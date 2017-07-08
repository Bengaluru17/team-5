<?php
include 'config.php';
$enterpass = $_POST['password'];
$check = "SELECT * FROM login WHERE username = '".$_POST['username']."' AND password='". $enterpass ."' ";
$result = $conn->query($check);

if (mysqli_num_rows($result) == 1)
{
    echo "Successful login. Redirecting to the home page in 3 seconds.\n";
    $row = mysqli_fetch_row($result);
    $aid_new = $row[0];
    $username_new = $row[1];

    $_SESSION['aid']= $aid_new;
    $_SESSION['username']= $username_new;
    echo "<script>alert('Success!');</script>";
    header("Location: index.php");
}

else
{   echo "<script>alert('No success!');</script>";
    header('Location: login.php');
}
?>