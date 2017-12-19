---
layout: post
title: "Meine Masterarbeit mit karriere.at"
date: 2017-12-19 08:00:00
author: stefank
tags: [informationextraction, masterthesis, fhhagenberg, parttime]
---

Auf der Suche nach einem Praktikum im Bachelorstudium bin ich das erste Mal auf karriere.at aufmerksam geworden. Ich habe einen Praktikumsplatz ergattert und wollte danach auch nicht mehr weg. So konnte ich neben meinem Masterstudium in Hagenberg weiterarbeiten. Montags und dienstags bei karriere.at und den Rest der Woche an der FH. Generell wurde ich bezüglich der Arbeitszeiten und dem Studium immer unterstützt.

Das Thema der Masterarbeit haben wir so gestaltet, dass sowohl karriere.at, als auch ich davon profitieren konnten. Ich konnte auch immer auf die Unterstützung meiner Kollegen zählen. Vor allem mit unserer Data Scientistin Christina habe ich intensiv zusammengearbeitet, um mein Wissen auf dem Gebiet der Informationsextraktion weiter zu vertiefen. Es ist einfach toll zu sehen, dass die vielen, in die Masterarbeit investierten Stunden, nicht umsonst waren, sondern, dass das dabei entwickelte System jetzt auch tatsächlich zum Einsatz kommt.

In den nächsten paar Absätzen habe ich einen Ausschnitt aus meiner Arbeit kurz zusammengefasst.

## Die Informationen liegen nicht am Silbertablett

In einem Stelleninserat steckt eine Vielzahl an für den/die Jobsuchende/n interessante Informationen. Allen voran der Titel der ausgeschriebenen Stelle und der Dienstort. Darüber hinaus auch noch das Gehalt und die Anstellungsart. Für das Absenden einer Bewerbung wird dann auch noch eine Ansprechperson benötigt, am besten mit Post- und E-Mail-Adresse.

Das Problem an der ganzen Sache besteht darin, dass wir selbst mit wenigen Blicken zwar relativ schnell die wichtigsten Informationen aus so einem Stelleninserat herausfiltern können, für eine Maschine ist es aber nicht mehr als ein Stück Text. Es gibt auch kein klar vordefiniertes Muster, welches verwendet werden könnte, um an die verschiedenen Happen an Informationen zu gelangen. Jedes Inserat hat seine eigene Struktur, seinen eigenen Aufbau und seine eigene Form.

## From Plain Text To Knowledge

Natürlich kann man den Ersteller eines Stellenangebots darum bitten, die benötigten Informationen in strukturierter Form, als Metainformation, zusätzlich zum eigentlichen Text anzugeben. Dies ist allerdings nur dann möglich, wenn das Inserat direkt bei karriere.at angelegt wird. Viele, vor allem größere Firmen, haben ihre eigenen Karriere-Portale oder einfach Inserate auf ihren Webseiten veröffentlicht. Diese Stellenangebote sollen aber auch auf den Plattformen von karriere.at gefunden werden. Daher ist es notwendig, auch nur aus reinem Text möglichst viel Wissen zu generieren.

Meine Masterarbeit mit dem Titel „Erkennung und Extraktion spezifischer Merkmale aus Stellenangeboten bei karriere.at“ behandelt genau dieses Thema und zeigt verschiedene Wege um möglichst viele Informationen aus einem Stelleninserat herauszukitzeln.

## GATE

Der größte Teil der Arbeit beschäftigt sich mit dem Gebiet der Informationsextraktion. Grundsätzlich will man dabei immer Informationen aus „unstrukturierten Daten“ extrahieren, in unserem Fall sind dies eben die Stelleninserate. Eines der in der Arbeit untersuchten Frameworks für Informationsextraktion ist die „General Architecture for Text Engineering“, kurz GATE. 

![GATE Logo](/assets/images/master-thesis/Gate_Logo.png)

GATE ist eine Infrastruktur für die Entwicklung von Natural Language Processing-Systemen. Natural Language Processing, kurz NLP, bedeutet die Verarbeitung natürlicher Sprachen. Hierbei ist vor allem das Hinzufügen von Annotationen zu bestimmten Wörtern oder Phrasen im Text interessant. Ein Text kann so um beliebige Metainformationen erweitert werden. Beispielsweise könnten alle Namen in einem Text mit der Annotation „Person“ versehen werden, welche dann von nachfolgenden Systemen weiterverarbeitet werden können.

