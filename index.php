<?php



header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");



DEFINE ('DB_USER', 'root');
DEFINE ('DB_PASSWORD', '');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'mobileapp');



$operation=null;
$title=null;
$details=null;
$dotto=null;


/*extract the values submitted by the web client (HTML page) using $_GET for get method or $_POST in case post method
format is as follows: localhost:<portname>/foldername/index.php?operation=<value>&title=<value>&author=<value>
check if the parameter has been submitted in the query, then extract the corresponding values.
The empty checks can be delayed until the variable is required, but has been done for simplicity here.
*/
if(!empty($_GET['operation'])){
	$operation=$_GET['operation'];
}

if(!empty($_GET['title'])){
	$title=$_GET['title'];
}
if(!empty($_GET['jojo'])){
	$dotto=$_GET['jojo'];
}

if(!empty($_GET['author'])){
	$details=$_GET['author'];
	
	
}




if($operation == 1){
	if($title !=null ){
		$author_name = getAuthor($title);
		echo $author_name;
	}
	

}elseif($operation == 2){
	if($details!=null && $title!=null){
		
			insertRecord($title,$details,$dotto);
		
		
	}
}else{
	echo ("operation not defined. Specify value 1 or 2");
}



function getAuthor($title_){

	//the connection string object
	$conn = mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Could not connect to MySQL: '.mysqli_connect_error() );

	//variables which take null values
  	$book_details = null;
	$author_ = null;
  
	//SQL Query - the dot (.) is used for concatenation
  	$query = "SELECT * from books where title='".$title_."'";
	
	//Executing the query on the connection object, which returns a 		resultset
  	$result = mysqli_query($conn, $query);


  	//echo "<br>len $result->num_rows";
  	if($result){
    	while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
   		$author_ = $row['author'];
    	}

	}else{
		$author_ = "not found";
	}
	return $author_;
	$conn->close();
}

function insertRecord($title_, $details_,$date_){
	//t
	$conn = mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Could not connect to MySQL: '.mysqli_connect_error() );

	
	//$query = "INSERT INTO books (title, author)VALUES ('".$title_."', '".$author_."')";
  $query =  "INSERT INTO tblnews (title,notes,date) VALUES ('".$title_."','".$details_."','".$date_."')";
  
	//execute query on connection object (conn) and echo result
	
	if (mysqli_query($conn, $query)) {
		echo "New record created successfully";
	 } else {
		echo "Error: " . $query . "" . mysqli_error($conn);
	 }
	 
	 $title=null;
     $author=null;
	 $conn->close();
}
 $title=null;
     $author=null;
?>
