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
            
            //echo "<li><strong>$key</strong>: ".$api->redis->get($key)." (ttl ".$api->redis->ttl($key).") <a href = '#' class = 'remove'>delete</a></li>";
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
        
    echo "<ul id = 'db_list'>";
    $keys = $api->redis->keys('*');
    foreach ($keys as $key)
    {
        echo "<li><strong>$key</strong>: ".$api->redis->get($key)." (ttl ".$api->redis->ttl($key).") <a href = '#' class = 'remove'>delete</a></li>";
    }
    echo "</ul>";
