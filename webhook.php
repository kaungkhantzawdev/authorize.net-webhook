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

$decode = $input ? json_encode($input) :( $_GET ? json_encode($_GET): json_encode($_POST)) ;

$_input = fopen(time()."webhook_input.log", "w") or die("Unable to open file!");

fwrite($_input, json_encode($input));

$myfile = fopen(time()."webhook_server.log", "w") or die("Unable to open file!");

fwrite($myfile, json_encode($_SERVER['HTTP_X_ANET_SIGNATURE']));


return;