---
layout: post
title: "Quality Check für Bewerber Matching"
date: 2015-05-06 13:02:54
author: wolfgang
---
Wir arbeiten ständig an Verbesserungen unserer Produkte, aber oft lässt sich nur schwer messen, welche Variante eines Produktes nun tatsächlich besser ist. Was bedeutet "besser" überhaupt?<!--more--> Schneller? Billiger? Schöner? Höhere Conversion Rate?

Für diesen Zweck greifen wir oft auf A/B Testing zurück, aber für das Bewerber-Matching (eines unserer neuesten Produkte) benötigen wir etwas zielgerichteteres. Zufälligerweise probieren wir immer gerne __neue Sachen__ aus, deswegen haben wir kurzerhand ein Tool entwickelt, mit dem wir die Qualität messen können.

# Worum geht's beim Bewerber Matching?

Eines der Kernprodukte bei karriere.at ist die [talent.cloud](http://www.karriere.at/hr/talent-cloud). Wie der Name vermuten lässt, sind hier unzählige Profile von Personen zu finden, die aktuell auf Jobsuche sind und sich dazu auf karriere.at registriert haben.
Firmen können in der talent.cloud diesen Bewerberpool durchsuchen und neue Mitarbeiter aufspüren. Um diese Suche so einfach wie möglich zu gestalten, ermittelt ein Algorithmus zu allen Jobinseraten passende Kandidaten. Diese Suchlogik steht in Form des Bewerber Matchings in der talent.cloud zur Verfügung.

# Warum machen wir den Matching Test?

Das Bewerber Matching ist nicht einfach nur ein Algorithmus, sondern es verbirgt sich viel mehr Komplexität dahinter. Es greifen unzählige Zahnräder ineinander, die am Ende entscheiden, ob ein Bewerberprofil auch tatsächlich passt oder nicht. Einerseits möchte man perfekt passende Matches sehen, andererseits wünscht man sich einen gewissen Anteil an „Magic“...

Letztendlich ist es doch ziemlich subjektiv, ob ein Kandidat nun zum Jobinserat passt oder nicht, also kann die Matching Qualität automatisiert nicht ermittelt werden. Damit wir eine bessere __Vorstellung von der tatsächlichen Matching Qualität__ bekommen, haben wir uns zu einem internen Quality Check entschlossen, bei dem mehrere Mitarbeiter von karriere.at in die Rolle eines HR Managers schlüpfen und Matchings überprüfen.

# Wie läuft der Test ab?

Unser DEV Team hat ein Tool gebaut, das in etwa so aussieht wie das Matching in der talent.cloud. Zusätzlich kann auf einer Skala von 1 (perfekt passend) bis 4 (passt überhaupt nicht) und einem Kommentarfeld eine Bewertung abgegeben werden. Während eines Tests werden 5 Jobinserate mit jeweils 5 Bewerbern angezeigt. Neben den Einzelbewertungen für die 5 Bewerber wird auch eine Bewertung des Ersteindrucks und des Abschlusseindrucks vorgenommen.

![](//kcdn.at/dev-blog/images/quality-check-bewerber-matching/matching-test-tool.png)

Getestet wurde in 3 Testgruppen, wobei 5 Jobinserate zu jeder Gruppe zugeteilt wurden. Dazu wurde zuerst eine größere Menge an Jobs zufällig vorgefiltert. Aus diesen Jobs wurden dann jene Inserate ausgewählt, bei denen ein Qualitäts Check interessant erschien.

Für die Durchführung des Tests haben sich viele [Mitarbeiter von karriere.at](http://www.karriere.at/recruiting/team) freiwillig gemeldet, sodass wir mit insgesamt 21 Personen in 3 Testgruppen testen konnten. Das beweist wieder einmal den Teamgeist bei karriere.at und die Bereitschaft, unsere Produkte ständig weiter zu verbessern - an dieser Stelle also nochmal einen herzlichen Dank an alle Tester!

# Welche Erkenntnisse haben wir gewonnen?

Da Jobs vom Assistenten bis zum Abteilungsleiter getestet wurden, die in verschiedenen Berufsfeldern angesiedelt sind, haben wir zunächst mit ziemlich unterschiedlichen Bewertungen gerechnet. Tatsächlich hat sich aber eine __relativ gleichmäßige Durchschnittsbewertung__ ergeben. Daraus lässt sich schließen, dass die Menge an Jobs und Testern wohl eine gute Bandbreite abdeckt.

![](//kcdn.at/dev-blog/images/quality-check-bewerber-matching/matching_test_outcome.png)

Außerdem konnten wir beobachten, dass es sowohl sehr positive als auch strenge Testergebnisse gab. Trotzdem war auch hier innerhalb der 3 Testgruppen ein recht ähnliches Muster zu erkennen, das sich wiederum in ähnlichen Durchschnittswerten pro Gruppe widerspiegelt.

Als konkrete Verbesserungsmöglichkeit hat sich herausgestellt, dass __Berufsfeld und Branche__ viel mehr in das Matching einfließen müssen als bisher. Wenn beispielsweise ein IT Leiter gesucht wird, müssen jene Profile bevorzugt werden, die sowohl im Berufsfeld IT als auch im Berufsfeld Management angesiedelt sind. Ansonsten besteht die Gefahr, dass IT Fachkräfte ohne Führungskompetenz bzw. Führungskräfte mit mangelndem Technik-Background vorgeschlagen werden. Entsprechende Änderungen am Algorithmus sind bereits in Vorbereitung.

# Was hat uns der Quality Check gebracht?

Sehr viel! Neben den ersten konkreten Verbesserungsvorschlägen haben wir einen __realitätsnahen Ist-Zustand__ ermittelt. Wir wissen also jetzt, wo wir stehen und wie es weitergehen muss. Sobald wir die anstehenden Tasks erledigt haben, folgt der nächste Quality Check und der Zyklus beginnt erneut. Ich bin auf jeden Fall schon neugierig, wie sich die Bewertungen in Zukunft weiterentwickeln!