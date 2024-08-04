<?php 
    session_start();
    include "../connect.php";
?>

<!doctype html>
<html lang="en">

<head>
    <title>Staff - quản lý tour</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" /> -->
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
                                        <a class="nav-link active text-black fs-5" href="info.php">Thông tin cá
                                            nhân</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-black fs-5" href="tourmanagement.php"
                                            aria-current="page">
                                            Thông tin tour</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-black fs-5" href="advise.php">
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
                    <p class="fs-3 fw-semibold">Danh sách Booking</p>
                </div>
                
                <!-- booking check table -->
                <div class="check-table">
                    <table class="table table-striped">
                        <thead>
                <?php
                    if (!isset($conn)) {
                        echo "Không thế kết nối đến CSDL!";
                    } else {
                        $stmt = $conn->prepare("SELECT * FROM booking b
                                                LEFT JOIN tour_date td ON b.tdID = td.tdID
                                                LEFT JOIN tours t ON td.tID = t.tID
                                                ORDER BY bID DESC");
                        $stmt->execute();
                        $result = $stmt->get_result();
                        if ($result->num_rows > 0) {
                            echo "<tr>";
                                echo "<th scope='col'>Mã booking</th>";
                                echo "<th scope='col'>Tên khách hàng</th>";
                                echo "<th scope='col'>Số điện thoại</th>";
                                echo "<th scope='col'>Số lượng vé</th>";
                                echo "<th scope='col'>Tổng tiền (VND)</th>";
                                echo "<th scope='col'>Xác nhận</th>";
                                echo "<th scope='col'>Check</th>";
                            echo "</tr>";
                            echo "</thead>
                                <tbody>";
                            while ($row = $result->fetch_assoc()) {
                                echo "
                                <tr>
                                <td>". $row['bID']."</td>
                                <td>". $row['bName'] ."</td>
                                <td>". $row['bPhone'] ."</td>
                                <td>". $row['bTicketNum'] ."</td>
                                <td>". number_format($row['bTotal'], 0, ',', '.') ."</td> <!-- Kết quả: 1.234.l567,89 -->
                                <td>". ($row['bStatus'] == 0 ? "Chưa xác nhận." : "Đã xác nhận.") ."</td>
                                <td><button type='button' class='btn' data-bs-toggle='modal'
                                    data-bs-target='#statusModal". $row['bID']."' ><i class='fas fa-edit'></i>                           
                                    </button>
                                </td>
                                <!-- Modal -->
                                <div class='modal fade' id='statusModal". $row['bID']. "' tabindex='-1'
                                    aria-labelledby='statusModalLabel' aria-hidden='true'>
                                    <div class='modal-dialog'>
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                                <h1 class='modal-title fs-5' id='exampleModalLabel'>Thông tin chi tiết booking của <span>".$row['bID'] ."</span></h1>
                                                <button type='button' class='btn-close' data-bs-dismiss='modal'
                                                    aria-label='Close'></button>
                                            </div>
                                            
                                            <div class='modal-body'>
                                                <form action='' id='info-content'>
                                                    <div class='row'>
                                                        <p class='fs-4 fw-semibold ms-2'>Thông tin tour</p>
                                                        <div class='col-12'>
                                                            <div class='px-2'>
                                                                <p class='fw-bold'>Tên tour</p>
                                                                <p>". $row['tName']."</p>
                                                            </div>
                                                        </div>
                                                        <div class='col-6'>
                                                            <div class='px-2'>
                                                                <p class='fw-bold'>Ngày bắt đầu</p>
                                                                <p>". $row['tStart']."</p>
                                                            </div>
                                                        </div>
                                                        <div class='col-6'>
                                                            <div class='px-2'>
                                                                <p class='fw-bold'>Ngày kết thúc</p>
                                                                <p>". $row['tEnd']."</p>
                                                            </div>
                                                        </div>
                                                        <p class='fs-4 fw-semibold mt-2 ms-2'>Thông tin khách hàng</p>
                                                        <div class='col-6'>
                                                            <div class='px-2'>
                                                                <label for='Name' class='form-label'>Tên khách hàng</label>
                                                                <input type='text' class='form-control' id='Name' value='". $row['bName']."'>
                                                            </div>
                                                        </div>
                                                        <div class='col-6'>
                                                            <div class='px-2 '>
                                                                <label for='email' class='form-label'>Email</label>
                                                                <input type='email' class='form-control' id='email' value='". $row['bEmail']."' readonly>
                                                            </div>
                                                        </div>
                                                        <div class='col-6'>
                                                            <div class='px-2 mt-2'>
                                                                <label for='Phone' class='form-label'>Số điện thoại</label>
                                                                <input type='text' class='form-control' id='Phone' value='". $row['bPhone']."' readonly>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class='col-12'>
                                                            <div class='px-2 mt-2'>
                                                                <label for='Note' class='form-label'>Ghi chú</label>
                                                                <input type='text' class='form-control' id='Note' value='". $row['bNote'] ."'>
                                                            </div>
                                                        </div>
                                                        <p class='fs-4 fw-semibold mt-3 ms-2'>Số lượng vé</p>
                                                        <div class='row'>
                                                            <div class='col-6'>
                                                                <div class='px-2'>
                                                                    <label for='aldult' class='form-label'>Người lớn (> 9 tuổi)</label>
                                                                    <input type='number' class='form-control' id='aldult' value='". $row['bTick_al'] ."' readonly>
                                                                </div>
                                                            </div>
                                                            <div class='col-6'>
                                                                <div class='px-2'>
                                                                    <label for='kids' class='form-label'>Trẻ em (5 - 9 tuổi)</label>
                                                                    <input type='number' class='form-control' id='kids' value='". $row['bTick_kids'] ."' readonly>
                                                                </div>
                                                            </div>
                                                            <div class='col-6'>
                                                                <div class='px-2'>
                                                                    <label for='child' class='form-label'>Trẻ nhỏ (< 5 tuổi)</label>
                                                                    <input type='number' class='form-control' id='child' value='". $row['bTick_child'] ."' readonly>
                                                                </div>
                                                            </div>
                                                            <div class='col-6'>
                                                                <div class='px-2'>
                                                                    <label for='child' class='form-label'>Tổng số vé</label>
                                                                    <input type='number' class='form-control' id='child' value='". $row['bTicketNum'] ."' readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>

                                            <div class='modal-footer'>
                                                <div class='form-check'>
                                                    <input class='form-check-input' type='radio' name='flexRadioDefault' id='confirmed'>
                                                    <label class='form-check-label' for='confirmed'>
                                                      Đã xác nhận
                                                    </label>
                                                </div>
                                                <div class='form-check'>
                                                    <input class='form-check-input' type='radio' name='flexRadioDefault' id='flexRadioDefault2'".($row['bStatus'] == 0 ? "checked" : "")." >
                                                    <label class='form-check-label' for='flexRadioDefault2'>
                                                      Chưa xác nhận
                                                    </label>
                                                </div>
                                                <button type='button' class='btn btn-secondary' id='check-done'
                                                    data-bs-dismiss='modal'>Done</button>
                                                    <input id='idBooking' value='". $row['bID'] ."' type='hidden'>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </tr>";
                            }
                        } else {
                            echo "Không có dữ liệu trong bảng booking";
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>

    <!-- khi thay đổi trạng thái xác nhận đơn -- confirmed -->
    <script>
        document.getElementById('check-done').addEventListener('click', function() {
        // Lấy giá trị của input radio "Đã xác nhận"
        const confirmed = document.getElementById('confirmed').checked;
        var idbooking = document.getElementById('idBooking').value;
        // Nếu input radio "Đã xác nhận" được chọn
        if (confirmed) {
            // Gửi yêu cầu AJAX để cập nhật trạng thái trong cơ sở dữ liệu
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'http://localhost/php_project/api/update-status.php?id=' + idbooking);
            xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                console.log(xhr.responseText); // Hiển thị phản hồi từ máy chủ trong console
                location.href="tourmanagement.php";
            }
            }
            xhr.send();
        }
        });
    </script>
</body>

</html>