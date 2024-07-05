<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="done_users.css">
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
            <a class="Admin" href="/admin_view/admin_view.php">Admin</a>
            <a class="done-users" href="/admin/done_users.php">Done Users</a>
        </div>
    </div>

    <?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include 'db_connect.php';

    // Fetch all records marked as done
    $sql = "SELECT * FROM users WHERE status = 'done' ORDER BY date_time DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>Appointment ID</th>
                    <th>Site</th>
                    <th>Date and Time</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Middle Name</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['site']}</td>
                    <td>{$row['date_time']}</td>
                    <td>{$row['first_name']}</td>
                    <td>{$row['last_name']}</td>
                    <td>{$row['middle_name']}</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "No records found";
    }

    $conn->close();
    ?>

    <script src="admin.js"></script>

</body>
</html>
