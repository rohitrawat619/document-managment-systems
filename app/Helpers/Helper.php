<?php
namespace App\Helpers;
class Helper {

    public static function showCaptcha(){
        $captcha = self::generateCaptcha();
        session(['captcha_answer' => $captcha]);
    }

    public static function generateCaptcha($length = 6){
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $captcha = '';
        for ($i = 0; $i < $length; $i++) {
            $captcha .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $captcha;
    }

    public static function random_keys(){
        return bin2Hex(random_bytes(16));
    }

    public static function crypto_keys() {

        // Use session for cryptojs keys
        session([
            'salt' => self::random_keys(),
            'iv' => self::random_keys(),
            'key' => self::random_keys(),
            'keySize' => 256 / 32,
            'iterations' => 1000,
        ]);
    }

    public static function decryptPassword($password) {
        if (!empty($password)) {
            $password = base64_decode($password);
            $salt = hex2bin(session('salt'));
            $iv = hex2bin(session('iv'));
            $keySize = session('keySize');
            $iterations = session('iterations');
            $key = hash_pbkdf2('sha512', session('key'), $salt, $iterations, 256);
            return openssl_decrypt($password, 'AES-256-CBC', hex2bin($key), OPENSSL_RAW_DATA, $iv);
        }
    }
}

?>
