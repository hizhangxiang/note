<?php
	$conn = @mysql_connect("localhost", "root", "root") or die("query error");
	mysql_select_db("data", $conn);
	mysql_query("set names 'UTF8'"); 
		
	if(isset($_GET['action'])){
		$action=$_GET['action'];
		switch($action){
			case 'search':
				search($conn);
				break;
			case 'add':
				add($conn);
				break;
		}
	}
	
	function add($conn){
		if(isset($_POST['title'])&&isset($_POST['content'])&&isset($_POST['add_time'])){
			$title=$_POST['title'];
			$content=$_POST['content'];
			$add_time=$_POST['add_time'];
			$sql="insert into note(id,title,content,add_time) values('','$title','$content','$add_time');";
			$result=mysql_query($sql,$conn);
			if($result){
				$array=array(
					'action'=>'add',
					'msg'=>'success',
					'return'=>$result);
				echo json_encode($array);
			}
			else{
				$array=array(
					'action'=>'add',
					'msg'=>'fail',
					);
				echo json_encode($array);
			}
		}
		
	}
	
	function search($conn){
		if(isset($_POST['keyword'])){
			$keyword=$_POST['keyword'];
			$sql="select * from note where title like '%$keyword%' or content like '%$keyword%' order by add_time desc;";
			$result=mysql_query($sql,$conn);
			if(mysql_num_rows($result)!=0){
				while($dataset=mysql_fetch_array($result)){
					$array[]=$dataset;			
				}
				echo json_encode($array);
			}else{
				$num=mysql_num_rows($result);
				$array=array('action'=>'search',
							 'msg'=>'success',
							 'num'=>$num);
				echo json_encode($array);
			}
		}
	}

	
	