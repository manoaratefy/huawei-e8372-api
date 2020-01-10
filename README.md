# Huawei E8372 API on PHP
PHP Class for interaction with Huawei E8372 (throught Hi-Link API)

## Manual installation
1. Clone this repository into your project.
2. Perform a `composer update` to load requirements.
3. Include `modem.class.php` into your project.

## Usage
Create a class instance:

```
$modem1 = new Manoaratefy\NetworkTools\Modem('192.168.8.1', 'admin', '***********');
```

Check if the modem is reacheable:

```
if (!$modem1->online()) {
    echo "The modem is not online. Check network connection.\n";
}
```

Use the class:

```
echo 'Software version: ' . $modem1->SoftwareVersion() . "\n";
```

## Class reference
Look at the project wiki.
