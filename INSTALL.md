# Установка пакета Media2

## Способ 1: Локальная установка (Path Repository)

### Шаг 1: Добавьте репозиторий в composer.json

В корневом `composer.json` вашего проекта добавьте в секцию `repositories`:

```json
{
    "repositories": [
        {
            "type": "path",
            "url": "./packages/media2"
        }
    ]
}
```

### Шаг 2: Добавьте пакет в require

В секцию `require` добавьте:

```json
{
    "require": {
        "letoceiling-coder/media2": "@dev"
    }
}
```

### Шаг 3: Установите пакет

```bash
composer update letoceiling-coder/media2
```

Или если это новый проект:

```bash
composer install
```

### Шаг 4: Опубликуйте ресурсы

```bash
php artisan vendor:publish --tag=media2-assets
php artisan vendor:publish --tag=media2-config
```

### Шаг 5: Установите npm зависимости

```bash
npm install sweetalert2 fslightbox-vue
```

## Способ 2: Установка из Packagist (после публикации)

```bash
composer require letoceiling-coder/media2
php artisan vendor:publish --tag=media2-assets
php artisan vendor:publish --tag=media2-config
npm install sweetalert2 fslightbox-vue
```

## Использование компонента

После установки импортируйте компонент в вашем Vue приложении:

```vue
<template>
  <Media2 
    :api-base-url="'/api/v1'"
    :selection-mode="false"
  />
</template>

<script>
import Media2 from '@/vendor/media2/components/Media2.vue'

export default {
  components: {
    Media2
  }
}
</script>
```

## Проверка установки

Убедитесь, что пакет установлен:

```bash
composer show letoceiling-coder/media2
```

Проверьте, что файлы опубликованы:

```bash
ls -la resources/js/vendor/media2/
ls -la config/media2.php
```

## Обновление пакета

Для обновления локального пакета:

```bash
composer update letoceiling-coder/media2
php artisan vendor:publish --tag=media2-assets --force
php artisan vendor:publish --tag=media2-config --force
```

