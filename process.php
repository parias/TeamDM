<?php   

    $url = $_POST["url"];
   
    $mystring = exec("python wordExtract.py $url", $output, $val);
    
$count = 0;   
echo "<table border='1'>";
  
    echo "<tr>";
    foreach($output as $word){ 
      echo "<td> ".$word."</td>";
	
      $count = $count + 1;
    }
    echo "</tr>";

 
echo "</table>";  

echo "<table border='1'>";

    echo "<thead><tr><td align='center'>Domain</td><td>Worth</td></tr></thead>";
    echo "<tr><td>".$url."</td><td>null</td></tr>";

echo "</table>";


#Database connection
$servername = "localhost";
$username = "root";
$password = "weather";
$dbname = "TeamDM";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "insert into DomainNameSplit (domainName";
$wordString = "";
for($i=1; $i<=9;$i++){
  $wordString .= ", word".$i;
}
$sql .= $wordString . ") values (\"" . $url . "\", ";

$value = "";
$temp = 0;
for($j=0;$j<8;$j++){
  $value .= "\"".$output[$j] ."\", ";
  $temp = $j+1;
}
$value .= "\"".$output[$j] . "\");";

$sql .= $value;
#echo $sql;

#check if domain in tables
#$sql = "select * from table
#f ($conn->query($sql) === TRUE) {
#    echo "\nNew record created successfully";
#} else {
#    echo "Error: " . $sql . "<br>" . $conn->error;
#}


#SQL to insert new Domain name
$sql = "insert into Domain(domain_id, domain) values (";
$sql .= "uuid(), \"" . $url . "\");";
echo $sql;

if ($conn->query($sql) === TRUE) {
    echo "\nNew record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

#SQL to insert Synonyms into Table
#foreach($output as $word){
#$sql = "insert into Words(word_id, domain id, word) values (";
#$sql .= "(1, 1, " 

#if($conn->query($sql) === TRUE){
#  echo "\nNew record crated successfully";
#} else {
#  echo "Error: " .$sql . "<br> " . $conn->error;
#}


#}
$conn->close();




?>



