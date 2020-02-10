<?php
//this line makes PHP behave in a more strict way
declare(strict_types=1);

ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);

//we are going to use session variables so we need to enable sessions
session_start();
$email = ""; $street = "";
$emailErr = ""; $streetErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["email"])) {
        $emailErr = "YOUR EMAIL GOES INTO THE EMAIL FIELD, YOU GANGLY TROGLODYTE";
    } else {
        $email = input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "THAT'S NOT A CORRECT EMAIL ADDRESS NOW IS IT ? YOU CANTANKEROUS GOBLIN";
        }
    }

    if (empty($_POST["street"])) {
        $streetErr = "OH COME ON, YOU CAN REMEMBER YOUR OWN STREET NAME RIGHT?";
    } else {
        $street = input($_POST["street"]);
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