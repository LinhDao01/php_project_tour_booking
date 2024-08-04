
use basicthesis;

SET SQL_SAFE_UPDATES = 0; /* tắt chế độ an toàn*/


create table roles (
	rID int primary key,
    rName varchar(100)
);

create table users (
	uID int AUTO_INCREMENT primary key,
    uName varchar(100),
    uPhone varchar(10) unique,
    uEmail varchar(100) unique,
    uPass varchar(100),
    uRole int default 0,
    uImg varchar(255) default 'user_ava.jpg',
    uActive bit default 1, /*xóa hoạt động của tk*/
    
    foreign key (uRole) references roles(rID)
);

alter table users add uPoint int default 0;

select * from users;
select count(*) as total_t from tours;
select count(*) as total_t from tours where tsoft_del = b'0';
SELECT uPoint FROM users where uID = 8;
create table type_tour (
	ttID int AUTO_INCREMENT primary key,
    ttName varchar(255)
);

create table tinh (
	tiID int AUTO_INCREMENT primary key,
    tiName varchar(50) unique

);

/*ID tim cach tu sinh*/ /* dữ liệu k thay đổi */
create table tours (
	tID int AUTO_INCREMENT primary key,  
    tName varchar(255) unique not null, 
    ttID int, /* loại tour */
    tTicket int, /*số lượng vé của tour*/
    tDesc text,  
    tPrice_al decimal(10,0), /*sô tiền theo loại vé */ 
    tPrice_kid decimal(10,0), /*sô tiền theo loại vé */ 	
    tPrice_child decimal(10,0), /*sô tiền theo loại vé */ 
    tTransport varchar(2000),
    tDay varchar(50) not null, /* thời gian của tour */
    tStay varchar(2000), /* địa điểm ở lại */
    tPic varchar(1000), /*tên của ảnh đầu trang*/ 
    tPlace varchar(100), /* nơi khởi hành*/
    tiID int,
								
    foreign key (ttID) references type_tour(ttID),
    foreign key (tiID) references tinh(tiID) 
);

alter table tours add tsoft_del bit default b'0';

select * from tours ;
-- drop table tours;
/*ID tim cach tu sinh*/  /*dữ liệu sẽ thay đổi*/

create table tour_date (
	tdID int AUTO_INCREMENT primary key, 
    tID int,
    tStart date not null, /* ngày khởi hành */
    tEnd date not null, /* ngày kết thúc*/
    
    foreign key (tID) references tours(tID) on delete cascade /* xóa cha thì con tự xóa */
);

create table tour_schedule (
	tsID int AUTO_INCREMENT primary key,
    tID int, 
    tsDay varchar(1000) not null, /* số tt ngày của lịch trình (head title*/
    tsDesc text,  /* mô tả ngày của lịch trình (content) */
    
    foreign key (tID) references tours(tID) /* xóa cha thì con tự xóa */
);

drop table tour_schedule;
select * from tour_schedule
where tID = 1;



create table booking (
	bID int AUTO_INCREMENT primary key,
    uID int, /* người đặt tour*/
    tdID int, /* thông tin ngày khách đặt*/
    bName varchar(100) not null,
    bEmail varchar(100),
    bPhone varchar(10) not null,
    bNote text(1000), 
    bTicketNum int, /* tổng số lượng vé */
    bTick_al int not null, 
    bTick_kids int, 
    bTick_child int,
    bTotal decimal(10,0),
    bVoucher varchar(100) default null, /*voucher khách dùng */
    bStatus bit default 0, /*đã đc xác nhận hay chưa */
    
    foreign key (tdID) references tour_date(tdID) on delete cascade, /* xóa cha thì con tự xóa */
    foreign key (uID) references users(uID)
    
);

create table suggest_tour (
	stID int AUTO_INCREMENT primary key,
    uID int, 
	stTitle varchar(255) not null,
    stContent varchar(2000) not null,
    
    foreign key (uID) references users(uID)
);

create table advise (
	aID int AUTO_INCREMENT primary key,
    tID int, 
    aName varchar(100) not null,
    aPhone varchar(10) not null,
    aEmail varchar(100),
    aNote varchar(1000),
    aStatus bit, 
    
    foreign key (tID) references tours(tID)
);

