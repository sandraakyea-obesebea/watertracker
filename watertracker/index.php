<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Water Intake Tracker</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../watertracker/css/index.css">
    <style>
        .bg-yellow {
            background-color: yellow !important;
        }
    </style>
</head>
<body>
    <div class="navigation-container">
        <header class="bg-yellow py-3 mb-4">
            <!-- Bootstrap Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="navbar-brand" href="#">Water Intake Tracker</a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../watertracker/login/login_view.php">Login</a>
                        </li>
                        <!-- New "Register" navigation link -->
                        <li class="nav-item">
                            <a class="nav-link" href="../watertracker/login/register_view.php">Register</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
    </div>

    <!-- Hero section -->
    <section class="hero">
        <div class="container">
            <h1>Welcome to Water Intake Tracker</h1>
            <p>A web application designed to help users monitor and manage their daily water consumption for maintaining hydration levels. Water Intake Tracker provides a convenient platform for users to log their water intake throughout the day, set hydration goals, and track their progress over time. The application also offers insights into hydration patterns and encourages users to stay hydrated for optimal health and well-being.</p>
            <p class="why-choose">Why choose Water Intake Tracker?</p>
            <ul>
                <li>Monitor and manage your daily water consumption.</li>
                <li>Set hydration goals and track progress over time.</li>
                <li>Gain insights into hydration patterns for optimal health and well-being.</li>
            </ul>
            <img src="../watertracker/img/homepage.jpg" alt="Water Intake Tracker Image">
        </div>
    </section>

    <!-- Add more sections or content here -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
