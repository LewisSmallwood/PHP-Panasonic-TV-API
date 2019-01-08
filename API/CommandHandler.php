<?php
/**
 * An API command handler.
 * User: LewisSmallwood
 * Date: 08/01/2019
 * Time: 00:00
 */

require_once 'PowerCommand.php';
require_once 'StatusCommand.php';

class CommandHandler
{
    public static function getCommand() {
        $command = new StatusCommand();

        if (isset($_GET['command'])) {
            switch ($_GET['command']) {
                case "power":
                    $command = new PowerCommand();
                    break;

                default:
                    break;
            }
        }

        return $command;
    }
}