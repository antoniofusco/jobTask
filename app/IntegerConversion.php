<?php
namespace App;
Use App\IntegerConversionInterface;

class IntegerConversion implements IntegerConversionInterface
{
	
	 /**
     * Error codes.
     *
     * @var array
     */
    private static $error_codes = [
        101 => 'Error: Please insert a valid number.',
        102 => 'Error: 2nd parameter is required. Ex. convert(21,R).',
        103 => "Error: Invalid 2nd parameter. Use 'R' for Roman, 'W' for Words and 'O' for Ordinal numbers.",
        104 => 'Error: Only integers from 1 to 3999 are convertible into Roman.',
        105 => 'Error: Word converter accepts numbers between -'.PHP_INT_MAX.' and '.PHP_INT_MAX,
        106 => "Error: Negetive numbers can't have ordinal suffix.",
    ];
	
	    /**
     * Check provided paramaters.
     *
     * @param int    $number
     * @param string $type
     *
     * @return int
     */
    private function checkParamaters($number, $type)
    {
        if ($number === '' || !is_numeric($number)) {
            return 101;
        }
        if ($type === '') {
            return 102;
        }
        if (!in_array($type, ['w', 'o', 'n', 'r'])) {
            return 103;
        }
        if ($type == 'r' && (!is_int($number) || $number < 1 || $number > 3999)) {
            return 104;
        }
        if ($number > PHP_INT_MAX || $number < 0 - PHP_INT_MAX) {
            return 105;
        }
        if ($type == 'o' && $number < 0) {
            return 106;
        }
        return 0;
    }
	
	/**
     * Convert integer to a roman numeral.
     *
     * @param int $integer
     *
     * @return string
     */
    public function toRomanNumerals($integer)
    {
        if (($error_code = $this->checkParamaters($integer, 'r')) > 0) {
            return array("error"=>self::$error_codes[$error_code]);
        }
        $roman_number = '';
        while ($integer >= 1000) {
            $roman_number .= 'M';
            $integer -= 1000;
        }
        while ($integer >= 900) {
            $roman_number .= 'CM';
            $integer -= 900;
        }
        while ($integer >= 500) {
            $roman_number .= 'D';
            $integer -= 500;
        }
        while ($integer >= 400) {
            $roman_number .= 'CD';
            $integer -= 400;
        }
        while ($integer >= 100) {
            $roman_number .= 'C';
            $integer -= 100;
        }
        while ($integer >= 90) {
            $roman_number .= 'XC';
            $integer -= 90;
        }
        while ($integer >= 50) {
            $roman_number .= 'L';
            $integer -= 50;
        }
        while ($integer >= 40) {
            $roman_number .= 'XL';
            $integer -= 40;
        }
        while ($integer >= 10) {
            $roman_number .= 'X';
            $integer -= 10;
        }
        while ($integer >= 9) {
            $roman_number .= 'IX';
            $integer -= 9;
        }
        while ($integer >= 5) {
            $roman_number .= 'V';
            $integer -= 5;
        }
        while ($integer >= 4) {
            $roman_number .= 'IV';
            $integer -= 4;
        }
        while ($integer >= 1) {
            $roman_number .= 'I';
            $integer -= 1;
        }
        return $roman_number;
    }

	
}