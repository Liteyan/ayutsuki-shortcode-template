<?php

/*
Plugin Name: Ayutsuki Shortcode Template
Plugin URI: https://ayutsuki.net/shortcode-template/
Description: ショートコードで文章を使い回そう。
Version: 1.0.0
Author: 鮎月 -Liteyan-
Author URI: https://ayutsuki.net/
License: GPL3
*/

if (!defined("ABSPATH")) exit;
$ast =  plugin_dir_path(__FILE__);
$files = array("functions.php", "create-post_type.php", "shortcode.php");

foreach ($files as $file_name) {
	include_once($ast . $file_name);
}

require $ast . "plugin-update-checker/plugin-update-checker.php";
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	"http://files.liteyan.xyz/plugins/ayutsuki-shortcode-template/version.json",
	__FILE__,
	"ayutsuki-shortcode-templete"
);
