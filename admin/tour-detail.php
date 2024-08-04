<?php
session_start();
include '../connect.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php //kiểm tra xem có tham số id trong URL hay không
    if (isset($_GET['id'])) {
        $tourId = $_GET['id'];

        if (isset($conn)) {
            $stmt = $conn->prepare("SELECT * FROM tours where tID = ?");
            $stmt->bind_param("i", $tourId);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo "<title> Thông tin tour" . $row['tName'] . "</title>";
            } else {
                echo "tour không tồn tại!";
            }
            // $stmt->close();
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
    <link rel="stylesheet" href="../bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <!-- css -->
    <link rel="stylesheet" href="../css/admin.css" />
    <!-- icon -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" /> -->
    <!-- fontawesome -->
    <script src="https://kit.fontawesome.com/1ee92f529b.js" crossorigin="anonymous"></script>
</head>

<body>
    <main>
        <div class="row g-0">
            <!-- sidebar -->
            <div class="col-2">
                <div class="menu px-3 pt-4 sticky">
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
                                        <a href="home.php" class="active">
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
                            <a class="text-black fs-5" aria-current="page" href="#name"><?php echo $_SESSION["username"]; ?></a>
                        </div>
                    </div>
                </div>
                <div class="content">
                    <div class="container">
                        <div class="">
                            <!-- đường dẫn -->
                            <div class="container my-3">
                                <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#">Quản lý tour</a></li>
                                        <li class="breadcrumb-item">
                                            <a href="tourinfo.php">Quản lý thông tin tour</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">
                                            Chi tiết tour
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                            <?php
                            //lấy ID tour được truyền từ tourinfo qua URL
                            if (isset($_GET['id'])) {
                                $tourId = $_GET['id'];

                                if (isset($conn)) {
                                    $stmt = $conn->prepare("SELECT * FROM tours t where tID = ?");
                                    $stmt->bind_param("i", $tourId);
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    if ($result->num_rows > 0) {
                                        $row = $result->fetch_assoc();
                                        $tourID = $row['tID'];

                                        // Hiển thị thông tin chi tiết của tour
                                        echo "<div class='container content'>
                                                <div class='tour-name'>
                                                    <h1 class='fw-bold text-success'>" . $row['tName'] . "</h1> <!-- tên tour -->
                                                </div>";

                                        echo "<div class='col-lg-12 col-md-12 col-sm-12 detail'>";
                                        // hình đầu trang
                                        echo "<div class='col-sm-12'>
                                                <div class='ol-sm-12 border border-success'>
                                                    <img src='../pic/back4.jpg' alt='' class='pic' />
                                                </div>
                                                <div class='col-sm-12 border border-success p-2'>
                                                    <div class='row'>
                                                        <div class='col-auto'>
                                                            <i class='fas fa-map-marker-alt' data-bs-toggle='tooltip'
                                                            data-bs-title='Nơi xuất phát'></i> " . $row['tPlace'] //noi xuất phát
                                            .
                                            "</div>
                                                        <div class='col-auto'>
                                                            <i class='fas fa-clock' data-bs-toggle='tooltip'
                                                            data-bs-title='Thời gian của tour'></i> " . $row['tDay'] //thời gian của tour
                                            .
                                            "</div>
                                                        <div class='col-auto'>
                                                            Phương tiện di chuyển
                                                            <i class='fas fa-bus' data-bs-toggle='tooltip' data-bs-title='Xe khách'></i>
                                                            <i class='fas fa-ship' data-bs-toggle='tooltip' data-bs-title='Tàu thủy'></i>
                                                        </div>
                                                        <div class='col-auto'>Mã tour: <span> " . $row['tID'] //mã tour
                                            . "</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>";

                                        echo "<div class='col-sm-12 border border-success my-2 introduce'>
                                                <div class='col-12 descript'>
                                                    <div class='head ms-1'>
                                                        <h4 class='fw-bold text-success'>" . $row['tName'] . "</h4>
                                                    </div>
                                                    <div class='content'>
                                                        <p class='ms-3'>" . $row['tDesc'] // mô tả tour
                                                        . "</p>
                                                    </div>
                                                </div>
                                            </div>";
                                        //Mô tả lịch trình chi tiết
                                        echo "<div class='col-sm-12 border border-success my-2 introduce'>
                                                <div class='head ms-1 d-flex'>
                                                    <h4 class='fw-bold text-success'>Lịch trình</h4>
                                                    <button  type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#Modal1'>
                                                        <i class='far fa-calendar-plus'></i>
                                                    </button>
                                                </div>";

                                        $stmt1 = $conn->prepare("SELECT ts.tsDay, ts.tsDesc 
                                                                FROM tours t
                                                                LEFT JOIN tour_schedule ts ON t.tID = ts.tID AND t.tID = ?
                                                                WHERE ts.tsId IS NOT NULL
                                                                ORDER BY ts.tsId ASC");
                                        $stmt1->bind_param("i", $tourID);
                                        $stmt1->execute();
                                        $result1 = $stmt1->get_result();
                                        // lịch trình (các nơi sẽ đi theo ngày)
                                        if ($result1->num_rows > 0) {
                                            while ($row1 = $result1->fetch_assoc()) {
                                                echo "
                                                    <div class='content mx-3'>
                                                        <h6 class='fw-semibold'>" . $row1['tsDay'] . " </h6>
                                                        <p>" . $row1['tsDesc'] . "</p>
                                                    </div>";
                                            }
                                        } else {
                                            echo "Chưa thêm lịch trình cho tour này!";
                                        }
                                        echo "</div>";

                                echo "<!-- Modal -->
                                        <div class='modal fade' id='Modal1' tabindex='-1' aria-labelledby='ModalLabel1' aria-hidden='true'>
                                            <div class='modal-dialog'>
                                                <div class='modal-content'>
                                                    <div class='modal-header '>
                                                        <h1 class='modal-title fs-5' id='exampleModalLabel'>Thêm lịch trình cho tour</h1>
                                                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                    </div>
                                              
                                                    <form action='tour-detail.php?id=$tourId' method='post'>
                                                        <div class='modal-body'>
                                                            <div class='mb-3'>
                                                                <input type='hidden' name='tour_id' id='tour_id' value='". $tourId ."'>
                                                                <label for='name' class='form-label'>Ngày thứ N</label>
                                                                <input type='text' class='form-control' id='dayof' name='dayof'>
                                                                <div id='desDay' class='form-text'>
                                                                    Đêm 1, Điểm đón, Ngày 1, Ngày 2, ...
                                                                </div>
                                                            </div>
                                                            <div class='mb-3'>
                                                                <label for='name' class='form-label'>Mô tả chi tiết lịch trình</label>
                                                                <textarea class='form-control' rows='5' placeholder='Nhập lịch trình ở đây...' name='desc' id='desc'></textarea>
                                                            </div>
                                                        </div>
                                                        <div class='modal-footer'>
                                                            <button type='submit' class='btn btn-primary' name='btn-tourschedule'>Lưu</button>
                                                        </div>
                                                    </form>
                                                
                                                </div>
                                            </div>
                                        </div>";
                                        // thêm lịch trình chi tiết cho tour
                                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                            if (isset($_POST['tour_id'])) {
                                                $id = $_POST['tour_id'];
                                                $day = $_POST['dayof'];
                                                $dayof =  strtoupper($day);
                                                $desc = $_POST['desc'];

                                                $add_t = $conn->prepare("CALL ADD_SCHEDULE(?,?,?)");
                                                $add_t->bind_param("iss", $id, $dayof, $desc);
                                                $add_t->execute();

                                                // Check if any rows were affected (successful deletion)
                                                if ($add_t->affected_rows > 0) {
                                                    echo "<script> alert('Thêm lịch trình thành công!');</script>";
                                                } else {
                                                    echo "<script>alert('Không thể thêm trình. Vui lòng thử lại sau!');</script>";
                                                }
                                            }
                                        }

                                        //lịch khởi hành - modal
                                        echo "<div class='col-sm-12 border border-success my-2 introduce'>
                                                <div class='head ms-1 d-flex'>
                                                    <h4 class='fw-bold text-success'>Lịch khởi hành</h4>
                                                    <button  type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#exampleModal'>
                                                        <i class='far fa-calendar-plus'></i>
                                                    </button>
                                                </div>
                                                <!-- Modal -->
                                                <div class='modal fade' id='exampleModal' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                                    <div class='modal-dialog'>
                                                        <div class='modal-content'>
                                                            <div class='modal-header'>
                                                                <h1 class='modal-title fs-5' id='exampleModalLabel'>Thêm lịch khởi hành cho tour</h1>
                                                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                            </div>
                                                      
                                                            <form action='tour-detail.php?id=$tourId' method='post'>
                                                                <div class='modal-body'>
                                                                    <div class='mb-3'>
                                                                        <input type='hidden' name='tour-id' id='tour-id' value='". $tourId ."'>
                                                                        <label for='name' class='form-label'>Ngày bắt đầu</label>
                                                                        <input type='date' class='form-control' id='start-date' name='start-date'>
                                                                    </div>
                                                                    <div class='mb-3'>
                                                                        <label for='name' class='form-label'>Ngày kết thúc</label>
                                                                        <input type='date' class='form-control' id='end-date' name='end-date'>
                                                                    </div>
                                                                </div>
                                                                <div class='modal-footer'>
                                                                    <button type='submit' class='btn btn-primary' name='btn-tourdate'>Lưu</button>
                                                                </div>
                                                            </form>
                                                        
                                                        </div>
                                                    </div>
                                                </div>";
                                        // Thêm lịch khởi hành
                                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                                if (isset($_POST['tour-id'])) {
                                                    $id = $_POST['tour-id'];
                                                    $start = $_POST['start-date'];
                                                    $end = $_POST['end-date'];

                                                    $add_t = $conn->prepare("CALL ADD_TOURDATE(?,?,?)");
                                                    $add_t->bind_param("iss", $id, $start, $end);
                                                    $add_t->execute();

                                                    // Check if any rows were affected (successful deletion)
                                                    if ($add_t->affected_rows > 0) {
                                                        echo "<script> alert('Thêm lịch khởi hành thành công!');</script>";
                                                    } else {
                                                        echo "<script>alert('Không thể thêm lịch khởi hành. Vui lòng thử lại sau!');</script>";
                                                    }
                                                }
                                            }

                                            // xóa lịch khởi hành
                                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                            if (isset($_POST['tdid'])) {
                                                $tdid = $_POST['tdid'];

                                                $del_td = $conn->prepare("CALL DEL_TOURDATE(?)");
                                                $del_td->bind_param("i", $tdid);
                                                $del_td->execute();

                                                // Check if any rows were affected (successful deletion) //chưa hiểu ---
                                                if ($del_td->affected_rows > 0) {
                                                    echo "<script> alert('Xóa lịch khởi hành thành công!');
                                                    window.location.back();</script>";
                                                } else {
                                                    echo "<script>alert('Không thể xóa được lịch khởi hành!');</script>";
                                                }

                                            }
                                        }
                                            
                                            // hiển thị lịch khởi hành
                                            echo "<div class='content mx-3'>
                                                    <table class='table'>
                                                        <thead>
                                                            <tr>
                                                                <th scope='col'>Ngày khởi hành</th>
                                                                <th scope='col'>Ngày về</th>
                                                                <th scope='col'>Tình trạng chỗ</th>
                                                                <th scope='col'>Giá</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class='table-group-divider'>";

                                        $stmt2 = $conn->prepare("SELECT * FROM tour_date td 
                                                                LEFT JOIN tours t on td.tID = t.tID 
                                                                where t.tID = ?");
                                        $stmt2->bind_param("i", $tourId);
                                        $stmt2->execute();
                                        $result2 = $stmt2->get_result();
                                        if ($result2->num_rows > 0) {
                                            while ($row2 = $result2->fetch_assoc()) {
                                                echo "<tr>";
                                                echo "<th>" .  $row2['tStart'] . "</th>";
                                                echo "<td>" . $row2['tEnd'] . "</td>";
                                                echo "<td>Liên hệ tư vấn</td>";
                                                echo "<td>" . $formattedAmount = number_format($row2['tPrice_al'], 0, ',', '.') . " VNĐ</td>";
                                                echo "<td><form action='tour-detail.php?id=$tourId' method='post'>
                                                            <input type='hidden' name='tdid' id='tdid' value='". $row2['tdID'] ."'>
                                                            <button type='submit' name'btn-td'><i class='far fa-trash-alt'></i></button>
                                                          </form>
                                                      </td>";
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "Chưa thêm lịch khởi hành cho tour!";
                                        }
                                        
                                        
                                        
                                        echo "</tbody>
                                                    </table>
                                                </div>
                                            </div>";
                                        // mô tả về hướng dẫn viên
                                        echo "<div class='col-sm-12 border border-success my-2 introduce'>
                                                <div class='head ms-1'>
                                                    <h4 class='fw-bold text-success'>Hướng dẫn viên</h4>
                                                </div>
                                                <div class='content'>
                                                    <p class='ms-3'>
                                                        - Hướng Dẫn Viên (HDV) sẽ liên lạc với Quý Khách khoảng 2-3
                                                        ngày trước khi khởi hành để sắp xếp giờ đón và cung cấp các
                                                        thông tin cần thiết cho chuyển đi.
                                                    </p>
                                                </div>
                                            </div>";
                                        // chi tiết giá và mục khác (list-tab)                
                                        echo "<div class='col-sm-12 border border-success my-2 introduce'>
                                                <div class='head ms-1'>
                                                    <h4 class='fw-bold text-success'>Chi tiết giá</h4>
                                                </div>
                                                <div class='col-sm-12'>
                                                    <!-- nav-tab -->
                                                    <div class='tourRule'>
                                                        <!-- tablist-->
                                                        <ul class='nav nav-tabs' id='myTab' role='tablist'>
                                                            <li class='nav-item' role='presentation'>
                                                                <button class='nav-link active' id='list-tab1' data-bs-toggle='tab'
                                                                    data-bs-target='#list-tab1-pane' type='button' role='tab'
                                                                    aria-controls='list-tab1-pane' aria-selected='true'>
                                                                    Giá bao gồm
                                                                </button>
                                                            </li>
                                                            <li class='nav-item' role='presentation'>
                                                                <button class='nav-link' id='list-tab2' data-bs-toggle='tab'
                                                                    data-bs-target='#list-tab2-pane' type='button' role='tab'
                                                                    aria-controls='list-tab2-pane' aria-selected='false'>
                                                                    Giá không bao gồm
                                                                </button>
                                                            </li>
                                                            <li class='nav-item' role='presentation'>
                                                                <button class='nav-link' id='list-tab3' data-bs-toggle='tab'
                                                                    data-bs-target='#list-tab3-pane' type='button' role='tab'
                                                                    aria-controls='list-tab3-pane' aria-selected='false'>
                                                                    Phụ thu
                                                                </button>
                                                            </li>
                                                            <li class='nav-item' role='presentation'>
                                                                <button class='nav-link' id='list-tab4' data-bs-toggle='tab'
                                                                    data-bs-target='#list-tab4-pane' type='button' role='tab'
                                                                    aria-controls='list-tab4-pane' aria-selected='false'>
                                                                    Hủy đổi
                                                                </button>
                                                            </li>
                                                            <li class='nav-item' role='presentation'>
                                                                <button class='nav-link' id='list-tab5' data-bs-toggle='tab'
                                                                    data-bs-target='#list-tab5-pane' type='button' role='tab'
                                                                    aria-controls='list-tab5-pane' aria-selected='false'>
                                                                    Lưu ý
                                                                </button>
                                                            </li>
                                                        </ul>
                                                        <!-- tab-content -->
                                                        <div class='tab-content mx-3' id='myTabContent'>
                                                            <div class='tab-pane fade show active' id='list-tab1-pane' role='tabpanel'
                                                                aria-labelledby='list-tab1' tabindex='0'>
                                                                <div class='col-sm-12'>
                                                                    <p><strong>Vận chuyển:</strong></p>";
                                                                    // <!-- hiển thị nơi lưu trú và phương tiện vận chuyển -->
                                                                    echo "<p>" . $row['tTransport'] . "<br /></p>";
                                                                    echo "<p><strong>Lưu trú:</strong></p>";
                                                                    echo "<p>" . $row['tStay'] . "</p>";
                                                                    echo "<p><strong>Khác:</strong></p>";
                                                                    echo "<p>
                                                                    - Ăn uống theo ẩm thực địa phương: Ăn sáng: 02 bữa -
                                                                    01 tô/ 01 ly, Ăn chính: 03 bữa <br />
                                                                    - Set menu 5 món trở lên. <br />
                                                                    - Hướng dẫn viên thuyết minh và phục vụ cho đoàn
                                                                    suốt tuyến. <br />
                                                                    - Bảo hiểm du lịch 50.000.000 VND. <br />
                                                                    - Vé tham quan vào cổng tại tất cả các điểm theo
                                                                    chương trình.
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class='tab-pane fade' id='list-tab2-pane' role='tabpanel'
                                                            aria-labelledby='list-tab2' tabindex='0'>
                                                            <div class='col-sm-12'>
                                                                <p>
                                                                    - VAT. <br />
                                                                    - Các khoản phụ thu. <br />
                                                                    - Các bữa ăn ngoài chương trình. <br />
                                                                    - Tips dành cho hướng dẫn, tài xế và nhân viên phục
                                                                    vụ nhà hàng, khách sạn. <br />
                                                                    - Ăn uống, tham quan ngoài chương trình, điện thoại,
                                                                    giặt ủi và các chi phí tắm biển, giải trí cá nhân.
                                                                    <br />
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class='tab-pane fade' id='list-tab3-pane' role='tabpanel'
                                                            aria-labelledby='list-tab3' tabindex='0'>
                                                            <div class='col-sm-12'>
                                                                <p>
                                                                    - Phòng 01 người: 300.000đ/phòng/tour. <br />
                                                                    - Phòng 03 người: 150.000đ/phòng/tour. <br />
                                                                    <strong>Phụ Thu Trẻ Em:</strong> <br />
                                                                    - Trẻ em từ 10 tuổi trở lên mua 100% giá tour.
                                                                    <br />
                                                                    - Trẻ em từ 06 - 9 tuổi mua 75% giá tour. <br />
                                                                    - Trẻ em từ 05 tuổi trở xuống: Không tính vé, gia
                                                                    đình tự lo. Hai người lớn được kèm 01 trẻ em, trẻ em
                                                                    thứ 02 trở lên phải mua 75% giá vé.
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class='tab-pane fade' id='list-tab4-pane' role='tabpanel'
                                                            aria-labelledby='list-tab4' tabindex='0'>
                                                            <div class='col-sm-12'>
                                                                <p>
                                                                    - Nếu quý khách huỷ vé sau khi mua chịu chi phí: 30%
                                                                    giá vé. <br />
                                                                    - Nếu quý khách huỷ trước ngày khởi hành 05 ngày
                                                                    chịu chi phí 50% giá vé. <br />
                                                                    - Nếu quý khách huỷ trước ngày khởi hành 03 ngày
                                                                    chịu chi phí 70% giá vé. <br />
                                                                    - Nếu quý khách huỷ trong vòng 24 giờ kể từ ngày
                                                                    khởi hành, chịu chi phí: 100% giá vé. <br />
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class='tab-pane fade' id='list-tab5-pane' role='tabpanel'
                                                            aria-labelledby='list-tab5' tabindex='0'>
                                                            <div class='col-sm-12'>
                                                                <p>
                                                                    - Thứ tự các điểm tham quan theo chương trình HDV có
                                                                    thể thay đổi tùy theo thời tiết vá các vấn đề khách
                                                                    quan khác mà vẫn đảm bảo đầy đủ các điểm tham quan.
                                                                    <br />
                                                                    - Do chương trình tour khách lẻ ghép đoàn nên khi
                                                                    không đủ số lượng khách để khởi hành thì công ty sẽ
                                                                    hỗ trợ khách dời sang ngày khởi hành gần nhất hoặc
                                                                    hoàn lại phí tour như đã đặt cọc. <br />
                                                                    - Thời gian trong chương trình tour là thời gian dự
                                                                    kiến, thực tế tour sẽ có chênh lệch (không nhiều) so
                                                                    với thời gian dự kiến. HDV sẽ báo trực tiếp cho
                                                                    Khách hàng trong thời gian thực hiện tour. <br />
                                                                    - Trong những trường hợp bất khả kháng như: khủng
                                                                    bố, bạo động, thiên tai, lũ lụt. dịch bệnh… Tuỳ theo
                                                                    tình hình thực tế và sự thuận tiện, an toàn của
                                                                    khách hàng, công ty sẽ chủ động thông báo cho khách
                                                                    hàng sự thay đổi như sau: huỷ hoặc thay thế bằng một
                                                                    chương trình mới với chi phí tương đương chương
                                                                    trình tham quan trước đó. Trong trường hợp chương
                                                                    trình mới có phát sinh thì Khách hàng sẽ thanh toán
                                                                    khoản phát sinh này. Tuy nhiên, mỗi bên có trách
                                                                    nhiệm cố gắng tối đa, giúp đỡ bên bị thiệt hại nhằm
                                                                    giảm thiểu các tổn thất gây ra vì lý do bất khả
                                                                    kháng.… <br />
                                                                    - Đối với sự thay đổi lịch trình, giờ bay do lỗi của
                                                                    hãng tàu thuỷ, công ty sẽ không chịu trách nhiệm bất
                                                                    kỳ phát sinh nào do lỗi trên như: phát sinh bữa ăn,
                                                                    nhà hàng, khách sạn, phương tiện di chuyển, hướng
                                                                    dẫn viên, …. <br />
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>";
                                       

                                    echo "</div>"; // đóng của div detail
                                echo "</div>"; // đóng của div container

                                    } else {
                                        echo "Không tìm thấy tour với ID này.";
                                    }
                                } else {
                                    echo "Chưa kết nối đến cơ sở dữ liệu";
                                }
                            } else {
                                echo "Không có ID tour được truyền vào";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <!-- Bootstrap JavaScript Libraries -->
    <script src="../bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script> -->

    <!-- để sử dụng tooltips -->
    <script>
        var tooltipTriggerList = [].slice.call(
            document.querySelectorAll('[data-bs-toggle="tooltip"]')
        );
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    </script>

</body>

</html>