<?php 
    session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <title>Giới thiệu</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" /> -->
    <!-- css -->
    <link rel="stylesheet" href="css/introduce.css">
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <!-- icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <!-- fontawesome -->
    <script src="https://kit.fontawesome.com/1ee92f529b.js" crossorigin="anonymous"></script>

</head>

<body>
    <header>
        <div class="container-fluid head1" >
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 my-1 logo-header">
                    <div class="container">
                        <nav class="navbar navbar-expand-lg">
                            <div class="col-3-lg me-5">
                                <div class="logo">
                                    <a href="index.php" class="logo-wrapper">
                                        <img src="pic/logo-4.png" alt="logo " />
                                    </a>
                                </div>
                            </div>
                            <!-- nút xuất hiện khi thu nhỏ màn hình tới break points, nếu k sẽ ẩn -->
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false"
                                aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarText">
                                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                    <li class="nav-item">
                                        <a class="nav-link active text-black fs-5" aria-current="page"
                                            href="index.php">Tours</a>
                                    </li>
                                   
                                    <li class="nav-item">
                                        <a class="nav-link text-black fs-5" href="introduce.php ">Giới thiệu</a>
                                    </li>
                                </ul>
                                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                                </ul>
                            </div>
                            <div class="col-lg-3 col-md-2 col-sm-3 text-center">
                            <?php 
                                if ( isset($_SESSION["username"])) {
                                    echo "<ul class='navbar-nav float-end'>
                                            <li class='nav-item d-flex'>
                                                <img src='pic/" . $_SESSION['img'] . "' alt='ảnh măc định' class='avatar-lg rounded-5'> 
                                        
                                                <a class='nav-link text-decoration-none fw-semibold text-black fs-5'
                                                href='user/profile.php'>". $_SESSION['username'] . "</a>
                                            </li>
                                        </ul>"; 
                                } else {
                                    echo "<p class='my-2'><a href='assign.php' title='assign'
                                                class='text-decoration-none fw-semibold text-black'> Đăng Ký</a>
                                            /
                                            <a href='login.php' title='login' class='text-decoration-none fw-semibold text-black'>
                                                Đăng Nhập</a>
                                            </p>"; 
                                }
                            ?>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main>
        <!-- đường dẫn trang -->
        <div class="container my-3">
            <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Tours</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Giới thiệu
                    </li>
                </ol>
            </nav>
        </div>
        <!-- nội dung -->
        <div class="container">
            <div class="d-flex align-items-start">
                <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <button class="nav-link active" id="v-pills-gioithieu-tab" data-bs-toggle="pill" data-bs-target="#v-pills-gioithieu" type="button" role="tab" aria-controls="v-pills-gioithieu" aria-selected="true">Giới thiệu</button>
                    <button class="nav-link" id="v-pills-dieukhoan-tab" data-bs-toggle="pill" data-bs-target="#v-pills-dieukhoan" type="button" role="tab" aria-controls="v-pills-dieukhoan" aria-selected="false">Điều khoản & điều kiện</button>
                    <button class="nav-link" id="v-pills-tichdiem-tab" data-bs-toggle="pill" data-bs-target="#v-pills-tichdiem" type="button" role="tab" aria-controls="v-pills-tichdiem" aria-selected="false">Tích điểm thành viên</button>
                    <button class="nav-link" id="v-pills-hotro-tab" data-bs-toggle="pill" data-bs-target="#v-pills-hotro" type="button" role="tab" aria-controls="v-pills-hotro" aria-selected="false">Hỗ trợ</button>
                </div>
                <div class="container mx-3">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-gioithieu" role="tabpanel" aria-labelledby="v-pills-gioithieu-tab" tabindex="0">
                            <h2>Giới thiệu về Western Travel</h2>
                            <p>Đây là một trang web được dùng để quảng bá du lịch miền tây do người miền tây thực hiện. Những tour được phát
                                triển dựa trên nhu cầu về du lịch ở miền tây.
                            </p>
                            
                        </div>
                        <div class="tab-pane fade" id="v-pills-dieukhoan" role="tabpanel" aria-labelledby="v-pills-dieukhoan-tab" tabindex="0">
                            ĐIỀU KIỆN & ĐIỀU KHOẢN DÀNH CHO KHÁCH HÀNG

Quý Khách chấp thuận những điều kiện và điều khoản dưới đây:

1.  Định nghĩa:

- Dịch vụ: là việc Western travel thay mặt khách hàng thực hiệntour, tư vấn với đối tác. <br>

- Nhà cung cấp bao gồm tour.<br>

