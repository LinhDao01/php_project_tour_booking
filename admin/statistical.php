<?php 
    session_start();
    include "../connect.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>ADMIN - Thống kê</title>
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
                <div class="menu px-3 pt-4 sticky">
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
                                        <a href="home.php" class="text-item">
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
                                    <li class="menu-item my-3 p-1"><a href="statistical.php" class="active"><i class="fa-solid fa-chart-column"></i>
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
                        <div class="">
                            <div class="page-header text-center py-3">
                                <h3>Thống kê doanh thu</small></h3>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading"></div>
                                <div class="panel-body table-responsive">
                                    <!-- <div class="search-bar">
                                        <div class="row d-flex justify-content-center p-3">
                                            <div class="col-md-auto mt-1">
                                                <input type="text" id="from" placeholder="Ngày bắt đầu" class="rounded enter" onfocus="(this.type='date')" onblur="(this.type='text')">
                                            </div>
                                            <div class="col-md-auto mt-1">
                                                <input type="text" id="to" placeholder="Ngày kết thúc" class="rounded enter" onfocus="(this.type='date')" onblur="(this.type='text')">
                                            </div>
                                            <div class="col-md-auto ">
                                                <input type="submit" value="Tìm kiếm" class="btn btn-primary me-4" /> <span>Doanh thu</span> 
                                            </div>
                                            
                                        </div>
                                    </div> -->
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Tên tour</th>
                                                <th>Số lượng vé đã bán</th>
                                                <th>Tổng doanh thu của tour</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        <?php
                                        $stmt = $conn->prepare("SELECT t.tID, t.tName,
                                                                    COALESCE(tt.total_tickets, 0) AS total_tickets,
                                                                    COALESCE(td.total, 0) AS total
                                                                FROM tours t LEFT JOIN (
                                                                            SELECT tID, COUNT(bTicketNum) AS total_tickets
                                                                            FROM tour_date td
                                                                            LEFT JOIN booking b ON td.tdID = b.tdID
                                                                            GROUP BY tID
                                                                            ) tt ON t.tID = tt.tID
                                                                            LEFT JOIN (
                                                                                SELECT tID, IFNULL(SUM(bTotal), 0) AS total
                                                                                FROM tour_date td
                                                                                LEFT JOIN booking b ON td.tdID = b.tdID
                                                                                GROUP BY tID
                                                                            ) td ON t.tID = td.tID
                                                                            WHERE t.tsoft_del = b'0';");
                                        $stmt->execute();
                                        $result = $stmt->get_result();

                                        while ($row = $result->fetch_assoc()) {
                                            echo "
                                                    <tr>
                                                        <td>". $row['tName'] ."</td>
                                                        <td>". $row['total_tickets'] ."</td>
                                                        <td>". $row['total'] ."</td>
                                                    </tr>
                                               ";
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