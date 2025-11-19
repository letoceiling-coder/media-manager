<?php

namespace LetoceilingCoder\MediaManager\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMediaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * Без токенов - всегда разрешено
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $maxSize = config('media2.upload.max_file_size', 10 * 1024 * 1024); // 10 МБ по умолчанию
        
        return [
            'file' => ['required', 'file', "max:" . ($maxSize / 1024)], // max в KB
            'folder_id' => 'nullable|exists:folders,id'
        ];
    }
    
    /**
     * Настройка сообщений об ошибках
     */
    public function messages(): array
    {
        $maxSizeMB = round(config('media2.upload.max_file_size', 10 * 1024 * 1024) / 1024 / 1024, 1);
        
        return [
            'file.required' => 'Файл обязателен для загрузки',
            'file.file' => 'Загружаемый объект должен быть файлом',
            'file.max' => "Размер файла не должен превышать {$maxSizeMB} МБ",
            'folder_id.exists' => 'Указанная папка не существует'
        ];
    }
}

