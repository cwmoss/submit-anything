<?php
namespace api;

use twentyseconds\docstore\store;

class org{
	
	public $db;

	public function __construct($db){
		$this->db = $db;
	}

	public function create($name, $data=[], $hdrs=[]){
		$p = gen_password();
		dbg("pass $p");
		$org = [
			'name' => $name,
			'password' => password_hash($p, PASSWORD_DEFAULT),
			'api_key' => gen_secret(),
			'types' => "{}",
		];
		$ok = $this->db->insert('orgs', $org);
		$org['password'] = $p;
		return $org;
	}
}