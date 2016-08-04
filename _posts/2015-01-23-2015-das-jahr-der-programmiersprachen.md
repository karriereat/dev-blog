---
layout: post
title: "2015 - Das Jahr der Programmiersprachen?"
date: 2015-01-23 11:29:06
author: fichtl
---
Neues Jahr, neues Glück? In Sachen Programmiersprachen gibts 2015 allerhand Interessantes: Neue Sprachen stehen in den Startlöchern, andere haben bereits Fahrt aufgenommen und alte Bekannte werden generalüberholt. Meiner Meinung nach dürften in diesem Jahr in vielen Bereichen Änderungen stattfinden. Hier mal meine rein subjektive Einschätzung zu unterschiedlichen Sprachen <!--more-->...

## Web Frontend

Gleich mal am Anfang die unspektakuläre Nachricht: Javascript wird bleiben! Ich seh keinen Nachfolger, keiner der unzähligen Dialekte und Herausforderer scheinen sich durchzusetzen. Wie immer liegt's wohl eher an den Browserherstellern, die eher zögerlich neue Sprachen in ihre Programme integrieren. Was 2015 ansteht, ist ECMAScript 6, wo schon [viel supported wird](https://developer.mozilla.org/en-US/docs/Web/JavaScript/New_in_JavaScript/ECMAScript_6_support_in_Mozilla) aber noch wichtige Teile fehlen.

