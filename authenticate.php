<?php
require_once('../../config.php');
require_once($CFG->libdir.'/authlib.php');
require_once($CFG->libdir.'/externallib.php');

if( isset($_GET['username']) and !empty($_GET['username']) and isset($_GET['password']) and !empty($_GET['password']) ) {
	$mobile_manual_auth = get_auth_plugin('mobilemanual');
	$logged_in = $mobile_manual_auth->user_login($_GET['username'], $_GET['password']);

	if( $logged_in === true ) {
		// set user	
		$USER = $DB->get_record('user', array('username'=>$_GET['username']) );

		// delete old tokens
		$DB->delete_records('external_tokens', array('userid' => $USER->id));

		// generate new tokens
		$serviceid = $mobile_manual_auth->config->webservice_id;
		$validuntil = time() + $mobile_manual_auth->config->token_duration;
		$courses = enrol_get_my_courses();
		$response = array();
		foreach($courses as $course) {
			$context = get_context_instance(CONTEXT_COURSE, $course->id);
			$response[$course->id] = array();
			$response[$course->id]['coursename'] = $course->fullname;
			$response[$course->id]['token'] = external_generate_token(EXTERNAL_TOKEN_PERMANENT, $serviceid, $USER->id, $context, $validuntil);
		}
		echo json_encode($response);
	} else {
		echo json_encode(array('error' => 'Authentication Failed'));
	}
} else {
	echo json_encode(array('error' => 'Missing user data'));
}
?>
