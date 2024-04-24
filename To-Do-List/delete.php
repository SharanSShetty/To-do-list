<?php include('db_conn.php');?>
<?php
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $query="delete from `todo_table` where `id`='$id'";
    $result=mysqli_query($connection,$query);
    if(!$result){
        die("query failed");
    }
    else{
        header('location:index.php?delete_msg=You have deleted successfully');
    }
}
?>
