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
    }

     
    function user_login($username, $password) {
        return false;
    }


//    /**
//     * Prints a form for configuring this authentication plugin.
//     *
//     * This function is called from admin/auth.php, and outputs a full page with
//     * a form for configuring this plugin.
//     *
//     * @param array $page An object containing all the data for this page.
//     */
//    function config_form($config, $err, $user_fields) {
//        include "config.html";
//    }
//
//    /**
//     * Processes and stores configuration data for this authentication plugin.
//     *
//     *
//     * @param object $config Configuration object
//     */
//    function process_config($config) {
//        global $CFG;
//
//        // set to defaults if undefined
//        if (!isset($config->auth_instructions) or empty($config->user_attribute)) {
//            $config->auth_instructions = get_string('auth_shib_instructions', 'auth_shibboleth', $CFG->wwwroot.'/auth/shibboleth/index.php');
//        }
//        if (!isset ($config->user_attribute)) {
//            $config->user_attribute = '';
//        }
//        if (!isset ($config->convert_data)) {
//            $config->convert_data = '';
//        }
//
//        if (!isset($config->changepasswordurl)) {
//            $config->changepasswordurl = '';
//        }
//
//        if (!isset($config->login_name)) {
//            $config->login_name = 'Shibboleth Login';
//        }
//
//        // Clean idp list
//        if (isset($config->organization_selection) && !empty($config->organization_selection) && isset($config->alt_login) && $config->alt_login == 'on') {
//            $idp_list = get_idp_list($config->organization_selection);
//            if (count($idp_list) < 1){
//                return false;
//            }
//            $config->organization_selection = '';
//            foreach ($idp_list as $idp => $value){
//                $config->organization_selection .= $idp.', '.$value[0].', '.$value[1]."\n";
//            }
//        }

    }


