---
layout: post
title: "Projekt-Fortschrittsanzeige in JIRA mittels Scriptrunner"
date: 2017-11-06 12:00:00
author: michael
tags: [kanban, process, agile, jira]
---

Während die Entwicklungsteams bei karriere.at ihr operatives Tagesgeschäft in ihren jeweiligen JIRA-Projekten verwalten, so besteht aus Managementsicht doch auch die Notwendigkeit einen Überblick über länger laufende Initiativen und Projekte zu haben, speziell wenn teamübergreifende Tätigkeiten notwendig sind. Das Produkt [Portfolio](https://www.atlassian.com/software/jira/portfolio) von Atlassian ist für unsere Zwecke leider nicht geeignet, da es sehr starken Fokus auf Velocity-Werte und Sprints legt.

Wir haben uns daher entschlossen ein eigenes JIRA-Projekt anzulegen und dort größere Vorhaben als Vorgangstyp *Initiative* abzubilden. Die einzelnen Tickets der Teams, wie *Epics*, *User Stories*, *Defects* oder *Spikes* werden dann mit der jeweiligen Initiative über die Verlinkungsart "Abgeleitet" verknüpft.

Dies hat aber den Nachteil, dass es aufgrund der unterschiedlichen Ebenen schwer ist, schnell feststellen zu können, wie weit eine Initiative fortgeschritten ist. Aus diesem Grund haben wir mithilfe des Add-ons [Scriptrunner](https://scriptrunner.adaptavist.com/latest/index.html) zur visuellen Unterstützung einen Fortschrittsbalken implementiert. Hierzu eine kleine Anleitung:

## Einrichten des Feldes

Zunächst benötigt man ein Custom Field vom Typ *Scripted Field*:

![Select-a-Field-Type-Modal](/assets/images/jira-progressbar/jira-addfield.png)

Im Anschluss wechselt man zu *Add-ons→Script Fields* und bearbeitet das gerade erzeugte Feld. Wichtig ist, dass die Ausgabe auf *HTML* geändert wird.

![Konfigurationsdialog für Scripted Field](/assets/images/jira-progressbar/jira-configurefield.png)

## Script

Bleibt nur noch, das Groovy-Skript als eigene Datei über den Serverpfad, oder als Inline-Script zu definieren.

Als erstes suchen wir alle Vorgänge, die mittels *derives* beim aktuellen Vorgang verlinkt sind. Handelt es sich um einen Epic, so wird der Issue Key zwischengespeichert. Alle anderen Vorgänge werden auf deren Statuskategorie geprüft und der jeweilige Counter hochgezählt.

~~~groovy
import com.atlassian.jira.component.ComponentAccessor
import com.atlassian.jira.issue.search.SearchProvider
import com.atlassian.jira.jql.parser.JqlQueryParser
import com.atlassian.jira.web.bean.PagerFilter

def jqlQueryParser                = ComponentAccessor.getComponent(JqlQueryParser)
def searchProvider                = ComponentAccessor.getComponent(SearchProvider)
def issueManager                  = ComponentAccessor.getIssueManager()
def user                          = ComponentAccessor.getJiraAuthenticationContext().getLoggedInUser()
def statusCounter                 = ['New':0, 'In Progress':0, 'Complete':0]
def epicslist                     = []

def query                         = jqlQueryParser.parseQuery("issueFunction in linkedIssuesOf('issue = " + issue.getKey() + "', 'derives')")
def results                       = searchProvider.search(query, user, PagerFilter.getUnlimitedFilter())

results.getIssues().each {documentIssue ->
    if (documentIssue.getIssueType().getName() == "Epic") {
        epicslist.add(documentIssue.getKey())
    } else {
        statusCounter[documentIssue.getStatus().getStatusCategory().getName()] += 1
    } // end if
} // end each
~~~

Epics verhalten sich etwas anders, deswegen fragen wir darin liegende Tickets noch einmal über eine eigene JQL-Query ab. Dazu nutzen wir die Issue Keys von der ersten Abfrage. Auch hier aktualisieren wir die Counter wieder.

~~~groovy
if (epicslist.size() > 0) {
    query                        = jqlQueryParser.parseQuery("issueFunction in issuesInEpics ('issuekey IN (" + epicslist.join(', ') + ")')")
    results                      = searchProvider.search(query, user, PagerFilter.getUnlimitedFilter())

    results.getIssues().each {documentIssue ->
        statusCounter[documentIssue.getStatus().getStatusCategory().getName()] += 1
    } // end each
} // end if
~~~

Nun, da wir die benötigten Werte ermittelt haben, wird das ganze noch ausgegeben. Der Fortschrittsbalken wird mittels CSS-Inline-Grid erzeugt, sodass er zum Look-and-Feel von JIRA passt.

~~~groovy
/*
return nothing if there are no linked issue
*/
if (statusCounter['New'] == 0 && statusCounter['In Progress'] == 0 && statusCounter['Complete'] == 0) {
    return null;
} // end if

def counterNewString        = ''
def counterInProgressString = ''
def counterCompleteString   = ''
def divContainerNew         = ''
def divContainerInProgress  = ''
def divContainerComplete    = ''
def counterSum              = statusCounter['New'] + statusCounter['In Progress'] + statusCounter['Complete']
def percentNew              = 0.0
def percentInProgress       = 0.0
def percentComplete         = 0.0

if (statusCounter['New'] > 0) {
    percentNew              = (100/counterSum*statusCounter['New']).toBigDecimal()
    counterNewString        = Integer.toString(statusCounter['New']) + 'fr'
    divContainerNew         = "<span title='ToDo (" + percentNew.setScale(0, BigDecimal.ROUND_HALF_UP) + "%)'>" + Integer.toString(statusCounter['New']) + "</span>"
}

if (statusCounter['In Progress'] > 0) {
    percentInProgress       = (100/counterSum*statusCounter['In Progress']).toBigDecimal()
    counterInProgressString = Integer.toString(statusCounter['In Progress']) + 'fr'
    divContainerInProgress  = "<span title='In Progress (" + percentInProgress.setScale(0, BigDecimal.ROUND_HALF_UP) + "%)'>" + Integer.toString(statusCounter['In Progress']) + "</span>"
}

if (statusCounter['Complete'] > 0) {
    percentComplete         = (100/counterSum*statusCounter['Complete']).toBigDecimal()
    counterCompleteString   = Integer.toString(statusCounter['Complete']) + 'fr'
    divContainerComplete    = "<span title='Done (" + percentComplete.setScale(0, BigDecimal.ROUND_HALF_UP) + "%)'>" + Integer.toString(statusCounter['Complete']) + "</span>"
}

def returnstring = """
<style type="text/css">
    .k-progress-chart {
        display: inline-grid;
        width: 30em;
        font: bold 0.6em arial, sans-serif;
        color: rgba(255, 255, 255, 0.5);
        text-align: center;
    }

    #k-issue-${issue.getKey()} {
        grid-template-columns: ${counterCompleteString} ${counterInProgressString} ${counterNewString};
    }

    .k-progress-chart span {
        padding: 0.2em 0;
    }

    .k-progress-chart span[title^='ToDo'] {
        background: #4a6785;
    }

    .k-progress-chart span[title^='In Progress'] {
        background: #ffd351;
        color: rgba(0, 0, 0, 0.5);
    }

    .k-progress-chart span[title^='Done'] {
        background: #14892c;
    }

    .k-progress-chart > :first-child { 
        border-top-left-radius:0.5em;
        border-bottom-left-radius:0.5em;
    }

    .k-progress-chart > :last-child { 
        border-top-right-radius:0.5em;
        border-bottom-right-radius:0.5em;
    }
</style>
<span class='k-progress-chart' id="k-issue-${issue.getKey()}">
    ${divContainerComplete}
    ${divContainerInProgress}
    ${divContainerNew}
</span>
"""
return returnstring.replaceAll(/    /, '');
~~~

Zum Schluss müssen wir noch definieren, wo der Balken angezeigt werden soll. Dazu wird das Custom Field einfach bei den verwendeten Bildschirmmasken eingehängt.

![Konfigurationsdialog für eine JIRA-Bildschirmmaske](/assets/images/jira-progressbar/jira-screen.png)
![JIRA-Vorgang mit Fortschrittsbalken-Anzeige](/assets/images/jira-progressbar/jira-issue.png)

Auch die Anzeige in Kanban-Boards und in Suchergebnissen funktioniert:

![JIRA-Kanban-Board mit eingeblendeter Fortschrittsanzeige](/assets/images/jira-progressbar/jira-kanbanboard.png)
![Suchergebnis in JIRA mit eingeblendeter Fortschrittsanzeige](/assets/images/jira-progressbar/jira-searchresult.png)
