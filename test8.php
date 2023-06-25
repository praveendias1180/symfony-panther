<?php
require 'vendor/autoload.php';

use \Symfony\Component\Panther\Client;
use \Facebook\WebDriver\WebDriverDimension;
use Symfony\Component\DomCrawler\Crawler;

$id = '5';
$filename = 'rendered_html_' . $id . '.html';

$url_1 = 'https://www.ubereats.com/ca/store/pizza-pizza-4461-lougheed-hwy/XVrk-n9kRPyvfHhdp5vRXg';
$url_2 = 'https://www.ubereats.com/ca/store/subway-mainland/XFbbPH7STyiKqHG7_Qi1fQ';
$url_3 = 'https://www.ubereats.com/ca/store/momos-corner/oVLLxmmqXvOn2Ho-orQ0Ig';
$url_4 = 'https://www.ubereats.com/ca/store/quickstop/nghQcOtoVYakz7eHyloKQQ';
$url_5 = 'https://www.ubereats.com/ca/store/veras-burger-shack-davie/3f4HjH5XSkuFZtPyHfS2mg';

$url = ${'url_' . $id};

$fetch = true;
$process = true;

if ($fetch) {
    $client = Client::createChromeClient();

    $crawler = $client->request('GET', $url);

    $button = $crawler->filter('[data-testid="close-button"]')->first();
    $button->click();

    $width = 1024;
    $size = new WebDriverDimension($width, $width * 12);
    $client->manage()->window()->setSize($size);

    $screenshot = $client->takeScreenshot();

    // get the rendered screenshot
    $screenshotFile = 'screenshot_' . $id . '.png';
    file_put_contents($screenshotFile, $screenshot);

    // Get the rendered HTML
    $renderedHtml = $crawler->html();
    file_put_contents($filename, $renderedHtml);
}

if ($process) {
    $html = file_get_contents($filename);

    $crawler = new Crawler($html);

    $output = '';

    $crawler->filterXPath('//main/div[5]/div/div[4]/ul/li')->each(function ($node) use (&$output) {

        $category = $node->filterXPath('//h3')->text();
        $output .= 'Category: ' . $category . PHP_EOL;

        $node->filterXPath('//ul/li')->each(function ($n2) use (&$output) {
            $name = $n2->filterXPath('//div/div/span[1]')->first()->text();
            $price = $n2->filterXPath('//div/div/span[1]')->last()->text();
            $output .= 'Name: ' . $name;
            $output .= ' | Price: ' . $price . PHP_EOL;
        });

        $output .= PHP_EOL . PHP_EOL;
    });

    echo $output;
    file_put_contents('output_' . $id . '.txt', $output);
}
