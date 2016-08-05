---
layout: post
title: "Sprintvorbereitungen in JIRA"
date: 2015-11-02 10:26:30
author: michael
tags: [scrum, jira]
---
Wenn sich Arbeitsprozesse ändern, so müssen sich auch die Werkzeuge an die neuen Gegebenheiten anpassen. Eine der letzten Änderungen betraf unser Ticket-Tool JIRA.
<!--more-->

Hier bei karriere.at arbeiten die meistens Teams nach dem [Scrum-Framework](https://de.wikipedia.org/wiki/Scrum) und verwenden <a href="https://de.atlassian.com/software/jira">JIRA</a> als Werkzeug, um [User Stories](https://de.wikipedia.org/wiki/Scrum#User_Story) zu erfassen. Da das sogenannte [Backlog Grooming](https://de.wikipedia.org/wiki/Scrum#Product_Backlog_Refinement) zwar von sehr vielen Entwicklerteams gemacht wird, jedoch kein offizieller Bestandteil von Scrum ist, hat der Hersteller [Atlassian](https://de.wikipedia.org/wiki/Atlassian) hierzu auch keine native Funktionalität in JIRA eingebaut.
Bis vor Kurzem haben die [Product Owner](https://de.wikipedia.org/wiki/Scrum#Product_Owner) dazu manuell eine Seite in <a href="https://de.wikipedia.org/wiki/Confluence_(Atlassian)">Confluence</a> gepflegt, wo sie ihre Stories eingetragen haben, die sie mit dem Umsetzungsteams groomen wollten. Stories die dann bereit für die Aufnahme in einen zukünftigen Sprint waren, wurden in der Backlogliste über einem Behelfseintrag "Next Sprint" platziert.

![](/assets/images/sprintvorbereitungen-jira/jira-next-sprint.png)

Das war immer sehr wartungsintensiv und fehleranfällig, weil mehrere Product Owner sich (momentan noch) ein Backlog teilen. Der elegantere Weg, den wir nun eingeführt haben sieht so aus:
* Wir haben in JIRA in der Board-Konfiguration zwei weitere Status in der Statuskategorie "To Do" eingeführt: "Grooming" und "Ready for Sprint". ![](/assets/images/sprintvorbereitungen-jira/jira-new-states.png)
* Wenn ein Product Owner eine Story bei einem Groomingmeeting besprechen will, so ändert er den Status dieser Story auf "Grooming". ![](/assets/images/sprintvorbereitungen-jira/jira-set-status.png)
* Wenn eine Story beim Grooming Meeting soweit besprochen wurde, dass alle Punkte geklärt sind und sie potentiell in einen Sprint aufgenommen werden kann, so vergibt der Product Owner den Status "Ready for Sprint".
* Zur besseren Übersicht wird einer Story, die den Status "Grooming" hat, eine hellblaue Kartenfarbe zugeteilt, einer Story mit dem Status "Ready for Sprint" eine dunkelblaue Kartenfarbe. ![](/assets/images/sprintvorbereitungen-jira/jira-card-colors-example.png) Dies kann ebenfalls in der Board-Konfiguration eingestellt werden: ![](/assets/images/sprintvorbereitungen-jira/jira-card-colors.png)
