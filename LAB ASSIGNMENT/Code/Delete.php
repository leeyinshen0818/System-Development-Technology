<?php

    include("db_connection.php");

    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $sql = "DELETE FROM students WHERE id='$id' " ;
        $result = mysqli_query($conn, $sql) ;


        if($result){
            echo "<script>alert('User Deleted Successfully'); window.location='StudentList.php'</script>" ;
        }else{
            echo "<script>alert('User Not Deleted'); window.location='StudentList.php'</script>" ;
        }

    }
?>