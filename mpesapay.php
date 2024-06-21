<?php

// Include the PHP config file
include 'config.php';

session_start();
if (!isset($_SESSION['user_name'])) {
  header('location:login_form.php');
}

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Connect to the database
    $conn = mysqli_connect('localhost','root','','gym_db');

    // Retrieve the form data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $paybill = mysqli_real_escape_string($conn, $_POST['paybill']);
    $amount = mysqli_real_escape_string($conn, $_POST['amount']);

    // Construct the INSERT query
    $query = "INSERT INTO mpesa_payments (name, phone, email, paybill, amount) VALUES ('$name', '$phone', '$email', '$paybill', '$amount')";

    // Execute the query
    mysqli_query($conn, $query);
     // Redirect to the "successful payment" page
     header('Location: thankyoupage.html');
    }


?>





<!DOCTYPE html>
<html>
  <head>
    <title>Mpesa payment</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  </head>
  <body>
<h1 style="color: green; text-align: center;">Pay with Mpesa</h1>
<div class="mainscreen">
    <div class="card">
  
    <form action="" method="post" >
  <label for="name"><i class="fas fa-user"></i> Name:</label><br>
  <input type="text" id="name" name="name" required placeholder="Enter full name" oninput="validateName()"><br>
  <label for="phone"><i class="fas fa-phone" ></i> Phone :</label><br>
  <input type="number" id="phone" name="phone"   required placeholder="07..."  onchange="validatePhoneNumber(this)"><br>
  <label for="email"><i class="fas fa-envelope"></i> Email:</label><br>
  <input type="email" id="email" name="email" required placeholder="Email Address"><br>
  <label for="paybill"><i class="fas fa-money-bill"></i> Paybill (22213):</label><br>
  <input type="number" id="paybill" name="paybill" required placeholder="Enter the paybill number"><br>
  <label for="amount"><i class="fas fa-money-bill"></i> Amount:</label><br>
  <input type="number" id="amount" name="amount" required placeholder="Amount"><br>
  <input type="submit" value="Submit">
</form>
<style>
body {
  background-color: lightgreen;
} 
h1 {
  color: green;
  text-align: center;
  margin: 20px 0;
}
.mainscreen {
  display: flex;
  justify-content: center;
}

.card {
  width: 50%;
  margin: 20px;
  background: white;
  border-radius: 1.5rem;
  box-shadow: 4px 3px 20px #3535358c;
  display: flex;
  flex-direction: column;
  margin-top: 10px;
}
form {
  width: 100%;
  margin: 0 auto;
  text-align: left;
  padding: 10px;
  border:none;
  border-radius: 5px;

}

label {
  display: block;
  margin-bottom: 10px;
  position: relative;
  color: royalblue;
}

label i {
  position: absolute;
  top: 20px;
  color:greenyellow;
  
}

input[type="text"], input[type="email"], input[type="number"], textarea {
  width: 90%;
  padding: 12px;
  border: 1px solid green;
  border-radius: 25px;
  box-sizing: border-box;
  resize: vertical;
  margin-bottom: 10px;
  padding-left: 30px;
  font-weight: 400;
  font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
}

input[type="submit"] {
  background-color: green;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  justify-content: center;
}

input[type="submit"]:hover {
  background-color:goldenrod;
}

</style>

<!--js link--->
<script>
  function validateName() {
  var nameInput = document.getElementById("name");
  nameInput.value = nameInput.value.replace(/[^a-zA-Z\s]/g, "");
}

const phoneField = document.getElementById('phone');

phoneField.addEventListener('input', function() {
  // Remove any non-numeric characters
  this.value = this.value.replace(/\D/g, '');

  // Restrict the input to 10 digits
  if (this.value.length > 10) {
    this.value = this.value.slice(0, 10);
  }

  const regex = /^07/;
    if (!regex.test(this.value)) {
        this.setCustomValidity('Phone number must start with 07');
    } else {
        this.setCustomValidity('');
    }
});

</script>

</body>
</html>


