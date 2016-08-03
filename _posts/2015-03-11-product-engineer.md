---
layout: post
title: "Was macht eigentlich ein Product Engineer?"
date: 2015-03-11 15:47:51
author: Wolfgang
---
Als Product Engineer bin ich Teil des Development-Teams bei karriere.at, obwohl ich selbst nur wenig programmiere. Der Großteil meiner Arbeit beinhaltet __technische Analysen und Konzepte__, deswegen muss ich Algorithmen nur so weit verstehen können, um Sinn und Zweck dahinter zu verstehen und daraus Verbesserungspotenzial erkennen zu können.
[---]
Manchmal wäre es zwar ganz gut, wenn ich die gesamte Codebase in- und auswendig kennen würde. Es kann allerdings auch von Vorteil sein, nicht ständig im Hinterkopf haben zu müssen, wie viel Refactoring notwendig ist, wenn dieses und jenes geändert werden soll. Das wird mir meistens erst dann bewusst, wenn meine DEV-Kollegen skeptische Blicke austauschen, wenn ich eine neue Idee vorstelle.

## It’s all about data
Um diese Analysen machen zu können, verbringe ich viel Zeit in der __Datenbank__ und in __Google Analytics__, denn mit mehr als 10.000 Jobinseraten und täglichen Traffic-Zahlen im sechsstelligen Bereich fallen wir ganz klar in die Kategorie "Big Data". Wir versuchen uns ständig vor Augen zu halten, was die User von karriere.at erwarten. Dementsprechend wichtig ist es zu wissen, welche Features gut angenommen werden und welche nicht. Dazu definieren wir __KPIs und Ziele__, die laufend überwacht und verbessert werden.

