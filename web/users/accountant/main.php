<?php
include '../index.php';
include 'sidebar.php';
if(!isset($_SESSION['perm']) || strcmp($_SESSION['perm'],"ac")!=0)
    header('Location: logout.php');
?>
    <div class="main-body">
        <div class="cotitle">
            Howdy, Accountant!
        </div>
    </div>
</body>
</html>