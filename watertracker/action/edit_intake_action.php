<?php
session_start();
include "../settings/connection.php";

if (!$conn) {
    die("Database connection error: " . mysqli_connect_error());
}

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login/login_view.php?error=unauthenticated_user");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $record_id = $_POST['record_id'];
    $intake_amount = $_POST['intake_amount'];

    $update_intake_query = "UPDATE water_intake_records SET intake_amount = '$intake_amount' WHERE record_id = '$record_id'";
    $result = mysqli_query($conn, $update_intake_query);

    if ($result) {
        header("Location: ../view/dashboard.php");
        exit();
    } else {
        echo "Error updating intake record: " . mysqli_error($conn);
    }
} else {
    header("Location: ../view/dashboard.php");
    exit();
}
?>
