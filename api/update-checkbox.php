<?php
    include "../connect.php";

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    // Lấy id từ yêu cầu AJAX
    $id = $_GET['id'];

    

    // Cập nhật trạng thái checkbox trong cơ sở dữ liệu
    $sql = "UPDATE advise SET aStatus = 1 WHERE aID = '$id'";

    if ($conn->query($sql) === TRUE) {
        echo 'Trạng thái checkbox đã được cập nhật thành công.';
        
    } else {
        echo 'Lỗi: ' . $conn->error;
    }

    $conn->close();