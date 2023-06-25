<?php
require 'vendor/autoload.php';

use \Symfony\Component\Panther\Client;
use \Facebook\WebDriver\WebDriverDimension;

$client = Client::createChromeClient();
$url = 'https://www.ubereats.com/lk/store/quesada-burritos-%26-tacos-canada-place/g4Zy4mthU_ifEsUClGIWSA?diningMode=DELIVERY';

$crawler = $client->request('GET', $url);

$button = $crawler->filter('[data-testid="close-button"]')->first();
$button->click();

$width = 1024;
$size = new WebDriverDimension($width, $width * 12);
$client->manage()->window()->setSize($size);

$screenshot = $client->takeScreenshot();

$id = '11';

// get the rendered screenshot
$screenshotFile = 'screenshot_' . $id . '.png';
file_put_contents($screenshotFile, $screenshot);

// Get the rendered HTML
$renderedHtml = $crawler->html();
$filename = 'rendered_html_' . $id . '.html';
file_put_contents($filename, $renderedHtml);

$client->quit();
