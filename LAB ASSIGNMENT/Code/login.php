<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>

<body>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">

            <h2 class="text-center mb-4">Login</h2>
            <form action="login.php" method="POST" class="p-4 border">
                <label for="username">Username: </label>
                <input type="text" id="username" name="username" class="form-control"> <br><br>

                <label for="password">Password: </label>
                <input type="password" id="password" name="password" class="form-control"> <br><br>
                
                <input type="submit" value="Login" class="btn btn-primary w-100">

            </form>

            <div class="text-center">
                <a href="register.php">Don't have an account? Register here</a>
            </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
        </div>
    </div>
</div>

</body>

</html>

<?php
session_start();//start session
include("db_connection.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM student_reg WHERE username = '$username'" ;
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row['password'])){
            $_SESSION['username'] = $username;
            header("Location: Studentlist.php");
        }else{  
            echo "Password is incorrect";
        }
    }else{
        echo "Username is incorrect";
    }
}
?>
