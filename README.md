# gus
VAT library for Laravel 6

# installation:
composer require check-vat/check-vat

# usage as parameter NIP number
http://localhost/vat/1234567890

{"status":true,"message":"Podmiot o podanym identyfikatorze podatkowy NIP jest zarejestrowany jako podatnik VAT czynny"}

or

{"status":false,"message":"Podmiot o podanym identyfikatorze podatkowym NIP nie jest zarejestrowany jako podatnik VAT"}

or

{"status":true,"message":"Podmiot o podanym identyfikatorze podatkowym NIP jest zarejestrowany jako podatnik VAT zwolniony"}
