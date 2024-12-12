<?php
require("../config/config.php");
define("APPURL", "http://localhost/brgyinfo");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $household_id = $_POST['household_id'];

    $delete = $conn->prepare("DELETE FROM household WHERE household_id = ?");
    $delete->execute([$household_id]);

    header("location:".APPURL."/households.php");
} else {
    header("location:".APPURL."/index.php");
}
?>