create table review (
	rID int AUTO_INCREMENT primary key,
    tID int,
    uID int,
    rContent text,
    rDate date,
    
    foreign key (uID) references users(uID),
    foreign key (tID) references tours(tID)
);


/* ---------------------------------------select table--------------------------------------- */
select * from roles;
select * from users;
select * from type_tour;
select * from tinh;
select * from tours;
select * from tour_date;
select * from tour_schedule; /* lịch trình */
select * from booking;
select * from suggest_tour;
select * from advise;
select * from review;

SELECT tt.* FROM type_tour tt;

SELECT t.*, IFNULL(SUM(b.bTicketNum), 0) AS total_ticket,
       0 AS total
FROM type_tour tt
LEFT JOIN tours t ON tt.ttID = t.ttID
LEFT JOIN tour_date td ON t.tID = td.tID
LEFT JOIN booking b ON td.tdID = b.tdID
GROUP BY t.tID

UNION ALL

select t.*, 0 AS total_ticket, 
       IFNULL(SUM(b.bTotal), 0) AS total
FROM type_tour tt 
LEFT JOIN tours t ON tt.ttID = t.ttID
LEFT JOIN tour_date td ON t.tID = td.tID
left join booking b on td.tdID = b.tdID
where tsoft_del = b'0'
GROUP BY t.tID;
    
SELECT tt.*, IFNULL(SUM(bTotal), 0) AS total
FROM type_tour tt
LEFT JOIN tours t ON tt.ttID = t.ttID
LEFT JOIN tour_date td ON t.tID = td.tID
LEFT JOIN (
    SELECT tdID, SUM(bTotal) AS totalPrice
    FROM booking
    GROUP BY tdID
) b ON td.tdID = b.tdID
GROUP BY tt.ttID;
    
select * from booking b
left join tour_date td on b.tdID = td.tdID
left join tours t on t.tID = td.tID;

/* ---------------------------------------drop table--------------------------------------- */
drop table review;
drop table advise;
drop table suggest_tour;
drop table booking;
drop table tour_schedule;
drop table tour_date;
drop table tours;
drop table tinh;
drop table type_tour;
drop table users;
drop table roles;


/* ---------------------------------------insert into---------------------------------------*/
select * from users;
select * from roles;
drop table users;
insert into roles
values ('0', 'User');
insert into roles 
values ('1', 'Admin');
insert into roles
values ('2', 'Staff');

/* users */
insert into users (uName, uPhone, uEmail, uPass, uRole, uActive)
values ('Linh', '0541272983', 'linh@gmail.com', '123',  '0', B'1');
insert into users (uName, uPhone, uEmail, uPass, uRole, uActive)
values ('Neko', '0546468483', 'neko@gmail.com', '123',  '1', B'1');
insert into users (uName, uPhone, uEmail, uPass, uRole, uActive)
values ('Nagi', '0369342352', 'nagi@gmail.com', '123',  '2', B'1');

update users
set uImg = 'user_ava.jpg'
where uID = 1;

DELETE FROM users WHERE uID = 13;


/* type_tour*/
insert into type_tour (ttName)
values ('Tour Du Lịch Hành Hương');
insert into type_tour (ttName)
values ('Tour Du Lịch Mùa Hè');
insert into type_tour (ttName)
values ('Tour Du Lịch Lễ 30/04');

select * from type_tour;

/* tinh*/
insert into tinh (tiName)
values ('Cần Thơ');
insert into tinh (tiName)
values ('Vĩnh Long');
insert into tinh (tiName)
values ('Bạc Liêu');
insert into tinh (tiName)
values ('Sóc Trăng');
insert into tinh (tiName)
values ('Cà Mau');

select * from tinh;

select * from tours;

select * from tour_schedule;

SELECT * FROM tours t left join tour_date td
on t.tID = td.tID
WHERE t.tID = 2 AND td.tStart > CURDATE();

/* tours */

