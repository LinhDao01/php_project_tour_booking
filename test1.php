<?php 
    session_start();

    include "connect.php";

    // kiểm tra quyền ghi file của thư mục uploads
    $upload_dir = "uploads/";

// Kiểm tra xem thư mục có tồn tại hay không
if (!is_dir($upload_dir)) {
    echo "Thư mục $upload_dir không tồn tại.";
} else {
    // Kiểm tra quyền ghi file
    if (is_writable($upload_dir)) {
        echo "Thư mục $upload_dir có quyền ghi file.";
    } else {
        echo "Thư mục $upload_dir không có quyền ghi file.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test1</title>
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

    <link rel="stylesheet" href="css/admin.css">

</head>
<body>
    <!-- <form action="" method="post" enctype="multipart/form-data">
        <input type="text" name="user">
        <input type="email" name="email" Required>
        <input type="file" name="pic">
        <input type="submit" name="send">

        <?php 
            // if(isset($_POST['send'])&&($_POST['send'])) {
            //     $name = $_POST['user'];
            //     $email = $_POST['email'];
            //     $picpath = basename($_FILES['pic']['name']);
            //     $targer_dir = "uploads/";
            //     $targer_file = $targer_dir . $picpath;

            //     // Check file size ()
            //     if ($_FILES["pic"]["size"] > 5000000) { 
            //         echo "Sorry, your file is too large.";
            //         $uploadOk = 0;
            //     }

            //     echo "tên". $name;
            //     echo "<br> email" . $email;
            //     echo "<br> đường hình ảnh: ". $picpath;
            //     echo "<br> <img src='". $targer_file ."' width='300'> ";
            // }
        ?>
    </form> -->

    <!-- <form action="" method="post" enctype="multipart/form-data">
    <input type="text" name="user">
    <input type="email" name="email" Required>
    <input type="file" name="pic" id="pic">
    <input type="submit" name="send">
</form> -->

<?php
// if (isset($_POST['send']) && ($_POST['send'])) {
//     $name = $_POST['user'];
//     $email = $_POST['email'];
//     $picpath = $_FILES['pic']['name'];
//     $target_dir = "uploads/";
//     $target_file = $target_dir . basename($picpath);
//     $uploadOk = 1;

//     // Check file size
//     if ($_FILES["pic"]["size"] > 5000000) {
//         echo "Sorry, your file is too large.";
//         $uploadOk = 0;
//     }

//     // Check if $uploadOk is set to 0 by an error
//     if ($uploadOk == 0) {
//         echo "Sorry, your file was not uploaded.";
//     // if everything is ok, try to upload file
//     } else {
//         if (move_uploaded_file($_FILES["pic"]["tmp_name"], $target_file)) {
//             echo "The file " . htmlspecialchars(basename($picpath)) . " has been uploaded.";
//         } else {
//             echo "Sorry, there was an error uploading your file.";
//         }
//     }

//     echo "Name: " . $name;
//     echo "<br>Email: " . $email;
//     echo "<br>File Path: " . $target_file;
//     echo "<br><img src='" . $target_file . "' width='300'>";
// }


// upload ảnh đại diện mới
if (isset($_POST['btn_pic_clicked']) && ($_POST['btn_pic_clicked']) == "1") {
    $picpath = $_FILES['pic-send']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($picpath);
    $uploadOk = 1;
    // Check file size
    if ($_FILES["pic-send"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
 
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        // If everything is ok, try to upload file
        if (move_uploaded_file($_FILES["pic-send"]["tmp_name"], $target_file)) {
            // Save the full file path to the session
            $_SESSION["img_new"] = $target_file;
            echo "<script>alert('File has been uploaded successfully.');</script>";
            echo $_SESSION['img_new'];
        } else {
            echo "<script>alert('Error uploading file.');</script>";
        }
    }
}
?>
    
    <form action="" method="post" enctype="multipart/form-data">
        <div class="mycard profile">
        <div class="pic-content d-flex justify-content-center mb-5" id="profile">
            <div class="card" style="width: 12rem">
                <div class="pic d-flex justify-content-center">
                <?php
                    if (isset($_SESSION["img_new"])) {
                        echo "<img src='" . $_SESSION["img_new"] . "' alt='Hình ảnh đã tải lên' class='avatar-lg rounded-5'>";
                        echo $_SESSION["img_new"];
                    } else {
                        echo "<img src='pic/user_ava.jpg' alt='Ảnh mặc định' class='avatar-lg rounded-5'>";
                        // echo "<img src='pic/-bai-dam-trau.jpg' >";
                    }
                    ?>
                </div>
                
                <div class="card-body d-flex justify-content-center">

                    <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-new-pic">
                    Upload hình mới
                </button>
                <!-- Modal -->
                <div class="modal fade" id="add-new-pic" tabindex="-1" aria-labelledby="add-new-pic-label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <input type="file" name="pic-send" id="btn-pic-send"></input>
                            
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="btn_pic_clicked" id="btn_pic_clicked" value="0">
                                <button type="submit" class="btn btn-secondary" name="pic-send-submit" id="pic-submit">Lưu</button>
                                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                            </div>
                        </div>
                    </div>
                </div>
                
                </div>
            </div>
        </div>
        </div>
    </form>
                

    <!-- <?php
        $pass= "123";
        $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

        echo $hashedPassword;
    ?> -->
    
    <img src="pic/-bai-dam-trau.jpg">
    <script>
        document.getElementById("pic-submit").addEventListener("click", function() {
            document.getElementById("btn_pic_clicked").value = "1";
        })

    </script>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>
</html>