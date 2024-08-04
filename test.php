<?php 
    session_start();
    ob_start();

    include "connect.php";

    if(isset($conn)) {
        // $stmt = $conn->prepare("SELECT * FROM SELECT * FROM tours t left join tour_date td
        //                         on t.tID = td.tID ");
        // $stmt->execute();
        // $result = $stmt->get_result();

        // $priceGroups = [];
        // if ($result->num_rows > 0) {
        //     while($row = $result->fetch_assoc()) {
        //         $priceGroups[] = [
        //             'price_al' => $row['tPrice_al'],
        //             'price_kid' => $row['tPrice_kid'],
        //             'price_child' => $row['tPrice_child'],
        //             'quantity' => 0, // Khởi tạo số lượng ban đầu là 0
        //             'min' => 0 // Khởi tạo giá trị nhỏ nhất là 0
        //         ];
        //     }
        // }

        // Đóng kết nối
        $conn->close();

        
        
    }



    // if((isset($_POST['dangnhap']))&&($_POST['dangnhap'])) {
    //     $email = $_POST['email'];
    //     $pass = $_POST['pass'];

    //     // Prepare the query
    //     $stmt = $conn->prepare("SELECT * FROM users WHERE uEmail = ? AND uPass = ?");

    //     // Bind (liên kết) parameters to the query
    //     $stmt->bind_param("ss", $email, $pass);
    //     //Execute this query
    //     $stmt->execute();
    //     // Get result
    //     $result = $stmt->get_result(); 
    //     $row = $result->fetch_assoc();

    
    // }




    // bản cũ của kiểm tra role khi đăng nhập
    // if ($result->num_rows == 1) {
    //     // User exists, check role
    //     $row = $result->fetch_assoc();
    //     if ($row['uRole'] == 0) {
    //         $_SESSION["username"] = $row['uName'];
    //         $_SESSION["img"] = $row['uImg'];
    //         $_SESSION["email"] = $email;
    //         header("Location: user/profile.php");
    //         exit();
    //     } elseif ($row['uRole'] == 2){
    //         $_SESSION["username"] = $row['uName'];
    //         $_SESSION["img"] = $row['uImg'];
    //         $_SESSION["email"] = $email;
    //         header("Location: staff/info.php");
    //         exit();
    //     } elseif ($row['uRole'] == 1) {
    //         $_SESSION["username"] = $row['uName'];
    //         $_SESSION["img"] = $row['uImg'];
    //         $_SESSION["email"] = $email;
    //         header("Location: admin/home.php");
    //         exit();
    //     } else {
    //         echo "User does not exist!";
    //     }

    // } else {
    //     // User doesn't exist or credentials are incorrect, redirect back to the login page
    //     header("Location: login.php");
    //     exit();
    // }
    //thực hiện các câu lệnh truy vấn 

    // $stmt = $conn->prepare("SELECT * FROM users");

    // $stmt->execute();

    // $result = $stmt->get_result();

    // if ($result->num_rows > 0) {
    //     // Đọc dữ liệu từng hàng
    //     while($row = $result->fetch_array()) {
    //         // In các giá trị của các cột
    //         echo "ID: " . $row["uID"]. " - Name: " . $row["uName"]. " - Email: " . $row["uEmail"]. "<br>";
    //     }
    // } else {
    //     echo "Không có dữ liệu trong bảng users";
    // }

        // $email = 'hehe@gmail.com';

        // Kiểm tra nếu session tồn tại
        // if (isset($_SESSION['username'])) {
        //     // Lấy thông tin người dùng từ session
        //     $username = $_SESSION['username'];
        //     $email = $_SESSION['email'];
        //     $img = $_SESSION['img'];
        //     $id = $_SESSION['id'];
        //     $phone = $_SESSION["phone"];
        //     echo "username: " . $username;
        //     echo "<br> email: " . $email;
        //     echo "<br> img: " . $img;
        //     echo "<br> id: " . $id;
        //     echo "<br> phone: " . $phone;
        // } else {
        //     echo "không tồn tại";
        // }

        // $stmt = $conn->prepare("SELECT * FROM users where $email = ");

        // $stmt->execute();
        // $result = $stmt->get_result();

        // if ($result->num_rows > 0) {
        //     while($row = $result->fetch_assoc()) {
        //         echo "ID: " . $row["uID"] . " <br> Name: "
        //         . $row["uName"]. " <br> Phone: " . $row["uPhone"]. "<br>";
        //         }
        // } else {
        //         echo "No student found";
        //         }
        
        
        
        // $email = $_SESSION['email'];

        // $stmt = $conn->prepare("SELECT * FROM users where uEmail = '$email'");
        // $stmt->execute();
        // $result = $stmt->get_result();

        // if ( $result->num_rows > 0) {
        //     while($row = $result->fetch_array()) {
        //         // gán các giá trị của các cột
        //         $name = $row["uName"];
        //         $email = $row["uEmail"];
        //         $phone = $row["uPhone"];

        //         echo "ID: " . $row["uID"]. " - Name: " . $row["uName"]. " - Email: " . $row["uEmail"]. "<br>";
        //     }
        // } else {
        //     echo "Không có dữ liệu trong bảng users";
        // }

        // $conn->close();
        




