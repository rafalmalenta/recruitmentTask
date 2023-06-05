***Opis zadania:***

Twoim zadaniem jest napisanie aplikacji w czystym PHP (bez użycia frameworków), która będzie korzystać z API NBP (Narodowy Bank Polski) do pobierania kursów walut. Aplikacja powinna umożliwiać zapisywanie pobranych kursów walut do bazy danych oraz wyświetlanie ich w formie tabeli. Dodatkowo, aplikacja powinna umożliwiać przewalutowanie danej kwoty z wybranej waluty na inną i zapisywanie wyników przewalutowań do bazy danych.

API NBP: http://api.nbp.pl/

***Wymagania:***

1. Utwórz nową bazę danych MySQL i skonfiguruj połączenie z bazą.
Napisz odpowiednie klasy lub metody, które będą odpowiedzialne za komunikację z API NBP i pobranie kursów walut.
Zapisz pobrane kursy walut do bazy danych.
2. Utwórz klasę lub funkcję, która będzie generować tabelę z kursami walut na podstawie danych z bazy danych.
3. Stwórz formularz, który umożliwi użytkownikowi wpisanie kwoty oraz wybranie dwóch walut: waluty źródłowej i waluty docelowej.
4. Napisz odpowiednie klasy lub metody, które będą przewalutowywać podaną kwotę z jednej waluty na drugą, korzystając z danych z bazy danych.
5. Zapisz wyniki przewalutowań do bazy danych wraz z informacjami o walutach źródłowej, docelowej i przewalutowanej kwocie.
6. Wyświetl listę ostatnich wyników przewalutowań wraz z informacjami o walutach źródłowej, docelowej i przewalutowanej kwocie. Wykorzystaj dane z bazy danych.
7. Wykorzystaj podejście obiektowe w kodzie, stosując dobre praktyki związane z programowaniem obiektowym w czystym PHP.
8. Zadbaj o odpowiednie zabezpieczenie aplikacji, takie jak walidacja danych wejściowych, obsługa błędów itp.
9. Zwróć uwagę na estetykę pracy i kodu. Staraj się zachować czytelność, odpowiednie formatowanie i nazewnictwo zmiennych.
10. Podczas oceny rozwiązania będziemy brać pod uwagę:

Poprawność działania aplikacji
Jakość kodu (czytelność, organizacja, nazewnictwo zmiennych, komentarze itp.)
Wykorzystanie obiektowego podejścia w czystym PHP
Estetykę pracy i kodu
Poprawność integracji z API NBP i bazą danych
Zgodność z wymaganiami
Wysyłka zadania:

Przygotuj repozytorium na platformie GitHub i udostępnij kod źródłowy aplikacji na publicznym repozytorium. Prześlij link do repozytorium jako część rozwiązania zadania.
Prześlij również link do działającej wersji aplikacji na serwerze, gdzie można zobaczyć demo działania aplikacji.
