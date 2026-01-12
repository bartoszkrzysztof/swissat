# Moduł formularzy kontaktowych dla WordPress

Moduł obsługi formularzy kontaktowych zintegrowany z szablonem WordPress, oparty na architekturze hooków i akcji WordPress.

## Funkcjonalności

### ✅ Zaimplementowane

1. **Custom Post Types**
   - `cf-form` - Definicje formularzy z konfigurowalnymi polami i widokiem HTML
   - `cf-sended` - Wysłane formularze (archiwum)

2. **Zarządzanie polami (CF_Field_Manager)**
   - 3 źródła definicji pól:
     - **Textarea JSON** - Definiowanie pól bezpośrednio w panelu admin (domyślnie)
     - **Plik JSON** - Wczytywanie z pliku JSON w szablonie
     - **ACF Pro** - Integracja z polami ACF Repeater (definicja w PHP)
   - Pełna normalizacja pól niezależnie od źródła
   - Obsługa atrybutów: name, type, label, value, options, css_classes, required

3. **Widok HTML formularza (CF_View_Parser)**
   - Własny HTML dla układu formularza
   - Parser `[name_pola]` - automatyczne renderowanie pól
   - Sanityzacja HTML (usuwanie `<script>`, `<?php ?>`, `<?= ?>`)
   - Możliwość użycia własnych klas CSS i struktury HTML

4. **Shortcode**
   - `[contact_form id="X"]` - Osadzanie formularzy w treści
   - Automatyczne renderowanie z własnym widokiem HTML lub standardowo
   - Automatyczne wykrywanie i parsowanie pól

5. **Typy pól**
   - **Text inputs**: text, email, tel, url, number, date, time, hidden, password
   - **Textarea**: wieloliniowe pole tekstowe
   - **Select**: lista rozwijana
   - **Multiselect**: lista wielokrotnego wyboru (z przytrzymaniem Ctrl/Cmd)
   - **Radio**: przyciski radio
   - **Checkbox**: pojedyncze pole wyboru
   - **Checkboxes**: lista pól wyboru (wielokrotny wybór)
   - **File**: upload plików z walidacją typu i rozmiaru

6. **ACF Pro - definicja programistyczna**
   - Plik `acf-fields-definition.php` z pełną definicją pól ACF
   - Automatyczne ładowanie gdy ACF Pro jest aktywne
   - Repeater z konfiguracją wszystkich typów pól
   - Conditional logic dla opcji specyficznych dla typu

7. **REST API**
   - `/contact-form/v1/validate` - Walidacja danych
   - `/contact-form/v1/submit` - Wysyłanie formularza

8. **Walidacja**
   - Walidacja po stronie serwera (PHP)
   - Walidacja po stronie klienta (JavaScript)
   - Walidacja typów: email, url, tel, number
   - Walidacja plików (rozmiar, typ, rozszerzenia)
   - Możliwość dodania własnej walidacji poprzez hooki
   - **Google reCAPTCHA v2** - Ochrona przed spamem (opcjonalna)

9. **Wysyłanie maili**
   - Parsowanie szablonu email z `[name_pola]`
   - Wysyłka przez `wp_mail()` (kompatybilne z SMTP)
   - Reply-To na podstawie pola email

10. **Assets**
    - JavaScript z walidacją i obsługą AJAX
    - CSS ze stylami formularzy (responsywne)

11. **Strona ustawień modułu (CF_Settings)**
    - Konfiguracja Google reCAPTCHA v2 (Site Key i Secret Key)
    - Możliwość włączania/wyłączania reCAPTCHA dla poszczególnych formularzy
    - Instrukcje konfiguracji kluczy API

### 🔧 Do rozbudowy

- Warunkowe pokazywanie pól (conditional logic)
- Zaawansowany kreator pól w GUI
- Integracje z zewnętrznymi serwisami (MailChimp, etc.)
- Multi-step forms

## Struktura katalogów

```
wp-content/themes/wwwmotyw/inc/ContactForm/
├── ContactForm.php                      # Główny plik modułu
├── config-example.php                   # Przykład konfiguracji źródła pól
├── fields-config-example.json           # Przykład pliku JSON z polami
├── includes/
│   ├── acf-fields-definition.php       # Definicja pól ACF (PHP)
│   ├── class-cf-settings.php           # Strona ustawień modułu - NOWE
│   ├── class-cf-field-manager.php      # Zarządzanie polami
│   ├── class-cf-view-parser.php        # Parser widoku HTML
│   ├── class-cf-post-types.php         # Custom Post Types
│   ├── class-cf-shortcode.php          # Obsługa shortcode + renderowanie
│   ├── class-cf-rest-api.php           # Endpointy REST API
│   ├── class-cf-validator.php          # Walidacja danych + reCAPTCHA - ZAKTUALIZOWANE
│   └── class-cf-mailer.php             # Wysyłanie emaili
└── assets/
    ├── js/
    │   └── validation.js               # Walidacja front-end
    └── css/
        └── form-style.css              # Style formularzy
```

