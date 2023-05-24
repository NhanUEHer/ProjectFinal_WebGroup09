<?php
    session_start();
    include('../db/connect.php');
?>
<?php
    if(isset($_POST['dangnhap'])){
        $taikhoan = $_POST['taikhoan'];
        $matkhau = md5($_POST['matkhau']);
        if($taikhoan=='' || $matkhau==''){
            echo "<script>alert('Vui lòng nhập đủ thông tin');</script>";
        }else{
            $sql_select_admin = mysqli_query($con,"SELECT * FROM tbl_admin WHERE email='$taikhoan' AND matkhau='$matkhau' LIMIT 1");
            $count = mysqli_num_rows($sql_select_admin);
            $row_dangnhap = mysqli_fetch_array($sql_select_admin);
            if($count>0){
                $_SESSION['dangnhap'] = $row_dangnhap['admin_name'];
                $_SESSION['admin_id'] = $row_dangnhap['admin_id'];
                header('Location: dashboard.php');
            }else{
                echo "<script>alert('Tài khoản hoặc mật khẩu không đúng');</script>";
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    

    <title>Đăng nhập Admin</title>
</head>
<body>
    <h2 align="center">Đăng nhập Admin</h2>
    <div class="col-md-6">   
        <div class="form-group">
            <form action="" method="POST">
            <label>Tài khoản</label>
            <input type="text" name="taikhoan" placeholder="Điền email" class="form-control"><br>
            <label>Mật khẩu</label>
            <input type="password" name="matkhau" placeholder="Điền mật khẩu" class="form-control"><br>
            <input type="submit" name="dangnhap" class="btn btn-primary" value="Đăng nhập">
            </form>
        </div>
    </div>   
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'mota' );
        CKEDITOR.replace( 'chitiet' );
    </script>  
</body>
</html>