insert into tours (tName, ttID, tTicket, tDesc, tPrice_al, tPrice_kid, tPrice_child, tTransport, tDay, tStay, tPic, tPlace, tiID)
values (
'Miền Tây 2N2Đ: Cà Mau - Cha Diệp - Sóc Trăng Cánh Đồng Quạt Gió', 
'1', '28', 
'Khám phá sự đa dạng của Miền Tây sông nước qua Cà Mau, Cha Diệp, Sóc Trăng và cánh đồng quạt gió. Hành trình bắt đầu từ HCM, đưa bạn đến 
với nhà thờ Cha Diệp, nhà công tử Bạc Liêu, và Điểm Cực Nam của Tổ Quốc. Trải nghiệm sâu sắc văn hóa và thiên nhiên, cùng thưởng thức đặc 
sản địa phương, mang lại cái nhìn toàn diện về cuộc sống miền Tây​​.',  	
'2500000.0',
2000000.0, 
0,
'- Xe Limousine 28c chỗ: Mỗi đợt từ 25 – 28 khách khách/đợt.
Trường hợp không đủ số lượng khách thì được dời sang lịch khởi hành tiếp theo, đón khách theo chương trình.
Trường hợp đường xấu do ảnh hương của thời tiết, đoàn sẽ đi Cano xuống Đất Mũi: Chi phí tự túc: 200000.0đ/khách.',
'2 ngày 2 đêm' ,
'Khách sạn 5 sao, Phòng: 2-3 khách/phòng',
'chua-som-rong.gif',
'Hồ Chí Minh',
'5'
);
--  'Chương trình tour 

insert into tours (tName, ttID, tTicket, tDesc, tPrice_al, tPrice_kid, tPrice_child, tTransport, tDay, tStay, tPic, tPlace, tiID)
values (
'Tour Núi Bà Đen và Tòa Thánh Tây Ninh Trong Ngày', 
'1', '28', 
'Khám phá núi Bà Đen và Tòa Thánh Tây Ninh, hành trình ngày đưa du khách đến với vẻ đẹp kỳ vĩ và linh thiêng của miền đất Tây Ninh. 
Nổi bật với cáp treo hiện đại lên núi Bà, ngôi Đền Bà, Động Thanh Long và Tòa Thánh cổ kính - trái tim của Đạo Cao Đài, mỗi điểm đến đều 
chứa đựng những câu chuyện văn hóa và tâm linh phong phú. Tham quan chùa Gò Kén, và tận hưởng cảnh quan thiên nhiên hùng vĩ, mang về trải 
nghiệm đáng nhớ từ mảnh đất anh hùng này. ', 
'2500000.0',
2000000.0, 
0,
'Xe du lịch đa dạng chỗ ngồi (16, 29, 35, 45 chỗ) với trang bị máy lạnh, Tivi, tài xế vui vẻ và nhiệt tình, đảm bảo trải nghiệm thoải mái và an toàn suốt hành trình.',
'1 ngày',
'Khách sạn 5 sao, Phòng: 2-3 khách/phòng',
'chua-som-rong.gif',
'Hồ Chí Minh',
'5'
);

-- 'Chương trình tour

insert into tours (tName, ttID, tTicket, tDesc, tPrice_al, tPrice_kid, tPrice_child, tTransport, tDay, tStay, tPic, tPlace, tiID)
values (
'Tour Phú Quốc 3N2Đ: HCM - Phú Quốc - Câu Cá Lặn Ngắm San Hô - Grand World', 
'2', '28', 
'Chương trình tour Phú Quốc 3 ngày 2 đêm từ TP.HCM đưa du khách thăm quan các điểm nổi bật như Dinh Cậu, Vườn Tiêu, và trải nghiệm tại Grand World. Bên cạnh đó, du khách có thể lựa chọn trải nghiệm cáp treo Hòn Thơm hoặc tham quan các đảo đẹp với hoạt động lặn ngắm san hô. Chuyến đi này hưa hẹn sẽ mang lại cái nhìn sâu sắc về văn hóa và tự nhiên của Phú Quốc.​​.', 
'2500000.0',
2000000.0, 
0,
'- Xe Limousine 28c chỗ: Mỗi đợt từ 25 – 28 khách khách/đợt.
Trường hợp không đủ số lượng khách thì được dời sang lịch khởi hành tiếp theo, đón khách theo chương trình.
Trường hợp đường xấu do ảnh hương của thời tiết, đoàn sẽ đi Cano xuống Đất Mũi: Chi phí tự túc: 200000.0đ/khách.',
'2 ngày 2 đêm' ,
'Khách sạn 5 sao, Phòng: 2-3 khách/phòng',
'chua-som-rong.gif',
'Hồ Chí Minh',
'2'
);

