<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="view_appointment.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <title>User Appointments</title>
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
            <a class="appointment" href="/appointment_form/appointment.html">Appointment</a>
            <a class="Admin" href="/admin/Admin.html">Admin</a>
        </div>
    </div>

    <div class="TB">
    <section>
        
    <h1>Appointment Details</h1>
       
        <?php
        include "config.php";

        $appointment_id = isset($_POST["appointment_id"]) ? $_POST["appointment_id"] : '';
        $email = isset($_POST["email"]) ? $_POST["email"] : '';

        if (!empty($appointment_id) && !empty($email)) {
            $query = "SELECT id, CONCAT(first_name, ' ', middle_name, ' ', last_name) AS full_name, email, mobile_number, date_time FROM users WHERE id = ? AND email = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("is", $appointment_id, $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo '<table border="1" cellspacing="2" cellpadding="2" style="background-color: #fff;"> 
                    <tr> 
                        <th>ID</th> 
                        <th>Name</th> 
                        <th>Email</th> 
                        <th>Mobile Number</th> 
                        <th>Appointment Date</th>  
                    </tr>';

                while ($row = $result->fetch_assoc()) {
                    $id = $row["id"];
                    $full_name = $row["full_name"];
                    $email = $row["email"];
                    $mobile_number = $row["mobile_number"];
                    $date_time = $row["date_time"];

                    echo '<tr> 
                            <td>'.$id.'</td> 
                            <td>'.$full_name.'</td> 
                            <td>'.$email.'</td> 
                            <td>'.$mobile_number.'</td> 
                            <td>'.$date_time.'</td> 
                        </tr>';
                }

                echo '</table>';
            } else {
                echo 'No appointment found with the provided ID and email.';
            }

            $stmt->close();
        } else {
            // Display the form if appointment ID and email are not submitted
            echo '<form method="POST">
                    <input type="text" id="appointment_id" placeholder="Enter Appointment ID" name="appointment_id" required>
                    <input type="email" id="email" placeholder="Enter Email" name="email" required>
                    <button type="submit">View Appointment</button>
                  </form>';
        }
        ?>
   
    </section>
    </div>
    <script src="admin.js"></script>

</body>
</html>
