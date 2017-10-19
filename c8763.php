#!/usr/bin/php

<?php

function curl_use_get($url, $api_data)
{
    $error_msg = '';
    $ch        = curl_init();
    $defaults  = array(
        CURLOPT_URL => $url. (strpos($url, '?') === FALSE ? '?' : ''). http_build_query($api_data),
        CURLOPT_HEADER => 0,
        CURLOPT_RETURNTRANSFER => TRUE,
        CURLOPT_TIMEOUT => 4
    );

    curl_setopt_array($ch, $defaults);

    if(curl_exec($ch) === false) {
        $error_msg = curl_error($ch);
    }

    curl_close($ch);
    return $error_msg;
}

function httpGet($url)
{
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
//  curl_setopt($ch,CURLOPT_HEADER, false);
    $output=curl_exec($ch);
    print_r($output);
    curl_close($ch);

    $url = 'https://slack.com/api/chat.postMessage';
    $api_data = array (
        'token' => '',
        'channel' => '#c8763',
        'username' => 'SKY 哥',
        'pretty' => 1,
        'text' =>  $output
    );
    $error_msg = '';

    $error_msg = curl_use_get($url, $api_data);

    if ($error_msg) {
        echo $error_msg;
    }
}

$comment = httpGet('');







?>