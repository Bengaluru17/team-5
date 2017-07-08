<?php
include '../index.php';
include 'sidebar.php';
if(!isset($_SESSION['perm']) || strcmp($_SESSION['perm'],"wa")!=0)
    header('Location: logout.php');
?>
    <div class="main-body">
        Welcome home, warden!
    </div>
</body>
</html>