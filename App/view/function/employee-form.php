<?php
session_start();
include('../../config/Config.php'); // Include the database configuration file

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<script>
            alert('User not logged in.');
            window.location.href = 'login.php';
        </script>";
    exit();
}

// Create a new instance of the Database class
$database = new Database();
$pdo = $database->getConnection();

// Prepare the SQL statement to insert employee data
$sql = "INSERT INTO employee_list (region, code, location, province, city_municipality, city_municipal_province_leader, student_name, address, mobile_number, email_address, birthday, sex, civil_status, occupation, social_media, precinct_number, member_status, valid_id, last_data_privacy, generated_code)
VALUES (:region, :code, :location, :province, :city_municipality, :city_municipal_province_leader, :name, :address, :mobile_number, :email_address, :birthday, :sex, :civil_status, :occupation, :social_media, :precinct_number, :member_status, :valid_id, :last_data_privacy, :generated_code)";

$stmt = $pdo->prepare($sql);

// Bind parameters
$stmt->bindParam(':region', $_POST['region']);
$stmt->bindParam(':code', $_POST['code']);
$stmt->bindParam(':location', $_POST['location']);
$stmt->bindParam(':province', $_POST['province']);
$stmt->bindParam(':city_municipality', $_POST['city_municipality']);
$stmt->bindParam(':city_municipal_province_leader', $_POST['city_municipal_province_leader']);
$stmt->bindParam(':name', $_POST['name']);
$stmt->bindParam(':address', $_POST['address']);
$stmt->bindParam(':mobile_number', $_POST['mobile_number']);
$stmt->bindParam(':email_address', $_POST['email_address']);
$stmt->bindParam(':birthday', $_POST['birthday']);
$stmt->bindParam(':sex', $_POST['sex']);
$stmt->bindParam(':civil_status', $_POST['civil_status']);
$stmt->bindParam(':occupation', $_POST['occupation']);
$stmt->bindParam(':social_media', $_POST['social_media']);
$stmt->bindParam(':precinct_number', $_POST['precinct_number']);
$stmt->bindParam(':member_status', $_POST['member_status']);
$stmt->bindParam(':valid_id', $_POST['valid_id']);
$stmt->bindParam(':last_data_privacy', $_POST['last_data_privacy']);
$stmt->bindParam(':generated_code', $_POST['generated_code']); // Assuming you're generating the code in the frontend

// Execute the statement
if ($stmt->execute()) {
    echo "<script>
            alert('Employee added successfully.');
            window.location.href = 'employee-list.php'; // Redirect to your employee list page
        </script>";
} else {
    echo "<script>
            alert('Error adding employee. Please try again.');
            window.location.href = 'employee-list.php'; // Redirect to your employee list page
        </script>";
}
?>
