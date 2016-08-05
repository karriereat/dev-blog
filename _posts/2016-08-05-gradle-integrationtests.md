---
layout: post
title: "Integration Testsets mit Gradle"
date: 2016-08-05 08:29:42
author: markusv
tags: [java, gradle]
---
Wir im Core Team haben unseren Fokus in letzter Zeit verstärkt auf die Tests unserer Java-Services gelegt. Eine Maßnahme die wir (endlich) erledigt haben war unsere Integrationtests von den Unittests zu trennen.

Wir verwenden Gradle als Buildtool und mussten daher in unserem build.gradle File ein eigenes SourceSet für die Integrationtests anlegen.

```groovy
// ...
apply plugin: 'java'

sourceSets {
    integrationTest {
        java {
            srcDir 'src/integrationTest/java'
        }
        resources {
            srcDir 'src/integrationTest/resources'
        }
        compileClasspath += sourceSets.test.compileClasspath
        runtimeClasspath += sourceSets.test.runtimeClasspath
    }
}

dependencies {
    // ....
}

task integrationTest(type: Test) {
    group = 'verification'
    testClassesDir = sourceSets.integrationTest.output.classesDir
    classpath = sourceSets.integrationTest.runtimeClasspath
}
```

In unserer IDE (momentan verwenden wir alle IntelliJ IDEA) konnten wir diese Verzeichnisstruktur anlegen und alle unsere Integrationtests nach `src/integrationTest/java` verschieben. Wenn ihr auch IntelliJ IDEA verwendet solltet ihr zumindest auf die [Version 2016.1](https://blog.jetbrains.com/idea/2016/03/intellij-idea-2016-1-is-here/) upgraden wenn ihr das nicht schon getan habt. Mit dieser Version ist nämlich der Support für Gradle SourceSets verbessert worden.

Das wars dann auch schon wieder. Jetzt können wir während der Entwicklung unsere Unittests so oft laufen lassen wie wir wollen ohne große Wartezeiten zu haben.

Die Integrationtests können über den `integrationTest` Task, den wir oben angelegt haben, ausgeführt werden. Die Unittests werden weiterhin über den `test` Task angestoßen. Jetzt können die Integrationtests, z.B. vom Jenkins, regelmäßig ausgeführt werden.
