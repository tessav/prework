<?php
session_start();
$validBill = true;
$message = "";

// FORM VALIDATION
// check if tip is chosen
if (empty($_POST['subtotal']) && $_POST['formSubmitted']) {
  $message .= "Please enter a bill. <br>";
  $validBill = false;
}
if (empty($_POST['tip']) && $_POST['formSubmitted']) {
  $message .= "Please choose a tip. <br>";
  $validBill = false;
}

// check if subtotal input is an integer / float and larger than 0
if (!empty($_POST['subtotal'])) {
  if (!is_numeric($_POST['subtotal'])) {
    $message .= "Subtotal must be a valid numeric price.";
    $validBill = false;
  }
  if ($_POST['subtotal'] < 0) {
    $message .= "Subtotal must be a valid price above $0. ";
    $validBill = false;
  }
}
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Tip Calculator</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="css/normalize.css">
        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css">
        <link rel="stylesheet" href="css/main.css">

        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body style="background-color: #ededed;">
      <div class="container">
        <div style="height: 100px; width: 100px;"></div>
        <div class="row">
          <div class="col s12 m3"></div>
        <div class="col s12 m6">
          <div class="card">
            <div class="card-content">
              <center><h5 style="color: #26a69a;">Tip Calculator</h5></center>
              <form method="POST" action=""><br>
                <input type="hidden" value="true" name="formSubmitted">
                <div class="row">
                  <div class="input-field col s7">
                    <input id="input_text" name="subtotal" type="text" value="<?php if (!empty($_POST['subtotal'])) { echo $_POST['subtotal']; }?>">
                    <label for="input_text">Bill Subtotal (USD)</label>
                  </div>
                  <div class="col s1"></div>
                  <div class="col s4">
                  <?php
                    $tipPercentages = ["10", "15", "20"];
                    foreach ($tipPercentages as $tipPercentage) {
                      echo "<p><input class='with-gap' name='tip' id=". $tipPercentage ." type='radio' ";
                      if (empty($_POST['tip']) && $tipPercentage == "10") {
                        echo "checked='checked'";
                      }
                      if ($tipPercentage == $_POST['tip']) {
                        echo "checked='checked'";
                      }
                      echo "value='" . $tipPercentage . "'/>";
                      echo "<label for='" . $tipPercentage . "'>". $tipPercentage . "%</label></p>";
                    }
                    ?>
                  </div>
                </div>

                <button class="btn waves-effect waves-light" type="submit" name="action" style="width: 100%; height: 50px;">
                  Calculate
                </button>
              </form><br>
              <div>
                <span><?php
                echo $message;
                  if ((count($_POST) > 0) && $validBill) {
                    $results = $_POST['subtotal'] * $_POST['tip'] / 100;
                    echo "Tips: $" . number_format($results,2);
                    echo "<br>";
                    $finalTotal = $results + $_POST['subtotal'];
                    echo "Total: $". number_format($finalTotal,2);
                  }
                ?>
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>



        <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.12.0.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <!-- Compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>
