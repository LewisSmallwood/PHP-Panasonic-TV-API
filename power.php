<?php
require_once 'PanasonicTV/Controller.php';
require_once 'PanasonicTV/Keys.php';
require_once 'PanasonicTV/Networking.php';

const TV_IP_ADDRESS = "192.168.0.161";
const TV_MAC_ADDRESS = "80:c7:55:38:3d:73";

Networking::WakeOnLAN(TV_MAC_ADDRESS);