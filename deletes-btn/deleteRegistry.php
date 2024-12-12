<?php
require("../config/config.php");
define("APPURL", "http://localhost/brgyinfo");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $record_id= $_POST['record_id'];

    $delete = $conn->prepare("DELETE FROM civil_registry WHERE record_id = ?");
    $delete->execute([$record_id]);

    header("location:".APPURL."/registry.php");
} else {
    header("location:".APPURL."/index.php");
}
?>