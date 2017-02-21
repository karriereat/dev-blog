---
layout: post
title: "MySQL InnoDB Row Format Compression, oder wie wir ..."
date: 2017-02-20 13:00:00
author: jakob
tags: [mysql, compression]
excerpt: ... die Größe unserer MySQL-Datenbank um mehr als 70% reduzieren konnten.
---

... die Größe unserer MySQL-Datenbank um mehr als 70% reduzieren konnten.

![](/assets/images/mysql-table-compression/grafana-fs.png)

## Neugierig?

Du bist noch nicht neugierig genug! Unsere besten Klick-Bait-Überschriften: 

* SSD manufacturers hate us for this!
* You won't believe how we reduced the size of our database by 70% with this one simple trick!
* How to save millions of dollars with one line of code!

## Ausgangslage

Wir betreiben bei einem externen Cloud-Hoster eine Applikation, welche viele Daten sammelt und speichert.

Der Speicherplatz in unserer virtuellen Maschine ist auf 80 GB begrenzt, vor etwa einer Woche wurde der Platz auf unserer SSD knapp.
Grund dafür war eine MySQL-Tabelle, die bereits auf über 40 GB angewachsen war.

## Wohin mit den Daten?

Nach einer kurzen Recherche machten wir folgende Lösungen ausfindig:

* __Größere Festplatte kaufen.__ ❎   
Das wäre die einfachste Lösung. Aber was, wenn nach einem Jahr noch eine Festplatte her muss? Wie teilt man ein 40 GB MySQL-Tabelle auf zwei Festplatten auf?
Aufgrund dieser Fragen, und natürlich auch wegen der zusätzlich Kosten, haben wir uns gegen diese Lösung entschieden.
* __Daten vor dem Speichern manuell komprimieren.__ ❎   
Unser nächster Ansatz war es, die Daten vor dem Speichern in die Tabelle manuell zu komprimieren. Etwa mit  der PHP-Funktion `gzcompress()`.
Der Nachteil dabei: erhöhte Code-Komplexität durch das Komprimieren / Dekodieren und die höhere CPU-Last.
* __InnoDB Row-Format-Kompression aktivieren.__ ✅   
Seit MySQL 5.7.7 ¹ ist `Barracuda` das Standardformat für InnoDB-Tabellen. Das `Barracuda`-Format unterstützt (im Gegenzug zum alten `Antelope`-Format) Kompression.
Da wir eine aktuelle MySQL-Version einsetzen, konnten wir das Kompressions-Feature ohne Probleme nutzen. Aber auch bei dieser Lösung ist natürlich mit einer erhöhten CPU-Last zu rechnen.

Wir entschieden uns dazu, die Kompression unserer MySQL-Tabellen zu aktivieren.

Neben dem Nachteil der höheren CPU-Last ergeben sich durch die Komprimierung auch einige Vorteile. Hier ein Auszug aus der [MySQL Dokumentation](https://dev.mysql.com/doc/refman/5.7/en/innodb-compression.html):

> Using the compression features of InnoDB, you can create tables where the data is stored in compressed form. Compression can help to improve both raw performance and scalability. The compression means less data is transferred between disk and memory, and takes up less space on disk and in memory. [...] Compression can be especially important for SSD storage devices, because they tend to have lower capacity than HDD devices. 

## Umsetzung

Die Aktivierung der Kompression bei einer bestehenden Tabelle ist sehr einfach:

```
ALTER TABLE `foo` ROW_FORMAT=COMPRESSED;
```

Wir führten dieses Statement zuerst auf einer kleineren, 2,1 GB großen, Tabelle aus.
Die Ausführungszeit betrug 69,3 Sekunden und reduzierte die Tabellengröße auf 911 MB.

Danach führten wir das Statement auf unserer 40 GB großen Tabelle aus.
Eine unserer Befürchtungen war, dass das Statement in ein Timeout läuft und die Tabelle in einem kaputten Zustand hinterlässt. Mit der Standardkonfiguration unseres MySQL-Docker-Containers trat dieses Problem aber nicht auf.

Das Statement für unsere große Tabelle benötigte 23 Minuten und reduzierte die Tabellengröße um 76% auf 9,7 GB. 😍

Das machte sich auch auf unserem Dashboard deutlich bemerkbar:

![](/assets/images/mysql-table-compression/grafana-fs-2.png)

Wie man an dem kleinen Ausschlag erkennen kann, erstellt MySQL bei diesem Vorgang eine Kopie der Tabelle. In unserem Fall waren also noch mindestens 10 GB freier Speicherplatz notwendig.

## Auswirkungen

Wir konnten nur einen sehr geringen Anstieg der CPU-Last feststellen.
Auf unserem Disk I/O Graph war die Änderung jedoch deutlicher zu erkennen. Die Größe unserer Schreib- und Lesevorgänge halbierte sich. 🎉


## Fazit

Hat man auf dem Rechner ausreichend CPU-Leistung zur Verfügung, spricht nichts gegen die Aktivierung der InnoDB-Tabellen-Kompression.

Wir sind von diesem Feature schwer begeistert und werden es in Zukunft vermehrt einsetzen.

¹ [InnoDB Startup Options and System Variables](https://dev.mysql.com/doc/refman/5.7/en/innodb-parameters.html#sysvar_innodb_file_format)
