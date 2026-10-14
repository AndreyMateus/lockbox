<?php

namespace Core\Utils;

class Encrypt
{
    public static function getSimetricKey(string | null $key = 'SIMETRICKEY', ?string $pathOfFileKey = '/.env', bool $returnBase64 = true): string
    {
        $configFileArr = parse_ini_file(convert_separator_of_path(base_path($pathOfFileKey)));

        $simetricKey = $configFileArr[$key];

        return $returnBase64 ? base64_decode($simetricKey) : $simetricKey;
    }

    /**
     * Generate a IV/NONCE for a KEY, and return the IV base64 encoded 
     * @paaram bool $returnBase64 TRUE | FALSE
     * @param string $algo
     * @return string
     */
    public static function generateIV(bool $returnBase64 = true, string $algo = "AES-256-CBC"): string
    {
        $lenghtIV = openssl_cipher_iv_length($algo);

        $iv = random_bytes($lenghtIV);

        return $returnBase64 ? base64_encode($iv) : $iv;
    }


    /**
     * Encrypt the text and return base64 text encoded 
     * @param string $text
     * @return string BASE64 need decode
     */
    public static function encrypt(string $text, mixed $key, mixed $iv, string $algo = "AES-256-CBC", bool $returnBase64 = true): string
    {
        $returnBase64 = $returnBase64 ? 0 : 1;

        $textEncryptedEncodedBase64 = openssl_encrypt(
            $text,
            $algo,
            $key,
            $returnBase64,
            $iv
        );

        return $textEncryptedEncodedBase64;
    }

    /**
     * Dencrypt the text and return text decoded 
     * @param string $text
     * @return string BASE64 need decode
     */
    public static function decrypt(string $text, mixed $key, mixed $iv, ?string $algo  = 'AES-256-CBC'): string
    {
        $textDencryptedEncodedBase64  = openssl_decrypt(
            $text,
            $algo,
            $key,
            0,
            $iv
        );

        return $textDencryptedEncodedBase64;
    }
}
