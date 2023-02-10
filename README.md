# Random number generator
Реализация API шенератора случайных чисал на чистом PHP без использования сторонних библиотек.

## Установка
* Скопировать `.env.example` в `.env`
* Скопировать `config.example.php` в `config.php`
* Выполнить `make build && make up`

## Ендпоинты API
Запрос: `http://localhost:8080/`

Ответ:
`["OK"]`

---

Запрос: `http://localhost:8080/generate`

Ответ:
```
{
    "id": "4d8f68cb-dca5-4319-b01b-b50a6457095b",
    "value": 1512242
}
```

---

Запрос: `http://localhost:8080/retrieve?id=4d8f68cb-dca5-4319-b01b-b50a6457095b`

Ответ:
```
{
    "id": "4d8f68cb-dca5-4319-b01b-b50a6457095b",
    "value": 1512242
}
```
