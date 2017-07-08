<?php
include 'index.php';
?>
    <div class="main-body">
        <div class="pagetitle">
            Add User
        </div>
        <div class="login">
            <div class="login-triangle"></div>
            <h2 class="login-header">Add Customer</h2>
            <form name="RegForm" class="login-container" method="POST" action="add-customer.php" onsubmit="return validateForm()">

                You are allowed to add customers for Zone <?php echo $cur_zone;?> only.
                <strong><?php echo $msg;?></strong>
                <strong><?php echo $emailErr;?></strong>
                <p><input id="fname" name="fname" type="text" placeholder="First Name*" required></p>
                <p><input id="lname" name="lname" type="text" placeholder="Last Name*" required></p>
                <p><input id="email" name="email" type="email" placeholder="Email*" required></p>
                <p><input id="contact" name="contact" type="text" placeholder="Contact (10 digits)*" required></p>
                <p><input id="zone" name="zone" type="text" placeholder="Zone*" value="Zone <?php echo $cur_zone;?>" disabled></p>
                <p><input id="username" name="username" type="text" placeholder="Username (4-10 characters)*" required></p>
                <p><input id="password" name="password" type="password" placeholder="Password (min 6 characters)*" required></p>
                <p><input type="hidden" value="Yes" name="AddCust" >
                    <button type="submit" class="btn btn-primary">Add Customer</button></p>
                <a href="index.php">Go Back</a>
            </form>

        </div>
    </div>
</body>
</html>