## Instalacja i konfiguracja

### 1. Dołączenie modułu do szablonu

W pliku `functions.php` szablonu dodaj:

```php
require_once get_template_directory() . '/inc/ContactForm/ContactForm.php';
```

### 2. Utworzenie formularza

1. Przejdź do **Formularze** w panelu administracyjnym
2. Kliknij **Dodaj nowy**
3. Ustaw:
   - Tytuł formularza
   - Email odbiorcy
   - Temat wiadomości
   - Szablon email (z `[name_pola]`)
### 2. Konfiguracja źródła pól

Moduł obsługuje 3 źródła definicji pól. Wybierz odpowiednią opcję:

#### Opcja A: Textarea JSON (domyślnie)

Nie wymaga konfiguracji. Pola definiuje się bezpośrednio w panelu administracyjnym formularza jako JSON.

#### Opcja B: Plik JSON

1. Skopiuj `config-example.php` jako `config.php`
2. Dodaj w `functions.php`:
```php
require_once get_template_directory() . '/inc/ContactForm/config.php';
```
3. Odkomentuj w `config.php`:
```php
define('CF_FIELD_SOURCE', 'json_file');
define('CF_JSON_FILE_PATH', 'inc/ContactForm/fields-config.json');
```
4. Utwórz plik `fields-config.json` (zobacz `fields-config-example.json`)

#### Opcja C: ACF Pro

1. Zainstaluj wtyczkę ACF Pro
2. Dodaj w `functions.php`:
```php
define('CF_FIELD_SOURCE', 'acf');
```
3. Pola ACF są automatycznie ładowane z `acf-fields-definition.php` (definicja programistyczna)
4. W panelu formularza zobaczysz repeater ACF do definiowania pól

**Uwaga:** Definicja pól ACF w pliku PHP jest stała i nie zmienia się przez panel admin. To zapewnia spójność struktury pól.

### 3. Utworzenie formularza

1. Przejdź do **Formularze** w panelu administracyjnym
2. Kliknij **Dodaj nowy**
3. Ustaw:
   - Tytuł formularza
   - Email odbiorcy
   - Temat wiadomości
   - **Opcjonalnie:** Włącz Google reCAPTCHA (wymaga konfiguracji kluczy w Ustawieniach)
4. W sekcji "Pola formularza" zdefiniuj pola (format zależy od wybranego źródła)
5. **OPCJONALNIE:** W sekcji "Widok HTML formularza" zdefiniuj własny układ HTML używając `[name_pola]`
6. W sekcji "Szablon wiadomości email" użyj `[name_pola]` dla dynamicznej treści
7. Opublikuj formularz

### 4. Konfiguracja Google reCAPTCHA (opcjonalnie)

1. Przejdź do **Formularze → Ustawienia**
2. Uzyskaj klucze z https://www.google.com/recaptcha/admin (wybierz reCAPTCHA v2 "Checkbox")
3. Wpisz **Site Key** i **Secret Key**
4. Zapisz ustawienia
5. W ustawieniach formularza zaznacz **"Włącz Google reCAPTCHA"**

### 5. Osadzenie formularza

Skopiuj shortcode z metaboxa "Shortcode" i wklej w treści strony:

```
[contact_form id="123"]
```

## Użycie

### Definiowanie pól formularza

#### Format JSON dla textarea i pliku JSON

Każde pole powinno zawierać:

```json
{
  "name": "field_name",           // WYMAGANE - unikalny identyfikator
  "type": "text",                 // WYMAGANE - typ pola
  "label": "Etykieta pola",       // Etykieta wyświetlana użytkownikowi
  "value": "wartość domyślna",    // Wartość domyślna
  "placeholder": "Placeholder",   // Tekst placeholder
  "required": true,               // Czy pole jest wymagane (true/false)
  "options": {},                  // Opcje dla select/radio/checkbox
  "css_classes": ["class1"],      // Klasy CSS (tablica lub string)
  "attributes": {},               // Dodatkowe atrybuty HTML
  "rows": 5,                      // Dla textarea - liczba wierszy
  "allowed_types": ["jpg"],       // Dla file - dozwolone rozszerzenia
  "max_size": 5242880            // Dla file - max rozmiar w bajtach
}
```

