<?php

include 'connection.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

$con = OpenCon();
$led = $_GET["led"] ?? null;
$tempo = $_GET["tempo"] ?? null;
$key = $_GET["key"];
$action = $_GET["action"];

if ($key != "A1B2C34D") {
    echo "Invalid key";
    CloseCon($con);
    exit();
}

// led id is 10
if ($action == 'set' && $led !== null) {
    $sql = "UPDATE ESP_COMPONENTS SET value = '$led' WHERE id = 10 ";
    mysqli_query($con, $sql);
    // echo "LED value updated to $led";
} elseif ($action == 'get') {
    $componentId = $_GET["componentId"];
    $sql = "SELECT value, id FROM ESP_COMPONENTS WHERE id = '$componentId'";
    $result = mysqli_query($con, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        echo $row['value'];
    } else {
        echo "No value found";
    }
}

if (isset($tempo) && $action == 'set') {
    $sql = "UPDATE ESP_COMPONENTS SET value = '$tempo' WHERE id = 12";
    mysqli_query($con, $sql);
    echo "Tempo value updated to $tempo";
}

CloseCon($con);
