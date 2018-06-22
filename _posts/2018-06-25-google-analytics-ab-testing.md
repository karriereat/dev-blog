---
layout: post
title: "A/B Testing using Google Analytics"
date: 2018-06-25
author: manu
tags: [analytics, process, performance, testing, tooling]
lang: en
---

A/B testing allows you to continually improve your product's user experience or various sales/marketing KPIs, as long as your goals are well-defined and you have a clear hypothesis. This article does not tell you why you should do A/B testing, but focuses on how to implement tracking its results using JavaScript and Google Analytics.

![](/assets/images/google-analytics-ab-testing/analytics-chart-data-cliché-stock-photo.jpg) 

The article is written for developers, marketing and product managers. If you are not a developer, feel free to skip the coding part and only read the first and third sections!

## 1. Test Definition

First you should define your A and B (even C?) versions and your conversion goal. 

The example A/B test we'll do in this example has a `Version A` and a `Version B`, with no difference other than their names, and we want visitors to click on the `Call to action` button. 

![](/assets/images/google-analytics-ab-testing/versions.png) 

To evaluate the test we therefore have to track three events:
1. A visitor viewing version A
2. A visitor viewing version B
3. A visitor clicking the `Call to action` button.

The conversion event (3) is a basic Google Analytics [Event](https://support.google.com/analytics/answer/1033068), made up of a __category__, __action__ and optional __label__ component. Their values depend on how you want to manage your events in Google Analytics and are entirely up to you. 

In the example A/B test each component has a value of the same name:

Component | Value
- | - 
Category | `Category`
Action | `Action`
Label | `Label` 

You can send also events for the visitor viewing version A (1) or B (2). We did so for [karriere.at](https://www.karriere.at/) in the past, and it looked like this:

Component | Value
- | - 
Category | `ab-test`
Action | `test-name`
Label | `version-a`

Component | Value
- | - 
Category | `ab-test`
Action | `test-name`
Label | `version-b`

This solution works reliably, however in this article I want to propose another approach: __virtual pageviews__. A virtual pageview is like a real pageview, but the URL is made up, hence virtual. 

In the example A/B test the pageview URLs are as follows:

Page | URL (Path)
- | - 
Page containing A/B test | `/google-analytics-ab-testing`
Version A | `/virtual/A`
Version B | `/virtual/B`

This means that for each request two pageviews are send to Google Analytics: the original pageview of `/google-analytics-ab-testing` and, depending on the version that is served to the user, either `/virtual/A` or `/virtual/B`. 

Why virtual pageviews? I feel it makes talking about the A/B test easier, as you would normally use phrases like 

> How many visitors viewed the red landing page?
 
as opposed to:
 
> How many events in the 'A/B test' category with a 'summer campaign' action and the 'red landing page' label have been tracked?

<small>
Beware, that the virtual pageviews are collected additionally to the normal pageview, so your visits will get "inflated". For this and many other reasons you should create a new view for all of your A/B tests and add a [filter](https://support.google.com/analytics/answer/1033162?hl=en) to exclude virtual pageviews (`/virtual/A`) in your original view.
</small> 

## 2. JavaScript Implementation

The test definition gets handed over to the developer, who sets up the code and sends the data to Google Analytics.

The code for the example A/B test is available on [GitHub](https://github.com/karriereat/google-analytics-ab-testing) and can be adapted to your needs. The tracking implementation has four tasks:

* Deliver version A to 50% of clients, and version B to the other 50% of clients
* Deliver the same version to a client on each subsequent page load
* Send virtual pageviews, tracking the version a client has received
* Sending conversion events when clicking the `Call to action` button

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
