<?php

namespace LetoceilingCoder\MediaManager\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use LetoceilingCoder\MediaManager\Models\Traits\Filterable;

class Media extends Model
{
    use Filterable;

    protected $table = 'media';

    protected $fillable = [
        'name',
        'original_name',
        'extension',
        'disk',
        'width',
        'height',
        'type',
        'size',
        'folder_id',
        'original_folder_id',
        'telegram_file_id',
        'metadata',
        'temporary',
        'deleted_at',
    ];

    protected $casts = [
        'width' => 'integer',
        'height' => 'integer',
        'size' => 'integer',
        'folder_id' => 'integer',
        'original_folder_id' => 'integer',
        'temporary' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Связь с папкой
     *
     * @return BelongsTo
     */
    public function folder(): BelongsTo
    {
        return $this->belongsTo(Folder::class, 'folder_id', 'id');
    }

    /**
     * Получить полный URL файла
     *
     * @return string
     */
    public function getUrlAttribute(): string
    {
        $metadata = $this->metadata ? json_decode($this->metadata, true) : [];
        $path = $metadata['path'] ?? ($this->disk . '/' . $this->name);
        
        return '/' . ltrim($path, '/');
    }

    /**
     * Получить полный путь к файлу на сервере
     *
     * @return string
     */
    public function getFullPathAttribute(): string
    {
        $metadata = $this->metadata ? json_decode($this->metadata, true) : [];
        $path = $metadata['path'] ?? ($this->disk . '/' . $this->name);
        
        return public_path($path);
    }

    /**
     * Получить размер файла в читаемом формате
     *
     * @return string
     */
    public function getSizeFormattedAttribute(): string
    {
        $bytes = $this->size;
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        
        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }
}

