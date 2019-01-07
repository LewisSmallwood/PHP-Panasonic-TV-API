# PHP Panasonic TV JSON API
An JSON API for interacting with a Panasonic Viera Smart TV (Internet SOAP Remote)


The IP address of the TV is required within the constant `TV_IP_ADDRESS`.

Currently opening index.php in the browser returns the following JSON:

```
{
    "isPowerOn": true,
    "volume": 50,
    "muted": false
}
```

The API defaults it's values if a connection cannot be made to the TV, or the TV is off.

The default values are:
```
{
    "isPowerOn": false,
    "volume": 0,
    "muted": false
}
```
