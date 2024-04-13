<?php
// Start session (if not already started)
session_start();

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Include database connection
    include "../settings/connection.php";

    // Check if all required fields are set in the POST request
    if (isset($_POST['first_name'], $_POST['last_name'], $_POST['gender'], $_POST['email'], $_POST['password'], $_POST['confirm_password'])) {
        // Retrieve the submitted values
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        // Check if passwords match
        if ($password !== $confirm_password) {
            // Redirect back to the registration form with an error message
            header("Location: ../login/register_view.php?error=password_mismatch");
            exit();
        }

        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare and execute the SQL statement to insert the user into the database
        $sql = "INSERT INTO users (first_name, last_name, gender, email, pass_word) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $first_name, $last_name, $gender, $email, $hashed_password);
        if ($stmt->execute()) {
            // Registration successful, redirect to login page
            header("Location: ../login/login_view.php?registration=success");
            exit();
        } else {
            // Redirect back to the registration form with an error message
            header("Location: ../login/register_view.php?error=registration_failed");
            exit();
        }
    } else {
        // If any required field is missing in the POST request, redirect back to the registration form with an error message
        header("Location: ../login/register_view.php?error=missing_fields");
        exit();
    }
} else {
    // If the request method is not POST, redirect back to the registration form with an error message
    header("Location: ../login/register_view.php?error=method_not_allowed");
    exit();
}
?>
