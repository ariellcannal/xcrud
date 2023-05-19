<?php
require_once (rtrim(FCPATH, '\\') . '/application/libraries/Xcrud/xcrud.php');
if (! function_exists('xcrud_get_instance')) {

	function xcrud_get_instance($name = false) {
	    $ci = &get_instance();
		$ci->load->library('session');
		$ci->load->helper('url');
		Xcrud_config::$scripts_url = base_url('');
		header('Content-Type: text/html; charset=' . Xcrud_config::$mbencoding);
		$crud = Xcrud::get_instance($name, $ci);
		return $crud;
	}
}
if (! function_exists('xcrud_store_session')) {

	function xcrud_store_session() {
		$CI = &get_instance();
		$CI->load->library('session');
		$_SESSION['xcrud_sess'] = Xcrud::export_session();
	}
}
if (! function_exists('xcrud_restore_session')) {

	function xcrud_restore_session() {
		$CI = &get_instance();
		$CI->load->library('session');
		Xcrud::import_session($_SESSION['xcrud_sess']);
	}
}