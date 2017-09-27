<?php
/**
 * Created by JetBrains PhpStorm.
 * User: USER
 * Date: 9/15/12
 * Time: 9:49 PM
 * To change this template use File | Settings | File Templates.
 */
if ( ! function_exists('SEOHTML')){
    function SEOHTML($name='') {
		$name = cleanUnicode($name);
        $name = str_replace("[^a-z,A-Z,0-9", "-", $name);
        $name = str_replace("---", "-", $name);
        $name = str_replace("--", "-", $name);
        return strtolower($name.".html");
    }
}

if ( ! function_exists('SEO')){
    function SEO($name='') {
		$name = cleanUnicode($name);
        $name = str_replace("[^a-z,A-Z,0-9", "-", $name);
        $name = str_replace("---", "-", $name);
        $name = str_replace("--", "-", $name);
        return strtolower($name);
    }
}

function cleanUrl($str) {
    $clean = str_replace("/[^a-zA-Z0-9\/_|+ -().]/", '', $str);
    $clean = strtolower(trim($clean, '-'));
    $clean = str_replace("/[\/_|+ -]+/().", '-', $clean);
    $clean = strtolower(trim($clean, '-'));
    return $clean;
}
function cleanUnicode($str)
{
    $accents_arr=array(
        "à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă",
        "ằ","ắ","ặ","ẳ","ẵ","è","é","ẹ","ẻ","ẽ","ê","ề",
        "ế","ệ","ể","ễ",
        "ì","í","ị","ỉ","ĩ",
        "ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ",
        "ờ","ớ","ợ","ở","ỡ",
        "ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ",
        "ỳ","ý","ỵ","ỷ","ỹ",
        "đ",
        "À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă",
        "Ằ","Ắ","Ặ","Ẳ","Ẵ",
        "È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ",
        "Ì","Í","Ị","Ỉ","Ĩ",
        "Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ",
        "Ờ","Ớ","Ợ","Ở","Ỡ",
        "Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ",
        "Ỳ","Ý","Ỵ","Ỷ","Ỹ",
        "Đ"," ","-","/","’","`","'","(",")",".",'"',',',':','.','“','”','+','_','*','?','!','$','%','&','^','#','@','”','“','–','™'
    );

    $no_accents_arr=array(
        "a","a","a","a","a","a","a","a","a","a","a",
        "a","a","a","a","a","a",
        "e","e","e","e","e","e","e","e","e","e","e",
        "i","i","i","i","i",
        "o","o","o","o","o","o","o","o","o","o","o","o",
        "o","o","o","o","o",
        "u","u","u","u","u","u","u","u","u","u","u",
        "y","y","y","y","y",
        "d",
        "A","A","A","A","A","A","A","A","A","A","A","A",
        "A","A","A","A","A",
        "E","E","E","E","E","E","E","E","E","E","E",
        "I","I","I","I","I",
        "O","O","O","O","O","O","O","O","O","O","O","O",
        "O","O","O","O","O",
        "U","U","U","U","U","U","U","U","U","U","U",
        "Y","Y","Y","Y","Y",
        "D","-","-","-","-","-","-","-","-","-","-",'-','-','-','','','','','','','','','','','','','','','','',''
    );

    $str = str_replace($accents_arr,$no_accents_arr,$str);
    $str = cleanUrl($str);
    return $str;
}
if ( ! function_exists('ramdom_string')){
    function ramdom_string($length = 4)
    {
        $sWord = '';
        $sChars = 'abcdefghjklmnprtwyzABCDEFGHJKLMNPRTWXYZ1234567890';
        for ($i = 1; $i <= $length; $i++)
        {
            $nNumber = rand(1, strlen($sChars));
            $sWord .= substr($sChars, $nNumber - 1, 1);
        }
        return $sWord;
    }
}

if ( ! function_exists('generate_password')){
    function generate_password( $length = 12, $special_chars = true, $extra_special_chars = false ) {
		$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		if ( $special_chars )
			$chars .= '!@#$%^&*()';
		if ( $extra_special_chars )
			$chars .= '-_ []{}<>~`+=,.;:/?|';
	 
		$password = '';
		for ( $i = 0; $i < $length; $i++ ) {
			$password .= substr($chars, rand(0, strlen($chars) - 1), 1);
		}
		return $password;
	}
}
if ( ! function_exists('getNow'))
{
    function getNow()
    {
        return date("d-m-Y H:i:s");
    }
}

function getIP(){
    if (!empty($_SERVER['HTTP_CLIENT_IP']))  //check ip from share internet
    {
        $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        //to check ip is pass from proxy
    {
        $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
        $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

if ( ! function_exists('last_query'))
{
    function last_query($exit=false)
    {
        $CI =& get_instance();
        echo $CI ->db->last_query();
        if($exit){
            exit();
        }
    }
}
if ( ! function_exists('CutText')){
    function CutText($text, $n=80)
    {
		$text = strip_tags($text, "<p><br>");
        // string is shorter than n, return as is
        if (strlen($text) <= $n) {
            return $text;
        }
        $text= substr($text, 0, $n);
        if ($text[$n-1] == ' ') {
            return trim($text)."...";
        }
        $x  = explode(" ", $text);
        $sz = sizeof($x);
        if ($sz <= 1)   {
            return $text."...";}
        $x[$sz-1] = '';
        return trim(implode(" ", $x))."...";
    }
}
if(!function_exists('trimPrice'))
{
    function trimPrice($price){
        $price = str_replace(" ","",$price);
        $price = str_replace(",","",$price);
        $price = str_replace(".","",$price);
        return $price;
    }
}
if(!function_exists('makedir'))
{
    function makedir($path)
    {
        if(!is_dir(BASEFOLDER.$path))
            mkdir(BASEFOLDER.$path, 0777);
        return true;
    }
}
if(!function_exists('pathUpload'))
{
    function pathUpload($name,$path)
    {
        $cleanUnicode = cleanUnicode($name);
        $url = SEO($cleanUnicode);
        $base = $path;
        if(!is_dir(BASEFOLDER.$base))
            mkdir(BASEFOLDER.$base,0777);
        $part = $base.$url.rand(0,10000);
        return $part;
    }
}
if(!function_exists('removedir'))
{
    function removedir($dir) {
        foreach(glob($dir . '/*') as $file) {
            if(is_dir($file))
                removedir($file);
            else
                unlink($file);
        }
        rmdir($dir);
    }
}
?>