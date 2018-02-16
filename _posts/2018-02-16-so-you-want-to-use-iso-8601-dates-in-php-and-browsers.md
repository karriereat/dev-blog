---
layout: post
title: "About the interoperability of ISO 8601 dates in PHP and browsers"
date: 2018-02-16
author: jakob
tags: [debugging, javascript, php, standards]
---

In today's modern web applications, communication between frontend (browser) and backend (PHP)
often happens via JSON APIs.   
Besides strings, integers and booleans, also dates have to be transferred between
the client and the server.



## Ways to transfer dates in JSON

There are multiple ways to transfer a date via JSON.

### Timestamp

A timestamp is a universally supported *time* format.

```json
{
  "time": 1518768684
}
```

#### Pros

* All browsers can work with it
* PHP can work with it
* Always UTC

#### Cons

* It is a **time** format. You want to have a date before 1970? Sorry, you should not use timestamps.
* Timezones. Lets say you want to save the birthday 01.01.2000 00:00 in a timestamp.
  Timestamps are UTC, so when a browser reads this timestamp in a UTC-1 timezone, you will
  end up with the birthday 31.12.1999 23:00.
  
### ISO 8601

[ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) is a standard for the representation of dates and times.

This standard can have a lot of different forms.
These formats are all valid ISO 8601 dates:

* `2018-02-16`
* `2018-02-16T07:57:14+00:00`
* `2018-W07-5`

This is how a birthday could look like in a JSON file:

```json
{
  "date": "2018-02-01T12:00:00+00:00"
}
```

The `Date` object in JavaScript is 
[specified to handle ISO 8601 dates](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Date), 
so you can simply do this:

```js
const date = new Date('2018-02-01T12:00:00+00:00');
console.log(date.getFullYear()); // 2018
```

#### Pros

* Human readable
* Actually a date format

#### Cons

* You can't rely on the correct implementation of the standard.   
  You can read more about the gotchas in the next section.


## ISO 8601 browser support

[MDN warns about parsing dates](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Date)
in browsers:

> Note: parsing of date strings with the Date constructor (and Date.parse, they are equivalent) is strongly discouraged 
  due to browser differences and inconsistencies.

Our test with the ISO 8601 format `YYYY-MM-DDThh:mm:ss±hh:mm` revealed that all major browsers will successfully parse
dates in this format.

* ✓ Google Chrome 64
* ✓ Mozilla Firefox 58
* ✓ Mozilla Firefox 52 ESR
* ✓ Safari 11
* ✓ Edge 41
* ✓ Internet Explorer 11

## A story about PHP and ISO 8601

There is one big pitfall when you create ISO 8601 dates with PHP.

Take a look at the following code sample, can you guess the output?

```php
<?php

echo date('c'); // ISO 8601 (http://php.net/manual/en/function.date.php)
echo date(DateTime::ISO8601);
echo date(DateTime::ATOM);
```

<details>
  <summary>Solution</summary>
  <div class="highlight">
    <pre class="highlight">
2018-02-01T12:29:54+00:00
2018-02-01T12:29:54+0000
2018-02-01T12:29:54+00:00</pre>
  </div>
</details>

### Are you kidding me?

No, PHP returns a different ISO 8601 format (both valid according to standard) depending on whether you are using `'c'` or `DateTime::ISO8601`.

This tiny little difference has a huge impact: 

Edge and Safari fail to parse ISO8601 dates if the timezone is not separated with a `:`.

So how do libraries like [Carbon](https://github.com/briannesbitt/Carbon) (PHP) solve this problem?

Carbon uses `DateTime::ATOM` to [generate a ISO 8601 date](https://github.com/briannesbitt/Carbon/blob/1.22.1/src/Carbon/Carbon.php#L1297),
which happens to be a valid ISO 8601 date.

## Conclusion

Don't use `date(DateTime::ISO8601)` if you want all browsers to be able to parse
your ISO 8601 date. Prefer `date('c')` or use a library like [Carbon](https://github.com/briannesbitt/Carbon).
