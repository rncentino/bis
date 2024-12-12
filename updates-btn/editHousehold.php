<?php
require("../config/config.php");
define("APPURL", "http://localhost/brgyinfo");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $household_id = $_POST['household_id'];
    $owner_name = $_POST['owner_name'];
    $size = $_POST['size'];
    $type = $_POST['type'];
    $tenure = $_POST['tenure'];
    $income_level = $_POST['income_level'];

    $update = $conn->prepare("UPDATE household SET owner_name = ?, size = ?, type = ?, tenure = ?, income_level = ? WHERE household_id = ?");
    $update->execute([$owner_name, $size, $type, $tenure, $income_level, $household_id]);

    header("location: ".APPURL."/households.php");
} else {
    header("location: ".APPURL."/index.php");
}

?>