<?php
include("model_office.php");
session_start();

if (!isset($_SESSION['officelist'])) {
    $_SESSION['officelist'] = array();
}

function createOffice()
{
    $office = new model_office();
    $office->name = $_POST['inputName'];
    $office->address = $_POST['inputAddress'];
    $office->city = $_POST['inputCity'];
    $office->phone = $_POST['inputPhone'];

    array_push($_SESSION['officelist'], $office);
}

function getAllOffice()
{
    return $_SESSION['officelist'];
}

function deleteOffice($officeIndex)
{
    unset($_SESSION['officelist'][$officeIndex]);
}

function getOfficeWithID($officeID)
{
    return $_SESSION['officelist'][$officeID];
}

function updateOffice($officeID)
{
    $office = $_SESSION['officelist'][$officeID];
    $office->name = $_POST['inputName'];
    $office->address = $_POST['inputAddress'];
    $office->city = $_POST['inputCity'];
    $office->phone = $_POST['inputPhone'];
}

if (isset($_POST['button_register'])) {
    createOffice();
    header("Location:view_office.php");
}

if (isset($_GET['deleteID'])) {
    deleteOffice($_GET['deleteID']);
    header("Location:view_office.php");
}

if (isset($_POST['button_update'])) {
    updateOffice($_POST['officeID']);
    header("Location:view_office.php");
}
