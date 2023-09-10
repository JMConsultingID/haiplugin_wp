<?php
// Add the plugin menu
function haiplugin_wp_lang_detection_menu() {
    add_menu_page('Hai Plugin', 'Hai Plugin', 'manage_options', 'haiplugin-wp', 'haiplugin_wp_lang_detection_settings_page_content');
    add_submenu_page('haiplugin-wp', 'Language Detection Form', 'Language Detection Form', 'manage_options', 'haiplugin-wp-lang-detection', 'haiplugin_wp_lang_detection_settings_page_content');
}
add_action('admin_menu', 'haiplugin_wp_lang_detection_menu');
// Render settings page content
function haiplugin_wp_lang_detection_settings_page_content() {
    ?>
    <div class="wrap">
        <h2>Hai Plugin</h2>
        <p>Description of the Plugin</p>
        <a href="https://app.edenai.run/bricks/translation/language-detection" target="_blank">Documentation and Pricing Provider</a>
        <form method="post" action="options.php">
            <?php
                settings_fields('haiplugin_wp_lang_detection_settings');
                do_settings_sections('haiplugin_wp_lang_detection_settings');
                submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Add plugin settings fields
function haiplugin_wp_lang_detection_settings_fields() {
    // Example: Add the "Enable Plugin" setting field
    add_settings_field(
        'haiplugin_wp_lang_detection_enabled',
        'Enable Plugin',
        'haiplugin_wp_lang_detection_enabled_callback',
        'haiplugin_wp_lang_detection_settings',
        'haiplugin_wp_lang_detection_general'
    );
    // Register "Enable Plugin" setting
    register_setting(
        'haiplugin_wp_lang_detection_settings', // Option group
        'haiplugin_wp_lang_detection_enabled',  // Option name
        array(
            'type' => 'string',
            'sanitize_callback' => 'haiplugin_wp_lang_detection_sanitize_enabled'
        )
    );
}
add_action('admin_init', 'haiplugin_wp_lang_detection_settings_fields');

// Render "Enable Plugin" field
function haiplugin_wp_lang_detection_enabled_callback() {
    $enabled = get_option('haiplugin_wp_lang_detection_enabled');
    ?>
    <select name="haiplugin_wp_lang_detection_enabled">
        <option value="enable" <?php selected($enabled, 'enable'); ?>>Enable</option>
        <option value="disable" <?php selected($enabled, 'disable'); ?>>Disable</option>
    </select>
    <?php
}