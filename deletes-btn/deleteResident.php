<?php
require("../config/config.php");
define("APPURL", "http://localhost/brgyinfo");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $resident_id = $_POST['resident_id'];

    $delete = $conn->prepare("DELETE FROM resident WHERE resident_id = ?");
    $delete->execute([$resident_id]);

    header("location:".APPURL."/residents.php");
} else {
    header("location:".APPURL."/index.php");
}
?>
