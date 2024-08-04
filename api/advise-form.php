<?php
    session_start();
    include "../connect.php";

    $name = $_GET['name'];
    $phone = $_GET['phone'];
    $email = $_GET['email'];
    $note = $_GET['note'];
    $tourid = $_GET['tourid'];
    $status = 0;

    if (!isset($conn)) {
        echo "Khống kết nối được đến CSDL!";
    } else {
        $stmt = $conn->prepare("CALL ADVISE(?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issssi", $tourid, $name, $phone, $email, $note, $status);
        if ($stmt->execute()) {
            http_response_code(200); //OK
            echo "<script>alert('Thủ tục ADVISE đã được thực thi thành công');
                 </script>";
        } else {
            http_response_code(500); //Internal Server Error
            echo "Lỗi thực thi thủ tục: " . $stmt->error;
        }
        $stmt->close();

    }
