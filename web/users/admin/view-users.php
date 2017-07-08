<?php
include '../index.php';
include 'sidebar.php';
?>

<div class="main-body">
    <div class="pagetitle">
        Views Users
    </div>
    <div class="viewusers">
        <?php

        $getlist = "SELECT * FROM login";
        $result = $conn->query($getlist);
        $search_result = $result;

        //            if ($get_search != "")
        //            {   $search_getlist = "SELECT * FROM customer WHERE zone=$cur_zone && contact= ".$get_search." ";
        //                $search_result = $conn->query($search_getlist);
        //            }
        ?>
    </div>
        <table>
            <tr>
                <th style="width:20%">Username</th>
                <th style="width:25%">Name</th>
                <th style="width:25%">Email</th>
                <th style="width:20%">Contact</th>
                <th style="width:10%">Permissions</th>
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
                    <td
                    <td>
                        <form action="#" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="cid" value="<?php echo $row[0]; ?>">
                            <input type="hidden" name="type" value="edit">
                            <button type="submit" title="Edit Details">
                                <i class="fa fa-pencil"></i>
                            </button>
                        </form>

                        <form action="#" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="cid" value="<?php echo $row[0]; ?>">
                            <input type="hidden" name="type" value="view">
                            <button type="submit" title="View Details">
                                <i class="fa fa-eye"></i>
                            </button>
                        </form>

                        <form action="#" method="POST"">
                        <input type="hidden" name="cid" value="<?php echo $row[0]; ?>">
                        <input type="hidden" name="Del_Type" value="del">
                        <button type="submit" title="Delete">
                            <i class="fa fa-trash"></i>
                        </button>
                        </form>

                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
</body>
</html>


