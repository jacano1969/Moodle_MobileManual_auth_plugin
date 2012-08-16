<?php
require_once('../../config.php');
require_once($CFG->libdir.'/authlib.php');
require_once($CFG->libdir.'/externallib.php');

header('Content-type: application/json');
$mobile_manual_auth = get_auth_plugin('mobilemanual');

if( 
	isset($_GET['username']) and !empty($_GET['username']) and 
	isset($_GET['password']) and !empty($_GET['password'])
) {
	$response = $mobile_manual_auth->user_login($_GET['username'], $_GET['password']);

	if( $response === true ) {
		// set user	
		$USER = $DB->get_record('user', array('username'=>$_GET['username']) );

		// delete old tokens
		$DB->delete_records('external_tokens', array('userid' => $USER->id));

		// generate new tokens
		$serviceid = $mobile_manual_auth->config->webservice_id;
		$validuntil = time() + $mobile_manual_auth->config->token_duration;
		$courses = enrol_get_my_courses(array('timemodified'), 'fullname');
		$response = array();
		foreach($courses as $course) {
			$context = get_context_instance(CONTEXT_COURSE, $course->id);
			$entry = array();
			$entry['id'] = intval($course->id);
			$entry['name'] = $course->fullname;
			$entry['timemodified'] = $course->timemodified;
			$entry['token'] = external_generate_token(EXTERNAL_TOKEN_PERMANENT, $serviceid, $USER->id, $context, $validuntil);
			$response[count($response)] = $entry;
		}
	} 
	echo json_encode($response);
} else {
	// manage missing parameters
	if( !isset($_GET['username']) or empty($_GET['username']) ) {
		echo json_encode( $mobile_manual_auth->error(1) );
	} else {
		echo json_encode( $mobile_manual_auth->error(2) );
	}
}
?>
