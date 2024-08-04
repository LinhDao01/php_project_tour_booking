<?php 
    session_start();

    include "../connect.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>ADMIN - QL thông tin tour</title>
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


    <style>
        .col1 {
            width: 5%;
        }
        .col2 {
            width: 500px;
        }
        .col3 {
            width: 120px;
        }
        .col4 {
            width: 140px;
        }
        .col5 {
            width: 140px;
        }
    </style>

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
                                    <a href="home"><img src="../pic/logo-4.png" alt=""></a>
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
                                        <a class="nav-link btn-account active text-light" href="#tour" role="button"
                                            data-bs-toggle="collapse" aria-expanded="false" aria-controls="tour">
                                            <i class="fa-solid fa-bars-progress"></i> Quản lý tour <i
                                                class="fa-solid fa-caret-down"></i>
                                        </a>
                                        <div class="collapse" id="tour">
                                            <ul class="flex-column">
                                                <li class="mt-3"><a class="text-item" href="tourtype.php">Quản lý phân loại tour</a></li>
                                                <li class="mt-3"><a class="active" href="tourinfo.php">Quản lý thông tin tour</a></li>                                        
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
                            <!-- đường dẫn -->
                            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="mt-2">
                                <ol class="breadcrumb">
                                  <li class="breadcrumb-item"><a href="#">Quản lý tour</a></li>
                                  <li class="breadcrumb-item active" aria-current="page">Quản lý thông tin tour</li>
                                </ol>
                              </nav>
                            
                            <div class="page-header text-center pt-2">
                                <h3>Quản lý thông tin tour</small></h3>
                            </div>
                            <div class="add">
                                <a type="button" class="btn btn-primary my-3" href="addnewtour.php"><i class="fa-solid fa-user-plus"></i> 
                                    Thêm tour mới</a>
                            </div>

                            <div class="panel panel-default"> 
                                <div class="panel-heading"></div>
                                <?php 
                                    if (!isset($conn)) {
                                        echo "Không kết nối được đến CSDL!";
                                    } else {
                                        $stmt = $conn->prepare("SELECT * FROM tours t
                                                                LEFT JOIN tinh ti
                                                                on t.tiID = ti.tiID
                                                                where t.tsoft_del = b'0'");
                                        $stmt->execute();
                                        $result = $stmt->get_result();

                                        if ($result->num_rows > 0) {
                                            echo "
                                <div class='panel-body table-responsive'>

                                    <table class='table table-bordered'>
                                        <thead>
                                            <tr>
                                                <th class='col1'>ID</th>
                                                <th class='col2'>Tên tour</th>
                                                <th class='col3'>Số lượng vé</th>
                                                <th class='col4'>Nơi khởi hành</th>
                                                <th class='col5'>Tỉnh thành</th>
                                                <th class='col6'></th>
                                            </tr>
                                        </thead>
                                        <tbody>";
                                        while ($row = $result->fetch_assoc()) {
                                            $id = $row['tID'];
                                            echo "<tr>";
                                                echo "<td class='col1'>". $row['tID'] ."</td>";
                                                echo "<td class='col2'>". $row['tName'] ."</td>";
                                                echo "<td class='col3'>". $row['tTicket'] ."</td>";
                                                echo "<td class='col4'>". $row['tPlace'] ."</td>";
                                                echo "<td class='col5'>". $row['tiName'] ."</td>";
                                                echo "<td class='col6 d-flex'>
                                                        <form action='". $_SERVER['PHP_SELF'] ."' method='post' >
                                                            <input type='hidden' value='". $row['tID'] ."' name='tourId'>
                                                            <button type='submit' class='btn' id='btn-del' name='btn-del' onclick = 'return confirmDel();'><i class='fas fa-trash-alt' ></i></button> <!-- nút xóa -->
                                                        </form>
                                                        <a class='btn' href='tour-detail.php?id=$id'><i class='far fa-eye'></i></a> <!-- xem chi tiết -->
                                                        
                                                        
                                                        
                                                    </td>";
                                            echo "</tr>";
                                            }
                                        echo "</tbody>
                                    </table>

                                </div>";
                                        } else {
                                            echo "Không có dữ liệu trong bảng tours";
                                        }
                                        
                                    }
                                ?>
                            </div>
                            <?php
                                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                    if (isset($_POST['tourId'])) {
                                        $id = $_POST['tourId'];

                                        $stmt = $conn->prepare("CALL DEL_TOUR(?)");
                                        $stmt->bind_param("i", $id);
                                        $stmt->execute();

                                        // Check if any rows were affected (successful deletion)
                                        if ($stmt->affected_rows > 0) {
                                            echo "<script>alert('Xóa tour thành công!'); window.location.href = './tourinfo.php';</script>";
                                        } else {
                                            echo "<script>alert('Không thể xóa tour. Vui lòng thử lại sau!');</script>";
                                        }

                                        $stmt->close();
                                    }
                                }
                                ?>

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

    <!-- xác nhận xóa tour -->
    <script>
        function confirmDel() {
            return window.confirm("Bạn có chắc chắn muốn xóa tour này?");
        }
    </script>

</body>

</html>