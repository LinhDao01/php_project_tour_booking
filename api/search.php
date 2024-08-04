<?php
    include "../connect.php";

    if (!isset($conn)) {
        echo "chưa kết nối đến CSDL"; 
    } else {
        // Lấy từ khóa tìm kiếm từ trang index hoặc trang result-search
        $keyword = $_GET['keyword'];

        // Thực hiện truy vấn tìm kiếm
        $stmt = $conn->prepare("SELECT t.*, MIN(td.tStart) AS min_tStart FROM type_tour tt
                                LEFT JOIN tours t ON tt.ttID = t.ttID
                                LEFT JOIN tour_date td ON t.tID = td.tID
                                WHERE td.tStart > CURDATE() AND tName LIKE '%$keyword%'
                                GROUP BY t.tID
                                ORDER BY min_tStart ASC");
        $stmt->execute();
        $result = $stmt->get_result();

        // Hiển thị kết quả
        if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $tourID = $row['tID']; 

            echo "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 list border border-success rounded p-2 m-2'>
                    <div class='row'>
                        <div class='col-lg-4 col-md-3 col-sm-3 col-xs-12 picture'>
                            <a href='tourdetail.php?id=$tourID'><img src='pic/". $row['tPic'] ."' alt='hinh anh'
                                    class='list-anh'></a>
                        </div>
                        <div class='col-lg-8 col-md-8 col-sm-8 col-xs-12 content '>
                            <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 '>
                                <p class='tour-name fw-bold fs-4'><a href='tourdetail.php?id=$tourID'>". $row['tName'] ."</a></p>
                            </div>
                            <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 '>
                                <div class='row'>
                                    <div class='col-lg-6 col-md-8 col-sm-8 col-xs-12'>
                                        <p class=''>Ngày khởi hành: ". $row['min_tStart'] ."</p>
                                        <p>Thời gian tour: ". $row['tDay'] ."</p>
                                        <p>Nơi khởi hành: ". $row['tPlace'] ."</p>
                                    </div>
                                    <div class='col-lg-6 col-md-4 col-sm-4 col-xs-12 text-end'>
                                        <h4 class='cost'>". $formattedAmount = number_format($row['tPrice_al'], 0, ',', '.')."<span>VND</span></h4>
                                        <p></p>
                                        
                                    </div>
                                </div>    
                            </div>
                        </div>
                    </div>
                </div>";
        }
        } else {
        echo "Không tìm thấy kết quả nào";
        }

        // Đóng kết nối
        $conn->close();
        }
    