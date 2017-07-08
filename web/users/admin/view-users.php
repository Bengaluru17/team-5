<?php
include '../index.php';
include 'sidebar.php';
?>

<div class="main-body">
    <div class="pagetitle">
        Views Users
    </div>
    <div class="view-users">
        <?php

        $getlist = "SELECT * FROM login";
        $result = $conn->query($getlist);
        $search_result = $result;

        //            if ($get_search != "")
        //            {   $search_getlist = "SELECT * FROM customer WHERE zone=$cur_zone && contact= ".$get_search." ";
        //                $search_result = $conn->query($search_getlist);
        //            }
        ?>
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
    </div>
</body>
</html>


