<?php
/**
 * Created by PhpStorm.
 * User: Han
 * Date: 23/06/2015
 * Time: 10:38 AM
 */
if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN'){ //windows is \ unix is /
    $adds = explode("\\", __FILE__, -3);
    $adds = implode("\\", $adds).'\\';
}else{
    $adds = explode("/", __FILE__, -3);
    $adds = implode("/", $adds).'/';
}
require ($adds.'wp-config.php');
require "class/user_class.php";
require_once 'class/PHPMailerAutoload.php';

global $wpdb;
$table_21ccn_users = $wpdb->prefix.'oneuni_21ccn_users';
global $table_21ccn_users;
global $user_class;

$user_class = new User_Class();

function code_check($code, $length){
    return substr(md5($code."oneu"),0,$length);
}
