<?php
include_once ('./layout/HeaderAdmin.php');
?>
<?php
include_once ('../database.php');
?>
<?php
$sql = "select * from tbl_product;";
$result = mysqli_query($conn,$sql);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
</head>
<body>
<?php
include_once ('menu_controller.php');
?>

<div class="functionAddProduct">
<!--    --><?php
//    if (isset($_POST['prd_name']) && isset($_POST['prd_category']) && isset($_POST['prd_img'])) {
//        $prd_id = $_POST['prd_id'];
//        $prd_name = $_POST['prd_name'];
//        $prd_type = $_POST['prd_type'];
//        $prd_gender = $_POST['prd_gender'];
//        $brand = $_POST['prd_brand'];
//        $price = $_POST['prd_price'];
//        $prd_img = $_POST['prd_image'];
//    }
//
//
//    ?>

    <div class="management_product">
        <form class="form-horizontal" action="<?php $_SERVER['PHP_SELF']?>" method="post">
            <fieldset>
                <br>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="prd_name">Tên Sản Phẩm</label>
                    <div class="col-md-4">
                        <input id="prd_name" name="prd_name" placeholder="Tên Sản Phẩm" class="form-control input-md" required="" type="text">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="prd_machine">Loại Máy</label>
                    <div class="col-md-4">
                        <input id="prd_type" name="prd_type" placeholder="Enter type" class="form-control input-md" required="" type="text">

                    </div>
                </div>
                <!-- Select Basic -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="prd_category">Dành cho</label>
                    <div class="col-md-4">
                        <input id="prd_gender" name="prd_gender" placeholder="Phân Loại" class="form-control input-md" required="" type="text">

                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="prd_trademark">Thương Hiệu</label>
                    <div class="col-md-4">
                        <input id="prd_brand" name="prd_brand" placeholder="Thương Hiệu" class="form-control input-md" required="" type="text">

                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="">Giá</label>
                    <div class="col-md-4">
                        <input id="prd_price" name="prd_price" placeholder="Enter price" class="form-control input-md" required="" type="text">

                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="prd_image">Image</label>
                    <div class="col-md-4">
                        <input id="prd_image" name="prd_image" placeholder="Enter picture file name" class="form-control input-md" required="" type="text">

                    </div>
                </div>
                <!-- Button -->
                <div class="form-group">
                    <label class="col-md-4 control-label" ></label>
                    <div class="col-md-4">
                        <button id="Add" name="Add" type="submit" class="btn btn-primary">Add</button>
                    </div>
                </div>

            </fieldset>
        </form>
    </div>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (empty($_POST['prd_name'])) {
                echo "<p class=".htmlspecialchars('text-danger').">Please enter product name</p> ";
            }
            elseif (empty($_POST['prd_type'])) {
                echo "<p class=".htmlspecialchars('text-danger').">Please enter type product</p> ";
            }
            elseif (empty($_POST['prd_gender'])) {
                echo "<p class=".htmlspecialchars('text-danger').">Please enter gender product</p> ";
            }
            elseif (empty($_POST['prd_brand'])) {
                echo "<p class=".htmlspecialchars('text-danger').">Please enter brand</p> ";
            }
            elseif (empty($_POST['prd_price'])) {
                echo "<p class=".htmlspecialchars('text-danger').">Please enter price</p> ";
            }
            elseif (empty($_POST['prd_image'])) {
                echo "<p class=".htmlspecialchars('text-danger').">Please enter img</p> ";
            }
            else {
                $prd_name = $_POST['prd_name'];

                $prd_type = $_POST['prd_type'];
                $prd_gender = $_POST['prd_gender'];
                $prd_brand = $_POST['prd_brand'];
                $price = $_POST['prd_price'];
                $prd_image = $_POST['prd_image'];

                $brand_tbl = "select * from tbl_category where cate_name ='$prd_brand' and gender ='$prd_gender'";
                $brand_result = mysqli_query($conn,$brand_tbl);
                if ($brand_result->num_rows == 0) {
                    $insert_new_brand = "insert into tbl_category (gender,cate_name) values('$prd_gender','$prd_brand')";
                    $inserting = $conn->query($insert_new_brand);

                }
                $brand_result = mysqli_query($conn,$brand_tbl);
                $cate_id = $brand_result->fetch_assoc()['cate_id'];
                }
                if ($result) {
                    $sql = "insert into tbl_product (prd_name,prd_type,prd_img,brand,price,prd_gender) values('$prd_name','$prd_type','$prd_image','$cate_id','$price','$prd_gender')";

                }
                $result = $conn ->query($sql);
                if ($result === TRUE) {
                    echo "<p class=".htmlspecialchars('text-success').">Add succesfully</p> ";

                    ?>

        <script>
            alert("Adding");
            window.location.href = "../Admin/Show.php";
        </script>
        <?php
                                                        }
                                                        else {
                                                            echo "<p class=".htmlspecialchars('text-danger').">Error</p> ";
                                                        }
                                                    }

        ?>

<!--    --><?php // if ($_SERVER['REQUEST_METHOD'] == "POST") {
//        $prd_name = $_POST['prd_name'];
//        echo $prd_name;
//    }?>
</div>
</body>
</html>
<?php
$conn->close();
?>