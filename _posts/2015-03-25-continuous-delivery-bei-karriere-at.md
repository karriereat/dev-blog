---
layout: post
title: "Continuous Delivery bei karriere.at"
date: 2015-03-25 12:07:25
author: alex
---
Neue Features den Benutzern sofort zugänglich machen und Bugfixes innerhalb kurzer Zeit zu beheben, ist oft sehr schwer zu verwirklichen. Wir bei karriere.at versuchen unser Bestes dieses Vorgehen zu leben. Möglich ist das aber nur durch unsere Entwicklungs- und Test- und Deployment-Umgebungen, sowie der Disziplin unserer Entwickler. Wie das bei uns funktioniert, möchten wir in diesem Artkiel erklären.
[---]
# Was bedeutet Continuous Delivery bei karriere.at?

Carl Caum hat mal folgenden Text getwittert:  

> "Continuous Delivery doesn't mean every change is deployed to production ASAP. It means every change is proven to be deployable at any time."  

Genau nach diesem Prinzip arbeiten wir auch bei karriere.at. Nicht jede Änderung wird sofort auf unsere Live-Server deployed. Nicht jede Änderung wollen wir sofort zur Verfügung stellen. Falls wir das aber wollen, ist es möglich. Dafür verwenden wird verschiedene Werkzeuge die uns dabei helfen:

* Grunt: Zur Erstellung und Kompilierung unserer Assets,
* Git: Zur Verwaltung und Versionierung unseres Source-Codes,
* Gitlab: Um unsere Änderungen nachvollziehen zu können und über
Merge Requests ( bei GitHub: Pull Requests )
Code Reviews durchzuführen.
* Jenkins: Um Änderungen zu testen und diese auf Test, Staging oder Production zu verteilen.

# Coding & Code-Review
![](//kcdn.at/dev-blog/images/continuous-delivery-bei-karriere-at/gitlab.png)
Abbildung: Gitlab Activity Stream

Für jede Änderung am Code wird bei uns ein Bugfix- oder Feature-Branch vom Master weg erstellt und man beginnt zu entwickeln. Auf dem erstellten Branch können einzelne oder mehrere Team-Mitglieder arbeiten, ohne dass dadurch der Master-Branch "dirty" wird. 

Ist der Bug behoben beziehungsweise das Feature fertig entwickelt, wird vom Entwickler ein Merge-Request in Gitlab erstellt und einem anderen Entwickler zugeteilt. Dieser führt ein Review des Source-Codes durch und kann dabei direkt beim geänderten Code Anmerkungen oder Verbesserungsvorschläge hinterlassen. Der Ersteller des Merge-Requests wird über die Kommentare benachrichtigt und kann diese beantworten oder den Code weiter verbessern. 

Ist der Reviewer mit allen Änderungen zufrieden, akzeptiert er den Merge-Request. Durch einen Pre-Merge Hook werden die Änderungen automatisch im Continuous-Integration-Server Jenkins überprüft. Falls auch dieser Test positiv ist, wird der Branch automatisch in den Master gemergt.

# Testing, Staging & Live Deployment

![](//kcdn.at/dev-blog/images/continuous-delivery-bei-karriere-at/Übersicht_Jenkins.png) Abbildung: Übersicht aller Jenkins-Deploys

Der Master-Branch, aber auch ein Feature- und Bugfix-Branch, kann mittels Jenkins auf Test-Servern bereitgestellt werden, die den selben Stack wie unsere Live-Server aufweisen. Hier wird die gesamte Codebase neu geklont und alle unsere Assets neu erstellt. Es werden Javascript-Files zusammengefügt und komprimiert, Less-Files kompiliert, Webfonts erstellt und Tests durchgeführt.

Unsere Staging-Deploys nützen wir um Branches zu deployen, die

1. auch von außen erreichbar sein sollen, und
2. nicht von anderen Test-Deploys überschrieben werden.

Der Staging-Deploy überschreibt keine älteren Deploys und generiert eine auf dem Branch basierende URL, die danach auch mit QA, Marketing und anderen Mitarbeitern zum Ansehen, Kontrollieren und Testen verwendet werden kann.

Auch das Live-Deployment wird über den CI-Server Jenkins durchgeführt. Auch hier werden Tests, sowie der Asset-Erstellungsprozess durchlaufen und das fertige Build danach auf unsere Webserver verteilt.

# Zusammenfassung

Viele der erwähnten Prozesse sind automatisiert und erleichtern uns den Entwicklungsalltag. Wir versuchen trotzdem täglich, die erwähnten Abläufe zu verbessern und zu optimieren. Diese werden bei uns mehrmals täglich durchlaufen – so kann es sein, dass unsere Web-Applikationen bis zu 15 Updates pro Tag erhalten.