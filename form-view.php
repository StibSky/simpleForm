<?php
$emailAlert = "";
$streetAlert = "";
$strnumAlert = "";
$cityAlert = "";
$zipAlert = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["email"])) {
        $emailAlert = "Email Required </br>";
    } else {
        $emailAlert = "";
        $email = $_POST['email'];;
    }

    if (empty($_POST["street"])) {
        $streetAlert = "Street Required </br>";
    } else {
        $streetAlert = "";
        $street = $_POST['street'];
        $_SESSION["street"] = $_POST['street'];
    }

    if (empty($_POST["streetnumber"])) {
        $strnumAlert = "strnum Required </br>";
    } else {
        $strnumAlert = "";
        $streetnumber = $_POST['streetnumber'];
        $_SESSION["streetnumber"] = $_POST['streetnumber'];
    }

    if (empty($_POST["city"])) {
        $cityAlert = "city Required </br>";
    } else {
        $cityAlert = "";
        $city = $_POST['city'];
        $_SESSION["city"] = $_POST['city'];
    }

    if (empty($_POST["zipcode"])) {
        $zipAlert = "zipcode Required </br>";
    } else {
        $zipAlert = "";
        $zip = $_POST['zipcode'];
        $_SESSION["zipcode"] = $_POST['zipcode'];
    }
}
if (!isset($_POST['email'])) {
    $_POST['email'] ="";
}

if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $emailFormat = "";
} else {
    $_POST['email'] = "";
    $emailFormat = "This is not a valid email address </br>";
}
if (!isset($_POST['zipcode'])) {
    $_POST['zipcode'] ="";
}

if (is_numeric($_POST['zipcode'])) {
    $nanZip = "";
} else {
    $nanZip = "Zip needs to be numeric </br>";
}


if (!isset($_POST['streetnumber'])) {
    $_POST['streetnumber'] ="";
}
if (is_numeric($_POST['streetnumber'])) {
    $nanStrnum = "";
} else {
    $nanStrnum = "Streetnumber needs to be numeric </br>";
}

//implement array if time allows
$okAlert ="";
if ($emailAlert == "" && $streetAlert == "" && $strnumAlert == "" && $cityAlert == "" && $zipAlert == "" && $nanStrnum == ""
&& $emailFormat == "") {
    $okAlert = "form sent!";
}



if ($_GET["food"] == 1) {
    $products = $products;
}
else {
    $products = $productsDrinks;
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" type="text/css"
          rel="stylesheet"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Order food & drinks</title>
</head>
<body>
<div class="alert alert-success" role="alert">
    <?php echo $okAlert ?>
</div>
<div class="alert alert-danger" role="alert">
    <?php echo $emailAlert ?>
    <?php echo $emailFormat ?>
    <?php echo $streetAlert ?>
    <?php echo $strnumAlert ?>
    <?php echo $nanStrnum ?>
    <?php echo $cityAlert ?>
    <?php echo $zipAlert ?>
    <?php echo $nanZip ?>




</div>

<div class="container">
    <h1>Order food in restaurant "the Personal Ham Processors"</h1>
    <nav>
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link active" href="?food=1">Order food</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?food=0">Order drinks</a>
            </li>
        </ul>
    </nav>
    <form method="post">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="email">E-mail:</label>
                <input type="text" id="email" name="email" class="form-control" value= "<?php echo isset($_POST['email']) ? $_POST['email']: '' ?>"/>
            </div>
            <div></div>
        </div>

        <fieldset>
            <legend>Address</legend>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="street">Street:</label>
                    <input type="text" name="street" id="street" class="form-control" value= "<?php echo isset($_POST['street']) ? $_POST['street']: '' ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="streetnumber">Street number:</label>
                    <input type="text" id="streetnumber" name="streetnumber" class="form-control" value= "<?php echo isset($_POST['streetnumber']) ? $_POST['streetnumber']: '' ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="city">City:</label>
                    <input type="text" id="city" name="city" class="form-control" value= "<?php echo isset($_POST['city']) ? $_POST['city']: '' ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="zipcode">Zipcode</label>
                    <input type="text" id="zipcode" name="zipcode" class="form-control" value= "<?php echo isset($_POST['zipcode']) ? $_POST['zipcode']: '' ?>">
                </div>
            </div>
        </fieldset>

        <fieldset>
            <legend>Products</legend>
            <?php foreach ($products AS $i => $product): ?>
                <label>
                    <input type="checkbox" value="1" name="products[<?php echo $i ?>]"/> <?php echo $product['name'] ?>
                    -
                    &euro; <?php echo number_format($product['price'], 2) ?></label><br/>
            <?php endforeach; ?>
        </fieldset>

        <button type="submit" class="btn btn-primary">Order!</button>
    </form>

    <footer>You already ordered <strong>&euro; <?php echo $totalValue ?></strong> in food and drinks.</footer>
</div>

<style>
    footer {
        text-align: center;
    }
</style>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>

</body>
</html>