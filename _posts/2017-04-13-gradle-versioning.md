---
layout: post
title: "Gradle Versionierung mit dem karriere.at Version Plugin"
date: 2017-06-21 10:00:00
author: markusv
tags: [gradle, versioning, github, open-source, java]
---

Projekte richtig zu versionieren ist eine komplexe Angelegenheit, die mit steigender Anzahl an Projekten auch immer 
komplexer wird. So haben wir das - zumindest im CORE Team - bei der Verwaltung unserer Java Projekte empfunden.

Wir halten uns an den [Semantic Versioning](http://semver.org/) Standard wodurch sichergestellt ist, dass die 
Releaseversionen immer eindeutig und nach einem gewissen Schema nachvollziehbar sind. Trotzdem kann es vorkommen, dass sich 
Snapshotversionen überschneiden, wenn mehrere Entwickler am selben Projekt arbeiten.

Unser erster Lösungsansatz für dieses Problem war, den Branchnamen mit in die Snapshotversion aufzunehmen. Das hat auch ganz gut 
funktioniert, allerdings war das ständige Ändern der Versionen ziemlich lästig. 

Als Entwickler versucht man natürlich, solche Aufgaben möglichst vollständig zu automatisieren: Genau das haben wir mit
unserem [Gradle Plugin](https://plugins.gradle.org/plugin/at.karriere.version) auch geschafft. Die manuellen Schritte zur
Erhöhung der Version, wurden fast vollständig automatisiert, was uns den Arbeitsalltag um einiges leichter macht.

![Increase Version Task](/assets/images/gradle-version/increase-version.png)

Da das Plugin auch für andere Entwickler möglichst gut zu verwenden sein soll, haben wir es auf 
[Github](https://github.com/karriereat/gradle-version-plugin) veröffentlicht. Wir würden uns freuen, wenn ihr uns dabei 
helft, das Plugin für möglichst viele verschiedene Projekt-Setups tauglich zu machen. Neben der Dokumentation findet ihr 
dort auch den Sourcecode, könnt Issues einbringen und Pull-Requests öffnen.

