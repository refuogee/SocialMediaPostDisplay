<?php    
        
    $social_post_data_for_sending =  require 'process-socialposts.php'; 

    //print_r($social_post_data_for_sending);

   /*  for ($i = 0; $i < count($social_post_data_for_sending); $i++ ) {
        echo print_r($social_post_data_for_sending[$i], true);
        echo '<br><br>';
    }
 */
    echo json_encode($social_post_data_for_sending);

    