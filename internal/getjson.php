<?php
function getJson($url)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_USERAGENT, "SpigetShortener");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($ch);
    $code = curl_getinfo($ch)["http_code"];
    if ($code !== 200) {
        return false;
    }
    curl_close($ch);
    return json_decode($result, true);
}