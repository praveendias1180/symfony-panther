<?php
require 'vendor/autoload.php';

use \Symfony\Component\Panther\Client;

$client = Client::createChromeClient();
$client->get('https://quotes.toscrape.com/js/');

$page_no = 0;
$quote_no = 0;
while (true) {
    $crawler = $client->waitFor('.quote');

    $crawler->filter('.quote')->each(function ($node) use (&$quote_no) {
        $quote_no++;
        $author = $node->filter('.author')->text();
        $quote = $node->filter('.text')->text();
        echo $quote_no . ") " . $author . " - " . $quote . PHP_EOL;
    });

    try {
        $page_no++;
        echo '=====================================================================================' . PHP_EOL;
        echo '--- Page ' . $page_no . ' Finished ' . PHP_EOL;
        echo '=====================================================================================' . PHP_EOL;
        $client->clickLink('Next');
    } catch (Exception) {
        break;
    }
}
