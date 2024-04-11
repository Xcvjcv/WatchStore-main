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

<?php
include_once ('menu_controller.php');
?>

<div class="ManagementUser">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12 col-md-6"></div>
                        <div class="col-sm-12 col-md-6"></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <table  class="table table-bordered table-hover dataTable" role="grid" >
                                <thead>
                                <tr role="row">
                                    <th style="text-align: center;" class="sorting_asc" tabindex="0"  rowspan="1" colspan="1">ID</th>
                                    <th style="text-align: center;" class="sorting" tabindex="0"  rowspan="1" colspan="1">Tên Người Dùng</th>
                                    <th style="text-align: center;" class="sorting" tabindex="0"  rowspan="1" colspan="1">type</th>
                                    <th style="text-align: center;" class="sorting" tabindex="0"  rowspan="1" colspan="1">img</th>
                                    <th style="text-align: center;" class="sorting" tabindex="0"  rowspan="1" colspan="1">brand</th>
                                    <th style="text-align: center;" class="sorting" tabindex="0"  rowspan="1" colspan="1">price</th>
                                    <th style="text-align: center;" class="sorting" tabindex="0"  rowspan="1" colspan="1">for</th>
                                    <th style="text-align: center;" class="sorting" tabindex="0"  rowspan="1" colspan="1">delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php while($row = $result->fetch_assoc()) {?>
                                    <tr role="row" class="odd">
                                        <td class="sorting_1"><?php echo $row['prd_id']?></td>
                                        <td><?php echo $row['prd_name']?></td>
                                        <td><?php echo $row['prd_type']?></td>
                                        <td>
                                            <img width="50px" src="<?php echo $row['prd_img']?>" alt="">
                                        </td>
                                        <td><?php echo $row['brand']?></td>
                                        <td><?php echo $row['price']?></td>
                                        <td><?php echo $row['prd_gender']?></td>
                                    <td><button type="button" class="btn btn-danger" onclick="delete_prd(<?php echo $row['prd_id']?>)">Delete</button></td>
                                    </tr>
                                    <?php
                                }
                                if (isset($_POST['prd_id'])) {
                                    $prd_id = $_POST['prd_id'];
                                    $delete_prd = "DELETE FROM tbl_product WHERE prd_id ='prd_id' ";
                                    $deleted_prd = mysqli_query($conn, $delete_prd);
                                    if ($deleted_prd) {
                                        echo "Deleted";
                                    }
                                    else {
                                        echo 'Error executing SQL script: ' . mysqli_error($conn);
                                    }
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <script>
        function delete_prd(prd_id) {
            // Make AJAX request to the PHP file
            var xhr = new XMLHttpRequest();
            xhr.open('POST', window.location.href, true);
            // Create a new FormData object and append the value to it
            var formData = new FormData();
            formData.append('prd_id', prd_id);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    alert("Updating");
                    window.location.href = "../Admin/Show.php";
                }
            };
            xhr.send(formData);
        }
    </script>
