---
layout: post
title: "Wie man einen Zustand speichern kann"
date: 2017-01-27 00:00:00
author: hannes
tags: [php, laravel, open-source, github]
---

Den aktuellen Zustand einer Applikation abzulegen ist ein durchaus schwieriges Unterfangen. Wenn die Applikation den Inhalt am Server rendert, muss der aktuelle Zustand am Server abgelegt werden.

Ein gutes Beispiel für die beschriebene Situation wäre, wenn sich der User auf einem Bloglisting auf Seite 2 befindet und einen Artikel kommentieren möchte. Nach dem Klick auf den "Kommentar hinzufügen" Link, muss der Server überprüfen, ob der User eine gültige Session hat. Ist dies nicht der Fall, wird der User auf die Login Seite weitergeleitet. Nach einem erfolgreichen Login erwartet der User, wieder im Bloglisting auf Seite 2 zu sein und ein Kommentarformular unterhalb des Artikels zu sehen.

## Wie lösen wir das Problem
Um Informationen über die aktuelle Seite und die gewünschte Aktion des Users abzuspeichern, haben wir ein Laravel Package erstellt. Dieses Projekt ist frei auf [Github](https://github.com/karriereat/state) verfügbar.

Die Idee hinter dem Package ist es, eine einfache Möglichkeit zu haben, Informationen über/für einen User abzulegen und diese über einen eindeutigen Identifier später wieder abrufen zu können. Die aktuelle Version erlaubt es uns die Daten in der Session des Users oder in einem Cache abzulegen. Werden die Daten im Cache abgelegt, sind diese natürlich nur bis zum Ablauf des Cacheeintrags abrufbar.

Informationen wie das Package installiert wird, was bei der Konfiguration zu beachten ist und wie das Package im Detail zu verwenden ist, findet man in der [README](https://github.com/karriereat/state/blob/master/README.md) im Github Repo.

## Weiter Entwicklung des Packages
Um die Möglichkeit zu schaffen, Informationen zu persistieren, werden wir noch einen `DatabaseStore` implementieren. Dadurch kann garantiert werden, dass die Zustandsinformationen auch nach längerer Zeit noch abgerufen werden können.
Natürlich müssen wir für diese Erweiterung auch einen Aufräum-Mechanismus implementieren, damit alte Datensätze entfernt werden können.

Ihr habt Verbesserungen oder einen Fehler gefunden? Sendet uns einen [Pull-Request](https://github.com/karriereat/state/pulls) oder öffnet ein [Issue](https://github.com/karriereat/state/issues).

## Links
* [Github Repository](https://github.com/karriereat/state)
* [Artikel auf Englisch](https://johannespichler.com/storing-an-applications-state)
