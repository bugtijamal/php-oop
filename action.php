<?php
include_once "users.php";
$tablename ="registration";

$db = new User();

if(isset($_POST['submit'])){
    if($_POST['confirm'] !== $_POST['password']){
        $messages = " Password must match!";
        $_SESSION['messages'] = $messages;
        header('Location:regiter.php');
        exit();
    }
   $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
   $userData = array(
       'name' => $_POST['name'],
       'username' => $_POST['username'],
       'email' => $_POST['email'],
       'password' => $hashed_password
   );
  $insert = $db->insert($tablename, $userData);

  $messages = $insert?"Thank you for registering ":"There is some problems";
  $_SESSION['messages'] = $messages;
  header('Location:index.php');
}

elseif(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $login = $db->login($tablename, $email, $password);
    if($login){
        header("Location:index.php");
    }
}   