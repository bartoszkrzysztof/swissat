<?php
/**
 * Settings Page dla modułu Contact Form
 */

if (!defined('ABSPATH')) {
    exit;
}

class CF_Settings {

    /**
     * Option name dla ustawień
     */
    const OPTION_NAME = 'cf_module_settings';

    public function __construct()
    {
        add_action('admin_menu', [$this, 'add_settings_page']);
        add_action('admin_init', [$this, 'register_settings']);
    }

    /**
     * Dodaje stronę ustawień do menu
     */
    public function add_settings_page()
    {
        add_submenu_page(
            'edit.php?post_type=cf-form',
            'Ustawienia modułu',
            'Ustawienia',
            'manage_options',
            'cf-settings',
            [$this, 'render_settings_page']
        );
    }

    /**
     * Rejestruje ustawienia modułu
     */
    public function register_settings()
    {
        register_setting(
            'cf_settings_group',
            self::OPTION_NAME,
            [$this, 'sanitize_settings']
        );

        // Sekcja: Google reCAPTCHA
        add_settings_section(
            'cf_recaptcha_section',
            'Google reCAPTCHA v2',
            [$this, 'render_recaptcha_section'],
            'cf-settings'
        );

        // Pole: reCAPTCHA Site Key
        add_settings_field(
            'recaptcha_site_key',
            'Site Key',
            [$this, 'render_site_key_field'],
            'cf-settings',
            'cf_recaptcha_section'
        );

        // Pole: reCAPTCHA Secret Key
        add_settings_field(
            'recaptcha_secret_key',
            'Secret Key',
            [$this, 'render_secret_key_field'],
            'cf-settings',
            'cf_recaptcha_section'
        );
    }

    /**
     * Renderuje stronę ustawień
     */
    public function render_settings_page()
    {
        if (!current_user_can('manage_options')) {
            return;
        }

        // Sprawdź czy zapisano ustawienia
        if (isset($_GET['settings-updated'])) {
            add_settings_error(
                'cf_messages',
                'cf_message',
                'Ustawienia zostały zapisane',
                'updated'
            );
        }

        settings_errors('cf_messages');
        ?>
        <div class="wrap">
            <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
            
            <form action="options.php" method="post">
                <?php
                settings_fields('cf_settings_group');
                do_settings_sections('cf-settings');
                submit_button('Zapisz ustawienia');
                ?>
            </form>
            
            <div class="card" style="max-width: 800px; margin-top: 20px;">
                <h2>Jak uzyskać klucze Google reCAPTCHA?</h2>
                <ol>
                    <li>Przejdź na stronę: <a href="https://www.google.com/recaptcha/admin" target="_blank">https://www.google.com/recaptcha/admin</a></li>
                    <li>Zaloguj się na konto Google</li>
                    <li>Kliknij przycisk "+" aby dodać nową witrynę</li>
                    <li>Wybierz <strong>reCAPTCHA v2</strong> → <strong>"Nie jestem robotem" Checkbox</strong></li>
                    <li>Wpisz domenę swojej witryny</li>
                    <li>Skopiuj otrzymane klucze i wklej powyżej</li>
                </ol>
                <p class="description">
                    <strong>Uwaga:</strong> Po zapisaniu kluczy, możesz włączyć reCAPTCHA dla poszczególnych formularzy w ich ustawieniach.
                </p>
            </div>
        </div>
        <?php
    }

    /**
     * Renderuje opis sekcji reCAPTCHA
     */
    public function render_recaptcha_section()
    {
        echo '<p>Skonfiguruj klucze Google reCAPTCHA v2 aby zabezpieczyć formularze przed spamem.</p>';
    }

    /**
     * Renderuje pole Site Key
     */
    public function render_site_key_field()
    {
        $options = get_option(self::OPTION_NAME, []);
        $value = isset($options['recaptcha_site_key']) ? $options['recaptcha_site_key'] : '';
        ?>
        <input type="text" 
               name="<?php echo self::OPTION_NAME; ?>[recaptcha_site_key]" 
               value="<?php echo esc_attr($value); ?>" 
               class="regular-text"
               placeholder="6Lc...">
        <p class="description">Klucz publiczny (Site Key) z panelu Google reCAPTCHA</p>
        <?php
    }

    /**
     * Renderuje pole Secret Key
     */
    public function render_secret_key_field()
    {
        $options = get_option(self::OPTION_NAME, []);
        $value = isset($options['recaptcha_secret_key']) ? $options['recaptcha_secret_key'] : '';
        ?>
        <input type="text" 
               name="<?php echo self::OPTION_NAME; ?>[recaptcha_secret_key]" 
               value="<?php echo esc_attr($value); ?>" 
               class="regular-text"
               placeholder="6Lc...">
        <p class="description">Klucz tajny (Secret Key) z panelu Google reCAPTCHA</p>
        <?php
    }

    /**
     * Sanityzuje zapisywane ustawienia
     */
    public function sanitize_settings($input)
    {
        $sanitized = [];

        if (isset($input['recaptcha_site_key'])) {
            $sanitized['recaptcha_site_key'] = sanitize_text_field($input['recaptcha_site_key']);
        }

        if (isset($input['recaptcha_secret_key'])) {
            $sanitized['recaptcha_secret_key'] = sanitize_text_field($input['recaptcha_secret_key']);
        }

        return $sanitized;
    }

    /**
     * Pobiera wartość ustawienia
     */
    public static function get_option($key, $default = '')
    {
        $options = get_option(self::OPTION_NAME, []);
        return isset($options[$key]) ? $options[$key] : $default;
    }

    /**
     * Sprawdza czy reCAPTCHA jest skonfigurowana
     */
    public static function is_recaptcha_configured()
    {
        $site_key = self::get_option('recaptcha_site_key');
        $secret_key = self::get_option('recaptcha_secret_key');
        
        return !empty($site_key) && !empty($secret_key);
    }

    /**
     * Pobiera Site Key
     */
    public static function get_site_key()
    {
        return self::get_option('recaptcha_site_key');
    }

    /**
     * Pobiera Secret Key
     */
    public static function get_secret_key()
    {
        return self::get_option('recaptcha_secret_key');
    }
}
