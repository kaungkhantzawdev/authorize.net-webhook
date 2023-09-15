<?php

require_once 'src/sha512.php';

$input = file_get_contents('php://input');
echo "respone print";

echo "I'm from post";
print_r($_POST);
echo "<br>";

echo "I'm from get";
print_r($_GET);
echo "<br>";

echo "I'm FROM Input";
print_r($input);
echo "<br>";

echo "I'm from server";
print_r($_SERVER);

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || json_last_error() !== JSON_ERROR_NONE)
{
    http_response_code(400);

    echo json_encode([ 'error' => 'Invalid request.' ]);
    die();
}

$input =  $input;
$x_anet_sig = $_SERVER['HTTP_X_ANET_SIGNATURE'];

if(generateSH512($input) === $x_anet_sig )
{
    $_input = fopen(time()."webhook_input.log", "w") or die("Unable to open file!");

    fwrite($_input, $input);
    
    $myfile = fopen(time()."webhook_server.log", "w") or die("Unable to open file!");
    
    fwrite($myfile, $x_anet_sig);
       
}

$_error = fopen(time()."webhook_error.log", "w") or die("Unable to open file!");

fwrite("Webhook Error, not same with signature", $_error);


return;