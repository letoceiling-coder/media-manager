# Инструкция по установке и публикации

## ✅ Пакет подготовлен к публикации

### Что было сделано:

1. ✅ Обновлен `composer.json`:
   - Название пакета: `letoceiling-coder/media-manager`
   - Обновлены все ссылки на GitHub репозиторий
   - Настроен namespace: `LetoceilingCoder\MediaManager`

2. ✅ Обновлены все PHP файлы:
   - Namespace изменен с `Media2` на `MediaManager`
   - Класс ServiceProvider переименован в `MediaManagerServiceProvider`

3. ✅ Созданы файлы для публикации:
   - `.gitignore`
   - `.gitattributes`
   - `PUBLISH.md`
   - `publish-to-github.ps1`

4. ✅ Обновлена документация:
   - `README.md` с актуальной информацией
   - Инструкции по установке и использованию

## 🚀 Публикация на GitHub

### Вариант 1: Использование скрипта

```powershell
cd packages/media2
.\publish-to-github.ps1
```

### Вариант 2: Ручная публикация

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

## 📦 Установка через Composer

После публикации на GitHub, пакет можно установить:

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

## 📝 Структура пакета

```
packages/media2/
├── src/                          # PHP код (namespace: LetoceilingCoder\MediaManager)
│   ├── MediaManagerServiceProvider.php
│   ├── Http/
│   ├── Models/
│   └── Routes/
├── resources/js/                 # Vue компоненты
├── database/migrations/           # Миграции
├── config/                       # Конфигурация
├── composer.json                 # Composer конфигурация
├── README.md                     # Документация
├── .gitignore                    # Git ignore
└── .gitattributes                # Git attributes
```

## ⚠️ Важно

1. Убедитесь, что репозиторий `media-manager` создан на GitHub
2. Проверьте права доступа к репозиторию
3. После публикации обновите версию в `composer.json` для новых релизов