**Przykład kompletnej definicji:**

```json
[
  {
    "name": "fullname",
    "type": "text",
    "label": "Imię i nazwisko",
    "placeholder": "Jan Kowalski",
    "required": true,
    "css_classes": ["form-control", "large"]
  },
  {
    "name": "email",
    "type": "email",
    "label": "Adres email",
    "required": true
  },
  {
    "name": "subject",
    "type": "select",
    "label": "Temat",
    "required": true,
    "options": {
      "general": "Pytanie ogólne",
      "support": "Wsparcie",
      "sales": "Sprzedaż"
    }
  },
  {
    "name": "message",
    "type": "textarea",
    "label": "Wiadomość",
    "required": true,
    "rows": 8
  },
  {
    "name": "attachment",
    "type": "file",
    "label": "Załącznik",
    "allowed_types": ["pdf", "doc", "docx"],
    "max_size": 5242880
  },
  {
    "name": "newsletter",
    "type": "checkbox",
    "label": "Zapisz się do newslettera",
    "value": "yes"
  }
]
```

**Dostępne typy pól:**
- `text`, `email`, `tel`, `url`, `number` - pola tekstowe
- `textarea` - pole wieloliniowe
- `select` - lista rozwijana
- `multiselect` - lista wielokrotnego wyboru
- `radio` - przyciski opcji
- `checkbox` - pojedyncze pole wyboru
- `checkboxes` - lista pól wyboru (wielokrotny wybór)
- `file` - upload pliku
- `date`, `time`, `datetime-local` - pola daty/czasu
- `hidden`, `password` - specjalne

#### Opcje dla select/radio/checkboxes/multiselect

Format JSON:
```json
"options": {
  "wartość1": "Etykieta 1",
  "wartość2": "Etykieta 2"
}
```

Lub string (w textarea):
```
"options": "wartość1:Etykieta 1,wartość2:Etykieta 2"
```

**Przykład checkboxes (lista pól wyboru):**
```json
{
  "name": "interests",
  "type": "checkboxes",
  "label": "Zainteresowania",
  "required": true,
  "options": {
    "sport": "Sport",
    "music": "Muzyka",
    "travel": "Podróże",
    "tech": "Technologia"
  }
}
```

**Przykład multiselect:**
```json
{
  "name": "services",
  "type": "multiselect",
  "label": "Wybierz usługi",
  "required": false,
  "size": 5,
  "options": {
    "web": "Strony internetowe",
    "seo": "Pozycjonowanie SEO",
    "ads": "Kampanie reklamowe",
    "social": "Social Media"
  }
}
```

#### Klasy CSS

Jako tablica:
```json
"css_classes": ["class1", "class2", "large"]
```

Lub string:
```json
"css_classes": "class1 class2 large"
```

### Widok HTML formularza

W metaboxie "Widok HTML formularza" możesz zdefiniować własny układ HTML używając placeholderów `[name_pola]`.

**Przykład prostego widoku:**

```html
<div class="row">
    <div class="col-md-6">
        [fullname]
    </div>
    <div class="col-md-6">
        [email]
    </div>
</div>

<div class="row">
    <div class="col-12">
        [message]
    </div>
</div>

<div class="form-check">
    [newsletter]
</div>
```

**Zaawansowany przykład z Bootstrap:**

```html
<div class="container">
    <div class="row g-3">
        <div class="col-md-6">
            <div class="form-floating">
                [fullname]
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating">
                [email]
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-floating">
                [phone]
            </div>
        </div>
        <div class="col-md-8">
            <div class="form-floating">
                [subject]
            </div>
        </div>
        <div class="col-12">
            <div class="form-floating">
                [message]
            </div>
        </div>
        <div class="col-12">
            <div class="form-check">
                [terms]
            </div>
        </div>
    </div>
</div>
```

**Ważne:**
- Każdy `[name_pola]` zostanie zastąpiony pełnym HTML pola (label + input/textarea/select/etc.)
- Możesz użyć dowolnych klas CSS i struktury HTML
- Tagi `<script>`, `<?php ?>` i `<?= ?>` są automatycznie usuwane ze względów bezpieczeństwa
- Jeśli pole nie istnieje w definicji, pojawi się ostrzeżenie

