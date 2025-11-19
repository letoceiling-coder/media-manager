<?php

namespace LetoceilingCoder\MediaManager\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreFolderRequest extends FormRequest
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
        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'parent_id' => ['nullable', 'integer', 'exists:folders,id'],
        ];
    }

    /**
     * Подготовка данных для валидации
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => $this->slug ?: Str::of($this->name)->lower()->slug(),
        ]);
    }

    /**
     * Сообщения об ошибках
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Заполните наименование папки',
            'name.string' => 'Название папки должно быть строкой',
            'name.max' => 'Название папки не должно превышать 255 символов',
            'parent_id.exists' => 'Указанная родительская папка не существует',
        ];
    }
}

