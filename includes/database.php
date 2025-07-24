<?php
$db_serverr = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "association";
try {
    //$conn = new PDO("mysql:host=$db_serverr;dbname=$db_name", $db_user, $db_password);
    //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn = mysqli_connect(
        $db_serverr,
        $db_user,
        $db_password,
        $db_name
    );
} catch (mysqli_sql_exception) {
    echo "Connection echoue <br> ";
}

?>
<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'association');
// definition de DNS (data source name) de connecxion

$dns = "mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME;
// Create a connection
try {
    $conn = new PDO($dns, DB_USERNAME, DB_PASSWORD);
    //  PDO erreu mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// methode de recuperation des donnees (fetch)
$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
?>