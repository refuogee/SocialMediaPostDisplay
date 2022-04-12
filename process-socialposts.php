<?php

    $the_social_media__data = require 'get-social-posts.php'; 

    unset($the_social_media__data[0]);
    $the_social_media__data_only = array_values($the_social_media__data);    

    for ($j = 0; $j < count($the_social_media__data_only); $j++) {
        $tempDate = $the_social_media__data_only[$j][0];
        $timestamp = strtotime($tempDate);
        $formattedDate = date('F d', $timestamp);
        $the_social_media__data_only[$j][0] = $formattedDate. ' at 11:00 AM';
    }

    for ($i = 0; $i < count($the_social_media__data_only); $i++) {
        $img_url = $the_social_media__data_only[$i][6];
        $before_id = strpos( $the_social_media__data_only[$i][6], 'd/' );
        $id_with_extra = substr( $the_social_media__data_only[$i][6], $before_id+2 );
        $after_id = strpos( $id_with_extra, '/v' );
        $img_id = substr( $id_with_extra, 0, $after_id );
        $the_social_media__data_only[$i][6] = "https://drive.google.com/uc?export=view&id=".$img_id;
    }

    //print_r($the_social_media__data_only);

    for ($k = 0; $k < count($the_social_media__data_only); $k++) {
        $formatted_social_post_data[$k] = array(
                                                    "date"  => $the_social_media__data_only[$k][0],
                                                    "post_type"  => $the_social_media__data_only[$k][1],
                                                    "copy"  => $the_social_media__data_only[$k][2],
                                                    "img_caption" => $the_social_media__data_only[$k][3],
                                                    "promoted" => $the_social_media__data_only[$k][4],
                                                    "img_url" => $the_social_media__data_only[$k][6],
                                                    "text_url" => $the_social_media__data_only[$k][5]
                                                );
    }

 
   return $formatted_social_post_data;