<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php
    $fbconfig['appid' ]  = "370031656342973";
    $fbconfig['secret']  = "2b50a5ca46922d6e1f695e005dbc7751";
    $fbconfig['api'   ]  = "your application api key";
    
 
    try{
        include_once "..\library\php-sdk\\facebook.php";
    }
    catch(Exception $o){
        echo '<pre>';
        print_r($o);
        echo '</pre>';
    }
    // Create our Application instance.
    $facebook = new Facebook(array(
      'appId'  => $fbconfig['appid'],
      'secret' => $fbconfig['secret'],
      'cookie' => true,
    ));
 
    // We may or may not have this data based on a $_GET or $_COOKIE based session.
    // If we get a session here, it means we found a correctly signed session using
    // the Application Secret only Facebook and the Application know. We dont know
    // if it is still valid until we make an API call using the session. A session
    // can become invalid if it has already expired (should not be getting the
    // session back in this case) or if the user logged out of Facebook.
    //$session = $facebook->getSession();
 
    $fbme = null;
    // Session based graph API call.
    //if ($session) {
      try {
        
        $uid = $facebook->getUser();
        echo '<br/>User: '.$uid;
        
        $access_token=$facebook->getAccessToken();
        echo '<br> Access_Token: '.$access_token;        
        
        $tmp_url = "https://graph.facebook.com/me?access_token=".$access_token;
        echo '<br/><a href='.$tmp_url.'> link to your profile <a/>';
        //$result = file_get_contents($tmp_url); 
        //$proxy = "localhost:80";
        //$result = GetData($tmp_url, $proxy);        
        //echo '<br/>Tmp: '.$result;
        
        //Facebook::$CURL_OPTS[CURLOPT_PROXY] = "localhost:80"; 
        Facebook::$CURL_OPTS[CURLOPT_SSL_VERIFYPEER] = false; 
        Facebook::$CURL_OPTS[CURLOPT_SSL_VERIFYHOST] = 2;
   
        $fbme = $facebook->api('/me');
       
      } catch (FacebookApiException $e) {
          d($e);
      }
    //}
 
    function d($d){
        echo '<pre>';
        print_r($d);
        echo '</pre>';
    }
    
     function GetData($url,$proxy){
        $ch=curl_init();
 	curl_setopt($ch, CURLOPT_URL, $url);
 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
 	curl_setopt($ch, CURLOPT_PROXY ,$proxy);
 	$str=curl_exec($ch);
        curl_close($ch);
        return $str;
    }
 

?>
<?php
/*
function getPage($proxy, $url, $referer, $agent, $header, $timeout) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, $header);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_PROXY, $proxy);
    //curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_REFERER, $referer);
    curl_setopt($ch, CURLOPT_USERAGENT, $agent);

    $result['EXE'] = curl_exec($ch);
    $result['INF'] = curl_getinfo($ch);
    $result['ERR'] = curl_error($ch);

    curl_close($ch);

    return $result;
}
try{
    echo 'Get Page:</br>';
    $result = getPage(
    '75.125.147.82:3128', // use valid proxy
    'http://www.google.com/',
    'http://www.google.com/',
    'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.8) Gecko/2009032609 Firefox/3.0.8',
    1,
    5);
}catch(Exception $e){
    print_r($e);    
}
if (empty($result['ERR'])) {
    echo $results['EXE'];
} else {
    echo $result['ERR'];
}
echo '</br>';
 
 */
?>