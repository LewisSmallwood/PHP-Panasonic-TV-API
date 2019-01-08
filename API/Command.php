<?php
/**
 * An abstract API command.
 * User: LewisSmallwood
 * Date: 08/01/2019
 * Time: 00:06
 */

require_once 'PanasonicTV/autoload.php';
require_once 'config.php';

abstract class Command
{
    protected $controller = "";

    public function __construct()
    {
        $this->controller = new Controller(TV_IP_ADDRESS);
    }

    public function execute() {
        return array("error" => "No command");
    }
}