<!DOCTYPE html>
<html>
<body>

<h1>Update DATA TO DATABASE</h1>

<?php
ini_set('display_errors', 1);
echo "Update database!";
?>

<form name="update" action="UpdateCustomer.php" method="POST"
      <label for="customerid"> Customerid</label><input type="text" name="customerid" placeholder="...."/>
      <label for="customername"> Customername</label><input type="text" name="newcustomername" placeholder="...."/><br>
      <label for="phonenumber"> Phone Number</label><input type="text" name="newphonenumber" placeholder="...."/><br>
      <label for="address"> Address</label><input type="text" name="newaddress" placeholder="...."/><br>
      
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
$sql = "UPDATE customer SET customername = '$_POST[newcustomername]' WHERE customerid = '$_POST[customerid]'";
$sql = "UPDATE customer SET phonenumber = '$_POST[newphonenumber]' WHERE customerid = '$_POST[customerid]'";
$sql = "UPDATE customer SET address = '$_POST[newaddress]' WHERE customerid = '$_POST[customerid]'";

      $stmt = $pdo->prepare($sql);
if($stmt->execute() == TRUE){
    echo "Record updated successfully.";
} else {
    echo "Error updating record. ";
}
    
?>
</body> 
</html>