### Szablon email

W polu "Szablon wiadomości email" możesz użyć placeholderów:

```
Nowa wiadomość od [name]

Email: [email]
Wiadomość:
[message]
```

### Własna walidacja (PHP)

Dodaj własną walidację dla konkretnego pola:

```php
add_filter('cf_validate_field_phone', function($error, $value, $field, $form_data) {
    if (!preg_match('/^\+48[0-9]{9}$/', $value)) {
        return 'Numer telefonu musi być w formacie +48XXXXXXXXX';
    }
    return $error;
}, 10, 4);
```

Lub dla wszystkich pól:

```php
add_filter('cf_custom_validation', function($errors, $form_data, $fields_config) {
    // Twoja własna logika walidacji
    if (empty($form_data['consent'])) {
        $errors['consent'] = 'Musisz zaakceptować regulamin';
    }
    return $errors;
}, 10, 3);
```

### Własna walidacja (JavaScript)

W pliku JavaScript dodaj:

```javascript
window.cfCustomValidators = {
    phone: function(value) {
        if (!/^\+48[0-9]{9}$/.test(value)) {
            return 'Numer telefonu musi być w formacie +48XXXXXXXXX';
        }
        return '';
    }
};
```

### Modyfikacja parametrów emaila

```php
add_filter('cf_email_params', function($params, $form_id, $form_data) {
    // Dodaj CC
    $params['headers'][] = 'Cc: biuro@example.com';
    
    // Zmień nadawcę
    $params['headers'][] = 'From: Formularz <formularz@example.com>';
    
    return $params;
}, 10, 3);
```

## Custom Post Types

### cf-form (Formularze)

**Meta fields:**
- `_cf_form_fields` - JSON z definicją pól (do rozbudowy)
- `_cf_recipient_email` - Email odbiorcy
- `_cf_email_subject` - Temat wiadomości
- `_cf_email_template` - Szablon treści email

### cf-sended (Wysłane formularze)

**Meta fields:**
- `_cf_form_id` - ID formularza źródłowego
- `_cf_form_data` - Tablica z danymi formularza
- `_cf_sender_ip` - IP nadawcy
- `_cf_user_agent` - User Agent przeglądarki

## REST API

### POST /wp-json/contact-form/v1/validate

Waliduje dane formularza bez wysyłania.

**Body:**
```json
{
  "form_id": 123,
  "form_data": {
    "name": "Jan Kowalski",
    "email": "jan@example.com"
  }
}
```

**Response:**
```json
{
  "success": true,
  "message": "Walidacja przebiegła pomyślnie"
}
```

### POST /wp-json/contact-form/v1/submit

Wysyła formularz (walidacja + zapis + email).

**Body:**
```json
{
  "form_id": 123,
  "form_data": {
    "name": "Jan Kowalski",
    "email": "jan@example.com",
    "message": "Treść wiadomości"
  },
  "nonce": "abc123..."
}
```

## Hooki i filtry

### Stałe konfiguracyjne

```php
// Źródło pól: 'textarea', 'json_file', 'acf'
define('CF_FIELD_SOURCE', 'textarea');

// Ścieżka do pliku JSON (dla CF_FIELD_SOURCE = 'json_file')
define('CF_JSON_FILE_PATH', 'inc/ContactForm/fields-config.json');
```

### Filtry

**Konfiguracja źródła pól:**
```php
// Zmiana źródła pól
add_filter('cf_field_source_type', function($source) {
    return 'json_file'; // lub 'acf', 'textarea'
});

// Zmiana ścieżki do pliku JSON
add_filter('cf_json_file_path', function($path) {
    return 'custom-path/fields.json';
});
```

**Walidacja:**
```php
// Własna walidacja dla konkretnego pola
add_filter('cf_validate_field_{name}', function($error, $value, $field, $form_data) {
    // Twoja logika walidacji
    return $error;
}, 10, 4);

// Własna walidacja dla wszystkich pól
add_filter('cf_custom_validation', function($errors, $form_data, $fields_config) {
    if (empty($form_data['consent'])) {
        $errors['consent'] = 'Musisz zaakceptować regulamin';
    }
    return $errors;
}, 10, 3);
```

**Email:**
```php
// Modyfikacja parametrów emaila
add_filter('cf_email_params', function($params, $form_id, $form_data) {
    // Dodaj CC
    $params['headers'][] = 'Cc: biuro@example.com';
    
    // Zmień nadawcę
    $params['headers'][] = 'From: Formularz <formularz@example.com>';
    
    return $params;
}, 10, 3);
```

