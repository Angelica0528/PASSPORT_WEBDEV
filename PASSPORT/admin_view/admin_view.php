<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin_view.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Passport Admin</title>
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
            <a class="Admin" href="/admin/Admin.html">Admin</a>
        </div>
    </div>

    <?php
    include 'db_connect.php';

    $sql = "SELECT * FROM users ORDER BY date_time DESC";
    $result = $conn->query($sql);

    if ($result === false) {
        die("Error in query: " . $conn->error);
    }

    if ($result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>Appointment ID</th>
                    <th>Site</th>
                    <th>Date and Time</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Middle Name</th>
                    <th>Action</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            $status = $row['status'] === 'done' ? 'disabled' : '';
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['site']}</td>
                    <td>{$row['date_time']}</td>
                    <td>{$row['first_name']}</td>
                    <td>{$row['last_name']}</td>
                    <td>{$row['middle_name']}</td>
                    <td>
                        <a href='delete_record.php?id={$row['id']}' onclick='return confirm(\"Are you sure you want to delete this record?\")'>
                            <i class='fas fa-trash' style='color:red;'></i>
                        </a>
                        <a href='done_record.php?id={$row['id']}' onclick='return confirm(\"Are you sure you want to mark this record as done?\")' $status>
                            <i class='fas fa-check' style='color:green;'></i>
                        </a>
                        <a href='details.php?id={$row['id']}'>
                            <i class='fas fa-info-circle' style='color:blue;'></i>
                        </a>
                    </td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "No records found";
    }

    $conn->close();
    ?>

    <!-- Button to view done users -->
    <div class="done-users-button">
        <a href="done_users.php">
            <button type="button">View Done Users</button>
        </a>
    </div>

    <script src="admin.js"></script>

</body>
</html>
