<?php
session_start();
include "connect.php";

?>

<!doctype html>
<html lang="en">

<head>
    <?php
    if (isset($_GET['id'])) {
        $tourID = $_GET['id'];

        if (isset($conn)) {
            $stmt = $conn->prepare("SELECT * FROM tour_date where tdID = ?");
            $stmt->bind_param("s", $tourID);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo "<title>Kiểm tra thông tin booking</title>";
            } else {
                echo "tour không tồn tại!";
            }
        }
    } else {
        echo "Không nhận được id!";
    }
    ?>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" /> -->
    <!-- css -->
    <link rel="stylesheet" href="css/booking.css">
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
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
                                    <a href="index.php" class="logo-wrapper">
                                        <img src="pic/logo-4.png" alt="logo " />
                                    </a>
                                </div>
                            </div>
                            <!-- nút xuất hiện khi thu nhỏ màn hình tới break points, nếu k sẽ ẩn -->
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarText">
                                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                    <li class="nav-item">
                                        <a class="nav-link active text-black fs-5" href="index.php">Tours</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link text-black fs-5" href="introduce.php">Giới thiệu</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-3 col-md-2 col-sm-3 text-center">
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

    <main>
        <!-- đường dẫn -->
        <div class="container my-3">
            <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Tours</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Đặt tour
                    </li>
                </ol>
            </nav>
        </div>
        <?php
        //lấy ID tour được truyền từ trang booking.php
        if (isset($_GET['id'])) {
            $tourId = $_GET['id'];
            $uID = $_SESSION['id'];

            if (isset($conn)) {
                $stmt = $conn->prepare("SELECT * FROM booking WHERE uID = ? AND tdID = ? ORDER BY bID desc LIMIT 1;");
                $stmt->bind_param("ii", $uID, $tourId);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();

                    // Thực hiện truy vấn để lấy thông tin từ bảng tours
                    $stmt = $conn->prepare("SELECT * FROM tours WHERE tID = (SELECT tID FROM tour_date WHERE tdID = ?)");
                    $stmt->bind_param("i", $tourId);
                    $stmt->execute();
                    $toursResult = $stmt->get_result();

                    if ($toursResult->num_rows > 0) {
                        $tourRow = $toursResult->fetch_assoc();

                        // Hiển thị thông tin từ bảng booking
                        echo "<div class='container'>";
                        echo "<h3 class='text-center'>XÁC NHẬN TOÀN BỘ THÔNG TIN</h3>";
                        echo "<div class='row'>";
                        echo "<div class='col-3'></div>";
                        echo "<div class='col-6'>
                        
                            <div class='panel-body table-responsive'>
                                <table class='table table-bordered'>
                                    <tr>
                                        <th>ID tour</th>
                                        <td>" . $tourRow['tID'] . "</td>
                                    </tr>
                                    <tr>
                                        <th>Tên khách hàng</th>
                                        <td>" . $row['bName'] . "</td>
                                    </tr>
                                    <tr>
                                        <th>Số điện thoại</th>
                                        <td>" . $row['bPhone'] . "</td>
                                    </tr>
                                    <tr>
                                        <th>Email (nếu có)</th>
                                        <td>" . $row['bEmail'] . "</td>
                                    </tr>
                                    <tr>
                                        <th>Ghi chú (nếu có)</th>
                                        <td>" . $row['bNote'] . "</td>
                                    </tr>
                                    <tr>
                                        <th colspan='2'><p class='text-center'>SỐ LƯỢNG VÉ ĐÃ ĐẶT</p></th>
                                    </tr>
                                    <tr>
                                        <th>Vé người lớn</th>
                                        <td>" . $row['bTick_al'] . "</td>
                                    </tr>
                                    <tr>
                                        <th>Vé trẻ em</th>
                                        <td>" . $row['bTick_kids'] . "</td>
                                    </tr>
                                    <tr>
                                        <th>Vé trẻ nhỏ</th>
                                        <td>" . $row['bTick_child'] . "</td>
                                    </tr>
                                    <tr>
                                        <th>Tổng số lượng vé của bạn</th>
                                        <td>" . $row['bTicketNum'] . "</td>
                                    </tr>
                                    <tr>
                                        <th>Tổng giá vé của bạn</th>
                                        <td>" . $row['bTotal'] . " VNĐ</td>
                                    </tr>
                                    ";
                        echo "";
                        echo "</table> ";
                        echo "</div>"; //đóng div col-6
                        echo "<div class='col-3'></div>";
                        echo "</div>"; //đóng div row
                        echo "</div>"; //đóng div container
                        echo "<form action='vnpay.php' method='post'>
                        <input type='hidden' name='order_id' value='" . $row['bID'] ."'>
                        <input type='text' name='amount' value='". $row['bTotal'] ."' hidden>
                        <input type='text' name='customer_name' value='". $row['bName'] ."' hidden>
                        <div class='d-flex justify-content-center'>
                            <input type='submit' value='Thanh toán' class='btn btn-primary'>
                        </div>
                    </form>
                    ";
                    }
                }
            }
        }
        ?>
    </main>

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
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script> -->

    <script src="../bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>
</body>

</html>