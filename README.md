crypto
======

Simple PHP library letting you check if a field has been altered after form submit

===
### How-to-use

In a form:
```php
<?php 
    $value = 24;
    $salt_key = 2; // can be everything in your array of salt keys
?>

<input type="hidden" name="clear_value" value="<?php echo $value ?>" />
<input type="hidden" name="encrypted_value" value="<?php echo Crypto::encrypt($value, $salt_key) ?>" />
```

In your controller (for example):
```php
<?php
    if(Crypto::checkIntegrity($_POST['clear_value'], $_POST['encrypted_value'], 2)) {
        // everything's ok
    } else {
        // someone cheated the DOM
    }
?>
```
