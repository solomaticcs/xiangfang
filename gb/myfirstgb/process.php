<html>
<head>
	<title>基礎留言板V1</title>
	<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
@session_start();
include('../../indb.php');
$name = $_REQUEST['message_p'];
$name2 = $_REQUEST['message_p2'];
$time = $_REQUEST['time'];
$content = $_REQUEST['message_c'];
$no = $_REQUEST['no'];
$a1 = $_REQUEST['a1'];
$id = $_REQUEST['id'];
$pw = $_REQUEST['pw'];
$idc = $_SESSION['idc'];
$pwc = $_SESSION['pwc'];
$del = $_REQUEST['del'];
$delful = $_REQUEST['delful'];
$good = $_REQUEST['good'];
$regname = $_REQUEST['name'];

//發言
if($a1 == 1)
{
	$insert = "insert into reply values ((select max(no)+1 from reply),'$regname','$idc','$content','$time');";
	if($time != null && $content != null)
	{
		if($db->db_query($insert))
		{
			echo '輸入完成';
			echo '<meta http-equiv=REFRESH CONTENT=0;url=index.php>';
		}
		else
		{
			echo '輸入失敗';
			echo '<meta http-equiv=REFRESH CONTENT=0;url=index.php>';
		}
	}
	else
	{
		echo '請勿空白';
		echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';
	}
}
//回覆
else if($a1 == 2)
{
	$re1 = "select * from reply";
	$re2 = $db->db_query($re1);
	$re3 = $db->db_fetch($re2);
	$insert = "insert into reply2 values ((select max(no)+1 from reply2),'$no','$regname','$idc','$content','$time');";
	if($time != null && $content != null)
	{
		if($db->db_query($insert))
		{
			echo'回覆訊息成功';
			echo '<meta http-equiv=REFRESH CONTENT=0;url=index.php>';
		}
	}
	else 
	{
		echo'回覆訊息失敗-請輸入訊息';
		echo "<meta http-equiv=REFRESH CONTENT=2;url=recon.php?no=$re3[0]>";
	}
}

//案讚
else if($a1 == 12)
{
	$insert = "insert into good values ((select max(no)+1 from good),'$good','$regname','$idc','1','$time');";
	$select1 = "select * from good where no2 = '$good' and id = '$idc'";
	$select2 = $db->db_query($select1);
	$select3 = $db->db_fetch($select2);
	if($select3[3] != $idc)
	{
		if($db->db_query($insert))
		{
			echo '<meta http-equiv=REFRESH CONTENT=0;url=index.php>';
		}
		else
		{
			echo '按讚失敗';
			echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';
		}
	}
	else
	{
		if($_SESSION['idc']==null)
		{
			echo '請登入使用者！';
			echo '<meta http-equiv=REFRESH CONTENT=1;url=login.html>';
		}
		else
		{
			echo '你按過此留言讚了！';
			echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';
		}
	}
}
else
{
	echo '你無權進入該網頁！';
	echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
}
?>
</body>
</html>