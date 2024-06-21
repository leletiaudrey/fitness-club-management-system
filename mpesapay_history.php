<?php
session_start();
if (!isset($_SESSION['admin_name'])) {
  header('location:login_form.php');
}

// Include the PHP config file
include 'config.php';

// Connect to the database
$conn = mysqli_connect('localhost','root','','gym_db');

// Retrieve the Mpesa payment history
$query = "SELECT * FROM mpesa_payments";
$result = mysqli_query($conn, $query);
$payments = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Mpesa Payment History</title>
  <div class="header">
    <h1>Payment History</h1>
    <h2>Your payments history records  will appear here for easy tracking:</h2>
    <a href="javascript:history.back()" class="back-button"><i class="fa fa-arrow-left"></i> Back</a>
  <link href="css/style.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
  <div class="mainscreen">
    <div class="card">
      <table>
        <tr>
          <th>Name</th>
          <th>Phone</th>
          <th>Email</th>
          <th>Paybill</th>
          <th>Amount</th>
        </tr>
        <?php foreach ($payments as $payment): ?>
          <tr>
            <td><?php echo $payment['name']; ?></td>
            <td><?php echo $payment['phone']; ?></td>
            <td><?php echo $payment['email']; ?></td>
            <td><?php echo $payment['paybill']; ?></td>
            <td><?php echo $payment['amount']; ?></td>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>
  </div>
  <style>
  /* Global Styles */
body {
  font-family: arial,sans-serif;
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
  color: black;
}

.header h2 {
  margin: 10px 0;
  color: white;
}

.back-button {
  color: #fff;
  text-decoration: none;
  font-size: 16px;
}

.back-button i {
  margin-right: 5px;
}

/* Table Styles */
.mainscreen {
  padding: 20px;
}

.card {
  background-color: #f9f9f9;
  padding: 20px;
}

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

    
</body>
</html>