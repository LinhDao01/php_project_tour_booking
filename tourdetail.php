<?php 
    session_start();
    include "connect.php";
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

                if($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo "<title>". $row['tName'] ."</title>";
                } else {
                    echo "tour không tồn tại!";
                }
                $stmt->close();            
                
            }
        } else {
            echo "Không nhận được id!";
        }

        
    ?>
    
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" /> -->
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <!-- css -->
    <link rel="stylesheet" href="css/tourdetail.css" />
    <!-- icon -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" /> -->
    <!-- fontawesome -->
    <script src="https://kit.fontawesome.com/1ee92f529b.js" crossorigin="anonymous"></script>
</head>

<body>
    <!-- modal BS5 -- hộp thoại xuất hiện khi bấm Liên hệ tư vấn -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-bold" id="staticBackdropLabel">
                        Yêu cầu tư vấn
                    </h1>
                    <br />
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="get">
                        <div class="mb-3">
                            <label for="name" class="form-label">Họ và tên</label>
                            <input type="text" class="form-control" id="name" name="name"/>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Điện thoại</label>
                            <input type="number" class="form-control" id="phone" name="phone"/>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email (nếu có)</label>
                            <input type="email" class="form-control" id="email" name="email"/>
                        </div>
                        <div class="mb-3">
                            <label for="note" class="form-label">Ghi chú (nếu có)</label>
                            <input type="text" class="form-control" id="note" name="note"/>
                        </div>
                        <input type="hidden" name="tourid" id="tourid" value="<?php echo $row['tID'];?>"> <!-- lấy idtour để truyền qua ajx -->
                    </form>
                </div>
                <div class="modal-footer">
                    
                    <button type="submit" class="btn btn-primary w-100" name="modal-btn" id="modal-btn">
                        Gửi yêu cầu
                        <div id="" class="form-text text-light">
                            Chúng tôi sẽ liên hệ sau ít phút
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>

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

    <main>
        <!-- đường dẫn -->
        <div class="container my-3">
            <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Tours</a></li>
                    <li class="breadcrumb-item">
                        <a href="tourlist.php">Tour Du lịch hành hương</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Chi tiết tour
                    </li>
                </ol>
            </nav>
        </div>
        
        <?php 
            //lấy ID tour được truyền từ file index qua URL
            if (isset($_GET['id'])) {
                $tourId = $_GET['id'];
            
                if (isset($conn)) {
                    $stmt = $conn->prepare("SELECT * FROM tours where tID = ?");
                    $stmt->bind_param("i", $tourId);
                    $stmt->execute();
                    $result = $stmt->get_result();
            
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $tourID = $row['tID'];
                        // Hiển thị thông tin chi tiết của tour
                        echo "<div class='container content'>
                            <div class='tour-name'>
                                <h1 class='fw-bold text-success'>" . $row['tName'] ."</h1> <!-- tên tour -->
                            </div>";

                            echo "<div class='col-lg-12 col-md-12 col-sm-12 detail'>";
                                echo "<div class='row'>";
                                    // <!-- side detail col-lg-8 -->
                                    echo "<div class='col-lg-8 col-md-8 col-sm-12 content-detail'>";
                                        // hình đầu trang
                                        echo "<div class='col-sm-12'>
                                                <div class='ol-sm-12 border border-success'>
                                                    <img src='pic/back4.jpg' alt='' class='pic' />
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
                                                        <h4 class='fw-bold text-success'>" . $row['tName'] ."</h4>
                                                    </div>
                                                    <div class='content'>
                                                        <p class='ms-3'>" . $row['tDesc'] // mô tả tour
                                                        . "</p>
                                                    </div>
                                                </div>
                                            </div>";
                                        //Mô tả lịch trình chi tiết
                                        echo "<div class='col-sm-12 border border-success my-2 introduce'>
                                                <div class='head ms-1'>
                                                    <h4 class='fw-bold text-success'>Lịch trình</h4>
                                                </div>";
                                                $stmt1 = $conn->prepare("SELECT ts.tsDay, ts.tsDesc 
                                                                        FROM tours t
                                                                        LEFT JOIN tour_schedule ts ON t.tID = ts.tID AND t.tID = ?
                                                                        WHERE ts.tsId IS NOT NULL
                                                                        ORDER BY ts.tsId ASC");
                                                $stmt1->bind_param("i", $tourId);
                                                $stmt1->execute();
                                                $result1 = $stmt1->get_result();
                                                if ($result1->num_rows > 0) {
                                                    // lịch trình (các nơi sẽ đi theo ngày)
                                                    while($row1 = $result1->fetch_assoc()){
                                                        echo "
                                                        <div class='content mx-3'>
                                                            <h6 class='fw-semibold'>". $row1['tsDay'] ." </h6>
                                                            <p>" . $row1['tsDesc'] ."</p>
                                                        </div>";
                                                    }
                                                } else {
                                                    echo "Hiện tại chưa cập nhật lịch trình. Vui lòng đợi chúng tôi sắp xếp!";
                                                }
                                        echo "</div>";
                                        //lịch khởi hành
                                        echo "<div class='col-sm-12 border border-success my-2 introduce'>
                                                <div class='head ms-1'>
                                                    <h4 class='fw-bold text-success'>Lịch khởi hành</h4>
                                                </div>
                                                <div class='content mx-3'>
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
                                                            
                                                            while ($row2 = $result->fetch_assoc()) {
                                                                echo "<tr>";
                                                                echo "<th>".  $row2['tStart'] . "</th>";
                                                                echo "<td>". $row2['tEnd'] ."</td>";
                                                                echo "<td>Liên hệ tư vấn</td>";
                                                                echo "<td>". $formattedAmount = number_format($row2['tPrice_al'], 0, ',', '.') ." VNĐ</td>";
                                                                echo "</tr>";
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
                                                                    echo "<p>". $row['tStay'] ."</p>";
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
                                            
                                        // Bình luận đánh giá của khách hàng          
                                        echo "<div class='col-sm-12 border border-success my-2 introduce'>
                                                <div class='head ms-1'>
                                                    <h4 class='fw-bold text-success'>Đánh giá của khách hàng</h4>
                                                </div>
                                                <div class='content'>";
                                                
                                            //kiểm tra người dùng đã đăng nhập chưa
                                            if (!empty($_SESSION)) {
                                                $uid = $_SESSION['id'];

                                                // kiểm tra xem người dùng đã đặt tour này hay chưa
                                                $check_booking = $conn->prepare("SELECT * FROM booking b
                                                                LEFT JOIN tour_date td ON b.tdID = td.tdId
                                                                LEFT JOIN tours t ON td.tID = t.tID
                                                                WHERE uID = ? AND t.tID = ?");
                                                $check_booking->bind_param("ii", $uid, $tourId);
                                                $check_booking->execute();
                                                $booking_result = $check_booking->get_result();

                                                if ($booking_result->num_rows > 0) {
                                                    // nếu có thì kiểm tra kiểm tra id của người đang đăng nhập trong bảng reivew để biết xem người dùng đã từng bình luận hay chưa
                                                    
                                                    $check = $conn->prepare("SELECT * FROM review where uID = ? AND tID = ?");
                                                    $check->bind_param("ii", $uid, $tourId);
                                                    $check->execute();
                                                    $recheck = $check->get_result();
                                                    
                                                    if ($recheck->num_rows == 0) {
                                                        // chưa đánh giá -> hiển thị form
                                                        echo "<form action='' method='post'>
                                                            <div class='container'>
                                                                <div class='row'>
                                                                    <div class='col-2'>". $_SESSION['username'] ."</div> <!-- thông tin người bình luận -->
                                                                    <div class='col-7'>
                                                                        <input type='hidden' name='id' value='". $_GET['id']."'>
                                                                        <textarea name='content' id='' cols='40px' rows='3'></textarea>
                                                                    </div>
                                                                    <div class='col-3'>
                                                                        <input type='submit' value='Gửi bình luận' name='sendcmt' class='btn btn-primary' > 
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                        </form>";
                                                    } 
                                                }
                                            }

                                                // kiểm tra có tồn tại nút sendcmt không và đã được bấm chưa
                                                if (isset($_POST['sendcmt'])&&($_POST['sendcmt'])) {
                                                    // lấy dữ liệu
                                                    $idtour = $_GET['id'];
                                                    $iduser = $_SESSION['id'];
                                                    $cmt = $_POST['content'];
                                                    // Lấy ngày hiện tại
                                                    $current_date = date("Y-m-d");
                                        
                                                    // xử lý dữ liệu
                                                    if (is_null($cmt)) {
                                                        echo "<script>alert('Vui lòng nhập bình luận của bạn trước khi bấm gửi!')</script>";
                                                        exit();
                                                    } else {
                                                        $rev = $conn->prepare("CALL ADD_REVIEW(?, ?, ?, ?)");
                                                        $rev->bind_param("iiss", $idtour, $iduser, $cmt, $current_date);
                                                        $rev->execute();
                                                        
                                                        if($rev->affected_rows > 0) {
                                                            echo "<script>alert('Bạn đã thêm bình luận thành công!');</script>";
                                                            $point = $conn->prepare("UPDATE users SET uPoint = uPoint + 2 WHERE uID = ?");
                                                            $point->bind_param("i", $_SESSION['id']);
                                                            $point->execute();
                                                            
                                                        } else {
                                                            echo "<script>alert('!done');</script>";
                                                        }
                                                    }
                                                }

                                                    // hiển thị bình luận
                                                    $stmt1 = $conn->prepare("SELECT * FROM review r 
                                                                            LEFT JOIN users u ON r.uID = u.uID
                                                                            Where tID = ?");
                                                    $stmt1->bind_param("i", $_GET['id']);
                                                    $stmt1->execute();
                                                    $result1 = $stmt1->get_result();
                                                    if ($result1->num_rows > 0) {
                                                        while ($row1 = $result1->fetch_assoc()) {
                                                            // Lấy ngày bình luận từ cơ sở dữ liệu
                                                            $comment= $row1['rDate']; // giả sử trường lưu ngày bình luận là 'comment_date'
                                                            // Định dạng ngày bình luận
                                                            $formatted_date = date("d/m/Y", strtotime($comment));
                                                            echo "<hr>";

                                                            echo " <div class='container'>
                                                                <div class='row'>
                                                                    <div class='col-2'>". $row1['uName']."</div>    
                                                                    <div class='col-8'>". $row1['rContent'] ."</div>
                                                                    <div class='col-2'>".  $formatted_date ."</div>
                                                                </div>
                                                            </div>";
                                                        }
                                                    } else {
                                                        echo "Chưa có bình luận cho tour này!";
                                                    }
                                            
                                                echo "</div>";
                                            echo "</div>";
                                    echo "</div>"; // đóng của div col-lg-8
                                    
                        // <!-- side booking bar-->
                                    echo "<div class='col-lg-4 col-md-4 col-sm-12 booking '>";
                                        echo "<div class='col-12 border border-success rounded py-2 sticky-top'>";
                                            echo "<div class='row px-2'>
                                            <form method='get' action='booking.php'>"; 
                                                $stmt3 = $conn->prepare("SELECT t.*, td.* FROM tours t 
                                                        LEFT JOIN tour_date td ON t.tID = td.tID
                                                        WHERE t.tID = ? AND td.tStart = (
                                                                        SELECT MIN(tStart) 
                                                                        FROM tour_date 
                                                                        WHERE tID = ? AND tStart > CURDATE()
                                                                    )");
                                                $stmt3->bind_param("ii", $tourID, $tourID);
                                                $stmt3->execute();
                                                $result3 = $stmt3->get_result();
                                                if ($result3->num_rows > 0) {
                                                    while ($row3 = $result3->fetch_assoc()) {
                                                echo "<div class='col-sm-12 heading'>
                                                        <div class='col-sm-12 fw-bold text-success'>
                                                            Ngày khởi hành: <span>". $row3['tStart'] ."</span>
                                                        </div>
                                                        <div class='col-sm-12 text'>Chọn vé và xem giá</div>
                                                        <hr />
                                                    </div>";
                                                    }
                                                }
                                                echo "<div class='col-sm-12 text-detail'>
                                                        <div class='col-sm-12 px-2'>
                                                        
                                                            <div class='row my-2 border border-secondary rounded price-detail'>
                                                                <div class='col-4 text-detail'>
                                                                    <span class=''>Người lớn</span>
                                                                    <br />
                                                                    <span class='text-muted'>> 9 tuổi</span>
                                                                </div>
                                                                <div class='col-4 price mt-2'> <span id='price_al'>x <span id='price1'>".  $row['tPrice_al'] ."</span></span></div>
                                                                <div class='col-4 button-group d-flex'>
                                                                    <a class='btn text-dark p-2' onclick='decrementQuantity_al()'>
                                                                        <i class='fas fa-minus'></i>
                                                                    </a>
                                                                        <input class='fw-bold text-black w-75 text-center in-quantity' min='1' max='10'
                                                                            name='quantity_al' value='2' type='number' id='quantity-al' readonly />
                                                                    <a class='btn text-dark p-2' onclick='incrementQuantity_al()'>
                                                                        <i class='fas fa-plus'></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                    
                                                            <div class='row my-2 border border-secondary rounded price-detail'>
                                                                <div class='col-4 text-detail '>
                                                                    <span class=''>Trẻ em</span>
                                                                    <br />
                                                                    <span class='text-muted'> 5 - 9 tuổi</span>
                                                                </div>
                                                                <div class='col-4 price d-flex mt-2' > <span id='price_kid'> x <span id='price2'>". $row['tPrice_kid'] ."</span></span></div>
                                                                <div class='col-4 button-group d-flex'>
                                                                    <a class='btn text-dark p-2' onclick='decrementQuantity_kid()'>
                                                                        <i class='fas fa-minus'></i>
                                                                    </a>
                                                                        <input class='fw-bold text-black w-75 text-center in-quantity' min='0' max='10'
                                                                            name='quantity_kid' value='0' type='number' id='quantity-kid' readonly />
                                                                    <a class='btn text-dark p-2' onclick='incrementQuantity_kid()'>
                                                                        <i class='fas fa-plus'></i>
                                                                    </a>
                                                                </div>
                                                            </div> 
                    
                                                            <div class='row my-2 border border-secondary rounded price-detail'>
                                                                <div class='col-4 text-detail'>
                                                                    <span class=''>Trẻ nhỏ</span>
                                                                    <br />
                                                                    <span class='text-muted'>
                                                                        < 5 tuổi</span>
                                                                </div>
                                                                <div class='col-4 price d-flex mt-2'><span id='price_child'>x <span id='price3'> " . $row['tPrice_child'] . "</span></span></div>
                                                                <div class='col-4 button-group d-flex'>
                                                                    <a class='btn text-dark p-2' onclick='decrementQuantity_child()'>
                                                                    <i class='fas fa-minus'></i>
                                                                    </a>
                                                                        <input class='fw-bold text-black w-75 text-center in-quantity' min='0' max='10'
                                                                            name='quantity_child' value='0' type='number' id='quantity-child' readonly />
                                                                    <a class='btn text-dark p-2' onclick='incrementQuantity_child()'>
                                                                        <i class='fas fa-plus'></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                    
                                                    <span class='my-2'><i class='fas fa-exclamation-circle'></i> Liên hệ để xác nhận chỗ</span>";
                    
                                                echo "<div class='row mt-4'>
                                                        <div class='col-6 text-end fs-5 fw-bold price hidden'>
                                                            <span id=''></span>300.000 <span class='fs-6 fw-light'>vnd</span>
                                                        </div>
                                                        <div class='col-5'>Tổng giá vé</div>
                                                        <div class='col-7 text-end fs-5 fw-bold price'>
                                                            <span id='price_total'></span> <span class='fs-6 fw-light'>vnd</span>
                                                        </div>
                                                    </div>";
                                                echo "<div class='row ms-1 mt-3'>
                                                        <div class='col-6'>
                                                            <button type='button' class='btn btn-outline-warning p-2' data-bs-toggle='modal'
                                                                data-bs-target='#staticBackdrop'>
                                                                Liên hệ tư vấn
                                                            </button>
                                                        </div>
                                                        <div class='col-6'>";
                                                            if (!empty($_SESSION)) {
                                                                echo "<button class='btn bg-warning p-2' type='submit'>Đặt Tour ngay</button>";
                                                            } else {
                                                                echo "Bạn phải đăng nhập mới được đặt tour!";
                                                            }
                                                         echo "<input name='id' value='". $row["tID"] ."' hidden> <!-- truyền ID cho trang đc bấm gửi -->
                                                        </div>
                                                    </div>
                                                </form>";

                                                echo "</div>"; // đóng div của row
                                            echo "</div>"; //đóng div của col-12
                                        echo "</div>"; // đóng của div col-lg-4

                                echo "</div>"; // đóng của div row
                            echo "</div>"; // đóng của div detail
                        echo "</div>";// đóng của div container

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

        
    </main>

    <footer>
        <section class="footer">
            <div class="container-fluid text-dark bg-body-secondary">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <h5 class="">Liên hệ</h5>
                            <ul class="footpanel">
                                <li><b>Địa chỉ: </b> ...</li>
                                <li><b>Số điện thoại: </b> ...</li>
                                <li><b>Email:</b> ...</li>
                                <li><b>Giờ làm việc:</b> 8h - 20h</li>
                            </ul>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 mx-5">
                            <ul class="footpanel">
                                <h5>Kết nối với chúng tôi qua</h5>
                                <li class="decor">
                                    <a href="#facebook" class="me-2"><i class="fab fa-facebook"
                                            style="color: #50bd60; font-size: 28px"></i></a>
                                    <a href="#instagram" class="me-2"><i class="bi bi-instagram"
                                            style="color: #50bd60; font-size: 28px"></i></a>
                                    <a href="#tiktok"><i class="bi bi-tiktok"
                                            style="color: #50bd60; font-size: 28px"></i></a>
                                </li>
                            </ul>
                            <ul class="footpanel">
                                <h5>Chấp nhận thanh toán</h5>
                                <img src="pic/vnpay-logo.jpg" alt="VNPAY" />
                            </ul>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <h5>Sản phẩm hiện tại</h5>
                            <ul class="footpanel">
                                <li><a href="/index.html" class="text-dark">Tours</a></li>
                                <li><a href="#ticket" class="text-dark">Vé tham quan</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </footer>


    <!-- Bootstrap JavaScript Libraries -->
    <script src="bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>

    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script> -->
    
        <!-- để sử dụng tooltips -->
    <script>
        var tooltipTriggerList = [].slice.call(
            document.querySelectorAll('[data-bs-toggle="tooltip"]')
        );
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    </script>


    <script>
        window.addEventListener('load', function() {
            var quantityInput = document.getElementById("quantity-al");
            var currentValue = parseInt(quantityInput.value); 
           document.getElementById("price_kid").style.display = "none";
           document.getElementById("price_child").style.display = "none";
           var hiddenElements = document.getElementsByClassName("hidden");

            // Lặp qua tất cả các phần tử và ẩn chúng
            for (var i = 0; i < hiddenElements.length; i++) {
            hiddenElements[i].style.display = "none";
            }
          
           var priceElement = document.getElementById("price1");
           var priceText = priceElement.textContent;
           var text = document.getElementById("price_total");
           text.innerText = parseInt(priceText) * currentValue;

            console.log(priceText);
       });

        // tăng giảm số vé của hàng người lớn
        function incrementQuantity_al() {
            var quantityInput = document.getElementById("quantity-al");
            var currentValue = parseInt(quantityInput.value); 
            var maxQuantity = parseInt(quantityInput.getAttribute("max"));
            var text = document.getElementById("price_total").textContent;
            var temp = document.getElementById("price1").textContent;

            if (currentValue + 1 <= maxQuantity) {

                quantityInput.value = currentValue + 1;
                var total = parseInt(temp) + parseInt(text);

                console.log(total);
                document.getElementById("price_total").innerText = total;

                
            } 
            }

            function decrementQuantity_al() {
            var quantityInput = document.getElementById("quantity-al");
            var newValue = parseInt(quantityInput.value) - 1;
            // quantityInput.value = newValue >= 1 ? newValue : 1;
            if (newValue >=1) {
                quantityInput.value = newValue;
                var text = document.getElementById("price_total").textContent;
                var temp = document.getElementById("price1").textContent;
                var total = parseInt(text) - parseInt(temp); 
                document.getElementById("price_total").innerText = total;
                

            } else {
                quantityInput.value = 1;
            }
            
            }
            // tăng giảm số vé trẻ em
            function incrementQuantity_kid() {
            
            var quantityInput = document.getElementById("quantity-kid");
            var currentValue = parseInt(quantityInput.value);
            var maxQuantity = parseInt(quantityInput.getAttribute("max"));
            var text = document.getElementById("price_total").textContent;
            var temp = document.getElementById("price2").textContent;

            if (currentValue + 1 <= maxQuantity) {
                quantityInput.value = currentValue + 1;
                if (currentValue + 1 > 0) {
                    document.getElementById("price_kid").style.display = "block";

                    var total = parseInt(temp) + parseInt(text);
                    console.log(total);
                    document.getElementById("price_total").innerText = total;
                }
            }
            }

            function decrementQuantity_kid() {
            var quantityInput = document.getElementById("quantity-kid");
            var newValue = parseInt(quantityInput.value) - 1;
            if (newValue >0) {
                quantityInput.value = newValue;
                var text = document.getElementById("price_total").textContent;
                var temp = document.getElementById("price2").textContent;
                var total = parseInt(text) - parseInt(temp); 
                document.getElementById("price_total").innerText = total;
            } else {
                document.getElementById("price_kid").style.display = "none";
                if (newValue == 0) {
                    
                    quantityInput.value = 0;
                    var text = document.getElementById("price_total").textContent;
                    var temp = document.getElementById("price2").textContent;
                    var total = parseInt(text) - parseInt(temp); 
                    document.getElementById("price_total").innerText = total;
                }
                
            }
                
            }
            // tăng giảm số vé của hàng trẻ em
            function incrementQuantity_child() {
            var quantityInput = document.getElementById("quantity-child");
            var currentValue = parseInt(quantityInput.value);
            var maxQuantity = parseInt(quantityInput.getAttribute("max"));
            var text = document.getElementById("price_total").textContent;
            var temp = document.getElementById("price3").textContent;

            if (currentValue + 1 <= maxQuantity) {
                quantityInput.value = currentValue + 1;
                if (currentValue + 1 > 0) {
                    document.getElementById("price_child").style.display = "block";

                    var total = parseInt(temp) + parseInt(text);
                    console.log(total);
                    document.getElementById("price_total").innerText = total;
                }
            }
            }

            function decrementQuantity_child() {
            var quantityInput = document.getElementById("quantity-child");
            var newValue = parseInt(quantityInput.value) - 1;
            if (newValue >0) {
                quantityInput.value = newValue;
                var text = document.getElementById("price_total").textContent;
                var temp = document.getElementById("price3").textContent;
                var total = parseInt(text) - parseInt(temp); 
                document.getElementById("price_total").innerText = total;
            } else {
                document.getElementById("price_child").style.display = "none";
                if (newValue == 0) {
                    
                    quantityInput.value = 0;
                    var text = document.getElementById("price_total").textContent;
                    var temp = document.getElementById("price3").textContent;
                    var total = parseInt(text) - parseInt(temp); 
                    document.getElementById("price_total").innerText = total;
                }
                
            }
            }

    </script>
    <!-- sau khi bấm nút submit modal form -->
    <script>
        document.getElementById("modal-btn").addEventListener("click", function() {
            var name = document.getElementById("name").value;
            var phone = document.getElementById("phone").value;
            var email = document.getElementById("email").value;
            var note = document.getElementById("note").value;
            var tourid = document.getElementById("tourid").value;

            // Khởi tạo đối tượng XMLHttpRequest
            const xhr = new XMLHttpRequest();

            // Open a new request
            xhr.open('GET', 'http://localhost/php_project/api/advise-form.php?name=' + name + '&phone=' + phone + '&email=' + email + '&note=' + note + '&tourid=' + tourid);

            xhr.onload = function() {
                if (xhr.status === 200) {
                    console.log(xhr.responseText);

                }
            };

            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        alert('Bạn đã gửi yêu cầu thành công. Vui lòng đợi chờ, chúng tôi sẽ gọi đến bạn nhanh nhất có thể.');
                        // Tìm modal và đóng nó
                        var modal = document.querySelector('.modal');
                        if (modal) {
                            var modalInstance = bootstrap.Modal.getInstance(modal);
                            modalInstance.hide();
                        }
                    } else {
                        alert('Đã xảy ra lỗi: ' + xhr.statusText);
                    }
                }
            };
            xhr.send();

        })
    </script>

</body>

</html>