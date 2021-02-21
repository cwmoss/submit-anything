<?php

$conf = require_once(__DIR__."/src/boot.php");

#new api\submission;

use twentyseconds\docstore\store;


$store = new store($conf['db'], "submissions", "robbie");

$doc = ['_type'=>'contact', 'name'=>'berrie', 'message'=>'ok very good!'];

$id = $store->insert_doc($doc);
$store->log($id, $_SERVER['REMOTE_ADDR']);

var_dump($ok);
