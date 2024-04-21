<?php
/** tento soubor pridava do databaze uzivatele, 
 * zaroven vraci arr s hodnotami co je postreba v formulari vyplnit  */

 /**Statusy
  * - 1 - uzivatel neuvedl jmeno
  * - 2 - uzivatel neuvedl prijmeni
  * - 3 - enail neodpozi stavbe emailove adresy 
  * - 4 - heslo je moc kratke (musi byt alespon 8 znaku dlouhe)
  * - 5 - heslo neobsahuje male pismeno
  * - 6 - heslo neobsahuje cislici
  * - 7 - heslo neobsahuje velke pismeno
  * - 8 - heslo se nerovna s druhym heslem pro vertifikaci
  * - 9 - telefoni cislo obsahuje jine znaky nez cislice
  * - 10 - email uz v databazi existuje  
  *
  */


  
  $firstname = "";
  $middlename = "";
  $lastname = "";
  
  $password_hash = "";
  $countryCode = "";
  $phone = "";
  $position = "";
  $pass = "jkj";
  $sql = "";

  
$mysqli = require __DIR__ . "/database.php";
$conn = new mysqli($host, $username, $password, $dbname);
$status = array();

if (empty($_POST["firstname"])) {
    array_push($status,1);
}

if (empty($_POST["lastname"])) {
    array_push($status,2);
}

$email = $_POST["email"];
if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    array_push($status,3);
}else{
    $sql_check = "SELECT * FROM user2 WHERE email = '$email'";
    $fetch_check = mysqli_query($conn, $sql_check);
    if(mysqli_num_rows($fetch_check) != 0){
        array_push($status,10);
    }
}


if (strlen($_POST["password"]) < 8) {
    array_push($status,4);
}


if (!preg_match("/[a-z]/i", $_POST["password"])) {
    array_push($status,5);
}


if (!preg_match("/[0-9]/", $_POST["password"])) {
    array_push($status,6);
}

if (!preg_match("/[A-Z]/", $_POST["password"])) {
    array_push($status,7);
}

if ($_POST["password"] != $_POST["password_confirmation"]) {
    array_push($status,8);
}
if (strlen($_POST["phone"]) > 0) {
$g = isNumeric($_POST["phone"]);
}else{
    $g  =true;
}
if($g == false){
    array_push($status,9);
}

function isNumeric($str) 
{ 
    return ctype_digit($str); 
} 
if(count($status) == 0){
    $firstname = $_POST["firstname"];
    $middlename = $_POST["middlename"];
    $lastname = $_POST["lastname"];
    
    $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $countryCode = $_POST["countryCode"];
    $phone = $_POST["phone"];
    $position = $_POST["position"];
    if($phone == null){
        $phone = 000000000;
    }
    $sql = "INSERT INTO user2 (firstname, middlename, lastname, email, password_hash, countryCode, phone, position)
    VALUES ('$firstname','$middlename', '$lastname', '$email', '$password_hash',$countryCode, $phone ,'$position' )";
    if (!mysqli_query($conn, $sql)) {
        //die('Error: ' . mysqli_error($conn));
        //echo json_encode(mysqli_error($conn));
    }
}
echo json_encode($status);

?>