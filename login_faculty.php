<?php
    include 'dbcon.php';
    session_start();
    if(!$con){
        echo("Error bro");
    }
    if(isset($_POST['submit'])){
        $username=$_POST['username'];
        $pswd=$_POST['facultyPassword'];
        $sql="select password from faculty where Username='$username'";
        $res=mysqli_query($con,$sql);
        echo("hi");
        if(!$res){
            echo("username not found");
        }
        else{
            $row=mysqli_fetch_assoc($res);
            $dbpswd=$row['password'];
            if(password_verify($pswd,$dbpswd)){
            echo('bye');
                $_SESSION['username']=$username;
                $_SESSION['pswd']=$pswd;
                $_SESSION['id']=$row['faculty_id'];
                $_SESSION['user']='faculty';
                header("location:../dashboard.php");
            }
        }
    }
    else{

        echo("its not joke brother");
    }
?>