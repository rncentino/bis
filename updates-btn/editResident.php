<?php
require("../config/config.php");
define("APPURL", "http://localhost/brgyinfo");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $resident_id = $_POST['resident_id'];
    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $birthdate = $_POST['birthdate'];
    $age = $_POST['age'];
    $birthplace = $_POST['birthplace'];
    $sex = $_POST['sex'];
    $civil_status = $_POST['civil_status'];
    $address = $_POST['address'];
    $contact_number = $_POST['contact_number'];
    $other_details = $_POST['other_details'];

    $update = $conn->prepare("UPDATE resident SET last_name = ?, first_name = ?, middle_name = ?, birthdate = ?, age = ?, birthplace = ?, sex = ?, civil_status = ?, address = ?, contact_number = ?, other_details = ? WHERE resident_id = ?");
    $update->execute([$last_name, $first_name, $middle_name, $birthdate, $age, $birthplace, $sex, $civil_status, $address, $contact_number, $other_details, $resident_id]);

    header("location: ".APPURL."/residents.php");
} else {
    header("location: ".APPURL."/index.php");
}
