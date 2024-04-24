<?php // Include the database connection file
@include 'db_conn.php';

// Check if the form has been submitted
if(isset($_POST['submit'])){

    // Initialize the error array
    $error = [];

    // Validate the email input
    // Validate the email input
$email = $_POST['email'];

// Check if the email is valid and does not contain special characters
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error[] = 'Invalid email address';
} elseif (!preg_match('/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email)) {
    $error[] = 'Email should not contain special characters';
} elseif (!preg_match('/^[a-zA-Z0-9]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email)) {
    $error[] = 'Email should contain a combination of alphabets and numbers';
} else {
       // Escape the email input to prevent SQL injection attacks
        $email = mysqli_real_escape_string($connection, $email);
        
        // Validate the password input
        $password = $_POST['password'];
        
        if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/", $password)) {
            $error[] = 'Password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, and one number.';
        } else {
            // Query the database to see if the email already exists
            $select = "SELECT * FROM users WHERE email_id = '$email'";
            $result = mysqli_query($connection, $select);

            // If the email already exists, display an error message
            if(mysqli_num_rows($result) > 0){
                $error[] = 'User already exists!';
            } else {
                // If the email doesn't exist, insert the new user into the database
                $insert = "INSERT INTO users(email_id, password) VALUES('$email','$password')";
                mysqli_query($connection, $insert);
                
                // Redirect the user to the login page
                header('location: login.php');
                exit(); // Terminate the script after redirection
            }
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
   <title>Register Form</title>
   <link rel="stylesheet" href="style.css">
</head>
<body>
   <div class="form-container">
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
         <h3>Register Now</h3>
         <?php
         if(isset($error)){
            foreach($error as $errorMsg){
               echo '<span class="error-msg">'.$errorMsg.'</span>';
            }
         }

         if(isset($success_message)){
            echo '<span class="success-msg">'.$success_message.'</span>';
         }
         ?>
         <input type="email" name="email" required placeholder="Enter your email">
         <div class="password-wrapper">
            <input type="password" name="password" id="password" required placeholder="Enter your password">
            <span class="show-password-icon" onclick="togglePassword()">&#x1F441;</span>
         </div>
         <input type="submit" name="submit" value="Register Now" class="form-btn">
         <p>Already have an account? <a href="login.php">Login Now</a></p>
      </form>
   </div>
   <style>
   /* Add this CSS to your existing style.css file */
.password-wrapper {
   position: relative;
}

.password-wrapper input[type="password"] {
   padding-right: 40px; /* space for the icon */
}

.show-password-icon {
   position: absolute;
   right: 10px; /* adjust as needed */
   top: 50%;
   transform: translateY(-50%);
   cursor: pointer;
}
</style>

   <script>
      // Function to toggle password visibility
      function togglePassword() {
         const passwordInput = document.getElementById("password");
         if (passwordInput.type === "password") {
            passwordInput.type = "text";
         } else {
            passwordInput.type = "password";
         }
      }
   </script>
</body>
</html>
