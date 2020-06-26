<!DOCTYPE html>
<html>
<body>

<h1>INSERT DATA TO DATABASE</h1>

<?php
ini_set('display_errors', 1);
echo "Update database!";
?>

<form name="update" action="UpdateData.php" method="POST"
      <label for="productid"> productid</label><input type="text" name="newproductid" placeholder="...."/>
      <label for="productname"> productname</label><input type="text" name="newproductname" placeholder="...."/><br>
      <label for="price"> price</label><input type="text" name="newprice" placeholder="...."/><br>
      <label for="quantity"> quantity</label><input type="text" name="newquantity" placeholder="...."/><br>
    <input type="submit" values="Update">
</form>

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

//$sql = 'UPDATE student '
//                . 'SET name = :name, '
//                . 'WHERE ID = :id';
// 
//      $stmt = $pdo->prepare($sql);
//      //bind values to the statement
//        $stmt->bindValue(':name', 'Lee');
//        $stmt->bindValue(':id', 'SV02');
        // update data in the database
//        $stmt->execute();

        // return the number of row affected
        //return $stmt->rowCount();
$sql = "UPDATE product SET productname = '$_POST[newproductname]' WHERE productid = '$_POST[productid]'";
$sql = "UPDATE product SET price = '$_POST[newprice]' WHERE productid = '$_POST[productid]'";
$sql = "UPDATE product SET quantity = '$_POST[newquantity]' WHERE productid = '$_POST[productid]'";
      $stmt = $pdo->prepare($sql);
if($stmt->execute() == TRUE){
    echo "Record updated successfully.";
} else {
    echo "Error updating record. ";
}
    
?>
</body> 
</html>