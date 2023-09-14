<?php

function generateSH512($textToHash, $signatureKey)
{
    if ($textToHash != null && $signatureKey != null) 
    {
        $sig = hash_hmac('sha512', $textToHash, $signatureKey);

        return "sha512=".strtoupper($sig);
    } 
    else 
    {
        return null;
    }
}

generateSH512($textToHash, $signatureKey);
?>
