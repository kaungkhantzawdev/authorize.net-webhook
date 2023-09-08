<?php

require_once 'src/get-an-accept-payment-page.php';

$token = getAnAcceptPaymentPage();


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
        <span class="fs-4">authorize.net webhook ( go to payment page )</span>
      </a>
    </header>

    <div class="p-5 mb-4 bg-body-tertiary rounded-3">
      <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold">Go directly to payment page, power by authorize.net</h1>
        <p class="col-md-8 fs-4">
          Continue to Authorize.net to Payment Page
        </p>
        <div class="my-3">
          <input type="text" class="form-control" value="<?php echo $token ?>">
        </div>
        <form method="post" action="https://test.authorize.net/payment/payment" id="formAuthorizeNetTestPage" name="formAuthorizeNetTestPage">
          <input type="hidden" name="token" value="<?php echo $token ?>" />
          <button id="btnContinue" class="btn btn-primary btn-lg">Continue to next page</button>
        </form>        
    
      </div>
    </div>

    <div class="row align-items-md-stretch">
      <div class="col-md-6">
        <div class="h-100 p-5 text-bg-dark rounded-3">
          <h2>Change the background</h2>
          <p>Swap the background-color utility and add a `.text-*` color utility to mix up the jumbotron look. Then, mix and match with additional component themes and more.</p>
          <button class="btn btn-outline-light" type="button">Example button</button>
        </div>
      </div>
      <div class="col-md-6">
        <div class="h-100 p-5 bg-body-tertiary rounded-3">
          <h2>Add borders</h2>
          <p>Or, keep it light and add a border for some added definition to the boundaries of your content. Be sure to look under the hood at the source HTML here as we've adjusted the alignment and sizing of both column's content for equal-height.</p>
          <button class="btn btn-outline-secondary" type="button">Example button</button>
        </div>
      </div>
    </div>

    <footer class="pt-3 mt-4 text-body-secondary">
      © 2023
    </footer>
  </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

</body>
</html>