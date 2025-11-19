# Media Manager

Независимый Vue компонент для управления медиа файлами в Laravel приложениях.

## Особенности

- ✅ Полностью независимый компонент
- ✅ Работа с папками и файлами
- ✅ Загрузка файлов с прогрессом
- ✅ Поиск и фильтрация
- ✅ Пагинация
- ✅ Drag & Drop загрузка
- ✅ Просмотр изображений и видео
- ✅ Перемещение файлов между папками
- ✅ Корзина с восстановлением
- ✅ CSRF защита для stateful запросов

## Требования

- PHP ^8.1
- Laravel ^10.0|^11.0|^12.0
- Vue 3.x
- SweetAlert2
- fslightbox-vue

## Установка

### Через Composer

```bash
composer require letoceiling-coder/media-manager
```

### Публикация ресурсов

```bash
# Vue компоненты
php artisan vendor:publish --tag=media2-assets

# Конфигурация
php artisan vendor:publish --tag=media2-config

# Миграции
php artisan vendor:publish --tag=media2-migrations
```

### Выполнение миграций

```bash
php artisan migrate
```

### Установка NPM зависимостей

```bash
npm install sweetalert2 fslightbox-vue
```

## Настройка Vite

В `vite.config.js` добавьте алиас:

```js
import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import path from 'path'

export default defineConfig({
  plugins: [vue()],
  resolve: {
    alias: {
      '@': path.resolve(__dirname, './resources/js'),
    },
  },
})
```

## Использование

### В Vue компоненте

```vue
<template>
  <Media2 
    :api-base-url="'/api/v1'"
    :selection-mode="false"
    @file-selected="handleFileSelected"
  />
</template>

<script setup>
import Media2 from '@/vendor/media2/components/Media2.vue'

const handleFileSelected = (file) => {
  console.log('Выбран файл:', file)
}
</script>
```

### Настройка CSRF

Убедитесь, что в вашем Blade шаблоне есть CSRF токен:

```blade
<meta name="csrf-token" content="{{ csrf_token() }}">
```

И что ваш домен добавлен в stateful домены Sanctum (для Laravel Sanctum):

```php
// config/sanctum.php
'stateful' => explode(',', env('SANCTUM_STATEFUL_DOMAINS', sprintf(
    '%s%s',
    'localhost,localhost:3000,127.0.0.1,127.0.0.1:8000,::1',
    env('APP_URL') ? ','.parse_url(env('APP_URL'), PHP_URL_HOST) : ''
))),
```

## Конфигурация

После публикации конфигурации, настройте `config/media2.php`:

```php
return [
    'api_base_url' => env('MEDIA2_API_BASE_URL', '/api/v1'),
    // другие настройки
];
```

## API Endpoints

- `GET /api/v1/folders` - Список папок
- `POST /api/v1/folders` - Создание папки
- `GET /api/v1/media` - Список медиа файлов
- `POST /api/v1/media` - Загрузка файла
- `DELETE /api/v1/media/{id}` - Удаление файла
- И другие...

## Лицензия

MIT License

## Поддержка

- Issues: https://github.com/letoceiling-coder/media-manager/issues
- Email: dsc-23@yandex.ru