Unabhängig von Programmiersprachen ist im Frontend immer noch die Frage offen, welches Framework sich durchsetzen wird. In letzter Zeit hört man viel über [ReactJS](http://facebook.github.io/react/) von Facebook, Googles [AngularJS](https://angularjs.org/) liest man auch ab und zu. Eher Newcomer oder für Spezialbereiche sind das Websocket/node.js Framework [Meteor](https://www.meteor.com/) und das Web Components Polyfill [Polymer](https://www.polymer-project.org/). Was unterm Strich wirklich die Nase vorne haben wird, kann ich noch nicht absehen ... irgendwie fehlt da noch was.
* [ECMAScript 6 compatibility table](http://kangax.github.io/compat-table/es6/)
* [Draft ECMA-262 6th Edition](https://people.mozilla.org/~jorendorff/es6-draft.html)

### Polymer
```html
<link rel="import" href="../bower_components/polymer/polymer.html">
<link rel="import" href="../bower_components/core-ajax/core-ajax.html">

<polymer-element name="my-element" noscript>
  <template>
    <span>I'm <b>my-element</b>. This is my Shadow DOM.</span>
    <core-ajax url="http://example.com/json" auto response="{{resp}}"></core-ajax>
    <textarea value="{{resp}}"></textarea>
  </template>
</polymer-element>
```

## Web Backend

Neben den alten Bekannten PHP, Ruby, Java oder .NET gewinnt Googles Go immer mehr an Bedeutung. Viele sagen, dass die Entwicklung mit Go "a lot of fun" ist, die Sprache einfach zu lesen ist, schnell kompiliert und für die Entwicklung auf Multicore-Systemen (also alle heutzutage) optimiert ist. 2015 wird wohl auch das Jahr von Javascript am Server sein. node.js wird sich wohl durchsetzen und in die Gruppe der großen Webplattformen einreihen, falls nicht schon passiert.

### node.js (Express)

```javascript
var express = require('express')
var app = express()

app.get('/', function (req, res) {
  res.send('Hello World!')
})

var server = app.listen(3000, function () {

  var host = server.address().address
  var port = server.address().port

  console.log('Example app listening at http://%s:%s', host, port)

})
```

## Java und PHP 2015

Die Java-Entwickler haben letztes Jahr die [Version 8](https://www.java.com/de/download/faq/java8.xml) von Oracle geliefert bekommen, da wird's sicher wieder einige Zeit (Jahre?) dauern bis wieder was nachkommt ... so lange wird man wohl auch brauchen bis alle Java-Applikationen darauf umgestellt sind. Die neue Version kann jetzt Lambda-Ausdrücke, die Javascript-Engine wurde komplett neu gemacht und neue APIs für zB.: Datum/Uhrzeit, Streams und Base64. Wer eher funktionale Sprachen gut findet, aber trotzdem in der Java-Welt bleiben möchte, sollte sich mal Clojure ansehen. [Clojure](http://clojure.org/) ist eine funktionale Sprache für die JVM die von Lisp abstammt und das Hauptaugenmerk auf nebenläufige Programmierung (concurrency) legt ... der Ableger für die Erlang Platform heißt [Elixir](http://elixir-lang.org/).

### Clojure

```clojure
(def hello (fn [] "Hello world"))
-> #'user/hello
(hello)
-> "Hello world"
```

Ein spannendes Jahr wird es für die PHP Entwickler ... ich denke in den nächsten Monaten wird sich entscheiden ob der Ableger [hhvm](http://hhvm.com/) von Facebook oder die nächste PHP-Version 7 (php-ng) das Rennen machen wird. Derzeit hat hhvm einen leichten Vorsprung, immerhin laufen Facebook, [WP Engine](http://wpengine.com/2014/11/19/hhvm-project-mercury/) und seit kurzem auch [Wikipedia auf hhvm](http://hhvm.com/blog/7205/wikipedia-on-hhvm). Für hhvm hat Facebook auch noch die neue Sprache Hack veröffentlicht die eine Erweiterung zu PHP darstellt und diese um Typsicherheit ergänzt.

### Hack und HHVM

```php
<?hh
class AnnotatedClass {
  public int $x;
  private string $s;
  protected array $arr;
  public AnotherClass $ac;

  function bar(string $str, bool $b): float {
    if ($b && $str === "Hi") {
       return 3.2;
    }
    return 0.3;
  }
}
```

## Mobile Apps

Bei den Apps würde ich gerne [Swift](http://swift-lang.org/main/) von Apple hervorheben, natürlich wird Swift nicht Java (Android) ersetzen, weil ja nur auf iOS verfügbar, dort aber dürfte Swift relativ schnell Objective-C ablösen. Ich hab jetzt schon einige Artikel gelesen, in denen Entwickler sagen, dass alle neuen Projekte nur mehr in Swift angefangen werden, Objective-C ist damit bald nur mehr als Legacy-Code vorhanden. Windows-Phone dürfte auch 2015 keine Rolle spielen? Hab zumindest nichts Gegenteiliges gelesen.

### Swift

```swift
class Residence {
    var rooms = [Room]()
    var numberOfRooms: Int {
        return rooms.count
    }
    subscript(i: Int) -> Room {
        get {
            return rooms[i]
        }
        set {
            rooms[i] = newValue
        }
    }
    func printNumberOfRooms() {
        println("The number of rooms is \(numberOfRooms)")
    }
    var address: Address?
}
```

## System
Rust, Rust, Rust ... man hat das Gefühl, dass alle nur mehr davon sprechen. Angeblich der lang erwartete Nachfolger für C oder zumindest der vielversprechendste Anwärter seit Jahren. Alternativ ist noch [nim](http://nim-lang.org/) (formerly known as nimrod) zu nennen, das wohl ähnliche Ziele verfolgt aber nicht ganz so tief runter geht wie [Rust](http://www.rust-lang.org/). Es geht bei beiden um die Minimierung der ganzen Probleme bei der Multithreading-Programmierung, die Entwickler sollten sich zukünftig keine Gedanken mehr über Locking, [Race Conditions](http://de.wikipedia.org/wiki/Race_Condition) und [Data Races](http://docs.oracle.com/cd/E19205-01/820-0619/geojs/index.html) machen müssen ... das alles soll auf Compilerebene gelöst werden.

### Rust
```rust
fn main() {
    // A simple integer calculator:
    // `+` or `-` means add or subtract by 1
    // `*` or `/` means multiply or divide by 2
    let program = "+ + * - /";
    let mut accumulator = 0;
    for token in program.chars() {
        match token {
            '+' => accumulator += 1,
            '-' => accumulator -= 1,
            '*' => accumulator *= 2,
            '/' => accumulator /= 2,
            _ => { /* ignore everything else */ }
        }
    }
    println!("The program \"{}\" calculates the value {}",
              program, accumulator);
}
```

## Sonst so ...

Schön das sich immer so viel tut in unserem Bereich ... dann wird's wenigstens nicht langweilig. Wenn jemand glaubt ich hätte was wichtiges übersehen dann bitte melden ... neue Sprachen anschauen ist immer fun (Lächeln)

### Quellen:

* http://www.infoworld.com/article/2866057/java/javascript-surges-past-swift-r-for-programming-language-of-the-year-honors.html
* http://www.tiobe.com/index.php/content/paperinfo/tpci/index.html
* http://www.freshersjobupdates.in/2014/06/top-10-programming-languages-that-are.html
* https://news.ycombinator.com/item?id=8803678
* http://tutorialzine.com/2014/12/the-languages-and-frameworks-that-you-should-learn-in-2015/
* https://medium.com/@shijuvar/web-development-trends-for-2015-and-beyond-c2d3c1ef5718
* http://redmonk.com/sogrady/2015/01/14/language-rankings-1-15/
