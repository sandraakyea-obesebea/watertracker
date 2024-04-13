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
    $goal_id = $_POST['goal_id'];

    $delete_goal_query = "DELETE FROM water_intake_goals WHERE goal_id = '$goal_id'";
    $result = mysqli_query($conn, $delete_goal_query);

    if ($result) {
        header("Location: ../view/dashboard.php");
        exit();
    } else {
        echo "Error deleting goal record: " . mysqli_error($conn);
    }
} else {
    header("Location: ../view/dashboard.php");
    exit();
}
?>
