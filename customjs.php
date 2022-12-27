/**
 * Plugin Name: Custom Front-End JS
 * Description: Allows you to add custom JavaScript to the front-end of your WordPress site.
 * Version: 1.0
 * Author: Khairul Imran
 * Author URI: http://khairulimran.com
 */

// Create a function to register the settings page
function custom_js_settings_page() {
    add_options_page(
        'Custom JS Settings', // Page title
        'Custom Front-End JS', // Menu title
        'manage_options', // Capability
        'custom-js', // Menu slug
        'custom_js_settings_page_callback' // Callback function
    );
}
add_action( 'admin_menu', 'custom_js_settings_page' );

// Callback function for the settings page
function custom_js_settings_page_callback() {
    // Check user capability
    if ( !current_user_can( 'manage_options' ) ) {
        return;
    }
    ?>
    <div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <form action="options.php" method="post">
            <?php
            // Output nonce, action, and option_page fields for the settings page
            settings_fields( 'custom_js' );
            do_settings_sections( 'custom-js' );
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Function to register the plugin's settings
function custom_js_settings_init() {
    // Register a new setting
    register_setting( 'custom_js', 'custom_js_settings' );

    // Add a new section
    add_settings_section(
        'custom_js_section', // Section ID
        'Custom JS Settings', // Section title
        'custom_js_section_callback', // Section callback function
        'custom-js' // Menu slug
    );

    // Add fields for the header, body, and footer sections
    add_settings_field(
        'header_section', // Field ID
        'Header Section', // Field title
        'custom_js_header_callback', // Field callback function
        'custom-js', // Menu slug
        'custom_js_section' // Section ID
    );
    add_settings_field(
        'body_section', // Field ID
        'Body Section', // Field title
        'custom_js_body_callback', // Field callback function
        'custom-js', // Menu slug
        'custom_js_section' // Section ID
    );
    add_settings_field(
        'footer_section', // Field ID
        'Footer Section', // Field title
        'custom_js_footer_callback', // Field callback function
        'custom-js', // Menu slug
        'custom_js_section' // Section ID
    );
}
add_action( 'admin_init', 'custom_js_settings_init' );

// Callback function for the section
function custom_js_section_callback() {
    echo 'Enter your custom JavaScript below:';
}

// Callback functions for the fields
function custom_js_header_callback() {
    // Get the plugin's settings
    $settings = get_option( 'custom_js_settings' );
	
	// Enqueue the CodeMirror library
    wp_enqueue_script( 'codemirror', 'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.57.0/codemirror.min.js' );
	wp_enqueue_style( 'codemirror-theme', 'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.57.0/theme/night.css' );
    wp_enqueue_style( 'codemirror', 'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.57.0/codemirror.min.css' );
    wp_enqueue_style( 'codemirror-theme', 'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.57.0/theme/eclipse.min.css' );

    // Create a textarea element for the header section
    echo '<textarea id="header_section" name="custom_js_settings[header_section]" rows="10" cols="50">' . esc_textarea( $settings['header_section'] ) . '</textarea>';

    // Initialize the CodeMirror editor and set the autoclosebrackets option to true
    $inline_js = "
        jQuery(document).ready(function() {
            var editor = CodeMirror.fromTextArea(document.getElementById('header_section'), {
                lineNumbers: true,
                mode: 'javascript',
                theme: 'night',
                autoclosebrackets: true
            });
        });
    ";
    wp_add_inline_script( 'codemirror', $inline_js );
}


function custom_js_body_callback() {
    // Get the plugin's settings
    $settings = get_option( 'custom_js_settings' );
	
	 // Enqueue the CodeMirror library
    wp_enqueue_script( 'codemirror', 'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.57.0/codemirror.min.js' );
	wp_enqueue_style( 'codemirror-theme', 'https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/theme/night.css' );
    wp_enqueue_style( 'codemirror', 'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.57.0/codemirror.min.css' );
    wp_enqueue_style( 'codemirror-theme', 'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.57.0/theme/eclipse.min.css' );

    // Create a textarea element for the header section
    echo '<textarea id="body_section" name="custom_js_settings[body_section]" rows="10" cols="50">' . esc_textarea( $settings['body_section'] ) . '</textarea>';

    // Initialize the CodeMirror editor and set the autoclosebrackets option to true
    $inline_js = "
        jQuery(document).ready(function() {
            var editor = CodeMirror.fromTextArea(document.getElementById('body_section'), {
                lineNumbers: true,
                mode: 'javascript',
                theme: 'night',
                autoclosebrackets: true
            });
        });
    ";
    wp_add_inline_script( 'codemirror', $inline_js );
}

function custom_js_footer_callback() {
    // Get the plugin's settings
    $settings = get_option( 'custom_js_settings' );
	
	 // Enqueue the CodeMirror library
    wp_enqueue_script( 'codemirror', 'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.57.0/codemirror.min.js' );
	wp_enqueue_style( 'codemirror-theme', 'https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/theme/night.css' );
    wp_enqueue_style( 'codemirror', 'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.57.0/codemirror.min.css' );
    wp_enqueue_style( 'codemirror-theme', 'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.57.0/theme/eclipse.min.css' );

    // Initialize the CodeMirror editor and set the autoclosebrackets option to true
    $inline_js = "
        jQuery(document).ready(function() {
            var editor = CodeMirror.fromTextArea(document.getElementById('footer_section'), {
                lineNumbers: true,
                mode: 'javascript',
                theme: 'night',
                autoclosebrackets: true
            });
        });
    ";
    wp_add_inline_script( 'codemirror', $inline_js );

    
	// Create a CodeMirror textarea editor for the footer section
    echo '<textarea id="footer_section" name="custom_js_settings[footer_section]">';
    echo esc_textarea( $settings['footer_section'] );
    echo '</textarea>';
}

// Function to add the custom JavaScript to the appropriate section of the website
function custom_js_wp_head() {
    // Get the plugin's settings
    $settings = get_option( 'custom_js_settings' );

     // Print the custom JavaScript for the header section
    if ( !empty( $settings['header_section'] ) ) {
        echo $settings['header_section'];
    }
}
add_action( 'wp_head', 'custom_js_wp_head' );

function custom_js_wp_body() {
    // Get the plugin's settings
    $settings = get_option( 'custom_js_settings' );

    // Print the custom JavaScript for the body section
    if ( !empty( $settings['body_section'] ) ) {
		echo $settings['body_section'];
    }
}
add_action( 'wp_body_open', 'custom_js_wp_body' );

function custom_js_wp_footer() {
    // Get the plugin's settings
    $settings = get_option( 'custom_js_settings' );

    // Print the custom JavaScript for the footer section
    if ( !empty( $settings['footer_section'] ) ) {
		echo $settings['footer_section'];
    }
}
add_action( 'wp_footer', 'custom_js_wp_footer' );
