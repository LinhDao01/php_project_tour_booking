<?php
    // Kết nối với cơ sở dữ liệu
    include "../connect.php";

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    // Lấy id
    $id = $_GET['id'];

    // Cập nhật trạng thái trong cơ sở dữ liệu
    $sql = "UPDATE booking SET bStatus = 1 WHERE bID = '$id'";

    if ($conn->query($sql) === TRUE) {
        echo 'Trạng thái đã được cập nhật thành công.';
        $point = $conn->prepare("UPDATE users SET uPoint = uPoint + 3 WHERE uID =
                                    (SELECT uID from booking where bID = ?)");
        $point->bind_param("i", $id);
        $point->execute();
        
    } else {
        echo 'Lỗi: ' . $conn->error;
    }

    $conn->close();