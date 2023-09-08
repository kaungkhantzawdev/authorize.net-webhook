<?php
  require 'vendor/autoload.php';
  require_once 'constants/SampleCodeConstants.php';

  $headers = getallheaders();
  $payload = file_get_contents("php://input");
  $webhook = new AuthnetWebhook(\SampleCodeConstants::AUTHNET_SIGNATURE, $payload, $headers);
  if ($webhook->isValid()) {

      $data = json_encode($webhook);

      $myfile = fopen(time()."webhook.txt", "w") or die("Unable to open file!");
      fwrite($myfile, $data);
      fclose($myfile);
      // Get the transaction ID
      $transactionId = $webhook->payload->id;
  
      // Here you can get more information about the transaction
      $request  = AuthnetApiFactory::getJsonApiHandler(\SampleCodeConstants::AUTHNET_LOGIN, AUTHNET_TRANSKEY);
      $response = $request->getTransactionDetailsRequest(array(
          'transId' => $transactionId
      ));
  
      /* You can put these response values in the database or whatever your business logic dictates.
      $response->transaction->transactionType
      $response->transaction->transactionStatus
      $response->transaction->authCode
      $response->transaction->AVSResponse
      */
}
else 
{
  $data = "ERROR";

  $myfile = fopen(time()."error.txt", "w") or die("Unable to open file!");
  fwrite($myfile, $data);
  fclose($myfile);
}