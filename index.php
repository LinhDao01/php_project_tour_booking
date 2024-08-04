<?php
session_start();
include "connect.php";
?>

<!doctype html>
<html lang="en">

<head>
    <title>
        WesternTravel
    </title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" /> -->
    <!-- link icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/index.css">
    <!-- fontawesome -->
    <script src="https://kit.fontawesome.com/1ee92f529b.js" crossorigin="anonymous"></script>

</head>

<body>
    <header>
        <!-- heading 1 -->
        <div class="container-fluid head1">
            <div class="row justify-content-md-center">
                <div class="col-lg-3 col-md-2 col-sm-3 my-1 logo-header text-center">
                    <div class="logo">
                        <a href="index.php" class="logo-wrapper">
                            <img src="pic/logo-4.png" alt="logo " class="logo">
                        </a>
                    </div>
                </div>
                <!-- thanh tìm kiếm -->
                <div class="col-lg-4 col-md-2 col-sm-3 text-center mt-4">
                    <div class="search-form">
                        <form action="#search" class="d-flex" role="search">
                            <input class="form-control me-2" type="search" id="searchInput" placeholder="Bạn muốn đi...">
                            <button class="btn btn-success" type="submit" id="searchButton">
                                <i class="bi bi-search-heart-fill"></i>
                            </button>
                        </form>

                        <div class="cate-overlay2"></div>
                    </div>

                </div>
                <div class="col-lg-1 col-md-1 col-sm-1 "></div>
                <div class="col-lg-3 col-md-2 col-sm-3 text-center mt-4">
                    <?php
                    if (isset($_SESSION["username"])) {
                        echo "<ul class='navbar-nav float-end'>
                                <li class='nav-item d-flex'>
                                    <img src='pic/" . $_SESSION['img'] . "' alt='ảnh măc định' class='avatar-lg rounded-5'> 
                            
                                    <a class='nav-link text-decoration-none fw-semibold text-black fs-5'
                                     href='user/profile.php'>" . $_SESSION['username'] . "</a>
                                </li>
                            </ul>";
                    } else {
                        echo "<p class='my-2'><a href='assign.php' title='assign'
                                    class='text-decoration-none fw-semibold text-black'> Đăng Ký</a>
                                /
                                <a href='login.php' title='login' class='text-decoration-none fw-semibold text-black'>
                                    Đăng Nhập</a>
                                </p>";
                    }
                    ?>
                </div>
            </div>
        </div>

        <!-- heading 2 -->
        <div class="main-nav">
            <div class="container-fluid head2">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <nav class="navbar navbar-expand-lg">
                            <div class="container">
                                <!-- nút xuất hiện khi thu nhỏ màn hình tới break points, nếu k sẽ ẩn -->
                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>

                                <div class="collapse navbar-collapse" id="navbarText">
                                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                        <li class="nav-item">
                                            <a class="nav-link active" aria-current="page" href="#tours">Tours</a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link text-black" href="introduce.php">Giới thiệu</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </nav>
                    </div>

                </div>
            </div>
        </div>
    </header>
