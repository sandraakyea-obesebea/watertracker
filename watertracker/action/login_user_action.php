<?php
session_start();
include "../settings/connection.php";

if (!$conn) {
    die("Database connection error: " . mysqli_connect_error());
}

if (isset($_POST['login_button'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $select_query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $select_query);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);

            if (password_verify($password, $row['pass_word'])) {
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['email'] = $row['email'];

                header("Location: ../view/dashboard.php");
                exit();
            } else {
                header("Location: ../login/login.php?msg=incorrect");
                exit();
            }
        } else {
            header("Location: ../login/login.php?msg=not_registered");
            exit();
        }
    } else {
        // Log the error for debugging
        error_log("Error executing query: " . mysqli_error($conn));

        // Display a generic error message
        header("Location: ../login/login.php?msg=error");
        exit();
    }
} else {
    header("Location: ../login/login.php?msg=error");
    exit();
}
?>
