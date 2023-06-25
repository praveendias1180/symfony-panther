<?php
require 'vendor/autoload.php';

use \Symfony\Component\Panther\Client;

$client = Client::createChromeClient();
$url = 'https://www.ubereats.com/lk/store/quesada-burritos-%26-tacos-canada-place/g4Zy4mthU_ifEsUClGIWSA?diningMode=DELIVERY';

$crawler = $client->request('GET', $url);

$button = $crawler->filter('[data-testid="close-button"]')->first();
$button->click();

$screenshot = $client->takeScreenshot();

$screenshotFile = 'screenshot.png';
file_put_contents($screenshotFile, $screenshot);

echo "Screenshot captured and saved to '$screenshotFile'." . PHP_EOL;

$client->quit();
