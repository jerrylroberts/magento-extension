<?php
	$productid = $_GET["id"];
	
	// you would database-drive these after scrubbing that $_GET["id"]. (http://www.php.net/manual/en/mysqli.real-escape-string.php)
	switch ($productid) {
		case 1:
			$title = "Flatback Rib 1/4-Zip Pullover";
			$description = "The luxurious look and feel of this style extends beyond the weekend. It mixes effortlessly with casual and business attire alike. With a rich, subtle texture, this flatback rib style is finished with impeccable details, making it perfect for a resort escape or around the office.";
			$image = "/assets/images/detail1.jpg";
			$price = 32;
			$priceDisplay = '$32.00';
			break;
		case 2:
			$title = "Tall Long Sleeve Easy Care Shirt";
			$description = "This comfortable wash-and-wear shirt is indispensable for the workday. Wrinkle resistance makes this shirt a cut above the competition so you and your staff can be too.";
			$image = "/assets/images/detail2.jpg";
			$price = 24;
			$priceDisplay = '$24.00';
			break;
		case 3:
			$title = "Ladies Nootka Jacket";
			$description = "The Nootka people live in the Northwest where rainy, soggy days are the norm. That\'s why every seam on our Nootka Jacket is sealed for superior waterproof protection. With the Nootka, you\'ll stay warm and dry—and look good too!";
			$image = "/assets/images/detail3.jpg";
			$price = 78;
			$priceDisplay = '$78.00';
			break;
		case 4:
			$title = "Ladies Dri-FIT Pebble Polo";
			$description = "An understated pebble texture meets high-performance moisture -wicking from Dri-FIT fabric in this Nike Golf style. Tailored for a feminine fit and designed to keep you comfortably dry, features include a self-fabric collar, four-button placket and open hem sleeves. Pearlized buttons are selected to complement the shirt color. The contrast Swoosh design trademark is embroidered on the left sleeve. Made of 3.9-ounce, 100% polyester.";
			$image = "/assets/images/detail4.jpg";
			$price = 36;
			$priceDisplay = '$36.00';
			break;
	}
?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="/assets/css/test.css" rel="stylesheet"/>

    <title>Product Details</title>
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
            

<style>
    .noie {
        position: absolute; 
        bottom: 0;
    }
</style>

<!--[if lt IE 9]>
<style>
    .noie {
        position: relative; 
        bottom: auto;
    }
</style>
<![endif]-->


<div class="row">
    
    <div id="error" class="alert alert-danger" style="display: none;"></div>

    <div id="form-div" class="col-sm-6">

        <h3><?php echo $title; ?></h3>

        <p><?php echo $description; ?></p>

        <h4><?php echo $priceDisplay; ?></h4>

		<form action="/results.php" id="payment_form" method="post">
			<input data-val="true" data-val-number="The field ID must be a number." data-val-required="The ID field is required." id="id" name="id" type="hidden" value="<?php echo $productid; ?>" />
            <fieldset>
                <label for="card_number">Card Number</label>
                <input type="text" id="card_number" placeholder="NUMBER" value="4012002000060016" />

                <label for="card_cvc">CVC</label>
                <input class="input-mini" type="text" id="card_cvc" placeholder="CVC" value="123" />

                <label for="exp_month">Exp Month</label>
                <input class="input-mini" type="text" id="exp_month" placeholder="MM" value="12" />

                <label for="exp_year">Exp Year</label>
                <input class="input-mini" type="text" id="exp_year" placeholder="YYYY" value="2015"  />

            </fieldset>
            <div class="clearfix">&nbsp;</div>
            <input type="submit" class="btn btn-lg btn-primary" value="Process Payment" />
            <div class="clearfix">&nbsp;</div>
		</form>
	</div>

    <div id="image-div" class="col-sm-6">
        <img src="<?php echo $image; ?>" alt="<?php echo $title; ?>" class="noie" />
    </div>
</div>
        </div>
    </div>

    <script src="/assets/js/test.js"></script>
    
    <script type="text/javascript">
        $(document).ready(function () {
            var form = $("#form-div");
            var image = $("#image-div");
            console.log(form);
            console.log(image);

            image.height(form.height());
        });

        $(function () {
            $("#payment_form").SecureSubmit({
                public_key: "pkapi_uat_dU7dx5tMnVPGloX41W",
                error: function (response) {
                    $("#error").html("<button type=button class=close data-dismiss=alert>&times;</button>" + response.message);
                    $("#error").show();
                }
            });
        });
    </script>


</body>
</html>
