<?php
include '../index.php';
include 'sidebar.php';

if(!isset($_SESSION['perm']) || strcmp($_SESSION['perm'],"ad")!=0)
    header('Location: logout.php');

//if(isset($_GET['search'])){
//    $get_search = $_GET['search'];
//}

$getlist = "SELECT * FROM requests";
$result = $conn->query($getlist);
$search_result = $result;

if (isset($_GET['perm']))
{   $getlist = 'SELECT * FROM `requests` WHERE `perm`="'.$_GET['perm'].'"';
    $search_result = $conn->query($getlist);
//    $row = mysqli_fetch_row($search_result);
//    echo $row[2];
}
?>

<div class="main-body">
    <div class="pagetitle">
        View Requests<?php
        if(isset($_GET['perm']) && strcmp ($_GET['perm'],"ad") == 0) echo ": Admin";
        if(isset($_GET['perm']) && strcmp ($_GET['perm'],"ac") == 0) echo ": Accountant";
        if(isset($_GET['perm']) && strcmp ($_GET['perm'],"wa") == 0) echo ": Warden";
        if(isset($_GET['perm']) && strcmp ($_GET['perm'],"vo") == 0) echo ": Volunteer";
        ?>
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
            <button type="submit" class="btn btn-primary">Filter Users</button>
        </form>
    </div>
<!--    --><?php //if($search_result)
//    { ?>
    <div class="view-users">
        <table>
            <tr>
                <th style="width:15%">Category</th>
                <th style="width:15%">Name</th>
                <th style="width:10%">Count</th>
                <th style="width:10%">Price</th>
                <th style="width:15%">Total Price</th>
                <th style="width:10%">Dormitory</th>
                <th style="width:15%">Requestee</th>
                <th>Status</th>
            </tr>

            <?php
            while ($row = mysqli_fetch_row($search_result)) {
            ?>
            <tr>
                <td><?php echo $row[5]; ?></td>
                <td><?php echo $row[3]; ?></td>
                <td><?php echo $row[2]; ?></td>
                <td><?php echo $row[1]; ?></td>
                <td><?php $total_price = $row[2] * $row[1];
                    echo $total_price; ?></td>
                <td><?php
                    if (strcmp($row[6], "m") == 0) echo "Male";
                    if (strcmp($row[6], "f") == 0) echo "Female";
                    ?>
                </td>
                <td><?php echo $row[7]; ?></td>
                <td>
                        <span>
                            <?php if (strcmp($row[4], "in") == 0) {?>
                                <button type="submit" title="Initiated">
                                    <i class="fa fa-pencil"></i>
                                </button>
                            <?php
                            } else if( strcmp ($row[4],"ap") == 0) {
                            ?>
                                <button type="submit" title="Approved">
                                    <i class="fa fa-pencil"></i>
                                </button>
                            <?php
                            } else if( strcmp ($row[4],"bo") == 0) {
                            ?>
                                <button type="submit" title="Bought">
                                    <i class="fa fa-pencil"></i>
                                </button>
                            <?php
                            } else if( strcmp ($row[4],"re") == 0) {
                             ?>
                                <button type="submit" title="Reimbursed">
                                    <i class="fa fa-pencil"></i>
                                </button>
                            <?php } ?>
                        <button type="submit" title="Edit Details">
                            <i class="fa fa-pencil"></i>
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


