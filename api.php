<?php

	class Api
	{

		private $lifetime = 3600;
		public $redis;
		private $rest_url = 'api/redis';
		
		function __construct()
		{
			require_once "predis/autoload.php";
			try {
				$this->redis = new Predis\Client();
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
	
		function expiration_info($key)
		{
			return "\nKey '".$key."' expires in ".$this->redis->ttl($key)." s.";
		}
	
		function add_key($key, $value)
		{
			if ($this->redis->exists($key)) {
				return false;
			} else {
				$this->redis->set($key, $value);
				$this->redis->expire($key, $this->lifetime);
				return true;
			}
			$ret .= $this->expiration_info($key);
			return $ret;
		}
	
		function cli_add_key($key, $value)
		{
			
			if ($this->add_key($key, $value)) {
				$ret = "Key '".$key."' set as '".$value."'.";			
			} else {
				$ret = "Key '".$key."' already exists.  No changes made.";
				$ret .= $this->expiration_info($key);
			}
			return $ret;
		}
	
		function delete_key($key)
		{
			if ($this->redis->exists($key)) {
				$this->redis->del($key);
				return true;
			} else {
				return false;
			}
		}

		function cli_delete_key($key)
		{
			
			if ($this->delete_key($key)) {
				$ret = "Key '".$key."' deleted.";
			} else {
				$ret = "Key '".$key."' does not exist.  No changes made.";
			}
			return $ret;
		}

		function rest_delete_key($key)
		{
			if ($this->delete_key($key)) {
				$ret = '
{"status": true,
"code": 200,
"data": {}
}
';
			} else {
				$ret = '
{"status": false,
"code": 500,
"data": {"message": "Key \"'.$key.'\" does not exist."}
}
';
			}
			return $ret;
		}

		function get_method()
		{
			return $_SERVER['REQUEST_METHOD'];
		}

		function rest_get_key()
		{
			if (preg_match('@/'.$this->rest_url.'/(.+)@', $_SERVER['REQUEST_URI'], $mt)){
				return rawurldecode($mt[1]);	
			} else {
				return null;
			}
		}
	
	}