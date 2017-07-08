<?php
include 'config.php';
$enterpass = $_POST['password'];
$check = "SELECT * FROM login WHERE username = '".$_POST['username']."' AND password='". $enterpass ."' ";
$result = $conn->query($check);

if (mysqli_num_rows($result) == 1)
{
//    session_start();
    // echo "Successful login.\n";
    $row = mysqli_fetch_row($result);
    $loguser_username = $row[0];
    $loguser_first_name = $row[2];
    $loguser_perm = $row[6];
    $_SESSION['username'] = $loguser_username;
    $_SESSION['first_name'] = $loguser_first_name;
    echo $_SESSION['first_name'];
    // echo "<script>alert('Success!');</script>";
    // echo $user_perm;
    if( strcmp($loguser_perm,"ad") == 0 )
        header("Location: admin/main.php");
//    else if ( strcmp($user_perm));
}
else
{   // echo "<script>alert('No success! Please use the correct details.');</script>";
    header('Location: login.php');
}
?>