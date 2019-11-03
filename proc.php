<?php session_start();
include('indb.php');
$type = $_REQUEST['type'];//接受給的方法
$type2 = str_replace(array("\n","\t","\r","<javascript","<LINK","<br />","<br>","<br/>","<b>","<i>","<u>","'"), array("","","","","","","","","","","",""), $type);

//註冊會員
if($type2 == 'registermember')
{
	$id = $_REQUEST['id'];//取得使用者輸入的帳號
	$id2 = str_replace(array("\n","\t","\r","<javascript","<LINK","<br />","<br>","<br/>","<b>","<i>","<u>","'"), array("","","","","","","","","","","",""), $id);
	$pw = $_REQUEST['pw'];//取得使用者輸入的密碼
	$pw2 = str_replace(array("\n","\t","\r","<javascript","<LINK","<br />","<br>","<br/>","<b>","<i>","<u>","'"), array("","","","","","","","","","","",""), $pw);
	$pwsha1 = sha1($pw2);
	$name = $_REQUEST['name'];//取得使用者輸入的名字
	$name2 = str_replace(array("\n","\t","\r","<javascript","<LINK","<br />","<br>","<br/>","<b>","<i>","<u>","'"), array("","","","","","","","","","","",""), $name);
	$email = $_REQUEST['email'];//取得使用者輸入的電話
	$email2 = str_replace(array("\n","\t","\r","<javascript","<LINK","<br />","<br>","<br/>","<b>","<i>","<u>","'"), array("","","","","","","","","","","",""), $email);
	$telphone = $_REQUEST['telphone'];//取得使用者輸入的電話
	$telphone2 = str_replace(array("\n","\t","\r","<javascript","<LINK","<br />","<br>","<br/>","<b>","<i>","<u>","'"), array("","","","","","","","","","","",""), $telphone);
	$addr = $_REQUEST['addr'];//取得使用者輸入的住址
	$addr2 = str_replace(array("\n","\t","\r","<javascript","<LINK","<br />","<br>","<br/>","<b>","<i>","<u>","'"), array("","","","","","","","","","","",""), $addr);
	if($id2 != null && $pw2 != null && $name2 != null && $email2 != null && $telphone2 != null && $addr2 != null)
	{
		$select_member1 = "select uid from product_member where uid='$id2';";
		$select_member2 = pg_query($select_member1);
		$select_member3 = pg_fetch_row($select_member2);
		if($select_member3[0] == null)
		{
			$insert1 = "insert into product_member values ((select max(uno)+1 from product_member),'$id2','$pwsha1','$name2','$email2','$telphone2','$addr2','0');";
			if(pg_query($insert1))
			{
				echo '註冊成功！...3秒後回首頁<br/>';
				echo '<a href="index.php">點我回首頁</a>';
				echo "<meta http-equiv=REFRESH CONTENT=3;url=index.php>";
			}
		}
		else
		{
			echo '帳號'.$id2.'重複了喔!!<br/>';
			echo '<a href="register.php">點我回註冊頁面</a>';			
		}
	}
	else
	{
		echo '沒有填寫完整!!';
		echo "<meta http-equiv=REFRESH CONTENT=2;url=register.php>";
	}
}

//會員登入
else if($type2 == 'login')
{
	$id = $_REQUEST['id'];//取得使用者輸入的帳號
	$pw = $_REQUEST['pw'];//取得使用者輸入的密碼
	$pwsha1 = sha1($pw);
	$select_member1 = "select * from product_member where uid='$id';";
	$select_member2 = pg_query($select_member1);
	$select_member3 = pg_fetch_row($select_member2);
	if($id != null && $id == $select_member3[1] && $pwsha1 != null && $pwsha1 == $select_member3[2])
	{
		echo '登入成功！...3秒後回首頁<br/>';
		echo '<a href="index.php">按此回首頁</a>';
		$_SESSION['idc'] = $id;
		echo "<meta http-equiv=REFRESH CONTENT=3;url=index.php>";
	}
	else
	{
		echo '帳號或密碼錯誤！<br/>';
		echo '<a href="login.php">按此回登入頁面</a>';
		echo "<meta http-equiv=REFRESH CONTENT=3;url=login.php>";
	}
}

