<?php

 */
class Rimplates_Api {
	
	 */
	public function __construct() {
		$this->load_required_files();
	}
    private function load_required_files() {
   	 //Add Required Files to Load
	 require_once plugin_dir_path( dirname( __FILE__ ) ) . 'api/core/users/class-base-users.php';
    }
	
}


$Rimplates_Api = new Rimplates_Api();