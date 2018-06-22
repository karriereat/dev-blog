---
layout: post
title: "A/B Testing using Google Analytics"
date: 2018-06-25
author: manu
tags: [analytics, process, performance, testing, tooling]
lang: en
---

A/B testing allows you to continually improve your product's user experience or various sales/marketing KPI's, as long as your goals are well-defined and you have a clear hypothesis. This article does not tell you why you should do A/B testing, but focuses on how to implement tracking its results using JavaScript and Google Analytics.

The article is written for developers, marketing and product managers. If you are not a developer, feel free to skip the coding part and only read the first and third sections!

## 1. Test Definition

Define your segments and conversion goal

![](/assets/images/google-analytics-ab-testing/versions.png) 

## 2. JavaScript Implementation

Setting up your code and sending data to Google Analytics


Minimal A/B testing example on [GitHub](https://github.com/karriereat/google-analytics-ab-testing),

* delivering the same version to a client on each page load,
* sending virtual pageviews, tracking the version a client has received,
* and sending conversion events.

```html
<script>
    // ...
    ga('create', 'UA-XXXXX-Y', 'auto');
    ga('send', 'pageview');
</script>
<script async src='https://www.google-analytics.com/analytics.js'></script>
```

```js
function getVersion() {
    return localStorage.getItem('version') || (Math.random() >= 0.5 ? 'A' : 'B');
}
function setVersion(value) {
    localStorage.setItem('version', value);
}
```

```js
function sendVirtualPageview(version) {
    ga('send', {
        hitType: 'pageview',
        page: `/virtual/${version}`
    });
    // ga('send', 'pageview',`/${this.version}`)
}
```

```js
function sendConversionEvent() {
    ga('send', {
        hitType: 'event',
        eventCategory: 'Category',
        eventAction: 'Action',
        eventLabel: 'Label'
    });
    // ga('send', 'event', 'Category', 'Action', 'Label');
}
```

![](/assets/images/google-analytics-ab-testing/network-tab-pageview-request.png) 
![](/assets/images/google-analytics-ab-testing/network-tab-virtual-pageview-request.png) 
![](/assets/images/google-analytics-ab-testing/network-tab-event-request.png) 

## 3. Google Analytics Report

Setting up Google Analytics

![](/assets/images/google-analytics-ab-testing/report-virtual-pageviews.png) 
![](/assets/images/google-analytics-ab-testing/report-events.png) 

![](/assets/images/google-analytics-ab-testing/goal-creation-step-1.png)
![](/assets/images/google-analytics-ab-testing/goal-creation-step-2.png)


![](/assets/images/google-analytics-ab-testing/report.png)
