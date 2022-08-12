<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopicDocument extends Model
{
    use HasFactory;

    protected $table = 'topic_documents';
    protected $primaryKey = 'id';
    protected $fillable = [
        'topic_id',
        'link',
        'type',
        'is_show',
    ];
}
