<?php

    $the_auth_token_object = require 'get_token.php'; 

    

    $auth_token =  $the_auth_token_object[0]['token'];


    $curl = curl_init();
    
    curl_setopt_array($curl, array(
        CURLOPT_URL => /* The url for the google sheet */,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array('Authorization: Bearer '.$auth_token.' Expires In:', 'Content-Type: application/json'),
      ));
      
      $response = curl_exec($curl);
      
      curl_close($curl);
      //echo $response;

      //$array = array('key1' => 'value1', 'key2' => 'value2'); 

      /* echo '<br>What is response<br>';
      echo '<br>' . gettype(json_decode($response, true)); */

      $response_array = json_decode($response, true);

      //echo '<br>Response array drilling <br>';
      //print_r($response_array);

      //print_r ($response_array['values'][1]);
      //echo (count($response_array['values']));
      $the_data = $response_array['values'];

      //print_r ($the_social_media_post_data);

      return $the_data;