### Akcje

```php
// Po wysłaniu formularza
add_action('cf_form_submitted', function($form_id, $form_data, $sended_id) {
    // Twoja akcja po wysłaniu
}, 10, 3);

// Po zapisaniu formularza w bazie
add_action('cf_form_saved', function($sended_id, $form_id) {
    // Twoja akcja po zapisie
}, 10, 2);
```

## Przykłady użycia

### Przykład 1: Prosty formularz kontaktowy

```json
[
  {
    "name": "name",
    "type": "text",
    "label": "Imię i nazwisko",
    "required": true
  },
  {
    "name": "email",
    "type": "email",
    "label": "Email",
    "required": true
  },
  {
    "name": "message",
    "type": "textarea",
    "label": "Wiadomość",
    "required": true
  }
]
```

### Przykład 2: Formularz z wieloma typami pól

```json
[
  {
    "name": "company",
    "type": "text",
    "label": "Nazwa firmy",
    "required": true
  },
  {
    "name": "contact_type",
    "type": "select",
    "label": "Rodzaj zapytania",
    "required": true,
    "options": {
      "offer": "Prośba o ofertę",
      "support": "Wsparcie techniczne",
      "partnership": "Współpraca"
    }
  },
  {
    "name": "budget",
    "type": "radio",
    "label": "Budżet projektu",
    "required": true,
    "options": {
      "small": "Do 10 000 PLN",
      "medium": "10 000 - 50 000 PLN",
      "large": "Powyżej 50 000 PLN"
    }
  },
  {
    "name": "phone",
    "type": "tel",
    "label": "Telefon kontaktowy",
    "placeholder": "+48 123 456 789"
  },
  {
    "name": "attachments",
    "type": "file",
    "label": "Załączniki",
    "allowed_types": ["pdf", "doc", "docx", "jpg", "png"],
    "max_size": 10485760
  },
  {
    "name": "terms",
    "type": "checkbox",
    "label": "Akceptuję regulamin",
    "value": "accepted",
    "required": true
  }
]
```

### Przykład 3: Własna walidacja numeru telefonu

```php
// W functions.php
add_filter('cf_validate_field_phone', function($error, $value, $field, $form_data) {
    // Polski format telefonu
    if (!empty($value) && !preg_match('/^\+?48\s?[0-9]{3}\s?[0-9]{3}\s?[0-9]{3}$/', $value)) {
        return 'Wprowadź poprawny polski numer telefonu (np. +48 123 456 789)';
    }
    return $error;
}, 10, 4);
```

### Przykład 4: Własny widok HTML z Bootstrap

```html
<div class="contact-form-custom">
    <div class="row mb-3">
        <div class="col-md-6">
            [fullname]
        </div>
        <div class="col-md-6">
            [email]
        </div>
    </div>
    
    <div class="row mb-3">
        <div class="col-md-4">
            [phone]
        </div>
        <div class="col-md-8">
            [company]
        </div>
    </div>
    
    <div class="mb-3">
        [subject]
    </div>
    
    <div class="mb-3">
        [message]
    </div>
    
    <div class="mb-3">
        [attachment]
    </div>
    
    <div class="form-check mb-3">
        [terms]
    </div>
</div>
```

### Przykład 5: Integracja z MailChimp po wysłaniu

```php
// W functions.php
add_action('cf_form_submitted', function($form_id, $form_data, $sended_id) {
    // Jeśli zaznaczono newsletter
    if (!empty($form_data['newsletter']) && !empty($form_data['email'])) {
        // Dodaj do MailChimp
        // ... Twoja integracja z API MailChimp
    }
}, 10, 3);
```

## Bezpieczeństwo

- Weryfikacja nonce przy wysyłce
- Sanityzacja danych wejściowych
- Walidacja typów plików
- Limit rozmiaru plików
- Sanityzacja widoku HTML (usuwanie `<script>`, `<?php ?>`, `<?= ?>`)
- **Google reCAPTCHA v2** - Ochrona przed spamem i botami (opcjonalna)
- Walidacja reCAPTCHA po stronie serwera z weryfikacją IP
- Bezpieczne przechowywanie kluczy API w opcjach WordPress

## Wymagania

- WordPress 5.0+
- PHP 7.4+
- jQuery (dołączony do WP)
- ACF Pro (opcjonalnie, tylko dla źródła 'acf')
- Klucze Google reCAPTCHA v2 (opcjonalnie, dla ochrony przed spamem)

