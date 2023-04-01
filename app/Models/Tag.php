<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tag';

    protected $primaryKey = 'tagId';

    public $timestamps = false;

    protected $fillable = [
        'tagName',
    ];

}