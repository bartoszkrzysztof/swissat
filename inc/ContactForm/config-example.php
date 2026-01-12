<?php
/**
 * Przykładowa konfiguracja dla różnych źródeł pól
 * 
 * Skopiuj ten plik do folderu szablonu i dostosuj według potrzeb
 */

// ===================================================================
// OPCJA 1: Użycie pola textarea (domyślne)
// ===================================================================
// Nie wymaga żadnej konfiguracji - pola definiuje się bezpośrednio
// w panelu administracyjnym formularza jako JSON

// ===================================================================
// OPCJA 2: Użycie pliku JSON
// ===================================================================
// Odkomentuj poniższe linie i dostosuj ścieżkę do pliku JSON

// define('CF_FIELD_SOURCE', 'json_file');
// define('CF_JSON_FILE_PATH', 'inc/ContactForm/fields-config.json');

// ===================================================================
// OPCJA 3: Użycie ACF Pro
// ===================================================================
// Wymaga zainstalowanej wtyczki ACF Pro
// Odkomentuj poniższą linię

// define('CF_FIELD_SOURCE', 'acf');

// Następnie w ACF Pro utwórz grupę pól z repeatorem o nazwie 'cf_form_fields'
// przypisaną do Custom Post Type 'cf-form'

// ===================================================================
// ALTERNATYWNIE: Użycie filtrów WordPress
// ===================================================================

// Filtr do ustawienia typu źródła
add_filter('cf_field_source_type', function($source) {
    // return 'acf';
    // return 'json_file';
    return 'textarea'; // domyślnie
});

// Filtr do ustawienia ścieżki pliku JSON
add_filter('cf_json_file_path', function($path) {
    return 'inc/ContactForm/fields-config.json';
});