## Du suchst - wir finden
Der wohl wichtigste Kernbereich von karriere.at ist die Suche, wobei wir zwei verschiedene Bereiche im Einsatz haben. Einerseits gibt es natürlich die __Jobsuche__ für Bewerber. Wir stellen aber auch für Arbeitgeber eine __Bewerbersuche__ und ein __Bewerbermatching__ zur Verfügung, um das Auffinden von Kandidaten für Firmen zu vereinfachen.
[---]
An eine Suche wird ein ähnlich hoher Anspruch gestellt, wie wir es mittlerweile von Google, Amazon & Co. gewohnt sind. Diese Suchmaschinen liefern scheinbar intuitiv die perfekten Treffer, selbst für die unmöglichsten Suchbegriffe. Mittlerweile haben sich Web User daran gewöhnt, alles schnell und einfach googeln zu können. Deswegen wird erwartet, dass auch unsere Jobsuche __perfekte Ergebnisse__ liefert. Auch wenn sich die Thematik simpel anhört, steht dahinter eine ausgeklügelte Suchlogik, die viel mehr leisten muss, als es auf den ersten Blick scheint.
![](//kcdn.at/dev-blog/images/product-engineer/jobsuche.png)
## Ontologie und Semantic Search
Bei karriere.at setzen wir eine solide Ontologie in Kombination mit einer intelligenten Logik für die "Semantische Suche" ein.
[---]
In der Semantischen Suche steht die "Semantik" für die __Bedeutung__, also welche Aussage sich tatsächlich hinter einem Wort oder einem Satz verbirgt. Wird in einem Jobinserat zum Beispiel "Unterstützung für den Projektleiter" gesucht, muss erkannt werden, dass ein Assistenz-Job gemeint ist. Das Wort "Projektleiter" darf hier also nicht blind verwendet werden, ohne die Bedeutung (Semantik) zu erfassen. Dies ist nur möglich, indem die Jobinserate nicht nur nach einzelnen Wörtern durchsucht, sondern im Gesamtbild erfasst werden.
[---]
Die Basis dafür stellt die bereits genannte Ontologie dar, die man sich als großes Wörterbuch vorstellen kann, bei dem die einzelnen Wörter untereinander verknüpft sind. Diese Verknüpfungen werden verwendet, um ähnliche Begriffe zu finden, in etwa wie bei einem Thesaurus. Im Unterschied zu einem Thesaurus bietet aber eine Ontologie viel feinere Abstufungen, um verschiedene Szenarien abbilden zu können:
* Gleichwertige Begriffe finden, zB. "Arbeiter" und "Arbeiterin"
* Ähnliche Begriffe finden, zB. "Film" und "Fernsehen"
* Entfernt verwandte Begriffe erkennen, etwa um festzustellen, dass der Beruf "Bierbrauer" etwas mit den Wörtern "Getränke" und "Lebensmittel" zu tun hat.
* Ungültige Beziehungen identifizieren, um zB. "Zuckerbäcker" und "Pizzabäcker" als völlig unterschiedliche Berufe zu erkennen, obwohl sie beide zur Gastronomie zugeordnet werden können.
[---]
Meine Aufgabe ist, das Potential dieser riesigen Sammlung an Begriffen und Begriffs-Verknüpfungen voll auszuschöpfen und Verbesserungsvorschläge zu liefern. Damit wollen wir die __Qualität all unserer Services kontinuierlich erhöhen__, damit auch du bald deinen Traumjob findest!

## Matching
Auf Basis der beschriebenen Techniken haben wir kürzlich für unser neuestes Produkt, die [talent.cloud](http://www.karriere.at/hr/talent-cloud "talent.cloud"), ein Matching-System entwickelt. Die Grundlage dafür stellt die __Extraktion von Keywords aus den Jobinseraten__ dar. Dazu wird jeder auf karriere.at verfügbare Job gescannt, um zu verstehen, welche Bewerberprofile hier gesucht werden. Dies übernimmt ein Tool, das die einzelnen Textabschnitte im Jobinserat erkennen kann. Das sieht dann ungefähr so aus:

<div class="video videoNormal">
    <video controls autoplay loop>
        <source id="mp4" src="//kcdn.at/dev-blog/images/product-engineer/job-extractor-full.mp4" type="video/mp4">
        <p>Your user agent does not support the HTML5 Video element.</p>
    </video>
</div>

Die gefundenen Textblöcke werden mit allen weiteren Metadaten des Jobs sinnvoll kombiniert, etwa ob es eine Vollzeit- oder Teilzeitstelle ist, und ob Einsteiger oder eher Personen mit Senioritätslevel gesucht werden. Mit all den gesammelten Informationen werden nun passende Profile aus unserer __Bewerberdatenbank__ gesucht, wobei es je nach Berufsfeld zu verschiedenen Matching-Strategien kommen kann.

## Mein Werdegang
Nach der HTL-Matura wollte ich direkt Berufserfahrung sammeln, anstatt mein Wissen in einem Studium zu vertiefen. Also habe ich zunächst einige Jahre als Software Entwickler (Schwerpunkt auf PHP und Oracle Datenbanken) gearbeitet und bin danach in den Web-Bereich umgestiegen, zuerst als Web- bzw. CMS-Entwickler, danach als Projektleiter. Nach mehreren Jahren im Projektgeschäft wollte ich in die __Produktentwicklung__ wechseln. Die Stelle als Product Engineer bei karriere.at hat mich deswegen angesprochen, weil eine Person gesucht wurde, die einerseits ein Verständnis für Useranforderungen haben sollte und gleichzeitig den technischen Background mitbringt, um Daten und Algorithmen analysieren und auswerten zu können.
[---]
Bei karriere.at ist im DEV-Team eine gesunde Mischung vorhanden: Viele Kollegen bringen eine fundierte Ausbildung aus Uni oder FH mit, andere DEVs haben eine BHS-Matura oder eine Lehre absolviert. Man kann in unserem Recruitingprozess nicht nur mit Ausbildung, sondern auch mit sonstiger Erfahrung punkten, wie etwa mit __eigenen Website-Projekten__ oder __selbstgebastelten Apps__. Wer neue Technologien und Ideen einbringen kann, ist bei uns gut aufgehoben, da wir immer offen sind, neue Dinge auszuprobieren, um Innovationsgrad und Coolness-Faktor zu erhöhen!