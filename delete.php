<?php 
   $conn=new mysqli('localhost','root','','image name_project');
   $id=$_GET["id"];
   $sql="DELETE fROM userdata WHERE id=$id";
   if($conn->query($sql)===TRUE){
    header("Location: index.php");
    exit(); 
   }
   else {
    echo "❌ Error: " . $conn->error;
}
$conn->close();
?>
