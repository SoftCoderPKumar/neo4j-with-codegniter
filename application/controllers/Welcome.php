<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}
	public function neo(){
		$db = $this->neo4j->get_db();
  		//$query = "CALL db.labels() YIELD label WHERE label CONTAINS  'a' RETURN label";
  		//$query = "Match (p:TopicMaster)<-[*]-(s:Topic) with labels(s) as l UNWIND l as label with label as lbl WHERE toLower(lbl) CONTAINS toLower('b') return collect(distinct lbl) as lab";
  		$query = "MATCH (p:TopicMaster) OPTIONAL MATCH (p)<-[*]-(c) UNWIND p.name,c.name as name  return collect(distinct name) as name";
  		$response = $db->run($query)->getrecords();
  		foreach ($response as $key => $value) {
  			print_r($value->values());
  		}
	}
}
