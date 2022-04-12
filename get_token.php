<?php
    
    // Open database connection
    // Get token
    // Test token is still Valid
    // If valid return token
    
    // If not then create new token 
        // Save most recent token to database
        // Return token

    require_once('dbhandler.php');

    $db_connection = new DBHandler();
    
    // Check if database connection established successfully
    if ($db_connection->getInstance() === null) {
        die("No database connection");
    }     

    // Function Get Token
    function get_token( $db_connection ){
            $select_statement = $db_connection->getInstance()->query('SELECT * FROM token');
            $token_from_db = $select_statement->fetchAll(PDO::FETCH_ASSOC);
        return $token_from_db;
    }

    function check_token_expiry($expires_in, $unix_time_stamp_created){
        $time_now = time();
        $time_left = $time_now - $unix_time_stamp_created;
        if ($time_left > 3599) {
            return false;

        } else {            
            return true;
        }
    }

    function save_token_to_db( $db_connection, $json_token ){
 
        $sql = 'UPDATE token SET token = :token, expires = :expires, unix_time_stamp_created = :unix_time_stamp_created WHERE id = 1';

        $update_statement = $db_connection->getInstance()->prepare($sql);
        
        $token = $json_token->access_token;
        $expires = $json_token->expires_in;
        $unix_time_stamp_created = time();

        $update_statement->bindParam(':token', $token, PDO::PARAM_STR); 
        $update_statement->bindParam(':expires', $expires, PDO::PARAM_INT); 
        $update_statement->bindParam(':unix_time_stamp_created', $unix_time_stamp_created, PDO::PARAM_INT); 
        
        if ($update_statement === false) {
            trigger_error($this->mysqli->error, E_USER_ERROR);
            return;
          }
        
        if ( $update_statement->execute() ) {
            //echo 'The database updated successfully!';
        }
        
        
    }

    function generate_token(){
        
        $private_key = "-----BEGIN PRIVATE KEY-----\n\n-----END PRIVATE KEY-----\n";
        
        function base64url_encode($data) { 
            return rtrim(strtr(base64_encode($data), '+/', '-_'), '='); 
        } 
        
        $jwtHeader = base64url_encode(json_encode(array(
            "alg" => "RS256",
            "typ" => "JWT"
        )));

        $now = time();


        // Changed time to 300 unix / 5 minutes for testing purposes change back to 3600 or 1 hour later

        $jwtClaim = base64url_encode(json_encode(array(
            "iss" => /* Google Service Account */,
            "scope" => "https://www.googleapis.com/auth/analytics.readonly https://www.googleapis.com/auth/spreadsheets.readonly",
            "aud" => "https://www.googleapis.com/oauth2/v4/token",
            "exp" => $now + 3600,
            "iat" => $now
        )));

        openssl_sign(
            $jwtHeader.".".$jwtClaim,
            $jwtSig,
            $private_key,
            "sha256WithRSAEncryption"
        );
        $jwtSig = base64url_encode($jwtSig);

        $jwtAssertion = $jwtHeader.".".$jwtClaim.".".$jwtSig;

        $url = "https://www.googleapis.com/oauth2/v4/token";


        $data = array(
            "grant_type" => "urn:ietf:params:oauth:grant-type:jwt-bearer",
            "assertion" => $jwtAssertion
        );
        
        $ch = curl_init();

        //This is for localhost testing only - delete once on a server - bypasses SSL which is great for testing or you'd get errors
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch) ;

        $the_token = json_decode($response);

        return $the_token;
    }

    //echo '<br><br>';
    //print_r ($token[0]);
    $token_from_db = get_token($db_connection);

    $auth_token = $token_from_db[0]['token'];
    $expires_in = $token_from_db[0]['expires'];
    $time_created = $token_from_db[0]['unix_time_stamp_created'];

    // function check validity
    if ( check_token_expiry($expires_in, $time_created) ) {
        //echo 'Token is fine return it to the API call';
        //print_r ($token_from_db);
        return $token_from_db;
    } else {
        //echo 'Token has expired generate a new one';
        $json_token = generate_token();        
        save_token_to_db($db_connection, $json_token);
        //print_r ($token_from_db);
        return $token_from_db = get_token($db_connection);
    }