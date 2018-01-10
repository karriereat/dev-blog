---
layout: post
title: "5 Features der Chrome Developer Tools, die du unbedingt verwenden solltest!"
date: 2018-01-01
author: manu
tags: [debugging, javascript, performance, tooling]
---

Die Chrome DevTools werden von Entwicklern täglich genutzt. Die meisten Entwickler beschränken sich allerdings auf ein paar Features, die ihnen sehr vertraut sind -- etwa um CSS-Styles zu verändern oder JavaScript-Fehler zu überprüfen. Dabei lohnt der Blick über den Tellerrand, um neue hilfreiche Tools zu entdecken. 

In diesem Post möchte ich einige Features vorstellen, die ihr vielleicht noch nicht kanntet, aber ich bei meiner Arbeit sehr praktisch finde.

## Browser verlangsamen

Oft möchte man die Zeit verlangsamen, um genau beobachten zu können, was eigentlich auf der eigenen App oder Seite passiert. Diese Möglichkeit bieten die Chrome DevTools in drei verschiedenen Panels: _Animations_, _Network_ und _Performance_.

### Animationen verlangsamen

Das hilfreiche Panel _Animations_ ist leider nicht auf Anhieb sichtbar. Wer mit `Esc` die Konsole öffnet, findet es im Menü mit den drei vertikalen Punkten. Darin werden alle CSS-Animationen inkl. ihrer Graphen aufgeschlüsselt, lassen sich wiederholen und eben auch langsamer abspielen.

<video width="864" height="432" controls>
  <source src="/assets/images/chrome-developer-tools/chrome-developer-tools-animation-panel.mp4" type="video/mp4">
</video>

### Netzwerk drosseln

Im Panel _Network_ lassen sich langsame Verbindungen simulieren, indem man das Dropdown rechts in der Leiste öffnet. Das gleiche Dropdown befindet sich außerdem im Panel _Performance_.

![](/assets/images/chrome-developer-tools/chrome-developer-tools-throttle-network.png)

### CPU drosseln

Ein schwacher Rechner lässt sich ebenfalls simulieren. Das Dropdown im Panel _Performance_ hat aber leider nur zwei Auswahlmöglichkeiten.

![](/assets/images/chrome-developer-tools/chrome-developer-tools-throttle-cpu.png)


## Events überprüfen

1. Event Listeners auf DOM-Elementen
2. Event Listeners auf Objekten: `getEventListeners(object)`
3. Events überwachen: `monitorEvents(object[, events])`

## Progressive Web Apps überprüfen

1. Manifest
2. Audits

## 7+1 Arten von Breakpoints

* Codezeilen
* Codezeilen mit Bedingungen
* DOM
* XHR
* Event Listener
* Exception
* Funktionen
* `debugger;`

## Ausführung (Anzahl und Zeit) messen

* `console.count(label)`
* `console.time([label])` und `console.timeEnd()`
* `console.timeStamp([label])`
