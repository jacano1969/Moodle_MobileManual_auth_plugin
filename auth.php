<?php

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}

require_once($CFG->libdir.'/authlib.php');

class auth_plugin_mobilemanual extends auth_plugin_base {

    /**
     * Constructor.
     */
    function auth_plugin_mobilemanual() {
        $this->authtype = 'mobilemanual';
		$this->config = get_config('auth/mobilemanual');
    }

    function user_login($username, $password) {
		$manual_auth = get_auth_plugin('manual');
        $result = $manual_auth->user_login($username, $password);
		if ($result === true) {
			return true;	
		} else {
			return $this->error(0);	
		}
    }


    /**
     * Prints a form for configuring this authentication plugin.
     *
     * This function is called from admin/auth.php, and outputs a full page with
     * a form for configuring this plugin.
     *
     * @param array $page An object containing all the data for this page.
     */
    function config_form($config, $err, $user_fields) {
        include "config.html";
    }

    /**
     * Processes and stores configuration data for this authentication plugin.
     *
     *
     * @param object $config Configuration object
     */
    function process_config($config) {
        global $CFG;
		
        if( isset($config->webservice_id) and is_numeric($config->webservice_id)) {
			set_config('webservice_id', $config->webservice_id, 'auth/mobilemanual');	
		} else {
			return false;	
		}

        if( isset($config->token_duration) and is_numeric($config->token_duration)) {
			set_config('token_duration', $config->token_duration, 'auth/mobilemanual');	
		} else {
			return false;	
		}

		return true;
    }

	public function error($code) {
		$error = array(
				'exception' => 'unknown exception',
				'message' => 'no message',
				'debuginfo'=>'code: '.$code
				);

		switch ($code) {
			case 0:
				$error["exception"] = 'authentication_failed';
				$error["message"] = 'Authentication failed. Please check your username and password.';
				break;
			case 1:
				$error["exception"] = 'user_data_exception';
				$error["message"] = 'The username is missing.';
				break;
			case 2:
				$error["exception"] = 'user_data_exception';
				$error["message"] = 'The password is missing.';
				break;
		}
		return $error;
	}
}


