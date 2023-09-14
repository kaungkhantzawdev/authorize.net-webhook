<?php

// $apiLogin="5dFe4T8U";
// $transId="9sM534728pG4T8rj";
// $amount='12.00';
// $signatureKey='6D3545F065A58EAB059D04207B5D91F0D4B1100D9E8FF0563D212B214BABBAFBADD48162811AA81F5B7DA1BF5C73BD45A9ADD6F984C68F26A1E1A02453F75EB8';
// // $textToHash="^". $apiLogin."^". $transId ."^". $amount."^";

// $textToHash = "{\"notificationId\":\"0409933c-0a6c-474a-94b8-1df1bb32516c\",\"eventType\":\"net.authorize.payment.authcapture.created\",\"eventDate\":\"2023-09-13T12:48:39.7738554Z\",\"webhookId\":\"23f65ba9-6bba-46ab-bb38-73beefb6b93e\",\"payload\":{\"responseCode\":1,\"authCode\":\"GET5Y6\",\"avsResponse\":\"Y\",\"authAmount\":13.99,\"merchantReferenceId\":\"event_123\",\"invoiceNumber\":\"inv-000002\",\"entityName\":\"transaction\",\"id\":\"120003813007\"}}";

function generateSH512($textToHash, $signatureKey)
{
    if ($textToHash != null && $signatureKey != null) 
    {
        // $sig = hash_hmac('sha512', $textToHash, hex2bin($signatureKey));
        $sig = hash_hmac('sha512', $textToHash, $signatureKey);

        return $sig;
    } 
    else 
    {
        return null;
    }
}

generateSH512($textToHash, $signatureKey);
?>
