<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Type extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug'
    ];

    //i tipi sono le relazioni 1 to many
    //un type appartiene a piu progetti

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

}
