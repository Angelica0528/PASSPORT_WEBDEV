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
            <a class="home" href="#">Home</a>
            <a class="appointment" href="/appointment_form/appointment.html">Appointment</a>
            <a class="Admin" href="/Admin.html">Admin</a>
        </div>
    </div>

    <div class="TB">
    <section>
        
        <h1>Schedule Details</h1>
        <hr>
        <?php
    include "config.php";
    $query = "SELECT id, CONCAT(first_name, ' ', middle_name, ' ', last_name) AS full_name, email, mobile_number, date_time FROM users";

    echo '<table border="1" cellspacing="2" cellpadding="2" style="background-color: #fff;"> 
      <tr> 
          <th>ID</th> 
          <th>Name</th> 
          <th>Email</th> 
          <th>Mobile Number</th> 
          <th>Created Date</th>  
         
      </tr>';

    if ($result = $conn->query($query)) {
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
        $result->free();
    } 
    ?>

         
   
    </section>
    </div>

</body>
</html>
