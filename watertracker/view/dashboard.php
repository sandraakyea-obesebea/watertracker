<?php
session_start();
include "../settings/connection.php";

if (!$conn) {
    die("Database connection error: " . mysqli_connect_error());
}

if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if user is not authenticated
    header("Location: ../login/login_view.php?error=unauthenticated_user");
    exit();
}

$user_id = $_SESSION['user_id'];

// Retrieve water intake records
$select_intake_query = "SELECT * FROM water_intake_records WHERE user_id = '$user_id'";
$result_intake = mysqli_query($conn, $select_intake_query);

// Check if the query was successful
if (!$result_intake) {
    die("Error fetching intake records: " . mysqli_error($conn));
}

// Retrieve water intake goals
$select_goal_query = "SELECT * FROM water_intake_goals WHERE user_id = '$user_id'";
$result_goal = mysqli_query($conn, $select_goal_query);

// Check if the query was successful
if (!$result_goal) {
    die("Error fetching goal records: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-warning">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../view/dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../view/water_intake_goals.php">Add Intake & Goal</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../login/login_view.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../login/logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <h2 class="text-center mb-4">User Dashboard</h2>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Intake History
                </div>
                <div class="card-body">
                    <ul>
                        <?php
                        if (mysqli_num_rows($result_intake) > 0) {
                            while ($row = mysqli_fetch_assoc($result_intake)) {
                                echo "<li>Date: " . $row['intake_date'] . ", Amount: " . $row['intake_amount'] . " ml 
                                <a href='../view/edit_intake.php?id=" . $row['record_id'] . "' class='btn btn-sm btn-primary mr-2'>Edit</a>
                                <form action='../action/delete_intake_action.php' method='post' style='display: inline;'>
                                    <input type='hidden' name='record_id' value='" . $row['record_id'] . "'>
                                    <button type='submit' class='btn btn-sm btn-danger'>Delete</button>
                                </form>
                                </li>";
                            }
                        } else {
                            echo "No intake records found.";
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Goal Progress
                </div>
                <div class="card-body">
                    <ul>
                        <?php
                        if (mysqli_num_rows($result_goal) > 0) {
                            while ($row = mysqli_fetch_assoc($result_goal)) {
                                echo "<li>Date: " . $row['goal_date'] . ", Amount: " . $row['goal_amount'] . " ml 
                                <a href='../view/edit_goal.php?id=" . $row['goal_id'] . "' class='btn btn-sm btn-primary mr-2'>Edit</a>
                                <form action='../action/delete_goal_action.php' method='post' style='display: inline;'>
                                    <input type='hidden' name='goal_id' value='" . $row['goal_id'] . "'>
                                    <button type='submit' class='btn btn-sm btn-danger'>Delete</button>
                                </form>
                                </li>";
                            }
                        } else {
                            echo "No goals found.";
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
