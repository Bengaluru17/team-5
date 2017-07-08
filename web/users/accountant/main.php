<?php
include '../index.php';
include 'sidebar.php';
if(!isset($_SESSION['perm']) || strcmp($_SESSION['perm'],"ad")!=0)
    header('Location: logout.php');
?>
    <div class="main-body">
        Welcome home, accountant!
    </div>
</body>
</html>