- Phí dịch vụ là khoản phí mà người sử dụng cuối hoặc khách hàng phải trả khi họ đặt các dịch vụ tours... được cung cấp bởi western travel. Khoản phí dịch vụ mà khách hàng đã thanh toán sẽ không được hoàn trả trong bất kỳ tình huống nào. Đây là một phí được áp dụng để bù đắp cho những nỗ lực của Western travel trong việc cung cấp nguồn nhân lực và kiến thức chuyên môn, nhằm đáp ứng và đồng hành với các nhu cầu và mong muốn của khách hàng.

- Phí tiện ích là khoản phí mà Western travel thu khi khách hàng sử dụng dịch vụ tại website và ứng dụng điện thoại của Western travel. Mức phí tiện ích được tính theo từng dịch vụ và có thể thay đổi (mà không cần thông báo trước) tùy thuộc vào từng giai đoạn. Mục đích của việc áp dụng phí tiện ích là nâng cao chất lượng dịch vụ và cải thiện hệ thống cung cấp dịch vụ của Western travel, nhằm mang lại trải nghiệm tốt hơn cho khách hàng.

2.  Độ tuổi:

Quý Khách phải từ 18 tuổi trở lên mới được phép đặt dịch vụ Western travel.

3. Thanh toán

Western travel.com có nhiều phương thức thanh toán để thuận tiện cho Khách hàng khi đặt dịch vụ, Khách hàng có thể tham khảo và lựa chọn phương thức phù hợp:

Chuyển khoản qua ngân hàng: Sau khi đặt hàng, Khách hàng chuyển khoản số tiền đơn hàng vào tài khoản của Western travel.com tại các hệ thống ngân hàng.
Thanh toán bằng thẻ ATM nội địa: Khách hàng sử dụng thẻ ATM nội địa để thanh toán.
Thanh toán bằng thẻ tín dụng quốc tế: Khách hàng sử dụng thẻ Visa/ Master Card/ JCB để thanh toán.
Thanh toán tại cửa hàng tiện lợi Payoo hoặc qua QR code Payoo
Thanh toán tại các Văn phòng của Western travel.com: tại Hồ Chí Minh, Hà Nội, Cần Thơ

4.   Xác nhận thông tin đặt dịch vụ:

Thông tin đặt dịch vụ được xác nhận thể hiện trong email xác nhận (đặt phòng, combo, vé máy bay, …) được gởi từ Western travel đến email Quý Khách đã đăng ký tại thời điểm đặt phòng với Western travel và trên hệ thống Western travel (bao gồm website và ứng dụng Western travel). Đây là cơ sở xác định các dịch vụ cung cấp cho khách hàng.

Trường hợp Quý Khách thực hiện thanh toán trễ hơn hạn thanh toán được thông báo từ Western travel.com qua email, website, ứng dụng, việc đặt dịch vụ của Quý khách sẽ không còn hiệu lực.

Chúng tôi không đảm bảo bất kỳ thông tin đặt phòng nào cho đến khi quý khách nhận được email xác nhận lần cuối.

Khi thực hiện đặt dịch vụ và thanh toán, xem như Quý Khách đã đồng ý các điều kiện, điều khoản, chính sách áp dụng của Western travel và nhà cung cấp trước, trong và sau quá trình sử dụng dịch vụ. 

5.  Thực hiện thay đổi cho thông tin đặt dịch vụ:

Sau khi đặt dịch vụ thành công (dịch vụ đã được xác nhận qua email), nếu Quý Khách muốn thay đổi thông tin đặt dịch vụ, vui lòng gởi yêu cầu đến email tc@Western travel.com hoặc số điện thoại 1900 1870. Chúng tôi sẽ cố gắng để hỗ trợ Quý Khách một cách tốt nhất, tuy nhiên chúng tôi không đảm bảo mọi yêu cầu thay đổi sẽ được thực hiện. 

Nếu Quý Khách được phép hủy hoặc thay đổi Đặt dịch vụ nhưng không hủy hoặc thay đổi trước thời hạn cho phép, Quý Khách sẽ có trách nhiệm trả phí hủy theo quy định tại thời điểm đó, thuế hoặc phí khôi phục thuế (áp dụng hiện hành theo quy định), phí dịch vụ hoặc phí đặt dịch vụ khác dù Quý Khách có sử dụng dịch vụ hay không.

Nếu Quý Khách không sử dụng dịch vụ (lên máy bay, tham gia tour, nhận phòng khách sạn, …) vào ngày/đêm đặt dịch vụ đầu tiên nhưng dự định nhận phòng/tiếp tục sử dụng dịch vụ cho các đêm tiếp theo thì Quý Khách phải xác nhận với Western travel và nhà cung cấp/đơn vị liên kết của Western travel tối thiểu 6 tiếng trước giờ khởi hành/ngày/đêm đặt dịch vụ đầu tiên và trong thời gian làm việc (08.00 am – 20.00 pm). Nếu Quý Khách không làm như vậy, Đặt dịch vụ của Quý Khách sẽ bị hủy và Quý Khách sẽ không được sử dụng dịch vụ cũng như hoàn trả.

