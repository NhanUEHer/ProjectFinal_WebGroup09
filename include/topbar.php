<?php
	if(isset($_POST['dangnhap_home'])){
        $taikhoan = $_POST['email_login'];
        $matkhau = md5($_POST['password_login']);
        if($taikhoan=='' || $matkhau==''){
            echo "<script>alert('Vui lòng nhập đủ thông tin');</script>";
        }else{
            $sql_select_admin = mysqli_query($con,"SELECT * FROM tbl_khachhang WHERE cus_email='$taikhoan' AND password='$matkhau' LIMIT 1");
            $count = mysqli_num_rows($sql_select_admin);
            $row_dangnhap = mysqli_fetch_array($sql_select_admin);
            if($count>0){
                $_SESSION['dangnhap_home'] = $row_dangnhap['cus_name'];
                $_SESSION['khachhang_id'] = $row_dangnhap['khachhang_id'];
				header('Location: index.php?quanly=giohang');
            }else{
                echo "<script>alert('Tài khoản hoặc mật khẩu không đúng');</script>";
            }
        }
    }
?>
<!-- top-header -->
<div class="agile-main-top">
		<div class="container-fluid">
			<div style="background-color:#ffd400de;" class="row main-top-w3l py-2">
				<div class="col-lg-4 header-most-top">
					
				</div>
				<div class="col-lg-8 header-right mt-lg-0 mt-2">
					<!-- header lists -->
					<ul>
					<?php 
						if(isset($_SESSION['dangnhap_home'])){
					?>
						<li class="text-center border-right border-dark text-black">
							<a href="index.php?quanly=xemdonhang&khachhang=<?php echo $_SESSION['khachhang_id'] ?>" style="color:#000;">
								<i class="fas fa-truck mr-2"></i>Kiểm tra đơn hàng <?php echo $_SESSION['dangnhap_home'] ?></a>
						</li>
					<?php 
						}
					?>
						<li class="text-center border-right border-dark text-black">
							<i class="fas fa-phone mr-2" style="color:#000;"></i style="color:#000;"> 093 478 3313
						</li>
						<li class="text-center border-right border-dark text-black">
							<a href="#" data-toggle="modal" data-target="#dangnhap" style="color:#000;">
								<i class="fas fa-sign-in-alt mr-2"></i> Đăng nhập </a>
						</li>
						<li class="text-center text-black">
							<a href="#" data-toggle="modal" data-target="#dangky" style="color:#000;">
								<i class="fas fa-sign-out-alt mr-2"></i>Đăng ký </a>
						</li>
					</ul>
					<!-- //header lists -->
				</div>
			</div>
		</div>
	</div>

	<!-- log in -->
	<div class="modal fade" id="dangnhap" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title text-center" style="color:#000;"">Đăng nhập</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="#" method="post">
						<div class="form-group">
							<label class="col-form-label">Email</label>
							<input type="text" class="form-control" placeholder=" " name="email_login" required="">
						</div>
						<div class="form-group">
							<label class="col-form-label">Mật khẩu</label>
							<input type="password" class="form-control" placeholder=" " name="password_login" required="">
						</div>
						<div class="right-w3l">
							<input type="submit" class="form-control" name="dangnhap_home"value="Đăng nhập" style="background-color:#ffd400; color:#000;">
						</div>
						<div class="sub-w3l">
							
						</div>
						<p class="text-center dont-do mt-3">Chưa có tài khoản?
							<a href="#" data-toggle="modal" data-target="#exampleModal2">
								Đăng ký</a>
						</p>
					</form>
				</div>
			</div>
		</div>
	</div>
    <!-- register -->
	<div class="modal fade" id="dangky" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" style="color:#000;">Đăng ký</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="#" method="post">
						<div class="form-group">
							<label class="col-form-label">Tên khách hàng</label>
							<input type="text" class="form-control" placeholder=" " name="Name" required="">
						</div>
						<div class="form-group">
							<label class="col-form-label">Email</label>
							<input type="email" class="form-control" placeholder=" " name="Email" required="">
						</div>
						<div class="form-group">
							<label class="col-form-label">Mật khẩu</label>
							<input type="password" class="form-control" placeholder=" " name="Password" id="password1" required="">
						</div>
						<div class="form-group">
							<label class="col-form-label">Xác nhận mật khẩu</label>
							<input type="password" class="form-control" placeholder=" " name="Confirm Password" id="password2" required="">
						</div>
						<div class="right-w3l">
							<input type="submit" class="form-control" value="Đăng ký" style="background-color:#ffd400; color:#000;">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- //modal -->
	<!-- //top-header -->
    <!-- header-bottom-->
	<div class="header-bot" style="background-color:#ffe562">
		<div class="container">
			<div class="row header-bot_inner_wthreeinfo_header_mid">
				<!-- logo -->
				<div class="col-md-3 logo_agile">
					<h1 class="text-center">
						<a href="index.php" class="font-weight-bold font-italic" style="color:#000;">
							<i style="font-size:40px;">GeekVape</i> <i style="font-size:15px;">Store</i>
						</a>
					</h1>
				</div>
				<!-- //logo -->
				<!-- header-bot -->
				<div class="col-md-9 header mt-4 mb-md-0 mb-4">
					<div class="row">
						<!-- search -->
						<div class="col-10 agileits_search">
							<form class="form-inline" action="index.php?quanly=timkiem" method="POST">
								<input class="form-control mr-sm-2" name="search-product" type="search" placeholder="Tìm kiếm sản phẩm" aria-label="Search" required>
								<button style="background-color:rgba(255,172,10,.6); color:#000;" class="btn my-2 my-sm-0" name="search_button" type="submit">Tìm kiếm</button>
							</form>
						</div>
						<!-- //search -->
						<!-- cart details -->
						<div class="col-2 top_nav_right text-center mt-sm-0 mt-2">
							<div class="wthreecartaits wthreecartaits2 cart cart box_1">
								<form action="?quanly=giohang" method="post" class="last">
									<input type="hidden" name="cmd" value="_cart">
									<input type="hidden" name="display" value="1">
									<button  style="background-color:rgba(255,172,10,.6); color:#000" class="btn w3view-cart" type="submit" name="submit" value="">
										<i class="fas fa-cart-arrow-down"></i>
									</button>
								</form>
							</div>
						</div>
						<!-- //cart details -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- shop locator (popup) -->
	<!-- //header-bottom -->
	<!-- navigation -->