<?php
require("../config/config.php");
define("APPURL", "http://localhost/brgyinfo");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $case_id = $_POST['case_id'];

    $delete = $conn->prepare("DELETE FROM case_management WHERE case_id = ?");
    $delete->execute([$case_id]);

    header("location:".APPURL."/case.php");
} else {
    header("location:".APPURL."/index.php");
}
?>