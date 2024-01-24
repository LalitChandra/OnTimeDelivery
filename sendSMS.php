<?php

    require_once '"C:\Users\lalit\OneDrive\Desktop\Project#3\OnTimeDelivery\vendor\autoload.php"';

    use Twilio\Rest\Client;
    $sid    = "ACa1afa87f1a27149a1250ca2afd2a7148";
    $token  = "f4b34776450675635d6c1f1e71127e1b";
    $twilio = new Client($sid, $token);
    $message = $twilio->messages
      ->create("+15199817011", // to
        array(
          "from" => "+18302242266",
          "body" => "Hello"
        )
      );

print($message->sid);
?>
