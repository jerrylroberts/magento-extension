<?php
/******************************************
TODO: Add HPS header etc.

******************************************/

// The line below sets the include path to include the parent directory. This gets around 
// problems caused by including from the 'examples' subdirectory and will not be needed in your
// code if you follow a normal structure.
set_include_path(get_include_path() . PATH_SEPARATOR . realpath(dirname(__FILE__) .  DIRECTORY_SEPARATOR . ".." ));

// Everything you need to make a charge is included from the file below.
include("hpsChargeService.php");

// In many situations, you'll build a card object like below.
// The minimum fields required are CardNbr, ExpMonth, and ExpYear.
$TestCard = new HpsCardInfo();
$TestCard->CardNbr = "5473500000000014";
$TestCard->ExpYear = "2015";
$TestCard->ExpMonth = "12";
$TestCard->CVV2 = "123";

// Using AVS gives you better rates when processing payments. A good place to start is
// by simply requiring users to enter their Zip Code. This and many other options are
// available through the HpsCardHolderInfo object.
$CardHolder = new HpsCardHolderInfo();
$CardHolder->Address->Zip = "47130";

// In this example we'll store a multi-use token after the first auth
$token = NULL;

// An HpsChargeService object handles all charges, authorizations, validations, etc.
$ChargeService = new HpsChargeService();

// Now we'll try to authorize the card for $amount dollars.
try
{
    $amount = 90.01;
    $currency = "usd"; 
    $tokenize = true;
    // $response will be of type HpsTransactionResponse
    
    $response = $ChargeService->Authorize($amount, $currency, $TestCard, $CardHolder, $tokenize);
    // Store the token we get back from the call to Authorize
    $token = new HpsToken($response->TokenData->TokenValue);
}
catch(Exception $e)
{
    // This should be handled in production apps, just printing exception for demo
    // For more information about the different exception types that can be thrown,
    // please see the appropriate code example file.
    echo "Exception in authorize:\n";
    echo ($e);
}

// Now that the charge is authorized, we'll add it to the batch by transaction ID
try
{
    $id = $response->TransactionId; 
    $captureResponse = $ChargeService->Capture($id);
}
catch(Exception $e)
{
    echo "Exception in capture:\n";
    echo ($e);
}

// Now we'll add another charge using the token we got back from the Authorize
try
{
    $amount = 4.25;
    $curency = "usd";
    $chargeResponse = $ChargeService->Charge($amount, $currency, $token);

}
catch(Exception $e)
{
    echo "Exception in charge:\n";
    echo ($e);
}

// If you've gotten to this point in the example code, the credit authorization was successful
// and the charge was afterwards added to the batch.
echo ("ResponseMessage: " . $chargeResponse->ResponseMessage . "\n");

// If you'd like to see the full response, uncomment the line below.
 var_dump($chargeResponse);

?>
