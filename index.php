<html>
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
	add_menu_page("OSIRIS Dashboard", "OSIRIS", 4, "OSIRIS-Dashboard", "OSIRISDashboard");
	add_submenu_page("OSIRIS-Dashboard", "Submenu1", "Submenu1", 4, "OSIRIS-Submenu-1", "Submenu1");
}

// Content for the main page of OSIRIS plugin
function OSIRISDashboard()
{
	?> <h1>This is just a test: Zed</h1> <?php
}

// Content for submenu item 1 of OSIRIS plugin
function Submenu1()
{
    ?> <h1>This is just a test for the submenu: Zed</h1> <?php
}

?>
</html>