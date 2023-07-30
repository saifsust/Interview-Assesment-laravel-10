<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookMeta extends Model
{
    use HasFactory;

           /**
             * Books model main columns
             *
             * @var array<int, string>
             */
            protected $fillable = [
                'user_id',
                'book_id',
                "is_returned",
                "issued_at",
                "returned_at"
            ];
}
