<link rel="stylesheet" href="admin.css">

<h1>Passport Scheduling System</h1>

<?php


    include "submit_registration.php";
        $query="SELECT * FROM users";

    echo '<table>
    <tr>
         <th scope="col">#</th>
         <th scope="col">Name</th>
         <th scope="col">Email</th>
         <th scope="col">Mobile Number</th>
            <th scope="col">Created Date</th>
         <th scope="col">Action</th>
    </tr>';

    if ($result = $conn->query($query)){
        while ($row = $result->fetch_assoc()) {

            $id = $row["id"];
            $full_name = $row["full_name"];
            $email = $row["email"];
            $mobile_no = $row["mobile_no"];
            $date_created = $row["date_created"];

    
            echo '<tr>
                <td>'.$id.'</td>
                <td>'.$full_name.'</td>
                <td>'.$email.'</td>
                <td>'.$mobile_no.'</td>
                <td> '.$date_created.'</td>
            </tr>';
            
        }
        $result->free();
    }

?>
