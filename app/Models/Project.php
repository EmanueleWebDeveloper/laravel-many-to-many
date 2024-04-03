<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'cover',
        'slug',
        'type_id'
    ];

    public static function generateSlug($title){
        return Str::slug($title, '-');
    }

    //un progetto puo avere solo un typo

    public function type(): BelongsTo{
        return $this->belongsTo( type::class );
    }
}
