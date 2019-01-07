<?php
require_once 'PanasonicTV/Controller.php';
require_once 'PanasonicTV/Keys.php';

const TV_IP_ADDRESS = "192.168.0.161";

$controller = new Controller(TV_IP_ADDRESS);

header("Content-Type: application/json;");

$volume = $controller->getVolume();
$isMuted = $controller->getIsMuted();
$isPowerOn = $controller->getIsPowerOn();

$output = array(
    "isPowerOn" => $isPowerOn,
    "volume" => $volume,
    "muted" => $isMuted
);

echo(json_encode($output, JSON_PRETTY_PRINT));