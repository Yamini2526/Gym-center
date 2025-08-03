<?php
    include 'dbcon.php';
    session_start();
    if(!$con){
        echo("Error bro");
    }
    if(isset($_POST['submit'])){
        $date=new DateTime();
        $dateString = $date->format('Y-m-d H:i:s'); 
        $weight=$_POST['weight'];
        $WorkoutDetails=$_POST['workouts'];
        $CaloriesBurned=$_POST['calories'];
        $sql="insert into progress values ('$dateString','$weight','$WorkoutDetails','$CaloriesBurned')";
        $res=mysqli_query($con,$sql);
        if(!$res){
            echo("Error");
        }
        else{
            echo("Inserted");
        }
    }
    else{

        echo("its not joke brother");
    }
?>
