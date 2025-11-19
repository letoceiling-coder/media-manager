# Структура пакета Media2

## Полная структура файлов

```
packages/media2/
├── src/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   └── Api/
│   │   │       ├── FolderController.php      # Контроллер папок (без токенов)
│   │   │       └── MediaController.php      # Контроллер медиа (без токенов)
│   │   ├── Filters/
│   │   │   ├── AbstractFilter.php           # Базовый класс фильтра
│   │   │   ├── FilterInterface.php           # Интерфейс фильтра
│   │   │   └── FolderFilter.php              # Фильтр для папок
│   │   ├── Requests/
│   │   │   ├── StoreFolderRequest.php        # Валидация создания папки
│   │   │   └── StoreMediaRequest.php         # Валидация загрузки файла
│   │   └── Resources/
│   │       ├── FolderResource.php            # Resource для папок
│   │       └── MediaResource.php              # Resource для медиа
│   ├── Models/
│   │   ├── Traits/
│   │   │   └── Filterable.php                 # Trait для фильтрации (без HasUserScope)
│   │   ├── Folder.php                         # Модель папки (без токенов)
│   │   └── Media.php                          # Модель медиа (без токенов)
│   ├── Routes/
│   │   └── media-api.php                      # Роуты API (без токенов)
│   └── Media2ServiceProvider.php              # Service Provider
├── database/
│   └── migrations/
│       ├── 2025_11_19_000001_create_folders_table.php
│       └── 2025_11_19_000002_create_media_table.php
├── resources/
│   └── js/
│       ├── components/
│       │   └── Media2.vue                     # Vue компонент (без токенов)
│       └── utils/
│           └── api.js                          # Утилиты API (без токенов)
├── config/
│   └── media2.php                             # Конфигурация пакета
├── composer.json                               # Конфигурация Composer
├── README.md                                   # Основная документация
├── EXAMPLE.md                                  # Примеры использования
├── TESTING.md                                  # Инструкции по тестированию
├── BUILD.md                                    # Инструкции по сборке
├── INSTALL.md                                  # Инструкции по установке
├── CHANGELOG.md                                # История изменений
└── PACKAGE_SUMMARY.md                         # Сводка по пакету
```

## Основные отличия от оригинального Media

### Убрано:
- ❌ Токены авторизации (`useAuthToken`)
- ❌ Passport Laravel
- ❌ Middleware проверки токенов
- ❌ Trait `HasUserScope` (фильтрация по user_id)
- ❌ Зависимость от `auth()->check()` и `auth()->id()`
- ❌ ImageEditor компонент

### Добавлено:
- ✅ Независимые модели без user_id scope
- ✅ Контроллеры без проверки токенов
- ✅ Отдельный файл роутов `media-api.php`
- ✅ Упрощенные Request классы
- ✅ Полная структура для composer пакета

## Зависимости

**PHP:**
- PHP ^8.1
- illuminate/support ^10.0|^11.0
- illuminate/database ^10.0|^11.0
- illuminate/http ^10.0|^11.0

**JavaScript:**
- Vue 3.x
- sweetalert2
- fslightbox-vue
- Tailwind CSS

## Миграции

Пакет включает миграции для создания таблиц:
- `folders` - папки медиа-менеджера
- `media` - медиа-файлы

После установки выполните:
```bash
php artisan migrate
```

## Роуты

Роуты регистрируются автоматически через ServiceProvider.
Все роуты доступны без токенов авторизации.

Базовый URL настраивается через конфигурацию:
```php
'api_base_url' => env('MEDIA2_API_BASE_URL', '/api/v1')
```

