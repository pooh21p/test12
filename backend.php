<script src="rest.js"></script>
<?php

	require_once "api.php";
	$api = new Api();

	if (isset($_REQUEST['key'])){
		$ret = $api->rest_delete_key($_REQUEST['key']);
	}

	echo '<ul id="db_list">';

	$keys = $api->redis->keys('*');
	foreach ($keys as $key)
	{
		echo '<li><strong>'.$key.'</strong>: '.$api->redis->get($key).' <a href="#" class="remove">delete</a></li>';
	}
	
	echo '</ul>';
	echo '<br><a href="./backend.php">Перезагрузить страницу</a>';
	echo '<br><a id="reload_list" href="#">Обновить список через REST</a>';
