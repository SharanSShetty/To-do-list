<?php 
 include('db_conn.php');
 
 session_start();

 $msg="";
  
if (isset($_POST['submit'])) {
 /* echo "<pre>";
  print_r($_POST);*/
  $email_id = mysqli_real_escape_string($connection,$_POST['email']);
  $password = mysqli_real_escape_string($connection,$_POST['password']);
  $sql = mysqli_query($connection,"select * from users where email_id='$email_id' && password='$password'");
  $num=mysqli_num_rows($sql);
  if ($num>0) {
    /*echo "login";*/
    $row=mysqli_fetch_assoc($sql);
    $_SESSION['USER_ID']=$row['id'];
    $_SESSION['UNSER_NAME']=$row['email_id'];
    header("location:index.php");
  }
  else{
    $msg="Please Enter Valid Details !";
  }
}





?>


<!DOCTYPE html>
<html>
<head>
	<title>User Login</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    #button1:hover {
  background-color: green; 
  color: white; 
    border:2px solid green;
}
.forgot-btn{
  text-align:right;
}

#button2:hover {
  background-color: #555555;
  color: white;
}

#button3:hover {
  background-color: red;
  color: white;
}


.forgot-btn button{
  border:none;
  background-color: transparent;
  outline:none;
  font-weight:450;
  cursor:pointer;
}

    </style>

</head>
<body background="photo/background.jpg" >
<section class="vh-100" >
  <div class="container py-4 h-100" id="login-popup">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-8">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              <img style="height:40rem; border-radius: 1rem; " src="photo/loginimg.jpg"
                alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
            </div>

            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">

                <form method="post" action="">
                        
                  <div class="error" style="color: red; text-align: center;">  
                          
                     </div>
                  <div class="d-flex align-items-center mb-3 pb-1">
                    <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                    <span class="h1 fw-bold mb-0">User Login</span>
                  </div>
                  <h4  style="color: red"><?php echo "$msg";  ?></h4>


                  <!-- <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5> -->

                  <div class="form-outline mb-4">
                    <input type="email" id="email"   name="email" class="form-control form-control-lg" />
                    <label class="form-label" for="form2Example17">Email address</label>
                  </div>

                  <div class="form-outline mb-4 password-wrapper">
    <input type="password" id="password" name="password" class="form-control form-control-lg" />
    <label class="form-label" for="form2Example27">Password</label>
    <span class="show-password-icon" onclick="togglePassword()">&#x1F441;</span>
</div>


                  <div class="pt-1 mb-4">
                    <button id="button1" class="btn btn-dark btn-lg btn-block" 
  type="submit" name="submit">Login</button>
                  </div>
                  <div class="forgot-btn">
                    <button type="button" onclick="forgotPopup()">
                      Forgot Password?
                    </button>
                  </div>
				  <p>Not registered? 
              <a href="register.php"
               style="text-decoration: none;">
                Create an account
            </a>
			<style>
.password-wrapper {
    position: relative;
}

.password-wrapper input[type="password"] {
    padding-right: 40px; /* space for the icon */
}

.show-password-icon {
    position: absolute;
    right: 10px; /* adjust as needed */
    top: 30%;
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
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
	<title>Reset Password</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .reset-popup {
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: white;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .reset-popup h2 {
      margin-top: 0;
    }
    .reset-popup button {
      margin-top: 10px;
    }
  </style>
</head>
<body>



<div class="reset-popup" id="forgot-popup">
  <form method="POST" action="forgotpassword.php">
    <h2>Reset Password</h2>
    <input type="text" placeholder="E-mail" name="email">
    <button id="button2" type="submit" class="reset-btn" name="send-reset-link">SEND LINK</button>
    <button id="button3" type="button" onclick="popup('forgot-popup')">Close</button>
  </form>
</div>

<script>
  function popup(popup_name){
    get_popup=document.getElementById(popup_name);
    if(get_popup.style.display=="flex"){
      get_popup.style.display="none";
    }
    else{
      get_popup.style.display="flex";
    }
  }
  function forgotPopup(){
    document.getElementById('forgot-popup').style.display="flex";
  }
</script>

</body>
</html>