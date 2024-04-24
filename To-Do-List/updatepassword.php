<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Update</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
        }

        .container {
            text-align: center;
            width: 300px;
            background-color: #fff;
            padding: 20px;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .title {
            margin-top: 0;
        }

        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
        }

        button {
            cursor: pointer;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <?php
    require('db_conn.php');
    if(isset($_GET['email']) && isset($_GET['reset_token'])){
        date_default_timezone_set('Asia/kolkata');
        $date=date("Y-m-d");
        $query="SELECT * from `users` WHERE `email_id`='$_GET[email]' AND `resettoken`='$_GET[reset_token]' AND `resettokenexpire`='$date' ";
        $result=mysqli_query($connection,$query);
        if($result){
            if(mysqli_num_rows($result)==1){
    echo"<div class='container'>
    <h3 class='title'>Create New Password</h3>
    <form method='POST'>
        <input type='password' placeholder='New Password' name='Password' required>
        <button type='submit' name='updatepassword'>UPDATE</button>
        <input type='hidden' name='email' value='$_GET[email]'>
    </form>
    </div>";
            }else{
                echo "<script>
                alert('Invalid or expired link');
                window.location.href='index.php';
                </script>";   
            }
        }else{
            echo "<script>
            alert('Server down!try again later');
            window.location.href='index.php';
            </script>";  
        }
    }

    if(isset($_POST['updatepassword'])){
        $pass=$_POST['Password']; 
        $update="UPDATE `users` SET `password`='$pass',`resettoken`=NULL,`resettokenexpire`=NULL WHERE `email_id`='$_POST[email]' ";
        if(mysqli_query($connection,$update)){
            echo "<script>
            alert('Password updated successfully');
            window.location.href='index.php';
            </script>";
        }else{
            echo "<script>
            alert('Server down!try again later');
            window.location.href='index.php';
            </script>";
        }
    }
    ?>
</body>
</html>