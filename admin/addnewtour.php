<?php
session_start();
include "../connect.php";


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Thêm tour mới</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" /> -->
    <link rel="stylesheet" href="../bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <!-- css -->
    <link rel="stylesheet" href="../css/admin.css" />
    <!-- icon
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" /> -->
    <!-- fontawesome -->
    <script src="https://kit.fontawesome.com/1ee92f529b.js" crossorigin="anonymous"></script>

</head>

<body>
    <main>
        <div class="row g-0">
            <!-- sidebar -->
            <div class="col-2 ">
                <div class="menu px-3 pt-4 sticky">
                    <nav class="navbar navbar-expand-lg">
                        <div class="menu-content">
                            <div class="menu-head">
                                <div class="logo">
                                    <a href="home.php"><img src="../pic/logo-4.png" alt=""></a>
                                </div>
                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarmenu" aria-controls="navbarmenu" aria-expanded="false" aria-label="Toggle navigation">
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
                                        <a class="nav-link btn-account active text-light" href="#tour" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="tour">
                                            <i class="fa-solid fa-bars-progress"></i> Quản lý tour <i class="fa-solid fa-caret-down"></i>
                                        </a>
                                        <div class="collapse" id="tour">
                                            <ul class="flex-column">
                                                <li class="mt-3"><a class="text-item" href="tourtype.php">Quản lý phân loại tour</a></li>
                                                <li class="mt-3"><a class="text-item" href="tourinfo.php">Quản lý thông tin tour</a>
                                                    <ul class="flex-column">
                                                        <li class="mt-3"><a class="active" href="addnewtour.php">Thêm tour mới</a>
                                                    </ul>
                                                </li>
                                                <li class="mt-3"><a class="text-item" href="tourstatus.php">Quản lý trạng thái</a>
                                                </li>

                                            </ul>
                                        </div>
                                    </li>
                                    <li class="menu-item my-3 p-1">
                                        <a class="nav-link btn-account text-item" href="#account" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="account">
                                            <i class="fa-solid fa-users"></i> Quản lý tài khoản <i class="fa-solid fa-caret-down"></i>
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
            <!-- content-body -->
            <!-- header -->
            <div class="col-10">
                <div class="header">
                    <div class="container-fluid">
                        <div class="text-end pe-5">
                            <a class="text-black fs-5" aria-current="page" href="/user/profile.php"><?php echo $_SESSION["username"]; ?></a>
                        </div>
                    </div>
                </div>
                <!-- content -->
                <div class="content">
                    <div class="container">
                        <!-- đường dẫn -->
                        <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb" class="my-2">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Quản lý tour</a></li>
                                <li class="breadcrumb-item"><a href="tourinfo.php">Quản lý thông tin tour</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Thêm tour mới
                                </li>
                            </ol>
                        </nav>
                        <!-- Thêm tour -->
                        <div class="addtour">
                            <div class="head text-center">
                                <h4>Thêm tour mới</h4>
                            </div>
                            <div class="body m-3">
                    <form action="" method="post" enctype="multipart/form-data">
                                    <div class="row my-3">
                                        <div class="col-3">
                                            <label for="nametour" class="form-label">Tên của tour: </label>
                                        </div>
                                        <div class="col-8">
                                            <input type="text" class="form-control" id="nametour" name="nametour" Required />
                                            <div id="name" class="form-text">
                                                Tên bao gồm các điểm đến, thời gian tour, ...
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row my-3">
                                        <div class="col-3">
                                            <label class="form-label">Loại tour: </label>
                                        </div>
                                        <?php
                                        if (!isset($conn)) {
                                            echo "Không kết nối được đến CSDL";
                                        } else {
                                            $stmt = $conn->prepare("SELECT * FROM type_tour");
                                            $stmt->execute();
                                            $result = $stmt->get_result();

                                            if ($result->num_rows > 0) {
                                                echo "<div class='col-8'>
                                                        <select class='form-select' aria-label='' aria-describedby='desType' id='typetour' name='typetour' onchange='getTypeTour()' Required>
                                                                <option selected>Loại tour</option>";
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<option value='" . $row['ttID'] . "'>" . $row['ttName'] . "</option>";
                                                }
                                                echo "</select>
                                                            <div id='desType' class='form-text'>
                                                                Chọn 1 loại.
                                                            </div>
                                                        </div>";
                                                echo "<input type='hidden' id='typetourid' name='typetourid' value=''>";
                                            } else {
                                                echo "Không có dữ liệu trong bảng type_tour";
                                            }
                                            $stmt->close();
                                        }
                                        ?>
                                        
                                    </div>
                                    <div class="row my-3">
                                        <div class="col-3">
                                            <label for="" class="form-label">Tour thuộc tỉnh:
                                            </label>
                                        </div>
                                        <div class="col-8">
                                            <!--combo box-->
                                            <?php
                                            if (!isset($conn)) {
                                                echo "Không kết nối được dến database!";
                                            } else {
                                                $stmt1 = $conn->prepare("SELECT * FROM tinh");
                                                $stmt1->execute();
                                                $result1 = $stmt1->get_result();
                                                if ($result1->num_rows > 0) {                                               
                                                    echo "<select class='form-select' aria-label='' aria-describedby='desTinh' id='tinh' name='tinh' onchange='getTinh()' Required>
                                                            <option selected>Tỉnh / Thành phố</option>";
                                                    while ($row1 = $result1->fetch_assoc()) {
                                                        echo "<option value='" . $row1['tiID'] . "' Required>" . $row1['tiName'] . "</option>";
                                                        
                                                    }
                                                    echo "</select>";
                                                    echo "<input type='hidden' id='tinhid' name='tinhid' value=''>";
                                                } else {
                                                    echo "Không có CSDL trong bảng tỉnh!";
                                                }
                                                $stmt1->close();
                                            }

                                            ?>
                                            <div id="desTinh" class="form-text">
                                                Chỉ thuộc 1 tỉnh!
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row my-3">
                                        <div class="col-3">
                                            <label for="nametour" class="form-label">Thời gian tour: </label>
                                        </div>
                                        <div class="col-8">
                                            <input type="text" class="form-control" id="timetour" name="timetour" Required />
                                            <div id="name" class="form-text">
                                                1 ngày 1 đêm, ...
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row my-3">
                                        <div class="col-3">
                                            <label for="" class="form-label">Nơi khởi hành:
                                            </label>
                                        </div>
                                        <div class="col-8">
                                            <input type="text" class="form-control" id="start_place" name="start_place" Required/>
                                        </div>
                                    </div>
                                    <div class="row my-3">
                                        <div class="col-3">
                                            <label class="form-label">Số lượng vé của tour:
                                            </label>
                                        </div>
                                        <div class="col-8">
                                            <input type="number" class="form-control" id="num_ticket" name="num_ticket" Required/>
                                        </div>
                                    </div>
                                    <div class="row my-3">
                                        <div class="col-3">
                                            <label for="" class="form-label">Giá vé người lớn:
                                            </label>
                                        </div>
                                        <div class="col-8">
                                            <input type="text" class="form-control" id="adult_price" name="adult_price" Required/>
                                        </div>
                                    </div>
                                    <div class="row my-3">
                                        <div class="col-3">
                                            <label for="" class="form-label">Giá vé trẻ em:
                                            </label>
                                        </div>
                                        <div class="col-8">
                                            <input type="text" class="form-control" id="kid_price" name="kid_price" Required/>
                                        </div>
                                    </div>
                                    <div class="row my-3">
                                        <div class="col-3">
                                            <label for="" class="form-label">Giá vé trẻ nhỏ:
                                            </label>
                                        </div>
                                        <div class="col-8">
                                            <input type="text" class="form-control" id="child_price" name="child_price" Required/>
                                        </div>
                                    </div>
                                    <div class="row my-3">
                                        <div class="col-3">
                                            <label for="" class="form-label">Phương tiện di chuyển: </label>

                                        </div>
                                        <div class="col-8">
                                            <input type="text" class="form-control" id="transport" name="transport" Required/>
                                            <div id="desTransport" class="form-text">
                                                Xe khách, tàu thủy, xe lửa, ...
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row my-3">
                                        <div class="col-3">
                                            <label for="" class="form-label">Nơi ở khi tham gia tour:
                                            </label>
                                        </div>
                                        <div class="col-8">
                                            <input type="text" class="form-control" id="place" name="place" aria-describedby="desPlace" Required/>
                                            <div id="desPlace" class="form-text">
                                                Tên khách sạn, nhà nghỉ, khu du lịch,...
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row my-3">
                                        <div class="col-3">
                                            <label for="" class="form-label">Tên ảnh đầu trang:
                                            </label>
                                        </div>
                                        <div class="col-8">
                                            <div class="">
                                                <input type="file" name="upload" id="upload" accept=".jpg, .jpeg, .png" Required>
                                            </div>
                                        </div>
                                    </div>

                        <div class="row my-3">
                            <div class="col-3">
                                <label class="form-label">Mô tả của tour:
                                </label>
                            </div>
                            <div class="col-8">
                                <textarea class="form-control" id="desTour" name="desTour" Required></textarea>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <input type="hidden" name="btn_send_clicked" id="btn_send_clicked" value="0">
                            <button type="submit" class="btn btn-primary" name="btn-send" id="btn-send">
                                Thêm tour
                            </button>
                        </div>
                    </form>

                    <script>
                        function getTinh() {
                            var selectElement = document.getElementById('tinh');
                            var selectedOption = selectElement.options[selectElement.selectedIndex];
                            var tinhID = selectedOption.value;

                            // Gán giá trị tourTypeID vào trường input ẩn
                            document.getElementById('tinhid').value = tinhID;
                        }
                    </script>

                    <!-- dùng để lấy và truyền ID tourtype từ select vào biến và truyền qua file ajax tour-upload.php -->
                    <script>
                        function getTypeTour() {
                            var selectElement = document.getElementById('typetour');
                            var selectedOption = selectElement.options[selectElement.selectedIndex];
                            var tourTypeID = selectedOption.value;

                            // Gán giá trị tourTypeID vào trường input ẩn
                            document.getElementById('typetourid').value = tourTypeID;
                        }
                    </script>

                    <script>
                        var fileInput = document.getElementById('upload');
                        document.getElementById("btn-send").addEventListener("click", function() {
                            var check = document.getElementById("btn_send_clicked").value = "1";
                            
                             // Lấy giá trị của các trường nhập liệu
                            const nametour = document.getElementById('nametour').value.trim();
                            const typetour = document.getElementById('typetour').value.trim();
                            const num_ticket = document.getElementById('num_ticket').value.trim();
                            const desTour = document.getElementById('desTour').value.trim();
                            const adult_price = document.getElementById('adult_price').value.trim();
                            const kid_price = document.getElementById('kid_price').value.trim();
                            const child_price = document.getElementById('child_price').value.trim();
                            const transport = document.getElementById('transport').value.trim();
                            const timetour = document.getElementById('timetour').value.trim();
                            const place = document.getElementById('place').value.trim();
                            const start_place = document.getElementById('start_place').value.trim();
                            const tinh = document.getElementById('tinh').value.trim();

                            // Kiểm tra xem có trường nào bị bỏ trống không
                            if (!nametour || !typetour || !num_ticket || !desTour || !adult_price || !kid_price || !child_price || !transport || !timetour || !place || !start_place || !tinh) {
                                alert('Vui lòng nhập đầy đủ thông tin!');
                                event.preventDefault(); // Ngăn chặn form được gửi đi
                                return;
                            }
                            
                            // Lấy dữ liệu từ form
                            var formData = new FormData(document.querySelector('form'));
                            
                            // Thêm tệp tin ảnh vào FormData
                            if (fileInput.files.length > 0) {
                                formData.append('upload', fileInput.files[0]);
                            }

                            // Sử dụng XMLHttpRequest
                            var xhr = new XMLHttpRequest();
                            xhr.open('POST', 'http://localhost/php_project/api/tour-upload.php');
                            xhr.onreadystatechange = function() {
                                if (xhr.readyState === 4 && xhr.status === 200) {
                                    // Xử lý phản hồi từ máy chủ
                                    console.log(xhr.responseText);
                                    // Hiển thị thông báo thành công
                                    alert('Đã tải lên thành công!'); 
                                } else if (xhr.readyState === 4) {
                                    // Xử lý lỗi
                                    console.error('Lỗi khi tải lên: ' + xhr.status);
                                    // Hiển thị thông báo lỗi
                                    alert('Đã xảy ra lỗi khi tải lên!');
                                }
                            };

                            // Gửi yêu cầu
                            xhr.send(formData);
                        });
                        
                    </script>
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
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script> -->

    <script>
        document.getElementById("btn-send").addEventListener("click", function() {
            // Khi nút được nhấn, gán giá trị 1 cho input hidden
            document.getElementById("btn_send_clicked").value = "1";
        })
    </script>


</body>

</html>