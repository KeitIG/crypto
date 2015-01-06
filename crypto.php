<?php

class Crypto {

    const MCRYPT_ENCRYPTION = MCRYPT_RIJNDAEL_256;
    const MCRYPT_MODE       = MCRYPT_MODE_CBC;
    const ENCRYPTION_KEY    = '98F4432B1A616C443E79BBCC9EB9E'; // Your encryption key, keep it secret

    private static $SALT_KEYS = ['HNsA+QGx-L@gg4EXsF2O%[)lDQ7iER@rhac_e{_*1^$NgL)&&]>pi)zz$z_)@*oD',
                                 'kYp[cjAiq*>^kK:<PWNDPvj@mHzaf]N._p)D7Wd|+MD<LN]AjABK%^e61.S]4fCr',
                                 'e]87E^+nL1[f?/HD!w$aT<k>NW?-d2s>=<&(OHV}rUN0rRd~-fe>+u~hX3BG1 |+']; // can be empty

    /**
     * Encrypt a string
     *
     * @param $string   string
     * @param $salt_key int (optional)
     *
     * @return string
     */
    public static function encrypt($string, $salt_key = 0) {

        $salt = isset(self::$SALT_KEYS[$salt_key]) ? $SALT_KEYS[$salt_key] : '';

        return base64_encode(sha1(mcrypt_encrypt(
                                    self::MCRYPT_ENCRYPTION,
                                    md5(self::ENCRYPTION_KEY.$salt),
                                    $string,
                                    self::MCRYPT_MODE,
                                    md5(md5(self::ENCRYPTION_KEY)))));
    }


    /**
     * Compare a crypted and an not-crypted string
     *
     * @param $string   string
     * @param $hash     string
     * @param $salt_key int (optional)
     *
     * @return boolean
     */
    public static function checkIntegrity($string, $hash, $salt_key = 0) {

        return $hash == self::encrypt($string, $salt_key);
    }
}
