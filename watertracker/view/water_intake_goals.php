<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Water Intake Record & Goal</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="styles.css" rel="../css/water_intake.css">
    <style>
        .navbar-light .navbar-nav .nav-link {
            color: white;
        }
    </style>
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

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="form-container">
                <h2 class="text-center mb-4">Add Water Intake Record & Goal</h2>
                <form action="../action/add_intake_goal_action.php" method="post">
                    <div class="form-group">
                        <label for="intake_date">Intake Date:</label>
                        <input type="date" class="form-control" id="intake_date" name="intake_date" required>
                    </div>
                    <div class="form-group">
                        <label for="intake_amount">Intake Amount (in ml):</label>
                        <input type="number" class="form-control" id="intake_amount" name="intake_amount" required>
                    </div>
                    <div class="form-group">
                        <label for="goal_date">Goal Date:</label>
                        <input type="date" class="form-control" id="goal_date" name="goal_date" required>
                    </div>
                    <div class="form-group">
                        <label for="goal_amount">Goal Amount (in ml):</label>
                        <input type="number" class="form-control" id="goal_amount" name="goal_amount" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Add Record & Goal</button>
                </form>
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
