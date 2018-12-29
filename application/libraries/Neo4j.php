<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
require_once 'vendor/autoload.php';
use GraphAware\Neo4j\Client\ClientBuilder;

class Neo4j {
    private $neo4j;

    function __construct()
    {
        
        $this->connect();
    }

    //connect to the neo4j database
    public function connect(){

        $CI = & get_instance();
        //load CI to access config files 

        //Get database details from the config file.
        $user       = $CI->config->item('username1');
        $password   = $CI->config->item('password1');
        $host       = $CI->config->item('hostname1');
        $port       = $CI->config->item('port1');
        $database   = $CI->config->item('database1');

        //build connection to db
        $client = ClientBuilder::create()
                ->addConnection('default', 'http://'.$user.':'.$password.'@'.$host.':'.$port)
                ->build();

        //save the connection object in a private class variable
        $this->neo4j    = $client;
    }

    //Returns the connection object to the neo4j database
    public function get_db(){
        return $this->neo4j;
    }
}