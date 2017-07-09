<?php
include '../index.php';
include 'sidebar.php';
if(!isset($_SESSION['perm']) || strcmp($_SESSION['perm'],"ac")!=0)
    header('Location: logout.php');

if(isset($_POST['name']))
{
    $item_category = $_POST['category'];
    $item_name = $_POST['name'];
    $item_quantity = $_POST['quantity'];
    $item_price = $_POST['price'];
    $item_gender = $_POST['gender'];
    $item_username = $_SESSION['username'];
    $item_status = "in";
    $insert = "INSERT INTO `requests`(`price`, `quantity`, `item`, `status`, `category`, `gender`, `username`)
                VALUES ('$item_price','$item_quantity','$item_name','$item_status','$item_category','$item_gender','$item_username')";
    $conn->query($insert);
}

?>
    <div class="main-body">
        <div class="pagetitle">
            Request an Item
        </div>
        <div class="addform">
            <form name="RegForm" class="login-container" method="POST" action="add-request.php">
                <p><select name="category">
                        <option value="st">Stationary</option>
                        <option value="kt">Kitchen</option>
                        <option value="ut">Utilities</option>
                        <option value="md">Medication</option>
                    </select>
                </p>
                <p><input id="name" name="name" type="text" placeholder="Item Name*" required></p>
                <p><input id="quantity" name="quantity" type="text" placeholder="Quantity*" required></p>
                <p><input id="price" name="price" type="text" placeholder="Price per unit*" required></p>
                <p><select name="gender">
                        <option value="m">Male</option>
                        <option value="f">Female</option>
                    </select>
                </p>
                <p><input type="hidden" value="Yes" name="AddUser">
                    <button type="submit" class="btn btn-primary">Request this item!</button></p>
            </form>
        </div>
    </div>
</body>
</html>
