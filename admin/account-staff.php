<?php 
    session_start();

    include "../connect.php";

    if (!isset($conn)) {
        echo "Kết nối thất bại!";
    } else {
        $email = $_SESSION['email'];

        if(isset($_POST['btn_send_clicked']) && $_POST['btn_send_clicked'] == "1") {
            // Kiểm tra và lấy dữ liệu từ form
            if(isset($_POST['email'], $_POST['name'], $_POST['phone'])) {
                $email = $_POST['email'];
                $name = $_POST['name'];
                $phone = $_POST['phone'];
        
                // Kiểm tra các giá trị không được trống
                if(empty($email) || empty($name) || empty($phone)) {
                    echo "<script>alert('Vui lòng điền đầy đủ thông tin');</script>";
                    exit();
                }
        
                // Băm mật khẩu
                $pass = password_hash("123", PASSWORD_DEFAULT); // Băm mật khẩu mặc định là "123"
                $role = 2;
        
                // Gọi thủ tục ASSIGN_STAFF với các tham số
                $stmt = $conn->prepare("CALL ASSIGN_STAFF(?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssi", $name, $phone, $email, $pass, $role);
                $stmt->execute();
        
                // Kiểm tra lỗi khi thực thi thủ tục
                if ($stmt->errno) {
                    echo "Lỗi: " . $stmt->error;
                } else {
                    echo "<script>alert('Thêm nhân viên thành công');</script>";
                }
        
                $stmt->close();
            } //else {
            //     echo "<script>alert('Dữ liệu không hợp lệ');</script>";
            }
        }
        
        
    // }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>ADMIN - QL staff</title>
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
                                        <a class="nav-link btn-account active text-light" href="#account" role="button"
                                            data-bs-toggle="collapse" aria-expanded="false" aria-controls="account">
                                            <i class="fa-solid fa-users"></i> Quản lý tài khoản <i
                                                class="fa-solid fa-caret-down"></i>
                                        </a>
                                        <div class="collapse" id="account">
                                            <ul class="flex-column">
                                                <li class="mt-3"><a class="text-item" href="account-cus.php">Người dùng</a></li>
                                                <li class="mt-3"><a class="active" href="account-staff.php">Nhân viên</a></li>
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
                        <!-- đường dẫn -->
                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="#quản_lý_tour">Quản lý tài khoản</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Nhân viên</li>
                            </ol>
                          </nav>
                        <div class="">
                            <div class="page-header text-center pt-3">
                                <h3>Quản lý nhân viên</small></h3>
                            </div>
                            <div class="add">
                                <button type="button" class="btn btn-primary my-3" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal"><i class="fa-solid fa-user-plus"></i> Thêm nhân
                                    viên</button>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="" method="post">
                                                    <div class="mb-3">
                                                      <label for="name" class="form-label">Họ tên đầy đủ</label>
                                                      <input type="text" class="form-control" id="name" name="name">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="phone" class="form-label">Số điện thoại</label>
                                                        <input type="number" maxlength="10" class="form-control" id="phone" name="phone">
                                                      </div>
                                                      <div class="mb-3">
                                                        <label for="email" class="form-label">Email</label>
                                                        <input type="email" class="form-control" id="email" name="email">
                                                      </div>

                                                    <input type="hidden" id="btn_send_clicked" name="btn_send_clicked" value="0"> <!-- trạng thái khi nút chưa được click-->      
                                                    <button type="submit" id="btn_send" class="btn btn-primary">Thêm</button>
                                                    
                                                  </form>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading"></div>

                                <?php 
                                    if(isset($conn)) {
                                        $stmt = $conn->prepare("SELECT * FROM users where uRole = '2'");
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                
                                        if ($result->num_rows > 0) {
                                            echo "
                                                <div class='panel-body table-responsive'>
                                                    <table class='table table-bordered'>
                                                        <thead>
                                                            <tr>
                                                                <th>ID</th>
                                                                <th>Họ và tên</th>
                                                                <th>Email</th>
                                                                <th>Số điện thoại</th>
                                                                <th>Trạng thái</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>";

                                            while ($row = $result->fetch_assoc()) {
                                                echo "<tr>";
                                                echo "<td>". $row['uID'] ."</td>";
                                                echo "<td>". $row['uName'] ."</td>";
                                                echo "<td>". $row['uEmail'] ."</td>";
                                                echo "<td>". $row['uPhone'] ."</td>";
                                                echo "<td>". $row['uActive'] ."</td>";
                                                echo "</tr>";
                                            }

                                            echo "</tbody>";
                                            echo "</table> ";
                                        } else {
                                            echo "Không có dữ liệu từ bảng type_tour";
                                        }
                                
                                    } else {
                                        echo "<script>alert('Chưa kết nối đến csdl!')</script>";
                                    }
                                
                                        echo "</div>";
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

    <script>
        document.getElementById("btn_send").addEventListener("click", function() {
            // Khi nút được nhấn, gán giá trị 1 cho input hidden
            document.getElementById("btn_send_clicked").value = "1";
        });
    </script>    

</body>

</html>