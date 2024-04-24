<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To do list</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
body {
  background-image: url("photo/back.jpg");
  background-size: cover;
  background-repeat: no-repeat;
      }

      a{
            text-decoration: none;
            color:white;
        }
        #logout_btn
        {
            float:right;
        }
        #input_text{
            display:flex;
            justify-content: center;
            align-items: center;
        }
        .space{
            margin: 10px;
        }
        #title{
            display: inline;
            width:500px;
        }
        .box{
            display:flex;
            justify-content: center;
            align-items: center;
        }
        header{
            background-color: #333;
            color:white;
            padding: 20px;
        }
        h6{
            text-align:center;
            color:red;
        }
        h5{
            text-align:center;
            color:green; 
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="photo/todo-list-logo.png" alt="To Do List Logo" width="30" height="30" class="d-inline-block align-top">
    </a>
    <div class="collapse navbar-collapse" id="mynavbar">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="about.php">About Us</a>
        </li>
      </ul>
      <button id="logout_btn" class="btn btn-danger"><a href="logout.php">Logout</a></button>
    </div>
  </div>
</nav>
</body>
</html>
