<?php

	require_once "api.php";
	$api = new Api();


	$method = $api->get_method();
	
	
	
	if ($method=='DELETE'){
		
		$key = $api->rest_get_key();
		if ($key) {
			$ans = $api->rest_delete_key($key);
			echo $ans;
			if ($ans) {
				
			}	
		}	
		return;
	}



	if ($method=='GET'){

		$ans = '';
		$keys = $api->redis->keys('*');
		foreach ($keys as $k => $key)
		{
			if ($k>0)
				$ans .= ',';
			$ans .= "\n".'  "'.$key.'": "'.$api->redis->get($key).'"';
			
			//echo "<li><strong>$key</strong>: ".$api->redis->get($key)." (ttl ".$api->redis->ttl($key).") <a href='#' class='remove'>delete</a></li>";
		}
		$ans = '{
 "status": true,
 "code": 200,
 "data": {'.$ans.'
 }
}';
		echo $ans;
		return;
	}
		


		echo "<ul id='db_list'>";

	$keys = $api->redis->keys('*');
	foreach ($keys as $key)
	{
		echo "<li><strong>$key</strong>: ".$api->redis->get($key)." (ttl ".$api->redis->ttl($key).") <a href='#' class='remove'>delete</a></li>";
	}
		echo "</ul>";

 
// Hello world

//echo "<BR><B>".__FILE__." (".__LINE__.")</B><BR><div style=\"text-align:left; color:green;\"><PRE>"; print_r($value); echo "</PRE></div>"; 



//<li>{key}: {value} <a href=‘#’ class=‘remove’>delete</a></li>


return;



	$lifetime = 3600;





	print_r($argv);

	if ($argv[1] != 'redis') {
		die("Invalid parameters. Parameter 1 must be redis.");
	}

	if ($argv[2] == 'add') {
		die(add_key($argv[3], $argv[4]));
	} else if ($argv[2] == 'delete') {
		die(delete_key($argv[3]));
	} else {
		die("Invalid parameters. Parameter 2 must be 'add' or 'delete'.");
	}


print_r($argv);


/*
print_r(getopt('redisb:'));

print_r(getopt('a:b:', ['opt1:', 'opt2:', 'opt3:']));

//echo "\e4m Подчеркнутый текст \e0m\n";
//echo "\e[1m Жирный текст \e[0m\n";
//echo "\e[7m Выделенный текст \e[0m";

echo "\e[91m zzzzzzzz \e[0m\n";
*/

/*
E:\xampp\php;C:\PROGRA~2\Borland\CBUILD~1\Bin;C:\PROGRA~2\Borland\CBUILD~1\Projects\Bpl;C:\Program Files\Common Files\Microsoft Shared\Windows Live;C:\Program Files (x86)\Common Files\Microsoft Shared\Windows Live;C:\Windows\system32;C:\Windows;C:\Windows\System32\Wbem;C:\Windows\System32\WindowsPowerShell\v1.0\;C:\Program Files (x86)\Windows Live\Shared;C:\Program Files (x86)\Common Files\Adobe\AGL;C:\ProgramData\ComposerSetup\bin;C:\Program Files\PuTTY\;C:\Program Files\Git\cmd

*/