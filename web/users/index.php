<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="indexstyle.scss" rel="stylesheet">
    <link href="../indexstyle.scss" rel="stylesheet">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">

    <script>
        function validateAddForm()
        {   var usern = document.forms["RegForm"]["username"].value;
            if(usern.length < 4 || usern.length > 11){
                alert("Username should be of 4-10 characters long.");
                return false;
            }

            var passw = document.forms["RegForm"]["password"].value;
            if(passw.length <6)
            {
                alert("Not a secure password, length is less than 6 characters.");
                return false;
            }

            var mob = document.forms["RegForm"]["contact"].value;
            if(mob.length != 10)
            {
                alert("Contact number incorrect. Should be of 10 characters.");
                return false;
            }
            return true;
        }
    </script>

</head>

<body>
    <?php
        include 'config.php';
    ?>