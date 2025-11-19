# Тестирование Media2

## Подготовка к тестированию

1. Убедитесь, что пакет установлен:
```bash
composer require letoceiling-coder/media2
```

2. Опубликуйте ресурсы:
```bash
php artisan vendor:publish --tag=media2-assets
php artisan vendor:publish --tag=media2-config
```

3. Установите зависимости:
```bash
npm install sweetalert2 fslightbox-vue
```

## Тестирование компонента

### 1. Создайте тестовый Vue компонент

Создайте файл `resources/js/src/Pages/Test/Media2Test.vue`:

```vue
<template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Тест Media2</h1>
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
  name: 'Media2Test',
  components: {
    Media2
  },
  methods: {
    handleFileSelected(file) {
      console.log('Выбран файл:', file)
      alert(`Выбран файл: ${file.original_name}`)
    }
  }
}
</script>
```

### 2. Добавьте маршрут

В `routes/web.php`:

```php
Route::get('/test/media2', function () {
    return view('test-media2');
});
```

### 3. Создайте Blade шаблон

Создайте `resources/views/test-media2.blade.php`:

```blade
<!DOCTYPE html>
<html>
<head>
    <title>Media2 Test</title>
    @vite(['resources/js/app.js'])
</head>
<body>
    <div id="app">
        <media2-test></media2-test>
    </div>
</body>
</html>
```

### 4. Зарегистрируйте компонент в app.js

В `resources/js/app.js`:

```js
import { createApp } from 'vue'
import Media2Test from './src/Pages/Test/Media2Test.vue'

const app = createApp({
    components: {
        Media2Test
    }
})

app.mount('#app')
```

## Проверка функционала

### Тест 1: Загрузка папок
- Откройте страницу `/test/media2`
- Проверьте, что список папок загружается
- Проверьте, что нет ошибок в консоли

### Тест 2: Создание папки
- Нажмите "Создать папку"
- Введите название папки
- Проверьте, что папка создана

### Тест 3: Загрузка файлов
- Откройте папку
- Выберите файлы для загрузки
- Проверьте прогресс загрузки
- Проверьте, что файлы загружены

### Тест 4: Просмотр файлов
- Откройте файл (изображение или видео)
- Проверьте, что lightbox открывается
- Проверьте навигацию между файлами

### Тест 5: Удаление файлов
- Выберите файл
- Нажмите "Удалить"
- Проверьте, что файл удален

### Тест 6: Поиск и фильтрация
- Введите поисковый запрос
- Проверьте, что результаты фильтруются
- Измените тип фильтра
- Проверьте, что фильтрация работает

## Отладка

Если возникают проблемы:

1. Проверьте консоль браузера на наличие ошибок
2. Проверьте Network tab в DevTools
3. Убедитесь, что API endpoints доступны
4. Проверьте, что все зависимости установлены

## Известные проблемы

- ImageEditor не включен в пакет (функция редактирования отключена)
- Компонент требует Tailwind CSS для стилей
- API должен быть доступен без токенов авторизации

