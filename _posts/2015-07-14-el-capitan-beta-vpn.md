---
layout: post
title: "Mac OSX El Capitan Beta breaks ..."
date: 2015-07-14 07:56:12
author: Fichtl
---
... zum Beispiel unseren VPN Client oder auch Composer. Nachdem ein Downgrade nicht vorgesehen ist, habe ich mal den Fehler zurückverfolgt.

[---]

Zuerst ist mir aufgefallen das mein Composer verschwunden ist. Der war ursprünglich im /bin Verzeichnis aber dabei hab ich mir noch nicht viel gedacht und einfach nochmal unter /usr/local/bin installiert.

    curl -sS https://getcomposer.org/installer | php
    mv composer.phar /usr/local/bin/composer

... aber am Wochenende hat dann unser Barracuda VPN Client den Geist aufgegeben, mit der vielsagenden Fehlermeldung: "Es ist ein FEHLER aufgetreten". In der /var/log/system.log bin ich dann auf komische Fehlermeldungen gestoßen:

    System Policy: deny file-write-create /System/Library/barracudavpn

 ... klingt nach Rechteproblem ... aber selbst als Root darf man dort nicht schreiben. Ein sudo mkdir /System/Library/barracudavpn sagt nur "Operation not permitted". Grund ist eine Neuerung in Mac OSX 10.11. die System Integrity Protection oder rootless genannt wird. 

Rootless schützt wichtige Verzeichnisse vor Schreibzugriffen, unter anderem /System/Library, /usr oder /bin ... grundsätzlich ein guter Plan ... nur nicht wenn der VPN-Client noch nicht mit El Capitan kompatibel ist.

Als Quickfix kann man den System Integrity Check deaktivieren, dazu muss man beim Booten des Systems CMD+R drücken damit man in den Recovery Mode kommt. Dann oben im Menu auf Security und die Checkbox bei System Integrity Check deaktivieren.

Eine nicht besonders schöne Lösung, aber bis Barracuda seinen VPN-Client für 10.11. fit macht, wohl die einzige.

Links:
* https://www.quora.com/How-do-I-turn-off-the-rootless-in-OS-X-El-Capitan-10-11
* http://arstechnica.com/apple/2015/06/preview-os-x-el-capitans-first-beta-is-a-promising-heap-of-refinements/4/




