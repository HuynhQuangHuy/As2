<!DOCTYPE html>
<html>
    <head>
<title>Insert data to PostgreSQL with php - creating a simple web application</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
li {
list-style: none;
}
</style>
</head>
<body>
<h1>Nhập hoá đơn</h1>
<h2>Enter data into receipt table</h2>
<ul>
    <form name="InsertData" action="InsertReceipt.php" method="POST" >
        <li>receiptid:</li><li><input type="text" name="receiptid"  required=/></li>
        <li>date:</li><li><input type="text" name="date" /></li>
        <li>customer:</li><li><input type="text" name="customer" /></li>
        <li><input type="submit" value="nhập" /></li>
</form>
</ul>

<?php

if (empty(getenv("DATABASE_URL"))){
    echo '<p>The DB does not exist</p>';
    $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=mydb', 'postgres', '123456');
}  else {
     
   $db = parse_url(getenv("DATABASE_URL"));
   $pdo = new PDO("pgsql:" . sprintf(
        "host=ec2-52-7-39-178.compute-1.amazonaws.com;port=5432;user=klkiodyeeoozkr;password=ae94a2076f4648fe1aa94b50d82109d7fb2eab5ff73bd21cecfe34f6fb217a1c;dbname=d4ncpltpdbuol8",
        $db["host"],
        $db["port"],
        $db["user"],
        $db["pass"],
        ltrim($db["path"], "/")
   ));
}  

if($pdo === false){
     echo "ERROR: Could not connect Database";
}

//Khởi tạo Prepared Statement
//$stmt = $pdo->prepare('INSERT INTO student (stuid, fname, email, classname) values (:id, :name, :email, :class)');

//$stmt->bindParam(':id','SV03');
//$stmt->bindParam(':name','Ho Hong Linh');
//$stmt->bindParam(':email', 'Linhhh@fpt.edu.vn');
//$stmt->bindParam(':class', 'GCD018');
//$stmt->execute();
//$sql = "INSERT INTO student(stuid, fname, email, classname) VALUES('SV02', 'Hong Thanh','thanhh@fpt.edu.vn','GCD018')";
$sql = "INSERT INTO receipt(receiptid, date, customer)"
        . " VALUES('$_POST[receiptid]','$_POST[date]','$_POST[customer]')";
$stmt = $pdo->prepare($sql);
//$stmt->execute();
 if (is_null($_POST[receiptid])) {
   echo "Customer ID Không được thiếu.";
 }
 else
 {
    if($stmt->execute() == TRUE){
        echo "Nhập hoá đơn thành công";
    } else {
        echo "Error inserting record: ";
    }
 }
?>
</body>
</html>