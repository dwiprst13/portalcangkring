<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenRt extends Model
{
    use HasFactory;
    protected $table = 'penrts'; // Sesuaikan dengan nama tabel yang benar
    protected $guarded = ['id'];
}