/* chi tiết bảng tour*/
select * from tours;

/* tour_date */
update tour_date 
set tStart = '2024-05-7',
    tEnd = '2024-05-7'
where tdID = 1;
update tour_date 
set tStart = '2024-05-9',
    tEnd = '2024-05-9'
where tdID = 2;
update tour_date 
set tStart = '2024-05-11',
    tEnd = '2024-05-11'
where tdID = 3;
update tour_date 
set tStart = '2024-05-7',
    tEnd = '2024-05-9'
where tdID = 4;
update tour_date 
set tStart = '2024-05-7',
    tEnd = '2024-05-9'
where tdID = 5;
update tour_date 
set tStart = '2024-05-6',
    tEnd = '2024-05-8'
where tdID = 6;
update tour_date 
set tStart = '2024-05-10',
    tEnd = '2024-05-12'
where tdID = 7;
update tour_date 
set tStart = '2024-05-11',
    tEnd = '2024-05-13'
where tdID = 8;
update tour_date 
set tStart = '2024-05-15',
    tEnd = '2024-05-17'
where tdID = 9;

select * from tour_date;

-- ('2', '2024-04-30', '2024-04-30');
insert into tour_date (tID, tStart, tEnd)
values ('2', '2024-04-28', '2024-04-30');
insert into tour_date (tID, tStart, tEnd)
values ('2', '2024-05-01', '2024-04-30');
insert into tour_date (tID, tStart, tEnd)
values ('2', '2024-04-26', '2024-04-30');

insert into tour_date (tID, tStart, tEnd)
values ('1', '2024-04-30', '2024-04-30');
insert into tour_date (tID, tStart, tEnd)
values ('1', '2024-04-28', '2024-04-30');
insert into tour_date (tID, tStart, tEnd)
values ('1', '2024-05-01', '2024-04-30');
insert into tour_date (tID, tStart, tEnd)
values ('1', '2024-04-26', '2024-04-30');

insert into tour_date (tID, tStart, tEnd)
values ('3', '2024-05-05', '2024-05-08');
insert into tour_date (tID, tStart, tEnd)
values ('3', '2024-05-10', '2024-05-13');
insert into tour_date (tID, tStart, tEnd)
values ('3', '2024-05-11', '2024-05-14');
insert into tour_date (tID, tStart, tEnd)
values ('3', '2024-05-20', '2024-05-23');

select * from tour_date;


