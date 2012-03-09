<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php
    $fbconfig['appid' ]  = "352622804782318";
    $fbconfig['secret']  = "af03e15f053d5a34585e4802bc5a25f1";
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