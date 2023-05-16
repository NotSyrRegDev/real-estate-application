<?php

// EDIT THESE
$host = 'localhost';
$user = 'root';
$pass = '';

// DONT EDIT
$db_name = 'real_estate_portal';
$finishedOperations = false;

global $conn;

$conn = new MySQLi($host, $user, $pass , $db_name );




if ($conn->connect_error) {
    die('Database connection error: ' . $conn->connect_error);
}


if (!$finishedOperations) {
    // Create DATABASE 
    
$sql = "CREATE DATABASE IF NOT EXISTS $db_name";

if ($conn->query($sql) === TRUE) {
    $conn = new MySQLi($host, $user, $pass , $db_name);
    



    // $sqlUsers = "CREATE TABLE IF NOT EXISTS users (
    // id INT(11) AUTO_INCREMENT PRIMARY KEY,
    // refere VARCHAR(50) NOT NULL,
    // name VARCHAR(150) NOT NULL,
    // email VARCHAR(150) NOT NULL,
    // password VARCHAR(150) NOT NULL,
    // refere_id TINYINT(4) NOT NULL,
    // user_group_id TINYINT(4) NOT NULL,
    // image TEXT NOT NULL
    // )";
    // $conn->query($sqlUsers);

    // $sqlSuppliers = "CREATE TABLE IF NOT EXISTS supplier (
    // id INT(11) AUTO_INCREMENT PRIMARY KEY,
    // name VARCHAR(100) NOT NULL,
    // email VARCHAR(250) NOT NULL,
    // image TEXT NOT NULL,
    // about TINYTEXT NOT NULL,
    // hero_image TEXT NOT NULL,
    // related_agency TINYINT(4) NOT NULL,
    // city VARCHAR(50) NOT NULL,
    // street VARCHAR(50) NOT NULL,
    // location_link TEXT NOT NULL,
    // job_id TINYINT(4) NOT NULL,
    // phone_number INT(11) NOT NULL,
    // civil_registry INT(11) NOT NULL,
    // status TINYINT(4) DEFAULT 1 NOT NULL

    // )";
    // $conn->query($sqlSuppliers);

    // $sqlMonitors = "CREATE TABLE IF NOT EXISTS monitor (
    // id INT(11) AUTO_INCREMENT PRIMARY KEY,
    // name VARCHAR(100) NOT NULL,
    // email VARCHAR(250) NOT NULL,
    // image TEXT NOT NULL,
    // civil_registry INT(11) NOT NULL,
    // postion VARCHAR(100) NOT NULL,
    // job_id TINYINT(4) NOT NULL,
    // phone_number INT(11) NOT NULL,
    // status TINYINT(4) DEFAULT 1 NOT NULL

    // )";
    // $conn->query($sqlMonitors);

    // $sqlInvoiceItems = "CREATE TABLE IF NOT EXISTS invoice_items (
    // id INT(11) AUTO_INCREMENT PRIMARY KEY,
    // invoice_relate TINYINT(4) NOT NULL,
    // price INT(11) NOT NULL,
    // quantity VARCHAR(100) NOT NULL,
    // total INT(11) NOT NULL,
    // description TINYTEXT NOT NULL,
    // status TINYINT(4) DEFAULT 1 NOT NULL

    // )";
    // $conn->query($sqlInvoiceItems);

    // $sqlInvoices = "CREATE TABLE IF NOT EXISTS invoices (
    // id INT(11) AUTO_INCREMENT PRIMARY KEY,
    // invoice_agency VARCHAR(250) AUTO_INCREMENT PRIMARY KEY,
    // invoice_number INT(11) NOT NULL,
    // tax_number INT(11) NOT NULL,
    // date DATE NOT NULL,
    // relate_to VARCHAR(50) NOT NULL,
    // relate_to_id INT(11) NOT NULL,
    // invoice_to VARCHAR(50) NOT NULL
    // )";
    // $conn->query($sqlInvoices);

    // $sqlDealerOwners = "CREATE TABLE IF NOT EXISTS dealer_owner (
    //     id INT(11) AUTO_INCREMENT PRIMARY KEY,
    //     name VARCHAR(100) NOT NULL,
    //     email VARCHAR(250) NOT NULL,
    //     image TEXT NOT NULL,
    //     civil_registry INT(11) NOT NULL,
    //     postion VARCHAR(100) NOT NULL,
    //     job_id TINYINT(4) NOT NULL,
    //     phone_number INT(11) NOT NULL,
    //     dealer_refere TINYINT(4) NOT NULL,
    //     status TINYINT(4) DEFAULT 1 NOT NULL
    
    //     )";
    //     $conn->query($sqlDealerOwners);

    // $sqlFacilityOwners = "CREATE TABLE IF NOT EXISTS agency_owner (
    // id INT(11) AUTO_INCREMENT PRIMARY KEY,
    // name VARCHAR(250) NOT NULL,
    // email VARCHAR(250) NOT NULL,
    // phone_number INT(11) NOT NULL,
    // postion VARCHAR(50) NOT NULL,
    // job_id INT(11) NOT NULL,
    // civil_registry INT(11) NOT NULL,
    // agency_refere SMALLINT(6) NOT NULL,
    // image TEXT NOT NULL


    // )";
    // $conn->query($sqlFacilityOwners);

    // $sqlConsumers = "CREATE TABLE IF NOT EXISTS consumers (
    // id INT(11) AUTO_INCREMENT PRIMARY KEY,
    // name VARCHAR(250) NOT NULL,
    // email VARCHAR(250) NOT NULL,
    // phone_number INT(11) NOT NULL,
    // job_id INT(11) NOT NULL,
    // civil_registry INT(11) NOT NULL,
    // image TEXT NOT NULL,
    // status TINYINT(4) DEFAULT 1 NOT NULL


    // )";
    // $conn->query($sqlConsumers);

    // $sqlCertficateRequests = "CREATE TABLE IF NOT EXISTS certficates_requests (
    // id INT(11) AUTO_INCREMENT PRIMARY KEY,
    // requester_name VARCHAR(250) NOT NULL,
    // refere_to VARCHAR(250) NOT NULL,
    // requested VARCHAR(250) NOT NULL,
    // refere_id TINYINT(11) NOT NULL,
    // status TINYINT(4) DEFAULT 1 NOT NULL


    // )";
    // $conn->query($sqlCertficateRequests);

    // $sqlAgencyProducts = "CREATE TABLE IF NOT EXISTS agency_products (
    // id INT(11) AUTO_INCREMENT PRIMARY KEY,
    // name VARCHAR(250) NOT NULL,
    // description TEXT NOT NULL,
    // image TEXT NOT NULL,
    // price TINYINT(11) NOT NULL,
    // related_agency TINYINT(4)  NOT NULL


    // )";
    // $conn->query($sqlAgencyProducts);

    // $sqlDealer = "CREATE TABLE IF NOT EXISTS dealer (
    // id  INT(11) AUTO_INCREMENT PRIMARY KEY,
    // dealer_name VARCHAR(250) NOT NULL,
    // about TEXT NOT NULL,
    // image TEXT NOT NULL,
    // hero_image TEXT NOT NULL,
    // tasij_certficate INT(4) NOT NULL,
    // sahi_certficate INT(4) NOT NULL,
    // city VARCHAR(50) NOT NULL,
    // street VARCHAR(50) NOT NULL,
    // location_link TEXT NOT NULL,
    // owner_id INT(11) NOT NULL,
    // owner_name VARCHAR(50) NOT NULL, 
    // number INT(11) NOT NULL,
    // commercial_register INT(11) NOT NULL,
    // status TINYINT(4) DEFAULT 1 NOT NULL

    

    // )";
    // $conn->query($sqlDealer);

    // $sqlAgency = "CREATE TABLE IF NOT EXISTS dealer (
    // id  INT(11) AUTO_INCREMENT PRIMARY KEY,
    // agency_name VARCHAR(250) NOT NULL,
    // about TEXT NOT NULL,
    // image TEXT NOT NULL,
    // hero_image TEXT NOT NULL,
    // tasij_certficate INT(4) NOT NULL,
    // sahi_certficate INT(4) NOT NULL,
    // city VARCHAR(50) NOT NULL,
    // street VARCHAR(50) NOT NULL,
    // location_link TEXT NOT NULL,
    // owner_id INT(11) NOT NULL,
    // owner_name VARCHAR(50) NOT NULL, 
    // number INT(11) NOT NULL,
    // commercial_register INT(11) NOT NULL,
    // status TINYINT(4) DEFAULT 1 NOT NULL

    

    // )";
    // $conn->query($sqlAgency);

    $finishedOperations = true;

}
 }

// 