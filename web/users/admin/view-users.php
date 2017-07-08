<?php
include '../index.php';
include 'sidebar.php';

//if(isset($_GET['search'])){
//    $get_search = $_GET['search'];
//}

$getlist = "SELECT * FROM login";
$result = $conn->query($getlist);
$search_result = $result;

if (isset($_GET['perm']))
{   echo "show";
    $getlist = "SELECT * FROM `login` WHERE `perm` = ".$_GET['perm']." ";
    $search_result = $conn->query($getlist);
//    $row = mysqli_fetch_row($search_result);
//    echo $row[2];
}
?>

<div class="main-body">
    <div class="pagetitle">
        Views Users: <?php if(isset($_GET['perm'])) echo $_GET['perm'];?>
    </div>
    <div class="userfilter">
        <form method="GET" action="view-users.php" id="searchForm">
            <div class="input-group">
                <select name="perm">
                    <option value="ad">Admin</option>
                    <option value="ac">Accountant</option>
                    <option value="wa">Warden</option>
                    <option value="vo">Volunteer</option>
                </select>
            </div>
<!--            <input type="hidden" value="Yes" name="AddUser">-->
            <button type="submit" class="btn btn-primary">Add User</button>
        </form>
    </div>
<!--    --><?php //if($search_result)
//    { ?>
    <div class="view-users">
        <table>
            <tr>
                <th style="width:15%">Username</th>
                <th style="width:20%">Name</th>
                <th style="width:20%">Email</th>
                <th style="width:15%">Contact</th>
                <th style="width:15%">Permissions</th>
                <th>Operations</th>
            </tr>

            <?php
            while ($row = mysqli_fetch_row($search_result)) {
                ?>
                <tr>
                    <td><?php echo $row[0]; ?></td>
                    <td><?php echo $row[2]; echo " "; echo $row[3]; ?></td>
                    <td><?php echo $row[4]; ?></td>
                    <td><?php echo $row[5]; ?></td>
                    <td><?php
                        if (strcmp ($row[6],"ad") == 0)
                            echo "Admin";
                        ?>
                    </td>
                    <td
                    <td>
                        <span>
                        <button type="submit" title="Edit Details">
                            <i class="fa fa-pencil"></i>
                        </button>
                        <button type="submit" title="View Details">
                            <i class="fa fa-eye"></i>
                        </button>
                        <button type="submit" title="Delete">
                            <i class="fa fa-trash"></i>
                        </button>
                        </span>
<!--                        <form action="#" method="post" enctype="multipart/form-data">-->
<!--                            <input type="hidden" name="cid" value="--><?php //echo $row[0]; ?><!--">-->
<!--                            <input type="hidden" name="type" value="edit">-->
<!--                            <button type="submit" title="Edit Details">-->
<!--                                <i class="fa fa-pencil"></i>-->
<!--                            </button>-->
<!--                        </form>-->
<!---->
<!--                        <form action="#" method="post" enctype="multipart/form-data">-->
<!--                            <input type="hidden" name="cid" value="--><?php //echo $row[0]; ?><!--">-->
<!--                            <input type="hidden" name="type" value="view">-->
<!--                            <button type="submit" title="View Details">-->
<!--                                <i class="fa fa-eye"></i>-->
<!--                            </button>-->
<!--                        </form>-->
<!---->
<!--                        <form action="#" method="POST"">-->
<!--                        <input type="hidden" name="cid" value="--><?php //echo $row[0]; ?><!--">-->
<!--                        <input type="hidden" name="Del_Type" value="del">-->
<!--                        <button type="submit" title="Delete">-->
<!--                            <i class="fa fa-trash"></i>-->
<!--                        </button>-->
<!--                        </form>-->

                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
<!--    --><?php //}
//    else echo "no results";
//    ?>
    </div>
</body>
</html>


