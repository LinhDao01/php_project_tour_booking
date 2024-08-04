<?php 
    session_start();
    include "../connect.php";
?>

<!DOCTYPE html>
<html lang="en"> 

<head>
    <title>Tên User</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" /> -->
    <link rel="stylesheet" href="../bootstrap-5.3.3-dist/css/bootstrap.min.css">
        <!-- css -->
    <link rel="stylesheet" href="../css/user.css" />
    <!-- icon -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" /> -->
    <!-- fontawesome -->
    <script src="https://kit.fontawesome.com/1ee92f529b.js" crossorigin="anonymous"></script>

</head>

<body>
    <header>
        <div class="container-fluid head1">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 my-1 logo-header">
                    <div class="container">
                        <nav class="navbar navbar-expand-lg">
                            <div class="col-3-lg me-5">
                                <div class="logo">
                                    <a href="../index.php" class="logo-wrapper">
                                        <img src="../pic/logo-4.png" alt="logo" class="logo"/>
                                    </a>
                                </div>
                            </div>
                            <!-- nút xuất hiện khi thu nhỏ màn hình tới break points, nếu k sẽ ẩn -->
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false"
                                aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarText">
                                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                    <li class="nav-item">
                                        <a class="nav-link active text-black fs-5" aria-current="page"
                                            href="../index.php">Tours</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-black fs-5" href="../introduce.php">Giới thiệu</a>
                                    </li>
                                </ul>
                                <ul class="navbar-nav float-end">
                                    <li class="nav-item d-flex">
                                        <?php echo "<img src='../pic/" . $_SESSION["img"] . "' alt='ảnh măc định' class='avatar-lg rounded-5'> " ?>
                                        
                                        <a class="nav-link text-black fs-5"
                                        href="profile.php"><?php echo $_SESSION["username"];?></a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="mt-3">
        <div class="container">

            <div class="row">
                <!-- side card -->
                <div class="col-lg-4">
                    <div class="mycard">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                            <div class="pic">
                                <?php echo "<img src='../pic/" . $_SESSION["img"] . "' alt='ảnh măc định' class='avatar-lg rounded-5'> " ?>
                                    
                                </div>
                                <div class="mt-3">
                                    <h4><?php echo $_SESSION["username"];?></h4>
                                </div>
                            </div>
                            <hr class="my-3" />
                            <div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex align-items-center pb-3 point">
                                        <a href="tour.php"><i class="fa-solid fa-cart-plus"></i>
                                            <span>Đơn hàng của tôi</span></a>
                                    </li>
                                    <li class="list-group-item d-flex align-items-center py-3">
                                        <a href="point.php"><i class="fa-solid fa-gifts"></i>
                                            <span>Tích điểm</span></a>
                                    </li>
                                    <li class="list-group-item d-flex align-items-center py-3">
                                        <a href="profile.php"><i class="fa-solid fa-user"></i>
                                            <span>Hồ sơ của tôi </span></a>
                                    </li>
                                    <li class="list-group-item d-flex align-items-center pt-3">
                                        <a href="suggest.php"><i class="fa-solid fa-ticket"></i>
                                            <span>Gợi ý thêm tour cho web</span></a>
                                    </li>
                                    <li class="list-group-item d-flex align-items-center pt-3">
                                        <a href="../logout.php"><i class="fas fa-sign-out-alt"></i>
                                            <span>Đăng xuất</span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end side card -->
                <!-- content card -->
                <div class="col-lg-8">
                    <div class="tour">
                        <ul class="nav nav-pills mb-3" id="tour-list-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="tour-future-tab" data-bs-toggle="pill"
                                    data-bs-target="#tour-future" type="button" role="tab" aria-controls="tour-future"
                                    aria-selected="true">
                                    Chuyến đi sắp tới
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="tour-history-tab" data-bs-toggle="pill"
                                    data-bs-target="#tour-history" type="button" role="tab" aria-controls="tour-history"
                                    aria-selected="false">
                                    Lịch sử chuyến đi
                                </button>
                            </li>
                        </ul>
                        <div class="mycard">
                            <div class="tab-content" id="tour-list-tabContent">
                                <div class="tab-pane fade show active" id="tour-future" role="tabpanel"
                                    aria-labelledby="tour-future-tab" tabindex="0">
                <!-- danh sách tour sắp tới -->
                <?php
                    if (!isset($conn)) {
                        echo "Không kết nối được đến CSDL";
                    } else {
                        $uid = $_SESSION['id'];
                        
                        $stmt = $conn->prepare("SELECT * FROM tour_date td
                                                LEFT JOIN booking b on b.tdID = td.tdID
                                                LEFT JOIN tours t on td.tID = t.tID
                                                WHERE uID = ? AND td.tStart > CURDATE()
                                                ORDER BY bStatus DESC");
                        $stmt->bind_param("i", $uid);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $tourID = $row['tID'];
                    echo "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 list border border-success rounded p-2 m-2'>
                            <div class='row'>
                                <div class='col-lg-4 col-md-3 col-sm-3 col-xs-12 picture'>
                                    <a href='../tourdetail.php?id=$tourID'><img src='../pic/". $row['tPic'] ."' alt='hinh anh'
                                            class='list-anh'></a>
                                </div>
                                <div class='col-lg-8 col-md-8 col-sm-8 col-xs-12 content '>
                                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 '>
                                        <p class='tour-name fw-bold'><a href='../tourdetail.php?id=$tourID'>". $row['tName'] ."</a></p>
                                    </div>
                                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 '>
                                        <div class='row'>
                                            <div class='col-lg-6 col-md-8 col-sm-8 col-xs-12'>
                                                <p class=''>Ngày khởi hành: ". $row['tStart'] ."</p>
                                                <p>Thời gian tour: ". $row['tDay'] ."</p>
                                                <p>Nơi khởi hành: ". $row['tPlace'] ."</p>
                                            </div>
                                            <div class='col-lg-6 col-md-4 col-sm-4 col-xs-12'>
                                                <h5 class='cost'>". $formattedAmount = number_format($row['bTotal'], 0, ',', '.') // Kết quả: 1.234.567,89
                                                ."<span> VND</span></h5>
                                                
                                                <p>Trạng thái: ". ($row['bStatus'] == 0 ? "Chưa xác nhận." : "Đã xác nhận.") ."</p>
                                            </div>
                                        </div>    
                                    </div>
                                </div>
                            </div>
                        </div>";
                            } 
                                                   
                        } else {
                        echo "Bạn hiện tại chưa có chuyến đi nào!";
                        }
                    }
                ?>
                                     
                                </div>
                                <div class="tab-pane fade" id="tour-history" role="tabpanel"
                                    aria-labelledby="tour-history-tab" tabindex="0">
                <!-- lịch sử tour đã đi -->
                <?php
                    if (!isset($conn)) {
                        echo "Không kết nối được đến CSDL";
                    } else {
                        $uid = $_SESSION['id'];
                        
                        $stmt1 = $conn->prepare("SELECT * FROM tour_date td
                                                LEFT JOIN booking b on b.tdID = td.tdID
                                                LEFT JOIN tours t on td.tID = t.tID
                                                WHERE uID = ? AND td.tStart <= CURDATE()");
                        $stmt1->bind_param("i", $uid);
                        $stmt1->execute();
                        $result1 = $stmt1->get_result();
                        
                        if ($result1->num_rows > 0) {
                            while ($row1 = $result1->fetch_assoc()) {
                    echo "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 list border border-success rounded p-2 m-2'>
                            <div class='row'>
                                <div class='col-lg-4 col-md-3 col-sm-3 col-xs-12 picture'>
                                    <a href='tourdetail.php'><img src='../pic/". $row1['tPic'] ."' alt='hinh anh'
                                            class='list-anh'></a>
                                </div>
                                <div class='col-lg-8 col-md-8 col-sm-8 col-xs-12 content '>
                                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 '>
                                        <p class='tour-name fw-bold'><a href='tourdetail.php'>". $row1['tName'] ."</a></p>
                                    </div>
                                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 '>
                                        <div class='row'>
                                            <div class='col-lg-6 col-md-8 col-sm-8 col-xs-12'>
                                                <p class=''>Ngày khởi hành: ". $row1['tStart'] ."</p>
                                                <p>Thời gian tour: ". $row1['tDay'] ."</p>
                                                <p>Nơi khởi hành: ". $row1['tPlace'] ."</p>
                                            </div>
                                            <div class='col-lg-6 col-md-4 col-sm-4 col-xs-12'>
                                                <h5 class='cost'>".$formattedAmount = number_format($row1['bTotal'], 0, ',', '.') // Kết quả: 1.234.567,89
                                                 ."<span> VND</span></h5>
                                                
                                            </div>
                                        </div>    
                                    </div>
                                </div>
                            </div>
                        </div>";
                            } 
                                                   
                        } else {
                        echo "Bạn hiện tại chưa có lịch sử chuyến đi nào!";
                        }
                    }
                ?>                
                                    
                                </div>
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