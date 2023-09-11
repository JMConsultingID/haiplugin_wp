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
        <h2>Hai Plugin - Language Detection Form</h2>
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
    add_settings_section(
        'haiplugin_wp_lang_detection_general',
        'General Settings',
        NULL,
        'haiplugin_wp_lang_detection_settings'
    );
    add_settings_field(
        'haiplugin_wp_lang_detection_enabled',
        'Enable Plugin',
        'haiplugin_wp_lang_detection_enabled_callback',
        'haiplugin_wp_lang_detection_settings',
        'haiplugin_wp_lang_detection_general'
    );
    // Add the "Endpoint URL" setting field
    add_settings_field(
        'haiplugin_wp_lang_detection_endpoint_url',
        'Endpoint URL',
        'haiplugin_wp_lang_detection_endpoint_url_callback',
        'haiplugin_wp_lang_detection_settings',
        'haiplugin_wp_lang_detection_general'
    );
    // Add the "API KEY" setting field
    add_settings_field(
        'haiplugin_wp_lang_detection_api_key',
        'API KEY',
        'haiplugin_wp_lang_detection_api_key_callback',
        'haiplugin_wp_lang_detection_settings',
        'haiplugin_wp_lang_detection_general'
    );
    // Add the "Provider" setting field
    add_settings_field(
        'haiplugin_wp_lang_detection_provider',
        'Provider',
        'haiplugin_wp_lang_detection_provider_callback',
        'haiplugin_wp_lang_detection_settings',
        'haiplugin_wp_lang_detection_general'
    );
    // Add the "Language Detection" setting field
    add_settings_field(
        'haiplugin_wp_lang_detection_language',
        'Language Detection',
        'haiplugin_wp_lang_detection_language_callback',
        'haiplugin_wp_lang_detection_settings',
        'haiplugin_wp_lang_detection_general'
    );
    // Add the "Select Form Engine" setting field
    add_settings_field(
        'haiplugin_wp_lang_detection_form_engine',
        'Select Form Engine',
        'haiplugin_wp_lang_detection_form_engine_callback',
        'haiplugin_wp_lang_detection_settings',
        'haiplugin_wp_lang_detection_general'
    );
    // Add the "Select WP Form" setting field
    add_settings_field(
        'haiplugin_wp_lang_detection_wp_form',
        'Select WP Form',
        'haiplugin_wp_lang_detection_wp_form_callback',
        'haiplugin_wp_lang_detection_settings',
        'haiplugin_wp_lang_detection_general'
    );
     // Add the "Select Field WP Form" setting field
    add_settings_field(
        'haiplugin_wp_lang_detection_wp_form_field',
        'Select Field WP Form',
        'haiplugin_wp_lang_detection_wp_form_field_callback',
        'haiplugin_wp_lang_detection_settings',
        'haiplugin_wp_lang_detection_general'
    );
    register_setting(
        'haiplugin_wp_lang_detection_settings', // Option group
        'haiplugin_wp_lang_detection_enabled',  // Option name
        array(
        	'type' => 'string',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    register_setting(
        'haiplugin_wp_lang_detection_settings', // Option group
        'haiplugin_wp_lang_detection_endpoint_url',  // Option name
        array(
        	'type' => 'string',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    register_setting(
        'haiplugin_wp_lang_detection_settings', // Option group
        'haiplugin_wp_lang_detection_api_key',  // Option name
        array(
        	'type' => 'string',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    register_setting(
        'haiplugin_wp_lang_detection_settings', // Option group
        'haiplugin_wp_lang_detection_provider',  // Option name
        array(
        	'type' => 'string',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    register_setting(
        'haiplugin_wp_lang_detection_settings', // Option group
        'haiplugin_wp_lang_detection_language',  // Option name
        array(
        	'type' => 'string',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    register_setting(
        'haiplugin_wp_lang_detection_settings', // Option group
        'haiplugin_wp_lang_detection_form_engine',  // Option name
        array(
        	'type' => 'string',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    register_setting(
        'haiplugin_wp_lang_detection_settings', // Option group
        'haiplugin_wp_lang_detection_wp_form',  // Option name
        array(
        	'type' => 'string',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    register_setting(
        'haiplugin_wp_lang_detection_settings', // Option group
        'haiplugin_wp_lang_detection_wp_form_field',  // Option name
        array(
        	'type' => 'string',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
}
add_action('admin_init', 'haiplugin_wp_lang_detection_settings_fields');

// Render general settings section callback
function haiplugin_wp_lang_detection_general_section_callback() {
    echo 'Configure the general settings Plugin.';
}

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

// Render "Endpoint URL" field
function haiplugin_wp_lang_detection_endpoint_url_callback() {
    $endpoint_url = get_option('haiplugin_wp_lang_detection_endpoint_url', ''); // Default value is an empty string
    ?>
    <input type="text" name="haiplugin_wp_lang_detection_endpoint_url" value="<?php echo esc_attr($endpoint_url); ?>" class="regular-text">
    <p class="description">Enter the endpoint URL for the Edenai API.</p>
    <?php
}

// Render "API KEY" field
function haiplugin_wp_lang_detection_api_key_callback() {
    $api_key = get_option('haiplugin_wp_lang_detection_api_key', ''); // Default value is an empty string
    ?>
    <input type="text" name="haiplugin_wp_lang_detection_api_key" value="<?php echo esc_attr($api_key); ?>" class="regular-text">
    <p class="description">Enter your Edenai API key.</p>
    <?php
}

// Render "Provider" select field
function haiplugin_wp_lang_detection_provider_callback() {
    $current_provider = get_option('haiplugin_wp_lang_detection_provider', 'microsoft'); // Default value is 'microsoft'
    $providers = array(
        'amazon' => 'Amazon',
        'microsoft' => 'Microsoft',
        'neuralspace' => 'Neuralspace',
        'modernmt' => 'ModernMT',
        'google' => 'Google',
        'openai' => 'OpenAI'
    );
    ?>
    <select name="haiplugin_wp_lang_detection_provider">
        <?php foreach ($providers as $key => $label): ?>
            <option value="<?php echo esc_attr($key); ?>" <?php selected($current_provider, $key); ?>><?php echo esc_html($label); ?></option>
        <?php endforeach; ?>
    </select>
    <?php
}
// Render "Language Detection" select field
function haiplugin_wp_lang_detection_language_callback() {
    $current_language = get_option('haiplugin_wp_lang_detection_language', 'en'); // Default value is 'en'
    $languages = array(
        'en' => 'English'
    );
    ?>
    <select name="haiplugin_wp_lang_detection_language">
        <?php foreach ($languages as $key => $label): ?>
            <option value="<?php echo esc_attr($key); ?>" <?php selected($current_language, $key); ?>><?php echo esc_html($label); ?></option>
        <?php endforeach; ?>
    </select>
    <?php
}
// Render "Select Form Engine" select field
function haiplugin_wp_lang_detection_form_engine_callback() {
    $current_engine = get_option('haiplugin_wp_lang_detection_form_engine', 'wpform'); // Default value is 'wpform'
    $engines = array(
        'wpform' => 'WPForm'
    );
    ?>
    <select name="haiplugin_wp_lang_detection_form_engine">
        <?php foreach ($engines as $key => $label): ?>
            <option value="<?php echo esc_attr($key); ?>" <?php selected($current_engine, $key); ?>><?php echo esc_html($label); ?></option>
        <?php endforeach; ?>
    </select>
    <?php
}
// Render "Select WP Form" select field
function haiplugin_wp_lang_detection_wp_form_callback() {
    $current_form = get_option('haiplugin_wp_lang_detection_wp_form');
    $forms = array();

    // Check if WPForm is active
    if (function_exists('wpforms')) {
        $wpforms = wpforms()->form->get();
        if (!empty($wpforms)) {
            foreach ($wpforms as $form) {
                $forms['wpforms-form-' . $form->ID] = $form->post_title;
            }
        }
    }
    ?>
    <select name="haiplugin_wp_lang_detection_wp_form">
        <?php foreach ($forms as $key => $label): ?>
            <option value="<?php echo esc_attr($key); ?>" <?php selected($current_form, $key); ?>><?php echo esc_html($label); ?></option>
        <?php endforeach; ?>
    </select>
    <?php
}
// Render "Select Field WP Form" select field
function haiplugin_wp_lang_detection_wp_form_field_callback() {
    $current_field = get_option('haiplugin_wp_lang_detection_wp_form_field');
    $selected_form_id = get_option('haiplugin_wp_lang_detection_wp_form');

    if ($selected_form_id) {
        $form_id = str_replace('wpforms-form-', '', $selected_form_id);
        $form = wpforms()->form->get($form_id);
        if ($form) {
            $fields = wpforms_decode($form->post_content);
            ?>
            <select name="haiplugin_wp_lang_detection_wp_form_field">
                <?php foreach ($fields['fields'] as $field): ?>
                    <option value="<?php echo esc_attr('wpforms-' . $form_id . '-field_' . $field['id']); ?>" <?php selected($current_field, 'wpforms-' . $form_id . '-field_' . $field['id']); ?>><?php echo esc_html($field['label']); ?></option>
                <?php endforeach; ?>
            </select>
            <?php
        } else {
            echo '<p>No fields found for the selected form.</p>';
        }
    } else {
        echo '<p>Please select a WP Form first.</p>';
    }
}



// Check if the plugin is enabled
$plugin_enabled = get_option('haiplugin_wp_lang_detection_enabled');
if ($plugin_enabled === 'enable') {
    add_action('wp_footer', 'haiplugin_wp_lang_detection_script');
}

// Check if the plugin is enabled
$plugin_enabled = get_option('haiplugin_wp_lang_detection_enabled');
if ($plugin_enabled === 'enable') {
    add_action('wp_footer', 'haiplugin_wp_lang_detection_script');
}

function haiplugin_wp_lang_detection_script() {
    $contactForm = get_option('haiplugin_wp_lang_detection_wp_form');
    $messageField = get_option('haiplugin_wp_lang_detection_wp_form_field');
    $authorization = get_option('haiplugin_wp_lang_detection_api_key');
    $endpoint = get_option('haiplugin_wp_lang_detection_endpoint_url');
    $providerName = get_option('haiplugin_wp_lang_detection_provider');
    ?>
    <script>
        console.log('language Detection Active 1');
        (function( $ ) {
            'use strict';

            const submitButton = document.getElementById('wpforms-submit-<?php echo esc_js(str_replace('wpforms-form-', '', $contactForm)); ?>');
            const textareaElement = document.getElementById('<?php echo esc_js($messageField); ?>');
            let lastCheckedText = ""; // To store the last checked 5 words

            function debounce(func, wait) {
                let timeout;
                return function() {
                    const context = this, args = arguments;
                    const later = function() {
                        timeout = null;
                        func.apply(context, args);
                    };
                    clearTimeout(timeout);
                    timeout = setTimeout(later, wait);
                };
            }

            // Function to remove the warning message
            function removeWarningMessage() {
                const existingWarning = document.getElementById('languageWarning');
                if (existingWarning) {
                    existingWarning.remove();
                }
            }

            const detectLanguage = debounce(function() {
                let message = textareaElement.value;
                const words = message.split(' ').filter(Boolean); // filter(Boolean) removes empty strings

                removeWarningMessage();

                if (words.length >= 5) { // Threshold of 5 words
                    message = words.slice(0, 5).join(' ');

                    if (message !== lastCheckedText) { // Check if the first 5 words have changed
                        lastCheckedText = message; // Update the last checked text
                        const providerName = '<?php echo esc_js($providerName); ?>';
                        console.log('language Detection Active 2');

                        const options = {
                            method: 'POST',
                            headers: {
                                accept: 'application/json',
                                'content-type': 'application/json',
                                authorization: 'Bearer <?php echo esc_js($authorization); ?>'
                            },
                            body: JSON.stringify({
                                text: message,
                                response_as_dict: true,
                                attributes_as_list: false,
                                show_original_response: false,
                                providers: providerName
                            })
                        };

                        fetch('<?php echo esc_url($endpoint); ?>', options)
                            .then(response => response.json())
                            .then(data => {
                                const detectedLanguage = data[providerName].items[0].language;
                                if (detectedLanguage !== 'en') {
                                    const warningMessage = document.createElement('div');
                                    warningMessage.id = 'languageWarning';
                                    warningMessage.textContent = 'Please submit the form in English.';
                                    warningMessage.style.color = 'red';
                                    textareaElement.parentNode.insertBefore(warningMessage, textareaElement.nextSibling);
                                    submitButton.disabled = true;
                                    console.log('language Detection Active 3 Success');
                                } else {
                                    removeWarningMessage();
                                    submitButton.disabled = false;
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                console.log('language Detection Active 4 Error');
                            });
                    }
                }
            }, 500); // Debounce time of 500ms

            textareaElement.addEventListener('input', detectLanguage);

        })( jQuery );
    </script>
    <?php
}
