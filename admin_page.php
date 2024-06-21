<?php
   @include 'config.php';

   session_start();

   if(!isset($_SESSION['admin_name'])){
      header('location:login_form.php');
   }
   
   
   // Get the total number of registered users
   $query = "SELECT COUNT(id) as total_users FROM user_form";
   $result = mysqli_query($conn, $query);
   $row = mysqli_fetch_assoc($result);
   $total_users = $row['total_users'];

   // Get the total number of queries
   $query = "SELECT COUNT(id) AS total_contact_queries FROM contact_form";
   $result = mysqli_query($conn, $query);
   $row = mysqli_fetch_assoc($result); 
   $total_contact_queries = $row['total_contact_queries']; 
 

   // Get the total amount of rent paid through M-Pesa payments
   $query = "SELECT SUM(amount) as total_mpesa_payments FROM mpesa_payments";
   $result = mysqli_query($conn, $query);
   $row = mysqli_fetch_assoc($result);
   $total_mpesa_payments = $row['total_mpesa_payments'];

  


?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Admin Page</title>
      

   <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

   <link rel="stylesheet"
  href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
   </head>


      <style>
         * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
         }

         body {
            font-family: Arial, sans-serif;
            font-size: 16px;
            line-height: 1.6;
            color: green;
            background-color:white;
         }
         .logo{

   align-items: center;
}
.logo i{
   color:#333;
   font-size: 40px;
   
    
}
.logo span{
   color: blue;
   font-size: 1.7rem;
   font-weight: 600;
}

         /* Add styles for the header */
         header {
            background-color: whitesmoke;
            color: #fff;
            padding: 8px;
            text-align: center;
            margin-bottom: 20px;
            height: auto;
         }

         header h1 {
            font-size: 32px;
            margin-bottom: 10px;
         }

         header p {
            font-size: 18px;
            margin-bottom: 0;
         }

         /* Add styles for the container */
         .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
         }

         /* Add styles for the vertical bar */
         .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: whitesmoke;
            overflow-x: hidden;
            padding-top: 20px;
         }

         .sidebar a {
            padding: 10px 8px 10px 16px;
            text-decoration: none;
            font-size: 20px;
            color: black;
            display: block;
            font-weight: 800;
         }

         .sidebar a:hover {
            color: gold;
         }
          .user-name{
            font-size: 18px;
            color: chartreuse;
            font-weight: 400;
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            text-decoration: underline;
            text-transform: uppercase;
          }
         

         /* Style the links for the active page */
         .active {
            background-color: #04AA6D;
            color: white;
         }

         /* Style the logout button */
         .logout-btn {
            background-color: red;
            color: white;
            border: none;
            padding: 10px;
            margin-top: 20px;
            cursor: pointer;
         }

         .logout-btn:hover {
            background-color: #cc0000;
         }
         .sidebar .menu-items a i {
   margin-right: 10px;
   width: 20px;
   text-align: center;
}

.sidebar .menu-items a i.fas {
   font-size: 18px;
}

         .container {
  max-width: 750px;
  margin: 0 auto;
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  align-items: center;
  padding: 2rem;
}

/* Style the cards */
.card {
  background-color: var(--secondary-color);
  border-radius: 0.4rem;
  box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
  padding: 1rem;
  margin-bottom: 1rem;
  flex-basis: calc(33.33% - 1rem);
  text-align: center;
  top:auto;
}
.card:hover {
  transform: scale(1.07);
  box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.4);
}

.card i {
  font-size: 60px; 
}


.card h2 {
  font-size: 1.5rem;
  margin-bottom: 1rem;
  color: blue;
}

.card p {
  font-size: 1.2rem;
  font-weight: bold;
  color:green;
}
      

         .btn {
            display: inline-block;
            background-color: #04AA6D;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            margin-right: 10px;
         }

         .btn:hover {
            background-color: #3e8e41;
         }
         .title {
  font-size: 36px;
  text-align: center;
  margin: 0;
  padding: 20px 0;
  text-decoration: underline;
}
.menu-title {
   text-align: center;
   margin-top: 20px;
   margin-bottom: 10px;
   font-size: 28px;
   color:brown;
   text-transform: uppercase;
   font-weight: bold;
   text-decoration: underline;
}
.menu-items a:hover {
  background-color: #333;
  color: #fff;
  cursor: pointer;
  transform: scale(1.05);
}

/* Styles for screens wider than 868px */
@media (max-width: 1000px) {
  .container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: stretch;
  }

  .sidebar {
    position: static;
    width: 100%;
    height: auto;
    margin-bottom: 20px;
    padding-top: 0;
  }

  .main {
    flex-basis: calc(100% - 250px);
    text-align: left;
    margin-top: 0;
  }

  .main h1 {
    font-size: 72px;
    margin-bottom: 40px;
  }

  .main p {
    font-size: 24px;
  }

  .menu-title {
    text-align: left;
    margin-top: 0;
    margin-bottom: 20px;
  }
}




         </style>
         <body>
         <div class="header">
         <header>
      <a href="#" class="logo"></i><span>Gym Management for Admin</span></a>

      <ul class="navbar"  id="navbar-content">
      </header>
      <h1 class="title">Admin Dashboard</h1>
   </div>
   
   <div class="sidebar">
   <h2 class="menu-title">Menu</h2>
   <ul class="menu-items">
      <li><a href="admin_page.php"><i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
      <li><a href="register_form.php"><i class="fas fa-user-plus"></i>Registar user</a></li>
      <li><a href="manage_users.php"><i class="fas fa-users"></i>Manage Users</a></li>
      <li><a href="contact_query.php"><i class="fas fa-comments"></i>Tenants Queries</a></li>
      <li><a href="mpesapay_history.php"><i class="fas fa-mobile-alt"></i>View Records for Mpesa</a></li>
      <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
      <span class="user-name">Admin:<?php echo $_SESSION['admin_name'] ?></span>
   </ul>
  
</div>


<div class="container">
<div class="card">
   <i class="fas fa-users"></i>
   <h2>Total Users</h2>
   <p><?php echo number_format($total_users); ?></p>
</div>

<div class="card">
<i class="far fa-envelope"></i>
<h2>Total Tenant Queries</h2>
 <p><?php echo number_format($total_contact_queries); ?></p>
</div>

<div class="card">
   <i class="fas fa-mobile-alt"></i>
   <h2>Total M-Pesa Payments</h2>
   <p><?php echo "Ksh " . number_format($total_mpesa_payments); ?></p>
</div>

</body>
</html>