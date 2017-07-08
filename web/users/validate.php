<?php
include 'config.php';
$enterpass = $_POST['password'];
$check = "SELECT * FROM login WHERE username = '".$_POST['username']."' AND password='". $enterpass ."' ";
$result = $conn->query($check);

if (mysqli_num_rows($result) == 1)
{
    $row = mysqli_fetch_row($result);
    $loguser_username = $row[0];
    $loguser_first_name = $row[2];
    $loguser_perm = $row[6];
    echo "<script>console.log( 'Debug Objects: " . $row[0] . "' );</script>";
    $_SESSION['username'] = $loguser_username;
    $_SESSION['first_name'] = $loguser_first_name;
    $_SESSION['perm'] = $loguser_perm;
    echo $_SESSION['first_name'];
    if( strcmp($loguser_perm,"ad") == 0 )
        header("Location: admin/main.php");
    else if( strcmp($loguser_perm,"ac") == 0 )
        header("Location: accountant/main.php");
    else if( strcmp($loguser_perm,"vo") == 0 )
        header("Location: volunteer/main.php");
    else if( strcmp($loguser_perm,"wa") == 0 )
        header("Location: warden/main.php");
    else echo $loguser_perm;

}
else
{   echo $check;
    echo "False";
}
?>