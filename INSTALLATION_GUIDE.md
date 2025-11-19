# Руководство по установке Media2 в другой проект

## Способ 1: Path Repository (Локальная установка) ⭐ Рекомендуется

### Если пакет находится в том же проекте или доступен по пути

#### Шаг 1: Скопируйте пакет

Скопируйте папку `packages/media2` в новый проект (например, в `packages/media2`)

#### Шаг 2: Добавьте репозиторий в composer.json

В корневом `composer.json` нового проекта добавьте:

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

#### Шаг 3: Установите пакет

```bash
composer update letoceiling-coder/media2
```

#### Шаг 4: Опубликуйте ресурсы

```bash
php artisan vendor:publish --tag=media2-assets
php artisan vendor:publish --tag=media2-config
php artisan vendor:publish --tag=media2-migrations
```

#### Шаг 5: Выполните миграции

```bash
php artisan migrate
```

#### Шаг 6: Установите npm зависимости

```bash
npm install sweetalert2 fslightbox-vue
```

---

## Способ 2: Git Repository (GitHub/GitLab)

### Если пакет находится в Git репозитории

#### Шаг 1: Добавьте репозиторий в composer.json

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

#### Шаг 2: Установите пакет

```bash
composer require letoceiling-coder/media2:dev-main
```

#### Шаг 3-6: См. Способ 1 (шаги 4-6)

---

## Способ 3: ZIP архив

### Создание архива

```bash
# В директории packages
cd media2
zip -r ../media2-1.0.0.zip . -x "*.git*" "node_modules/*" ".DS_Store"
```

### Установка из архива

#### Шаг 1: Распакуйте архив

Распакуйте архив в `packages/media2` нового проекта

#### Шаг 2-6: См. Способ 1 (шаги 2-6)

---

## Способ 4: Packagist (после публикации)

### После публикации пакета на packagist.org

#### Шаг 1: Установите пакет

```bash
composer require letoceiling-coder/media2
```

#### Шаг 2-6: См. Способ 1 (шаги 4-6)

---

## Способ 5: Локальный Satis репозиторий

### Создание локального репозитория

#### Шаг 1: Установите Satis

```bash
composer create-project composer/satis satis-repo
```

#### Шаг 2: Создайте конфигурацию `satis.json`

```json
{
    "name": "My Private Repository",
    "homepage": "http://packages.example.org",
    "repositories": [
        {
            "type": "path",
            "url": "../packages/*"
        }
    ],
    "require": {
        "letoceiling-coder/media2": "*"
    }
}
```

#### Шаг 3: Постройте репозиторий

```bash
php bin/satis build satis.json public/
```

#### Шаг 4: В новом проекте добавьте репозиторий

```json
{
    "repositories": [
        {
            "type": "composer",
            "url": "http://packages.example.org"
        }
    ],
    "require": {
        "letoceiling-coder/media2": "*"
    }
}
```

---

## Полная инструкция установки (после добавления в composer.json)

### 1. Установка пакета

```bash
composer update letoceiling-coder/media2
```

### 2. Публикация ресурсов

```bash
# Vue компоненты и утилиты
php artisan vendor:publish --tag=media2-assets

# Конфигурация
php artisan vendor:publish --tag=media2-config

# Миграции
php artisan vendor:publish --tag=media2-migrations
```

### 3. Выполнение миграций

```bash
php artisan migrate
```

### 4. Установка npm зависимостей

```bash
npm install sweetalert2 fslightbox-vue
```

### 5. Настройка Vite (если используется)

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
      '@vendor': path.resolve(__dirname, './resources/js/vendor')
    }
  }
})
```

### 6. Использование компонента

```vue
<template>
  <Media2 :api-base-url="'/api/v1'" />
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

---

## Проверка установки

### Проверка через composer

```bash
composer show letoceiling-coder/media2
```

### Проверка файлов

```bash
# Проверка опубликованных файлов
ls -la resources/js/vendor/media2/
ls -la config/media2.php
ls -la database/migrations/*media2*
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

---

## Решение проблем

### Проблема: Пакет не найден

**Решение:** Проверьте путь в `repositories` в composer.json

### Проблема: Роуты не работают

**Решение:** 
1. Проверьте, что ServiceProvider зарегистрирован
2. Выполните `php artisan config:clear`
3. Выполните `php artisan route:clear`

### Проблема: Миграции не выполняются

**Решение:**
1. Проверьте, что миграции опубликованы
2. Проверьте права доступа к БД
3. Выполните `php artisan migrate:status`

### Проблема: Vue компонент не найден

**Решение:**
1. Проверьте, что ресурсы опубликованы
2. Проверьте алиасы в vite.config.js
3. Пересоберите assets: `npm run build`

---

## Быстрая установка (копипаста)

```bash
# 1. Добавьте в composer.json
# "repositories": [{"type": "path", "url": "./packages/media2"}]
# "require": {"letoceiling-coder/media2": "@dev"}

# 2. Установите
composer update letoceiling-coder/media2

# 3. Опубликуйте
php artisan vendor:publish --tag=media2-assets
php artisan vendor:publish --tag=media2-config
php artisan vendor:publish --tag=media2-migrations

# 4. Миграции
php artisan migrate

# 5. NPM
npm install sweetalert2 fslightbox-vue
```

Готово! 🎉