//登入管理員
else if($type2 == 'backstagelogin')
{
	$id = $_REQUEST['id'];//取得管理員輸入的帳號
	$pw = $_REQUEST['pw'];//取得管理員輸入的密碼
	$pwsha1 = sha1($pw);
	$select_member1 = "select * from product_member where uid='$id';";
	$select_member2 = pg_query($select_member1);
	$select_member3 = pg_fetch_row($select_member2);
	if($id != null && $id == $select_member3[1] && $pwsha1 != null && $pwsha1 == $select_member3[2] && $select_member3[7] == 88888)
	{
		echo '登入成功！...3秒後進入管理員介面<br/>';
		echo '<a href="backstageAdd.php">按此進入管理員介面</a>';
		$_SESSION['idc'] = $id;
		echo "<meta http-equiv=REFRESH CONTENT=3;url=backstageAdd.php>";
	}
	else
	{
		echo '帳號或密碼錯誤！<br/>';
		echo '<a href="backstage.html">按此回管理員登入頁面</a>';
		echo "<meta http-equiv=REFRESH CONTENT=3;url=backstage.html>";
	}
}

//新增產品
else if($type2 == 'backstageAdd')
{
	$max1 = "select max(pid)+1 from product;";
	$max2 = pg_query($max1);
	$max3 = pg_fetch_row($max2);
	$insert_product_type = $_REQUEST['insert_product_type'];
	$insert_product_pmodel = $_REQUEST['insert_product_pmodel'];
	$insert_product_size = $_REQUEST['insert_product_size'];
	$insert_product_weight = $_REQUEST['insert_product_weight'];
	$insert_product_price = $_REQUEST['insert_product_price'];
	if($_FILES['imgfile']['tmp_name'] != null)
	{
		$FILENAME='_images/'.$max3[0].'.jpg';
		copy($_FILES['imgfile']['tmp_name'],$FILENAME);
		$insert_product_imgurl = $max3[0].'.jpg';
		$insert1 = "insert into product values ((select max(pid)+1 from product),'$insert_product_type','$insert_product_pmodel','$insert_product_size','$insert_product_weight','$insert_product_price','$insert_product_imgurl','0');";
		if(pg_query($insert1))
		{
			echo '新增商品成功！';
		}
	}
	else if($_FILES['imgfile']['tmp_name'] == null)
	{echo '請選擇上傳檔案！';}
	echo "<meta http-equiv=REFRESH CONTENT=2;url=backstageAdd.php>";
}

//修改產品
else if($type2 == 'backstageEdit')
{
	$pid = $_REQUEST['pid'];
	$update_product_tid = $_REQUEST['update_product_tid'];
	$update_product_pmodel = $_REQUEST['update_product_pmodel'];
	$update_product_size = $_REQUEST['update_product_size'];
	$update_product_weight = $_REQUEST['update_product_weight'];
	$update_product_price = $_REQUEST['update_product_price'];
	
	$update1 = "update product set tid='$update_product_tid',pmodel='$update_product_pmodel',size='$update_product_size',weight='$update_product_weight',price='$update_product_price' where pid='$pid';";
	if(pg_query($update1))
	{
		echo '編號：'.$pid;
		echo '修改產品成功！';
	}
	echo "<meta http-equiv=REFRESH CONTENT=2;url=backstageEdit.php>";
}

//刪除產品
else if($type2 == 'backstageDel')
{
	$pid = $_REQUEST['pid'];

	$delete1 = "delete from product where pid='$pid';";
	if(pg_query($delete1))
	{
		echo '刪除產品編號為'.$pid.'　成功！';
	}
	echo "<meta http-equiv=REFRESH CONTENT=2;url=backstageDel.php>";
}

