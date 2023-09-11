<?php

$input = file_get_contents('php://input');
echo json_encode($input);

// if ($_SERVER['REQUEST_METHOD'] !== 'POST' || json_last_error() !== JSON_ERROR_NONE)
// {
//     http_response_code(400);

//     echo json_encode([ 'error' => 'Invalid request.' ]);
//     die();
// }

$decode = $input ? json_encode($input) :( $_GET ? json_encode($_GET): json_encode($_POST)) ;

$myfile = fopen(time()."webhook.log", "w") or die("Unable to open file!");

fwrite($myfile, $decode);

fclose($myfile);

return;