<?php

    // // Tạo kết nối
    // $conn = mysqli_connect("localhost", "root", "orcl", "project");
    

    // // Kiểm tra kết nối
    // if (!$conn) {
    //     die("Kết nối thất bại: " . mysqli_connect_error());
    // } else {
    //     // echo "done!";
    // }
    
    // $_SESSION["id"] = 2; // User's session
    // $sessionId = $_SESSION["id"];
    // $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE uID = $sessionId"));

    //cập nhật mật khẩu toàn bộ người dùng có mk là "1234", "123", "12345" vào mysql
            // Lấy danh sách người dùng có mật khẩu thô là "1234"
        // $stmt99 = $conn->prepare("SELECT uID, uPass FROM users WHERE uPass = '12345'");
        // $stmt99->execute();
        // $users = $stmt99->get_result();

        // // Mã hóa và cập nhật lại mật khẩu cho từng người dùng
        // foreach ($users as $user) {
        //     $uID = $user['uID'];
        //     $hashedPassword = password_hash("1234", PASSWORD_DEFAULT);

        //     $updateStmt = $conn->prepare("UPDATE users SET uPass = ? WHERE uID = ?");
        //     $updateStmt->bind_param('si', $hashedPassword, $uID);
        //     $updateStmt->execute();
        // }

        // echo "Đã cập nhật mật khẩu thành công.";
        // // Lấy giá trị email từ session
        // $email = $_SESSION['email'];
        // $uid = $_SESSION['id'];
            
        //     // Đóng kết nối
        //     $conn = null;
        //     ?>
    password_hash('')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test 2</title>
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/admin.css">


    <style>
        .search-container {
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 20px;
}

#searchInput {
  padding: 8px 12px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 4px;
  width: 300px;
}

#searchButton {
  padding: 8px 16px;
  font-size: 16px;
  background-color: #4CAF50;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  margin-left: 8px;
}

#searchResults {
  margin-top: 20px;
  width: 100%;
}
    </style>
</head>
<body>

    <div class="search-container">
        <input type="text" id="searchInput" placeholder="Nhập từ khóa tìm kiếm...">
        <button id="searchButton">Tìm kiếm</button>
        
    </div>
    <div id="searchResults"></div>

    <script>
        const searchInput = document.getElementById('searchInput');
        const searchButton = document.getElementById('searchButton');
        const searchResults = document.getElementById('searchResults');

        searchButton.addEventListener('click', function() {
        const keyword = searchInput.value.trim();
        if (keyword !== '') {
            performSearch(keyword);
        }
        });

        function performSearch(keyword) {
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'api/search.php?keyword=' + encodeURIComponent(keyword), true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                const results = xhr.responseText;
                searchResults.innerHTML = results;
                }
            };
        xhr.send();
        }
    </script>
<!-- <form name="form" id="form" action="" method="post" enctype="multipart/form-data">
    <?php
        // $id = $user['uID'];
        // $name = $user['uName'];
        // $image = $user['uImg'];
    ?>
        <div class="mycard profile">
        <div class="pic-content d-flex justify-content-center mb-5" id="profile">
            <div class="card" style="width: 12rem">
                <div class="pic d-flex justify-content-center">
                <img src="pic/<?php echo $image; ?>" width = 500 height = 500 title="<?php echo $image; ?>">
                </div>
                
                <div class="card-body d-flex justify-content-center">

                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="hidden" name="name" value="<?php echo $name; ?>">
                <input type="file" name="upload" id="upload" accept=".jpg, .jpeg, .png" hidden>
                <label for="upload" class="btn btn-primary"> Upload hình mới</label>   
                
                
                </div>
            </div>
        </div>
        </div>
</form>

    <script>
        document.getElementById("upload").onchange = function() {
            document.getElementById("form").submit();
        }
    </script>
    <?php
    //     if(isset($_FILES["upload"]["name"])){
    //         $id = $_POST["id"];
    //         $name = $_POST["name"];
      
    //         $imageName = $_FILES["upload"]["name"];
    //         $imageSize = $_FILES["upload"]["size"];
    //         $tmpName = $_FILES["upload"]["tmp_name"];
      
    //         // Image validation
    //         $validImageExtension = ['jpg', 'jpeg', 'png'];
    //         $imageExtension = explode('.', $imageName);
    //         $imageExtension = strtolower(end($imageExtension));
    //         if (!in_array($imageExtension, $validImageExtension)){
    //           echo
    //           "
    //           <script>
    //             alert('Invalid Image Extension');
    //             document.location.href = '/php_project/test2.php';
    //           </script>
    //           ";
    //         }
    //         elseif ($imageSize > 5000000){
    //           echo
    //           "
    //           <script>
    //             alert('Image Size Is Too Large');
    //             document.location.href = '/php_project/test2.php';
    //           </script>
    //           ";
    //         }
    //         else{
    //           $newImageName = $name . " - " . date("Y.m.d") . " - " . date("h.i.sa"); // Generate new image name
    //           $newImageName .= '.' . $imageExtension;
    //           $query = "UPDATE users SET uImg = '$newImageName' WHERE uID = $id";
    //           mysqli_query($conn, $query);
    //           move_uploaded_file($tmpName, 'pic/' . $newImageName);
    //           echo
    //           "
    //           <script>
    //           alert('Thành công!');
    //           document.location.href = '/php_project/test2.php';
    //           </script>
    //           ";
    //         }
    //       }
    // ?>

                    Bootstrap JavaScript Libraries
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script> -->
</body>
</html>