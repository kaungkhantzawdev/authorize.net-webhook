<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://apitest.authorize.net/rest/v1/notifications',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Authorization: Basic NWRGZTRUOFU6OXNNNTM0NzI4cEc0VDhyag=='
  ),
));

$response = curl_exec($curl);

curl_close($curl);
// echo $response;


//write json to file
file_put_contents("data.json", $response)

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
        <span class="fs-4">authorize.net webhook ( create token )</span>
      </a>
    </header>

    <div class="p-5 mb-4 bg-body-tertiary rounded-3">
      <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold">Create Token For Payment</h1>
        <p class="col-md-8 fs-4">
          Please, create token to get your payment.
        </p>
        <form method="post" action="get-token.php" id="formAuthorizeNetTestPage" name="formAuthorizeNetTestPage">
          <button id="btnContinue" class="btn btn-primary btn-lg">Get token</button>
        </form>   
      </div>
    </div>

    <div class="row align-items-md-stretch">
      <div class="col">
        <div class="h-100 p-5 text-bg-dark rounded-3">
          <h2>WebHook notifications</h2>
          <div id="app">
            
          </div>
        </div>
      </div>
    </div>

    <footer class="pt-3 mt-4 text-body-secondary">
      © 2023
    </footer>
  </div>
</main>
<script>

  const app = document.getElementById('app')

  const data = fetch("data.json")
              .then(response => response.json())
              .then(json => {
                app.innerHTML += `
                      <h1>${json.notifications.length}</h1>
                  
                    `
                  json.notifications.map((obj,i) => {
                    app.innerHTML += `
                      <div class="border mb-2 rounded p-3">
                      <h3>index: ${i}</h3>
                      <p>event date - ${obj.eventDate}</p>
                      <p>delivery status - ${obj.deliveryStatus}</p>
                      <p>event type - ${obj.eventType}</p>
                      <p>webhook id - ${obj.webhookId}</p>
                      <p>notification id - ${obj.notificationId}</p>
                      </div>
                  
                    `
                  })
              });

  
  // console.log('hello', data)

</script>
</body>
</html>