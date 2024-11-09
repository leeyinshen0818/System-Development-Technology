<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
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
                        <a class="nav-link active" aria-current="page" href="StudentList.php">Student List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="AddStudent.php">Add Student</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-2">
        <h2 class="display-5 text-center">Student List</h2>

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-sm">
                <thead class="table-dark text-center">
                    <tr>
                        <th scope="col" class="text-decoration-underline">ID</th>
                        <th scope="col" class="text-decoration-underline">Name</th>
                        <th scope="col" class="text-decoration-underline">Email</th>
                        <th scope="col" class="text-decoration-underline">StudentID</th>
                        <th scope="col" class="text-decoration-underline">Registration Date</th>
                        <th scope="col" class="text-decoration-underline">Course</th>
                        <th scope="col" class="text-decoration-underline">Status</th>
                        <th scope="col" class="text-decoration-underline">Edit</th>
                        <th scope="col" class="text-decoration-underline">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include("db_connection.php");

                        $sql = "SELECT * FROM students";
                        $result = mysqli_query($conn, $sql);

                        if(mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td class='text-center'>".$row['id']."</td>";
                                echo "<td>".$row['name']."</td>";
                                echo "<td>".$row['email']."</td>";
                                echo "<td>".$row['studentID']."</td>";
                                echo "<td>".$row['registered_date']."</td>";
                                echo "<td>".$row['course']."</td>";
                                echo "<td>".($row['is_active'] ? "<span class='text-success'>Active</span>" : "<span class='text-danger'>Inactive</span>")."</td>";
                                echo "<td class='text-center'><a href='Update.php?id=".$row['id']."' class='btn btn-warning btn-sm'>Edit</a></td>";
                                echo "<td class='text-center'><button class='btn btn-danger btn-sm' onclick='confirmDelete(".$row['id'].")'>Delete</button></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='9' class='text-center'>No Data Found</td></tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="text-center mt-4">
            <a href="AddStudent.php" class="btn btn-success">Add New Student</a>
        </div>
    </div>

    <!--Delete Confirmation Modal-->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this student?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a id="confirmDeleteBtn" href="#" class="btn btn-danger">Delete</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script>
        function confirmDelete(studentId){
            var deleteUrl = 'Delete.php?id=' + studentId;
            document.getElementById('confirmDeleteBtn').setAttribute('href', deleteUrl);
            var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            deleteModal.show();
        }
    </script>

</body>

</html>
