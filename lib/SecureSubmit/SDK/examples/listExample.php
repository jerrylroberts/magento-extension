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
// The file below contains constants enumerating possible transaction types
include("entities/listFilters.php");

// An HpsChargeService object handles all charges, authorizations, validations, etc.
$ChargeService = new HpsChargeService();

// $dateMinus1 is exactly one day ago, we'll just look at the last 24 hours of transactions
$dateMinus1 = new DateTime();
$dateMinus1->sub(new DateInterval('P1D'));
// All dates used are in UTC. the HpsChargeService has a helper function to make this easier.
$dateMinus1Utc = $ChargeService->ToUtc($dateMinus1);
$nowUtc = $ChargeService->ToUtc(new DateTime());

$filter = ListFilters::CreditSale;
echo "\n\nListing items of type $filter from $dateMinus1Utc to $nowUtc.\n\n";

try
{
    $items = $ChargeService->ListTransactions($dateMinus1Utc, $nowUtc, $filter);
    print "Found " . (string)count($items) . " transactions.\n";
    print "First transaction listed: \n\n";
    print_r($items[0]); 
}
catch(Exception $e)
{
    echo "Exception:\n";
    print_r($e);
}

?>
