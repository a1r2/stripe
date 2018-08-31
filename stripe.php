<?php
// 07232018
session_start();
// echo "<pre>"; print_r($GLOBALS); echo "</pre>";

// Retrieve post data
$invoiceID = intval(filter_input(INPUT_POST, 'invoiceID'));
// echo "invoiceID> " . $invoiceID . "<br>";

$totalDueStripe = intval(filter_input(INPUT_POST, 'totalDueStripe'));
// echo "totalDueStripe> " . gettype($totalDueStripe) . "<br>";
// echo "totalDueStripe> " . $totalDueStripe . "<br>";

$clientID = intval(filter_input(INPUT_POST, 'clientID'));
// echo "legalName> " . $legalName . "<br>";

$token = $_POST['stripeToken'];
// echo "token> " . $token . "<br>";

$stripeEmail = $_POST['stripeEmail'];
// echo "stripeEmail> " . $stripeEmail . "<br>";


// empty $invoiceID
if(empty($token))
{

  ?>
  <HTML>
    <HEAD>
      <META HTTP-EQUIV=REFRESH CONTENT='0; URL=https://www.disney.com/'>
    </HEAD>
  </HTML>
  <?php

// empty $invoiceID
}

//Open else
else {

  // my tools
  require_once (__DIR__ . "/../yourClass.php");
  $nutsBolts = new USER();

  //So there are no errors
  $charge = null;
  $err = null;
  $customerId = null;

  // Charging Stripe, client typed info.
  $charge = $nutsBolts->chargingStripe($token, $stripeEmail, $totalDueStripe, $customerId, $invoiceID);

  if ($charge != null) {

    // Charge returns from stripe, handles inserts and move screens
    $nutsBolts->handleChargeObject($charge, $clientID, $invoiceID);

  }

  else {

    // echo "65 else";

  }

//Close else
}

?>
