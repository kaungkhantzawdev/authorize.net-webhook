<?php
  require 'vendor/autoload.php';
  require_once 'constants/SampleCodeConstants.php';
  use net\authorize\api\contract\v1 as AnetAPI;
  use net\authorize\api\controller as AnetController;

  define("AUTHORIZENET_LOG_FILE", "phplog");
  
function getAnAcceptPaymentPage()
{
    /* Create a merchantAuthenticationType object with authentication details
       retrieved from the constants file */
    $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
    $merchantAuthentication->setName(\SampleCodeConstants::MERCHANT_LOGIN_ID);
    $merchantAuthentication->setTransactionKey(\SampleCodeConstants::MERCHANT_TRANSACTION_KEY);
    
    // Set the transaction's refId
    // $refId = 'ref' . time();
    $refId = 'event_123';

    // Create order information
    $order = new AnetAPI\OrderType();
    $order->setInvoiceNumber("inv-000002");
    $order->setDescription("Judgify Test");

    // Set the customer's identifying information
    $customerData = new AnetAPI\CustomerDataType();
    $customerData->setType("individual");
    $customerData->setId("99999456654");
    $customerData->setEmail("EllenJohnson@example.com");

    // add to user filed.
    $merchantDefinedField1 = new AnetAPI\UserFieldType();
    $merchantDefinedField1->setName("event_id");
    $merchantDefinedField1->setValue("1128836273");
    ;

    // tax
    $tax = new AnetAPI\ExtendedAmountType();
    $tax->setAmount(5.00);
    $tax->setName("level2 tax name");
    $tax->setDescription("level2 tax");

    $currency_code = 'AUD';

    //create a transaction
    $transactionRequestType = new AnetAPI\TransactionRequestType();
    $transactionRequestType->setTransactionType("authCaptureTransaction");
    $transactionRequestType->setOrder($order);
    // $transactionRequestType->setTax($tax);
    $transactionRequestType->setCustomer($customerData);
    $transactionRequestType->addToUserFields($merchantDefinedField1);
    $transactionRequestType->setAmount("13.99");

    // Set Hosted Form options
    $setting1 = new AnetAPI\SettingType();
    $setting1->setSettingName("hostedPaymentButtonOptions");
    $setting1->setSettingValue("{\"text\": \"Pay\"}");

    $setting2 = new AnetAPI\SettingType();
    $setting2->setSettingName("hostedPaymentOrderOptions");
    $setting2->setSettingValue("{\"show\": false}");

    $setting3 = new AnetAPI\SettingType();
    $setting3->setSettingName("hostedPaymentReturnOptions");
    $setting3->setSettingValue(
        "{\"url\": \"http://localhost.authorizewebhook.me\", \"cancelUrl\": \"http://localhost.authorizewebhook.me\", \"showReceipt\": true}"
    );

    $setting4 = new AnetAPI\SettingType();
    $setting4->setSettingName("hostedPaymentShippingAddressOptions");
    $setting4->setSettingValue("{\"show\": false}");

    $setting5 = new AnetAPI\SettingType();
    $setting5->setSettingName("hostedPaymentBillingAddressOptions");
    $setting5->setSettingValue("{\"show\": false}");

    // Build transaction request
    $request = new AnetAPI\GetHostedPaymentPageRequest();
    $request->setMerchantAuthentication($merchantAuthentication);
    $request->setRefId($refId);
    $request->setTransactionRequest($transactionRequestType);

    $request->addToHostedPaymentSettings($setting1);
    $request->addToHostedPaymentSettings($setting2);
    $request->addToHostedPaymentSettings($setting3);
    $request->addToHostedPaymentSettings($setting4);
    $request->addToHostedPaymentSettings($setting5);

    
    //execute request
    $controller = new AnetController\GetHostedPaymentPageController($request);
    $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);
    
    if (($response != null) && ($response->getMessages()->getResultCode() == "Ok")) {
        // echo $response->getToken()."\n";
        return $response->getToken()."\n";

    } else {
        echo "ERROR :  Failed to get hosted payment page token\n";
        $errorMessages = $response->getMessages()->getMessage();
        echo "RESPONSE : " . $errorMessages[0]->getCode() . "  " .$errorMessages[0]->getText() . "\n";
    }
    return $response;
}
if (!defined('DONT_RUN_SAMPLES')) {
    getAnAcceptPaymentPage();
}
