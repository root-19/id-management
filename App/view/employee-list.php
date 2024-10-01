<?php
session_start(); 
include('../config/config.php');

// Check if user_id is set in the session
if (!isset($_SESSION['user_id'])) {
    echo "<script>
            alert('User not logged in.');
            window.location.href = '../login.php';
        </script>";
    exit();
}

// Create a new instance of the Database class
$database = new Database();
$pdo = $database->getConnection();
include "../model/header.php";

// Fetch student data
$stmt = $pdo->prepare("SELECT * FROM employee_list");
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Link to Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="main">
    <div class="student-container">
        <div class="student-list">
            <div class="title">
                <h4>List of employee</h4>
                <button class="btn btn-dark" data-toggle="modal" data-target="#addStudentModal">Add employee</button>
            </div>
            <hr>
            <div class="table-container table-responsive">
                <table class="table text-center table-sm" id="studentTable">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Code</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            foreach ($result as $row) {
                                $studentID = $row["tbl_student_id"];
                                $studentName = $row["student_name"];
                                $studentCourse = $row["course_section"];
                                $qrCode = $row["generated_code"];
                        ?>
                        <tr>
                            <th scope="row" id="studentID-<?= htmlspecialchars($studentID) ?>"><?= htmlspecialchars($studentID) ?></th>
                            <td id="studentName-<?= htmlspecialchars($studentID) ?>"><?= htmlspecialchars($studentName) ?></td>
                            <td id="studentCourse-<?= htmlspecialchars($studentID) ?>"><?= htmlspecialchars($studentCourse) ?></td>
                            <td>
                                <div class="action-button">
                                    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#qrCodeModal<?= htmlspecialchars($studentID) ?>">
                                        <img src="https://cdn-icons-png.flaticon.com/512/1341/1341632.png" alt="" width="16">
                                    </button>

                                    <!-- QR Modal -->
                                    <div class="modal fade" id="qrCodeModal<?= htmlspecialchars($studentID) ?>" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"><?= htmlspecialchars($studentName) ?>'s QR Code</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?= urlencode($qrCode) ?>" alt="" style="display: block; margin: 0 auto;" width="300">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-secondary btn-sm" onclick="updateStudent(<?= htmlspecialchars($studentID) ?>)">&#128393;</button>
                                    <button class="btn btn-danger btn-sm" onclick="deleteStudent(<?= htmlspecialchars($studentID) ?>)">&#10006;</button>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addStudentModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="addStudent" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- Change to modal-lg for a larger modal -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addStudent">Add Student</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="./function/employee-form.php" method="POST">
                    <div class="row"> <!-- Use Bootstrap grid system -->
                        <div class="col-md-6"> <!-- Left column -->
                            <div class="form-group">
                                <label for="region">Region:</label>
                                <input type="text" class="form-control" id="region" name="region" required>
                            </div>
                            <div class="form-group">
                                <label for="code">Code:</label>
                                <input type="text" class="form-control" id="code" name="code" required>
                            </div>
                            <div class="form-group">
                                <label for="location">Location:</label>
                                <input type="text" class="form-control" id="location" name="location" required>
                            </div>
                            <div class="form-group">
                                <label for="province">Province:</label>
                                <input type="text" class="form-control" id="province" name="province" required>
                            </div>
                            <div class="form-group">
                                <label for="cityMunicipality">City/Municipality:</label>
                                <input type="text" class="form-control" id="cityMunicipality" name="city_municipality" required>
                            </div>
                            <div class="form-group">
                                <label for="cityMunicipalProvinceLeader">City/Municipal Province Leader:</label>
                                <input type="text" class="form-control" id="cityMunicipalProvinceLeader" name="city_municipal_province_leader" required>
                            </div>
                        </div>
                        <div class="col-md-6"> <!-- Right column -->
                            <div class="form-group">
                                <label for="name">Full Name:</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="address">Address:</label>
                                <input type="text" class="form-control" id="address" name="address" required>
                            </div>
                            <div class="form-group">
                                <label for="mobileNumber">Mobile Number:</label>
                                <input type="text" class="form-control" id="mobileNumber" name="mobile_number" required>
                            </div>
                            <div class="form-group">
                                <label for="emailAddress">Email Address:</label>
                                <input type="email" class="form-control" id="emailAddress" name="email_address" required>
                            </div>
                            <div class="form-group">
                                <label for="birthday">Birthday:</label>
                                <input type="date" class="form-control" id="birthday" name="birthday" required>
                            </div>
                            <div class="form-group">
                                <label for="sex">Sex:</label>
                                <select class="form-control" id="sex" name="sex" required>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row"> <!-- Additional fields can go in a new row -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="civilStatus">Civil Status:</label>
                                <select class="form-control" id="civilStatus" name="civil_status" required>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Divorced">Divorced</option>
                                    <option value="Widowed">Widowed</option>
                                    <option value="Separated">Separated</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="occupation">Occupation:</label>
                                <input type="text" class="form-control" id="occupation" name="occupation" required>
                            </div>
                            <div class="form-group">
                                <label for="socialMedia">Social Media:</label>
                                <input type="text" class="form-control" id="socialMedia" name="social_media">
                            </div>
                            <div class="form-group">
                                <label for="precinctNumber">Precinct Number:</label>
                                <input type="text" class="form-control" id="precinctNumber" name="precinct_number">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="memberStatus">Member Status:</label>
                                <select class="form-control" id="memberStatus" name="member_status" required>
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                    <option value="Pending">Pending</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="validID">Valid ID:</label>
                                <input type="text" class="form-control" id="validID" name="valid_id" required>
                            </div>
                            <div class="form-group">
                                <label for="lastDataPrivacy">Last Data Privacy:</label>
                                <input type="date" class="form-control" id="lastDataPrivacy" name="last_data_privacy" required>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary form-control qr-generator" onclick="generateQrCode()">Generate QR Code</button>

                    <div class="qr-con text-center" style="display: none;">
                        <input type="hidden" class="form-control" id="generatedCode" name="generated_code">
                        <p>Take a pic with your QR code.</p>
                        <div class="row">
                            <div class="col-md-6 border border  rounded">

                            <div class="id-card front bg-gray-200">
    <img src="your-image-path.jpg" class="ml-10" alt="Profile Image" /> <p>Name: <span id="cardName">John Doe</span></p>
    <p>Contact: <span id="cardContact">123-456-7890</span></p>
    <p>Address: <span id="cardAddress">123 Main St, City</span></p>
    <p>Code: <span id="cardCode">XYZ123</span></p>
  </div>
                            </div>
                            <div class="col-md-6">
                                <div class="id-card back border border  rounded">
                                    <h5>ID Card Back</h5>
                                    <div class="qr-code">
                                        <img id="qrImg" src="https://via.placeholder.com/100" alt="QR Code" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer modal-close" style="display: none;">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-dark">Add Student</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- QR Code generation script -->
<script>
function toggleCard() {
    const card = $('.id-card');
    card.toggleClass('show-back');
}

function generateQrCode() {
    // Capture values from all input fields
    const region = $('#region').val();
    const code = $('#code').val();
    const location = $('#location').val();
    const province = $('#province').val();
    const cityMunicipality = $('#cityMunicipality').val();
    const cityMunicipalProvinceLeader = $('#cityMunicipalProvinceLeader').val();
    const name = $('#name').val();
    const address = $('#address').val();
    const mobileNumber = $('#mobileNumber').val();
    const emailAddress = $('#emailAddress').val();
    const birthday = $('#birthday').val();
    const sex = $('#sex').val();
    const civilStatus = $('#civilStatus').val();
    const occupation = $('#occupation').val();
    const socialMedia = $('#socialMedia').val();
    const precinctNumber = $('#precinctNumber').val();
    const memberStatus = $('#memberStatus').val();
    const validID = $('#validID').val();
    const lastDataPrivacy = $('#lastDataPrivacy').val();

    // Assuming you have a method to generate QR Code based on the data
    const generatedCode = `${name}|${mobileNumber}|${emailAddress}`; // customize as needed
    $('#generatedCode').val(generatedCode);

    $('#cardName').text(name);
    $('#cardContact').text(mobileNumber);
    $('#cardAddress').text(address);
    $('#cardCode').text(generatedCode);
    
    $('#qrImg').attr('src', 'https://api.qrserver.com/v1/create-qr-code/?data=' + encodeURIComponent(generatedCode) + '&size=100x100');

    $('.qr-con').show();
    $('.modal-footer').show(); // Show the modal footer when QR Code is generated
}
</script>