Trường hợp Quý Khách muốn thay đổi, hủy, hoàn tiền cho đặt dịch vụ đã đặt vì bất kỳ lý do gì vui lòng liên hệ Western travel để được hỗ trợ trước khi sử dụng dịch vụ/nhận phòng (check in)/ khởi hành hoặc theo thời gian quy định tại thời điểm đó. Western travel sẽ nỗ lực hết sức để hỗ trợ Quý Khách trong khả năng của Western travel. Trường hợp Quý Khách đã sử dụng dịch vụ, mọi yêu cầu hoàn, hủy, thay đổi sẽ không được thực hiện.

Ngoài ra, Western travel cũng áp dụng phí quản lý cho các yêu cầu thay đổi đặt dịch vụ /thông tin hủy phòng được chấp nhận (phí cộng thêm ngoài mức phí huỷ dịch vụ của nhà cung cấp).

Voucher, khuyến mãi, mã giảm giá, điểm thưởng sẽ không được hoàn lại khi Quý Khách thay đổi, hủy dịch vụ.

Trường hợp có sự thay đổi từ nhà cung cấp dịch vụ (hãng hàng không, khách sạn, dịch vụ khác, ...) các điều kiện khách quan khác (bao gồm và không giới hạn các trường hợp bất khả kháng như thiên tai, dịch bệnh, ...) dẫn đến Quý Khách không thể sử dụng dịch vụ hoặc thay đổi dịch vụ, tùy theo quyết định của nhà cung cấp, Western travel sẽ thông báo lại cho Quý khách phương án áp dụng hoặc các chi phí hoàn lại, phát sinh tại thời điểm đó. Trường hợp nhà cung cấp cho phép hủy dịch vụ và hoàn lại tiền, Western travel sẽ hoàn lại số tiền Quý Khách đã thanh toán sau khi trừ đi phí dịch vụ của Western travel.

6.  Yêu cầu đăng ký thông tin:

Chúng tôi không cung cấp thông tin chi tiết thẻ tín dụng của Quý Khách cho bất kỳ nhà cung cấp phòng nào.

Cho nên, nhà cung cấp của chúng tôi có thể yêu cầu Quý khách cung cấp thông tin có trên thẻ đã sử dụng để thanh toán cho việc đặt dịch vụ và chữ ký chủ thẻ tương. Nhà cung cấp sẽ yêu cầu xuất trình giấy CMND hoặc hộ chiếu tại thời điểm sử dụng dịch vụ. Một bản lưu của thẻ tín dụng / CMND hoặc hộ chiếu (passport) của Quý Khách cũng có thể được nhà cung cấp giữ lại.

7.  Thông tin trang web:

Chúng tôi nỗ lực cam kết độ chính xác cao nhất của các thông tin được hiển thị trên trang web, tuy nhiên xin lưu ý các thông tin cũng được chỉnh sửa từ nhà cung cấp dịch vụ và điều chỉnh theo đánh giá khách quan, phù hợp từ khách hàng (bao gồm cả thông tin, xếp hạng, đánh giá khách sạn, khu nghỉ dưỡng, ...). Do đó, chúng tôi không đảm bảo được tất cả thông tin trên là chính xác hoàn toàn hoặc không có bất kỳ lỗi nào. Chúng tôi bảo lưu quyền thay đổi thông tin hiển thị trên trang web (bao gồm Điều khoản và Điều kiện này) bất kỳ thời điểm nào mà không phải báo trước và các thay đổi này có hiệu lực ngay cho tất cả các dịch vụ của Western travel ở mọi thời điểm.   

8.  Trách nhiệm:

Chúng tôi sẽ không chịu trách nhiệm với bất kỳ thiệt hại, mất mát, khiếu nại hoặc khoản phí nào (bao gồm những nguyên nhân sau: sự sai lệch thông tin hậu quả trực tiếp hay gián tiếp gây ra) được phát sinh từ trang web chúng tôi liên quan đến những sản phẩm hay những dịch vụ được niêm yết trên trang này.

Chúng tôi không bảo đảm hay là người đại diện cho những sản phẩm phòng ở hay dịch vụ nào trên trang web hoặc các trang kết nối. Ở đây trách nhiệm của chúng tôi chỉ cho phép thực hiện việc đặt phòng. Chúng tôi không chịu trách nhiệm với lý do không có phòng trống vì khách sạn đã cho thuê vượt quá số phòng.

