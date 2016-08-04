---
layout: post
title: "Logging #epicwin"
date: 2015-07-03 08:52:10
author: fichtl
---
Seit einigen Wochen überwacht der sogenannte ELK unsere Applikationen und die ersten Erfahrungen sind sehr positiv.

[---]

ELK steht für ElasticSearch / LogStash / Kibana, diese drei Programme bilden gemeinsam eine flexible Logging-Plattform die wir zukünftig sukzessive ausbauen wollen.

Jedes der Programme hat eine spezielle Aufgabe: 
* [ElasticSearch](https://www.elastic.co/products/elasticsearch) dient als Datastore
* [LogStash](https://www.elastic.co/products/logstash) bereitet die Log-Files auf oder fungiert als UDP-Server
* [Kibana](https://www.elastic.co/products/kibana) bereitet die Daten grafisch auf

![](//kcdn.at/dev-blog/images/logging-epicwin/Bildschirmfoto 2015-07-03 um 10.50.03.png)

## ELK aber wie?

Es gibt viele unterschiedliche Möglichkeiten wie man ELK verwenden kann. Bei uns sind alle ELK-Anwendungen auf einem zentralen Server installiert. Alle Webserver pushen mittels [UDP](https://de.wikipedia.org/wiki/User_Datagram_Protocol) auf diesen Server, dort hört LogStash auf diese Nachrichten und bereitet diese für die Speicherung auf.

UDP hat den Vorteil das der Absender nicht auf die Empfangsbestätigung wartet ("verbindungsloses Protokoll"), also wenn auf dem Logging-Server zum Beispiel Logstash nicht läuft, dann gehen die gesendeten Daten verloren ohne das der Absender davon erfährt ... das ist in diesem Fall nicht so schlimm da es nur Monitoring-Daten sind. 

Derzeit wird jede Action (inkl. Controller) an LogStash geschickt, ausserdem haben wir die Möglichkeit unterschiedliche Messpunkte pro Controller/Action zu senden. Diese Messpunkte lassen sich mittels Kibana als kombinierter Barchart visualisieren.

![](//kcdn.at/dev-blog/images/logging-epicwin/Bildschirmfoto 2015-07-03 um 10.36.03.png)

## Warum monitoren?

Im obigen Bild sieht man die Auswirkung eines IP-Blocks den wir setzen mussten weil ein anderer Spider karriere.at übermäßig gecrawlt hat. Solche Dinge sieht man teilweise auch im Nagios, dort wo Server-Load usw. überwacht werden. In diesem Fall war aber die Auswirkung nur im Kibana sichtbar.

Live-Application Monitoring macht immer Sinn weil sich selbst eine komplett getestete Anwendung im Echtbetrieb anders verhalten kann als auf einem Staging-Server. Die Entwicklungsumgebung ist nie 100%ig gleich wie das Produktivsystem und Anwender kommen immer wieder auf neue kreative Wege deine Software zu "verwenden" :)

## Lessons learned

Monitoring produziert viele Daten, man sollte sehr genau darauf achten welche Daten man pusht und wie die Daten dann im ElasticSearch abgelegt werden. Es macht einen enormen Unterschied ob der Typ einer Nachricht aus nur einem oder aus zehn Buchstaben besteht ... weil man ja pro Sekunde zig solcher Nachrichten sendet.

Die Auswertungen werden teilweise von Kibana im RAM durchgeführt, wenn dieser zu wenig ist dann scheitert die Auswertung und es wird nur ein Fehler angezeigt. Das kann man aber in der Konfiguration ändern. Überhaupt ist die Konfiguration nicht ganz einfach, man muss relativ genau aufpassen wie hoch man unterschiedliche Limits setzt, oder man bekommt ständig Exceptions.




