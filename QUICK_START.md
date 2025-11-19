# Быстрый старт - Media2

## 🚀 Установка за 5 минут

### 1. Добавьте репозиторий в composer.json

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

### 2. Установите пакет

```bash
composer update letoceiling-coder/media2
```

### 3. Опубликуйте ресурсы

```bash
php artisan vendor:publish --tag=media2-assets
php artisan vendor:publish --tag=media2-config
```

### 4. Установите npm зависимости

```bash
npm install sweetalert2 fslightbox-vue
```

### 5. Используйте компонент

```vue
<template>
  <Media2 :api-base-url="'/api/v1'" />
</template>

<script>
import Media2 from '@/vendor/media2/components/Media2.vue'

export default {
  components: { Media2 }
}
</script>
```

## ✅ Готово!

Теперь компонент Media2 доступен в вашем проекте.

## 📚 Дополнительная информация

- **Полная документация**: README.md
- **Примеры**: EXAMPLE.md
- **Тестирование**: TESTING.md
- **Сборка**: BUILD.md
- **Установка**: INSTALL.md

