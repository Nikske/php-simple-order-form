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
$email = ""; $street = ""; $streetnr = ""; $city = ""; $zipcode = "";
$emailErr = ""; $streetErr = ""; $streetnrErr = ""; $cityErr = ""; $zipcodeErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Email
    if (empty($_POST["email"])) {
        $emailErr = "Your email goes into the email field";
    } else {
        $email = input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "THAT'S NOT A CORRECT EMAIL ADDRESS NOW IS IT ? YOU GANGLY GREASE-GOBLIN";
        }
    }
    // Street
    if (empty($_POST["street"])) {
        $streetErr = "Surely you can remember where you live?";
    } else {
        $street = input($_POST["street"]);
    }
    // Street number
    if (empty($_POST["streetnumber"])) {
        $streetnrErr = "Street -number-. It's right there man, just give us a number.";
    } else {
        $streetnr = input($_POST["streetnumber"]);
        // Check if the street number is an actual number
        if (!is_numeric($streetnr)) {
            $streetnrErr = "I'm no Count von Count but that's not a number";
        }
    }
    // City
    if (empty($_POST["city"])) {
        $cityErr = "So I wasn't wrong for thinking you're a caveman because you apparently don't live in a city.";
    } else {
        $city = input($_POST["city"]);
    }
    // Zipcode
    if (empty($_POST["zipcode"])) {
        $zipcodeErr = "Your zipcode, please";
    } else {
        $zipcode = input($_POST["zipcode"]);
        if (!is_numeric($zipcode)) {
            $zipcodeErr= "NaN. No I'm not calling your grandmother, I'm saying whatever you just entered wasn't a number";
        }
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

whatIsHappening();

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

//your products with their price.
$products = [
    ['name' => 'Club Ham', 'price' => 3.20],
    ['name' => 'Club Cheese', 'price' => 3],
    ['name' => 'Club Cheese & Ham', 'price' => 4],
    ['name' => 'Club Chicken', 'price' => 4],
    ['name' => 'Club Salmon', 'price' => 5]
];

$products = [
    ['name' => 'Cola', 'price' => 2],
    ['name' => 'Fanta', 'price' => 2],
    ['name' => 'Sprite', 'price' => 2],
    ['name' => 'Ice-tea', 'price' => 3],
];

$totalValue = 0;

require 'form-view.php';