<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:loginform.php');
}

?>

<!DOCTYPE html>
<html lang="en">
   <head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin page</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   
</head>
<body>
   <nav>
         <a href="dashboard.php" class="nav">Dashboard</a>
   </nav>
<div class="container">

   <div class="content">
      <h3>Hi, <span>admin</span></h3>
      <h1>Welcome <span><?php echo $_SESSION['admin_name'] ?></span></h1>
      <p>this is an admin page</p>
      <a href="loginform.php" class="btn">Login</a>

      <a href="logout.php" class="btn">Logout</a>
   </div>
</div>


</body>
</html> 