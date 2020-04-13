<?php
function ambil_template($nama_template = '') {
	if($nama_template) {
		require_once('template-parts/'.$nama_template.'.php');
	}	
}

function selected($param1='', $param2='') {
	if($param1 == $param2) {
		echo 'selected="selected"';
	}
}

function redirect_to($url = '') {
	header('Location: '.$url);
	exit();
}

function cek_login() {
	
	if(isset($_SESSION['username']) && isset($_SESSION['level'])) {
		// do nothing
	} else {
		redirect_to("../index.php");
	}	
}

function cek_login_index(){
	if(isset($_SESSION['level']) == 'admin') {
    redirect_to("admin/dashboard.php");
  }elseif(isset($_SESSION['level']) == 'pimpinan') {
    redirect_to("pimpinan/dashboard.php");
  } elseif(isset($_SESSION['level']) == 'user'){
    redirect_to("user/dashboard.php");
  } else {
    // do nothing
  } 
}

function get_role() {
	
	if(isset($_SESSION['username'])) {
		if($_SESSION['level'] == 'admin') {
			return 'Admin';
		} elseif($_SESSION['level'] == 'pimpinan') {
			return 'Pimpinan';
		} else {
			return 'User';
		}
	} else {
		return false;
	}	
}