//加入購物車
else if($type2 == 1)
{
	$b1 = $_REQUEST['b1'];//接收購物車的產品編號
	$b11 = $_REQUEST['b11'];//接收購物車的產品類型
	//搜尋購物車內指定編號的商品
	$select_cart_pid_1 = "select product.pid,product_type.tid,product_type.tname,product.pmodel,product.size,product.weight,product.price,product.imgurl,product.click from product,product_type where product.tid=product_type.tid and product.pid='$b1';";
	$select_cart_pid_2 = pg_query($select_cart_pid_1);
	$select_cart_pid_3 = pg_fetch_row($select_cart_pid_2);
	echo '編號No.'.$b1.'的商品已經加入您的購物車了！<br/>';
	$_SESSION["cart_pid_$b1"] = $select_cart_pid_3[0]; //紀錄商品編號
	$_SESSION["cart_tid_$b1"] = $select_cart_pid_3[1]; //紀錄類別編號
	$_SESSION["cart_tname_$b1"] = $select_cart_pid_3[2]; //紀錄種類
	$_SESSION["cart_pmodel_$b1"] = $select_cart_pid_3[3]; //紀錄型號
	$_SESSION["cart_size_$b1"] = $select_cart_pid_3[4]; //紀錄尺寸
	$_SESSION["cart_weight_$b1"] = $select_cart_pid_3[5]; //紀錄重量
	$_SESSION["cart_price_$b1"] = $select_cart_pid_3[6]; //紀錄價格
	$_SESSION["cart_imgurl_$b1"] = $select_cart_pid_3[7]; //紀錄圖片網址
	echo 'Add Success,Please Wait .. !';
	echo "<meta http-equiv=REFRESH CONTENT=0;url=product_info.php?tid=$b11&pid=$b1>";
}

//刪除購物車內的商品
else if($type2 == 2)
{
	$b2 = $_REQUEST['b2']; //得到刪除的編號
	unset($_SESSION["cart_pid_$b2"]);
	unset($_SESSION["cart_tid_$b2"]);
	unset($_SESSION["cart_tname_$b2"]);
	unset($_SESSION["cart_pmodel_$b2"]);
	unset($_SESSION["cart_size_$b2"]);
	unset($_SESSION["cart_weight_$b2"]);
	unset($_SESSION["cart_price_$b2"]);
	unset($_SESSION["cart_imgurl_$b2"]);
	echo 'Delete Success,Please Wait .. !';
	echo '<meta http-equiv=REFRESH CONTENT=0;url=cart.php>';
}