/* tour_schedule*/
insert into tour_schedule (tID, tsDay, tsDesc)
values (1, 'ĐIỂM ĐÓN:', 
'19h00: Đón khách tại 367 Tân Sơn, Phường 15, Quận Tân Bình
19h30: Đón khách tại Trường Đại Học Hồng Bàng, 03 Hoàng Việt, Phường 4, Quận Tân Bình.
20h00: Đón khách tại Nhà Văn Hóa Thanh Niên, 04 Phạm Ngọc Thạch, Phường Bến Nghé, Quận 1
20h30: Đón khách tại Bến xe Miền Tây, Phường An Lạc, Quận Bình Tân.');

insert into tour_schedule (tID, tsDay, tsDesc)
values (1, 'ĐÊM 1: HỒ CHÍ MINH – ĐẤT MŨI (NGHỈ ĐÊM TRÊN XE)', 
'19h00: Xe và Hướng Dẫn Viên đón quý khách tại điểm hẹn, khởi hành rời TP. HCM đi Cà Mau quý khách nghỉ đêm xe với nội thất và trang thiết bị tiện nghi, giúp quý khách có một giấc ngủ thật ngon.');


insert into tour_schedule (tID, tsDay, tsDesc)
values (1, 'NGÀY 1: ĐẤT MŨI- BẠC LIÊU ( ĂN SÁNG, TRƯA)', 
'Buổi sáng: 06h00: Đoàn dùng bữa sáng. Quý khách đặt chân lên mảnh đất “Cực nam của Tổ quốc”, ngắm mũi Cà Mau với khu rừng ngập mặn lớn thứ hai trên thế giới.  
Đoàn chụp hình lưu niệm tại Cột mốc tọa độ quốc gia, Panô biểu tượng mũi Cà Mau và Cột mốc Đường Hồ Chí Minh - điểm cuối Cà Mau Km2436 là điểm đến du lịch đánh dấu "điểm cuối cùng" trên chuyến hành trình trải dài cả quốc gia, đi qua 28 tỉnh, thành phố với chiều dài 3.183km. ');

SELECT * FROM tours t 
left join tour_schedule ts on t.tID = ts.tID ;
delete from tour_schedule
where tsID = 2;

insert into suggest_tour (uID, stTitle, stContent)
values (1, 'Các nơi ở Cần Thơ', 'Tôi muốn tham quan những di tích lịch sử như Mộ thủ khoa Bùi Hữu Nghĩa, nhà cổ, ...');
insert into suggest_tour (uID, stTitle, stContent)
values (5, 'Du lịch Vĩnh Long', 'Tôi muốn tham gia 1 chuyến đi trong ngày ở tỉnh Vĩnh Long');
insert into suggest_tour (uID, stTitle, stContent)
values (6, 'Tham quan Kiên Giang', 'Tôi muốn tham quan Kiên Giang trong ngày vì tôi không có nhiều thời gian');
insert into suggest_tour (uID, stTitle, stContent)
values (8, 'Khám phá Bạc Liêu', 'Tôi muốn tham quan Bạc Liêu trong ngày vì tôi muốn đi nhiều nơi khác nhau');
insert into suggest_tour (uID, stTitle, stContent)
values (9, 'Đi tham quan Kiên Giang nhưng trên đất liền', 'Tôi đã từng đi Phú Quốc nhưng giá cả lại quá đắt. Các bạn có thể tạo thêm tour giúp chúng tôi đi tham quan những nơi trên đất liền được không');

select * from suggest_tour;


select * from users;

SELECT ts.tsDay, ts.tsDesc 
FROM tours t
LEFT JOIN tour_schedule ts ON t.tID = ts.tID AND t.tID = 4
WHERE ts.tsId IS NOT NULL
ORDER BY ts.tsId ASC;
/* ---------------------------------------procedures--------------------------------------- */
delimiter \
/* assign cus*/
create procedure ASSIGN_CUS(
					uName varchar(100), 
					uEmail varchar(100), 
					uPass varchar(100)
)
begin
	insert into users (uName, uEmail, uPass)
	values (uName, uEmail, uPass);
end\

call ASSIGN_CUS ('haha','haha@gmail.com', '123')\

drop procedure ASSIGN_CUS\

/* staff account*/
create procedure ASSIGN_STAFF(
					In p_uName varchar(100), 
                    In p_uPhone varchar(10), 
					In p_uEmail varchar(100), 
					In p_uPass varchar(100), 
                    In p_uRole int
)
begin
	insert into users (uName, uPhone, uEmail, uPass, uRole)
	values (p_uName, p_uPhone, p_uEmail, p_uPass, 2);
end\

call ASSIGN_STAFF('Potter', 0943762341,'potter@gmail.com', '', 2)\
call ASSIGN_STAFF('Ron', 0852948593,'ron@gmail.com', '', 0)\
select * from users\

drop procedure ASSIGN_STAFF\

delete from users
where uID = 19\
/* change personal infomation*/

create procedure CHANGE_INFO (
			CName varchar(100),
			CPhone varchar(10),
			CEmail varchar(100)
)
begin
	update users
	set uName = CName, uPhone = CPhone
	where uEmail = CEmail;
    
end \

call CHANGE_INFO ('haha', '0896736422', 'haha@gmail.com')\
call CHANGE_INFO ('Khánh Linh', '0541272983', 'linh@gmail.com')\
select * from users\	



create procedure CHANGE_PASS (
				new_uID int, 
				New_uPass varchar(100)
                
)
begin 
	update users
	set uPass = New_uPass
	where uID = new_uID;
    
end\

CALL CHANGE_PASS(1, "12345")\

drop procedure CHANGE_PASS\

create procedure BOOKING_TOUR (
				BuID int,
                BtdID int, 
				BbName varchar(100) ,
				BbEmail varchar(100),
				BbPhone varchar(10),
                BbNote text(1000), 
				BbTicketNum int, /* tổng số lượng vé */
				BbTick_al int , 
				BbTick_kids int, 
				BbTick_child int, 
				BbTotal decimal(10,0), /* tổng số tiền */
                BbStatus bit
    )
begin
	insert into booking (uID, tdID, bName, bEmail, bPhone, bNote, bTicketNum, bTick_al, bTick_kids, bTick_child, bTotal, bStatus)
    values (BuID, BtdID, BbName, BbEmail, BbPhone, BbNote, BbTicketNum, BbTick_al, BbTick_kids, BbTick_child, BbTotal, 0);
end \

    select * from booking\
    drop procedure BOOKING_TOUR\
    
 create procedure SUGGEST (
				SuID int, 
				StTitle varchar(255) ,
				StContent varchar(2000) 
 )
 begin 
	insert into suggest_tour (uID, stTitle, stContent)
    values (SuID, StTitle, StContent);
 end \
 
 
 create procedure ADVISE (
				AtID int, 
				AName varchar(100),
				APhone varchar(10),
				AEmail varchar(100),
				ANote varchar(1000),
				AStatus bit
 )
 begin
	insert into advise(tID, aName, aPhone, aEmail, aNote, aStatus)
    values (AtID, AName, APhone, AEmail, ANote, AStatus);
 end \


CREATE PROCEDURE ADD_TOUR (
				tName VARCHAR(255),
                ttID INT,
				tTicket INT, 
				tDesc TEXT,
				tPrice_al DECIMAL(10,0), 
				tPrice_kid DECIMAL(10,0),
				tPrice_child DECIMAL(10,0),
				tTransport VARCHAR(2000),
				tDay VARCHAR(50), 
				tStay VARCHAR(2000),
				tPic VARCHAR(1000), 
				tPlace VARCHAR(100), 
				tiID INT
)
begin 
	insert into tours (tName, ttID, tTicket, tDesc, tPrice_al, tPrice_kid, tPrice_child, tTransport, tDay, tStay, tPic, tPlace, tiID, tsoft_del)
    values (tName, ttID, tTicket, tDesc, tPrice_al, tPrice_kid, tPrice_child, tTransport, tDay, tStay, tPic, tPlace, tiID, 0);
end\
drop procedure ADD_TOUR\
select * from tours\
delete from tours where tID = 4\


create procedure ADD_SCHEDULE (
				AtID int, 
				AtsDay varchar(1000), /* số ngày của lịch trình*/
				AtsDesc text
)
begin
	insert into tour_schedule (tID, tsDay, tsDesc)
    values (AtID, AtsDay, AtsDesc);
 
end \

call ADD_SCHEDULE (3, 'ĐÊM 1: TP. HCM - SÓC TRĂNG', '22h00 - 22h30: Xe và Hướng dẫn viên Công Ty Du Lịch đón khách tại điểm hẹn tập trung khởi hành đi Sóc Trăng. Quý khách thư giản, nghỉ ngơi trên xe.
Lưu ý: Theo thông báo số 14253/TB-SGTVT, TP. Hồ Chí Minh cấm xe Giường nằm vào trung tâm từ 06:00 đến 22:00. Mong Quý khách thông cảm và đồng hành cùng công ty.', '', '')\

select * from tours t 
left join tour_schedule ts
on t.tID = ts.tID\

drop procedure ADD_SCHEDULE\


/* xóa tour */
create procedure DEL_TOUR (
				DtID int
)
begin
	update tours 
    set tsoft_del = b'1'
    where tID = DtID; 

end \
drop procedure DEL_TOUR\
CALL DEL_TOUR (12)\
select * from tours\


create procedure ADD_TOURDATE (
				AtID int,
				AtStart date, /* ngày khởi hành */
				AtEnd date /* ngày kết thúc*/
)
begin 
	insert into tour_date (tID, tStart, tEnd)
    values (AtID, AtStart, AtEnd);
end \
call ADD_TOURDATE(12, '2024-05-10', '2024-05-11')\
select * from tour_date\

create procedure DEL_TOURDATE (
				AtdID int
)
begin
	delete from tour_date where tdID = AtdID;
end\

CALL DEL_TOURDATE(21)\

create procedure ADD_REVIEW (
				AtID int,
				AuID int,
				ArContent text,
				ArDate date
)
begin
	insert into review(tID, uID, rContent, rDate)
    values (AtID, AuID, ArContent, ArDate);
end\

call ADD_REVIEW(1,1,'Tour rất vui nhé!','2024-05-12')\

select * from review\

/* ---------------------------------------delete procedures--------------------------------------- */


