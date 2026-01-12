# Aplikacja obsługująca formularze kontaktowe w szablonie WordPress
## Główne założenia: 
1. moduł ma być oparty o akcje i hooki WordPress,
2. struktura bazowa modułu jest w folderze wp-content/themes/wwwmotyw/inc/contact-form - do którego będą wprowadzane zmiany strukturalne i funkcjonalne opisane dalej,
3. moduł nie będzie pluginem - ma być rozszerzeniem szablonu WordPress ale bez zawierania nazw szablonu (możliwość przeniesienia do innego motywu),
4. wysyłanie maili ma działać przez core WordPress zgodnie z zewnętrznymi ustawieniam (wp_mail() lub skonfigurowane konto SMTP - ta funkcjonalność nie ma być zawarta w module)
## Struktura
### Custom Post Type
* moduł definiuje 2 typy wpisów: 'Formularze' ('cf-form') i 'Wysłane formularze' ('cf-sended'). Oba typy wpisów nie mają być dostępne publicznie, tylko poprzez panel wp-admin. 
* 'cf-form' ma zawierać definicję formularza - ustawienia, pola, widok, szablon maila - przygotowane miejsce - do dalszej pracy późneij
* 'cf-sended' ma zawierać datę i treść wysłanego formularza kontaktowego
### Shortcode
* formualarz ma być osadzany w treści jako shortcode z atrybutem określającym id wybranego 'cf-form'
### Walidacja
* walidacja ma odbywać się poprzez endpoint Rest API i JS, plik assetu JS powienien być ładowany z modułu i folderu 'assets',
* walidacja ma sprawdzać: czy pole jest wymagane, czy ma odpowiednią wartość (mail), rozmiar i typ plików w $_FILES - definiowany w ustawieniach pola 'cf-form',
* walidacja ma mieć możliwość dopisania własnej walidacji opartej na 'name' pola.
### Tworzenie i wysyłanie maila
* treść wysyłanej wiadomości pobierana z pola 'cf-form' i parsowana w sposób następujący: w treści '[name_pola]' (name wybranego pola w bracket) zastępowany treścią wysyłaną przez formularz (value pola zgodnie z 'name_pola').
Plan dalszych kroków:
* definiowane pól i warunków
* tworzenie widoku formularza
-------------------------------------------------------------------------
# Aplikacja obsługująca formularze kontaktowe w szablonie WordPress - część 2
## Główne założenia:
1. Rozbudowanie definicji pól formularzy ('cf-form')
### Definiowanie pól formualarza

definiowanie pól ma mieć możliwość wyboru w stałych modułu czy korzysta z:
1. wtyczki ACF Pro i pól repeater
2. pliku .json (dodanego jako ścieżka w szablonie)
3. pliku tekstowego w formacie JSON wpisywanego jako pole textarea w definicji 'cf-form'

Definiowane pole powinno zawierać (niezależnie od modułu): 
1. name, 
2. value (domyślne jeśli jest), 
3. options (dla select, radio lub checkbox), 
3. listę klas css. 
-------------------------------------------------------------------------
# Aplikacja obsługująca formularze kontaktowe w szablonie WordPress - część 3
## główne założenia:
1. Dodanie definicji pól ACF jako plik php i ładowanie automatyczne
2. Definicja widoku formularza

### Definicja pól ACF
1. Dodaj definicję pól ACF dla formularza jako plik php (ta konfiguracja nie powinna być zmieniana przez administratora, tylko programistycznie)
2. Dołącz pola do widoku formularza

### Dodanie widoku formularza

założeniem jest stworzenie w panelu wp-admin posta 'cf-form' pola do definicji widoku formularza.
1. pole powinno być html i móc przekazywać te wartości (brak czyszczenia html, usuwanie tylko <script></script> oraz <?php ?> i <?= ?>),
2. deklaracja pól powinna się odbywać przy użyciu definicji name wewnątrz bracket np. [email] - dane pola powinny być parsowane na bazie definicji pola (typ, name, klasy, opcje, domyślna wartość),
3. Sparsowana treść ma być wyswietlana przez shortcode.