Trường hợp nhà cung cấp không cung cấp những dịch vụ đã được Western travel.com thay mặt cho khách hàng đặt trước (bao gồm và không giới hạn: phòng không còn trống, loại phòng không chính xác, …) hoặc khách hàng không nhận được dịch vụ như đã xác nhận, khách hàng có trách nhiệm thông báo cho Western travel.com ngay lập tức tại thời điểm xảy ra sự việc. Western travel.com sẽ nỗ lực hết sức phối hợp với nhà cung cấp để cung cấp dịch vụ đúng như yêu cầu đã được xác nhận dựa vào chính sách, quy định của đối tác cung cấp tại thời điểm phát sinh. Trường hợp đã qua ngày hoàn tất dịch vụ (ngày trả phòng, ngày sử dụng dịch vụ, ...), Western travel.com có quyền từ chối hỗ trợ trừ khi có sự đồng ý từ phía nhà cung cấp. Western travel sẽ thông báo cho khách hàng quyết định của nhà cung cấp cho các yêu cầu hỗ trợ của khách hàng. Western travel không chịu trách nhiệm bồi thường cho các phát sinh xảy ra nếu khách hàng không thông báo cho Western travel theo quy định nêu trên hoặc do nhà cung cấp không đồng ý bồi thường.

Trong trường hợp không cung cấp dịch vụ được do hết phòng, hết chỗ, hủy chuyến, ..., Western travel có quyền lựa chọn dịch vụ thay thế, đặt lại dịch vụ cho Quý Khách:

   (i) Đặt dịch vụ thay thế cho Quý Khách với một nhà cung cấp khác tương đương.;

   (ii) Trường hợp không có nhà cung cấp tương đương, Western travel sẽ đặt dịch vụ với một nhà cung cấp khác.

   (iii) Trường hợp Quý khách không đồng ý với (i) và (ii) hoặc không có dịch vụ thay thế, Western travel sẽ hoàn lại phần tiền Quý khách đã thanh toán cho dịch vụ Quý Khách chưa sử dụng.

Tương đương được định nghĩa như sau:

-       Đối với đặt phòng khách sạn: chỗ lưu trú tại khách sạn cùng hạng sao, ở cùng khu vực (tỉnh, thành phố), loại phòng có sức chứa giống nhau (số lượng khách), các dịch vụ bao gồm nhau: bữa ăn sáng/bữa ăn trưa/bữa ăn tối, ... (đảm bảo đủ số bữa, số lượng dịch vụ, không đảm bảo về món ăn, chi tiết dịch vụ).

Giá trị/loại dịch vụ thay thế được xác định dựa trên giá công bố dịch vụ đó trên website Western travel.com hoặc các trang web online khác do Western travel.com xác định, vào thời điểm do Western travel.com xác định.

Trường hợp khách hàng không đồng ý với dịch vụ thay thế, khách hàng có quyền hủy đơn đặt dịch vụ và nhận lại khoản tiền hoàn cho phần dịch vụ chưa sử dụng. Trường hợp khách hàng đã sử dụng dịch vụ, sẽ không được hoàn tiền. 

-       Đối với phương tiện vận chuyển (Vé máy bay/ tàu lửa/ Xe khách...): thời gian khởi hành cho lựa chọn mới đúng hoặc chênh lệch +/- 3 tiếng so với giờ khởi hành ban đầu đã đặt dịch vụ. Hoặc dựa vào chính sách, quy định của nhà cung cấp tại thời điểm phát sinh.

Chúng tôi và các nhà cung cấp của chúng tôi sẽ nỗ lực hợp lý trong việc cập nhật Thông tin để đảm bảo thông tin được chính xác. Tuy nhiên, Thông tin của chúng tôi là do các nhà cung cấp Đặt phòng khách sạn cung cấp. Vì vậy:

Thông tin của chúng tôi có thể được thay đổi, bổ sung, sửa đổi hoặc xóa bất kỳ lúc nào, thông tin có thể không còn hoặc được thay đổi bất kỳ lúc nào mà không có thông báo và chúng tôi không chịu trách nhiệm pháp lý;

Chúng tôi khước từ toàn bộ trách nhiệm pháp lý về bất kỳ lỗi hay sự không chính xác nào liên quan đến Thông tin của chúng tôi (bao gồm nhưng không giới hạn ở giá Đặt phòng khách sạn, ảnh khách sạn, danh sách tiện nghi khách sạn và mô tả chung về khách sạn, …);

Chúng tôi không đảm bảo khả năng cung cấp của Đặt phòng khách sạn cụ thể;

Chúng tôi không cam đoan về tính phù hợp của Thông tin của chúng tôi cho bất kỳ mục đích nào;

Xếp hạng khách sạn hiển thị trong Thông tin của chúng tôi chỉ nhằm mục đích hướng dẫn chung dựa trên thông tin nhà cung cấp cập nhật và đánh giá khách quan, phù hợp từ khách hàng, chúng tôi không thể đảm bảo tính chính xác của các xếp hạng đó;

