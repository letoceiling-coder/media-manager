# Инструкция по публикации пакета

## Подготовка

1. Убедитесь, что все изменения закоммичены
2. Проверьте версию в composer.json
3. Обновите CHANGELOG.md

## Публикация на GitHub

```bash
cd packages/media2

# Инициализация git (если еще не инициализирован)
git init

# Добавление remote
git remote add origin https://github.com/letoceiling-coder/media-manager.git

# Добавление файлов
git add .

# Коммит
git commit -m "Initial release: Media Manager v1.0.0"

# Создание тега
git tag -a v1.0.0 -m "Release version 1.0.0"

# Отправка на GitHub
git push -u origin main
git push --tags
```

## Публикация через Composer

После публикации на GitHub, пакет можно установить через:

```bash
composer require letoceiling-coder/media-manager:dev-main
```

Или добавить в `composer.json`:

```json
{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/letoceiling-coder/media-manager.git"
        }
    ],
    "require": {
        "letoceiling-coder/media-manager": "dev-main"
    }
}
```

## Структура пакета

```
packages/media2/
├── src/                          # PHP код
├── resources/js/                 # Vue компоненты
├── database/migrations/           # Миграции
├── config/                       # Конфигурация
├── composer.json                 # Composer конфигурация
├── README.md                     # Документация
└── .gitignore                    # Git ignore
```

