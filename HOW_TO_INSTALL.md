# Как установить Media2 в другой проект

## 🚀 Быстрая установка (3 способа)

### Способ 1: Path Repository (если пакет доступен локально) ⭐

**1. Скопируйте папку `packages/media2` в новый проект**

**2. В `composer.json` нового проекта добавьте:**

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

**3. Установите:**

```bash
composer update letoceiling-coder/media2
php artisan vendor:publish --tag=media2-assets --tag=media2-config --tag=media2-migrations
php artisan migrate
npm install sweetalert2 fslightbox-vue
```

---

### Способ 2: Через Git репозиторий

**1. Загрузите пакет в Git (GitHub/GitLab/Bitbucket)**

```bash
cd packages/media2
git init
git add .
git commit -m "Initial commit"
git remote add origin https://github.com/your-username/media2.git
git push -u origin main
```

**2. В `composer.json` нового проекта:**

```json
{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/your-username/media2.git"
        }
    ],
    "require": {
        "letoceiling-coder/media2": "dev-main"
    }
}
```

**3. Установите:**

```bash
composer require letoceiling-coder/media2:dev-main
php artisan vendor:publish --tag=media2-assets --tag=media2-config --tag=media2-migrations
php artisan migrate
npm install sweetalert2 fslightbox-vue
```

---

### Способ 3: ZIP архив

**1. Создайте архив:**

```bash
cd packages
zip -r media2-1.0.0.zip media2/ -x "*.git*" "node_modules/*" ".DS_Store"
```

**2. Распакуйте в новый проект:**

```bash
# В новом проекте
unzip media2-1.0.0.zip -d packages/
```

**3. В `composer.json`:**

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

**4. Установите (см. Способ 1, шаг 3)**

---

## 📝 Полная последовательность команд

```bash
# 1. Добавить в composer.json репозиторий и require (см. выше)

# 2. Установить пакет
composer update letoceiling-coder/media2

# 3. Опубликовать ресурсы
php artisan vendor:publish --tag=media2-assets
php artisan vendor:publish --tag=media2-config
php artisan vendor:publish --tag=media2-migrations

# 4. Выполнить миграции
php artisan migrate

# 5. Установить npm зависимости
npm install sweetalert2 fslightbox-vue

# 6. Пересобрать assets (если используется Vite)
npm run build
```

---

## ✅ Проверка установки

```bash
# Проверить пакет
composer show letoceiling-coder/media2

# Проверить роуты
php artisan route:list | grep media2

# Проверить файлы
ls resources/js/vendor/media2/components/Media2.vue
ls config/media2.php
```

---

## 🎯 Использование

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

---

## 📚 Дополнительная информация

- **Полная инструкция:** INSTALLATION_GUIDE.md
- **Примеры:** EXAMPLE.md
- **Тестирование:** TESTING.md

