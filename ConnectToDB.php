<!DOCTYPE html>
<html>
    <style>
a:link, a:visited {
  background-color: #f44336;
  color: white;
  padding: 14px 25px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
}

a:hover, a:active {
  background-color: red;
}
</style>
<body>

<h1>DATABASE CONNECTION</h1>

<?php
ini_set('display_errors', 1);
echo "Hello Cloud computing class 0818!";
?>

<?php


if (empty(getenv("DATABASE_URL"))){
    echo '<p>The DB does not exist</p>';
    $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=mydb', 'postgres', '123456');
}  else {
     echo '<p>The DB exists</p>';
     echo getenv("dbname");
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

$sql = "SELECT productid, productname, price, quantity, (price*quantity) As total FROM product";
$stmt = $pdo->prepare($sql);
//Thiết lập kiểu dữ liệu trả về
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$resultSet = $stmt->fetchAll();
echo '<p>Students information:</p>';

?>
<style>
table {
  width:60%;
}
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
th, td {
  padding: 15px;
  text-align: left;
}

#t01 th {
  background-color: #FFCC66;
  color: black;
}
</style>
<a href="DeleteData.php">Cancel order</a>
<div id="container">
<table id="t01" class="table table-bordered table-condensed">
    <thead>
      <tr>
        <th>ProductID</th>
        <th>ProductName</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // tạo vòng lặp 
         //while($r = mysql_fetch_array($result)){
             foreach ($resultSet as $row) {
      ?>
   
      <tr>
        <td scope="row"><?php echo $row['productid'] ?></td>
        <td><?php echo $row['productname'] ?></td>
        <td><?php echo $row['price'] ?></td>
        <td><?php echo $row['quantity'] ?></td>
        <td><?php echo $row['total'] ?></td>
      </tr>
     
      <?php
        }
      ?>
    </tbody>
  </table>
</div>
</body>
</html>