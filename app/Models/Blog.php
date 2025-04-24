<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Blog extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'title',
        'detail'
    ];

    public function toSearchableArray(): array
    {
        return [
            'title' => $this->title,
            'detail' => $this->detail,
        ];
    }
}
