<?php
/**
 * The status command.
 * User: LewisSmallwood
 * Date: 08/01/2019
 * Time: 00:07
 */

require_once 'Command.php';

class StatusCommand extends Command
{
    public function execute()
    {
        $volume = $this->controller->getVolume();
        $isMuted = $this->controller->getIsMuted();
        $isPowerOn = $this->controller->getIsPowerOn();

        return array (
            "hostname" => TV_IP_ADDRESS,
            "state" => array(
                "power" => $isPowerOn,
                "volume" => $volume,
                "mute" => $isMuted
            )
        );
    }
}