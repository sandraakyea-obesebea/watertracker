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
$record_id = $_GET['id'];

// Retrieve water intake record
$select_intake_query = "SELECT * FROM water_intake_records WHERE record_id = '$record_id' AND user_id = '$user_id'";
$result_intake = mysqli_query($conn, $select_intake_query);

if (mysqli_num_rows($result_intake) !== 1) {
    // Redirect if record not found or not owned by the user
    header("Location: ../view/dashboard.php?error=record_not_found");
    exit();
}

$row = mysqli_fetch_assoc($result_intake);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Water Intake Record</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2 class="my-4">Edit Water Intake Record</h2>
    <form action="../action/edit_intake_action.php" method="post">
        <input type="hidden" name="record_id" value="<?php echo $row['record_id']; ?>">
        <div class="form-group">
            <label for="intake_date">Intake Date:</label>
            <input type="date" class="form-control" id="intake_date" name="intake_date" value="<?php echo $row['intake_date']; ?>" required>
        </div>
        <div class="form-group">
            <label for="intake_amount">Intake Amount (in ml):</label>
            <input type="number" class="form-control" id="intake_amount" name="intake_amount" value="<?php echo $row['intake_amount']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Record</button>
        <a href="../view/dashboard.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
