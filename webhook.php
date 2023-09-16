
<?php

require_once 'src/sha512.php';

$input = file_get_contents('php://input');

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || json_last_error() !== JSON_ERROR_NONE)
{
    http_response_code(400);

    echo json_encode([ 'error' => 'Invalid request.' ]);
    die();
}




$x_anet_sig = $_SERVER['HTTP_X_ANET_SIGNATURE'];
$input_p = json_decode($input);
$arr = array(
"eventType" => $input_p->eventType,
"responseCode" => $input_p->payload->responseCode,
"authAmount" => $input_p->payload->authAmount,
"merchantReferenceId" => $input_p->payload->merchantReferenceId,
"invoiceNumber" => $input_p->payload->invoiceNumber,

);

if(generateSH512($input) === $x_anet_sig )
{
    $_input = fopen(time()."webhook_success_input.log", "w") or die("Unable to open file!");

    fwrite($_input, json_encode($arr));
    
    $myfile = fopen(time()."webhook_success_server.log", "w") or die("Unable to open file!");
    
    fwrite($myfile, json_encode(array("input" => $input, "x_anet_sig" => $x_anet_sig)));

}else {

$_error = fopen(time()."webhook_error.log", "w") or die("Unable to open file!");

fwrite("Webhook Error, not same with signature", $_error);

}

return;