// echo "<div class='col-sm-12 text-detail'>
//         <div class='col-sm-12 px-2'>
//             <div class='row my-2 border border-secondary rounded price-detail'>
//                 <div class='col-4 text-detail'>
//                     <span class=''>Người lớn</span>
//                     <br />
//                     <span class='text-muted'>> 9 tuổi</span>
//                 </div>
//                 <div class='col-4 price mt-2'>x 2.700.000</div>
//                 <div class='col-4 button-group d-flex'>
//                     <button
//                         onclick='this.parentNode.querySelector('input[type=number]').stepDown()'
//                         class='btn text-dark p-2'>
//                         <i class='fas fa-minus'></i>
//                     </button>
//                     <input class='quantity fw-bold text-black w-75' min='1' name='quantity'
//                         value='4' type='number' readonly />
//                     <button
//                         onclick='this.parentNode.querySelector('input[type=number]').stepUp()'
//                         class='btn text-dark p-2'>
//                         <i class='fas fa-plus'></i>
//                     </button>
//                 </div>
//             </div>

//             <div class='row my-2 border border-secondary rounded price-detail'>
//                 <div class='col-4 text-detail '>
//                     <span class=''>Trẻ em</span>
//                     <br />
//                     <span class='text-muted'> 5 - 9 tuổi</span>
//                 </div>
//                 <div class='col-4 price d-flex mt-2'>x 2.700.000</div>
//                 <div class='col-4 button-group d-flex'>
//                     <button 
//                         onclick='this.parentNode.querySelector('input[type=number]').stepDown()'
//                         class='btn text-dark p-2'>
//                         <i class='fas fa-minus'></i>
//                     </button>
//                     <input class='quantity fw-bold text-black w-75 text-center' min='0'
//                         name='quantity' value='0' type='number' readonly />
//                     <button
//                         onclick='this.parentNode.querySelector('input[type=number]').stepUp()'
//                         class='btn text-dark p-2'>
//                         <i class='fas fa-plus'></i>
//                     </button>
//                 </div>
//             </div> 

//             <div class='row my-2 border border-secondary rounded price-detail'>
//                 <div class='col-4 text-detail'>
//                     <span class=''>Trẻ nhỏ</span>
//                     <br />
//                     <span class='text-muted'>
//                         < 5 tuổi</span>
//                 </div>
//                 <div class='col-4 price d-flex mt-2'>x 2.700.000</div>
//                 <div class='col-4 button-group d-flex'>
//                     <button
//                         onclick='this.parentNode.querySelector('input[type=number]').stepDown()'
//                         class='btn text-dark p-2'>
//                         <i class='fas fa-minus'></i>
//                     </button>
//                     <input class='quantity fw-bold text-black w-75 text-center' min='0'
//                         name='quantity' value='0' type='number' readonly />
//                     <button
//                         onclick='this.parentNode.querySelector('input[type=number]').stepUp()'
//                         class='btn text-dark p-2'>
//                         <i class='fas fa-plus'></i>
//                     </button>
//                 </div>
//             </div>
//         </div>
//     </div>

//     <span class='my-2'><i class='fas fa-exclamation-circle'></i> Liên hệ để xác
//         nhận chỗ</span>";

?>

<html>
<head>
<script src="https://kit.fontawesome.com/1ee92f529b.js" crossorigin="anonymous"></script>
</head>

