<?php
    // Update the path below to your autoload.php
    require_once 'vendor/autoload.php';

    use Twilio\Rest\Client;

    // Your Account SID and Auth Token from Twilio
    $sid    = "AC9298e805dd2cf96561ee13cdfa19571d";
    $token  = "7a359c603866a44f0498ac87c8815065"; // Replace with your actual Auth Token
    $twilio = new Client($sid, $token);

    // Send the SMS
    $message = $twilio->messages
      ->create("+639076011089", // to
        array(
          "from" => "+12515722383", // Your Twilio number
          "body" => "Check this out"
        )
      );

    // Print the message SID to confirm
    print($message->sid);
