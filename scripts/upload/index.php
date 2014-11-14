
<?php
error_reporting(0);
class upload
{
	function upload_image(){
		
		$userid=$_REQUEST['uid'];
		$pid=$_REQUEST['pid'];
		if($_FILES['upload_image']['name'] != ''){
		$destination="../images/";
		  $tempfile= $_FILES['upload_image']['tmp_name'];
		  $file= $_FILES['upload_image']['name'];
		  $file_path = "images/".$file;
           move_uploaded_file($tempfile,$destination.'/'.$file);       
                    
		$query="update tbl_user_profile set avatar='".$file_path."' where id=".$userid;
		  $q=mysql_query($query) or die(mysql_error());		
		  echo json_encode(array("grooveyak"=>1));
		}
		echo json_encode(array("grooveyak"=>0));
	}
}

$upload=new upload();
if(isset($_GET['task']))
{
	
	
	 $upload->$_GET['task']();
}
?>