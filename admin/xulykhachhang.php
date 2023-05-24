<?php
    include('../db/connect.php');   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />

    <title>Khách hàng</title>
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
                <div class="col-md-12">
                    <h4>Khách hàng</h4>
                        <?php
                            $sql_select_khachhang = mysqli_query($con,"SELECT * FROM tbl_khachhang,tbl_giaodich WHERE tbl_khachhang.khachhang_id=tbl_giaodich.khachhang_id GROUP BY tbl_giaodich.magiaodich ORDER BY tbl_khachhang.khachhang_id DESC"); 
                            
                            // $sql_select_khachhang = mysqli_query($con,"SELECT DISTINCT tbl_khachhang.khachhang_id, tbl_khachhang.cus_name, tbl_khachhang.cus_phone, tbl_khachhang.cus_addr, tbl_khachhang.cus_email,tbl_giaodich.ngaythang, tbl_giaodich.magiaodich FROM tbl_khachhang INNER JOIN tbl_giaodich ON tbl_khachhang.khachhang_id = tbl_giaodich.khachhang_id ORDER BY tbl_khachhang.khachhang_id DESC");
                        ?>
                    <table class="table table-bordered" margin = 0 width = 90%">
                        <tr>
                            <th>Thứ tự</th>
                            <th>Tên khách hàng</th>
                            <th>Số điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Email</th>
                            <th>Ngày mua</th>
                            <th>Quản lý</th>
                        </tr>
                            <?php
                                $i = 0;
                                while($row_khachhang = mysqli_fetch_array($sql_select_khachhang)){
                                    $i++;
                            ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row_khachhang['cus_name']; ?></td>
                            <td><?php echo $row_khachhang['cus_phone']?></td>
                            <td><?php echo $row_khachhang['cus_addr']?></td>
                            <td><?php echo $row_khachhang['cus_email']?></td>
                            <td><?php echo $row_khachhang['ngaythang']?></td>
                            <td><a href="?quanly=xemgiaodich&khachhang=<?php echo $row_khachhang['magiaodich']?>">Xem giao dịch</a></td>
                        </tr>
                            <?php
                            }
                            ?>
                    </table>
                </div>
            <div class="col-md-12">
                <h4>Liệt kê lịch sử đơn hàng</h4>
                    <?php
                        if(isset($_GET['khachhang'])){
                        $magiaodich = $_GET['khachhang'];
                    }else{
                        $magiaodich = '';
                    }
                        $sql_select = mysqli_query($con,"SELECT * FROM tbl_giaodich, tbl_khachhang, tbl_sanpham WHERE tbl_giaodich.sanpham_id = tbl_sanpham.sanpham_id AND tbl_khachhang.khachhang_id = tbl_giaodich.khachhang_id AND tbl_giaodich.magiaodich = '$magiaodich' ORDER BY tbl_giaodich.giaodich_id DESC");
                    ?>
                    <table class="table table-bordered" margin = 0 width = 90%">
                        <tr>
                            <th>Thứ tự</th>
                            <th>Mã giao dịch</th>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Ngày đặt</th>
                        </tr>
                    <?php
                        $i = 0;
                        while($row_donhang = mysqli_fetch_array($sql_select)){
                            $i++;
                    ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row_donhang['magiaodich']; ?></td>
                            <td><?php echo $row_donhang['sanpham_name']?></td>
                            <td><?php echo $row_donhang['soluong']?></td>
                            <td><?php echo $row_donhang['ngaythang']?></td>
                            <!-- <td><a href="?xoadonhang=<?php echo $row_donhang['mahang']?>">Xóa</a> || <a href="?quanly=xemdonhang&mahang=<?php echo $row_donhang['mahang']?>">Xem đơn hàng</a></td> -->
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