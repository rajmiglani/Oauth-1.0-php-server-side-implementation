<?php
require_once '../../vendor/autoload.php';

define('OAUTH_HOST', 'http://' . $_SERVER['SERVER_NAME']);
$id = 12;

//echo "yyyyyy??";
$options = array(
    'consumer_key' => '2f1fffc1529d8e594040d4970114ed0d0557d8084',
    'consumer_secret' => 'e296af8c7cb0778ab5933b932f08c66d',
    'server_uri' => OAUTH_HOST,'/public',
    'request_token_uri' => OAUTH_HOST . '/public/request_token.php',
    'authorize_uri' => OAUTH_HOST . '/public/login.php',
    'access_token_uri' => OAUTH_HOST . '/public/access_token.php'
);

OAuthStore::instance('Session', $options);
 
if (empty($_GET['oauth_token'])) {
  
    $tokenResultParams = OAuthRequester::requestRequestToken($options['consumer_key'], $id);

    header('Location: ' . $options['authorize_uri'] .
        '?oauth_token=' . $tokenResultParams['token'] . 
        '&oauth_callback='.urlencode('http://' . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF']));
}
else {
    
    $oauthToken = $_GET['oauth_token'];
    $tokenResultParams = $_GET;
    OAuthRequester::requestAccessToken($options['consumer_key'], $tokenResultParams['oauth_token'], $id, 'POST', $_GET);
    $request = new OAuthRequester(OAUTH_HOST . '/public/test_request.php', 'GET', $tokenResultParams);
    $result = $request->doRequest(0);
    
   
    if ($result['code'] == 200) {
        var_dump($result['body']);
    }
    else {
        echo 'Error';
    }
}
