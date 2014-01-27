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

// An HpsChargeService object handles all charges, authorizations, validations, etc.
$ChargeService = new HpsChargeService();

$amount = 90.01;
$currency = "usd"; 

// Create a test charge that we will then refund.
try
{
    // $response will be of type HpsTransactionResponse
    $response = $ChargeService->Charge($amount, $currency, $TestCard, $CardHolder);

    // Close the batch so we can use Refund
    // In most situations this will have automatically been closed, but for testing purposes
    // we will go ahead and push it through quickly
    $ChargeService->BatchClose();
}
catch(Exception $e)
{
    // This should be handled in production apps, just printing exception for demo
    // For more information about the different exception types that can be thrown,
    // please see the appropriate code example file.
    echo "Exception in Charge: \n";
    var_dump($e);
}

// Now we'll try to refund the same amount
try
{
    $refundResponse = $ChargeService->Refund($amount, $currency, $TestCard, $CardHolder);
}
catch(Exception $e)
{
    echo "Exception in Refund: \n";
    var_dump ($e);
}

echo ("ResponseMessage: " . $refundResponse->ResponseMessage . "\n");

?>
