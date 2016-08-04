---
layout: post
title: "Introducing: Core Services Team"
date: 2015-08-28 08:07:07
author: wolfgang
---
Bei karriere.at gibt es für das DEV Team immer viel zu tun: Anforderungen kommen aus allen Abteilungen, vorwiegend aus dem Produktmanagement. Bei all den neuen Anforderungen bleibt kaum noch Zeit, sich um technologische Verbesserungen zu kümmern. Ein Update auf eine neuere Java Version bringt nach außen kaum eine sichtbare Verbesserung, ist aber dringend notwendig, um weiterhin eine hervorragende Qualität zu liefern. Deswegen wurde das DEV Team neu strukturiert, wodurch neben anderen Neuerungen ein eigenes Team für unsere Core Services entstanden ist.

![](//kcdn.at/dev-blog/images/introducing-core-services-team/dev_team.png)

<!--more-->

Grob gesagt sind die Hauptthemen im Core Services Team die Search & Match Technologien, auf denen die Jobsuche, der Jobalarm und vieles mehr aufbauen, sowie viele, viele Tools, die von karriere.at intern verwendet werden, wie etwa Producing Tools und die Ontologie.

# Let’s get the party started!

Als Product Owner für unsere Core Technologien bin ich für den Backlog und die Priorisierung unserer Tasks zuständig. Gleich zu Beginn haben wir uns einen ziemlich fetten Refactoring Task vorgenommen, nämlich die **technologische Harmonisierung** unseres Herzstücks von karriere.at: die Jobsuche!

Derzeit baut die Jobsuche auf einem Lucene Index auf. Beim Bewerber Matching haben wir bereits Elasticsearch im Einsatz, deswegen möchten wir nun auch die **Jobsuche auf Elasticsearch umbauen**.

Warum? Weil Elasticsearch mächtig und cool ist :)

Gleich im Anschluss wollen wir auch die Firmensuche auf Elasticsearch umbauen. Derzeit wird die Firmensuche über eine normale SQL Query ausgeführt, was früher vollkommen ausreichend war. In den letzten Jahren sind aber immer wieder neue Anforderungen eingeflossen, während gleichzeitig die Datenmenge immer größer wurde. Mittlerweile ist die SQL Query schon ziemlich am Limit und fleht uns an, auf Elasticsearch zu wechseln. Also gut - machen wir!

#Java 8: much good, much improvement, much win

Für unsere Java Entwickler ist es ein großes Anliegen, alles auf Java 8 zu migrieren. Die Begründung dafür wurde ziemlich klar formuliert, wie man am Titel des Tickets sieht:

![](//kcdn.at/dev-blog/images/introducing-core-services-team/java8.png)

# Was steht noch am Plan?

## Suchbegriff bei Jobsuche analysieren
In der Jobsuche werden nicht nur einfache Suchbegriffe wie Maurer, Projektleiter und Sachbearbeiter eingegeben. Web User sind es von Google & Co gewohnt, dass selbst komplette Sätze von der Suchmaschine problemlos verarbeitet werden können:

* Suche Job in meiner Umgebung
* Job, bei dem ich mit Menschen zu tun habe
* Firma entlang der A2

Solche Suchbegriffe stellen uns vor eine große Herausforderung, die wir aber gerne annehmen wollen. **Challenge accepted!**

## Information Extraction
Für unsere Search & Match Services ist es notwendig, den tatsächlichen Inhalt von Job Inseraten zu ermitteln. Hört sich einfach an, ist jedoch keine einfache Aufgabe, weil es für einen Algorithmus gar nicht so einfach ist, die **menschliche Sprache inhaltlich zu verstehen**. Wir haben bereits einige Erfahrungen auf diesem Gebiet gesammelt und erfolgreiche Implementierungen im Einsatz, möchten aber in naher Zukunft mit weiteren Technologien experimentieren.

## Interne Tools verbessern
Im Producing Team werden alle Jobs auf karriere.at manuell durchgesehen, kategorisiert, mit Schlagwörtern versehen und schließlich online gestellt. Ja - **ALLE** Jobs! Qualität ist uns nämlich ein echtes Anliegen.

Um diese anspruchsvolle Aufgabe für unsere Producer so angenehm wie möglich zu gestalten, gibt es Tools, die ständig verbessert und erweitert werden wollen. Auch neue Anforderungen haben oft eine Auswirkung auf die Arbeit des Producings. Beispielsweise unsere neuen spezialisierten Job Portale [itstellen.at](http://itstellen.at) und [techtalents.at](http://techtalents.at) mussten in den Producing Tools berücksichtigt werden.

## Kontinuierliche Performance Verbesserung
Mit Hilfe unseres **ELK Monitorings** können wir unser System in Echtzeit überwachen und sofort eingreifen, wenn etwas schief geht.

![](//kcdn.at/dev-blog/images/introducing-core-services-team/kibana_performance.png)

Die Grafik zeigt einen Fall aus jüngster Zeit, bei dem wir morgens einen **Performance Einbruch** beobachten konnten, der uns zwar einige Stunden beschäftigt hat, aber schließlich am Nachmittag gelöst werden konnte.

Es war übrigens kein Problem unserer Software, sondern ein Netzwerk Issue des Servers.