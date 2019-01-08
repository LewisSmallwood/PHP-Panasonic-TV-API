<?php
/**
 * The power command.
 * User: LewisSmallwood
 * Date: 08/01/2019
 * Time: 00:07
 */

require_once 'Command.php';

class PowerCommand extends Command
{
    public function execute()
    {
        Networking::WakeOnLAN(TV_MAC_ADDRESS);

        $isPowerOn = $this->controller->getIsPowerOn();

        return array (
            "hostname" => TV_IP_ADDRESS,
            "power" => $isPowerOn
        );
    }
}