<?php
    include('../db/connect.php');   
?>
<?php
    
    if(isset($_POST['themdanhmuc'])){
        $tendanhmuc = $_POST['danhmuc'];
        $category_menu = $_POST['category_menu'];
        
        // Lấy danh sách danh mục từ cơ sở dữ liệu
        $sql_select = mysqli_query($con,"SELECT category_name FROM tbl_category");
        $flag = true;
        
        while($row = mysqli_fetch_assoc($sql_select)){
            // Nếu tên danh mục đã tồn tại trong danh sách
            if(strtolower($tendanhmuc) == strtolower($row['category_name'])){
                $flag = false;
                echo "<script>alert('Tên danh mục đã tồn tại');</script>";
                break;
            }
        }
        // Nếu tên danh mục chưa tồn tại trong danh sách
        if($flag){
            $sql_insert = mysqli_query($con,"INSERT INTO tbl_category(category_name,category_menu) values ('$tendanhmuc','$category_menu')");
            header('Location: xulydanhmuc.php', true, 303);
            exit;
        }
    }elseif(isset($_POST['capnhatdanhmuc'])){
        $id_post = $_POST['id_danhmuc'];
        $tendanhmuc = $_POST['danhmuc'];
        $category_menu = $_POST['category_menu'];
        $sql_update = mysqli_query($con,"UPDATE tbl_category SET category_name = '$tendanhmuc',category_menu = '$category_menu' WHERE category_id='$id_post'");
        header('Location: xulydanhmuc.php');
    }
    if(isset($_GET['xoa'])){
        $id= $_GET['xoa'];
        $sql_xoa = mysqli_query($con,"DELETE FROM tbl_category WHERE category_id='$id'");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />

    <title>Danh mục</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="xulydonhang.php">Đơn hàng <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="xulydanhmuc.php">Danh mục</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="xulysanpham.php">Sản phẩm</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="xulydanhmucbaiviet.php">Danh mục bài viết</a>
            </li>
            <li class="nav-item">
	        <a class="nav-link" href="xulybaiviet.php">Bài viết</a>
	        </li>
            <li class="nav-item">
                <a class="nav-link" href="xulykhachhang.php">Khách hàng</a>
            </li>
            </ul>
        </div>
    </nav><br>
    <div class="container">
        <div class="row">
            <?php
                if(isset($_GET['quanly'])=='capnhat'){
                    $id_capnhat = $_GET['id'];
                    $sql_capnhat = mysqli_query($con,"SELECT * FROM tbl_category WHERE category_id='$id_capnhat'");
                    $row_capnhat = mysqli_fetch_array($sql_capnhat);
            ?>
            <div class="col-md-4">
                <h4>Cập nhật danh mục</h4>
                    <form action="" method = "POST">
                        <label>Cập nhật danh mục</label>
                        <input type="text" class="form-control" name="danhmuc" value="<?php echo $row_capnhat['category_name'] ?> "><br>
                        <input type="hidden" class="form-control" name="id_danhmuc" value="<?php echo $row_capnhat['category_id'] ?> ">
                        <label>Danh mục chính</label>
                        <select name="category_menu" class="form-control">
                            <option value="0">Không</option>
                            <option value="1">Có</option>
                        </select><br>
                        <input type="submit" name="capnhatdanhmuc" value="Cập nhật danh mục" class="btn btn-default">
                    </form>
            </div>
            <?php
                }else{
            ?>
            <div class="col-md-4">
                <h4>Thêm danh mục</h4>
                <form action="" method = "POST">
                        <label>Tên danh mục</label>
                        <input type="text" class="form-control" name="danhmuc" placeholder="Tên danh mục"><br>
                        <label>Danh mục chính</label>
                        <select name="category_menu" class="form-control">
                            <option value="0">Không</option>
                            <option value="1">Có</option>
                        </select><br>
                        <input type="submit" name="themdanhmuc" value="Thêm danh mục" class="btn btn-default">
                    </form>
            </div>
            <?php
                }
            ?>
            <div class="col-md-8">
                <h4>Liệt kê danh mục</h4>
                <?php
                    $sql_select = mysqli_query($con,"SELECT * FROM tbl_category ORDER BY category_id DESC");
                ?>
                <table class="table table-bordered">
                    <tr>
                        <th>Thứ tự</th>
                        <th>Tên danh mục</th>
                        <th>Danh mục chính</th>
                        <th>Quản lý</th>
                    </tr>
                    <?php
                        $i = 0;
                        while($row_category = mysqli_fetch_array($sql_select)){
                            $i++;
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $row_category['category_name']?></td>
                        <td><?php echo $row_category['category_menu']== 1 ? 'Có' : 'Không';?></td>
                        <td><a href="?xoa=<?php echo $row_category['category_id']?>">Xóa</a> || <a href="?quanly=capnhat&id=<?php echo $row_category['category_id']?>">Cập nhật</a></td>
                    </tr>
                    <?php
                        }
                    ?>
                </table>
            </div>

        </div>
    </div>
</body>
</html>