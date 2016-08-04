---
layout: post
title: "The Joel Test - 12 Steps to Better Code"
date: 2015-04-09 15:54:21
author: fichtl
---
Vor 15 Jahren hat Joel Spolsky die 12 Regeln für bessere Software in seinem Blog [www.joelonsoftware.com](http://www.joelonsoftware.com) veröffentlicht. Letztens hab ich die Liste in einem Jobinserat von stackoverflow entdeckt und mich gefragt, wie schaut es damit eigentlich bei karriere.at aus?

<!--more-->

1. Do you use source control? __Ja, klar__. Seit kurzem Git vorher Subversion, gibts noch Firmen die das nicht machen? Ich denke nicht.

2. Can you make a build in one step? __Ja__. Jenkins builded und deployed alle unsere Projekte mit einem Klick. Siehe auch den letzten Artikel von Alex über [Continuous Delivery](http://www.karriere.at/dev-blog/article/view/continuous-delivery-bei-karriere-at).

3. Do you make daily builds? __Nein__. Die Regel bezieht sich wohl eher auf klassische Software. Wir machen aber eine Webseite und branchen alles, diese Regel ist also für uns nicht wirklich anwendbar. Vergleichbar wäre vielleicht ein täglicher Build aller aktuellen Branches mit allen Tests (Unit, GUI) ... sowas gibts aber derzeit (noch) nicht. Wir wollen aber zukünftig stärker automatisiert testen und da wäre dann auch ein automatischer Durchlauf aller Tests inbegriffen, aber mehrmals am Tag und nicht nur einmal.

4. Do you have a bug database? __Ja__. Wir haben Jira in dem alle Support-Tickets erfasst werden.

5. Do you fix bugs before writing new code? __Ja__. Meistens schon. Es gibt natürlich immer Probleme die sehr selten auftreten oder einfach nicht wichtig sind, die werden dann als Ticket erfasst und später behoben.

6. Do you have an up-to-date schedule? __Ja__. Wir haben eine Roadmap für 12 Monate die jedes Quartal auf den neuen Stand gebracht wird. Darüber hinaus mache ich eine Release-Roadmap fürs aktuelle Quartal die alle größeren Projekte enthält und es gibt, wie in Scrum üblich, ein Backlog das die Aufgaben (Userstories) der nächsten Wochen enthält.

7. Do you have a spec? __Ja__. ... sowas in der Art. Wir haben User-Stories und darüber hinaus Wiki-Seiten wo Anforderungen und Details zur Umsetzung schon ziemlich genau festgelegt sind. Allerdings ist "Spec" wohl nicht ganz das richtige Wort weil ja User-Stories per Definition keine Spezifikation sind ... aber sie erfüllen den gleichen Zweck.

8. Do programmers have quiet working conditions? __Ja/Nein/Vielleicht__. Diese Frage bezieht sich auf das Buch Peopleware, dort wird über einige Kapitel hinweg ziemlich stark auf genau diesen Punkt eingegangen. Im Buch ist mit "quiet" nicht nur die Lautstärke der Umgebung gemeint, sondern auch ob man oft durch Kollegen oder Anrufe unterbrochen wird. Wir Entwickler sitzen alle gemeinsam in einem Büro und da kann es schnell mal laut werden. Für jeden ist das unterschiedlich schlimm, darum sollten Besprechungen eher in den Besprechungsraum verlegt werden, ausserdem gibts schallschluckende Deckenelemente. Jeder hat ein Telefon ... läuten tuen die wenig (ausser meins Lächeln :)) weil wir viel über Skype kommunizieren.

9. Do you use the best tools money can buy? __Ja__. Hochwertige MacBooks oder UltraBooks, zusätzliche Monitore, IDEs nach Wunsch (derzeit wird oft PHPStorm verwendet) und diverse Tools von Atlassian (JIRA, Fisheye, Confluence) und GitLab. Sicher auch eine Auslegungssache ... der Preis einer Soft- oder Hardware sagt nicht immer was über Qualität und Nutzen aus.

10. Do you have testers? __Nein__. Aber wir würden einen suchen. Dieser Punkt wird also hoffentlich bald ein Ja. Hier das Inserat: [Support Engineer / Software Tester](http://www.karriere.at/jobs/4316380)

11. Do new candidates write code during their interview? __Nein__. Überlegenswert ... eigentlich.

12. Do you do hallway usability testing? __Ja__. Kann immer wieder mal sein das jemand aus dem PM/UX kommt und dir ein Design/Mockup zeigt und Feedback braucht oder man für einen kurzen Usability-Test herhalten muss.

Joel Test Score: 8,5 / 12 (3 in Arbeit)

