<?php

session_start();
ob_start();

include "../connect.php";

if (isset($conn)) {
    // Lấy giá trị email từ session 
    $email = $_SESSION['email'];
    $uid = $_SESSION['id'];

    // Thực hiện truy vấn SQL lấy dữ liệu từ bảng users để gán các giá trị cần dùng
    $stmt = $conn->prepare("SELECT * FROM users WHERE uEmail = ?");
    // Kiểm tra xem truy vấn đã được chuẩn bị thành công hay không
    if ($stmt) {
        // Bind giá trị vào truy vấn
        $stmt->bind_param("s", $email);
        // Thực hiện truy vấn
        $stmt->execute();
        // Lấy kết quả truy vấn
        $result = $stmt->get_result();

        // Kiểm tra xem có dữ liệu trả về không
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_array()) {
                // Gán các giá trị của các cột vào biến
                $name = $row["uName"];
                $email = $row["uEmail"];
                $phone = $row['uPhone'];
                $image = $row["uImg"];
            }
            } else {
                echo "Không có dữ liệu trong bảng users";
            }
            $stmt->close(); // Đóng statement
            } else {
                // Hiển thị thông báo lỗi nếu truy vấn không được chuẩn bị thành công
                echo "Lỗi trong quá trình chuẩn bị truy vấn";
            }
        } else {
        // Hiển thị thông báo lỗi nếu biến kết nối không tồn tại
        echo "Lỗi: Không có kết nối đến cơ sở dữ liệu";
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
                                        <a class="nav-link active text-black fs-5" href="../index.php">Tours</a>
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
                                    <li class="list-group-item d-flex align-items-center py-3 point ">
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
                    <div class="mycard profile"> <!-- thuộc tính enctype dùng để lấy file của user -->
                        <form name="form-img" id="form-img" action="" method="post" enctype="multipart/form-data">
                            <div class="pic-content d-flex justify-content-center mb-5" id="profile">
                                <div class="card" style="width: 12rem">
                                    <div class="pic d-flex justify-content-center">
                                        <img src="../pic/<?php echo $image; ?>" class='avatar-lg rounded-5' title="<?php echo $image; ?>">
                                    </div>

                                    <div class="card-body d-flex justify-content-center">
                                        <input type="hidden" name="id" value="<?php echo $uid; ?>">
                                        <input type="hidden" name="name" value="<?php echo $name; ?>">
                                        <input type="file" name="upload" id="upload" accept=".jpg, .jpeg, .png" hidden>
                                        <label for="upload" class="btn btn-primary"> Upload hình mới</label>
                                    </div>
                                </div>
                            </div>
                            <!-- Đổi hình ảnh -->
                            <script>
                                //khi bấm vào input có id là upload sẽ submit form
                                document.getElementById("upload").onchange = function() {
                                    document.getElementById("form-img").submit();
                                }
                            </script>
                            <?php
                            //kiểm tra xem hình ảnh đã được tải lên hay chưa
                            if (isset($_FILES["upload"]["name"])) {
                                $uid = $_POST["id"];
                                $name = $_POST["name"];

                                $imageName = $_FILES["upload"]["name"]; //tên tệp hình ảnh
                                $imageSize = $_FILES["upload"]["size"]; //kích cỡ ảnh
                                $tmpName = $_FILES["upload"]["tmp_name"]; //đường dẫn tạm thời của ảnh

                                // xác thực đuôi tệp có đúng định dạng hay chưa
                                $validImageExtension = ['jpg', 'jpeg', 'png'];
                                $imageExtension = explode('.', $imageName); //Tách chuỗi tên thành 1 mảng
                                $imageExtension = strtolower(end($imageExtension)); //chuyển 1 chuỗi thành viết thường và truy xuất phần tử cuối cùng của mảng

                                if (!in_array($imageExtension, $validImageExtension)) { //kiểm tra xem tên hình ảnh có hợp lệ hay không
                                    echo "<script>alert('Invalid Image Extension');
                                          exit;
                                          </script>";
                                } elseif ($imageSize > 5000000) { //giới hạn là 5mb
                                    echo "<script>alert('Image Size Is Too Large');
                                          exit;
                                          </script>";
                                } else {
                                    $newImageName = $name . " - " . date("Y.m.d") . " - " . date("h.i.sa"); // tạo tên hình ảnh mới để lưu vào CSDL
                                    $newImageName .= '.' . $imageExtension;
                                    $stmt = $conn->prepare("UPDATE users SET uImg = ? WHERE uID = ?");
                                    $stmt->bind_param("si", $newImageName, $uid);
                                    $stmt->execute();
                                    move_uploaded_file($tmpName, '../pic/' . $newImageName); //Di chuyển tệp tin hình ảnh tạm thời đến thư mục ../pic với tên mới

                                    // gắn hình mới vào session img
                                    $stmt1 = $conn->prepare("SELECT uImg from users where uID = ?");
                                    $stmt1->bind_param("i", $uid);      
                                    $stmt1->execute();

                                    $result1 = $stmt1->get_result();
                                    $row1 = $result1->fetch_assoc();
                                    $_SESSION['img'] = $row1['uImg'];
                                    
                                    echo " <script> alert('Thành công!');
                                          window.location.href = '/php_project/user/profile.php';
                                          </script>";
                                }
                            }
                            ?>
                        </form>
                            <!-- sử dụng ajax để thêm dữ liệu -->
                        <div class="profile-content px-4"> <!-- class cover sẽ bị ẩn khi nút đổi mật khẩu được bấm-->
                            <form action="" method="get" name="form-change-info" id="form-change-info" class="cover">
                                <div class="mb-3 row">
                                    <label for="namechange" class="col-sm-3 col-form-label">Họ tên đầy đủ:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="namechange" id="namechange" value="<?php echo $name; ?>" />
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="phone" class="col-sm-3 col-form-label">Số điện thoại</label>
                                    <div class="col-sm-8">
                                        <input type="" class="form-control" name="phonechange" id="phonechange" value="<?php echo $phone; ?>" />
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-8">
                                        <input type="email" class="form-control" id="email" name="email" readonly value="<?php echo $email; ?>" />
                                    </div>
                                </div>
                            </form>

                        </div>

                        <!-- đổi mật khẩu -- form ẩn cho đến khi được bấm vào -->
                        <form action="" method="post" name="form-change-pass" id="form-change-pass">
                            <div class="hidden resetpass">
                                <div class="mb-3 row">
                                    <label for="oldPass" class="col-sm-3 col-form-label">Mật khẩu hiện tại</label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control" id="oldPass" name="oldPass">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="newPass" class="col-sm-3 col-form-label">Mật khẩu mới:</label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control" id="newPass" name="newPass">
                                        <div id="note1" class="form-text">Ít nhất 6 kí tự.</div>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="reEnterPass" class="col-sm-3 col-form-label">Nhập lại mật khẩu:</label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control" id="reEnterPass" name="reEnterPass">
                                        <div id="note2" class="form-text">Ít nhất 6 kí tự.</div>
                                    </div>
                                </div>
                                <div class="d-flex float-end">
                                    <button type="submit" class="btn btn-primary" id="change-submit">Xác nhận đổi</button>
                                </div>
                            </div>
                            <div class="submit-btn d-flex justify-content-center">
                                <!-- nút thay đổi thông tin cá nhân -->
                                <button type="submit" name="saveinfo-btn" id="saveinfo-btn" class="btn btn-outline-secondary me-4 cover">Lưu thông tin</button>
                                <input type="hidden" name="changeInfo_btn_clicked" id="changeInfo_btn_clicked" value="0">
                                <!-- nút đổi mật khẩu -->
                                <button type="submit" class="btn btn-outline-secondary" id="changePass-btn" name="changePass-btn">Đổi mật khẩu</button>
                                <input type="hidden" name="changePass_btn_clicked" id="changePass_btn_clicked" value="0">

                            </div>
                        </form>


                        <!-- đổi mật khẩu -->
                        <?php
                        if (isset($_POST['changePass_btn_clicked']) && ($_POST['changePass_btn_clicked']) == "2") {
                            $oldpass = $_POST['oldPass'];
                            $newpass = $_POST['newPass'];
                            $reEnter = $_POST['reEnterPass'];

                            $stmt1 = $conn->prepare("SELECT uPass FROM users WHERE uID = ?");
                            $stmt1->bind_param("i", $uid);
                            $stmt1->execute();
                            $result1 = $stmt1->get_result();

                            if ($result1->num_rows > 0) {
                                $row1 = $result1->fetch_assoc();
                                $storedPassword = $row1['uPass']; // Mật khẩu đã được lưu trong cơ sở dữ liệu

                                // Kiểm tra mật khẩu hiện tại
                                if ($oldpass === $storedPassword) {
                                    // Kiểm tra mật khẩu mới và xác nhận lại mật khẩu
                                    if ($newpass === $reEnter) {

                                        // Gọi stored procedure để thay đổi mật khẩu
                                        $stmt2 = $conn->prepare("CALL CHANGE_PASS(?, ?)");
                                        $stmt2->bind_param("is", $uid, $newpass);
                                        $stmt2->execute();

                                        echo "<script>alert('Đổi mật khẩu thành công');</script>";
                                    } else {
                                        echo "<script>alert('Nhập lại mật khẩu mới không khớp');</script>";
                                    }
                                } else {
                                    echo "<script>alert('Sai mật khẩu hiện tại');</script>";
                                }
                            }
                        }
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
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script> -->

    <!-- Thay đổi thông tin cá nhân -->
    <script>
        document.getElementById("saveinfo-btn").addEventListener("click", function() {
            var name = document.getElementById("namechange").value;
            var phone = document.getElementById("phonechange").value;
            
            //khởi tạo một đối tượng XMLHttpRequest mới, đây là đối tượng cho phép thực hiện các yêu cầu AJAX mà không cần phải tải lại trang
            const xhr = new XMLHttpRequest(); 

            // Open a new request
            xhr.open('GET', 'http://localhost/php_project/api/changeInfo.php?name=' + name + '&phone=' + phone);
            // define a callback function
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Xử lý phản hồi
                    console.log(xhr.responseText); 
                    alert("Đổi thông tin cá nhân hoàn tất");
                }
            };
            xhr.send();

        })
    </script>

    <!-- Đổi mật khẩu -->
    <script>
        // Wait for the DOM content to fully load before executing the code
        document.getElementById('changePass-btn').addEventListener('click', function(event) {
            document.getElementById('changePass_btn_clicked').value = "2"; // Gán giá trị "2" cho input ẩn
            event.preventDefault(); // Ngăn chặn hành vi mặc định của sự kiện click        

            var changePassBtn = document.getElementById("changePass-btn");

            if (changePassBtn) {
                changePassBtn.addEventListener("click", function() {


                    var resetPass = document.querySelectorAll(".hidden.resetpass");
                    var cover = document.querySelectorAll(".cover");

                    // hiển thị các phần tử ở class "hidden resetpass"
                    resetPass.forEach(function(element) {
                        element.style.display = "block";
                    });

                    // ẩn các nút có ID "changePass-btn"
                    changePassBtn.style.display = "none";

                    // ẩn các phần thử ở class "cover"
                    cover.forEach(function(element) {
                        element.style.display = "none";
                    });
                });
            }
        });
    </script>


</body>

</html>