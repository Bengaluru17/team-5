<?php
include '../index.php';
include 'sidebar.php';

if(!isset($_SESSION['perm']) || strcmp($_SESSION['perm'],"wa")!=0)
    header('Location: logout.php');

$getlist = 'SELECT * FROM requests WHERE username = "' . $_SESSION['username'] . '"';
$result = $conn->query($getlist);
$search_result = $result;

if (isset($_GET['gender']) || isset($_GET['category']))
{   if(strcmp ($_GET['gender'],"both") == 0 && strcmp($_GET['category'],"all") == 0)
    $getlist = "SELECT * FROM requests";
    if(strcmp ($_GET['gender'],"both") == 0 && strcmp($_GET['category'],"all") != 0)
        $getlist = 'SELECT * FROM requests WHERE `category`="'.$_GET['category'].'" AND username = "' . $_SESSION['username'] . '"';
    if(strcmp ($_GET['gender'],"both") != 0 && strcmp($_GET['category'],"all") == 0)
        $getlist = 'SELECT * FROM requests WHERE `gender`="'.$_GET['gender'].'" AND username = "' . $_SESSION['username'] . '"';
    if(strcmp ($_GET['gender'],"both") != 0 && strcmp($_GET['category'],"all") != 0)
        $getlist = 'SELECT * FROM requests WHERE `gender`="'.$_GET['gender'].'" AND `category`="'.$_GET['category'].'" AND username = "' . $_SESSION['username'] . '"';
    $search_result = $conn->query($getlist);
}

if(isset($_POST['Update_Type']))
{
    if($_POST['Update_Type']=="bo") {
        $to_reqid = $_POST['reqid'];
        $update = 'UPDATE requests SET status = "bo" WHERE reqid = ' . $to_reqid . '';
        $run_update = $conn->query($update);
        header('Location: view-requests.php');
    }
}
?>

<div class="main-body">
    <div class="pagetitle">
        View your Requests
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
                                Not approved
                            <?php
                            } else if( strcmp ($row[4],"ap") == 0) {
                            ?>
                                <form action="view-requests.php" method="POST"">
                                <input type="hidden" name="reqid" value="<?php echo $row[0]; ?>">
                                <input type="hidden" name="Update_Type" value="bo">
                                <button type="submit" title="Initiated">
                                    <i class="fa fa-thumbs-up"></i>
                                </button>
                                </form>
                                Bought?
                            <?php
                            } else if( strcmp ($row[4],"bo") == 0) {
                            ?>
                                <button type="submit" title="Not reimbursed">
                                    <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                                </button>
                                Not reimbursed

                            <?php
                            } else if( strcmp ($row[4],"re") == 0) {
                             ?>
                                <button type="submit" title="Reimbursed">
                                    <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                                </button>
                                Not reimbursed
                            <?php } ?>
                        </span>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
    </div>
</body>
</html>