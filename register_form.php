<?php
@include 'config.php';

if(isset($_POST['submit'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $dateofbirth = mysqli_real_escape_string($conn, $_POST['dateofbirth']);
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['cpassword']);
    $user_type = $_POST['user_type'];

    $select = "SELECT * FROM user_form WHERE email = '$email' && password = '$pass'";
    $result = mysqli_query($conn, $select);

    if(mysqli_num_rows($result) > 0){
        $error[] = 'User already exists!';
    } else {
        if($pass != $cpass){
            $error[] = 'Password does not match!';
        } else {
            $insert = "INSERT INTO user_form(name, email, gender, dateofbirth, password, user_type) VALUES('$name','$email','$gender','$dateofbirth','$pass','$user_type')";
            mysqli_query($conn, $insert);
            header('location:login_form.php');
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register form</title>
   <!-- Favicon -->
   <link href="img/favicon.ico" rel="icon">

   <!-- Font Awesome -->
   <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

   <!-- Flaticon Font -->
   <link href="lib/flaticon/font/flaticon.css" rel="stylesheet">

   <!-- Customized Bootstrap Stylesheet -->
   <link href="css/style.min.css" rel="stylesheet">

   <!-- jQuery UI Datepicker Stylesheet -->
   <link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <!-- JavaScript Libraries -->
   <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
   <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

   <script>
   $(document).ready(function() {
      $("#dateofbirth").datepicker({
         dateFormat: 'yy-mm-dd',
         changeMonth: true,
         changeYear: true,
         yearRange: "-100:+0" // Set the range to allow selection of the last 100 years
      });
   });
   </script>
   <script>
   $(document).ready(function() {
      $("#showPassword").click(function() {
         var passwordField = $("#password");
         var passwordFieldType = passwordField.attr("type");
         if (passwordFieldType === "password") {
            passwordField.attr("type", "text");
            $(this).html('<i class="fas fa-eye-slash"></i>');
         } else {
            passwordField.attr("type", "password");
            $(this).html('<i class="fas fa-eye"></i>');
         }
      });
   $("#showCPassword").click(function() {
         var cpasswordField = $("#cpassword");
         var cpasswordFieldType = cpasswordField.attr("type");
         if (cpasswordFieldType === "password") {
            cpasswordField.attr("type", "text");
            $(this).html('<i class="fas fa-eye-slash"></i>');
         } else {
            cpasswordField.attr("type", "password");
            $(this).html('<i class="fas fa-eye"></i>');
         }
      });
   });
   </script>
</head>
<body class="bg-white">
    <!-- Navbar Start -->
    <div class="container-fluid p-0 nav-bar">
        <nav class="navbar navbar-expand-sm bg-none navbar-dark py-0 w3-small">
            <a href="" class="navbar-brand">
                <h1 class="m-0 display-4 font-weight-bold text-uppercase text-black">FITNESS</h1>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav ml-auto p-4 bg-secondary">
                    <a href="index.html" class="nav-item nav-link active">Home</a>
                    <a href="about.html" class="nav-item nav-link">About Us</a>
                    <a href="feature.html" class="nav-item nav-link">Our Features</a>
                    <a href="class.html" class="nav-item nav-link">Classes</a>
                     <a href="register_form.php" class="nav-item nav-link">Register</a>
                   <a href="contact.html" class="nav-item nav-link">Contact</a>
                </div>
            </div>
        </nav>
    </div>
<div class="form-container">
      <form action="" method="post">
         <h3>register now</h3>
         <?php
         if(isset($error)){
            foreach($error as $error){
               echo '<span class="error-msg">'.$error.'</span>';
            }
         }
         ?>
         <input type="text" id="name" name="name" required placeholder="Enter your name" oninput="validateName()"><br>
         <input type="email" name="email" required placeholder="Enter your email">
         <p>
            <select name="gender" required>
               <option value="">Select Gender</option>
               <option value="Male">Male</option>
               <option value="Female">Female</option>
               <option value="Other">Other</option>
            </select>
         </p>
         <input type="text" name="dateofbirth" id="dateofbirth" required placeholder="Select your date of birth">
         <input type="password" name="password" id="password" required placeholder="Enter your password">
         <div>
            <input type="checkbox" id="showPassword">
            <label for="showPassword"><i class="fas fa-eye"></i></label>
         </div>
         <input type="password" name="cpassword" id="cpassword" required placeholder="Confirm your password">
         <div>
            <input type="checkbox" id="showCPassword">
            <label for="showCPassword"><i class="fas fa-eye" id="password"></i></label>
         </div>
         <style>
             .fa-eye{
                width: 100%;
                padding:10px 15px;
                font-size: 17px;
                margin:8px 0;background: #eee;
                border-radius: 5px;
            }
         </style>
         <select name="user_type">
            <option value="user">User</option>
            <option value="admin">Admin</option>
         </select>
         <input type="submit" name="submit" value="Register Now" class="form-btn">
         <p>Already have an account? <a href="login_form.php">Login Now</a></p>
      </form>
   </div>
<div class="footer container-fluid mt-5 py-5 px-sm-3 px-md-5 text-white">
        <div class="row pt-5">
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="text-primary mb-4">Get In Touch</h4>
                <p><i class="fa fa-map-marker-alt mr-2"></i>Ruiru, Kiambu, KENYA</p>
                <p><i class="fa fa-phone-alt mr-2"></i>+254104498844</p>
                <p><i class="fa fa-envelope mr-2"></i>info@gmail.com</p>
                <div class="d-flex justify-content-start mt-4">
                    <a class="btn btn-outline-light rounded-circle text-center mr-2 px-0" style="width: 40px; height: 40px;" href="#"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-outline-light rounded-circle text-center mr-2 px-0" style="width: 40px; height: 40px;" href="#"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-outline-light rounded-circle text-center mr-2 px-0" style="width: 40px; height: 40px;" href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-outline-light rounded-circle text-center mr-2 px-0" style="width: 40px; height: 40px;" href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="text-primary mb-4">Quick Links</h4>
                <div class="d-flex flex-column justify-content-start">
                    <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Home</a>
                    <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>About Us</a>
                    <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Our Features</a>
                    <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Classes</a>
                    <a class="text-white" href="#"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="text-primary mb-4">Popular Links</h4>
                <div class="d-flex flex-column justify-content-start">
                    <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Home</a>
                    <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>About Us</a>
                    <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Our Features</a>
                    <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Classes</a>
                    <a class="text-white" href="#"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="text-primary mb-4">Opening Hours</h4>
                <h5 class="text-white">Monday - Friday</h5>
                <p>8.00 AM - 8.00 PM</p>
                <h5 class="text-white">Saturday - Sunday</h5>
                <p>2.00 PM - 8.00 PM</p>
            </div>
        </div>
        <div class="container border-top border-dark pt-5">
            <p class="m-0 text-center text-white">
                &copy; <a class="text-white font-weight-bold" href="#">Fitness club</a>. All Rights Reserved.
                <a class="text-white font-weight-bold" href="https://htmlcodex.com"></a>
            </p>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-outline-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>
    <!-- JavaScript Libraries -->
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
    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>
</html>
