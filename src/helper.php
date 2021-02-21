<?php

function resp($data){
  header("content-type: application/json");
  print json_encode($data);

  dbg("+++ finished");
}

function dbg($txt, ...$vars){
// im servermodus wird der zeitstempel automatisch gesetzt
//	$log = [date('Y-m-d H:i:s')];
	$log= [];
   if(!is_string($txt)){
   	array_unshift($vars, $txt);
   }else{
      $log[] = $txt;
   }
   $log[] = join(' ', array_map('json_encode', $vars));
	error_log(join(' ', $log));
}

function get_json_and_raw_req(){
  $raw = get_raw_req();
	$post = json_decode($raw, true);
	return [$post, $raw];
}

function get_json_req(){
  return json_decode(get_raw_req(), true);
}

function get_raw_req(){
  dbg("++++ raw input read ++++");
  return file_get_contents('php://input');
}

function url_to_pdo_dsn($url){
    $parts = parse_url($url);

    return [
        $parts['scheme'].':host='.$parts['host'].';dbname='.trim($parts['path'], '/'),
        $parts['user'],
        $parts['pass']
    ];
}

