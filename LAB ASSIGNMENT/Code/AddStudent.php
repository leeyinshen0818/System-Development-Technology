<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="StudentList.php">UTM STUDENT REGISTRATION SYSTEM</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link "  href="StudentList.php">Student List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="AddStudent.php">Add Student</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-2"> 
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <h2 class="mb-4 text-center">Add Student</h2>
                <form action="AddStudent.php" method="POST" class="p-4 border rounded shadow-sm">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="studentID" class="form-label">Student ID:</label>
                        <input type="text" id="studentID" name="studentID" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="register_date" class="form-label">Registration Date:</label>
                        <input type="date" id="register_date" name="register_date" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="course" class="form-label">Course:</label>
                        <select name="course" id="course" class="form-select">
                            <option value="Data Engineering">Data Engineering</option>
                            <option value="Software Engineering">Software Engineering</option>
                            <option value="Graphical Design">Graphical Design</option>
                            <option value="Bioinformatic">Bio Informatics</option>
                            <option value="Network Security">Network Security</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Student Status:</label><br>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="status" id="active" value="1" class="form-check-input">
                            <label for="active" class="form-check-label">Active</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="status" id="not_active" value="0" class="form-check-input">
                            <label for="not_active" class="form-check-label">Not Active</label>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form>

                <div class="text-center mt-4">
                    <a href="StudentList.php" class="btn btn-link">Back to Student List</a>
                </div>

            </div>
        </div>
    </div>

    <!--Modal for status message-->
    <div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="statusModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalMessage"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>

<?php
include("db_connection.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $studentID = $_POST['studentID'];
    $register_date = $_POST['register_date'];
    $course = $_POST['course'];
    $status = $_POST['status'];
    $success = true;

    $sql = "INSERT INTO students (name, email, studentID, registered_date, course, is_active) VALUES ('$name', '$email', '$studentID', '$register_date', '$course', '$status')" ;

    if (mysqli_query($conn, $sql)) {
        $title = "Success!";
        $message = "Student added successfully.";
    } else {
        $title = "Warning!";
        $message = "Student addition unsuccessful.";
    }

    //JavaScript to trigger the modal with the message
    echo "
    <script>
        document.getElementById('statusModalLabel').innerText = '$title';
        document.getElementById('modalMessage').innerText = '$message';
        var myModal = new bootstrap.Modal(document.getElementById('statusModal'));
        myModal.show();
    </script>";

}

?>