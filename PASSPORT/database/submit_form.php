<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch all form data
    $site = $_POST['site'];
    $date_time = $_POST['date_time'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $middle_name = $_POST['middle_name'];
    $birth_date = $_POST['birth_date'];
    $gender = $_POST['gender'];
    $mobile_number = $_POST['mobile_number'];
    $email = $_POST['email'];
    $civil_status = $_POST['civil_status'];
    $province = $_POST['province'];
    $barangay = $_POST['barangay'];
    $city = $_POST['city'];
    $zip_code = $_POST['zip_code'];
    $country = $_POST['country'];
    $permanent_address = $_POST['permanent_address'];
    $father_name = $_POST['father_name'];
    $mother_name = $_POST['mother_name'];
    $spouse_name = $_POST['spouse_name'];
    $application_type = $_POST['application_type'];
    $emergency_contact = $_POST['emergency_contact'];
    $emergency_mobile_no = $_POST['emergency_mobile_no'];

    // Prepare SQL query
    $sql = "INSERT INTO users(site, date_time, first_name, last_name, middle_name, birth_date, gender, mobile_number, email, civil_status, province, barangay, city, zip_code, country, permanent_address, father_name, mother_name, spouse_name, application_type, emergency_contact, emergency_mobile_no)
            VALUES ('$site', '$date_time', '$first_name', '$last_name', '$middle_name', '$birth_date', '$gender', '$mobile_number', '$email', '$civil_status', '$province', '$barangay', '$city', '$zip_code', '$country', '$permanent_address', '$father_name', '$mother_name', '$spouse_name', '$application_type', '$emergency_contact', '$emergency_mobile_no')";

    // Execute SQL query
    if ($conn->query($sql) === TRUE) {
        // Retrieve the newly inserted ID
        $last_id = $conn->insert_id;

        // Redirect to the confirmation page with appointment ID as a query parameter
        header("Location: /confirmation/confirmation.php?id=$last_id");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