<?php
    if ((isset($_POST['btn-pay']))&&($_POST['btn-pay'])) {
                $uid = $_SESSION['id'];
                $tdid = $_POST['id1'];
                $name = $_POST['add-name'];
                $email = $_POST['add-email'];
                $phone = $_POST['add-phone'];
                $ticket = $_POST['check-pt'];
                $ticket_al = $_POST['check-p1'];
                $ticket_kid = $_POST['check-p2'];
                $ticket_child = $_POST['check-p3'];
                $note = $_POST['add-note'];
                $total = $_POST['price-tt'];
                 echo "<script>console.log(1);</script>";
                $stmt1 = $conn->prepare("CALL BOOKING_TOUR(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                // Bind (liên kết) parameters to the query
                $stmt1->bind_param("iissiiiiisd", $uid, $tdid, $tname, $email, $phone, $ticket, $ticket_al, $ticket_kid, $ticket_child, $note, $total);
                
                $stmt1->execute();   
                var_dump($uid, $tdid, $name, $email, $phone, $ticket, $ticket_al, $ticket_kid, $ticket_child, $note, $total);
                $result1 = $stmt1->get_result();
                if ($result1) {
                    while ($row = $result1->fetch_assoc()) {
                        header("Location: checking.php");
                    }
                } else {
                    header("Location: test.php");
                    echo "<p>Không xác định!</p>";
                }

            }
echo " <div>
            <form method='post' id='info-content' action=''>
            <input value='" .$row['tID']."' hidden name='id'> <!--  -->

            <div class='tour-info'>
            
                <input id='hidden-price' value='' hidden name='price-tt'> <!-- total price -->
                <div class='header text-center mb-4'>
                    <h3><i class='fa-solid fa-circle-info'></i> THÔNG TIN LIÊN HỆ</h3>
                </div>
                <div class='tour-info-content'>
                    
                        <div class='row'>
                            <div class='col-4'>
                                <div class='px-2'>
                                    <label for='Name' class='form-label'>Họ và tên</label>
                                    <input type='text' class='form-control' id='Name' name='add-name'>
                                </div>
                            </div>
                            <div class='col-4'>
                                <div class='px-2'>
                                    <label for='email' class='form-label'>Email</label>
                                    <input type='email' class='form-control' id='email' name='add-email'>
                                </div>
                            </div>
                            <div class='col-4'>
                                <div class='px-2'>
                                    <label for='Phone' class='form-label'>Số điện thoại</label>
                                    <input type='number' class='form-control' id='Phone' name='add-phone' maxlength='10'>
                                </div>
                            </div>
                            <div class='col-4'>
                                <div class='px-2'>
                                    <label for='Address' class='form-label'>Địa chỉ</label>
                                    <input type='text' class='form-control' id='Address' name='add-address'>
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
                                        <input type='number' class='form-control' id='aldult' value='".$tPrice_al."' name='check-p1'>
                                    </div>
                                </div>
                                <div class='col-3'>
                                    <div class='px-2'>
                                        <label for='kids' class='form-label'>Trẻ em (5 - 9 tuổi)</label>
                                        <input type='number' class='form-control' id='kids' value='".$tPrice_kid."' name='check-p2'>
                                    </div>
                                </div>
                                <div class='col-3'>
                                    <div class='px-2'>
                                        <label for='child' class='form-label'>Trẻ nhỏ (< 5 tuổi)</label>
                                        <input type='number' class='form-control' id='child' value='".$tPrice_child."'name='check-p3'>
                                    </div>
                                </div>
                                <div class='col-3'>
                                    <div class='px-2 mb-3 mt-2'>
                                        <label for='totalticket' class='form-label'>Tổng số vé đặt</label>
                                        <input type='number' class='form-control' id='totalticket' name='check-pt'>
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
                                    <input type='text' class='form-control' placeholder='Voucher' id='Voucher'
                                        aria-label='Recipient's username' aria-describedby='button-addon2'>
                                    <button class='btn btn-outline-secondary' type='submit' id='button-addon2'>Sử
                                        dụng</button>
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
                            <button class='btn btn-outline-secondary' name='btn-pay'>Thanh toán</button>
                        </div>";
                    
                    echo "</div>"; //đóng div của pay
                echo "</div>  <!-- // đóng div của payment -->
                </form>
            </div>";
?>



<!-- <button class="btn btn-outline-secondary px-3 me-2" onclick="decrementQuantity()">
    <i class="fas fa-minus"></i>
</button>
<div class="form-outline">
    <input id="quantity" min="1" name="quantity" value="1" max="10" type="number"
        class="form-control text-center" readonly />
 </div>
<button class="btn btn-outline-secondary px-3 ms-2" onclick="incrementQuantity()">
    <i class="fas fa-plus"></i>
</button> -->


<!-- <script>
    function incrementQuantity() {
      var quantityInput = document.getElementById("quantity");
      var currentValue = parseInt(quantityInput.value);
      var maxQuantity = parseInt(quantityInput.getAttribute("max"));

      if (currentValue + 1 <= maxQuantity) {
        quantityInput.value = currentValue + 1;
      }
    }

    function decrementQuantity() {
      var quantityInput = document.getElementById("quantity");
      var newValue = parseInt(quantityInput.value) - 1;
      quantityInput.value = newValue >= 1 ? newValue : 1;
    }
</script> -->

</html>