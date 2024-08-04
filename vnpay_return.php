<?php
    session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <title>VNPAY RESPONSE</title>
    <!-- Bootstrap core CSS -->
    <!-- <link href="assets/bootstrap.min.css" rel="stylesheet"> -->

    <!-- Bootstrap CSS v5.2.1 -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" /> -->
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <!-- Custom styles for this template -->
    <link href="assets/jumbotron-narrow.css" rel="stylesheet">
    <script src="assets/jquery-1.11.3.min.js"></script>

    <!-- css -->
    <link rel="stylesheet" href="css/tourdetail.css">
</head>

<body>
    <?php //hứng giá trị của vnpay
    $vnp_TmnCode = "XAD6ZS26"; //Mã website tại VNPAY 
    $vnp_HashSecret = "QUTZYNXOBVZHUWYZRVHPMPGLNMVDYLBH"; //Chuỗi bí mật

    $vnp_SecureHash = $_GET['vnp_SecureHash'];
    $inputData = array();
    foreach ($_GET as $key => $value) {
        if (substr($key, 0, 4) == "vnp_") {
            $inputData[$key] = $value;
        }
    }

    unset($inputData['vnp_SecureHash']);
    ksort($inputData);
    $i = 0;
    $hashData = "";
    foreach ($inputData as $key => $value) {
        if ($i == 1) {
            $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
        } else {
            $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
            $i = 1;
        }
    }

    $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

    function format_datetime($dateString)
    {
        // Chuyển đổi chuỗi ngày tháng năm thành timestamp
        $timestamp = strtotime($dateString);

        // Định dạng lại ngày tháng năm theo định dạng mong muốn
        $formattedDate = date('d-m-Y H:i:s', $timestamp); // Ví dụ: 28-04-2024 13:32:41

        echo $formattedDate;
    }

    ?>
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
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false"
                                aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarText">
                                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                    <li class="nav-item">
                                        <a class="nav-link active text-black fs-5" aria-current="page"
                                            href="index.php">Tours</a>
                                    </li>
                                     <li class="nav-item">
                                        <a class="nav-link text-black fs-5" href="introduce.php">Giới thiệu</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-3 col-md-2 col-sm-3 text-center">
                            <?php 
                                if ( isset($_SESSION["username"])) {
                                    echo "<ul class='navbar-nav float-end'>
                                            <li class='nav-item d-flex'>
                                                <img src='pic/" . $_SESSION['img'] . "' alt='ảnh măc định' class='avatar-lg rounded-5'> 
                                        
                                                <a class='nav-link text-decoration-none fw-semibold text-black fs-5'
                                                href='user/profile.php'>". $_SESSION['username'] . "</a>
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
    <!--Begin display -->
    <div class="container">
        <div class="header clearfix tex-center">
            <h3 class="text-center mt-3">THÔNG TIN GIAO DỊCH</h3>
        </div>
        <div class="tex-center">
        </div>
        <a class="btn btn-primary mb-3" href="/php_project/user/tour.php">Kiểm tra tour</a>
        <div class="table-responsive">
            <table class='table table-bordered'>
                <tr>
                    <th>Trạng thái giao dịch</th>
                    <td>
                        <?php
                        if ($secureHash == $vnp_SecureHash) {
                            if ($_GET['vnp_ResponseCode'] == '00') {
                                echo "<span class='text-primay fw-bold alin-'>Giao Dịch Thành Công</span>";
                            } else {
                                echo "<span class='text-danger fw-bold'>Giao Dịch Không Thành Công</span>";
                            }
                        } else {
                            echo "<span class='text-danger fw-bold'>Chu ky khong hop le</span>";
                        }
                        ?>
                    </td>
                </tr>

            </table>    
        </div>
        <p>
            &nbsp;
        </p>
    </div>
    <footer class="footer">
        
        <p>&copy; VNPAY <?php echo date('Y') ?></p>
    </footer>
</body>

</html>