//購買
else if($type2 == 3)
{
	$idc = $_SESSION['idc'];
	$time = $_REQUEST['time'];
	$product_pid = $_REQUEST['product_pid'];
	$pidnum = $_REQUEST['pidnum'];
	$pidnum2 = str_replace(array("\n","\t","\r","<javascript","<LINK","<br />","<br>","<br/>","<b>","<i>","<u>","'"), array("","","","","","","","","","","",""), $pidnum);

	$cart_pid = $_SESSION["cart_pid_$product_pid"];//Session中的商品編號
	$cart_tid = $_SESSION["cart_tid_$product_pid"];//Session中的類別編號
	$cart_tname = $_SESSION["cart_tname_$product_pid"];//Session中的種類
	$cart_pmodel = $_SESSION["cart_pmodel_$product_pid"];//Session中的型號
	$cart_size = $_SESSION["cart_size_$product_pid"];//Session中的尺寸
	$cart_weight = $_SESSION["cart_weight_$product_pid"];//Session中的重量
	$cart_price = $_SESSION["cart_price_$product_pid"];//Session中的價格
	$cart_imgurl = $_SESSION["cart_imgurl_$product_pid"];//Session中的圖片網址
	$psum = $cart_price*$pidnum;
	if($pidnum2 != null && $pidnum2 > 0)
	{
		$insert1 = "insert into product_order values ((select max(oid)+1 from product_order),'$idc','$product_pid','$cart_price','$pidnum2','$psum','$time');";
		if(pg_query($insert1))
		{
			echo '您所購買的產品為：';
			echo '<table>';
				echo '<tr style="text-align:center; background-color:yellow;">';
					echo '<td>編號</td><td>類別</td><td>型號</td><td>尺寸</td><td>重量</td><td>價格</td><td>數量</td>';
				echo '</tr>';
				echo '<tr>';
					echo '<td>'.$cart_pid.'</td>';
					echo '<td>'.$cart_tname.'</td>';
					echo '<td>'.$cart_pmodel.'</td>';
					echo '<td>'.$cart_size.'</td>';
					echo '<td>'.$cart_weight.'</td>';
					echo '<td>'.$cart_price.'</td>';
					echo '<td>'.$pidnum.'</td>';
				echo '</tr>';
			echo '</table>';
			
			echo '總共'.$cart_price.'*'.$pidnum.'='.$psum.'<br/>';
			echo '<font color="red">購買時間：'.$time.'</font>';
			unset($_SESSION["cart_pid_$product_pid"]);
			unset($_SESSION["cart_tid_$product_pid"]);
			unset($_SESSION["cart_tname_$product_pid"]);
			unset($_SESSION["cart_pmodel_$product_pid"]);
			unset($_SESSION["cart_size_$product_pid"]);
			unset($_SESSION["cart_weight_$product_pid"]);
			unset($_SESSION["cart_price_$product_pid"]);
			unset($_SESSION["cart_imgurl_$product_pid"]);
			echo '<a href="cart.php">回購物車</a>';
		}
	}
	else
	{
		echo '購買失敗！';
		echo '<a href="cart.php">回購物車</a>';
	}
	
	/*
	echo '訂單送出成功！<br/>';
	echo '您所訂購的商品為';
	echo '<table class="stable" width="800">';
	echo '<tr style="text-align:center; background-color:yellow;">';
	echo '<td>編號</td><td>類別</td><td>型號</td><td>尺寸</td><td>重量</td><td>價格</td><td>數量</td>';
	echo '</tr>';
	//搜尋購物車內有的物品
	$select_cart_1 = "select product.pid,product_type.tid,product_type.tname,product.pmodel,product.size,product.weight,product.price,product.imgurl,product.click from product,product_type where product.tid=product_type.tid order by pid desc;";
	$select_cart_2 = pg_query($select_cart_1);
	while($select_cart_3 = pg_fetch_row($select_cart_2))
	{
		$cart_pid = $_SESSION["cart_pid_$select_cart_3[0]"];//Session中的商品編號
		$cart_tid = $_SESSION["cart_tid_$select_cart_3[0]"];//Session中的類別編號
		$cart_tname = $_SESSION["cart_tname_$select_cart_3[0]"];//Session中的種類
		$cart_pmodel = $_SESSION["cart_pmodel_$select_cart_3[0]"];//Session中的型號
		$cart_size = $_SESSION["cart_size_$select_cart_3[0]"];//Session中的尺寸
		$cart_weight = $_SESSION["cart_weight_$select_cart_3[0]"];//Session中的重量
		$cart_price = $_SESSION["cart_price_$select_cart_3[0]"];//Session中的價格
		$cart_imgurl = $_SESSION["cart_imgurl_$select_cart_3[0]"];//Session中的圖片網址
		if($_SESSION["cart_pid_$select_cart_3[0]"] != null)
		{
			echo '<tr>';
				echo '<td>'.$cart_pid.'</td>';
				echo '<td>'.$cart_tname.'</td>';
				echo '<td>'.$cart_pmodel.'</td>';
				echo '<td>'.$cart_size.'</td>';
				echo '<td>'.$cart_weight.'</td>';
				echo '<td>'.$cart_price.'</td>';
				echo '<td>'.$pidnum.'</td>';
			echo '</tr>';
			//INSERT資料
			$insert1 = "insert into product_order values ((select max(oid)+1 from product_order),'1','$cart_pid','$pidnum');";
			if(pg_query($insert1))
			{
				echo '';
			}
		}
	}

	echo '</table>';
	echo '<br/>';
	echo '<a href="cart.php">回到購物車</a>';
	//搜尋購物車內有的物品
	$select_cart_4 = "select product.pid,product_type.tid,product_type.tname,product.pmodel,product.size,product.weight,product.price,product.imgurl,product.click from product,product_type where product.tid=product_type.tid;";
	$select_cart_5 = pg_query($select_cart_4);
	while($select_cart_6 = pg_fetch_row($select_cart_5))
	{
		unset($_SESSION["cart_pid_$select_cart_6[0]"]);
		unset($_SESSION["cart_tid_$select_cart_6[0]"]);
		unset($_SESSION["cart_tname_$select_cart_6[0]"]);
		unset($_SESSION["cart_pmodel_$select_cart_6[0]"]);
		unset($_SESSION["cart_size_$select_cart_6[0]"]);
		unset($_SESSION["cart_weight_$select_cart_6[0]"]);
		unset($_SESSION["cart_price_$select_cart_6[0]"]);
		unset($_SESSION["cart_imgurl_$select_cart_6[0]"]);
	}
	*/
}

