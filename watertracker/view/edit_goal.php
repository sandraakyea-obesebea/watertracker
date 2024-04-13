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

if (!isset($_GET['id']) || empty($_GET['id'])) {
    // Redirect if ID parameter is missing
    header("Location: ../view/dashboard.php?error=missing_id");
    exit();
}

$user_id = $_SESSION['user_id'];
$goal_id = $_GET['id'];

// Retrieve water intake goal
$select_goal_query = "SELECT * FROM water_intake_goals WHERE goal_id = '$goal_id' AND user_id = '$user_id'";
$result_goal = mysqli_query($conn, $select_goal_query);

if (mysqli_num_rows($result_goal) !== 1) {
    // Redirect if goal not found or not owned by the user
    header("Location: ../view/dashboard.php?error=goal_not_found");
    exit();
}

$row = mysqli_fetch_assoc($result_goal);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Water Intake Goal</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2 class="my-4">Edit Water Intake Goal</h2>
    <form action="../action/edit_goal_action.php" method="post">
        <input type="hidden" name="goal_id" value="<?php echo $row['goal_id']; ?>">
        <div class="form-group">
            <label for="goal_date">Goal Date:</label>
            <input type="date" class="form-control" id="goal_date" name="goal_date" value="<?php echo $row['goal_date']; ?>" required>
        </div>
        <div class="form-group">
            <label for="goal_amount">Goal Amount (in ml):</label>
            <input type="number" class="form-control" id="goal_amount" name="goal_amount" value="<?php echo $row['goal_amount']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Goal</button>
        <a href="../view/dashboard.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
