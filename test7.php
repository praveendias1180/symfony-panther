<?php
require 'vendor/autoload.php';

use Symfony\Component\DomCrawler\Crawler;

$html = file_get_contents('rendered_html_11.html');

$crawler = new Crawler($html);

$crawler->filterXPath('//main/div[5]/div/div[4]/ul/li')->each(function ($node) {

    $category = $node->filterXPath('//h3')->text();
    echo $category . PHP_EOL;

    $node->filterXPath('//ul/li')->each(function ($n2) {
        $name = $n2->filterXPath('//div/div/span')->text();
        $price = $n2->filterXPath('//div/div/span')->last()->text();
        echo 'Name: ' . $name;
        echo ' | Price: ' . $price . PHP_EOL;
    });

    echo PHP_EOL . PHP_EOL;
});
