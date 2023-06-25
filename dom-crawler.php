<?php

/**
 * Symfony DOM Crawler
 * 
 * https://symfony.com/doc/current/components/dom_crawler.html
 */
require 'vendor/autoload.php';

use Symfony\Component\DomCrawler\Crawler;

$html = <<<'HTML'
<!DOCTYPE html>
<html>
    <body>
        <p class="message">Hello World!</p>
        <p>Hello Crawler!
            <span>Test P</span>
        </p>
    </body>
</html>
HTML;

$crawler = new Crawler($html);
$crawler = $crawler->filterXPath('descendant-or-self::body/p');
$list = $crawler->filterXPath('//body//p/span');
foreach ($list as $domElement) {
    var_dump($domElement->nodeName);
    var_dump($domElement->textContent);
}

$message = $crawler->filterXPath('//body//p')->text();
echo $message . PHP_EOL;

$class = $crawler->filterXPath('//body/div/p')->attr('class');
echo $class . PHP_EOL;

$attributes = $crawler
    ->filterXpath('//body/p')
    ->extract(['_name', '_text', 'class']);

var_dump($attributes);