Khước từ mọi bảo đảm và điều kiện rằng Thông tin của chúng tôi, dịch vụ hay bất kỳ email nào mà chúng tôi gửi đều không chứa virus hay các thành phần độc hại khác và

Toàn bộ Thông tin và dịch vụ của chúng tôi đều được cung cấp “nguyên trạng” mà không có bất kỳ loại bảo đảm nào.

Chúng tôi công khai bảo lưu quyền sửa mọi lỗi về giá và/hoặc các Đặt phòng được thực hiện với mức giá không chính xác.Trong trường hợp như vậy, nếu có, Quý Khách sẽ có cơ hội giữ Đặt phòng với mức giá được sửa đổi hoặc quý vị có thể hủy đặt phòng mà không bị phạt tiền.

Western travel.com sẽ được miễn trừ nghĩa vụ cung cấp dịch vụ và bồi thường trong các trường hợp sau:

- Trong trường hợp bất khả kháng như thiên tai, chiến tranh, biểu tình, dịch bệnh hoặc các quyết định cấm đi/đến địa điểm cung cấp dịch vụ của các cơ quan quản lý nhà nước. 

Quý Khách được lựa chọn một trong các phương án nhà cung cấp thông báo, có thể là hủy đơn đặt dịch vụ, hoàn lại một phần hay toàn bộ phí; hoặc bảo lưu dịch vụ để sử dụng vào thời điểm khác (có phụ thu hoặc không) hoặc phương án khác. Western travel sẽ thông báo các phương án này để Quý khách lựa chọn. Trong tất cả các trường hợp, Western travel sẽ giữ lại phí dịch vụ của Western travel và không hoàn lại.

- Nếu có sự thay đổi lịch trình của các phương tiện vận chuyển công cộng như: tàu thuyền, tàu hỏa,.…theo thông báo từ phía nhà cung cấp, Western travel.com sẽ giữ quyền thay đổi lộ trình hoặc buộc phải thông báo hoãn hủy chuyến đi vì sự an toàn cho Quý khách.

- Chuyến bay/xe/tàu bị chậm, hủy theo thông báo của hãng hàng không/tàu/xe ngoài tầm kiểm soát của Western travel.com.

- Western travel.com không thông thông báo được cho hành khách về việc chậm, huỷ chuyến do hành khách không đăng ký địa chỉ hay thông tin liên lạc (email, số điện thoại); hoặc không liên hệ được với hành khách theo thông tin đã đăng ký.

- Miễn trừ bồi thường cho khách bị từ chối trong trường hơp lý do từ hành khách (như tình trạng sức khỏe, dịch bệnh, việc khách không tuân thủ đúng điều lệ/ hợp đồng vận chuyển/quy định của nhà chức trách…), theo yêu cầu của nhà chức trách, an ninh hàng không, ...

9.  Mức độ công bằng:

Chúng tôi luôn mong muốn giải quyết những đề xuất hoặc thắc mắc một cách nhanh chóng và công bằng nhất. Mọi ý kiến đóng góp xin gửi về Bộ Phận Chăm Sóc Khách Hàng:

- Văn phòng tại Hồ Chí Minh: Lầu 2, Tòa nhà Anh Đăng, 215 Nam Kỳ Khởi Nghĩa, Phường 7, Quận 3, Tp. Hồ Chí Minh, Việt Nam

- Văn phòng tại Hà Nội: P308, Tầng 3, tòa nhà The One, số 2 Chương Dương Độ, P.Chương Dương, Q.Hoàn Kiếm, Hà Nội, Việt Nam

- Văn phòng tại Cần Thơ: Tầng 7 - Tòa nhà STS - 11B Đại Lộ Hòa Bình, Phường Tân An, Quận Ninh Kiều, TP. Cần Thơ

- Điện thoại 1900 1870, hoặc gửi qua địa chỉ email TC@Western travel.com

10.    Bản quyền:

Những hình ảnh và nội dung trên Western travel.com là không được phép sao chép hoặc được sử dụng lại với bất kỳ phiên bản nào khác mà chỉ được sử dụng trên trang web của chúng tôi.

11.    Chung:

Tất cả những điều khoản và điều kiện được công nhận bởi pháp luật Việt Nam. Chúng tôi nhận những thanh toán từ khách sạn thành viên từ việc cung cấp dịch vụ phòng đặt phòng của chúng tôi. Mọi thắc mắc liên hệ Công ty VIVU để xác nhận đặt phòng qua email. Thông tin chi tiết của chúng tôi về cách thức xử lý thông tin cá nhân xin Quý Khách tham khảo Chính sách quyền cá nhân.

