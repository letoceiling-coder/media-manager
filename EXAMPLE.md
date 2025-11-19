# Пример использования Media2

## Базовое использование

```vue
<template>
  <div>
    <Media2 
      :api-base-url="'/api/v1'"
      :selection-mode="false"
    />
  </div>
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

## Использование в режиме выбора файлов

```vue
<template>
  <div>
    <Media2 
      :api-base-url="'/api/v1'"
      :selection-mode="true"
      :selected-files="selectedFiles"
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
  data() {
    return {
      selectedFiles: []
    }
  },
  methods: {
    handleFileSelected(file) {
      this.selectedFiles.push(file)
      console.log('Выбран файл:', file)
    }
  }
}
</script>
```

## Настройка базового URL API

```vue
<template>
  <Media2 
    :api-base-url="apiBaseUrl"
  />
</template>

<script>
import Media2 from '@/vendor/media2/components/Media2.vue'
import { config } from '@/config/media2'

export default {
  components: {
    Media2
  },
  computed: {
    apiBaseUrl() {
      return config('media2.api_base_url', '/api/v1')
    }
  }
}
</script>
```

## Интеграция с Vite

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

## Требования

- Vue 3.x
- Tailwind CSS (для стилей)
- SweetAlert2 (для уведомлений)
- fslightbox-vue (для просмотра изображений)

## Установка зависимостей

```bash
npm install sweetalert2 fslightbox-vue
# или
yarn add sweetalert2 fslightbox-vue
```

