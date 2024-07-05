<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="details.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Done Users</title>
</head>
<body>

    <div class="background-image"></div>

    <div class="header">
        <div class="logo-container">
            <a href="#" class="logo">
                <img src="mcfa_logo.png" alt="Airplane Logo" class="logo-image">
            </a>
            <a href="#default" class="title">Mabalacat City Foreign Affairs</a>
        </div>
        <div class="header-right">
            <a class="home" href="/landing_page/landing_page.html">Home</a>
            <a class="appointment" href="/appointment_form/index.html">Appointment</a>
            <a class="Admin" href="/admin/Admin.php">Admin</a>
            <a class="done-users" href="/admin/done_users.php">Done Users</a>
        </div>
    </div>

    <div class="container">
        <?php
        // Include database connection or any necessary setup
        include 'db_connect.php';

        // Check if ID parameter exists in the URL
        if (isset($_GET['id'])) {
            // Sanitize input to prevent SQL injection (you can use prepared statements for security)
            $user_id = htmlspecialchars($_GET['id']);

            // Query to fetch user details based on ID
            $sql = "SELECT * FROM users WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();

                // Display user details in a table format
                echo "<h2>User Details</h2>";
                echo "<div class='user-details'>";
                echo "<table>";
                echo "<tr><th>ID</th><td>{$user['id']}</td></tr>";
                echo "<tr><th>First Name</th><td>{$user['first_name']}</td></tr>";
                echo "<tr><th>Last Name</th><td>{$user['last_name']}</td></tr>";
                echo "<tr><th>Email</th><td>{$user['email']}</td></tr>";
                // Add more fields as needed
                echo "</table>";
                echo "</div>";
            } else {
                echo "<p>User not found</p>";
            }

            // Close statement and connection
            $stmt->close();
            $conn->close();
        } else {
            echo "<p>User ID not provided</p>";
        }
        ?>
        
        <div class="back-button">
            <a href="javascript:history.back()">Back</a>
        </div>
    </div>

    <script src="admin.js"></script>
</body>
</html>