Các đặt phòng được đặt qua đối tác EAN sẽ tuân theo các điều kiện và điều khoản của đối tác, vui lòng xem tại đây.
                        </div>
                        <div class="tab-pane fade" id="v-pills-tichdiem" role="tabpanel" aria-labelledby="v-pills-tichdiem-tab" tabindex="0">
                            1. Thành viên Western travel.COM

Khách hàng đã Đăng ký Tài Khoản trên website Western travel.com hoặc app Western travel.com sẽ trở thành thành viên của Western travel.COM

2. Chính sách tích điểm thành viên Western travel.COM

Khách hàng được tích điểm thành viên khi sử dụng dịch vụ Đặt phòng khách sạn, Combo du lịch và Tour du lịch tại Western travel.com. Dịch vụ vé máy bay và các dịch vụ khác không được tích điểm thành viên.

Mỗi 100,000VNĐ (một trăm ngàn đồng) chi tiêu cho các dịch vụ tại Western travel nêu trên sẽ quy đổi thành 01 (một) điểm thành viên 

Điểm thành viên chỉ được tính sau khi khách hàng sử dụng dịch vụ (trả phòng/kết thúc tour). Khách hàng cần tạo tài khoản trên website/app Western travel để nhận được điểm thành viên. 

Western travel.COM có quyền thay đổi chính sách bất cứ lúc nào và không cần thông báo trước.

3. Chính sách sử dụng điểm

Điểm thành viên được dùng để giảm giá cho các đơn hàng mà thành viên đặt lại tại Western travel bao gồm tất cả các dịch vụ mà Western travel đang cung cấp kể cả vé máy bay lẻ.

Mỗi điểm thành viên sử dụng được quy đổi thành 1,000VNĐ (một ngàn đồng) giảm giá booking.

Điểm thành viên chỉ được áp dụng cho các đơn hàng đặt lại bởi chính thành viên đó.

Trường hợp hủy/thay đổi đơn hàng, điểm không được hoàn lại.

4. Thời hạn sử dụng điểm thành viên

Điểm thành viên tích lũy trong năm sẽ có thời hạn sử dụng trong 1 năm tới. Theo đó, điểm thành viên tích lũy trong năm 2023 sẽ hết hạn vào ngày 31/12/2024.

