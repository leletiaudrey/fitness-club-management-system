<?php
// include database configuration file
include 'config.php';
session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:login_form.php');
}

// fetch all users from the database
$query = "SELECT * FROM user_form";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
   <title>Manage Users</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
<div class="header">
<h1>Manage Users</h1>
   
<div class="container">
<table class="table">
      <thead>
         

         <tr>
            <th>Name</th>
            <th>Email</th>
            <th>User Type</th>
        
         </tr>
      </thead>
      <tbody>
      
         <?php
         // loop through each user and display their details in a table row
         while($row = mysqli_fetch_assoc($result)){
            echo '<tr>';
            echo '<td>' . $row['name'] . '</td>';
            echo '<td>' . $row['email'] . '</td>';
            echo '<td>' . $row['user_type'] . '</td>';
            echo '</tr>';
         }
         ?>
      </tbody>
</div>
<style>
         /* Global Styles */
body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
}

.container {
  max-width: 960px;
  margin: 0 auto;
  padding: 20px;
}

/* Header Styles */
.header {
  background-color: maroon;
  color: black;
  padding: 20px;
}

.header h1 {
  margin: 0;
}

/* Table Styles */
.table {
  width: 100%;
  border-collapse: collapse;
}

.table th,
.table td {
  padding: 10px;
  border: 1px solid #ccc;
}

.table thead {
  background-color: #f0f0f0;
}

.table tbody tr:nth-child(even) {
  background-color: #f9f9f9;
}

.table tbody tr:hover {
  background-color: #e3e3e3;
}

    </style>
<a href="javascript:history.back()" class="back-button"><i class="fa fa-arrow-left"></i> Back</a>
</body>
</html>
