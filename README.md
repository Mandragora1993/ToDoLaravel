ToDoLaravel – Instrukcja uruchomienia i konfiguracji

->Wymagania:
    - Docker (wystarczy sam Docker CLI, Docker Desktop jest opcjonalny)
    - (Opcjonalnie) Git

->Uruchomienie projektu:

    1. Sklonuj repozytorium
    git clone https://github.com/Mandragora1993/ToDoLaravel.git

    2. Uruchom projekt w Dockerze
        Plik konfiguracyjny Docker Compose w katalogu src:  
        `compose.yml`
    docker compose up -d --build
    (Spowoduje to zbudowanie i uruchomienie wszystkich wymaganych serwisów (PHP-FPM, Nginx, Redis, Worker kolejki))

    3. Dostęp do aplikacji
    Aplikacja powinna być dostępna pod adresem [http://localhost:8080](http://localhost:8080)

->Struktura serwisów Docker
    - `php-fpm` – obsługuje backend aplikacji
    - `web` – serwer Nginx (frontend, reverse proxy)
    - `redis` – cache i kolejki
    - `queue` – worker obsługujący kolejki Laravel

WAŻNE!!!
Do prawidłowego działania wszystkich funkcjonalności aplikacji należy skonfigurować:

1. Mail do funkcjonalności przypomnienia o zadaniu dzień przed terminem:

    W pliku `.env` ustaw parametry SMTP, np.:
    MAIL_MAILER=smtp
    MAIL_HOST=smtp.example.com
    MAIL_PORT=587
    MAIL_USERNAME=twoj_login
    MAIL_PASSWORD=twoje_haslo
    MAIL_ENCRYPTION=tls
    MAIL_FROM_ADDRESS="noreply@example.com"
    MAIL_FROM_NAME="ToDoList"

2. Konfiguracja Google Calendar
    Aby korzystać z integracji tasków w Google Calendar, skonfiguruj odpowiednie dane:
    
    W pliku `.env`:
        GOOGLE_CALENDAR_AUTH_PROFILE=service_account
        GOOGLE_CALENDAR_ID=twoj_kalendarz_id

    W pliku plik `service-account.json`(src\storage\app\google-calendar\service-account.json) uzupełnij dane autoryzacyjne i konfiguracyjne zgodnie z dokumentacją Spatie\GoogleCalendar.
