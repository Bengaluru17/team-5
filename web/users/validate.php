<?php
include 'config.php';
$enterpass = $_POST['password'];
$check = "SELECT * FROM login WHERE username = '".$_POST['username']."' AND password='". $enterpass ."' ";
$result = $conn->query($check);

if (mysqli_num_rows($result) == 1)
{
    // echo "Successful login.\n";
    $row = mysqli_fetch_row($result);
    $username_new = $row[0];
    $user_perm = $row[6];
    $_SESSION['username']= $username_new;
    echo "<script>alert('Success!');</script>";
    if( strcmp($user_perm,"ad") )
    header("Location: index.php");
}
else
{   // echo "<script>alert('No success! Please use the correct details.');</script>";
    header('Location: login.php');
}
?>