<?php
include '../index.php';
include 'sidebar.php';

//if(isset($_GET['search'])){
//    $get_search = $_GET['search'];
//}

$getlist = "SELECT * FROM inventory";
$result = $conn->query($getlist);
$search_result = $result;

if (isset($_GET['gender']) || isset($_GET['category']))
{   if(strcmp ($_GET['gender'],"both") == 0 && strcmp($_GET['category'],"all") == 0)
        $getlist = "SELECT * FROM inventory";
    if(strcmp ($_GET['gender'],"both") == 0 && strcmp($_GET['category'],"all") != 0)
        $getlist = 'SELECT * FROM inventory WHERE `category`="'.$_GET['category'].'"';
    if(strcmp ($_GET['gender'],"both") != 0 && strcmp($_GET['category'],"all") == 0)
        $getlist = 'SELECT * FROM inventory WHERE `gender`="'.$_GET['gender'].'"';
    $search_result = $conn->query($getlist);
//    $row = mysqli_fetch_row($search_result);
//    echo $row[2];
}
?>

<div class="main-body">
    <div class="pagetitle">
        Inventory Stock
    </div>
    <section class="userfilter">
        <form method="GET" action="view-inventory.php" id="searchForm">
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
                <button type="submit" class="btn btn-primary">Filter Users</button>
            </div>
        </form>
    </section>
    <!--    --><?php //if($search_result)
    //    { ?>
    <div class="view-users">
        <table>
            <tr>
                <th style="width:15%">Category</th>
                <th style="width:20%">Name</th>
                <th style="width:20%">Count</th>
                <th style="width:15%">Dormitory</th>
                <th style="width:15%">Operations</th>
            </tr>

            <?php
            while ($row = mysqli_fetch_row($search_result)) {
                ?>
                <tr>
                    <td><?php
                        if(strcmp ($row[4],"st") == 0) echo "Stationary";
                        if(strcmp ($row[4],"kt") == 0) echo "Kitchen";
                        if(strcmp ($row[4],"ut") == 0) echo "Utilities";
                        if(strcmp ($row[4],"md") == 0) echo "Medication";
                        ?>
                    </td>
                    <td><?php echo $row[1]; ?></td>
                    <td><?php echo $row[2]; ?></td>
                    <td><?php
                        if(strcmp ($row[0],"m") == 0) echo "Male";
                        if(strcmp ($row[0],"f") == 0) echo "Female";
                        ?>
                    </td>
                    <td>
                        <span>
                        <button type="submit" title="Edit Details">
                            <i class="fa fa-pencil"></i>
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
</div>
</body>
</html>