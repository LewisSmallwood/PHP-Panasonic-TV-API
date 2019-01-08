<?php
/**
 * Networking functions.
 * User: LewisSmallwood
 * Date: 07/01/2019
 * Time: 23:33
 */

class Networking
{
    public static function WakeOnLAN($macAddress, $broadcast = "255.255.255.255") {
        $mac_array = explode(':', $macAddress);

        $hwaddr = '';
        foreach($mac_array as $octet)  {
            $hwaddr .= chr(hexdec($octet));
        }

        // Create a magic packet
        $packet = '';
        for ($i = 1; $i <= 6; $i++) {
            $packet .= chr(255);
        }

        for ($i = 1; $i <= 16; $i++) {
            $packet .= $hwaddr;
        }

        $sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);

        if ($sock)  {
            $options = socket_set_option($sock, SOL_SOCKET, SO_BROADCAST, true);

            if ($options >= 0) {
                $e = socket_sendto($sock, $packet, strlen($packet), 0, $broadcast, 7);
                socket_close($sock);
            }
        }
    }
}