<?php
//this line makes PHP behave in a more strict way
declare(strict_types=1);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

//we are going to use session variables so we need to enable sessions
session_start();

function whatIsHappening()
{
    echo '<h2>$_GET</h2>';
    var_dump($_GET);
    echo '<h2>$_POST</h2>';
    var_dump($_POST);
    echo '<h2>$_COOKIE</h2>';
    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    var_dump($_SESSION);
}

//your products with their price.
$products = [
    ['name' => 'Club Ham', 'price' => 3.20],
    ['name' => 'Club Cheese', 'price' => 3],
    ['name' => 'Club Cheese & Ham', 'price' => 4],
    ['name' => 'Club Chicken', 'price' => 4],
    ['name' => 'Club Salmon', 'price' => 5]
];

$productsDrinks = [
    ['name' => 'Cola', 'price' => 2],
    ['name' => 'Fanta', 'price' => 2],
    ['name' => 'Sprite', 'price' => 2],
    ['name' => 'Ice-tea', 'price' => 3],
];


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
        $email = $_POST['email'];
        $_SESSION["email"] = $_POST['email'];
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
    $_POST['email'] = "";
}

$emailFormat = "";
if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $emailFormat = "";
} else {
    $_POST['email'] = "";
    $emailFormat = "This is not a valid email address </br>";
}
if (!isset($_POST['zipcode'])) {
    $_POST['zipcode'] = "";
}

$nanZip = "";

if (is_numeric($_POST['zipcode'])) {
    $nanZip = "";
} else {
    $nanZip = "Zip needs to be numeric </br>";
}


if (!isset($_POST['streetnumber'])) {
    $_POST['streetnumber'] = "";
}

$nanStrnum = "";
if (is_numeric($_POST['streetnumber'])) {
    $nanStrnum = "";
} else {
    $nanStrnum = "Streetnumber needs to be numeric </br>";
}


$checked = [];

if (!empty($_POST["products"])) {
    $checked = $_POST["products"];
}
$sumprice = 0;
for ($i = 0; $i < count($products); $i++) {
    if (isset($checked[$i])) {
        $sumprice += $products[$i]["price"];
    }
}


//implement array if time allows
$delivery = "";
$okAlert = "";
$delivery = "";
$orderEmpty = "";
$bootstrapAlert = "";
if (empty($checked)) {
    $orderEmpty = "You didn't order anything!";
}
if ($emailAlert == "" && $streetAlert == "" && $strnumAlert == "" && $cityAlert == "" && $zipAlert == "" && $nanStrnum == ""
    && $emailFormat == "" && $orderEmpty == "") {
    $bootstrapAlert = '';
    $okAlert = "form sent!";
    if (!isset($_COOKIE['priceTotal'])) {
        setcookie("priceTotal", strval($sumprice));
    } else {
        $totalPrice = $_COOKIE['priceTotal'] + $sumprice;
        setcookie("priceTotal", strval($sumprice + $_COOKIE['priceTotal']));
    }

    $delivery = "Delivery: normal";
    if (empty($_POST["express"])) {
        $delivery = "Delivery: normal";
    } else {
        $delivery = "Delivery: express";
    }

} else {
    $okAlert = "";
    $bootstrapAlert = 'class="alert alert-danger" role="alert"';
}

if (!isset($_GET['food'])) {
    $_GET['food'] = 1;
}

if ($_GET["food"] == 1) {
    $products = $products;
} else {
    $products = $productsDrinks;
}





require 'form-view.php';

