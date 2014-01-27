<?php
/******************************************
TODO: Add HPS header etc.

******************************************/

// The line below sets the include path to include the parent directory. This gets around 
// problems caused by including from the 'examples' subdirectory and will not be needed in your
// code if you follow a normal structure.
set_include_path(get_include_path() . PATH_SEPARATOR . realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." ));

// Everything you need to make a charge is included from the file below.
include("hpsChargeService.php");

// Here we'll build a cardholder out of POSTed data. In a production app you'll
// want to sanitize any and all user input.
$CardHolder = new HpsCardHolderInfo();
$CardHolder->FirstName = $_POST['user_first_name'];
$CardHolder->LastName = $_POST['user_last_name'];
$CardHolder->Email = $_POST['user_email'];
$CardHolder->Address->Address = $_POST['user_street'];
$CardHolder->Address->City = $_POST['user_city'];
$CardHolder->Address->State = $_POST['user_state'];
$CardHolder->Address->Zip = $_POST['user_zip'];

// Now we'll create a token object to store tokenized data
$Token = new HpsToken($_POST['strPaymentToken']);
echo "Token: $Token->TokenValue \n";
$amount = $_POST['user_amount'];

// An HpsChargeService object handles all charges, authorizations, validations, etc.
$ChargeService = new HpsChargeService();

// Now we'll make the test charge using a payment token
try
{
    $currency = "usd"; 
    // $response will be of type HpsTransactionResponse
    $response = $ChargeService->Charge($amount, $currency, $Token, $CardHolder);
}
catch(Exception $e)
{
    // This should be handled in production apps, just printing exception for demo
    // For more information about the different exception types that can be thrown,
    // please see the appropriate code example file.
    echo "Exception:\n";
    print_r($e);
}

// If you've gotten to this point in the example code, the charge was successful!
echo ("\n\nResponseMessage: " . $response->ResponseMessage . "\n");

// If you'd like to see the full response, uncomment the line below.
 print_r($response);

?>
