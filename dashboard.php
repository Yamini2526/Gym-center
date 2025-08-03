<?php
include './php/dbcon.php';
session_start();
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: ./login.html");
    exit();
}
if (!isset($_SESSION['username'])) {
    header("Location: ./login.html");
    exit();
}
$id = $_SESSION['id'];
$username=$_SESSION['username'];
$user=$_SESSION['user'];
$sql="select * from $user where username ='$username'";
$res = mysqli_query($con, $sql);
$email=$_SESSION['email']=mysqli_fetch_assoc($res)['email'];
$sql = "select * from addition_info where id = '$id'";
$res = mysqli_query($con, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Gym Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .profile-pic {
            width: 70px;
            height: 70px;
            cursor: pointer;
            border: 2px solid white;
        }

        .card-custom {
            background-color: rgba(0, 0, 0, 0.6);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            color: white;
        }

        body {
            background-image: url('./images/dashboardbg.jpeg');
            background-size: cover;
            background-repeat: no-repeat;
            height: 100vh;
        }
    </style>
</head>

<body>
    <?php
    if (!$res || mysqli_num_rows($res) == 0) {
        echo ('<div class="container1 position-absolute top-0 start-0 z-3 w-100 bg-light border rounded p-2">
                <div class="container">
                    <h2 class="text-center">Personal Details</h2>
                </div>
                <form action="./php/additionalInfo.php" method="post" class="was-validated" id="additionalInfoForm">
                    <h2 class="text-white d-flex justify-content-center rounded-bottom">Additiona Information</h2>
                    <div class="mb-3">
                        <label for="firstname" class="form-label">First name</label>
                        <input type="text" class="form-control" name="firstname" id="firstname"
                            placeholder="Enter First name" required>
                    </div>
                    <div class="mb-3">
                        <label for="lastname" class="form-label">Last name</label>
                        <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Enter Last name"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="phno" class="form-label">Phone number</label>
                        <input type="number" class="form-control" name="phno" id="phno" placeholder="Enter phone number"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="dob" class="form-label">Date of birth</label>
                        <input type="date" class="form-control" name="dob" id="dob" placeholder="Enter your Date of Birth"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="currentweight" class="form-label">Current weight</label>
                        <input type="number" class="form-control" name="currentweight" id="currentweight"
                            placeholder="Enter your current weight" required>
                    </div>
                    <div class="mb-3">
                        <label for="height" class="form-label">Height :</label>
                        <input type="number" class="form-control" name="height" id="height"
                            placeholder="Enter your height" required>
                    </div>
                    <div class="mb-3">
                        <label for="GoalWeight" class="form-label">Goal Weight :</label>
                        <input type="number" class="form-control" name="GoalWeight" id="GoalWeight"
                            placeholder="Enter your goal weight " required>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-success" name="submit">Submit</button>
                    </div>
                </form>
            </div>');
    } else {
        $row=mysqli_fetch_assoc($res); 
        $fname=$row['firstname'];
        $lname=$row['lastname'];
        $phno=$_SESSION['phno']=$row['phno'];
        $date_of_birth=$_SESSION['dob']=$row['dob'];
        $cur_weight=$_SESSION['cur_weight']=$row['cur_weight'];
        $height=$_SESSION['height']=$row['height'];
        $GWieght=$_SESSION['goal_weight']=$row['goal_weight'];
        $dob = new DateTime($date_of_birth);
        $today = new DateTime(); // Get the current date
        $age = $_SESSION['age']=$dob->diff($today)->y;
        $heightInMeters = $height * 0.3048;
        $bmi = $cur_weight / ($heightInMeters * $heightInMeters);
        $profilPicPath=$_SESSION['profile_path']=$row['profile_path'];
    echo('<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="profileModalLabel">Profile Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <div class="position-relative d-inline-block">
                        <img src="'.$profilPicPath.'" id="modalProfilePic" class="img-fluid mb-3" width="100" height="100" alt="Profile">

                        <span class="edit-icon position-absolute top-50 start-50 translate-middle w-50 h-50 p-2 d-none">
                            <i class="bi bi-pencil"></i>
                        </span>
                    </div>

                    <h5 id="modalUserName">'.$username.'</h5>
                    <p class="text-muted" id="modalUserEmail">'.$email.'</p>

                    <div class="text-start px-4">
                        <p><strong>Username:</strong> <span id="modalUserUsername">'.$username.'</span></p>
                        <p><strong>Date of Birth:</strong> <span id="modalUserDOB">'.$date_of_birth.'</span></p>
                        <p><strong>Phone Number:</strong> <span id="modalUserPhone">'.$phno.'</span></p>
                        <p><strong>Height:</strong> <span id="modalUserHeight">'.$height.'</span></p>
                        <p><strong>Weight:</strong> <span id="modalUserWeight">'.$cur_weight.' kg</span></p>
                    </div>
                    <form action="" method="post">
                        <button class="btn btn-outline-danger mt-3 w-100" name="logout">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container main-content">
        <img src="'.$profilPicPath.'" class="img-fluid rounded-circle profile-pic ms-3 p-1 mx-3" alt="Profile" data-bs-toggle="modal" data-bs-target="#profileModal">

        <a class="navbar-brand fs-2" href="#">GetFit</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="workout.php">Workouts</a></li>
                <li class="nav-item"><a class="nav-link" href="progress.php">Progress</a></li>
                <li class="nav-item"><a class="nav-link" href="booking.html">Bookings</a></li>
                <li class="nav-item"><a class="nav-link" href="diet.html">Diet plans</a></li>
                <li class="nav-item"><a class="nav-link" href="about1.html">About</a></li>
            </ul>
        </div>
    </div>
    </nav>
    <div class="container mt-5">
        <h2 class="text-center text-light">Welcome, <span id="userName">'.$username.'</span>!</h2>
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card card-custom p-3">
                    <h5 class="text-light">Personal Details</h5>
                    <p><strong>Age:</strong> <span id="userAge">'.$age.'</span></p>
                    <p><strong>Weight:</strong> <span id="userWeight">'.$cur_weight.'</span></p>
                    <p><strong>Height:</strong> <span id="userHeight">'.$height.'</span></p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-custom p-3">
                    <h5 class="text-light">Fitness Statistics</h5>
                    <p><strong>BMI:</strong> <span id="userBMI">'.$bmi.'</span></p>
                    <p><strong>Calories Burned:</strong> </p>
                    <p><strong>Steps Taken:</strong> 10,000 steps</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-custom p-3">
                    <h5 class="text-light">Upcoming Workouts</h5>
                    <p><strong>Next Session:</strong> 14th March, 6:00 PM</p>
                    <p><strong>Trainer:</strong> Alex Smith</p>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center mt-4">
            <a href="#" class="btn btn-warning me-3">Update Fitness Progress</a>
            <a href="#" class="btn btn-info">Book a Workout Session</a>
        </div>
    </div>');
        }
            ?>
            <!-- Add this modal for image upload -->
<div class="modal fade" id="uploadImageModal" tabindex="-1" aria-labelledby="uploadImageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadImageModalLabel">Upload New Profile Picture</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="uploadImageForm" action="./php/uploadProfilePicture.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="profileImage" class="form-label">Choose Image</label>
                        <input type="file" class="form-control" name="profileImage" id="profileImage" accept="image/*" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const profilePic = document.getElementById("modalProfilePic");
        const editIcon = document.querySelector(".edit-icon");

        profilePic.addEventListener("mouseenter", function() {
            editIcon.classList.remove("d-none");
        });
        editIcon.addEventListener("mouseenter", function() {
            editIcon.classList.remove("d-none");
        });

        profilePic.addEventListener("mouseleave", function() {
            editIcon.classList.add("d-none");
        });

        editIcon.addEventListener("click", function() {
            // Open the upload image modal
            const uploadImageModal = new bootstrap.Modal(document.getElementById('uploadImageModal'));
            uploadImageModal.show();
        });
    });
</script>

<!-- JavaScript for Hover Effect -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const profilePic = document.getElementById("modalProfilePic");
        const editIcon = document.querySelector(".edit-icon");

        profilePic.addEventListener("mouseenter", function() {
            editIcon.classList.remove("d-none");
        });
        editIcon.addEventListener("mouseenter", function() {
            editIcon.classList.remove("d-none");
        });

        profilePic.addEventListener("mouseleave", function() {
            editIcon.classList.add("d-none");
        });

    });

    function addProfile() {
        alert("Add Profile clicked!");
        // Logic to add profile
    }
</script>
</body>

</html>