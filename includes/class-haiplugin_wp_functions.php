<?php
// Add the plugin menu
add_action('admin_menu', 'haiplugin_wp_lang_detection_menu');
function haiplugin_wp_lang_detection_menu() {
    add_menu_page('Hai Plugin', 'Hai Plugin', 'manage_options', 'haiplugin-wp', 'haiplugin_wp_lang_detection_main_content', 'dashicons-shield', 22);
    add_submenu_page('haiplugin-wp', 'Language Detection Form', 'Language Detection Form', 'manage_options', 'haiplugin-wp-lang-detection', 'haiplugin_wp_lang_detection_settings_page_content');
}
// Fungsi untuk menampilkan halaman settings
function haiplugin_wp_lang_detection_main_content() {
    $settings_link = admin_url('admin.php?page=haiplugin-wp-lang-detection');
    ?>
    <div class="wrap">
        <h2>Hai Plugin Settings</h2>
        <h3>Description</h3>
        <p>This plugin is designed to prevent spam by detecting the language used in the message field of your form engine.<br/>
        <a href="https://docs.edenai.co/reference/translation_language_detection_create" target="_blank">Documentation and Pricing Provider</a></p>

        <!-- Installation Instructions -->
        <h3>Installation Instructions</h3>
        <ol>
            <li><strong>Upload the Plugin:</strong>
                <ul>
                    <li>Download the plugin ZIP file.</li>
                    <li>Navigate to your WordPress dashboard.</li>
                    <li>Go to <code>Plugins > Add New > Upload Plugin</code>.</li>
                    <li>Choose the downloaded ZIP file and click <code>Install Now</code>.</li>
                </ul>
            </li>
            <li><strong>Activate the Plugin:</strong>
                <ul>
                    <li>After installation, click <code>Activate Plugin</code>.</li>
                </ul>
            </li>
            <li><strong>Configure the Plugin:</strong>
                <ul>
                    <li>Navigate to the settings page of the plugin in your WordPress dashboard.</li>
                    <li>Select the desired form engine and specify the message field where the language detection should occur.</li>
                    <li>Enter the necessary API details for language detection.</li>
                    <li>Save your settings.</li>
                </ul>
            </li>
            <li><strong>Usage:</strong>
                <ul>
                    <li>Once configured, the plugin will automatically detect the language of the message field in the selected form engine.</li>
                    <li>If the detected language is not the desired one (e.g., English), the plugin will prevent form submission and display an error message, helping to reduce spam.</li>
                </ul>
            </li>
            <li><strong>Notes:</strong>
                <ul>
                    <li>Ensure that your form engine is compatible with this plugin.</li>
                    <li>Regularly check the logs to monitor the plugin's activity and ensure it's working as expected.</li>
                    <li>If you have any questions, please send an email to ardi@jm-consulting.id.</li>     
                    <li>Enjoy Using this Plugin.</li>
                </ul>
            </li>
        </ol>

        <p>Setup Plugin :
        <ol>
            <li><a href="<?php echo esc_url($settings_link); ?>">Go to Language Detection Settings</a></li>
        </ol>
        <!-- Watermark Footer -->
        <footer style="margin-top: 50px; font-size: 0.8em; text-align: center; opacity: 0.6;">
            Developed by <a href="mailto:ardi@jm-consulting.id">ardi@jm-consulting.id</a>
        </footer>
    </div>
    <?php
}


// Render settings page content
function haiplugin_wp_lang_detection_settings_page_content() {
    ?>
    <div class="wrap">        
        <form method="post" action="options.php">
            <?php
                settings_fields('haiplugin_wp_lang_detection_settings');
                do_settings_sections('haiplugin_wp_lang_detection_settings');
                ?>
                <!-- Reset to Default Button -->
                <input type="submit" name="haiplugin_wp_reset" id="reset" class="button button-secondary" value="Reset to Default">
                <?php
                submit_button();
            ?>
        </form>
        <!-- Watermark Footer -->
        <footer style="margin-top: 50px; font-size: 0.8em; text-align: center; opacity: 0.6;">
            Developed by <a href="mailto:ardi@jm-consulting.id">ardi@jm-consulting.id</a>
        </footer>
    </div>
    <?php
}

