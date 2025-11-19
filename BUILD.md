# Инструкция по сборке и публикации пакета Media2

## Вариант 1: Локальное использование (Path Repository)

### Шаг 1: Добавьте пакет в основной composer.json

В корневом `composer.json` вашего проекта добавьте:

```json
{
    "repositories": [
        {
            "type": "path",
            "url": "./packages/media2"
        }
    ],
    "require": {
        "letoceiling-coder/media2": "@dev"
    }
}
```

### Шаг 2: Установите пакет

```bash
composer require letoceiling-coder/media2:@dev
```

### Шаг 3: Опубликуйте ресурсы

```bash
php artisan vendor:publish --tag=media2-assets
php artisan vendor:publish --tag=media2-config
```

## Вариант 2: Публикация в Packagist

### Шаг 1: Создайте репозиторий на GitHub

1. Создайте новый репозиторий на GitHub
2. Загрузите код пакета:

```bash
cd packages/media2
git init
git add .
git commit -m "Initial commit"
git remote add origin https://github.com/your-username/media2.git
git push -u origin main
```

### Шаг 2: Создайте тег версии

```bash
git tag -a v1.0.0 -m "Version 1.0.0"
git push origin v1.0.0
```

### Шаг 3: Зарегистрируйте пакет в Packagist

1. Зайдите на https://packagist.org
2. Нажмите "Submit"
3. Введите URL вашего GitHub репозитория
4. Нажмите "Check" и затем "Submit"

### Шаг 4: Установите пакет

```bash
composer require letoceiling-coder/media2
```

## Вариант 3: Локальный репозиторий Composer (Satis)

### Шаг 1: Установите Satis

```bash
composer create-project composer/satis --stability=dev
```

### Шаг 2: Создайте конфигурацию

Создайте файл `satis.json`:

```json
{
    "name": "My Private Repository",
    "homepage": "http://packages.example.org",
    "repositories": [
        {
            "type": "path",
            "url": "./packages/*"
        }
    ],
    "require": {
        "letoceiling-coder/media2": "*"
    }
}
```

### Шаг 3: Постройте репозиторий

```bash
php bin/satis build satis.json public/
```

## Вариант 4: ZIP архив

### Создание архива

```bash
cd packages
zip -r media2-1.0.0.zip media2/ -x "*.git*" "*.DS_Store" "node_modules/*"
```

### Использование архива

В `composer.json`:

```json
{
    "repositories": [
        {
            "type": "artifact",
            "url": "path/to/archives/"
        }
    ]
}
```

## Проверка перед публикацией

### 1. Проверьте composer.json

```bash
cd packages/media2
composer validate
```

### 2. Проверьте структуру файлов

Убедитесь, что все необходимые файлы на месте:
- `composer.json`
- `src/Media2ServiceProvider.php`
- `resources/js/components/Media2.vue`
- `resources/js/utils/api.js`
- `config/media2.php`
- `README.md`

### 3. Проверьте автозагрузку

```bash
composer dump-autoload
```

## Обновление версии

При обновлении версии:

1. Обновите версию в `composer.json`:
```json
"version": "1.0.1"
```

2. Создайте новый тег:
```bash
git tag -a v1.0.1 -m "Version 1.0.1"
git push origin v1.0.1
```

3. Обновите в Packagist (если используется)

## Рекомендации

- Используйте семантическое версионирование (SemVer)
- Ведите CHANGELOG.md для отслеживания изменений
- Добавьте тесты перед публикацией
- Убедитесь, что все зависимости указаны правильно

