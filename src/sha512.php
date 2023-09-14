<?php

function generateSH512($textToHash)
{

    $signatureKey = "6D3545F065A58EAB059D04207B5D91F0D4B1100D9E8FF0563D212B214BABBAFBADD48162811AA81F5B7DA1BF5C73BD45A9ADD6F984C68F26A1E1A02453F75EB8";
    
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