//搜尋
else if($type2 == 4)
{
	$search_product_type = $_REQUEST['search_product_type'];
	$search_product_type2 = str_replace(array("\n","\t","\r","<javascript","<LINK","<br />","<br>","<br/>","<b>","<i>","<u>","'"), array("","","","","","","","","","","",""), $search_product_type);
	
	$search_product_pmodel = $_REQUEST['search_product_pmodel'];
	$search_product_pmodel2 = str_replace(array("\n","\t","\r","<javascript","<LINK","<br />","<br>","<br/>","<b>","<i>","<u>","'"), array("","","","","","","","","","","",""), $search_product_pmodel);
	
	$search_product_weight_s = $_REQUEST['search_product_weight_s'];
	$search_product_weight_s2 = str_replace(array("\n","\t","\r","<javascript","<LINK","<br />","<br>","<br/>","<b>","<i>","<u>","'"), array("","","","","","","","","","","",""), $search_product_weight_s);
	if($search_product_weight_s2 == null)
	{
		$search_product_weight_s2 = 0;
	}
	
	$search_product_weight_b = $_REQUEST['search_product_weight_b'];
	$search_product_weight_b2 = str_replace(array("\n","\t","\r","<javascript","<LINK","<br />","<br>","<br/>","<b>","<i>","<u>","'"), array("","","","","","","","","","","",""), $search_product_weight_b);
	if($search_product_weight_b2 == null)
	{
		$search_product_weight_b2 = 9999999999;
	}
	
	$search_product_price_s = $_REQUEST['search_product_price_s'];
	$search_product_price_s2 = str_replace(array("\n","\t","\r","<javascript","<LINK","<br />","<br>","<br/>","<b>","<i>","<u>","'"), array("","","","","","","","","","","",""), $search_product_price_s);
	if($search_product_price_s2 == null)
	{
		$search_product_price_s2 = 0;
	}
	
	$search_product_price_b = $_REQUEST['search_product_price_b'];
	$search_product_price_b2 = str_replace(array("\n","\t","\r","<javascript","<LINK","<br />","<br>","<br/>","<b>","<i>","<u>","'"), array("","","","","","","","","","","",""), $search_product_price_b);
	if($search_product_price_b2 == null)
	{
		$search_product_price_b2 = 9999999999;
	}
	
	$count=(int)0;
	

	//搜尋所有的商品pid
	$pid_1 = "select pid from product;";
	$pid_2 = pg_query($pid_1);
	while($pid_3 = pg_fetch_row($pid_2))
	{
		unset($_SESSION["search1_$pid_3[0]"]);
		unset($_SESSION["search2_$pid_3[0]"]);
		unset($_SESSION["search3_$pid_3[0]"]);
		unset($_SESSION["search4_$pid_3[0]"]);
	}
	unset($_SESSION['search_count']);
	//整體搜尋
	$select_cart_pid_1 = "select product.pid,product_type.tid,product_type.tname,product.pmodel,product.size,product.weight,product.price,product.imgurl,product.click
	from product,product_type where product.tid=product_type.tid
	and product_type.tname like '%$search_product_type2%' and product.pmodel like '%$search_product_pmodel2%'
	and product.weight >= $search_product_weight_s2 and product.weight <= $search_product_weight_b2
	and product.price >= $search_product_price_s2 and product.price <= $search_product_price_b2;";
	$select_cart_pid_2 = pg_query($select_cart_pid_1);
	while($select_cart_pid_3 = pg_fetch_row($select_cart_pid_2))
	{
		$_SESSION["search1_$select_cart_pid_3[0]"] = $select_cart_pid_3[0]; //pid
		$_SESSION["search2_$select_cart_pid_3[0]"] = $select_cart_pid_3[3]; //pmodel
		$_SESSION["search3_$select_cart_pid_3[0]"] = $select_cart_pid_3[7]; //img
		$_SESSION["search4_$select_cart_pid_3[0]"] = $select_cart_pid_3[1]; //tid
		$count = $count+1;
	}
	$_SESSION['search_count'] = "$count";
	
	$_SESSION['search_product_type2'] = $search_product_type2;
	$_SESSION['search_product_pmodel2'] = $search_product_pmodel2;
	$_SESSION['search_product_weight_s2'] = $search_product_weight_s2;
	$_SESSION['search_product_weight_b2'] = $search_product_weight_b2;
	$_SESSION['search_product_price_s2'] = $search_product_price_s2;
	$_SESSION['search_product_price_b2'] = $search_product_price_b2;
	
	
	echo '<meta http-equiv=REFRESH CONTENT=0;url=search.php>';
}	
else
{
	echo '<meta http-equiv=REFRESH CONTENT=0;url=product.php>';
}
?>