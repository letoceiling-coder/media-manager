# Быстрая установка Media2

## 📦 Установка за 5 минут

### Вариант A: Пакет в том же проекте

```bash
# 1. Добавьте в composer.json:
# "repositories": [{"type": "path", "url": "./packages/media2"}]
# "require": {"letoceiling-coder/media2": "@dev"}

# 2. Установите
composer update letoceiling-coder/media2

# 3. Опубликуйте все
php artisan vendor:publish --tag=media2-assets --tag=media2-config --tag=media2-migrations

# 4. Миграции
php artisan migrate

# 5. NPM зависимости
npm install sweetalert2 fslightbox-vue
```

### Вариант B: Пакет в другом проекте (копирование)

```bash
# 1. Скопируйте папку packages/media2 в новый проект

# 2. В новом проекте добавьте в composer.json:
# "repositories": [{"type": "path", "url": "./packages/media2"}]
# "require": {"letoceiling-coder/media2": "@dev"}

# 3. Установите
composer update letoceiling-coder/media2

# 4. Опубликуйте
php artisan vendor:publish --tag=media2-assets --tag=media2-config --tag=media2-migrations

# 5. Миграции
php artisan migrate

# 6. NPM
npm install sweetalert2 fslightbox-vue
```

### Вариант C: Через Git

```bash
# 1. Загрузите пакет в Git репозиторий (GitHub/GitLab)

# 2. В новом проекте добавьте в composer.json:
# "repositories": [{"type": "vcs", "url": "https://github.com/your-username/media2.git"}]
# "require": {"letoceiling-coder/media2": "dev-main"}

# 3. Установите
composer require letoceiling-coder/media2:dev-main

# 4-6. См. Вариант A (шаги 3-5)
```

## ✅ Проверка

```bash
# Проверить установку
composer show letoceiling-coder/media2

# Проверить роуты
php artisan route:list | grep media2

# Проверить файлы
ls resources/js/vendor/media2/
ls config/media2.php
```

## 🚀 Использование

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

Готово! 🎉

