<?php 

    session_start();
    ob_start();
    include "connect.php"; //kết nối đến db

    if((isset($_POST['assign']))&&($_POST['assign'])) {
        //tham số đầu vào của thủ tục
        $name = $_POST['name'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];
 

        $chk = $conn->prepare("SELECT * FROM users WHERE uEmail = ?");
        $chk->bind_param("s", $email);
        $chk->execute();
        $result = $chk->get_result();

        if ( $result->num_rows > 0) {
            echo "<script>alert('Email đã tồn tại!')</script>";
        } else {
            $stmt = $conn->prepare("CALL ASSIGN_CUS(?, ?, ?)");
            // Bind (liên kết) parameters to the query
            $stmt->bind_param('sss', $name, $email, $pass);
        
            $stmt->execute();   
 

            // Lấy thông tin người dùng mới đăng ký
            $getUserStmt = $conn->prepare("SELECT * FROM users WHERE uEmail = ?");
            $getUserStmt->bind_param("s", $email);
            $getUserStmt->execute();
            $userResult = $getUserStmt->get_result();
            $userRow = $userResult->fetch_assoc();

            // Lưu thông tin người dùng vào session
            $_SESSION['id'] = $userRow['uID'];
            $_SESSION['username'] = $userRow['uName'];
            $_SESSION['img'] = $userRow['uImg'];
            $_SESSION['email'] = $email;

            echo "<script>alert('Đăng ký thành công!');</script> ";
            header("Location: user/profile.php");
            // Đóng câu truy vấn và kết nối
            $stmt->close();
            $conn->close();
        }
        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css "> -->
    <!-- <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        /> -->
    
    <!-- css -->
    <link rel="stylesheet" href="css/assign.css">
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">

</head>
<body style="background-image: url(pic/login1.jpg);">
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
                <article> 
                    <section class="left" style="background-image: url(pic/login1.jpg);">
                        <div class="container-xs">
                            <h1>Xin Chào <br>Bạn</h1>
                            <p>Nếu bạn đã có tài khoản, có thể đăng nhập dưới đây và tận hưởng!</p>
                        </div>                      
                        <a href="login.php"> <i class="fa-solid fa-arrow-right"></i> <span>Đăng nhập</span></a>
                    </section> 
                                            <!--action này tự action lại chính nó -->
                    <form class="right" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                        <h1 class="fw-bold">Đăng ký tại đây</h1>
                        <input type="text" placeholder="Họ tên" class="form-control" name="name" >
                        <input type="email" placeholder="Email" class="form-control" name="email" >
                        <input type="password" placeholder="Mật khẩu" class="form-control" name="pass" >
                        <input type="password" placeholder="Nhập lại mật khẩu" class="form-control" name="pass2">
                        <input name="assign" type="submit" value="Đăng ký"></input>
                    </form> 
                      
                </article>
            </div>
        

</div>
</div>
</body>
</html>