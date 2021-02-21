<?php
use api\submission;


// list($post, $raw) = get_json_req();
$data = get_json_req();

//$req = ['conf' => ['h'=>$hasura, 'e'=>$search], 'hdrs'=>$_SERVER, 'get'=>$_GET];

dbg("+++ incoming +++ ");
// dbg("hasura", $hasura);

error_reporting(E_ALL & ~E_NOTICE);

$router = new \Bramus\Router\Router();

if($BASE_URL){
   $router->setBasePath($BASE_URL);
}

$router->get('/', function()use($req){
    dbg("index");
	resp(['res'=>'ok']);
});


$router->mount('/submission', function() use ($router, $conf, $data) {
  
  $api = new submission($conf['db']);
  
  $hdrs = $router->getRequestHeaders();
  
  $router->post('/(\w+)/send/(\w+)', function($org, $type) use($api, $hdrs, $data) {

      $data = get_json_req();
      $api->set_org($org);
      dbg("send", $org, $type, $data);
      resp($api->send($type, $data, $hdrs));
  });

});

$router->set404(function() {
    header('HTTP/1.1 404 Not Found');
    resp(['res'=>'fail', 'msg'=>'not found']);
});

$router->run();