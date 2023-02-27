<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Load Predis autoloader
require(APPPATH.'/libraries/lib_predis/autoload.php');
// require (base_url().'application/lib_predis/autoload.php');
// require(SYSDIR.'\libraries\session\session.php');
// Registering Predis system
// Predis\Autoloader::register();
// $this->load->library('session');
class Session {
    
    private $redis;
    private $redis_config = array(
          'scheme' => 'tcp',
          'host' => '167.71.217.147',
          'port' => 6379,
          'database' => 13,
      );
    private $sess_id;
    
    public function __construct($params = array()) {
        // session_destroy();
        // Try to connect on the Redis server
        $this->redis = new Predis\Client($this->redis_config, array('prefix' => 'sessions:'));
        // Set the PHP SESSION handler as this own class
        $handler = new Predis\Session\Handler($this->redis, array('gc_maxlifetime' => 7200));
        // session_set_save_handler($this);
        // $set_id = generateCode(12);
        // session_id('test');
        $handler->register();
        session_start();
    }
    

    function userdata($item = '') 
    {
        return ( ! isset( $_SESSION[$item] ) ) ? FALSE : $_SESSION[$item];
    }
    /**
    * all_userdata()
    *
    * Returns the $_SESSION array.
    *
    * @param   string
    * @return  string
    */
    function all_userdata () 
    {
        return $_SESSION;
    }
    /**
    * set_userdata()
    *
    * Add or change data in the $_SESSION array.
    *
    * @param   mixed
    * @param   string
    * @return  void
    */
    function set_userdata($key = array(), $value = '')
    {
        if ( is_array($key) ) {
            foreach($key as $new_key => $value)
                $this->set_userdata($new_key, $value);
        } else
            $_SESSION[$key] = $value;
    }
    /**
    * unset_userdata()
    *
    * Deletes a variable data in the $_SESSION array.
    *
    * @param   mixed
    * @param   string
    * @return  void
    */
    function unset_userdata($key = '')
    {
        unset($_SESSION[$key]);
    }
    /**
    * sess_destroy()
    *
    * Destroy the current session.
    *
    * @return  void
    */
    function sess_destroy()
    {
        session_destroy();
    }
}