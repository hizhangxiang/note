<!DOCTYPE HTML>
<html>
<body>
keyword: <input type="text" name="fname" />
<button>search</button>
</body>
</html>
<?php
include("conn.php");

$keyword=str_replace("%","",$_GET['keyword']);
$keyword=str_replace("'","",$keyword);
if($keyword)
{
$SQL="SELECT * FROM `note` WHERE `title` LIKE '%$keyword%'
or content LIKE '%$keyword%'";
$result=mysql_query($SQL);
echo "</br>共查找到".mysql_num_rows($result)."条信息。</br></br>";
}
?>
<table border="1" cellpadding="1" cellspacing="0" bordercolor="#999999" bgcolor="#eeeeee">
<tr>
<td>序号ID</td> <td>姓名</td> <td>手机</td> <td>固话</td> <td>工作</td> 
</tr>
<?php
while($row=mysql_fetch_array($result)){

echo '<tr>';
echo "<td>".$row['id']."</td>";   //显示ID
echo "<td>".$row['title']." </td>";  //显示姓名
echo "<td>".$row['content']." </td>";  //显示姓名
echo "<td>".$row['add_time']." </td>";  //显示姓名
echo "<td>".$row['from']." </td>";  //显示姓名
echo '</tr>';

}?>
</table>
