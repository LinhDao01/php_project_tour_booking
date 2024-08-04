<?php 
    session_start();
    $uid = $_SESSION['id'];
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
                                        <a class="nav-link text-black fs-5"
                                            href="../index.php">Tours</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-black fs-5" 
                                        href="../introduce.php">Giới thiệu</a>
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
                                    <li class="list-group-item d-flex align-items-center pb-3">
                                        <a href="tour.php"><i class="fa-solid fa-cart-plus"></i>
                                            <span>Đơn hàng của tôi</span></a>
                                    </li>
                                    <li class="list-group-item d-flex align-items-center point py-3">
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
                    <?php 
                    echo "<div class='mycard point-content'>
                            <div class='point-user'>
                                <div class='point-card'>";
                                    $stmt = $conn->prepare("SELECT uPoint FROM users where uID = ?");
                                    $stmt->bind_param("i", $uid);
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    if ($result->num_rows == 0) {
                                        echo "<p class='px-3 text-info fw-semibold'>
                                                <span class='point fs-3'>0</span> điểm khả dụng
                                            </p>
                                        </div> <!-- đóng div của point-card-->
                                    <p>Quý khách chưa có hoạt động nào!</p>";
                                    } else {
                                        $row = $result->fetch_assoc();
                                        echo "<p class='px-3 text-info fw-semibold'>
                                                <span class='point fs-3'>". $row['uPoint'] ."</span> điểm khả dụng
                                            </p>
                                        </div>"; // đóng div của point-card
                                    }
                            echo "</div> <!-- đóng div của point-user-->
                        </div>"; // đóng div của mycard
                    ?>
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