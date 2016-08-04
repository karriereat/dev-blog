---
layout: post
title: "Pull-Prinzip für Kanban-Boards in JIRA"
date: 2016-05-04 09:06:07
author: michael
---
Kanban-Boards in JIRA bieten nur Basisfunktionalitäten. Mit ein paar Handgriffen lässt sich aber auch das Pull-Prinzip implementieren.

Setzt man [Kanban in der Softwareentwicklung](https://de.wikipedia.org/wiki/Kanban_(Softwareentwicklung)) ein, so ist eine der Praktiken das [Pull-Prinzip](https://youtu.be/ndWPFk7GR8k). Dies bedeutet, dass sich ein Teammitglied erst ein neues Ticket in seine Spalte zieht, sobald er die Arbeit am aktuellen Ticket fertig gestellt hat. Ist er mit der Arbeit an einem Ticket fertig, so markiert er es nur als "Done", belässt es aber in der gleichen Spalte. Dies soll in einem "sustainable pace", also in einer nachhaltigen Arbeitsgeschwindigkeit, resultieren und so vor Überlastung/Burn Outs schützen.

JIRA Software bietet prinzipiell die Möglichkeit Kanban-Boards zu erstellen, hat jedoch ein paar Defizite, was gewisse Kanban-Basisfunktionalitäten betrifft und wo die Konkurrenz schon weiter ist. Eben eines dieser fehlenden Features ist es, ein Ticket nach der Bearbeitung schnell als "Done" beziehungsweise "Ready to Pull" zu markieren.  
Für die Kanban-Boards bei karriere.at haben wir das nun auf folgende Art gelöst:

## Custom Field für Pull-Status

Zunächst haben wir ein eigenes Select-Feld "Ready to Pull" mit den Werten "Forward" und "Back" erstellt und auf allen relevanten Screens eingeblendet.

![](/assets/images/pull-prinzip-kanban-jira/readytopull.png)

## Kartenfarben für Status definieren

Um nun visuell auf den Boards anzuzeigen, ob ein Ticket bereit ist gezogen zu werden, verwenden wir die Kartenfarben, die man im Board einstellen kann. Leider verhindert dies, dass man die Kartenfarben dann noch auf eine andere sinnvolle Weise verwenden kann.

![](/assets/images/pull-prinzip-kanban-jira/jirakanbanboardconfig.png)

## Transitions definieren

Die hinterlegten Workflows bei den Projekten sind so modifiziert, dass bei jedem Statusübergang, also dann wenn ein Benutzer auf dem Board ein Ticket von einer Spalte in die nächste zieht, das Feld "Ready to Pull" geleert wird und der aktuelle Benutzer als "Assignee" eingetragen wird.

![](/assets/images/pull-prinzip-kanban-jira/jiratransitionpostfunctions.png)

## Scriptrunner

Bis hierher geht alles noch mit Boardmitteln. Allerdings ist das Setzen des Ready-to-Pull-Felds umständlich, weil der Anwender bei einem Ticket jedes Mal den Edit-Dialog aufrufen muss. Das Add-on [Scriptrunner](http://www.adaptavist.com/w/products-plugins/adaptavist-scriptrunner/scriptrunner-for-jira/) ermöglichst es aber seit der Version 4.3 auch sogenannte Script Fragments zu definieren. Im Prinzip klinkt sich das Plugin mit ein paar Hooks im Interface ein und ermöglicht dem Administrator so die Oberfläche an gewissen Stellen um Menüpunkte zu erweitern, die wiederum [Groovy-Scripts](https://de.wikipedia.org/wiki/Groovy) über einen Custom REST-API Endpoint aufrufen. Eine solche Schaltfläche haben wir implementiert um schnell den Ready-to-Pull-Wert zu ändern:

![](/assets/images/pull-prinzip-kanban-jira/jiraboarddetail.png) ![](/assets/images/pull-prinzip-kanban-jira/jiraissuedetail.png)

Die Menüpunkte werden über ein Script Fragment definiert:

![](/assets/images/pull-prinzip-kanban-jira/jirawebitemscriptrunner.png)

Dieses ruft wiederum einen Custom Endpoint auf, der dann den Ready-to-Pull-Wert setzt (Achtung: Es folgt ein grausliches Script):

```java
import com.onresolve.scriptrunner.runner.rest.common.CustomEndpointDelegate
import groovy.json.JsonOutput
import groovy.transform.BaseScript
import javax.ws.rs.core.MultivaluedMap
import javax.ws.rs.core.Response
import com.atlassian.jira.component.ComponentAccessor
import com.atlassian.jira.issue.IssueManager
import com.atlassian.crowd.embedded.api.User
import com.atlassian.jira.issue.MutableIssue
import com.atlassian.jira.ComponentManager
import com.atlassian.jira.issue.ModifiedValue
import com.atlassian.jira.issue.util.DefaultIssueChangeHolder
import com.atlassian.sal.api.ApplicationProperties
import com.onresolve.scriptrunner.runner.rest.common.CustomEndpointDelegate
import com.atlassian.jira.issue.fields.CustomField
import com.atlassian.jira.issue.CustomFieldManager
import com.atlassian.jira.issue.customfields.option.Options
import com.atlassian.jira.issue.customfields.manager.OptionsManager
import com.atlassian.jira.issue.index.IssueIndexingService
@BaseScript CustomEndpointDelegate delegate
def issueManager            = ComponentAccessor.getIssueManager()
def customFieldManager      = ComponentAccessor.getCustomFieldManager()
def componentManager        = ComponentManager.getInstance()
def optionsManager          = componentManager.getComponentInstanceOfType(OptionsManager.class)
def issueIndexingService    = ComponentAccessor.getComponent(IssueIndexingService)
def issueService            = ComponentAccessor.getIssueService()
rtp(httpMethod: "GET") { MultivaluedMap queryParams ->
    def issueId                 = queryParams.getFirst("issueId") as Long
    def rtpType                 = queryParams.getFirst("rtptype") as String
    def issue                   = issueManager.getIssueObject(issueId)
    def rtpCf                   = customFieldManager.getCustomFieldObject("customfield_10830")
    def changeHolder            = new DefaultIssueChangeHolder()
    def fieldConfig             = rtpCf.getRelevantConfig(issue)
    def user                    = ComponentAccessor.jiraAuthenticationContext.getLoggedInUser()
    def issueInputParameters    = issueService.newIssueInputParameters()
    Options options             = optionsManager.getOptions(rtpCf.getConfigurationSchemes().first().getOneAndOnlyConfig());

    // set "Ready to Pull" to "Forward"
    if (rtpType == "forward") {
        def selectedOptions = options.findAll {
            it.value == "Forward"
        }.collect {
            it.optionId.toString()
        }
        issueInputParameters.addCustomFieldValue("customfield_10830", *selectedOptions)
    } // end if
    // set "Ready to Pull" to "back"
    if (rtpType == "back") {
        def selectedOptions = options.findAll {
            it.value == "Back"
        }.collect {
            it.optionId.toString()
        }
        issueInputParameters.addCustomFieldValue("customfield_10830", *selectedOptions)
    } // end if

    def updateValidationResult = issueService.validateUpdate(user, issue.id, issueInputParameters)
    if (updateValidationResult.isValid()) {
        issueService.update(user, updateValidationResult)
        log.debug("Done")

        // reindex issue
        issueIndexingService.reIndexIssueObjects([issue])

        // Output message to user
        def flag = [
            type : 'success',
            title: "Issue change successfully",
            close: 'auto',
            body : "The following changes have been made: Set 'Ready to Pull'."
        ]

        Response.ok(JsonOutput.toJson(flag)).build()
    } else {
        log.debug(updateValidationResult.errorCollection)
    }
}
```

Ein kleiner Schönheitsfehler bleibt jedoch: Das Board beziehungsweise die Detailansicht eines Tickets wird nicht automatisch aktualisiert.

## Konklusion

Richtig schnell wäre man, wenn man ein Ticket mittels Tastenkombination auf " Done" setzen könnte. Dazu müsste man dann aber ein eigenes Plugin bauen. Das Erweitern des Kontextmenüs bei einem Ticket wäre auch nicht schlecht, scheitert jedoch daran, dass JIRA hier nicht mal Scriptrunner eine Möglichkeit bietet sich einzuklinken. Es bleibt zu hoffen, dass Atlassian diese Basisfunktionalität selber mal nachliefert und somit die Kartenfarben wieder zu anderen VIsualisierungszwecken verwendet werden können. Nachdem in letzter Zeit die JIRA- Releases jedoch nur kosmetischer und marketingtechnischer Natur sind dürfte dies wohl nicht so bald geschehen.
