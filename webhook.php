<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    

    $post = json_encode($_POST);

    $myfile = fopen(time()."post.txt", "w") or die("Unable to open file!");
    fwrite($myfile, $post);
    fclose($myfile);
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    

    $get = json_encode($_GET);

    $myfile = fopen(time()."get.txt", "w") or die("Unable to open file!");
    fwrite($myfile, $get);
    fclose($myfile);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebHook Test</title>
    <link rel="icon" href="https://www.judgify.me/l/wp-content/uploads/2018/09/judgify-favicon.png" sizes="192x192">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>

<main>
  <div class="container py-4">
    <header class="pb-3 mb-4">
      <a href="/" class="d-flex align-items-center text-body-emphasis text-decoration-none">
        <img src="https://www.judgify.me/l/wp-content/uploads/2018/07/logo.png" alt="logo">
        <span class="fs-4">authorize.net webhook ( webhook )</span>
      </a>
    </header>

    <div class="p-5 mb-4 bg-body-tertiary rounded-3">
      <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold">Webhook page</h1>
        <p class="col-md-8 fs-4">
          Write txt file anything with timestamp,
        </p>
        <form method="post" action="index.php" id="formAuthorizeNetTestPage" name="formAuthorizeNetTestPage">
          <button id="btnContinue" class="btn btn-primary btn-lg">Home </button>
        </form>   
      </div>
    </div>

    <footer class="pt-3 mt-4 text-body-secondary text-end">
      © 2023
    </footer>
  </div>
</main>
</body>
</html>