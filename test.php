<?php
require 'vendor/autoload.php';

use \Symfony\Component\Panther\Client;

$client = Client::createChromeClient();
$client->get('https://quotes.toscrape.com/js/');
$crawler = $client->waitFor('.quote');

$crawler->filter('.quote')->each(function ($node) {
    $author = $node->filter('.author')->text();
    $quote = $node->filter('.text')->text();
    echo $author . " - " . $quote . PHP_EOL;
});
