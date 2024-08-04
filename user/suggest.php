<?php
    session_start();
    ob_start();
    include "../connect.php";

    if (isset($conn)) {
        $email = $_SESSION['email'];
        $uid = $_SESSION['id'];
    } else {
        echo "Không kết nối được đến CSDL";
    }

    // Kiểm tra xem nút đã được nhấn chưa
    if(isset($_POST['btn_send_clicked']) && $_POST['btn_send_clicked'] == "1") {
        // Thực hiện các thao tác khi nút đã được nhấn
        $title = $_POST['title-text'];
        $content = $_POST['content-text'];

        $stmt = $conn->prepare("CALL SUGGEST(?, ?, ?)");
        // Bind (liên kết) parameters to the query
        $stmt->bind_param("iss", $uid, $title, $content);
        $stmt->execute();
        // Kiểm tra xem có lỗi xảy ra hay không
        if ($stmt->errno) {
            echo "Lỗi: " . $stmt->error;
            exit();
        } else {
            $stmt->close();
            $conn->close();
            // Chuyển hướng sau khi xử lý thành công
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }
         // Đóng statement ở cuối
        
    } 
    
    // Kiểm tra nếu được chuyển hướng từ chính trang này
    if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] == "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']) {
        echo "<script>alert('Cảm ơn vì góp ý của bạn! Chúng tôi sẽ ghi nhận và phát triển nó trong tương lai.');</script>";
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Tên User</title>

    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" /> -->
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
                                        <img src="../pic/logo-4.png" alt="logo" class="logo" />
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
                                        <a class="nav-link active text-black fs-5" aria-current="page" href="../index.php">Tours</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-black fs-5" href="../introduce.php">Giới thiệu</a>
                                    </li>
                                </ul>
                                <ul class="navbar-nav float-end">
                                    <li class="nav-item d-flex">
                                        <?php echo "<img src='../pic/" . $_SESSION["img"] . "' alt='ảnh măc định' class='avatar-lg rounded-5'> " ?>

                                        <a class="nav-link text-black fs-5" href="profile.php"><?php echo $_SESSION["username"]; ?></a>
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
                                    <h4><?php echo $_SESSION["username"]; ?></h4>
                                </div>
                            </div>
                            <hr class="my-3" />
                            <div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex align-items-center pb-3">
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
                                    <li class="list-group-item d-flex align-items-center pt-3 point">
                                        <a href="voucher.php"><i class="fa-solid fa-ticket"></i>
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
                    <div class="suggest-content">
                        <div class="mycard">
                            <form action='<?php echo $_SERVER['PHP_SELF'] ?>' method="post">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Tiêu đề</label>
                                    <input type="text" class="form-control" id="title" name="title-text">
                                    <div id="titlenote" class="form-text">Tên địa điểm bạn muốn gợi ý</div>
                                </div>
                                <div class="mb-3">
                                    <label for="content" class="form-label">Nội dung gợi ý của bạn</label>
                                    <textarea type="text" class="form-control" id="content" rows="5" name="content-text">
                                    </textarea>
                                </div>
                                <input type="hidden" id="btn_send_clicked" name="btn_send_clicked" value="0"> <!-- trạng thái khi nút chưa được click-->
                                <button id="btn_send" class="btn btn-primary float-end">Gửi <i class="fa-solid fa-paper-plane"></i></button>
                            </form>
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
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script> -->

    <script>
        document.getElementById("btn_send").addEventListener("click", function() {
            // Khi nút được nhấn, gán giá trị 1 cho input hidden
            document.getElementById("btn_send_clicked").value = "1";
        });
    </script>
</body>

</html>