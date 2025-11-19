# Пример установки Media2 в новый проект

## 📋 Пошаговая инструкция

### Шаг 1: Подготовка пакета

#### Вариант A: Копирование папки
```bash
# Скопируйте папку packages/media2 в новый проект
# Например: cp -r /path/to/old/project/packages/media2 /path/to/new/project/packages/
```

#### Вариант B: Через Git
```bash
# Загрузите пакет в Git репозиторий
cd packages/media2
git init
git add .
git commit -m "Initial commit"
git remote add origin https://github.com/your-username/media2.git
git push -u origin main
```

### Шаг 2: Настройка composer.json в новом проекте

Откройте `composer.json` нового проекта и добавьте:

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

**Или если используете Git:**

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

### Шаг 3: Установка пакета

```bash
composer update letoceiling-coder/media2
```

### Шаг 4: Публикация ресурсов

```bash
# Все сразу
php artisan vendor:publish --tag=media2-assets --tag=media2-config --tag=media2-migrations

# Или по отдельности
php artisan vendor:publish --tag=media2-assets
php artisan vendor:publish --tag=media2-config
php artisan vendor:publish --tag=media2-migrations
```

### Шаг 5: Выполнение миграций

```bash
php artisan migrate
```

### Шаг 6: Установка npm зависимостей

```bash
npm install sweetalert2 fslightbox-vue
```

### Шаг 7: Настройка Vite (если используется)

В `vite.config.js`:

```js
import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import path from 'path'

export default defineConfig({
  plugins: [vue()],
  resolve: {
    alias: {
      '@': path.resolve(__dirname, './resources/js'),
      '@vendor': path.resolve(__dirname, './resources/js/vendor')
    }
  }
})
```

### Шаг 8: Использование компонента

В вашем Vue компоненте:

```vue
<template>
  <div>
    <Media2 
      :api-base-url="'/api/v1'"
      :selection-mode="false"
      @file-selected="handleFileSelected"
    />
  </div>
</template>

<script>
import Media2 from '@/vendor/media2/components/Media2.vue'

export default {
  components: {
    Media2
  },
  methods: {
    handleFileSelected(file) {
      console.log('Выбран файл:', file)
    }
  }
}
</script>
```

## ✅ Проверка установки

### Проверка через composer

```bash
composer show letoceiling-coder/media2
```

Должен показать информацию о пакете.

### Проверка файлов

```bash
# Vue компоненты
ls resources/js/vendor/media2/components/Media2.vue

# Утилиты
ls resources/js/vendor/media2/utils/api.js

# Конфигурация
ls config/media2.php

# Миграции
ls database/migrations/*media2*
```

### Проверка роутов

```bash
php artisan route:list | grep media2
```

Должны появиться роуты:
- `GET /api/v1/folders`
- `POST /api/v1/folders`
- `GET /api/v1/media`
- `POST /api/v1/media`
- и т.д.

### Проверка таблиц в БД

```bash
php artisan tinker
>>> Schema::hasTable('folders')
=> true
>>> Schema::hasTable('media')
=> true
```

## 🔧 Настройка конфигурации

Отредактируйте `config/media2.php`:

```php
return [
    'api_base_url' => env('MEDIA2_API_BASE_URL', '/api/v1'),
    // ...
];
```

Или в `.env`:

```env
MEDIA2_API_BASE_URL=/api/v1
```

## 🎯 Готово!

Теперь компонент Media2 доступен в вашем проекте и работает без токенов авторизации.

