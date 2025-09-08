<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeDo extends Model
{
    use HasFactory;

    protected $table = 'we_dos';
    protected $fillable = [
        'title',
        'title_bn',
        'image',
        'description',
        'description_bn'
    ];
}
