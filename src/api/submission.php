<?php
namespace api;

use twentyseconds\docstore\store;

class submission{
    
    public $db;
    public $store;
    public $org;
    
    function __construct($db, $org=null){
        $this->db = $db;
        if($org) $this->set_org($org);
        $this->store = new store($db, "submissions", $org);
    }
    
    function set_org($org){
        $this->org = $org;
        $this->store->set_org($org);
    }
    
    function send($type, $doc, $hdrs){
        $doc['_type'] = $type;
        $id = $this->store->insert_doc($doc);
        if($id){
            $this->store->log($id, $_SERVER['REMOTE_ADDR'], $hdrs);
        }
        return ['res'=>'ok'];
    }
}
