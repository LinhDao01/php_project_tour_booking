<?php
include "../connect.php";

if (!isset($conn)) {
    echo "chưa kết nối đến CSDL!";
} else {
    // Kiểm tra xem hình ảnh đã được tải lên hay chưa
    if (isset($_FILES["upload"]["name"])) {
        $imageName = htmlspecialchars($_FILES["upload"]["name"], ENT_QUOTES);
        $imageSize = $_FILES["upload"]["size"];
        $tmpName = $_FILES["upload"]["tmp_name"];
        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = explode('.', $imageName);
        $imageExtension = strtolower(end($imageExtension));

        if (!in_array($imageExtension, $validImageExtension)) {
            echo "<script>alert('Invalid Image Extension'); exit; </script>";
        } elseif ($imageSize > 5000000) {
            echo "<script>alert('Image Size Is Too Large'); exit; </script>";
        } else {
            $newImageName = $imageName; // Sử dụng tên tệp tin gốc
            $targetDirectory = '../tour-pic/';

            // Di chuyển tệp tin ảnh đến thư mục đích
            if (move_uploaded_file($tmpName, $targetDirectory . $newImageName)) {
                echo "Thành công!";
            } else {
                echo "Không thể di chuyển tệp tin!";
            }
        }
    }

    // Thêm dữ liệu từ form method post vào bảng tours
    if (isset($_POST['btn_send_clicked']) && ($_POST['btn_send_clicked']) == "1") {
        $nametour = $_POST['nametour'];
        $typetour = $_POST['typetourid']; 
        $num_ticket = $_POST['num_ticket'];
        $desTour = $_POST['desTour'];
        $adult_price = $_POST['adult_price'];
        $kid_price = $_POST['kid_price'];
        $child_price = $_POST['child_price'];
        $transport = $_POST['transport'];
        $timetour = $_POST['timetour'];
        $place = $_POST['place'];
        $pic = $newImageName; // Sử dụng tên tệp tin ảnh mới
        $start_place = $_POST['start_place'];
        $tinh = $_POST['tinhid'];
        
        if (is_null($nametour) || is_null($typetour) || is_null($num_ticket) || is_null($desTour) || is_null($adult_price) || is_null($kid_price) || is_null($child_price) || is_null($transport) || is_null($timetour) || is_null($place) || is_null($pic) || is_null($start_place) || is_null($tinh)) {
            echo "<script>alert('Vui lòng nhập đầy đủ thông tin trước khi lưu mới!')</script>";
            exit();
        } else {
            $stmt2 = $conn->prepare("CALL ADD_TOUR(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt2->bind_param("siisdddsssssi", $nametour, $typetour, $num_ticket, $desTour, $adult_price, $kid_price, $child_price, $transport, $timetour, $place, $pic, $start_place, $tinh);
           
            // echo "Dữ liệu sẽ được gửi đi: <br>";
            // var_dump($nametour, $typetour, $num_ticket, $desTour, $adult_price, $kid_price, $child_price, $transport, $timetour, $place, $pic, $start_place, $tinh);    
            
            $stmt2->execute();
            
            if ($stmt2->errno) {
                echo "Lỗi: " . $stmt2->error;
                exit();
            } 
            // else {
            //     echo "<script>alert('Thêm tour thành công!'); window.location.href = './admin/tourinfo.php'; </script>";
            //     exit();
            // }
            if ($stmt2->affected_rows > 0) {
                echo "<script>alert('Xóa tour thành công!'); window.location.href = './admin/tourinfo.php';</script>";
            } else {
                echo "<script>alert('Không thể thêm tour. Vui lòng thử lại sau!');</script>";
            }

            $stmt->close();
        }
    }
}
