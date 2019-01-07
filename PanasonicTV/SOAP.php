<?php
/**
 * An XML SOAP Request handler
 * User: LewisSmallwood
 * Date: 07/01/2019
 * Time: 01:42
 */

class SOAP
{

    public static function request($ipAddress, $endpoint, $resource, $command, $option = array())
    {
        $url = "http://".$ipAddress.":55000/".$endpoint;

        $request = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n".
        "<s:Envelope xmlns:s=\"http://schemas.xmlsoap.org/soap/envelope/\" s:encodingStyle=\"http://schemas.xmlsoap.org/soap/encoding/\">\n".
        " <s:Body>\n".
        "  <u:".$command." xmlns:u=\"urn:".$resource."\">\n".
        "  ".$option['args']."\n".
        "  </u:".$command.">\n".
        " </s:Body>\n".
        "</s:Envelope>";

        $headers = array('SOAPACTION: "urn:'.$resource.'#'.$command.'"');

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $request);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($curl);

        if (isset($option['returnXml'])) {
            return $data;
        } else {
            $xml = simplexml_load_string($data);
            if ($xml === false) return false;
            $ns = $xml->getNamespaces(true);
            $soap = $xml->children($ns['s']);
            $res = $soap->children($ns['u'])->children();
            return $res[0];
        }
    }
}