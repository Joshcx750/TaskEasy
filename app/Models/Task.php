<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'priority',
        'status',
        'due_date',
        'google_drive_url',
    ];

    protected function casts(): array
    {
        return [
            'due_date' => 'date',
        ];
    }
}
