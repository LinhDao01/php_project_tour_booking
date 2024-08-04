<?php
    session_start();
    include "connect.php";


?>
<!doctype html>
<html lang="en">

<head>
    <title>Tours Du lịch hành hương</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" /> -->
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <!-- css -->
    <link rel="stylesheet" href="css/tourlist.css">
    <!-- link icon -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"> -->
    <!-- fontawesome -->
    <script src="https://kit.fontawesome.com/1ee92f529b.js" crossorigin="anonymous"></script>

    <style>

    </style>
</head>

<body>
    <!-- header -->
    <header>
        <div class="container-fluid head1">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 my-1 logo-header">
                    <div class="container">
                        <nav class="navbar navbar-expand-lg">
                            <div class="col-3-lg me-5">
                                <div class="logo">
                                    <a href="index.php" class="logo-wrapper">
                                        <img src="pic/logo-4.png" alt="logo ">
                                    </a>
                                </div> 
                            </div>
                            <!-- nút xuất hiện khi thu nhỏ màn hình tới break points, nếu k sẽ ẩn -->
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarText">
                                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                                    <li class="nav-item ">
                                        <a class="nav-link active text-black fs-5" aria-current="page" href="index.php">Tours</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link text-black fs-5" href="introduce.php">Giới thiệu</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-3 col-md-2 col-sm-3 text-center ">
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
                        </nav>

                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- main -->
    <main>
        <!-- search box -->
        <div class="container">
            <div class="search_box mt-4">
                <div class="search">
                    <div class="select_area">
                        <i class="fas fa-map-marker-alt map_icon"></i>
                        <div class="text">Bạn muốn đi</div>
                    </div>

                    <div class="line"></div>

                    <div>
                        <div class="d-flex text-and-icon">
                            <input type="text" class="search_text" id="searchInput" 
                                placeholder="Tìm kiếm theo tỉnh thành hoặc tên địa danh">
                            <button id="searchButton" type="submit" class="search_icon">
                                <i class="fas fa-search "></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- đường dẫn -->
        <div class="container my-3">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Tours</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Kết quả tìm kiếm </li>
                </ol>
            </nav>
        </div>

        <!-- tourlist -->
        <div class="container tourlist p-2">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 tour-content">
                <div class="row ">
                    <!-- slidebar -->
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 slidebar sticky-top ">
                        <div class="heading border border-primary text-center">
                            <h5>Khám phá theo tỉnh thành</h5>
                        </div>
                        <div class="content border border-primary">
                            <ol class="tinh-thanh mx-3">
                                <div class="row">
                                    <li>
                                        <div class="col-12 ">
                                            <a href="#tourgido">Long An</a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col-12 ">
                                            <a href="#tourgido">Tiền Giang</a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col-12 ">
                                            <a href="#tourgido">Đồng Tháp</a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col-12 ">
                                            <a href="#tourgido">Vĩnh Long</a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col-12 ">
                                            <a href="#tourgido">Trà Vinh</a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col-12 ">
                                            <a href="#tourgido">Thành phố Cần Thơ</a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col-12 ">
                                            <a href="#tourgido">Hậu Giang</a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col-12 ">
                                            <a href="#tourgido">Sóc Trăng</a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col-12 ">
                                            <a href="#tourgido">Bến Tre</a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col-12 ">
                                            <a href="#tourgido">An Giang</a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col-12 ">
                                            <a href="#tourgido">Kiên Giang</a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col-12 ">
                                            <a href="#tourgido">Bạc Liêu</a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col-12 ">
                                            <a href="#tourgido">Cà Mau</a>
                                        </div>
                                    </li>
                                </div>
                            </ol>
                        </div>
                    </div>
                    <!-- tour-content -->
                    <div class='col-lg-9 col-md-9 col-sm-12 col-xs-12 list-tour'>

                        <?php
                            // lấy từ khóa và kết quả từ thanh search bên trang index
                            $keyword = $_GET['keyword'];
                            $result = $_GET['result'];

                            echo "<div>
                                <h1>Kết quả tìm kiếm cho từ khóa: " . $keyword . "</h1>";
                            echo $result;
                            echo "</div>";

                        ?></div>
                </div>

            </div>
        </div>
        <!-- end tour-list -->
    </main>
    <!-- footer -->
    <footer>
        <section class="footer">
            <div class="container-fluid text-dark bg-body-secondary">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <h5 class="">Liên hệ</h5>
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
                                <img src="pic/vnpay-logo.jpg" alt="VNPAY" />
                            </ul>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <h5>Sản phẩm hiện tại</h5>
                            <ul class="footpanel">
                                <li><a href="index.php" class="text-dark">Tours</a></li>
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
        var searchInput = document.getElementById('searchInput');
        const searchButton = document.getElementById('searchButton');
        //const searchResults = document.getElementById('searchResults');

        searchButton.addEventListener('click', function() {
            var keyword = searchInput.value;


        function performSearch(keyword) {
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'api/search.php?keyword=' + encodeURIComponent(keyword), true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                window.location.href = 'result-search.php?keyword=' + encodeURIComponent(keyword) + '&result=' + encodeURIComponent(xhr.responseText);
                }
            };
        xhr.send();
        }

            if (keyword !== '') {

                const xhr = new XMLHttpRequest();

                xhr.open('GET', 'api/search.php?keyword=' + keyword);
                xhr.onload = function() {
                    console.log(2);
                    if (xhr.status === 200) {
                        console.log(4);
                        window.location.href = 'result-search.php?keyword=' + encodeURIComponent(keyword) + '&result=' + encodeURIComponent(xhr.responseText);
                    } else {
                        console.log(3);
                    }
                };
                xhr.send();

            } else {
                console.log(1);
            }
        });

    </script>
</body>

</html>