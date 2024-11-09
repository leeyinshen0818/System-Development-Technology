<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="">UTM STUDENT REGISTRATION SYSTEM</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="register.php">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <div class="row justify-content-center ">
            <div class="col-md-6 col-lg-5">

                <h2 class="text-center mb-4">Register</h2>
                <form action="register.php" method="POST" class="p-4 border ">
                    <label for="username">Username: </label>
                    <input type="text" id="username" name="username" class="form-control" required> <br><br>

                    <label for="password">Password: </label>
                    <input type="password" id="password" name="password" class="form-control" required> <br><br>
                    
                    <input type="submit" value="Register" class="btn btn-primary w-100">

                </form>

                <div class="text-center">
                    <a href="login.php">Already have an account? Login here</a>
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
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $success = true ;

    $sql = "INSERT INTO student_reg (username, password) VALUES ('$username', '$password')" ;

    if (mysqli_query($conn, $sql)) {
        $title = "Success!";
        $message = "Registration successful.";
    } else {
        $title = "Warning!";
        $message = "Registration unsuccessful.";
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