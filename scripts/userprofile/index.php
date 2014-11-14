<?php
error_reporting(0);
class userprofile
{

public function getalluser()
{
	   $query="select * from tbl_user_profile";
		$q=mysql_query($query);
	    while( $row=mysql_fetch_assoc($q))
		{
			$rows[]=$row;
		}
	  echo  json_encode(array("grooveyak"=>$rows));
		 
	 
}

public function checkloginuser()
{
	$username=$_REQUEST['username'];
	$password=md5($_REQUEST['password']);
	$active=1;
	
	   $query="select * from tbl_user_profile where username='".$username."' and password='".$password."' and active=".$active."";
		$q=mysql_query($query);
	    while( $row=mysql_fetch_assoc($q))
		{
			$rows[]=$row;
		}
	  echo  json_encode($rows); 
	 
}

public function registrationnewuser()
{
	
	$username=$_REQUEST['username'];
	$email=$_REQUEST['email'];
	$password=md5($_REQUEST['password']);
	//$avatar=$_REQUEST['avatar'];
	$active=$_REQUEST['active'];
	$date = date("Y-m-d H:i:s");
	
	 $select="select * from tbl_user_profile where email='".$email."'";
	$sq=mysql_query($select);
	 $num=mysql_num_rows($sq);
         
	 if($num==1)
	 {
		 echo json_encode(array("grooveyak"=>0));
	 }
	 else
	 {
             $query="insert into tbl_user_profile (username,email,password,active,created_at) 
    values('$username','$email','$password','$active','$date')";
            $q=mysql_query($query) or die(mysql_error());
             echo json_encode(array("grooveyak"=>1)); 
	 }

}

public function updateuserprofile()
{
	
	$username=$_REQUEST['username'];
	$email=$_REQUEST['email'];
	$password=md5($_REQUEST['password']);
	$avatar=$_REQUEST['avatar'];
	$active=$_REQUEST['active'];
	$date = date("Y-m-d H:i:s");
	
		 
$query="update tbl_user_profile set username='$username',avatar='$avatar',password='$password',updated_at='$date' where id=".$_REQUEST['uid']; 

$q=mysql_query($query) or die(mysql_error());
echo json_encode(array(1)); 
 
}

public function viewsingleuser()
{
	$userid=$_REQUEST['uid'];
	 $select="select * from tbl_user_profile where id='".$userid."'";
		$q=mysql_query($select);
	    while( $row=mysql_fetch_assoc($q))
		{
			$rows[]=$row;
		}

 echo  json_encode($rows);
 
		 
}


function upload_image(){
		$userid=$_REQUEST['uid'];
		 $select="select * from tbl_user_profile where id='".$userid."'";
	$sq=mysql_query($select);
	 $num=mysql_num_rows($sq);
         
	 if($num==1)
	 {
		 $image = $_REQUEST['image'];
		 $imgname = explode('/',$image);
	
		 $destination=realpath('.')."/images/".end($imgname);
		 copy($image,$destination);
		  $file_path = 'http://'.$_SERVER['SERVER_NAME'].'/grooveyak/images/'.end($imgname);
		 $query="update tbl_user_profile set avatar='".$file_path."' where id=".$userid;
		  $q=mysql_query($query) or die(mysql_error());		
		  echo json_encode(array("grooveyak"=>1));
         /*if($_FILES['upload_image']['name']!=''){
			 $rand='';
		  for($i=0;$i<5;$i++)
		  {
			  $rand.=rand(0,9);
		  }       
		
		  $destination="../images/";
		  $tempfile= $_FILES['upload_image']['tmp_name'];
		  $file= $rand.'_'.$_FILES['upload_image']['name'];
		  $file_path = "images/".$file;
		  
		  move_uploaded_file($tempfile,$destination.'/'.$file);

		  $query="update tbl_user_profile set avatar='".$file_path."' where id=".$userid;
		  $q=mysql_query($query) or die(mysql_error());		
		  echo json_encode(array(1));
		  */
		  
		  		  }else{
			  echo json_encode(array("grooveyak"=>0));	
		  }
		}

	
	
	function userstatus()
	{
		$uid=$_REQUEST['id'];	
		$select="select * from tbl_user_profile where id='".$uid."'";
		$sq=mysql_query($select);
	 	$num=mysql_num_rows($sq);
         
	 	if($num==1)
		{
			$query="update tbl_user_profile set active='".$_REQUEST['status']."' where id='".$uid."'";
			$q=mysql_query($query) or die(mysql_error());		
			echo json_encode(array("grooveyak"=>1));	
		}else{
		echo json_encode(array("grooveyak"=>0));		
		}
	}
	
        
}

$userprofile=new userprofile();
if(isset($_GET['task']))
{
	
	
	 $userprofile->$_GET['task']();
}
?>