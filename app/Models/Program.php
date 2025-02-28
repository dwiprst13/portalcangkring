<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Program extends Model {
    use HasFactory;
    use Sluggable;

    protected $fillable = ['foto', 'program', 'slug', 'deskripsi', 'user_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function sluggable(): array
    {
        return [
            'slug'  => [
                'source'    => 'program'
            ]
        ];
    }
}
