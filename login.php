
<?php 
    session_start();
    ob_start();
    include "connect.php"; //kết nối đến db

// Kiểm tra xem người dùng đã nhấn nút đăng nhập chưa
if (isset($_POST['dangnhap'])) {
    $email = $_POST['email'];
    $password = strval($_POST['pass']); // Lấy mật khẩu từ biểu mẫu đăng nhập

    var_dump($email, $password);
    // Chuẩn bị câu truy vấn
    $stmt = $conn->prepare("SELECT * FROM users WHERE uEmail = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    
    // Lấy kết quả
    $result = $stmt->get_result(); 

    // Kiểm tra số dòng trả về
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $storedPassword = strval($row['uPass']); // Mật khẩu đã được lưu trong cơ sở dữ liệu
       
        // Kiểm tra mật khẩu nhập vào với mật khẩu đã được mã hóa trong cơ sở dữ liệu
        if ($password === $storedPassword) {

            // Chuyển hướng người dùng dựa trên chức vụ
            $userRole = $row['uRole'];
            switch ($userRole) {
                case 0:
                    $_SESSION["username"] = $row['uName'];
                    $_SESSION["img"] = $row['uImg'];
                    $_SESSION["email"] = $email;
                    $_SESSION['id'] = $row['uID']; 
                    header("Location: user/profile.php");
                    break;
                case 1:
                    $_SESSION["username"] = $row['uName'];
                    $_SESSION["img"] = $row['uImg'];
                    $_SESSION["email"] = $email;
                    $_SESSION['id'] = $row['uID']; 
                    header("Location: admin/home.php");
                    break;
                case 2:
                    $_SESSION["username"] = $row['uName'];
                    $_SESSION["img"] = $row['uImg'];
                    $_SESSION["email"] = $email;
                    $_SESSION['id'] = $row['uID']; 
                    header("Location: staff/info.php");
                    break;
                default:
                    echo "User does not exist!";
            }
            exit; 
        } else {
            $errorMessage = $password;
        }
    } else {
        $errorMessage = "Invalid email or password!";
    }

    // Đóng câu truy vấn và kết nối
    $stmt->close();
    $conn->close();
}
?>
<!-- kiểm tra sai mật khẩu -->
<?php if (isset($errorMessage)): ?>
    <script>
        alert('<?php echo "Sai Mật Khẩu!" ?>');
        window.location.href = 'login.php';
    </script>
<?php endif; ?>



<!DOCTYPE html>    
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <!-- Bootstrap CSS v5.2.1 -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" /> -->
    <!-- link icon -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"> -->
    <link rel="stylesheet" href="css/login.css">
    <!-- fontawesome -->
    <script src="https://kit.fontawesome.com/1ee92f529b.js" crossorigin="anonymous"></script>

</head>
<body style="background-image: url('pic/login1.jpg');">
<header>
    <div class="container-fluid head1">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 my-1 logo-header">
                <div class="container">
            <nav class="navbar navbar-expand-lg">
                <div class="col-3-lg me-5">
                    <div class="logo">
                        <a href="index.php" class="logo-wrapper">					
                            <img src="pic/logo-4.png" alt="logo ">					
                        </a>
                    </div>
                </div>
                <!-- nút xuất hiện khi thu nhỏ màn hình tới break points, nếu k sẽ ẩn -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                        <li class="nav-item ">
                            <a class="nav-link text-light fs-5" href="index.php">Tours</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light fs-5" href="introduce.php">Giới thiệu</a>
                        </li>
                    </ul>     
                </div>
                
            </nav>
        </div>
            </div>
            	
            
        </div>	
        </div>
</header>
    <div class="container ">
        <div class="row justify-content-center mt-5">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 mt-5">
                <article>                       <!--action này tự action lại chính nó -->
                    <form class="left" action="<?php echo $_SERVER['PHP_SELF']?>" method="post"> 
                        <h1 class="fw-bold">Đăng nhập tại đây</h1>
                        <input type="email" placeholder="Email" name="email" class="form-control" id="name">
                        <input type="password" placeholder="Mật khẩu" name="pass" class="form-control" id="pass">
                        <input name="dangnhap" type="submit" value="Đăng nhập"></input>
                    </form>   
                    
                    <section class="right" style="background-image: url('pic/login1.jpg');">
                        <div class="container-xs">
                            <h1>Xin Chào <br>Bạn</h1>
                            <p>Nếu bạn chưa có tài khoản, có thể đăng ký dưới đây</p>
                        </div>                      
                        <a href="assign.php"> <i class="fa-solid fa-arrow-right"></i> <span>Đăng ký</span></a>
                    </section>
                        
                    
                </article>
            </div>
        
    
</div>
</div>
</body>
</html>