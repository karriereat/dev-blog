---
layout: post
title: "PHPStorm Quicktipp - Autosuggest für Klassenvariablen"
date: 2015-02-13 09:04:46
author: fichtl
---
Für Klassenvariablen von unbekannten Typ werden im PHPStorm keine Vorschläge angezeigt. Man kann das einfach über einen Type-Hint-Comment beheben ...
[---]

    Class Foobar {
        /** @var This_is_a_Classname $helper */
        protected $helper;
        public function __construct() {
            $this->helper-> <= autosuggest works here
        }
    }

... der Comment wird vorgeschlagen wenn man über der Zeile /**[SPACE] eingibt.

![](//kcdn.at/dev-blog/images/phpstorm-autosuggest-klassenvariablen/autosuggest.gif)