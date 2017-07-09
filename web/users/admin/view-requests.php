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

if (isset($_GET['gender']) || isset($_GET['category']))
{   if(strcmp ($_GET['gender'],"both") == 0 && strcmp($_GET['category'],"all") == 0)
    $getlist = "SELECT * FROM requests";
    if(strcmp ($_GET['gender'],"both") == 0 && strcmp($_GET['category'],"all") != 0)
        $getlist = 'SELECT * FROM requests WHERE `category`="'.$_GET['category'].'"';
    if(strcmp ($_GET['gender'],"both") != 0 && strcmp($_GET['category'],"all") == 0)
        $getlist = 'SELECT * FROM requests WHERE `gender`="'.$_GET['gender'].'"';
    if(strcmp ($_GET['gender'],"both") != 0 && strcmp($_GET['category'],"all") != 0)
        $getlist = 'SELECT * FROM requests WHERE `gender`="'.$_GET['gender'].'" AND `category`="'.$_GET['category'].'"';
    $search_result = $conn->query($getlist);
//    $row = mysqli_fetch_row($search_result);
//    echo $row[2];
}
?>

<div class="main-body">
    <div class="pagetitle">
        View Requests
    </div>
    <section class="userfilter">
        <form method="GET" action="view-requests.php" id="searchForm">
            <div class="input-group gone">
                <select name="gender">
                    <option value="both">Both</option>
                    <option value="m">Male</option>
                    <option value="f">Female</option>
                </select>
            </div>
            <div class="input-group gtwo">
                <select name="category">
                    <option value="all">All</option>
                    <option value="st">Stationary</option>
                    <option value="kt">Kitchen</option>
                    <option value="ut">Utilities</option>
                    <option value="md">Medication</option>
                </select>
            </div>
            <!--            <input type="hidden" value="Yes" name="AddUser">-->
            <div class="gthree">
                <button type="submit" class="btn btn-primary">Filter Requests</button>
            </div>
        </form>
    </section>
<!--    --><?php //if($search_result)
//    { ?>
    <div class="view-users">
        <table>
            <tr>
                <th style="width:15%">Category</th>
                <th style="width:15%">Name</th>
                <th style="width:10%">Quantity</th>
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
                    echo "Rs. ".$total_price; ?></td>
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
                                    <i class="fa fa-info" aria-hidden="true"></i>
                                </button>
                                Approve?
                            <?php
                            } else if( strcmp ($row[4],"ap") == 0) {
                            ?>
                                <button type="submit" title="Approved">
                                    <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                </button>
                                Approved
                            <?php
                            } else if( strcmp ($row[4],"bo") == 0) {
                            ?>
                                <button type="submit" title="Bought">
                                    <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                                </button>
                                Reimbursed?
                            <?php
                            } else if( strcmp ($row[4],"re") == 0) {
                             ?>
                                <button type="submit" title="Reimbursed">
                                    <i class="fa fa-registered" aria-hidden="true"></i>
                                </button>
                                Reimbursed
                            <?php } ?>
                        </span>
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


