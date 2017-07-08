<?php
include '../index.php';
include 'sidebar.php';
if(!isset($_SESSION['perm']) || strcmp($_SESSION['perm'],"wa")!=0)
    header('Location: logout.php');

if(isset($_POST['username']))
{
    $user_username = $_POST['username'];
    $user_password = $_POST['password'];
    $user_fname = $_POST['fname'];
    $user_lname = $_POST['lname'];
    $user_email = $_POST['email'];
    $user_contact = $_POST['contact'];
    $user_perm = $_POST['perm'];
    $insert = "INSERT INTO login (`username`, `password`, `first_name`, `last_name`, `email`, `contact`, `perm`)
                VALUES ('$user_username','$user_password','$user_fname','$user_lname','$user_email','$user_contact','$user_perm')";
    if ($conn->query($insert) == TRUE) {
        $msg = "Customer added successfully.";
    } else {
        $msg = "Customer addition unsuccessful.";
    }
}

?>
    <div class="main-body">
        <div class="pagetitle">
            Add User
        </div>
        <div class="addform">
            <form name="RegForm" class="login-container" method="POST" action="add-user.php" onsubmit="return validateAddForm()">
<!--                <strong>--><?php //echo $msg;?><!--</strong>-->
                <p><input id="fname" name="fname" type="text" placeholder="First Name*" required></p>
                <p><input id="lname" name="lname" type="text" placeholder="Last Name*" required></p>
                <p><input id="email" name="email" type="email" placeholder="Email*" required></p>
                <p><input id="contact" name="contact" type="text" placeholder="Contact (10 digits)*" required></p>
                <p><input id="username" name="username" type="text" placeholder="Username (4-10 characters)*" required></p>
                <p><input id="password" name="password" type="password" placeholder="Password (min 6 characters)*" required></p>
                <p><select name="perm">
                        <option value="ad">Admin</option>
                        <option value="ac">Accountant</option>
                        <option value="wa">Warden</option>
                        <option value="vo">Volunteer</option>
                    </select>
                </p>
                <p><input type="hidden" value="Yes" name="AddUser">
                    <button type="submit" class="btn btn-primary">Add User</button></p>
            </form>
        </div>
    </div>
</body>
</html>
