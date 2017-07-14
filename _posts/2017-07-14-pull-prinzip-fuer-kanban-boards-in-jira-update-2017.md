---
layout: post
title: "Pull-Prinzip für Kanban-Boards in JIRA (Update 2017)"
date: 2017-07-14 13:00:00
author: michael
tags: [kanban, process, agile]
---

Letztes Jahr habe ich über das Pull-Prinzip und dessen Umsetzung in JIRA geschrieben. Mittlerweile haben wir diesbezüglich ein paar Änderungen vorgenommen: 

## Eigene JIRA-Statuswerte für den Pull-Status

Die Information, dass ein Ticket gezogen werden kann, wird nun nicht mehr über ein Custom-Dropdown-Field gelöst, sondern über eigene Statuswerte. Dies hat zwei Vorteile:

1. Statuswerte können in den Charts besser ausgewertet werden, da JIRA die Verweildauer im jeweiligen Status mit protokolliert.
2. Es gibt im Workflow eigene Übergänge, die wiederum als Auslöser für diverse andere Dinge genutzt werden können, wie zum Beispiel Slack-Benachrichtigungen.
 
Damit das Board aber nicht zu unübersichtlich wird, werden der _Doing_- und der zugehörige _Done_-Status immer in einer gemeinsamen Spalte angezeigt.
Das alte Dropdownfeld existiert weiterhin, dient aber nur mehr als Hilfseigenschaft um festlegen zu können, dass ein Ticket im Prozess zurückgezogen werden muss (_Ready to Pull: Back_).

![Typisches Kanban-Board bei karriere.at](/assets/images/2017-07-14-pull-prinzip-fuer-kanban-boards-in-jira-update-2017/kanbanboard.png)
![Zwei Status in einer Spalte im JIRA-Board](/assets/images/2017-07-14-pull-prinzip-fuer-kanban-boards-in-jira-update-2017/kanbanboard_statuses.png)

## Anpassung der Kartenfarben-Regeln

Wann ein Ticket im Board grün angezeigt wird, war in der alten Lösung einfach zu regeln, da nur der Wert des Dropdown-Felds überprüft wurde. Nun müssen eine Vielzahl an Statuswerten berücksichtigt werden. Da die Konfiguration in mehreren Projekten Anwendung findet, wurde die JQL-Abfrage als eigener Filter gespeichert und dieser wird nun in den Boards ausgewertet.

![Filter zum bestimmen der Kartenfarbe in einem JIRA-Board](/assets/images/2017-07-14-pull-prinzip-fuer-kanban-boards-in-jira-update-2017/kartenfarben_filter.png)

Wichtig ist, dass der Filter allen JIRA-Benutzern freigegeben wurde. Sollten in Zukunft neue Statuswerte dazukommen, so muss nur dieser eine Filter aktualisiert werden und es schlägt sich gleich auf alle Boards durch. 

![Filtereigenschaften in JIRA](/assets/images/2017-07-14-pull-prinzip-fuer-kanban-boards-in-jira-update-2017/public_filter.png)

## Scriptrunner

Die Groovy-Skripte für Scriptrunner wurden ebenfalls adaptiert. Die Menüpunkte befinden sich noch an der der gleichen Stelle wie früher, jedoch setzen sie nun den richtigen Done-Status, statt einen Wert im Dropdown-Feld.

Die Menüpunkte sind speziell deswegen weiterhin notwendig, weil man im JIRA-Board ein Ticket innerhalb einer Spalte nicht in einen anderen Status verschieben kann, da man sich sonst um die Möglichkeit der Ticketsortierung bringen würde.

![Durch Scriptrunner hinzugefügt Menüpunkte in JIRA](/assets/images/2017-07-14-pull-prinzip-fuer-kanban-boards-in-jira-update-2017/custom_menu_entries.png)

## Auswertungen

Jedes Projekt hat nun ein zusätzliches Kanban-Board. Dieses ist nicht dafür ausgelegt, dass Personen darin Ticket bearbeiten, sondern rein für die Auswertung des Cumulative Flow Diagramms und des Control Charts. Dort hat jeder Status eine eigene Spalte. Speziell im Control Chart hat dies den Vorteil, dann man sich nun die durchschnittlichen Liegezeiten der Tickets in den einzelnen Schritten explizit heraus rechnen kann.

Weiters ist es mit etwas manueller Rechnerei auch möglich sich anhand der Median-Werte die Flow-Efficiency auszurechnen. Diese wird in Prozent angegeben und errechnet sich folgendermaßen: _Aktive Arbeitszeit im Prozess/Gesamtzeit im Prozess*100_.

Mehr Infos dazu gibt es im [Webinar von David J Anderson](https://youtu.be/Vd_8XMAeL0w?t=22m43s).