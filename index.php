<?php
//this line makes PHP behave in a more strict way
declare(strict_types=1);

ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);

//we are going to use session variables so we need to enable sessions
session_start();

// VALIDATION
// Initialising variables
$emailData = $_SESSION["email"]; $streetData = $_SESSION["street"]; $streetnrData = $_SESSION["streetnumber"]; $cityData = $_SESSION["city"]; $zipcodeData = $_SESSION["zipcode"];

$emailErr = ""; $streetErr = ""; $streetnrErr = ""; $cityErr = ""; $zipcodeErr = "";
$errorArr = [];
$success = "";
$delivery = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Email
    if (empty($_POST["email"])) {
        $emailErr = "Your email goes into the email field";
        array_push($errorArr, $emailErr);
        $_SESSION["email"] = "";
    } else {
        $_SESSION["email"] = input($_POST["email"]);
        $emailData = $_SESSION["email"];

        if (!filter_var($_SESSION["email"], FILTER_VALIDATE_EMAIL)) {
            $emailErr = "THAT'S NOT A CORRECT EMAIL ADDRESS NOW IS IT ? YOU GANGLY GREASE-GOBLIN";
            array_push($errorArr, $emailErr);
        }
    }
    // Street
    if (empty($_POST["street"])) {
        $streetErr = "Surely you can remember where you live?";
        array_push($errorArr, $streetErr);
        $_SESSION["street"] = "";
    } else {
        $_SESSION["street"] = input($_POST["street"]);
        $streetData = $_SESSION["street"];
    }
    // Street number
    if (empty($_POST["streetnumber"])) {
        $streetnrErr = "The street number, hand it over";
        array_push($errorArr,$streetErr);
        $_SESSION["streetnumber"] = "";
    } else {
        $_SESSION["streetnumber"] = input($_POST["streetnumber"]);
        $streetnrData = $_SESSION["streetnumber"];

        // Check if the street number is an actual number
        if (!is_numeric($_SESSION["streetnumber"])) {
            $streetnrErr = "I'm no Count von Count but that's not a number";
            array_push($errorArr,$streetErr);
        }
    }
    // City
    if (empty($_POST["city"])) {
        $cityErr = "So I wasn't wrong for thinking you're a caveman because you apparently don't live in a city";
        array_push($errorArr, $cityErr);
        $_SESSION["city"] = "";
    } else {
        $_SESSION["city"] = input($_POST["city"]);
        $cityData = $_SESSION["city"];
    }
    // Zipcode
    if (empty($_POST["zipcode"])) {
        $zipcodeErr = "Your zipcode, please";
        array_push($errorArr, $zipcodeErr);
        $_SESSION["zipcode"] = "";
    } else {
        $_SESSION["zipcode"] = input($_POST["zipcode"]);
        $zipcodeData = $_SESSION["zipcode"];

        if (!is_numeric($_SESSION["zipcode"])) {
            $zipcodeErr= "Number please";
            array_push($errorArr, $zipcodeErr);
        }
    }
    // If the error array is empty, meaning if there are no errors give them the green light, otherwise clear the error array so the user can try again.
    if (empty($errorArr)) {
        $success = "Order ordered";
        if (!isset($_POST["express"])) {
            $delivery = date('h:i:s A', strtotime('+ 2 hours'));
        } else {
            $delivery = date('h:i:s A', strtotime('+ 45 minutes'));
        }
    } else {
        $errorArr = [];
    }
}

// Function to clean up the input
function input($data) {
    // Trim = Remove unnecessary whitespace, etc.
    $data = trim($data);
    // Converts special characters to their HTML code, for security reasons
    $data = htmlspecialchars($data);
    return $data;
}

// FOOD & DRINK
//your products with their price.
$products = [
    ['name' => 'Club Ham', 'price' => 3.20],
    ['name' => 'Club Cheese', 'price' => 3],
    ['name' => 'Club Cheese & Ham', 'price' => 4],
    ['name' => 'Club Chicken', 'price' => 4],
    ['name' => 'Club Salmon', 'price' => 5]
];

$drink = [
    ['name' => 'Cola', 'price' => 2],
    ['name' => 'Fanta', 'price' => 2],
    ['name' => 'Sprite', 'price' => 2],
    ['name' => 'Ice-tea', 'price' => 3],
];
// Set food to 1 to avoid initial errors
if (!isset($_GET["food"])) {
    $_GET["food"] = 1;
}
// If food = 1 display the products array as food otherwise (aka 0) display as drinks
if ($_GET["food"] == 1) {
    $products;
} else {
    $products = $drink;
}


$totalValue = 0;

function whatIsHappening() {
    echo '<h2>$_GET</h2>';
    var_dump($_GET);
    echo '<h2>$_POST</h2>';
    var_dump($_POST);
    echo '<h2>$_COOKIE</h2>';
    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    var_dump($_SESSION);
}

require 'form-view.php';