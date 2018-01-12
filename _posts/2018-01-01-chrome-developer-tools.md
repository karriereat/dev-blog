---
layout: post
title: "5 Features der Chrome Developer Tools, die du unbedingt verwenden solltest!"
date: 2018-01-01
author: manu
tags: [debugging, javascript, performance, tooling]
---

Die Chrome DevTools werden von Entwicklern täglich genutzt. Die meisten Entwickler beschränken sich allerdings auf ein paar Features, die ihnen sehr vertraut sind -- etwa um CSS-Styles zu verändern oder JavaScript-Fehler zu überprüfen. Dabei lohnt der Blick über den Tellerrand, um neue hilfreiche Tools zu entdecken. 

In diesem Post möchte ich 5 Features vorstellen, die ihr vielleicht noch nicht kanntet, aber ich bei meiner Arbeit sehr praktisch finde:

1. [Browser verlangsamen](#browser-verlangsamen)
1. [Events überprüfen](#events-überprüfen)
1. [Progressive Web Apps überprüfen](#progressive-web-apps-überprüfen)
1. [7+1 Arten von Breakpoints](#71-arten-von-breakpoints)
1. [Ausführung (Anzahl und Zeit) messen](#ausführung-anzahl-und-zeit-messen)



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

Die Chrome DevTools bietet mehrere Möglichkeiten die zahlreichen Events auf modernen Seiten zu überprüfen. Besonders bei unbekannten Codestellen möchte man herausfinden, welche Event Listener auf welchen Elementen gesetzt sind.

### Event Listeners auf DOM-Elementen

Das Panel _Elements_ bietet einen Tab _Event Listeners_ in der Sidebar. Wählt man ein DOM-Element aus, werden alle Event Listener aufgelistet. Zu jedem Event Listener wird die Codezeile angegeben. Außerdem besteht die Möglichkeit, Event Listener vorübergehend zu entfernen.

![](/assets/images/chrome-developer-tools/chrome-developer-tools-events-on-dom-elements.png)

### Event Listeners auf Objekten

Will man sich die Event Listener in der Konsole ausgeben lassen gibt es den Befehl `getEventListeners(object)`. So lassen sich über `getEventListeners($('.c-dropdown-button'))` die gleichen Event Listener wie im vorherigen Beispiel anzeigen.

![](/assets/images/chrome-developer-tools/chrome-developer-tools-get-event-listeners.png)

Der Befehl `$(selector)` ist übrigens ein Alias für [document.querySelector](https://developer.mozilla.org/en-US/docs/Web/API/Document/querySelector).

### Events überwachen

Es lassen sich jedoch nicht nur die Event Listener eines Elements anzeigen. `monitorEvents(object[, events])` bietet die Möglichkeit, alle oder bestimmte Events in der Konsole zu protokollieren.

![](/assets/images/chrome-developer-tools/chrome-developer-tools-monitor-events.png)

Außerdem gibt es vordefinierte Gruppen, um mehrere Events gleichzeitig anzugeben: `mouse`, `key`, `touch` und `control`. `monitorEvents($0, 'mouse')` protokolliert z.B. `mousedown`, `mouseup` und dergleichen.
 
Der Befehl `$0` liefert übrigens das zuletzt ausgewählte DOM-Element oder JavaScript-Objekt.



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
