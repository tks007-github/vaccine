<?php
	session_start();			# 作成したセッションを再開
	session_regenerate_id(true);		# 既存のセッションIDを新しく置き換える
	
	$vac_sta_value=$post['vac_sta_value'];

	
	$_SESSION['vac_sta_code']=$vac_sta_code;
		

	header('Location:s_search_list.php');
	exit();
?>	
	