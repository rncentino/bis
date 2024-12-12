<?php
require("../config/config.php");
define("APPURL", "http://localhost/brgyinfo");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $clearance_id = $_POST['clearance_id'];

    $delete = $conn->prepare("DELETE FROM clearance_and_permit WHERE clearance_id = ?");
    $delete->execute([$clearance_id]);

    header("location:".APPURL."/permits.php");
} else {
    header("location:".APPURL."/index.php");
}
?>