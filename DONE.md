1. Co zrobiłem
    - Stworzyłem aplikację ToDoLaravel, która pozwala na zarządzanie zadaniami oraz wysyła przypomnienia mailowe dzień przed terminem zadania pełen (CRUD).
    - Dodałem możliwość filtrowania zadań według priorytetu, statusu i terminu.
    - Zapewniłem walidację wszystkich formularzy: sprawdzane są wymagane pola, limity znaków i poprawny format daty.
    - Wdrożyłem obsługę wielu użytkowników – każdy użytkownik ma własne konto i widzi tylko swoje zadania.
    - Dodałem opcję udostępniania zadań przez publiczny link z tokenem, który wygasa po określonym czasie.
    - Skonfigurowałem środowisko uruchomieniowe w oparciu o Dockera, korzystając z kontenerów php-fpm, nginx, redis oraz osobnego workera do kolejek.
    - Dodałem historię edycji zadań – każda zmiana jest zapisywana i można zobaczyć wcześniejsze wersje.
    - Dodałem integrację z Google Calendar, dzięki czemu zadania mogą być synchronizowane z kalendarzem użytkownika.
    - Zaimplementowałem obsługę kolejek (queue) z użyciem Redisa i bazy danych.
    - Przygotowałem konfigurację SMTP do wysyłki maili oraz opisałem ją w pliku README.md.
    - Umożliwiłem łatwe uruchomienie projektu na dowolnym systemie wspierającym Dockera.
    - Stworzyłem czytelną instrukcję uruchomienia i konfiguracji w pliku README.md.

2. Moje przemyślenia na temat projektu i wykonania
    - Dzięki Dockerowi aplikacja jest łatwa do uruchomienia na każdym komputerze.
    - Implementacja CRUD i filtrowania była prosta, ale wymagała dokładnej walidacji danych.
    - Najwięcej czasu poświęciłem na obsługę powiadomień e-mail i kolejek, ale nauczyłem się jak działa scheduler i kolejki w Laravelu.
    - Obsługa wielu użytkowników i uwierzytelnianie była łatwa dzięki gotowym mechanizmom Laravel.
    - Udostępnianie zadań przez token wymagało przemyślenia bezpieczeństwa i wygasania linków.
    - Historia edycji pozwala użytkownikom śledzić wszystkie zmiany – to praktyczna i ciekawa funkcja.
    - Integracja z Google Calendar była nowym wyzwaniem, ale pozwoliła mi nauczyć się pracy z API zewnętrznymi i biblioteką spatie/laravel-google-calendar.
    - Projekt uważam za kompletny i gotowy do dalszego rozwoju, np. o kolejne integracje lub bardziej rozbudowaną historię zmian.

3. Podsumowanie
    Udało mi się zrealizować założenia projektowe i zaimplementować wszystkie wymagane funkcjonalności. Dzięki Dockerowi uruchomienie oraz rozwijanie aplikacji jest szybkie i wygodne dla każdego użytkownika.