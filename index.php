<!DOCTYPE html>
<html>
<head>
	<title>cloud note</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script type="text/javascript" src="../assets/jquery/jquery-2.1.1.js"></script>
</head>
<body>
	<p>note</p>
	<button id="btn_add">add</button>
	<p>keyword:</p>
	<input type="text" id="keyword" name="keyword" autofocus="autofocus" placeholder="inpur your keywords..."/>
	<button id="btn_search">search</button>
	<div id="div_table"></div>
	<div id="div_add">
		title:<input type="text" id="title" placeholder="title..."/>
		<p>
		content:<textarea id="content" rows="4" placeholder="content..."></textarea>
		<p>
		<button id="btn_submit">submit</button> 
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#btn_search").click(function(){
				var keyword=document.getElementById("keyword").value;
				$.ajax({
					type:'post',
					url:'api.php?action=search',
					data:{'keyword':keyword},
					success:function(data){					
						console.log(data);
						handle_json(data);// alert(data.data);
					},
					error:function(data, status, e){
						alert('ajax error!'+data+status+e);
					},
					dataType:'json',
				});
			});

			$("#btn_submit").click(function(){
				var title=document.getElementById("title").value;
				var content=document.getElementById("content").value;
				var add_time=getFormatDate();
				var screen=get_screen();
				alert(getFormatDate());
				$.ajax({
					type:'post',
					url:'api.php?action=add',
					data:{"title":title,"content":content,"add_time":add_time,"screen":screen},
					success:function(data){					
						console.log(data);
						alert('add success~~');
					},
					error:function(data, status, e){
						alert('ajax error!'+data+status+e);
					},
					dataType:'json',
				});
			});
		});
	function handle_json(data){
		var str;
		if(data.num==0){
			str='query num is '+data.num;
		}else{
			str ="<table border=\"1px\"><thead><tr><th>ID</th><th>标题</th><th>内容</th><th>时间</th></tr></thead><tbody>";
		     $.each(data,function(index,element){
		      str +="<tr><td>"+element['id']
				  +"</td><td>"+element['title']
		          +"</td><td>"+element['content']
		          +"</td><td>"+element['add_time']
		          +"</td></tr>";
			});
		}
		$('#div_table').html(str+"</tbody></table>");
	}
	
	function getFormatDate() {
		var date = new Date();
		var month = date.getMonth() + 1;
		var strDate = date.getDate();
		var hour=date.getHours();
		var minute=date.getMinutes();
		var second=date.getSeconds();
		if (month >= 1 && month <= 9) {
			month = "0" + month;
		}
		if (strDate >= 0 && strDate <= 9) {
			strDate = "0" + strDate;
		}
		if (hour >= 0 && hour <= 9) {
			hour = "0" + hour;
		}
		if (minute >= 0 && minute <= 9) {
			minute = "0" + minute;
		}
		if (second >= 0 && second <= 9) {
			second = "0" + second;
		}
		var currentDate = date.getFullYear() + "-" + month + "-" + strDate+ " " + hour + ":" + minute + ":" + second;
		return currentDate;
	}
	function get_screen(){
		return window.screen.width+"*"+window.screen.height;
	}
			</script>
</body>
</html>











