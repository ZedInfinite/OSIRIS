<html>
<?php
/*
Plugin Name: OSIRIS Plugin
Plugin URI:
Description: Team INFINITE for I.E
Author: INFINITE
Author URI:
Version: 0.2
*/

//Adding side panel entry for OSIRIS jack
add_action("admin_menu", "addMenu");
add_action('admin_init', 'setup_sections');
add_action('admin_init', 'setup_fields');
function addMenu()
{
	add_menu_page("OSIRIS Dashboard", "OSIRIS", 4, "OSIRIS-Dashboard", "OSIRISDashboard");
	add_submenu_page("OSIRIS-Dashboard", "SettingSub", "Setting", 4, "Setting", "Plugin_Setting_Content");
}

// Content for the main page of OSIRIS plugin
function OSIRISDashboard()
{
	?> <h1>This is just a test: Zed</h1> <?php
}

function Plugin_Setting_Content()
{
    ?>
	<div class="wrap">
		<h2>Settings Page</h2>
        <?php
        if ( isset( $_GET['settings-updated'] ) && $_GET['settings-updated'] )
        {
            admin_notice();
        } 
        ?>
		<form method="post" action="options.php">
            <?php
                settings_fields( 'Setting' );
                do_settings_sections( 'Setting' );
                submit_button();
            ?>
		</form>
	</div> <?php
}

function admin_notice() 
{ ?>
    <div class="notice notice-success is-dismissible">
        <p>Your settings have been updated!</p>
    </div><?php
}
// Set up the sections of page
function setup_sections() 
{
    add_settings_section( 'our_first_section', 'First Section','Section_callback', 'Setting' );
    add_settings_section( 'our_second_section', 'Second Section', 'Section_callback', 'Setting' );
    add_settings_section( 'our_third_section', 'Third Section', 'Section_callback', 'Setting' );
    add_settings_section( 'our_fourth_section', 'Fourth Section', 'Section_callback', 'Setting' );
}
// Callback of each section
function Section_callback($arguments ) 
{
    switch( $arguments['id'] )
    {
		case 'our_first_section':
			echo 'First Section test';
            break;
        case 'our_second_section':
			echo 'Second Section test';
            break;
        case 'our_third_section':
			echo 'Third Section test';
            break;
        case 'our_fourth_section':
			echo 'Fourth Section test';
			break;
	}
}

function setup_fields() 
{
    $fields = array
    (
        array
        (
			'uid' => 'our_first_field',
			'label' => 'Date',
			'section' => 'our_first_section',
			'type' => 'text',
			'options' => false,
            'placeholder' => 'DD/MM/YYYY',
            //'helper' => 'Does this help?',
			//'supplemental' => 'I am underneath!',
			'default' => '01/01/2015'
        ),
        array
        (
            'uid' => 'awesome_password_field',
            'label' => 'Sample Password Field',
            'section' => 'our_first_section',
            'type' => 'password',
        ),
        array
        (
            'uid' => 'awesome_number_field',
            'label' => 'Sample Number Field',
            'section' => 'our_first_section',
            'type' => 'number',
        ),
        array
        (
            'uid' => 'our_second_field',
            'label' => 'Date',
            'section' => 'our_first_section',
            'type' => 'textarea',
            'options' => false,
            'placeholder' => 'DD/MM/YYYY',
            //'helper' => 'Does this help?',
            //'supplemental' => 'I am underneath!',
            'default' => '01/01/2015'
        ),
        array
        (
            'uid' => 'our_third_field',
            'label' => 'Select',
            'section' => 'our_first_section',
            'type' => 'select',
            'options' => array
            (
                'yes' => 'Yes',
                'no' => 'No',
                'maybe' => 'Meh, whatever.'
            ),
            'placeholder' => 'Text goes here',
            //'helper' => 'Does this help?',
            //'supplemental' => 'I am underneath!',
            'default' => 'maybe'
        ),
        array
        (
            'uid' => 'awesome_multiselect',
            'label' => 'Sample Multi Select',
            'section' => 'our_first_section',
            'type' => 'multiselect',
            'options' => array(
                'option1' => 'Option 1',
                'option2' => 'Option 2',
                'option3' => 'Option 3',
                'option4' => 'Option 4',
                'option5' => 'Option 5',
            ),
            'default' => array()
        ),
        array
        (
            'uid' => 'awesome_radio',
            'label' => 'Sample Radio Buttons',
            'section' => 'our_first_section',
            'type' => 'radio',
            'options' => array(
                'option1' => 'Option 1',
                'option2' => 'Option 2',
                'option3' => 'Option 3',
                'option4' => 'Option 4',
                'option5' => 'Option 5',
            ),
            'default' => array()
        ),
        array
        (
            'uid' => 'awesome_checkboxes',
            'label' => 'Sample Checkboxes',
            'section' => 'our_first_section',
            'type' => 'checkbox',
            'options' => array(
                'option1' => 'Option 1',
                'option2' => 'Option 2',
                'option3' => 'Option 3',
                'option4' => 'Option 4',
                'option5' => 'Option 5',
            ),
            'default' => array()
        )
	);
	foreach( $fields as $field ){
		add_settings_field( $field['uid'], $field['label'], 'field_callback', 'Setting', $field['section'], $field );
		register_setting( 'Setting', $field['uid'] );
	}
}

