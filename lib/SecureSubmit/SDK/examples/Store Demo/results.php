<?php
	$productid = $_POST["id"];
	
	switch ($productid) {
		case 1:
			$price = 32;
			break;
		case 2:
			$price = 24;
			break;
		case 3:
			$price = 78;
			break;
		case 4:
			$price = 36;
			break;
	}
	
	require_once("../../hpsChargeService.php");

	$config = new HpsServicesConfig();
	$config->secretAPIKey = 'skapi_uat_MSdXAAAwMRoATzlDTRmr64xO7d9VwOS_Bpv7DHSR-g';
		
	$chargeService = new HpsChargeService($config);
	$token = new HpsToken($_POST["token_value"]);
	
	$response = $chargeService->Charge($price, "usd", $token);
		
	$authorizationCode = $response->TransactionDetails->AuthCode;
?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="/assets/css/test.css" rel="stylesheet"/>
    <title>Payment Results</title>
</head>
<body class="bs-docs-docs" data-spy="scroll" data-target=".bs-docs-sidebar">
    <div class="navbar navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">
                <img src="/assets/images/securesubmit.png" alt="SecureSubmit" />
            </a>
        </div>
    </div>
</div>


    <div class="medium_background" style="height: 25px;"></div>

    <div class="light_background">
        <div class="container" style="padding-top: 25px;">
            

<h2><strong>Payment Processed!</strong></h2>

<div class="alert alert-success">Your transaction was proccessed successfully using SecureSubmit. <a href="https://developer.heartlandpaymentsystems.com/SecureSubmit/Account/Register"><strong>Register today</strong></a> to start taking payments through your application!</div>

<h3 class="muted">Authorization Code: <?php echo $authorizationCode; ?></h3>

<h2><strong>What Just Happened?</strong></h2>

<p>We used a simple form on the details page to capture the payment information.  We made sure to ommit the <b>name</b> attribute on all input tags that will contain sensitive information so they will not be transmitted to the server.  What happens if you forget?  Our secure submit jQuery plugin will remove those attributes for you so you're covered.  Here is what the markup looks like for our payment form.</p>

<pre class="prettyprint" style="height: 400px; overflow-y: scroll;">
&lt;form action=&quot;/SecureSubmit/Demo/Results&quot; id=&quot;payment_form&quot; method=&quot;post&quot;&gt;
	&lt;!-- The product id --&gt;
	&lt;input id=&quot;id&quot; name=&quot;id&quot; type=&quot;hidden&quot; value=&quot;2&quot; /&gt;        

	&lt;fieldset&gt;

		&lt;label for=&quot;card_number&quot;&gt;Card Number&lt;/label&gt;
		&lt;input id=&quot;card_number&quot; placeholder=&quot;NUMBER&quot; /&gt;

		&lt;label for=&quot;card_cvc&quot;&gt;CVC&lt;/label&gt;
		&lt;input type=&quot;text&quot; id=&quot;card_cvc&quot; placeholder=&quot;CVC&quot; /&gt;

		&lt;label for=&quot;exp_month&quot;&gt;Exp Month&lt;/label&gt;
		&lt;input type=&quot;text&quot; id=&quot;exp_month&quot; placeholder=&quot;MM&quot; /&gt;

		&lt;label for=&quot;exp_year&quot;&gt;Exp Year&lt;/label&gt;
		&lt;input type=&quot;text&quot; id=&quot;exp_year&quot; placeholder=&quot;YYYY&quot;  /&gt;

	&lt;/fieldset&gt;

	&lt;input type=&quot;submit&quot; value=&quot;Process Payment&quot; /&gt;

&lt;/form&gt;

&lt;script type=&quot;text/javascript&quot;&gt;
    $(function () {
        $(&quot;#payment_form&quot;).SecureSubmit({
            public_key: &quot;put your public key here&quot;,
            error: function (response) {
                console.log(response);
            }
        });
    });
&lt;/script&gt;
</pre>

<h3><strong>jQuery Plugin</strong></h3>
<p>The last section of our payment form contains the initialization code to configure the secure submit jQuery plugin.  Simply pass in your public key and our plugin will convert sensitive card information to a secure token.  The card information you entered in the previous screen was submited securely to our payment gateway and converted to a token, <strong>supt_2JGpuNkP5MPFDwaFfMKDtdVq</strong>, before the payment form was submitted.  The secure token is the only data that gets sent back to the merchant server.  Simply leverage one of our numerous <a href="https://developer.heartlandpaymentsystems.com/SecureSubmit/Documentation/SDKs">SDKs</a> to charge the token.</p>

<h3><strong>Making the Charge</strong></h3>

<p>Download any one of our numerous <a href="https://developer.heartlandpaymentsystems.com/SecureSubmit/Documentation/API">SDKs</a> to charge the token.  You will be issued both a public and secret key when you register with the developer portal.  Simply pass the secret key into our SDKs and follow our simple documentation to charge this token.</p>

<pre class="prettyprint">
	$config = new HpsServicesConfig();
	$config->secretAPIKey = &quot;put your secret api key here&quot;;
		
	$chargeService = new HpsChargeService($config);
	$token = new HpsToken($_POST[&quot;token_value&quot;]);
	$response = $chargeService->Charge($price, &quot;usd&quot;, $token);
		
	$authorizationCode = $response->TransactionDetails->AuthCode;
</pre>

<a class="col-lg-12 btn btn-lg btn-success" href="https://developer.heartlandpaymentsystems.com/SecureSubmit/Account/Register">Start integrating with your application today!</a>

<div class="clearfix">&nbsp;</div>
        </div>
    </div>

    <script src="/assets/js/test.js"></script>

    

</body>
</html>