Die große Stärke von GATE liegt im guten Zusammenspiel der einzelnen Komponenten, so können zum Beispiel mit der grafischen Oberfläche „GATE Developer“, sehr komfortabel alle für das NLP-System benötigten Komponenten angelegt und konfiguriert werden. Weiters kann es auf die zu testenden Dokumente, also die Stelleninserate, angewendet werden. So kann schnell und einfach überprüft werden, ob das System wie gewünscht arbeitet. Alle benötigten Funktionen können über Plugins eingebunden werden. Diese bieten zum Beispiel Funktionen für die Datenvorverarbeitung. Arbeitet das System korrekt, kann es einfach über das Framework für die Einbindung in eigene Systeme (GATE Embedded) in den eigenen Code eingebunden und verwendet werden.

## Die Information-Extraction-IDE

![GATE Developer](/assets/images/master-thesis/GATE_Developer.png)
Die obige Abbildung zeigt den GATE Developer mit einem annotierten Stellenangebot, mit den hervorgehobenen Annotationen „Titel“, „Dienstort“, „Gehalt“ und den Informationen über die Ansprechperson. Die Annotationen werden dadurch dem Text hinzugefügt, indem die zuvor definierten Regeln abgearbeitet werden. Definiert werden diese Regeln mit der „Java Annotation Patterns Engine“, kurz JAPE, einer in GATE integrierten Abwandlung der „Common Pattern Specification Language“, kurz CPSL. Diese Regeln stellen den Kern des Informationsextraktions-Systems dar. 

## JAPE

Die Grammatik einer JAPE-Datei besteht aus mehreren Phasen, welche wiederum aus einer Menge aus Mustern und Aktionen besteht. Die Phasen werden sequentiell abgearbeitet. Jede Regel besteht aus einer linken und einer rechten Seite. Die linke Seite, die „Left-Hand-Side“, kurz LHS, beinhaltet die Muster, welche die Annotationen im Text festlegen. In der „Right-Hand-Side“, kurz RHS, können die auf der LHS gefundenen Textstellen manipuliert werden, also vor allem Annotationen zum Text hinzugefügt werden. In der RHS kann auch regulärer Java Code verwendet werden, um weitere Berechnungen durchzuführen. Es könnten zum Beispiel die Anzahl der Konsonanten der gefundenen Phrase gezählt und der Annotation angefügt werden.

![JAPE Rules](/assets/images/master-thesis/Jape.png)

Die Abbildung zeigt den Aufbau einer JAPE-Datei mit einer Regel namens „TestRule“. Diese findet Stellen im Text, welche das Wort „Test“, gefolgt von beliebigen Zeichen und optional anschließend das Wort „Regel“, beinhalten. Dieses sehr simple Beispiel könnte man natürlich auch mit einem einfachen regulären Ausdruck bewerkstelligen, hier schießt man mit GATE-Kanonen auf Spatzen, aber diese Regeln werden schnell sehr komplex.

Die verschiedenen JAPE Regeln können mit Makros strukturiert werden und als Ganzes verkettet werden. So können Annotationen, welche in einer Phase gefunden wurden, für eine darauffolgende Phase als Input dienen. Ein Beispiel hierfür ist die Definition von Trigger-Wörtern, die auf bestimmte Merkmale hinweisen. So kann relativ sicher davon ausgegangen werden, dass hinter der Phrase „für unseren Standort in“ (dem Trigger) ein Ort steht. Durch den Plugin-Mechanismus von GATE können diverse NLP-Methoden in den JAPE-Regeln verwendet werden. So kann man sich zum Beispiel an den POS-Tags (Part of Speech) bedienen. Es kann also festgelegt werden, dass das zu untersuchende Wort zum Beispiel nur ein Nomen sein und nicht klein geschrieben werden darf.

## Neugierig?

Über das Thema Informationsextraktion bei karriere.at gäbe es jetzt noch genug zu erzählen, aber das würde den Rahmen dieses Dev-Blog-Artikels sprengen. Wenn dich dieses Thema auch so interessiert und du auch gerne mithacken möchtest, schau einfach einmal bei [unseren Jobs](https://www.karriere.at/f/karriere-at/jobs) rein!
