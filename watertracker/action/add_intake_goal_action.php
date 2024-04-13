<?php
session_start();
include "../settings/connection.php";

if (!$conn) {
    die("Database connection error: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if user is authenticated
    if (!isset($_SESSION['user_id'])) {
        // Redirect to login page if user is not authenticated
        header("Location: ../login/login_view.php?error=unauthenticated_user");
        exit();
    }

    // Check if all required fields are set
    if (isset($_POST['intake_date'], $_POST['intake_amount'], $_POST['goal_date'], $_POST['goal_amount'])) {
        // Retrieve the submitted values
        $intake_date = mysqli_real_escape_string($conn, $_POST['intake_date']);
        $intake_amount = mysqli_real_escape_string($conn, $_POST['intake_amount']);
        $goal_date = mysqli_real_escape_string($conn, $_POST['goal_date']);
        $goal_amount = mysqli_real_escape_string($conn, $_POST['goal_amount']);
        $user_id = $_SESSION['user_id'];

        // Insert water intake record into the database
        $insert_intake_query = "INSERT INTO water_intake_records (user_id, intake_date, intake_amount) VALUES ('$user_id', '$intake_date', '$intake_amount')";
        $result_intake = mysqli_query($conn, $insert_intake_query);

        // Insert water intake goal into the database
        $insert_goal_query = "INSERT INTO water_intake_goals (user_id, goal_date, goal_amount) VALUES ('$user_id', '$goal_date', '$goal_amount')";
        $result_goal = mysqli_query($conn, $insert_goal_query);

        if ($result_intake && $result_goal) {
            // Records and goals added successfully, redirect to dashboard
            header("Location: ../view/dashboard.php?success=records_and_goal_added");
            exit();
        } else {
            // Error occurred while adding records or goals
            header("Location: ../action/add_intake_goal_view.php?error=database_error");
            exit();
        }
    } else {
        // Required fields are missing in the POST request
        header("Location: ../action/add_intake_goal_view.php?error=missing_fields");
        exit();
    }
} else {
    // Invalid request method
    header("Location: ../action/add_intake_goal_view.php?error=method_not_allowed");
    exit();
}
?>
