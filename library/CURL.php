<?php 

namespace library;

class CURL
{
    public static function get($url)
    {
        $CURL = CURL_INIT($url);
        
        CURL_SETOPT($CURL, CURLOPT_SSL_VERIFYPEER, FALSE);
        
        CURL_SETOPT($CURL, CURLOPT_RETURNTRANSFER, TRUE);
        
        CURL_SETOPT($CURL, CURLOPT_HEADER, FALSE);
        
        $EXEC = CURL_EXEC($CURL);
        
        CURL_CLOSE($CURL);
        
        return $EXEC;
    }    
    
    public static function post($url, $data = [])
    {
        $CURL = CURL_INIT($url);

        CURL_SETOPT($CURL, CURLOPT_POST, 1);
        
        CURL_SETOPT($CURL, CURLOPT_POSTFIELDS, http_build_query($data));
        
        CURL_SETOPT($CURL, CURLOPT_SSL_VERIFYPEER, TRUE);
        
        CURL_SETOPT($CURL, CURLOPT_RETURNTRANSFER, TRUE);

        CURL_SETOPT($CURL, CURLOPT_HEADER, FALSE);

        CURL_SETOPT($CURL, CURLOPT_COOKIEJAR, 'cookie.txt'); 

        CURL_SETOPT($CURL, CURLOPT_COOKIEFILE, 'cookie.txt');

        $exec = CURL_EXEC($CURL);
        
        CURL_CLOSE($CURL);

        return $exec;
    }
}

/*

$CURL = new \library\CURL;

$CURL->post('http://xcode', [
    'chat_text' => ''
]);

*/

/*
dd(library\CURL::post('https://textbelt.com/text', [
    'phone' => '',
    'message' => '',
    'key' => '',
]));
*/
