<?php
/**
 * The Panasonic TV Remote Controller.
 * User: LewisSmallwood
 * Date: 07/01/2019
 * Time: 02:08
 */

require_once 'PanasonicTV/SOAP.php';

class Controller
{
    private $ipAddress;

    public function __construct($ipAddress)
    {
        $this->ipAddress = $ipAddress;
    }

    public function getIsPowerOn() {
        $endpoint = "dmr/control_0";
        $resource = "schemas-upnp-org:service:RenderingControl:1";
        $command = "GetMute";
        $options = array('args' => '<InstanceID>0</InstanceID><Channel>Master</Channel>');

        $res = SOAP::request($this->ipAddress, $endpoint, $resource, $command, $options);
        if ($res === false) {
            return false;
        } else {
            return true;
        }
    }

    public function getVolume() {
        $endpoint = "dmr/control_0";
        $resource = "schemas-upnp-org:service:RenderingControl:1";
        $command = "GetVolume";
        $options = array('args' => '<InstanceID>0</InstanceID><Channel>Master</Channel>');

        return intval(trim(SOAP::request($this->ipAddress, $endpoint, $resource, $command, $options)));
    }

    public function getIsMuted() {
        $endpoint = "dmr/control_0";
        $resource = "schemas-upnp-org:service:RenderingControl:1";
        $command = "GetMute";
        $options = array('args' => '<InstanceID>0</InstanceID><Channel>Master</Channel>');

        $res = SOAP::request($this->ipAddress, $endpoint, $resource, $command, $options);

        return ($res == "1");
    }

    public function setVolume($volume = "0") {
        $volume = intval($volume);
        if ($volume > 100 || $volume < 0) {
            throw new Exception('Volume must be between 0 and 100.');
        }

        $endpoint = "dmr/control_0";
        $resource = "schemas-upnp-org:service:RenderingControl:1";
        $command = "SetMute";
        $options = array('args' => '<InstanceID>0</InstanceID><Channel>Master</Channel><DesiredVolume>'.$volume.'</DesiredVolume>', 'returnXml' => true);

        return SOAP::request($this->ipAddress, $endpoint, $resource, $command, $options);
    }

    public function setIsMuted($isMuted = false) {
        $mute = "0";
        if ($isMuted) $mute = "1";

        $endpoint = "dmr/control_0";
        $resource = "schemas-upnp-org:service:RenderingControl:1";
        $command = "SetMute";
        $options = array('args' => '<InstanceID>0</InstanceID><Channel>Master</Channel><DesiredMute>'.$mute.'</DesiredMute>');

        return SOAP::request($this->ipAddress, $endpoint, $resource, $command, $options);
    }

    function sendKey($keyCode) {
        $endpoint = "nrc/control_0";
        $resource = "panasonic-com:service:p00NetworkControl:1";
        $command = "X_SendKey";
        $options = array('args' => '<X_KeyEvent>'.$keyCode.'</X_KeyEvent>', 'returnXml' => true);

        return SOAP::request($this->ipAddress, $endpoint, $resource, $command, $options);
    }

    function sendString($string) {
        $endpoint = "nrc/control_0";
        $resource = "panasonic-com:service:p00NetworkControl:1";
        $command = "X_SendString";
        $options = array('args' => '<X_String>'.$string.'</X_String>', 'returnXml' => true);

        return SOAP::request($this->ipAddress, $endpoint, $resource, $command, $options);
    }
}