function field_callback( $arguments ) 
{
    $value = get_option( $arguments['uid'] ); // Get the current value, if there is one
    if( ! $value ) // If no value exists
    { 
        $value = $arguments['default']; // Set to our default
    }

	// Check which type of field we want
    switch( $arguments['type'] )
    {
        case 'text': // If it is a text field
            printf( '<input name="%1$s" id="%1$s" type="%2$s" placeholder="%3$s" value="%4$s" />', $arguments['uid'], $arguments['type'], $arguments['placeholder'], $value );
            break;
        case 'password':
        case 'number':
            printf( '<input name="%1$s" id="%1$s" type="%2$s" placeholder="%3$s" value="%4$s" />', $arguments['uid'], $arguments['type'], $arguments['placeholder'], $value );
            break;
        case 'textarea': // If it is a textarea
            printf( '<textarea name="%1$s" id="%1$s" placeholder="%2$s" rows="5" cols="50">%3$s</textarea>', $arguments['uid'], $arguments['placeholder'], $value );
            break;
        case 'select': // If it is a select dropdown
            if( ! empty ( $arguments['options'] ) && is_array( $arguments['options'] ) )
            {
                $options_markup = '';
                foreach( $arguments['options'] as $key => $label )
                {
                    $options_markup .= sprintf( '<option value="%s" %s>%s</option>', $key, selected( $value, $key, false ), $label );
                }
                printf( '<select name="%1$s" id="%1$s">%2$s</select>', $arguments['uid'], $options_markup );
            }
            break;
        case 'multiselect':
            if( ! empty ( $arguments['options'] ) && is_array( $arguments['options'] ) )
            {
                $attributes = '';
                $options_markup = '';
                foreach( $arguments['options'] as $key => $label )
                {
                    $options_markup .= sprintf( '<option value="%s" %s>%s</option>', $key, selected( $value[ array_search( $key, $value, true ) ], $key, false ), $label );
                }
                if( $arguments['type'] === 'multiselect' )
                {
                    $attributes = ' multiple="multiple" ';
                }
                printf( '<select name="%1$s[]" id="%1$s" %2$s>%3$s</select>', $arguments['uid'], $attributes, $options_markup );
            }
            break;
        case 'radio':
        case 'checkbox':
            if( ! empty ( $arguments['options'] ) && is_array( $arguments['options'] ) )
            {
                $options_markup = '';
                $iterator = 0;
                foreach( $arguments['options'] as $key => $label )
                {
                    $iterator++;
                    $options_markup .= sprintf( '<label for="%1$s_%6$s"><input id="%1$s_%6$s" name="%1$s[]" type="%2$s" value="%3$s" %4$s /> %5$s</label><br/>', $arguments['uid'], $arguments['type'], $key, checked( $value[ array_search( $key, $value, true ) ], $key, false ), $label, $iterator );
                }
                printf( '<fieldset>%s</fieldset>', $options_markup );
            }
            break;
    }

	// If there is help text
    if( $helper = $arguments['helper'] ){
        printf( '<span class="helper"> %s</span>', $helper ); // Show it
    }

	// If there is supplemental text
    if( $supplimental = $arguments['supplemental'] ){
        printf( '<p class="description">%s</p>', $supplimental ); // Show it
    }
}