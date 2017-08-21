<?php
/*
Plugin Name: OSIRIS Plugin
Plugin URI:
Description: Team INFINITE for I.E
Author: INFINITE
Author URI:
Version: 0.1
*/

//Adding side panel entry for OSIRIS
add_action("admin_menu", "addMenu");
function addMenu()
{
	add_menu_page("OSIRIS Options", "OSIRIS Options", 4, "OSIRIS-Options", "OSIRISMenu");
	add_submenu_page("OSIRIS-Options", "Option 1", "Option 2", 4, "OSIRIS-Options-1", "SubmenuExample");
}

function OSIRISMenu()
{
	echo "This is just a test: Zed";
}

function SubmenuExample()
{
	echo "This is just a test for the submenu: Zed";
}

?>