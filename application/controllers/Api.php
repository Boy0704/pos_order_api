<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	public function get_token()
    {
        // API URL
        $url = 'http://103.195.30.157/api/v3500/users/getToken';

        // Create a new cURL resource
        $ch = curl_init($url);

        $clientId = "boykurniawan123@gmail.com"; 
        $clientSecret = "1585920285651"; 
        $headerAuth = base64_encode("2:$clientSecret"); 
        $headers = array(
            "Authorization: Basic $headerAuth",
            "X-CREWDIBLE-CLIENT: $clientId" 
        );

        // Setup request to send json via POST
        $data = array(
            'email' => 'boykurniawan123@gmail.com',
            'password' => 'Boy07041995'
        );
        $payload = json_encode($data);

        // Attach encoded JSON string to the POST fields
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

        // Set the content type to application/json
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Return response instead of outputting
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute the POST request
        $result = curl_exec($ch);

        print_r($result);

        // Close cURL resource
        curl_close($ch);
    }

    public function seller_info()
    {
        // API URL
        $url = 'http://103.195.30.157/api/v3500/owner/info';

        // Create a new cURL resource
        $ch = curl_init($url);

        $clientId = "boykurniawan123@gmail.com"; 
        $clientSecret = "1585920285651"; 
        $headerAuth = base64_encode("2:$clientSecret"); 
        $headers = array(
            "Authorization: Basic $headerAuth",
            "X-CREWDIBLE-CLIENT: $clientId" 
        );

        // Setup request to send json via POST
        $data = array(
            'account' => 'boykurniawan123@gmail.com',
            'email' => 'boykurniawan123@gmail.com',
            "token" => "f96c0ef0c108ffcab1022121195109c3", 
            "command" => ""
        );
        $payload = json_encode($data);

        // Attach encoded JSON string to the POST fields
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

        // Set the content type to application/json
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Return response instead of outputting
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute the POST request
        $result = curl_exec($ch);

        print_r($result);

        // Close cURL resource
        curl_close($ch);
    }
    
}

/* End of file Api.php */
/* Location: ./application/controllers/Api.php */
