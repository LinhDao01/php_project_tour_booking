<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>ADMIN - Chi tiết tour</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" /> -->
    <link rel="stylesheet" href="../bootstrap-5.3.3-dist/css/bootstrap.min.css">    
    <!-- css -->
    <link rel="stylesheet" href="../css/admin.css" />
    <!-- icon -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" /> -->
    <!-- fontawesome -->
    <script src="https://kit.fontawesome.com/1ee92f529b.js" crossorigin="anonymous"></script>

</head>

<body>
    <main class="">
        <div class="row g-0">
            <!-- sidebar -->
            <div class="col-2">
                <div class="menu px-3 pt-4">
                    <nav class="navbar navbar-expand-lg">
                        <div class="menu-content">
                            <div class="menu-head">
                                <div class="logo">
                                    <a href="home.php"><img src="../pic/logo-4.png" alt=""></a>
                                </div>
                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#navbarmenu" aria-controls="navbarmenu" aria-expanded="false"
                                    aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                            </div>
                            <div class="menu-body" id="navbarmenu">
                                <ul class="menu-list ">
                                    <li class="menu-item my-3 p-1">
                                        <a href=" home.php" class="text-item">
                                            <i class="fa-solid fa-house"></i> Tổng quan
                                        </a>
                                    </li>
                                    <li class="menu-item my-3 p-1">
                                        <a class="nav-link btn-account active text-light" href="#tour" role="button"
                                            data-bs-toggle="collapse" aria-expanded="false" aria-controls="tour">
                                            <i class="fa-solid fa-bars-progress"></i> Quản lý tour <i
                                                class="fa-solid fa-caret-down"></i>
                                        </a>
                                        <div class="collapse" id="tour">
                                            <ul class="flex-column">
                                                <li class="mt-3"><a class="text-item" href=" tourtype.php">Quản lý phân loại tour</a></li>
                                                <li class="mt-3"><a class="text-item" href=" tourinfo.php">Quản lý thông tin tour</a></li>                                        
                                                <li class="mt-3"><a class="text-item" href=" tourstatus.php">Quản lý trạng thái</a>
                                                <ul class="flex-column">
                                                    <li class="mt-3"><a class="active" href=" tourstatusDetail.php">Chi tiết</a></li>
                                                </ul>
                                                </li>
                                                
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="menu-item my-3 p-1">
                                        <a class="nav-link btn-account text-item" href="#account" role="button"
                                            data-bs-toggle="collapse" aria-expanded="false" aria-controls="account">
                                            <i class="fa-solid fa-users"></i> Quản lý tài khoản <i
                                                class="fa-solid fa-caret-down"></i>
                                        </a>
                                        <div class="collapse" id="account">
                                            <ul class="flex-column">
                                                <li class="mt-3"><a class="text-item" href=" account-cus.php">Người dùng</a></li>
                                                <li class="mt-3"><a class="text-item" href=" account-staff.php">Nhân viên</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="menu-item my-3 p-1"><a href=" suggest.php" class="text-item"><i class="fa-solid fa-star"></i> 
                                        Gợi ý tour</a></li>
                                    <li class="menu-item my-3 p-1"><a href=" statistical.php" class="text-item"><i class="fa-solid fa-chart-column"></i>
                                        Thống kê</a></li>
                                    <li class="menu-item my-3 p-1"><a href="../logout.php" class="text-item"><i class="fas fa-sign-out-alt"></i>
                                        Đăng xuất</a></li> 
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>

            </div>
            <!-- content -->

            <div class="col-10">
                <div class="header">
                    <div class="container-fluid">
                        <div class="text-end pe-5">
                            <a class="text-black fs-5" aria-current="page" href="/user/profile.php"><?php echo $_SESSION["username"]; ?></a>
                        </div>
                    </div>
                </div>
                <div class="content">
                    <div class="container">
                        <!-- đường dẫn -->
                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="#quản_lý_tour">Quản lý tour</a></li>
                              <li class="breadcrumb-item"><a href=" tourstatus.php">Quản lý trạng thái</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Chi tiết</li>
                            </ol>
                          </nav>
                        <!-- content-body -->
                        <div class="">
                            <div class="page-header text-center pt-3">
                                <h3>Thông tin chi tiết</small></h3>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 tour-detail">
                                <div class="row">
                                    <div class="col-4 pic">
                                        <img src="/pic/back4.jpg" alt="" class="w-100 h-75">
                                    </div>
                                    <div class="col-8 detail ">
                                        <div class="col-12 border border-secondary">
                                            <div class="head text-center ">
                                                <h4 class="text-success">Tour Côn Đảo 2N2Đ: Côn Đảo Huyền Thoại (Tàu Cao Tốc)</h4>
                                            </div>
                                            <hr>
                                            <div class="list-info ">
                                                <div class="col-12">
                                                    <div class="row mb-3">
                                                        <div class="col-3 ms-2">
                                                            <div class="">Mã tour: </div>
                                                            <div class="">Thời gian tour: </div>
                                                            <div class="">Ngày khởi hành: </div>
                                                            <div class="">Nơi khởi hành: </div>
                                                        </div>
                                                        <div class="col-7 fw-semibold">
                                                            <div class="">CD1234 </div>
                                                            <div class="">2 ngày 2 đêm </div>
                                                            <div class="">05/04/2024</div>
                                                            <div class="">Hồ Chí Minh</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading fs-4 text-center">Danh sách người đặt</div>
                                <div class="panel-body table-responsive">

                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>IDcus</th>
                                                <th>Họ tên</th>
                                                <th>Số điện thoại</th>
                                                <th>Email</th>
                                                <th>Số lượng vé</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Table cell</td>
                                                <td>Table cell</td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Table cell</td>
                                                <td>Table cell</td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Table cell</td>
                                                <td>Table cell</td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </main>


    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="../bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script> -->

</body>

</html>