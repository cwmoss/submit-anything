<?php
namespace twentyseconds\docstore;

use Ramsey\Uuid\Uuid;

class store{
    
    public $db;
    public $table;
    public $org;
    
    function __construct($db, $table, $org=null){
        $this->db = $db;
        $this->table = $table;
        if($org) $this->org = $org;
    }
    
    function set_org($org){
        $this->org = $org;
    }
    
    function insert_doc($doc){
        $type=$this->validate_type($doc);
        if(!$type) return false;
        $ok = $this->_insert($this->gen_id(), $type, $doc);
        return $ok;
    }
    
    function save_doc($doc){
        $type=$this->validate_type($doc);
        if(!$type) return false;
        
        $id = $doc['_id'];
        if(!$id){
            $id = $this->gen_id();
            return $this->_insert($id, $type, $doc);
        }else{
            return $this->_insert_or_update($id, $type, $doc);
        } 
    }
    
    function validate_type($doc){
        return $doc['_type']??false;
    }
  
    function gen_id(){
        return Uuid::uuid4();
    }
    
    function _insert($id, $type, $doc){
        unset($doc['_id'], $doc['_type']);
        $this->db->insert($this->table, [
            'id' => $id,
            'org' => $this->org,
            'type' => $type,
            'doc' => json_encode($doc)
        ]);
        return $id;
    }
    
    function log($id, $ip=null, $headers=[]){
        $this->db->insert($this->table."_log", [
            'doc_id' => $id,
            'org' => $this->org,
            'ip' => $ip??'',
            'header' => json_encode($headers)
        ]);
        return $id;
    }
    
    /*
    achtung!
    API darf nur inserts, sonst könnten sich orgs gegenseitig überschreiben
    
    INSERT INTO table (id, name, age) VALUES(1, "A", 19) ON DUPLICATE KEY UPDATE  
    https://stackoverflow.com/questions/4205181/insert-into-a-mysql-table-or-update-if-exists
      
    */
    function _insert_or_update($id, $type, $doc){
        
    }
    
    function _update($id, $type, $doc){
        
    }
    
}

/*
SELECT JSON_EXTRACT(doc, "$.name") AS name  from submissions 
select * from submissions where doc->"$.name" = 'harry'
*/