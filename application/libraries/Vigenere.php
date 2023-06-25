<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vigenere
{
    private $key;

    public function setKey($key)
    {
        $this->key = $key;
    }

    private function generateKey($length)
    {
        $key = '';
        $keyLength = strlen($this->key);

        for ($i = 0; $i < $length; $i++) {
            $key .= $this->key[$i % $keyLength];
        }

        return $key;
    }

    public function encrypt($text)
    {
        $textLength = strlen($text);
        $key = $this->generateKey($textLength);
        $cipher = '';

        for ($i = 0; $i < $textLength; $i++) {
            $cipher .= chr((ord($text[$i]) + ord($key[$i])) % 256);
        }

        return base64_encode($cipher);
    }

    public function decrypt($cipher)
    {
        $cipher = base64_decode($cipher);
        $cipherLength = strlen($cipher);
        $key = $this->generateKey($cipherLength);
        $text = '';

        for ($i = 0; $i < $cipherLength; $i++) {
            $text .= chr((ord($cipher[$i]) - ord($key[$i]) + 256) % 256);
        }

        return $this->cleanText($text);
    }

    private function cleanText($text) {
        $text = trim($text);
        $text = stripslashes($text);
        $text = htmlspecialchars($text);

        return $text;
    }
    
}