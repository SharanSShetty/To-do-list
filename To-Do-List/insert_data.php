
<?php
include 'db_conn.php';
session_start();
if(isset($_POST['add_btn'])){

    $user = $_SESSION['UNSER_NAME'];
    $query = mysqli_query($connection,"select * from users where email_id = '$user'");
    $row =mysqli_fetch_array($query);
    $id = $row['id'];

$title=$_POST['title'];
date_default_timezone_set('Asia/Kolkata'); // Set the timezone to India (IST)
$date = date("d-m-y h:i:s"); 
if($title=="" || empty($title)){
    header('location:index.php?message=please enter task to add');
}
else{
    $query="insert into `todo_table` (`title`,`datetime`,`user_id`) values('$title','$date',$id)";
    $result=mysqli_query($connection,$query);
    if(!$result)
    {
        die("query failed");
    }
    else{
        header('location:index.php?insert_msg=you have inserted task sucessfully');
    }
}
}
?>