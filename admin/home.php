<?php 
    session_start();
    include "../connect.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>ADMIN - home</title>
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
                                        <a href="home.php" class="active">
                                            <i class="fa-solid fa-house"></i> Tổng quan
                                        </a>
                                    </li>
                                    <li class="menu-item my-3 p-1">
                                        <a class="nav-link btn-account text-item" href="#tour" role="button"
                                            data-bs-toggle="collapse" aria-expanded="false" aria-controls="tour">
                                            <i class="fa-solid fa-bars-progress"></i> Quản lý tour <i
                                                class="fa-solid fa-caret-down"></i>
                                        </a>
                                        <div class="collapse" id="tour">
                                            <ul class="flex-column">
                                                <li class="mt-3"><a class="text-item" href="tourtype.php">Quản lý phân loại tour</a></li>
                                                <li class="mt-3"><a class="text-item" href="tourinfo.php">Quản lý thông tin tour</a></li>                                        
                                                <li class="mt-3"><a class="text-item" href="tourstatus.php">Quản lý trạng thái</a>
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
                                                <li class="mt-3"><a class="text-item" href="account-cus.php">Người dùng</a></li>
                                                <li class="mt-3"><a class="text-item" href="account-staff.php">Nhân viên</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="menu-item my-3 p-1"><a href="suggest.php" class="text-item"><i class="fa-solid fa-star"></i> 
                                        Gợi ý tour</a></li>
                                    <li class="menu-item my-3 p-1"><a href="statistical.php" class="text-item"><i class="fa-solid fa-chart-column"></i>
                                        Thống kê</a></li>
                                    <li class="menu-item my-3 p-1"><a href="../logout.php" class="text-item"><i class="fas fa-sign-out-alt"></i>
                                        Đăng xuất</a></li> 
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>

            </div>
            <!-- tổng quan -->
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
                        <div class="header-content">
                            <h3 class="fw-bold mt-3">Tổng quan</h3>
                        </div>
                        <div class="body-content mt-4">
                            <div class="col-12">
                                <div class='row g-2 d-flex'>
                                    <?php                           
                                    $stmt = $conn->prepare("SELECT COUNT(*) as total_t FROM tours");
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    if ($result->num_rows > 0) {
                                        $row = $result->fetch_assoc();
                                        $total = $row['total_t'];
                                    echo "<div class='col-3 rounded mycard mx-4'>
                                            <div class='p-2 d-flex'>
                                                <div class=' '>
                                                    <i class='fa-solid fa-location-dot rounded-5 p-3 fs-3 icon'></i>
                                                </div>
                                                <div><p class='ms-2 mt-3'>Số lượng tour hiện có: <span>". $total."</span> </p></div>
                                            </div>
                                        </div>";
                                        }
                                    $stmt->close();
                                    
                                    $stmt1 = $conn->prepare("SELECT COUNT(*) as total_ad FROM advise");
                                    $stmt1->execute();
                                    $result1 = $stmt1->get_result();

                                    if ($result1->num_rows > 0) {
                                        $row1 = $result1->fetch_assoc();
                                        $total1 = $row1['total_ad'];
                                    echo "
                                        <div class='col-3 rounded mycard mx-4'>
                                            <div class='p-2 d-flex'>
                                                <div class=' '>
                                                    <i class='fa-solid fa-location-dot rounded-5 p-3 fs-3 icon'></i>
                                                </div>
                                                <div><p class='ms-2 mt-3'>Số lượng gợi ý: <span>". $total1 ."</span> </p></div>
                                            </div>
                                        </div>";
                                    }
                                    $stmt1->close();

                                    $stmt2 = $conn->prepare("SELECT sum(bTotal) AS total FROM booking");
                                    $stmt2->execute();
                                    $result2 = $stmt2->get_result();

                                    if ($result2->num_rows > 0) {
                                        $row2 = $result2->fetch_assoc();
                                        $total2 = $row2['total'];
                                        $formattedPrice = number_format($total2, 0, ',', '.');

                                    echo "<div class='col-3 rounded mycard mx-4'>
                                            <div class='p-2 d-flex'>
                                                <div class=' '>
                                                    <i class='fa-solid fa-location-dot rounded-5 p-3 fs-3 icon'></i>
                                                </div>
                                                <div><p class='ms-2 mt-3'>Tổng doanh thu: <span>". $formattedPrice ." VNĐ</span> </p></div>
                                            </div>
                                        </div>";
                                    }
                                    
                                        $stmt3 = $conn->prepare("SELECT COUNT(*) as total FROM tours WHERE tsoft_del = b'0'");
                                        $stmt3->execute();
                                        $result3 = $stmt3->get_result();
    
                                        if ($result3->num_rows > 0) {
                                            $row3 = $result3->fetch_assoc();
                                            $total3 = $row3['total'];

                                    echo "<div class='col-3 rounded mycard mx-4 my-4'>
                                            <div class='p-2 d-flex'>
                                                <div class=' '>
                                                    <i class='fa-solid fa-location-dot rounded-5 p-3 fs-3 icon'></i>
                                                </div>
                                                <div><p class='ms-2 mt-3'>Số tour khả dụng: <span>". $total3 ."</span> </p></div>
                                            </div>
                                        </div>
                                    </div>";
                                        $stmt3->close();
                                    }
                                    ?>
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