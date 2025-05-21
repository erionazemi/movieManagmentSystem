<?php

include_once("config.php");

if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = password_hash($temPass, PASSWORD_DEFAULT);

    
    if(empty($name) || empty($surname) || empty($username) || empty($email) || empty($password)){
        echo "you need to fill the fields";
    }else{
        $sql = "SELECT username from users where username=:username";

        $tempSQL = $conn ->prepare($sql);
        $tempSQL->bindParam(":username", $usernamename);
        $tempSQL->execute();
    
    if($tempSQL->rowCount() > 0){
        echo"username exists";
        header("refresh:2; url=signup.php");
    }
    else{
        $sql = "INSERT INTO users (name, surname, username, email, password) VALUES (:name, :surname, :username, :email, :password)";
        $insertSQL = $conn -> prepare($sql);

        $insertSQL->bindParam(":name", $name);
         $insertSQL->bindParam(":surname", $surname);
       $insertSQL->bindParam(":username", $username);
       $insertSQL->bindParam(":email", $email);
       $insertSQL->bindParam(":password", $password);


       $insertSQL->execute();
       echo "user created";
       header("refresh:2, url=login.php");
     }
    }
  }

?>