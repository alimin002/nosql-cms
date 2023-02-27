<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Library Log txt
 * @author adopabianko@gmail.com
 */

class Log_activityelastic {
	protected $path;
	protected $filename;

	/**
	 * Create log
	 * @param  string $log_url
	 * @param  string $log_method
	 * @param  string $log_param
	 * @param  string $log_response
	 * @param  string $log_ip
	 * @param  string $created_by
	 */
	public function createLog(
		$created_by,
		$log_url,
		$log_method,
		$log_param,
		$log_response
	) {
		$this->path     = './logs/'.date('Y').'/'.date('m'); // Directory Logs
		$this->filename = 'log_cms_'.date('d_m_Y').'.log'; // File log

		$list = array (
			date('ymdHis'),
			$created_by,
			$log_url,
			$log_method,
			$log_param,
			$log_response,
			$_SERVER['REMOTE_ADDR'] != null ? $_SERVER['REMOTE_ADDR'] : $_SERVER['HTTP_X_FORWARDED_FOR']
		);

		
          
                $urlAPI = 'http://119.110.87.74:9200/ecopark_cms/log';
                $data = array("first_name" => "First name","last_name" => "last name","email"=>"email@gmail.com","addresses" => array ("address1" => "some address" ,"city" => "city","country" => "CA", "first_name" =>  "Mother","last_name" =>  "Lastnameson","phone" => "555-1212", "province" => "ON", "zip" => "123 ABC" ) );

                $postdata = json_encode($data);

                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                $result = curl_exec($ch);
                curl_close($ch);
                print_r ($result);
	}

	/**
	 * Create file TEXT
	 * @param  array $list
	 */
	public function createFileTxt($list) {
		$file = fopen($this->path.'/'.$this->filename,"w");

		$format_log = $list[0].'|'.$list[1].'|'.$list[2].'|'.$list[3].'|'.$list[4].'|'.$list[5].'|'.$list[6]."\n\n";
		fwrite($file, $format_log);
		fclose($file);
	}

	/**
	 * Update file TEXT
	 * @param  array $list
	 */
	public function updateFileTxt($list) {
		$file = fopen($this->path.'/'.$this->filename,"a");

		$format_log = $list[0].'|'.$list[1].'|'.$list[2].'|'.$list[3].'|'.$list[4].'|'.$list[5].'|'.$list[6]."\n\n";
		fwrite($file, $format_log);
		fclose($file);
	}
}