<div id="searchResults" ></div>
    <main>
        <!-- hình ảnh đầu trang -->
        <img src="pic/pictrangdau1.jpg" alt="Du lịch miền tây nam bộ" class="w-100 h-50">
        <!-- các sản phẩm -->
        <section id="tours">
            <div class="container-lg mt-5">

                <?php
                // Lấy tất cả các loại tour có số lượng tour ít nhất là 1
                $stmt = $conn->prepare("SELECT tt.* FROM type_tour tt 
                                        WHERE EXISTS (SELECT 1 FROM tours t 
                                                    WHERE t.ttID = tt.ttID)");
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='text-start' style='width: 30rem;'>";
                        echo "<h2 class='display-7 fw-bold'>" . $row['ttName'] . "</h2>";
                        echo "</div>";
                        $ttid = $row['ttID'];

                        // Lấy tất cả các tour thuộc loại hiện tại
                        $stmt1 = $conn->prepare("SELECT * FROM tours WHERE ttID = ? AND tsoft_del = b'0'");
                        $stmt1->bind_param("i", $ttid);
                        $stmt1->execute();
                        $result1 = $stmt1->get_result();

                        echo "<div class='row item-m align-item-center justify-content-center'>";
                        if ($result1->num_rows > 0) {
                            while ($row1 = $result1->fetch_assoc()) {
                                $tourID = $row1['tID'];
                                $tourtypeID = $row1['ttID'];
                                if ($tourID) {
                                    echo "<div class='col-xs-12 col-sm-6 col-md-4'>";
                                    echo "<div class='card border-0 shadow p-3 mb-5 bg-body-tertiary rounded'>";
                                    echo "<a href='tourdetail.php?id=$tourID' class='text-decoration-none'>"; /* thêm Id vào đường dẫn*/
                                    echo "<img src='pic/pic.jpg' alt='hinh anh' class='card-img-top' style='width: 325px; height: 200px;'>";
                                    echo "<div class='card-body py-4'>";
                                    echo "<h5 class='card-title text-black tour-name'>" . $row1['tName'] . "</h5>";
                                    echo "<p class='text-muted card-subtitle ht-2'>" . $row1['tDesc'] . "</p>";
                                    echo "<p class='my-4 text-primary fw-bold text-end'>" . $formattedAmount = number_format($row1['tPrice_al'], 0, ',', '.')  . " VND / người</p>";
                                    echo "</div>";
                                    echo "</a>";
                                    echo "</div>";
                                    echo "</div>";
                                }
                                
                            }
                        }
                        echo "</div>";
                    }
                } else {
                    echo "Không tồn tại dữ liệu trong bảng tours!";
                }

                ?>

            </div>
        </section>

    </main>

    <!-- footer -->
    <footer>
        <section class="footer">
            <div class="container-fluid text-dark bg-body-secondary">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <h5 class="fw-semibold">Liên hệ</h5>
                            <ul class="footpanel">
                                <li><b>Địa chỉ: </b> ...</li>
                                <li><b>Số điện thoại: </b> ...</li>
                                <li><b>Email:</b> ...</li>
                                <li><b>Giờ làm việc:</b> 8h - 20h</li>
                            </ul>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 mx-5">
                            <ul class="footpanel">
                                <h5>Kết nối với chúng tôi qua</h5>
                                <li class="decor">
                                    <a href="#facebook" class="me-2"><i class="fab fa-facebook" style="color: #50bd60; font-size: 28px"></i></a>
                                    <a href="#instagram" class="me-2"><i class="bi bi-instagram" style="color: #50bd60; font-size: 28px"></i></a>
                                    <a href="#tiktok"><i class="bi bi-tiktok" style="color: #50bd60; font-size: 28px"></i></a>
                                </li>
                            </ul>
                            <ul class="footpanel">
                                <h5>Chấp nhận thanh toán</h5>
                                <img src="pic/vnpay-logo.jpg" alt="VNPAY" class="logo" />
                            </ul>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <h5>Sản phẩm hiện tại</h5>
                            <ul class="footpanel">
                                <li><a href="/index.html" class="text-dark">Tours</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </footer>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="../bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script> -->

    <!-- khi tìm kiếm trên thanh search -->
    <script>
        const searchInput = document.getElementById('searchInput');
        const searchButton = document.getElementById('searchButton');
        const searchResults = document.getElementById('searchResults');

        searchButton.addEventListener('click', function() {
        const keyword = searchInput.value.trim();
        if (keyword !== '') {
            
            performSearch(keyword);
        }
        });

        function performSearch(keyword) {
            // Khởi tạo đối tượng XMLHttpRequest
            const xhr = new XMLHttpRequest();
            // Open a new request
            xhr.open('GET', 'api/search.php?keyword=' + encodeURIComponent(keyword), true);
            
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                // Chuyển hướng trang đến result.php với kết quả tìm kiếm
                window.location.href = 'result-search.php?keyword=' + encodeURIComponent(keyword) + '&result=' + encodeURIComponent(xhr.responseText);

                }

            };
        xhr.send();
        }
    </script>
</body>

</html>