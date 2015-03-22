Things to do:      updated:3/22
Add WordNet functionality
  -synonyms
find similar URLs
Add a list of URLs

<?php   

   $url = $_POST["url"];

   #splits words from url, $output is array of words  
   $mystring = exec("python wordExtract.py $url", $output, $val);

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
/*
   $sql = "INSERT INTO Domain(domain_id, domain, value) values (uuid(),'";
   $sql .= $url . "', NULL);";
   echo $sql;

   if ($conn->query($sql) === TRUE) {
      echo "\nNew record created successfully";
   } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
   }
*/

   #request UUID
   $sql = "SELECT domain_id from Domain where domain = '".$url."';";
   echo $sql;

   $result = $conn->query($sql); 
   while($row = $result->fetch_assoc()){
     $domainID =  $row['domain_id'];
     echo $domainID;
     echo $row['domain_id'];
   }

   echo "<br/>Domain ID: " . $domainID . "<br/>";   

   #removes the first array value, ie:array of all values  
   array_shift($output); 
 
   #inserts each word into Words Table database
/* works
   foreach($output as $word){
      echo "<br/>";
      $sql = "INSERT into Words(word_id,domain_id,word) VALUES(uuid(),'";
      $sql .= $domainID . "','".$word."');";
      echo $sql."<br/>";
      if ($conn->query($sql) === TRUE) {
         echo "\nNew record created successfully<br/>";
      } else {
         echo "Error: " . $sql . "<br>" . $conn->error."<br/>";
      }
   }
/*
   #Create Synonyms and insert into Synonyms table
   


#check if domain in tables

#SQL to insert Synonyms into Table


$conn->close();

?>



