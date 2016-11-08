---
layout: post
title: "Laravel Task Scheduling mit Docker"
date: 2016-11-08 17:40:07
author: jakob
tags: [laravel, php, docker]
excerpt: Task Scheduling für Laravel in einem Docker-Container einrichten, wie kann diese Aufgabe möglichst einfach umgesetzt werden?
---

![](/assets/images/laravel-task-scheduling-docker/laravel_cron_docker.jpg)

Für eines unserer internen Projekte verwenden wir Laravel, basierend auf folgendem Docker Setup:

* nginx
* PHP 7
* MySQL 5.7
* Redis

Dieses Projekt beinhaltet einige Laravel-Commands, welche regelmäßig aufgerufen werden müssen. Laravel bietet dafür eine komfortable Scheduling-Lösung.
Um den [Task Scheduler in Laravel](https://laravel.com/docs/5.3/scheduling) zu aktivieren, muss ein Cron-Job eingerichtet werden.

## Wie richte ich einen Cron-Job in einem Docker-Setup ein?

Ein Cron-Job in einer Docker-Umgebung kann auf viele Arten eingerichtet werden, dazu zählen:

* __Ein eigener Cron-Container.__ ❎
Dieser eignet sich besonders dann, wenn viele Cron-Jobs für viele verschiedenen Container benötigt werden.
Da unser Setup aber nur einen Cron-Job für das Laravel Task Scheduling benötigt, fällt diese Option weg.
* __Ein Cron-Job auf dem Host-System.__ ❎
Bei dieser Option wird der Cron-Job einmalig am Host-System eingerichtet, ist also nicht Teil des Container-Setups.
Da wir Docker-Compose verwenden und das Setup mit einem einfachen `docker-compose up -d --build` starten wollen, fällt diese Option ebenfalls weg.
* __Ein Cron-Job im Container.__ ✅
Diese Option eignet sich am Besten, da für Laravel nur ein Cron-Job benötigt wird, welcher regelmäßig den Laravel Task Scheduler aufruft.
Der Cron-Job kann also im PHP-Container selbst eingerichtet werden.

## Cron in einem PHP Container aktivieren

Für PHP verwenden wir das offizielle `php:7.0-fpm` image von [Docker Hub](https://hub.docker.com/_/php/), welches auf Debian basiert.

Um darin einen Cron-Job starten zu können, müssen wir zuerst das `cron`-Paket installieren:

```
RUN apt-get install cron -y
```

Als nächstes muss der Cron-Job selbst angelegt werden. In unserem Fall wird der Cron-Job `laravel-scheduler` heißen:

```
* * * * * root /usr/local/bin/php /var/www/html/artisan schedule:run >> /dev/null 2>&1
```

Da wir uns auf einem Debian-System befinden, müssen wir den User angeben. In unserem Fall ist das der Standard-User `root`.


Als nächstes muss der Cron-Job in den Container kopiert werden:

```
COPY laravel-scheduler /etc/cron.d/
RUN chmod 0644 /etc/cron.d/laravel-scheduler
```
Das Verzeichnis `/etc/cron.d/` eignet sich am Besten, da in Debian dieses Verzeichnis automatisch von `cron` durchsucht wird.
Der `chmod`-Command sorgt dafür, dass der Cron-Job die richtigen Rechte bekommt und von `cron` ausgeführt wird.

## Cron ausführen

Nun muss nur noch dafür gesorgt werden, dass der `cron`-Dienst beim Starten des Containers ausgeführt wird.

Dazu könnte im `Dockerfile` einfach die Zeile `CMD ["cron"]` hinzugefügt werden. Das würde aber den Befehl `CMD ["php-fpm"]` vom PHP-Container überschreiben und dazu führen, dass unsere PHP-Container nicht mehr funktioniert.

Es gibt zwei Möglichkeiten, dieses Problem zu umgehen:

* __Supervisor einsetzen.__
Mit [Supervisor](http://supervisord.org/) lassen sich Prozesse kontrollieren und steuern.
* __Ein eigenes Start-Script verwenden.__
Mit einem eigenen Script können beliebige Befehle ausgefürt werden.

Unsere Entscheidung ist auf das Start-Script gefallen, da es keine Supervisor-Wissen vorraussetzt und für unsere Ansprüche ausreichend ist.

Das Start-Script `start.sh`:

```
#!/bin/bash

# Start cron.
cron

# Call the original container command.
php-fpm
```

Dieses Script muss anschließend in den Container kopiert werden.

Das fertige Dockerfile sieht folgendermaßen aus:

```
FROM php:7.0-fpm

# Install cron.
RUN apt-get update && apt-get install cron -y

# Set up the scheduler for Laravel.
COPY laravel-scheduler /etc/cron.d/
RUN chmod 0644 /etc/cron.d/laravel-scheduler

# Copy the start script.
COPY start.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/start.sh

# Start php-fpm and cron.
CMD ["start.sh"]
```

## Fazit

Um Cron-Jobs in Docker-Containern laufen zu lassen, muss `cron` im Container installiert und ausgeführt werden.

Dazu muss das `Dockerfile` des jeweiligen Containers angepasst werden. Ein eigenes Start-Script startet den Cron-Dienst und ruft danach den ursprünglichen Befehl des Docker-Images auf.