Lưu ý: Điểm thành viên tích lũy từ các năm trước 2022 đã hết hạn vào ngày 31/12/2023.
                        </div>
                        <div class="tab-pane fade" id="v-pills-hotro" role="tabpanel" aria-labelledby="v-pills-hotro-tab" tabindex="0">
                            Giá Phòng

                            2. Giá công bố là giá sau khi đã tính tất cả các phí phải không?
                            
                            Giá công bố là giá khách sạn đưa ra cho các khách hàng đặt trực tiếp tại khách sạn. Giá này sẽ cao hơn 20-30% so với giá dành cho khách hàng đặt trực tuyến qua Western travel.com.
                            
                            3. Chúng tôi có được giảm giá nếu đặt số lượng phòng nhiều không?
                            
                            Giá đăng trên Western travel.com là giá đã được niêm yết và là giá ưu đãi Western travel.com dành cho khách hàng. Tuy nhiên nếu bạn muốn đặt phòng với số lượng lớn, Western travel.com sẽ cố gắng thương lượng với phía khách sạn và đưa ra giá hợp lí. Chúng tôi cũng có chương trình Thẻ VIVU  giúp bạn càng đặt nhiều, tiết kiệm càng lớn.
                            
                             
                            
                            Đặt Phòng
                            
                            4. Đặt phòng tại Western travel.com tôi được lợi/tiền/quà tặng gì không?
                            
                            Rất nhiều! Đây là một lợi thế của Western travel.com so với các hình thức đặt phòng khác. Bạn có thể trở thành khách hàng thân thiết của Western travel.com, nhận nhiều lợi ích giảm giá, tích điểm, quà may mắn hay tham gia các chương trình khuyến mại thường xuyên của chúng tôi. Hãy vào facebook của Western travel.com  nhé.
                            
                            5. Tôi muốn đặt phòng cho tập thể hoặc cho gia đình từ 4 người nhưng tôi không biết tìm nhanh ở đâu. Phải xem từng loại phòng từng khách sạn thật mất thời gian!
                            
                            Bạn có thể tham khảo danh sách các khách sạn tốt nhất cho gia đình trên Cùng VIVU , hay gọi đến đường dây nóng 1900 1870 của Western travel.com để được hỗ trợ cụ thể.
                            
                             
                            
                            Thay Đổi Thông Tin Đặt Phòng
                            
                            6. Tôi có thể thay đổi các thông tin khách hàng như: địa chỉ email và điện thoại được không?
                            
                            Tất nhiên. Hãy liên hệ với bộ phận Chăm Sóc Khách Hàng của chúng tôi!
                            
                            7. Việc thay đổi hay hủy phòng có dễ dàng không? Có tốn phí không?
                            
                            Trường hợp bạn muốn hủy phòng sau khi thanh toán, việc hoàn tiền sẽ tùy thuộc vào chính sách hủy phòng của từng khách sạn hay điều kiện các chương trình khuyến mại. Bạn cần kiểm tra kỹ chính sách này trước khi đặt phòng.
                            
                            Phần lớn trường hợp, tiền sẽ dễ dàng được hoàn lại tài khoản của bạn sau 03 ngày làm việc, sau khi đã trừ đi 20.000VND phí quản trị.
                            
                            Nếu bạn muốn hủy đặt phòng, xin làm theo hướng dẫn sau:
                            1. Kiểm tra Chính sách hủy phòng của khách sạn được công bố trên website, đặc biệt là thời hạn chấp nhận hủy đặt phòng. Bạn cũng có thể tham khảo Chính sách hủy phòng trên email xác nhận đặt phòng.
                            2. Gọi đến Trung tâm Chăm sóc Khách hàng (Hotline: 1900 1870) để thông báo hủy đặt phòng. Vui lòng cung cấp số đặt phòng để chúng tôi có thể hỗ trợ nhanh chóng.
                            3. Chúng tôi sẽ gửi email xác nhận việc hủy đặt phòng và phí hoàn trả.
                            
                             
                            
                            Thanh Toán
                            
                            8. Tại sao tôi không được thanh toán trực tiếp tại khách sạn?
                            
                            Khi đặt phòng với Western travel.com , bạn sẽ nhận được giá ưu đãi hơn khi đặt trực tiếp với khách sạn. Theo điều kiện hợp tác giữa khách sạn và Western travel.com, khoản thanh toán này sẽ giúp cung cấp một dịch vụ hoàn hảo và an tâm nhất cho bạn trước mỗi chuyến đi.
                            
                            9. Chúng tôi có thể đặt cọc trước 50% số tiền cần thanh toán cho khách sạn được không?
                            
                            Rất tiếc, bạn sẽ phải thanh toán 100% tiền phòng cho Western travel.com để đảm bảo đặt phòng. Đến khi nhận phòng, bạn sẽ không phải trả thêm khoản phí nào (trừ các dịch vụ cá nhân).
                            
                            10. 24 tiếng thanh toán tiền phòng ngay rất gấp gáp cho chúng tôi. Chúng tôi đặt phòng trực tiếp tại khách sạn qua điện thoại rồi đến đó thanh toán tiện lợi hơn nhiều.
                            
                            Thanh toán tại khách sạn sẽ rất khó đảm bảo khách sạn còn giữ phòng cho bạn, nhất là cuối tuần hay mùa cao điểm. Vì vậy, Western travel.com có nhiều hình thức thanh toán linh động và thuận tiện. Với lượng đặt phòng khá cao mỗi ngày và tình trạng phòng thay đổi, chúng tôi chỉ có thể cam kết giữ phòng chính thức khi đơn đặt phòng được thanh toán đúng hạn.
                            
                            11. Western travel.com có phương thức thanh toán nào ngoài thẻ tín dụng không?
                            
                            Western travel.com cung cấp nhiều phương thức thanh toán đa dạng so với các website khác hiện nay. Bạn có thể chọn các cách thanh toán sau:
                            • Thẻ tín dụng/Thẻ ghi nợ
                            • Thẻ ATM
                            • Trả sau
                            • Văn phòng Western travel.com
                            • Các điểm giao dịch ACB
                            • Chuyển khoản trực tuyến
                            
                            12. Tôi có phải trả phí chuyển tiền khi chọn phương thức thanh toán chuyển khoản qua ngân hàng ACB không?
                            
                            Không. Bạn sử dụng hệ thống Smartlink cũng không bị tính phí.
                            Nếu bạn chuyển khoản qua VCB thì có một khoản phí nhỏ là 11.000VND. Chúng tôi đang làm việc với VCB về vấn đề này.
                            
                             
                            
                            Xác Nhận Thông Tin
                            
                            13. Sau khi chúng tôi thanh toán thành công, chúng tôi sẽ có xác nhận gì từ cty?
                            
                            Khi bạn thanh toán thành công, Western travel.com sẽ gửi đến bạn Giấy xác nhận đặt phòng chính thức qua email. Giấy xác nhận này đảm bảo khách sạn có phòng cho bạn khi bạn đến nơi. Đồng thời, bạn cũng sẽ nhận được tin nhắn thông báo “ Đặt phòng thành công” qua số điện thoại bạn cung cấp.
                            
                            14. Tại sao trên xác nhận đặt phòng không có con dấu, nhìn rất dễ bị làm giả. Mang đến khách sạn có gây khó dễ không?
                            
                            Bạn yên tâm! Các khách sạn và Western travel.com đã có liên kết và thống nhất về quy trình nhận phòng, đơn xác nhận đặt phòng bạn nhận được là hợp lệ khi làm thủ tục nhận phòng. Nếu muốn yên tâm hơn nữa, bạn có thể gọi 1900 1870 cho chúng tôi với số booking để được xác nhận cụ thể.
                            
                            Bảo Mật Thông Tin
                            
                            15. Thông tin cá nhân của tôi có được giữ kín không?
                            
                            Tất nhiên. Chúng tôi không tiết lộ bất kỳ thông tin của bạn ngoại trừ một số thông tin cần thiết cho các đối tác khách sạn để họ thực hiện việc đặt phòng. Để biết thêm chi tiết, vui lòng tham khảo chính sách riêng tư của chúng tôi.
                            
                            16. Quy trình thanh toán trực tuyến bằng thẻ tín dụng có an toàn không?
                            
                            Để loại trừ các trường hợp giả mạo thẻ tín dụng trên Internet, các chi tiết thẻ tín dụng của bạn được bảo vệ bằng cách sử dụng phương pháp mã hóa 128 bit. Để biết thêm chi tiết, vui lòng xem chính sách bảo mật của chúng tôi.
                            
                             
                            
                            Thông Tin Khác
                            
                            17. Tôi muốn biết xung quanh khách sạn có chỗ giải trí hay hàng ăn nào.
                            
                            Hãy gọi 1900 1870 cho chúng tôi. Nhân viên khách sạn nơi bạn ở cũng là người am hiểu địa phương và có thể tư vấn cho bạn.
                            
                            18. Tôi cần nhân viên CSKH Western travel.com như một người quản lý kỳ nghỉ riêng của gia đình tôi nên tôi cần cung cấp thông tin vé máy bay/tàu lửa/tàu cánh ngầm ngoài thông tin khách sạn.
                            
                            Hãy gọi 1900 1870, chúng tôi sẽ cố gắng hết sức cung cấp thông tin về việc đi lại cho bạn. Cho dù chuyên môn của Western travel.com vẫn là về các dịch vụ đặt phòng khách sạn nhé
                            
                            19. Tôi muốn mua voucher khách sạn từ Western travel.com (số tiền cụ thể) để tặng bạn bè hay người thân.
                            
                            Hãy gọi 1900 1870 để được tư vấn. Hiện tại chúng tôi đang triển khai chương trình voucher, giúp khách hàng sử dụng dịch vụ trên Western travel.com linh hoạt nhất.
                            
                            20. Tôi sẽ làm gì nếu khách sạn không thể cung cấp phòng khi tôi đến nhận phòng?
                            
                            Thật đáng tiếc nếu điều này xảy ra! Bộ phận Chăm sóc Khách hàng sẽ luôn hỗ trợ bạn trong mọi trường hợp. Chúng tôi sẽ yêu cầu khách sạn cung cấp phòng ngay. Nếu cần thiết, chúng tôi sẽ đặt phòng ở khách sạn khác, đảm bảo chuyến đi của bạn không bị gián đoạn.
                        </div>
                    </div>
                </div>
                
              </div>
        </div>
        
    </main>

    <footer>
        <section class="footer">
            <div class="container-fluid text-dark bg-body-secondary">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <h5 class="">Liên hệ</h5>
                            <ul class="footpanel">
                                <li><b>Địa chỉ: </b> ...</li>
                                <li><b>Số điện thoại: </b> ...</li>
                                <li><b>Email:</b> ...</li>
                                <li><b>Giờ làm việc:</b> 8h - 20h</li>
                            </ul>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 mx-5">
                            <ul class="footpanel">
                                <h5>Kết nối với chúng tôi qua</h5>
                                <li class="decor">
                                    <a href="#facebook" class="me-2"><i class="fab fa-facebook"
                                            style="color: #50bd60; font-size: 28px"></i></a>
                                    <a href="#instagram" class="me-2"><i class="bi bi-instagram"
                                            style="color: #50bd60; font-size: 28px"></i></a>
                                    <a href="#tiktok"><i class="bi bi-tiktok"
                                            style="color: #50bd60; font-size: 28px"></i></a>
                                </li>
                            </ul>
                            <ul class="footpanel">
                                <h5>Chấp nhận thanh toán</h5>
                                <img src="pic/vnpay-logo.jpg" alt="VNPAY" />
                            </ul>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <h5>Sản phẩm hiện tại</h5>
                            <ul class="footpanel"> 
                                <li><a href="index.php" class="text-dark">Tours</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script> -->
</body>

</html>