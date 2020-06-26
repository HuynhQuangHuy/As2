<!DOCTYPE html>
<html>
<body>

<h1>UPDATING DATA</h1>

<?php
ini_set('display_errors', 1);
echo "Update database!";
?>

<form name="update" action="UpdateCustomer.php" method="POST">
    <label for="customerid">customerid </label><input type="text" name="newcustomerid" placeholder="....."/><br>
    <label for="customername">newcustomername</label><input type="text" name="newcustomername" placeholder="....."/><br>
    <label for="phonenumber">newphonenumber</label><input type="text" name="newphonenumber" placeholder="....."/><br>
    <label for="address">newaddress</label><input type="text" name="address" placeholder="....."/><br>
    <input type="submit" value="update">
</form>

<?php


if (empty(getenv("DATABASE_URL"))){
    echo '<p>The DB does not exist</p>';
    $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=postgres', 'postgres', '123456');
}  else {
     
   $db = parse_url(getenv("DATABASE_URL"));
   $pdo = new PDO("pgsql:" . sprintf(
    "host=ec2-52-70-15-120.compute-1.amazonaws.com;port=5432;user=ipagxrlrkttaqn;password=31a531d7f814a0faeb9c471448dfb15bac415dc2700ede802a6d647562f51488;dbname=dnsl4ngqnktr0",
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
$sql = "update customer set customername = '$_POST[newcustomername]' where customerid = '$_POST[customerid]'";
$sql = "update customer set phonenumber = '$_POST[newphonenumber]' where customerid = '$_POST[customerid]'";
$sql = "update customer set address = '$_POST[newaddress]' where customerid = '$_POST[customerid]'";

      $stmt = $pdo->prepare($sql);
if($stmt->execute() == TRUE){
    echo "Record updated successfully.";
} else {
    echo "Error updating record. ";
}

?>
</body>
</html>
