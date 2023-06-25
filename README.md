# Symfony Panther

```
composer require --dev symfony/panther
```
![](panther-packages.png)

25 packages were installed started from **masterminds/html5** including **symfony/browser-kit** and **php-webdriver/webdriver**.

# Panther

![](panther.svg)

A browser testing and web scraping library for PHP and Symfony

Panther is a convenient standalone library to scrape websites and to run end-to-end tests using real browsers.

Panther is super powerful. It leverages the W3C's WebDriver protocol to drive native web browsers such as Google Chrome and Firefox.

https://github.com/symfony/panther

# Install Drivers

```
composer require --dev dbrekelmans/bdi && vendor/bin/bdi detect drivers
```

![](install-drivers.png)

# Crawling JS Rendered Pages

Note the *js* slug at the end of the url. This is a JS rendered page.

![](crawling-js.png)

# Website to CSV

![](crawl-website.png)

![](crawl-csv.png)

# Demo

https://www.youtube.com/watch?v=uTxRF5ag27A

![](demo-scraping.png)