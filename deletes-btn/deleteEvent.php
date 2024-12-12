<?php
require("../config/config.php");
define("APPURL", "http://localhost/brgyinfo");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $project_id = $_POST['project_id'];

    $delete = $conn->prepare("DELETE FROM project_and_events WHERE project_id = ?");
    $delete->execute([$project_id]);

    header("location:".APPURL."/events.php");
} else {
    header("location:".APPURL."/index.php");
}
?>