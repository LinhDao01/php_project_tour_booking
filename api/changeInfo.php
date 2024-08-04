<?php
    session_start();
    include "../connect.php";

    $name = $_GET['name'];
    $phone = $_GET['phone'];
    $email = $_SESSION['email']; 

    $uid = $_SESSION['id'];

    if (!isset($conn)) {
        echo "Không kết nối được đến CSDL";
    } else {
        $stmt = $conn->prepare("CALL CHANGE_INFO(?, ?, ?)");
        $stmt->bind_param("sss", $name, $phone, $email);
        if ($stmt->execute()) {
            http_response_code(200); // OK
            echo "Thủ tục CHANGE_INFO đã được thực thi thành công";
            $_SESSION['username'] = $name;
        } else {
            http_response_code(500); // Internal Server Error
            echo "Lỗi thực thi thủ tục: " . $stmt->error;
        }
        $stmt->close();

    }