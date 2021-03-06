<?php
session_start();
 include_once 'users.php';
 $db = new User();
 
 if(!empty($_SESSION['messages'])){
   echo $_SESSION['messages'];
   unset($_SESSION['messages']);
 }

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>HOME</title>
  </head>
  <body>
  <div class="container">
  <div class="row">
  <table class="table table-sm table-striped">
  <thead>
  <th>#</th>
  <th>Profile</th>
  <th>Name</th>
  <th>Email</th>
  <th>Date created</th>
  <th>Update</th>
  <th>Delete</th>
  </thead>
  <tbody>
  <?php 
  $users = $db->select('registration');
  if($users):
    $count = 0;
    foreach($users as $user):
        $count ++;
  ?>
  <tr>
  <td><?=$count;?></td>
  <td><img src="<?=$user['profile'];?>" width="30" hieght="30" class="rounded-circle"></td>
  <td><?=$user['name'];?></td>
  <td><?=$user['email'];?></td>
  <td><?=$user['date_created'];?></td>
  <td> <a href="update.php?id=<?=$user['id'];?>" class="btn btn-sm btn-info"> Update </a></td>
  <td>Delete</td>
  </tr>
  <?php 
        endforeach;
    endif;
  ?>
  </tbody>
  </table>
  </div>
  </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>