
<?php
// Include the bundled autoload from the Twilio PHP Helper Library
require __DIR__ . '/twilio-php-master/src/Twilio/autoload.php';
use Twilio\Rest\Client;
// Your Account SID and Auth Token from twilio.com/console
// In production, these should be environment variables. E.g.:
// $auth_token = $_ENV["TWILIO_ACCOUNT_SID"]
// A Twilio number you own with SMS capabilities

function sendSMS($number){
    
    $account_sid = 'ACe4c35c09943c21dea996e4121aac76d5';
    $auth_token = 'c728bb0be0f2ebff510c063c23916ace';
    $twilio_number = "+12056497759";
    
    $client = new Client($account_sid, $auth_token);
    $client->messages->create(
        // Where to send a text message (your cell phone?)
        $number,
        array(
            'from' => $twilio_number,
            'body' => "Thank you for booking with True Fitted! A consultant will call you shortly to brief you through your appointment.\n\nWe look forward to getting you fitted!\n\nhttps://youtu.be/MqAeGgUCboY"
        )
    );
}
