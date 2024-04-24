<?php include('header.php');?>
<?php include('db_conn.php');?>
<?php
include('db_conn.php');
session_start();
if (!isset($_SESSION['USER_ID'])) {
	header("location:login.php");
	die();
}
 ?>
<form action="insert_data.php" method="post">
<div id="input_text"><input id="title" type="text" name="title" class="space" placeholder="Enter task">
<input type="submit" class="btn btn-success space" id="add_btn" name="add_btn" value="Add">
</div>
</form>
<?php
if(isset($_GET['message'])){
    echo "<h6>".$_GET['message']."</h6>";
}
?>
<?php

$user = $_SESSION['UNSER_NAME'];
$query = mysqli_query($connection,"select * from users where email_id = '$user'");
$row =mysqli_fetch_array($query);
$id = $row['id'];

$query="select * from `todo_table` where `user_id`=$id";
$result=mysqli_query($connection,$query);
if(!$result)
{
    echo "query failed";
}
else{
    while($row=mysqli_fetch_assoc($result)){
?>
<div class="box">
<div class="card" style="width: 400px;">
  <div class="card-body">
  <p><?php echo $row['title'];?></p>
    <small><?php echo $row['datetime'];?></small>
    <a href="update.php?id=<?php echo $row['id'];?>" class="btn btn-primary space">Update</a> 
    <a href="delete.php?id=<?php echo $row['id'];?>" class="btn btn-danger space">Delete</a> 
    
  </div>
</div>
</div>
<?php 
    }
}
?>
<?php
if(isset($_GET['insert_msg'])){
    echo "<h5>".$_GET['insert_msg']."</h5>";
}
?>
<?php
if(isset($_GET['update_msg'])){
    echo "<h5>".$_GET['update_msg']."</h5>";
}
?>
<?php
if(isset($_GET['delete_msg'])){
    echo "<h6>".$_GET['delete_msg']."</h6>";
}
?>
<?php include('footer.php');?>
