<?php

namespace LetoceilingCoder\MediaManager\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use LetoceilingCoder\MediaManager\Models\Traits\Filterable;

class Folder extends Model
{
    use Filterable, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'src',
        'parent_id',
        'position',
        'protected',
        'is_trash',
    ];

    protected $appends = ['filesCount'];

    protected $casts = [
        'parent_id' => 'int',
        'position' => 'int',
        'protected' => 'boolean',
        'is_trash' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Родительская папка
     *
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }

    /**
     * Дочерние папки
     *
     * @return HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id', 'id')
            ->orderBy('position', 'asc')
            ->orderBy('id', 'asc');
    }

    /**
     * Файлы в папке
     *
     * @return HasMany
     */
    public function files(): HasMany
    {
        return $this->hasMany(Media::class, 'folder_id', 'id')
            ->orderBy('created_at', 'desc');
    }

    /**
     * Количество файлов в папке
     *
     * @return Attribute
     */
    public function filesCount(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->files()->count(),
        );
    }

    /**
     * Accessor и mutator для slug
     *
     * @return Attribute
     */
    public function slug(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ?? Str::of($this->name)->lower()->slug(),
            set: fn ($value) => $value ?: Str::of($this->name)->lower()->slug(),
        );
    }

    /**
     * Получить папку корзины
     *
     * @return Folder|null
     */
    public static function getTrashFolder(): ?Folder
    {
        return self::where('is_trash', true)->first();
    }
}

