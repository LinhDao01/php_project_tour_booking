<?php 
    session_start();
    include "../connect.php";

?>

<!doctype html>
<html lang="en">

<head>
    <title>Staff - Tư vấn khách hàng</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" -->
        <!-- integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" /> -->
    <link rel="stylesheet" href="../bootstrap-5.3.3-dist/css/bootstrap.min.css">    
    <!-- css -->
    <link rel="stylesheet" href="../css/staff.css">
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
                                    <a href="#" class="logo-wrapper">
                                        <img src="../pic/logo-4.png" alt="logo " />
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
                                        <a class="nav-link active text-black fs-5" 
                                            href="info.php">Thông tin cá nhân</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-black fs-5" href="tourmanagement.php" >
                                            Thông tin tour</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-black fs-5" href="tourmanagement.php" aria-current="page">
                                            Tư vấn khách hàng
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-black fs-5" href="../logout.php"></i>
                                            <span>Đăng xuất</span></a>
                                    </li>
                                </ul>
                                <ul class="navbar-nav float-end">
                                    <li class="nav-item">
                                        <a class="nav-link text-black fs-5"
                                            href="info.php"><?php echo $_SESSION["username"]; ?></a>
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
            <div class="mycard mana-tour">
                <div class="header">
                    <p class="fs-3 fw-semibold">Danh sách Tư vấn</p>
                </div>
                    
                <!-- booking check table -->
                <div class="check-table">
                    <table class="table table-striped">
                        <thead>
                <?php 
                    if (!isset($conn)) {
                        echo "Không kết nối được đến CSDL!";
                    } else {
                        $stmt = $conn->prepare("SELECT * FROM advise ORDER BY aID DESC");
                        $stmt->execute();
                        $result = $stmt->get_result();
                        if ($result->num_rows > 0) {
                            echo "<tr>";
                                echo "<th scope='col'>ID</th>";
                                echo "<th scope='col'>Tên khách hàng</th>";
                                echo "<th scope='col'>Số điện thoại</th>";
                                echo "<th scope='col'>Email</th>";
                                echo "<th scope='col'>Yêu cầu khác</th>";
                                echo "<th scope='col'>Check</th>";
                            echo "</tr>";
                            echo "</thead>
                            <tbody>";
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                <th scope='row'>". $row['aID'] ." <input id='idques' type='hidden' value='". $row['aID'] ."'></th>
                                <td>". $row['aName'] ."</td>
                                <td>". $row['aPhone'] ."</td>
                                <td>". $row['aEmail'] ."</td>
                                <td>". $row['aNote'] ."</td>
                                <td><input class='check' type='checkbox' id='myCheck' ></td>
                              </tr>";
                            }
                        } else {
                            echo "Không có dữ liệu trong bảng advise!";
                        }
                    }
                ?>
                          </tbody>
                      </table>
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
                
        <!-- checkbox trạng thái tư vấn -->
        <script>
            var checkbox = document.getElementById('myCheck');
            var idques = document.getElementById('idques').value;

            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    // Gửi yêu cầu AJAX để lưu trạng thái vào cơ sở dữ liệu
                    var xhr = new XMLHttpRequest();
                    xhr.open('GET', 'http://localhost/php_project/api/update-checkbox.php?id=' + idques);
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                            console.log(xhr.responseText); // Hiển thị phản hồi từ máy chủ trong console
                            checkbox.disabled = true; // Vô hiệu hóa checkbox sau khi đã được check
                        }
                    }
                    xhr.send();
                }
            });
        </script>
</body>

</html>