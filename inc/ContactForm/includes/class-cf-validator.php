<?php
/**
 * Walidator dla formularzy kontaktowych
 */

if (!defined('ABSPATH')) {
    exit;
}

class CF_Validator {

    private $errors = [];

    /**
     * Waliduje dane formularza
     * 
     * @param array $form_data Dane z formularza
     * @param array $fields_config Konfiguracja pól
     * @param array $files Przesłane pliki
     * @param int $form_id ID formularza
     * @return array Wynik walidacji
     */
    public function validate($form_data, $fields_config = [], $files = [], $form_id = 0)
    {
        $this->errors = [];

        // Walidacja reCAPTCHA jeśli jest włączona
        if ($form_id > 0) {
            $enable_recaptcha = get_post_meta($form_id, '_cf_enable_recaptcha', true);
            if ($enable_recaptcha && CF_Settings::is_recaptcha_configured()) {
                $this->validate_recaptcha($form_data);
            }
        }

        // Walidacja na podstawie konfiguracji pól
        if (!empty($fields_config) && is_array($fields_config)) {
            foreach ($fields_config as $field) {
                $this->validate_field($form_data, $field);
            }
        } else {
            // Domyślna walidacja dla przykładowych pól
            $this->validate_default_fields($form_data);
        }

        // Walidacja plików
        if (!empty($files)) {
            $this->validate_files($files, $fields_config);
        }

        // Hook pozwalający na dodanie własnej walidacji
        $this->errors = apply_filters('cf_custom_validation', $this->errors, $form_data, $fields_config);

        return [
            'valid' => empty($this->errors),
            'errors' => $this->errors,
        ];
    }

    /**
     * Waliduje pojedyncze pole
     * 
     * @param array $form_data Dane formularza
     * @param array $field Konfiguracja pola
     */
    private function validate_field($form_data, $field)
    {
        $name = $field['name'] ?? '';
        $label = $field['label'] ?? $name;
        $type = $field['type'] ?? 'text';
        $required = $field['required'] ?? false;
        $value = $form_data[$name] ?? '';

        // Sprawdzenie czy pole jest wymagane
        if ($required && empty($value)) {
            $this->errors[$name] = sprintf('Pole "%s" jest wymagane', $label);
            return;
        }

        // Walidacja według typu
        switch ($type) {
            case 'email':
                if (!empty($value) && !is_email($value)) {
                    $this->errors[$name] = sprintf('Pole "%s" musi zawierać poprawny adres email', $label);
                }
                break;

            case 'url':
                if (!empty($value) && !filter_var($value, FILTER_VALIDATE_URL)) {
                    $this->errors[$name] = sprintf('Pole "%s" musi zawierać poprawny adres URL', $label);
                }
                break;

            case 'number':
                if (!empty($value) && !is_numeric($value)) {
                    $this->errors[$name] = sprintf('Pole "%s" musi zawierać liczbę', $label);
                }
                break;

            case 'tel':
                if (!empty($value) && !preg_match('/^[0-9\s\-\+\(\)]+$/', $value)) {
                    $this->errors[$name] = sprintf('Pole "%s" musi zawierać poprawny numer telefonu', $label);
                }
                break;
        }

        // Hook pozwalający na dodanie własnej walidacji dla konkretnego pola
        $field_error = apply_filters('cf_validate_field_' . $name, '', $value, $field, $form_data);
        if (!empty($field_error)) {
            $this->errors[$name] = $field_error;
        }
    }

    /**
     * Domyślna walidacja dla przykładowych pól
     * 
     * @param array $form_data Dane formularza
     */
    private function validate_default_fields($form_data)
    {
        // Walidacja pola "name"
        if (empty($form_data['name'])) {
            $this->errors['name'] = 'Pole "Imię i nazwisko" jest wymagane';
        }

        // Walidacja pola "email"
        if (empty($form_data['email'])) {
            $this->errors['email'] = 'Pole "Email" jest wymagane';
        } elseif (!is_email($form_data['email'])) {
            $this->errors['email'] = 'Pole "Email" musi zawierać poprawny adres email';
        }

        // Walidacja pola "message"
        if (empty($form_data['message'])) {
            $this->errors['message'] = 'Pole "Wiadomość" jest wymagane';
        }
    }

    /**
     * Waliduje przesłane pliki
     * 
     * @param array $files Tablica $_FILES
     * @param array $fields_config Konfiguracja pól
     */
    private function validate_files($files, $fields_config)
    {
        foreach ($files as $field_name => $file) {
            // Pominięcie jeśli plik nie został wysłany
            if (empty($file['name'])) {
                continue;
            }

            // Znajdź konfigurację pola
            $field_config = $this->get_field_config_by_name($field_name, $fields_config);
            
            if (!$field_config) {
                continue;
            }

            // Sprawdzenie rozmiaru pliku
            $max_size = $field_config['max_size'] ?? 5242880; // 5MB domyślnie
            if ($file['size'] > $max_size) {
                $this->errors[$field_name] = sprintf(
                    'Plik jest za duży. Maksymalny rozmiar to %s MB',
                    $max_size / 1024 / 1024
                );
                continue;
            }

            // Sprawdzenie typu pliku
            $allowed_types = $field_config['allowed_types'] ?? ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx'];
            $file_ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            
            if (!in_array($file_ext, $allowed_types)) {
                $this->errors[$field_name] = sprintf(
                    'Niedozwolony typ pliku. Dozwolone typy: %s',
                    implode(', ', $allowed_types)
                );
                continue;
            }

            // Sprawdzenie błędów uploadu
            if ($file['error'] !== UPLOAD_ERR_OK) {
                $this->errors[$field_name] = 'Wystąpił błąd podczas przesyłania pliku';
            }
        }
    }

    /**
     * Waliduje Google reCAPTCHA
     * 
     * @param array $form_data Dane z formularza
     */
    private function validate_recaptcha($form_data)
    {
        $recaptcha_response = $form_data['g-recaptcha-response'] ?? '';
        
        if (empty($recaptcha_response)) {
            $this->errors['recaptcha'] = 'Proszę potwierdzić, że nie jesteś robotem';
            return;
        }

        $secret_key = CF_Settings::get_secret_key();
        
        // Wywołanie API Google reCAPTCHA
        $verify_url = 'https://www.google.com/recaptcha/api/siteverify';
        $response = wp_remote_post($verify_url, [
            'body' => [
                'secret' => $secret_key,
                'response' => $recaptcha_response,
                'remoteip' => $this->get_user_ip()
            ]
        ]);

        if (is_wp_error($response)) {
            $this->errors['recaptcha'] = 'Błąd weryfikacji reCAPTCHA. Spróbuj ponownie.';
            return;
        }

        $response_body = wp_remote_retrieve_body($response);
        $result = json_decode($response_body, true);

        if (empty($result['success'])) {
            $this->errors['recaptcha'] = 'Weryfikacja reCAPTCHA nie powiodła się. Spróbuj ponownie.';
        }
    }

    /**
     * Pobiera IP użytkownika
     * 
     * @return string
     */
    private function get_user_ip()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            return $_SERVER['REMOTE_ADDR'] ?? '';
        }
    }

    /**
     * Znajduje konfigurację pola na podstawie nazwy
     * 
     * @param string $name Nazwa pola
     * @param array $fields_config Konfiguracja pól
     * @return array|null
     */
    private function get_field_config_by_name($name, $fields_config)
    {
        if (empty($fields_config) || !is_array($fields_config)) {
            return null;
        }

        foreach ($fields_config as $field) {
            if (isset($field['name']) && $field['name'] === $name) {
                return $field;
            }
        }

        return null;
    }
}
