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
<h1>Đăng ký thành viên</h1>
<h2>Enter data into student table</h2>
<ul>
    <form name="InsertData" action="InsertProduct.php" method="POST" >
        <li>productid:</li><li><input type="text" name="productid"  required=/></li>
        <li>productname:</li><li><input type="text" name="productname" /></li>
        <li>price:</li><li><input type="text" name="price" /></li>
        <li>quantity:</li><li><input type="text" name="quantity" /></li>
        <li><input type="submit" value="Đăng kí" /></li>
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
$sql = "INSERT INTO product(productid, productname, price, quantity)"
        . " VALUES('$_POST[productid]','$_POST[productname]','$_POST[price]','$_POST[quantity]')";
$stmt = $pdo->prepare($sql);
//$stmt->execute();
 if (is_null($_POST[productid])) {
   echo "productid Không được thiếu.";
 }
 else
 {
    if($stmt->execute() == TRUE){
        echo "Đăng kí thành công. Vui lòng dùng customerid khi thanh toán.";
    } else {
        echo "Error inserting record: ";
    }
 }
?>
</body>
</html>