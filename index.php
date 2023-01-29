<?php

// start session
session_start();

// require all the classes & functions files
require "config.php";
require "includes/class-db.php";
require "includes/class-user.php";
require "includes/class-authentication.php";
require "includes/class-form-validation.php";
require "includes/class-csrf.php";
require "includes/class-products.php";
require "includes/functions.php";
require "includes/class-cart.php";
require "includes/class-orders.php";
require "includes/class-bill.php";
// require "parts/style.css";

// get route
$path = trim($_SERVER["REQUEST_URI"], '/');

// remove query string
$path = parse_url($path, PHP_URL_PATH);

switch ($path) {
    case 'login':
        require 'pages/login.php';
        break;
    case 'signup':
        require 'pages/signup.php';
        break;
    case 'logout':
        require 'pages/logout.php';
        break;
    case 'dashboard':
        require 'pages/dashboard.php';
        break;
    case 'manage-users':
        require 'pages/manage-users.php';
        break;
    case 'manage-users-edit':
        require 'pages/manage-users-edit.php';
        break;
    case 'manage-users-add':
        require 'pages/manage-users-add.php';
        break;
    case 'manage-products':
        require 'pages/manage-products.php';
        break;
    case 'manage-products-add':
        require 'pages/manage-products-add.php';
        break;
    case 'manage-products-delete':
        require 'pages/manage-products-delete.php';
        break;
    case 'manage-products-edit':
        require 'pages/manage-products-edit.php';
        break;

    case 'shopping-page':
        require 'pages/shoppingpage.php';
        break;
    case 'cart':
        require "pages/cart.php";
        break;
    case 'orders':
        require "pages/orders.php";
        break;
    case 'checkout':
        require "pages/checkout.php";
        break;
        case 'bill':
            require "pages/bill.php";
            break;
        case 'payment-verification';
            require "pages/payment-verification.php";
            break;
    default:
        require 'pages/dashboard.php';
        break;
}
