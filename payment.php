<?php

 $orderID = $_POST['order_id'];
 $amount = $_POST['amount'];
 $nameCus = $_POST['customer_name'];

 echo "<img src='https://img.vietqr.io/image/MB-0344436724-compact2.png?amount=" . $amount . "&addInfo=Thanh toán booking ".  $orderID ."&accountName=". $nameCus ."' alt='' class='w-100 h-100'>";