## Roadmap

- [x] Definiowanie pól formularzy (3 źródła: textarea, JSON, ACF)
- [x] Renderowanie wszystkich typów pól
- [x] Normalizacja danych z różnych źródeł
- [x] Własny widok HTML formularza z parserem `[name_pola]`
- [x] ACF - definicja programistyczna w PHP
- [x] Integracja z Google reCAPTCHA v2
- [ ] Warunkowe pokazywanie pól (conditional logic)
- [ ] GUI kreator pól w panelu admin
- [ ] Export wysłanych formularzy do CSV
- [ ] Multi-step forms (wielokrokowe formularze)
- [ ] Szablony gotowych formularzy
- [ ] Integracja z popularnymi CRM

## Changelog

### v4.1.0 (2026-01-12)
- ✅ Dodano typ pola **checkboxes** (lista pól wyboru z wielokrotnym wyborem)
- ✅ Dodano typ pola **multiselect** (lista wielokrotnego wyboru)
- ✅ Obsługa checkboxes w shortcode, view parser i ACF
- ✅ Obsługa multiselect z możliwością ustawienia rozmiaru (size)
- ✅ Zaktualizowana dokumentacja z przykładami użycia
- ✅ Instrukcje obsługi dla użytkowników (Ctrl/Cmd dla multiselect)

### v4.0.0 (2026-01-12)
- ✅ Dodano CF_Settings - strona ustawień modułu
- ✅ Konfiguracja Google reCAPTCHA v2 (Site Key i Secret Key)
- ✅ Możliwość włączania/wyłączania reCAPTCHA dla poszczególnych formularzy
- ✅ Walidacja reCAPTCHA po stronie serwera
- ✅ Automatyczne ładowanie skryptu Google reCAPTCHA
- ✅ Checkbox w ustawieniach formularza "Włącz Google reCAPTCHA"
- ✅ Ostrzeżenie w panelu admin gdy reCAPTCHA nie jest skonfigurowana
- ✅ Instrukcje konfiguracji kluczy w stronie ustawień
- ✅ Zaktualizowana dokumentacja z konfiguracją reCAPTCHA

### v3.0.0 (2026-01-12)
- ✅ Dodano CF_View_Parser - parser widoku HTML formularza
- ✅ Metabox "Widok HTML formularza" z edytorem WYSIWYG
- ✅ Parsowanie `[name_pola]` w widoku HTML
- ✅ Sanityzacja HTML (usuwanie niebezpiecznych tagów)
- ✅ ACF - definicja pól w pliku PHP (acf-fields-definition.php)
- ✅ Automatyczne ładowanie ACF fields gdy ACF Pro aktywne
- ✅ Rozbudowa Field Manager o konwersję danych ACF
- ✅ Integracja parsera z shortcode
- ✅ Ostrzeżenia dla niezdefiniowanych pól w widoku
- ✅ Zaktualizowana dokumentacja z przykładami HTML

### v2.0.0 (2026-01-12)
- ✅ Dodano CF_Field_Manager - zarządzanie polami z 3 źródeł
- ✅ Obsługa textarea JSON (domyślnie)
- ✅ Obsługa pliku JSON
- ✅ Obsługa ACF Pro repeater
- ✅ Pełne renderowanie wszystkich typów pól
- ✅ Rozbudowane metaboxy w panelu admin
- ✅ Przykłady konfiguracji i użycia
- ✅ Zaktualizowana dokumentacja

### v1.0.0
- ✅ Podstawowa struktura modułu
- ✅ Custom Post Types (cf-form, cf-sended)
- ✅ Shortcode z podstawowym formularzem
- ✅ REST API (validate, submit)
- ✅ Walidacja PHP i JavaScript
- ✅ Wysyłanie emaili przez wp_mail()
- ✅ Assets (JS, CSS)
- ✅ Custom Post Types (cf-form, cf-sended)
- ✅ Shortcode z podstawowym formularzem
- ✅ REST API (validate, submit)
- ✅ Walidacja PHP i JavaScript
- ✅ Wysyłanie emaili przez wp_mail()
- ✅ Assets (JS, CSS)

## Wsparcie

Moduł jest częścią szablonu WordPress i nie wymaga osobnej instalacji jako plugin.

## Autor

Moduł przygotowany zgodnie z wymaganiami projektu.

## Licencja

Moduł jest własnością projektu i szablonu WordPress.
