<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'alias',
        'is_active'
    ];

    public function isActive(): bool
    {
        return $this->is_active;
    }

    public function translations()
    {
        return $this->morphMany(Translation::class, 'translatable');
    }

    public function getTranslationValue($field, $locale)
    {
        return $this->translations()
            ->where('locale', $locale)
            ->where('field', $field)
            ->value('value')
        ;
    }

    public function getTitle($locale): string
    {
        return $this->getTranslationValue('title', $locale);
    }

    public function getContent($locale): string
    {
        return $this->getTranslationValue('content', $locale);
    }
}
