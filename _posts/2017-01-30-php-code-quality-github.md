---
layout: post
title: "Unser PHP Code Quality Package ist jetzt auf GitHub!"
date: 2017-01-30 13:00:00
author: jakob
tags: [php, code-quality, open-source, github]
---

Wie in unserem Blog-Eintrag [Code Quality matters](/a/php-code-quality/) beschrieben,
haben wir vor ein paar Monaten ein Package für die Sicherstellung unserer
PHP-Code-Quality erstellt.

Dieses ist jetzt frei auf GitHub verfügbar:
[karriereat/php-code-quality](https://github.com/karriereat/php-code-quality) 🎉

## Mögliche Einsatzgebiete

Für OpenSource Projekte ist dieses Package nicht sonderlich interessant, da es bereits sehr gute und kostenlose Code-Quality-Services wie TravisCI und StyleCI gibt.

Verwaltet man Git-Repositories jedoch privat, stehen einem diese freien Dienste nicht mehr (oder nur noch kostenpflichtig) zur Verfügung.

Da wir bei karriere.at unsere Projekte in einem privaten Repository verwalten, kommen für uns Cloud-Lösungen wie TravisCI oder StyleCI nicht in Frage.

Stattdessen führen wir unsere Code-Quality-Tests lokal und auf unserem eigenen CI-Server aus.

### Composer Scripts in Jenkins

Mit dem [karriereat/php-code-quality](https://github.com/karriereat/php-code-quality) Package können wir in unserem CI-Server einfach Composer-Scripts ausführen:

![](/assets/images/php-code-quality-github/jenkins_composer_scripts.png)

Diese Abstraktion hat den Vorteil, dass wir im Hintergrund jederzeit das verwendete Tool (wie zum Beispiel `phpcs`) austauschen können.

Die verwendeten Tools und deren Versionen werden zentral über das Code-Quality-Package verwaltet.

## Ausblick

Wir versuchen die Dependencies des Code-Quality-Package so gering wie möglich zu halten, um die Dauer des `composer install` Befehls nicht zu sehr zu verlängern.

Ihr habt Verbesserungen oder einen Fehler gefunden? Sendet uns einen [Pull-Request](https://github.com/karriereat/php-code-quality/pulls) oder öffnet ein [Issue](https://github.com/karriereat/php-code-quality/issues). 🚀
