<?php
require("../config/config.php");
define("APPURL", "http://localhost/brgyinfo");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $official_id = $_POST['official_id'];

    $delete = $conn->prepare("DELETE FROM barangay_officials WHERE official_id = ?");
    $delete->execute([$official_id]);

    header("location:".APPURL."/officials.php");
} else {
    header("location:".APPURL."/index.php");
}
?>