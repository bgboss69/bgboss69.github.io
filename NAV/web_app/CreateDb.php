<?php

// call data by insert 
//require_once('./php/CreateDb.php');
$database = new CreateDb("Productdb","Producttb");
class CreateDb
{
        public $servername;
        public $username;
        public $password;
        public $dbname;
        public $tablename;
        public $con;


        // class constructor
    public function __construct( $dbname = "Newdb", $tablename = "Productdb", $servername = "localhost", $username = "root", $password = "" ){
    
      $this->dbname = $dbname;
      $this->tablename = $tablename;
      $this->servername = $servername;
      $this->username = $username;
      $this->password = $password;

      // create connection
        $this->con = mysqli_connect($servername, $username, $password);

        // Check connection
        if (!$this->con){
            die("Connection failed : " . mysqli_connect_error());
        }

        // query
        $sql = "CREATE DATABASE IF NOT EXISTS $dbname";

        // execute query
        if(mysqli_query($this->con, $sql)){

            $this->con = mysqli_connect($servername, $username, $password, $dbname);

            // sql to create new table
            $sql = " CREATE TABLE IF NOT EXISTS $tablename
                            (id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                             product_name VARCHAR (25) NOT NULL,
                             product_price FLOAT,
                             product_image VARCHAR (100),   
                             product_detail TEXT
                            );";

            if (!mysqli_query($this->con, $sql)){
                echo "Error creating table : " . mysqli_error($this->con);
            }

        }else{
            return false;
        }
    }


  

    // get product from the database
    public function getData(){
        $sql = "SELECT * FROM $this->tablename";

        $result = mysqli_query($this->con, $sql);

        if(mysqli_num_rows($result) > 0){
            return $result;
        }
    }


    public function searchData(){
        if (isset($_POST['submit-search'])) {
            $search = mysqli_real_escape_string($this->con, $_POST['search']);
            $sql = "SELECT * FROM $this->tablename WHERE product_name LIKE '%$search%' OR product_detail LIKE '%$search%'";
            $result = mysqli_query($this->con, $sql);
            $queryResults = mysqli_num_rows($result); 
            echo "There are $queryResults maching your search";
            if (mysqli_num_rows($result) > 0) {
                
                return $result;
            }
            else{
                echo "There is no results maching your search";
            }
        }
    }
}
?>       
<?php
// in seacrh.php
// $server = "localhost";
// $username = "root";
// $password = "";
// $dbname = "localhost";
// $conn = mysqli_connect($server,$username,$password,$dbname);
// $sql = "SELECT * FROM dbtable";





//  $server = "localhost";
//  $username = "root";
//  $password = "";
//  $dbname = "localhost";
//  $conn = mysqli_connect($server,$username,$password,$dbname);
//  $sql = "SELECT * FROM dbtable";
//  $result = mysqli_query($conn,$sql);   
//  $queryResults = mysqli_num_rows($result);    //get the rows of table
 
//  if($queryResults > 0){
//    while($row = mysqli_fetch_assoc($result)){ // get data by row and sub into row
//   echo " 
//           <div>
//           " . row['row_name'] . "
//           </div>
//            ";
//    }
//  }       
?>