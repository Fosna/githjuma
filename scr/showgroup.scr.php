
<!DOCTYPE html>
<html>
<body>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hjuma";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
  die("Neuspjelo spajanje: " . mysqli_connect_error());
}

$sql = "SELECT id, name, description FROM groups";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<br> id: ". $row["id"]. " - Name: ". $row["name"]. " " . $row["description"] . "<br>";
    }
} else {
    echo "0 results";
}

$conn->close();
?>

</body>
</html>