function haiplugin_wp_handle_reset() {
    if (isset($_POST['haiplugin_wp_reset'])) {
        update_option('haiplugin_wp_lang_detection_enabled', 'disable');
        update_option('haiplugin_wp_lang_detection_endpoint_url', 'https://api.edenai.run/v2/translation/language_detection'); // Default value is an empty string
        update_option('haiplugin_wp_lang_detection_api_key', 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyX2lkIjoiMmMyY2FkZDMtYmFkNS00MTkyLWE5OTEtNzAwMzJjMmUwYTI1IiwidHlwZSI6ImFwaV90b2tlbiJ9.qbIW8ot9u8cR5MgrP4pbTuV4hJqWCF_TyXcTkbCeikA'); // Default value is an empty string
        update_option('haiplugin_wp_lang_detection_provider', 'microsoft'); // Default value is 'microsoft'
        update_option('haiplugin_wp_lang_detection_language', 'en'); // Default value is 'en'
        update_option('haiplugin_wp_lang_detection_word_count', '5 Words');
        update_option('haiplugin_wp_lang_detection_error_message', 'Please submit the form in English.');
        update_option('haiplugin_wp_lang_detection_form_engine', 'wpform'); // Default value is 'wpform'
        wp_redirect(add_query_arg(['settings-updated' => 'true'], admin_url('admin.php?page=haiplugin-wp-lang-detection')));
        exit;
    }
}
add_action('admin_init', 'haiplugin_wp_handle_reset');



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
    // Word Detection After
    add_settings_field(
        'haiplugin_wp_lang_detection_word_count',
        'Word Detection After',
        'haiplugin_wp_lang_detection_word_count_callback',
        'haiplugin_wp_lang_detection_settings',
        'haiplugin_wp_lang_detection_general'
    );
    // Error Message
    add_settings_field(
        'haiplugin_wp_lang_detection_error_message',
        'Error Message',
        'haiplugin_wp_lang_detection_error_message_callback',
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
        'haiplugin_wp_lang_detection_word_count',  // Option name
        array(
            'type' => 'string',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    register_setting(
        'haiplugin_wp_lang_detection_settings', // Option group
        'haiplugin_wp_lang_detection_error_message',  // Option name
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
    $enabled = get_option('haiplugin_wp_lang_detection_enabled', 'disable');
    ?>
    <select name="haiplugin_wp_lang_detection_enabled">
        <option value="enable" <?php selected($enabled, 'enable'); ?>>Enable</option>
        <option value="disable" <?php selected($enabled, 'disable'); ?>>Disable</option>
    </select>
    <?php
}

// Render "Endpoint URL" field
function haiplugin_wp_lang_detection_endpoint_url_callback() {
    $endpoint_url = get_option('haiplugin_wp_lang_detection_endpoint_url', 'https://api.edenai.run/v2/translation/language_detection'); // Default value is an empty string
    ?>
    <input type="text" name="haiplugin_wp_lang_detection_endpoint_url" value="<?php echo esc_attr($endpoint_url); ?>" class="regular-text">
    <p class="description">Enter the endpoint URL for the Edenai API.</p>
    <?php
}

// Render "API KEY" field
function haiplugin_wp_lang_detection_api_key_callback() {
    $api_key = get_option('haiplugin_wp_lang_detection_api_key', 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyX2lkIjoiMmMyY2FkZDMtYmFkNS00MTkyLWE5OTEtNzAwMzJjMmUwYTI1IiwidHlwZSI6ImFwaV90b2tlbiJ9.qbIW8ot9u8cR5MgrP4pbTuV4hJqWCF_TyXcTkbCeikA'); // Default value is an empty string
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
// Callback for Word Detection After
function haiplugin_wp_lang_detection_word_count_callback() {
    $word_count = get_option('haiplugin_wp_lang_detection_word_count', '5 Words');
    $options = ["1 Word", "2 Words", "3 Words", "4 Words", "5 Words", "6 Words", "7 Words", "8 Words", "9 Words", "10 Words"];
    echo '<select name="haiplugin_wp_lang_detection_word_count">';
    foreach ($options as $option) {
        echo '<option value="' . $option . '" ' . selected($word_count, $option, false) . '>' . $option . '</option>';
    }
    echo '</select>';
}

// Callback for Error Message
function haiplugin_wp_lang_detection_error_message_callback() {
    $error_message = get_option('haiplugin_wp_lang_detection_error_message', 'Please submit the form in English.');
    echo '<input type="text" name="haiplugin_wp_lang_detection_error_message" value="' . esc_attr($error_message) . '" class="regular-text">';
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

function is_wpform_present($form_id) {
    global $post;
    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'wpforms') && strpos($post->post_content, 'id="' . $form_id . '"') !== false) {
        return true;
    }
    return false;
}

function haiplugin_wp_enqueue_scripts() {
    $form_id = str_replace('wpforms-form-', '', get_option('haiplugin_wp_lang_detection_wp_form'));
    $plugin_enabled = get_option('haiplugin_wp_lang_detection_enabled');
    if (is_wpform_present($form_id)) {        
        if ($plugin_enabled === 'enable') {
            // Enqueue your scripts or inline scripts here
            add_action('wp_footer', 'haiplugin_wp_lang_detection_script', 20);
        }
    }
}
add_action('wp_enqueue_scripts', 'haiplugin_wp_enqueue_scripts');

function haiplugin_wp_lang_detection_script() {
    $contactForm = get_option('haiplugin_wp_lang_detection_wp_form');
    $messageField = get_option('haiplugin_wp_lang_detection_wp_form_field');
    $authorization = get_option('haiplugin_wp_lang_detection_api_key');
    $endpoint = get_option('haiplugin_wp_lang_detection_endpoint_url');
    $providerName = get_option('haiplugin_wp_lang_detection_provider');
    $wordCount = intval(explode(' ', get_option('haiplugin_wp_lang_detection_word_count', '5 Words'))[0]);
    $errorMessage = get_option('haiplugin_wp_lang_detection_error_message', 'Please submit the form in English.'); // Default message if not set
    ?>
    <script>
        console.log('language Detection Active 1');
        (function( $ ) {
            'use strict';

            const submitButton = document.getElementById('wpforms-submit-<?php echo esc_js(str_replace('wpforms-form-', '', $contactForm)); ?>');
            const textareaElement = document.getElementById('<?php echo esc_js($messageField); ?>');
            let lastCheckedText = ""; // To store the last checked 5 words
            const wordThreshold = <?php echo $wordCount; ?>;
            const warningMessageText = "<?php echo esc_js($errorMessage); ?>";
            const messageFieldID = "<?php echo esc_js($messageField); ?>";
            const warningMessage = document.createElement('em');
            warningMessage.id = messageFieldID + '-languageWarning';
            warningMessage.className = 'wpforms-error-radius';
            warningMessage.setAttribute('role', 'alert');
            warningMessage.setAttribute('aria-label', 'Error message');
            warningMessage.style.color = 'red';

            function sendLogToServer(message, type = 'info') {
                jQuery.ajax({
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    type: 'POST',
                    data: {
                        action: 'haiplugin_wp_log_action',
                        message: message,
                        type: type
                    },
                    success: function(response) {
                        if (response.data && response.data.message) {
                            console.log(response.data.message);
                        } else {
                            console.warn('Unexpected server response:', response);
                        }
                    },
                    error: function() {
                        console.error('Failed to send log to server.');
                    }
                });
            }


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
                const existingWarning = document.getElementById(messageFieldID + '-languageWarning');
                if (existingWarning) {
                    existingWarning.remove();
                }
            }

            textareaElement.addEventListener('input', function() {
                if (!this.value.trim()) {
                    submitButton.disabled = false;
                    removeWarningMessage();
                }
            });

            const detectLanguage = debounce(function() {
                let message = textareaElement.value;
                const words = this.value.split(/\s+/).filter(Boolean); // Split by whitespace and remove empty strings

                if (words.length % wordThreshold === 0 && words.length !== 0) { // Threshold of 5 words
                    message = this.value; // Use the entire text for detection

                        const providerName = '<?php echo esc_js($providerName); ?>';
                        console.log('language Detection Preparing Data');

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
                                const detectedConfidence = data[providerName].items[0].confidence;
                                sendLogToServer("1. Plugin received API response. Detected language: " + detectedLanguage);
                                console.log('language Detection : '+detectedLanguage + ' | confidence : '+detectedConfidence);
                                if (detectedLanguage !== 'en') {
                                    if (detectedConfidence < 0.98) {
                                    textareaElement.parentNode.insertBefore(warningMessage, textareaElement.nextSibling);
                                    warningMessage.textContent = warningMessageText;
                                    submitButton.disabled = true;
                                    console.log('message : '+message);
                                    console.log('language Detection is not English : '+detectedLanguage + ' | confidence : '+detectedConfidence);
                                    } else {
                                        console.log('message : '+message);
                                        submitButton.disabled = false;
                                    }
                                } else {
                                    removeWarningMessage();
                                    console.log('message : '+message);
                                    submitButton.disabled = false;
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                console.log('language Detection Active 4 Error : '+error);
                                sendLogToServer("3. Plugin encountered an error: " + error, "error");
                                removeWarningMessage();
                                submitButton.disabled = false;
                            });
                }
                if (!this.value.trim()) { // If textarea is empty or just whitespace
                    submitButton.disabled = false; // Enable the submit button
                }
            }, 500); // Debounce time of 500ms

            textareaElement.addEventListener('input', detectLanguage);

        })( jQuery );
    </script>
    <?php
}
function haiplugin_wp_log($message, $type = 'info') {
    $log_file = WP_CONTENT_DIR . '/haiplugin_wp_log.log'; // Lokasi file log di direktori wp-content

    // Format pesan log
    $log_message = date('Y-m-d H:i:s') . " [$type] $message" . PHP_EOL;

    // Tambahkan pesan ke file log
    error_log($log_message, 3, $log_file);
}
// Fungsi untuk menangani permintaan AJAX
function haiplugin_wp_ajax_log_handler() {
    $message = isset($_POST['message']) ? sanitize_text_field($_POST['message']) : '';
    $type = isset($_POST['type']) ? sanitize_text_field($_POST['type']) : 'info';

    haiplugin_wp_log($message, $type);

    wp_send_json_success(['message' => 'Logged successfully']);
}

// Mendaftarkan handler AJAX untuk user yang logged in dan yang tidak
add_action('wp_ajax_haiplugin_wp_log_action', 'haiplugin_wp_ajax_log_handler'); // Jika user logged in
add_action('wp_ajax_nopriv_haiplugin_wp_log_action', 'haiplugin_wp_ajax_log_handler'); // Jika user tidak logged in