<?php

function generate20CharHmacSha256($policy, $secret_key): string
{
    $hmac_str = hash_hmac('sha256', $policy, $secret_key);
    return substr($hmac_str, 0, 20);
}


function createPolicy()
{
    $UrlPrefix = "http://localhost:8080";
    $etime = date('YmdHis',  strtotime(' + 60 minutes')); //stime Start time (not valid before this time) e.g. 20120424115300 datetime format UTC
    $resource = sprintf("URL=%s:Expires=%d", $UrlPrefix, $etime);

    return  base64_encode($resource);
}

function createSignedCookie()
{

    $secret_key = "npkj0qkaczlkapq5uuzr2yh1cftut4zdz8o6ifb0dff4xq4vh0comb82tdt506fh";
    //CDN secret key generated from gotipath portal.
    $policy = createPolicy();


    $signature = generate20CharHmacSha256($policy, $secret_key);

    $signedCookie = array(
        "Gotipath-Policy" => $policy,
        "Gotipath-Signature" => '0' . $signature
    );
    return $signedCookie;
}

$signedCookieCustomPolicy = createSignedCookie();

var_dump($signedCookieCustomPolicy);



// foreach ($signedCookieCustomPolicy as $name => $value) {
//     setcookie($name, $value, 10, "/", "tm.gpcdn.net", false, false);
// }
