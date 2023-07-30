<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory;

        /**
         * Books model main columns
         *
         * @var array<int, string>
         */
        protected $fillable = [
            'name',
            'author_name',
            "copies"
        ];
}
