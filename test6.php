<?php
require 'vendor/autoload.php';

use \Symfony\Component\Panther\Client;

$client = Client::createChromeClient();
$client->get('https://praveendias1180.web.app');

$crawler = $client->getCrawler();

$crawler->filterXPath('//div[@class="card-body"]/h5[@class="card-title"]')->each(function ($node) {
    $quote = $node->ancestors()->first()->filter('p')->first()->text();
    echo $quote . PHP_EOL. PHP_EOL;
});
