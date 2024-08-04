<?php 
    session_start();
    include "connect.php";
?>

<!doctype html>
<html lang="en">

<head>
<?php 
        if (isset($_GET['id'])) {
            $tourID = $_GET['id'];
            $tPrice_al = $_GET['quantity_al'];
            $tPrice_kid = $_GET['quantity_kid'];
            $tPrice_child = $_GET['quantity_child'];
            $uid = $_SESSION['id'];

            if (isset($conn)) {
                //dùng để hiển thị tên tour trên tilte của trang
                $stmt = $conn->prepare("SELECT tName FROM tours where tID = ?");
                $stmt->bind_param("s", $tourID);
                $stmt->execute();
                $result = $stmt->get_result();

                if($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo "<title>Đặt ". $row['tName'] ."</title>";
                } else {
                    echo "tour không tồn tại!";
                }

                // sau khi người dùng bấm nút "Xác nhận tiếp tục", hệ thống sẽ lưu dữ liệu đã nhập vào database bảng booking
                if (isset($_POST['btn_cont_clicked'])&&($_POST['btn_cont_clicked']) == "1") {
                    $tdID = $_POST['tdID'];
                    $namecus = $_POST['add-name'];
                    $email = $_POST['add-email'];
                    $phone = $_POST['add-phone'];
                    $note = $_POST['add-note'];
                    $adult_ticket = $_POST['check-p1'];
                    $kid_ticket = $_POST['check-p2'];
                    $child_ticket = $_POST['check-p3'];
                    $total_ticket = $_POST['check-pt'];
                    $voucher = 1;
                    $cost = $_POST['price-tt'];
                    $status = 0;


                    $stmt1 = $conn->prepare("CALL BOOKING_TOUR(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    $stmt1->bind_param("iisssiiiisdb", $uid, $tdID, $namecus, $email, $phone, $note, $total_ticket, $adult_ticket, $kid_ticket, $child_ticket, $cost, $status);
                    $stmt1->execute();

                    if ($stmt->errno) {
                        echo "Lỗi: " . $stmt->error;
                        exit();
                    } else {
                        echo "<script>alert('Thêm booking thành công');</script> ";
                        header("Location: checking.php?id=$tdID");
                        
                    }
                }
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
    <!-- css -->
    <link rel="stylesheet" href="css/booking.css">
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
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
                                        <a class="nav-link active text-black fs-5"
                                            href="index.php">Tours</a>
                                    </li>
                                   
                                    <li class="nav-item">
                                        <a class="nav-link text-black fs-5" 
                                        href="introduce.php">Giới thiệu</a>
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
                    <li class="breadcrumb-item active" aria-current="page">
                        Đặt tour
                    </li>
                </ol>
            </nav>
        </div>
    <?php          
        //lấy ID tour được truyền từ ...
        if (isset($_GET['id'])) {
            $tourId = $_GET['id'];
        
            if (isset($conn)) {
                $stmt = $conn->prepare("SELECT t.*, td.* FROM tours t 
                                        LEFT JOIN tour_date td ON t.tID = td.tID
                                        WHERE t.tID = ? AND td.tStart = (
                                                        SELECT MIN(tStart) 
                                                        FROM tour_date 
                                                        WHERE tID = ? AND tStart > CURDATE()
                                                    )");
                $stmt->bind_param("ii", $tourID, $tourID);
                $stmt->execute();
                $result = $stmt->get_result();
        
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();               
        echo "<div class='container my-4'>";
            echo "<div class='col-lg-12 col-md-12 col-sm-12 tour-detail'>";
                echo "<div class='row'>";
                    echo "<div class='col-4 pic'>
                            <img src='pic/back4.jpg' alt='' class='w-100 h-100'>
                        </div>
                        <div class='col-8 detail'>
                            <div class='col-12 border border-secondary'>
                                <div class='header text-center '>
                                    <h4 class='text-success'>". $row['tName'] . "</h4>
                                </div>
                                <hr>
                                <div class='list-info '>
                                    <div class='col-12'>
                                        <div class='row mb-3'>
                                            <div class='col-3 ms-2'>
                                                <div class=''>Mã tour: </div>
                                                <div class=''>Thời gian tour: </div>
                                                <div class=''>Tổng giá tiền: </div>
                                                <div class=''>Ngày khởi hành: </div>
                                                <div class=''>Nơi khởi hành: </div>
                                            </div>
                                            <div class='col-7 fw-semibold'>
                                                <div class=''>". $row['tID'] ." </div>
                                                <div class=''>". $row['tDay'] ." </div>
                                                <div class='' ><span id='price' name='price_total'></span> vnd</div> <!-- tính trong trang = JS -->
                                                <div class=''>" .$row['tStart']."</div> 
                                                <div class=''>". $row['tPlace'] ."</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <hr>

            <div class='tour-price'>
                <div class='header text-center'>
                    <h3><i class='fa-solid fa-tags'></i> BẢNG GIÁ TOUR CHI TIẾT</h3>
                </div>
                <div class='tour-price-detail'>
                    <table class='table table-bordered'>
                        <thead>
                            <tr>
                                <th scope='col'>Giá \ Độ tuổi</th>
                                <th scope='col'>Người lớn (> 9 tuổi)</th>
                                <th scope='col'>Trẻ em (5 - 9 tuổi)</th>
                                <th scope='col'>Trẻ nhỏ (< 5 tuổi)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope='row'>Giá</th>
                                <td > <span id='price-al' name='price-al'>". $row['tPrice_al'] ."</span> đ</td>
                                <td > <span id='price-kid' name='price-kid'>". $row['tPrice_kid'] ."</span> đ</td>
                                <td > <span id='price-child' name='price-child'>". $row['tPrice_child'] ."</span> đ</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        <form method='post' action=''>
            <input id='hidden-price' value='' hidden name='price-tt'> <!-- total price -->
            <input value='" .$row['tdID']."' hidden name='tdID'>
            <input value='" .$row['tName']."' hidden name='tname'>

            <div class='tour-info'>
                <div class='header text-center mb-4'>
                    <h3><i class='fa-solid fa-circle-info'></i> THÔNG TIN LIÊN HỆ</h3>
                </div>
                <div class='tour-info-content'>";
                // đổ thông tin của user lên     
                $stmt2 = $conn->prepare("SELECT * FROM users where uID = ?");
                $stmt2->bind_param("i", $uid);
                $stmt2->execute();
                $result2 = $stmt2->get_result();
                $row2 = $result2->fetch_assoc();
                
                        echo "<div class='row'>
                            <div class='col-4'>
                                <div class='px-2'>
                                    <label for='Name' class='form-label'>Họ và tên</label>
                                    <input type='text' class='form-control' id='Name' name='add-name' value='". $row2['uName'] ."'>
                                </div>
                            </div>
                            <div class='col-4'>
                                <div class='px-2'>
                                    <label for='email' class='form-label'>Email</label>
                                    <input type='email' class='form-control' id='email' name='add-email' value='". $row2['uEmail'] ."'>
                                </div>
                            </div>
                            <div class='col-4'>
                                <div class='px-2'>
                                    <label for='Phone' class='form-label'>Số điện thoại</label>
                                    <input type='number' class='form-control' id='Phone' name='add-phone' maxlength='10' value='". $row2['uPhone'] ."'>
                                </div>
                            </div>
                            <div class='col-8'>
                                <div class='px-2'>
                                    <label for='Note' class='form-label'>Ghi chú</label>
                                    <input type='text' class='form-control' id='Note' name='add-note'>
                                </div>
                            </div>
                            <p class='fs-4 fw-semibold mt-3 ms-2'>Xác nhận số lượng vé</p>
                            <div class='row'>
                                
                                <div class='col-3'>
                                    <div class='px-2'>
                                        <label for='aldult' class='form-label'>Người lớn (> 9 tuổi)</label>
                                        <input type='number' class='form-control' id='adult' value='".$tPrice_al."' readonly name='check-p1'>
                                    </div>
                                </div>
                                <div class='col-3'>
                                    <div class='px-2'>
                                        <label for='kids' class='form-label'>Trẻ em (5 - 9 tuổi)</label>
                                        <input type='number' class='form-control' id='kids' value='".$tPrice_kid."' readonly name='check-p2'>
                                    </div>
                                </div>
                                <div class='col-3'>
                                    <div class='px-2'>
                                        <label for='child' class='form-label'>Trẻ nhỏ (< 5 tuổi)</label>
                                        <input type='number' class='form-control' id='child' value='".$tPrice_child."' readonly name='check-p3'>
                                    </div>
                                </div>
                                <div class='col-3'>
                                    <div class='px-2'>
                                        <label for='totalticket' class='form-label'>Tổng số vé đặt</label>
                                        <input type='number' class='form-control' id='totalticket' readonly name='check-pt'>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                   
                </div>
                <div class='add-voucher'>
                    <div class='row'>
                        <div class='col-8'></div>
                        <div class='col-4'>
                            <form action='' class=''>
                                <label for='Voucher' class='mt-2'>Nhập mã voucher bạn có</label>
                                <div class='input-group mb-3 mt-2 '>
                                    <input type='text' class='form-control' placeholder='Voucher' id='Voucher' name='voucher'
                                        aria-label='Recipient's username' aria-describedby='button-addon2'>
                                    <button class='btn btn-outline-secondary' type='submit' id='button-addon2'>
                                    Sử dụng</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <hr>";

                echo "<div class='payment'>
                    <div class='header text-center'>
                        <h3><i class='fa-solid fa-wallet'></i> PHƯƠNG THỨC THANH TOÁN</h3>
                    </div>
                    <div class='pay'>
                        <div class='text'>
                            <p>Chúng tôi <strong>chỉ chấp nhận thanh toán qua ví VNPay</strong> để đảm bảo tính chính xác và
                                độ tin cậy trong quá trình đặt tour.
                                <br>
                                Sau khi hoàn tất thanh toán, <strong>vui lòng chụp lại màn hình đã thanh toán</strong> và
                                đợi trong vòng 1 ngày để nhân viên liên hệ đến để xác nhận với bạn. <br>
                                Nếu đã quá 1 ngày mà chưa nhận được cuộc gọi xác nhận, vui lòng liên hệ qua số
                                <strong>hotline: 19009900</strong> để phản hồi về vấn đề bạn gặp. <br>
                                <a href='introduce.php' class='condition' target='_blank'><i class='fa-solid fa-circle-info'></i>
                                    Tham khảo thêm về điều khoản, điều kiện phí thanh toán tại đây.</a>
                        </div>";

                        echo "<div class='text-center'>
                            <p class=''>Bằng việc tiếp tục, bạn chấp nhận đồng ý với chính sách/điều khoản như trên.</p>
                            <input type='hidden' id='btn_cont_clicked' name='btn_cont_clicked' value='0'> <!-- trạng thái khi nút chưa được click-->
                            <button class='btn btn-outline-secondary' id='btn-cont' name='btn-cont'>Xác nhận tiếp tục</button>
                            <input name='tID' value='". $row["tID"] ."' hidden>
                        </div>";
                    
                    echo "</div>"; //đóng div của pay
                echo "</div>  <!-- // đóng div của payment -->
                </form>
            </div>";
               
                
        echo "</div>"; // đóng div của container    
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
                                <li><a href="index.php" class="text-dark">Tours</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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
        window.addEventListener('load', function() {
            var totalTicket = document.getElementById("totalticket");
            var alTicket = document.getElementById("adult").value;
            var kidTicket = document.getElementById("kids").value;
            var childTicket = document.getElementById("child").value;
            var hidden_price = document.getElementById("hidden-price");

            var total =parseInt(alTicket) +parseInt(kidTicket) +parseInt(childTicket);
            totalTicket.value =total;

            var price_al = document.getElementById("price-al").textContent;
            var price_kid = document.getElementById("price-kid").textContent;
            var price_child = document.getElementById("price-child").textContent;


            var cal = (parseInt(alTicket)*parseInt(price_al)) + (parseInt(kidTicket)*parseInt(price_kid)) +(parseInt(childTicket)*parseInt(price_child));
            document.getElementById("price").innerText = cal;
            hidden_price.value = cal;
        })

    </script>    

    <script>
        document.getElementById("btn-cont").addEventListener("click", function(){
            // Khi nút được nhấn, gán giá trị 1 cho input hidden
            document.getElementById("btn_cont_clicked").value = "1";
        })

    </script>
</body>

</html>