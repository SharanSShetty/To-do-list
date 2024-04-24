<?php include('header.php');?>
<?php include('db_conn.php');?>

<?php
if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $query="select * from `todo_table` where `id`='$id'";
    $result=mysqli_query($connection,$query);
    if(!$result)
    {
        die("query failed");
    }
    else
    {
        $row=mysqli_fetch_assoc($result);
    }
}
?>
<?php
if(isset($_POST['update_btn'])){
    if(isset($_GET['id']))
    {
        $idnew=$_GET['id'];
    
    $title=$_POST['title'];
    $query="update `todo_table` set `title`='$title' where `id`='$idnew'";
    $result=mysqli_query($connection,$query);
    if(!$result)
    {
        die("query failed");
    }
    else
    {
        header('location:index.php?update_msg=You have updated successfully');
    }
}
}
?>

<form action="update.php?id=<?php echo $id;?>" method="post">
<div id="input_text"><input id="title" type="text" name="title" class="space" value="<?php echo $row['title'];?>">
<input type="submit" class="btn btn-success space" id="update_btn" name="update_btn" value="Update">
</div>
</form>
<?php include('footer.php');?>