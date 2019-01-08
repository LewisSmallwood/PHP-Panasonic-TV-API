<?php
    require_once 'API/CommandHandler.php';

    header("Content-Type: application/json;");

    $command = CommandHandler::getCommand();
    $response = $command->execute();

    echo(json_encode($response, JSON_PRETTY_PRINT));