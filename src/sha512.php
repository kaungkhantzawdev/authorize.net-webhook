<?php

function generateSH512($textToHash)
{

    $signatureKey = "sig key";
    
    if ($textToHash != null) 
    {
        $sig = hash_hmac('sha512', $textToHash, $signatureKey);

        return "sha512=".strtoupper($sig);
    } 
    else 
    {
        return null;
    }
}
?>
