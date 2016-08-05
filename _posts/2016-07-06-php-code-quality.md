---
layout: post
title: "Code Quality matters"
date: 2016-07-06 09:14:57
author: jakob
tags: [php, code-quality]
---
Jeder Entwickler kennt die Situation; man muss Änderungen in einem fremden Projekt vornehmen, findet aber eine unschöne Code-Basis vor:

- Tabs und Spaces sind gemischt
- Der Code Style ist inkonsistent
- DocBlocks sind eine Seltenheit
- Es sind keine Tests vorhanden
- Im VCS wurden keine Versionen getagged

Bei dieser Ausgangsbasis würde man das Projekt am liebsten erst gar nicht angreifen.
![](http://i.imgur.com/J1svNp7.jpg)
Nach einigen Jahren Entwicklung an unserer Core-Library (PHP), ist diese genau zu so einem Projekt geworden. Man vermeidet so weit wie möglich Änderungen, weil die Folgen oft unabsehbar sind.

Um unsere Entwicklung wieder angenehmer zu machen, musste also ein neues Konzept her. Wir entschieden uns, unsere Kernkomponenten in Composer-Packages aufzuteilen, um in Zukunft flexibler zu sein (und um unsere WTFs/minute zu reduzieren 😉 ).

## Maßnahmen zur Verbesserung der Code Qualität

Um die Code Qualität über alle Packages hinweg konsistent zu halten, machen wir von folgenden Praktiken gebrauch:

* Jedes Paket enthält eine [.editorconfig](http://editorconfig.org/)-Datei:

```config
charset = utf-8
end_of_line = lf
indent_style = space
indent_size = 4
```

* Jedes Paket hält sich an den [PSR-2](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md) Standard.
* Jedes Paket enthält Tests für die wichtigsten Funktionen.
* Jedes Paket muss nach [SemVer 2.0.0](http://semver.org/) versioniert werden.

Aber was helfen all diese Richtlinien, wenn sich keiner daran hält? Aus diesem Grund haben wir ein Code-Quality-Package erstellt, welches dem Entwickler hilft, sich an die Vorgaben zu halten.

Dieses kann einfach als 'require-dev' zu einem Package hinzugefügt werden und enthält folgende Funktionen, welche als Composer-Script ausgeführt werden können:
* Ausführen der Tests (und Erstellung eines Code Coverage Reports).
* Überprüfung des Code Style (PSR-2).
* Automatisches beheben von Code Style Fehlern.

## Automatisierung

Diese Tests werden außerdem automatisch in Jenkins ausgeführt. Dadurch sieht man sofort, welche Packages Verbesserungsbedarf haben:

![](/assets/images/php-code-quality/jenkins_packages.png)
![](/assets/images/php-code-quality/jenkins_codequality.png)

## Fazit

Qualitativ hochwertiger Code = glückliche Entwickler = mehr Effizienz beim Entwickeln.
