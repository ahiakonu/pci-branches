<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoticeBoard extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender',
        'sender_role',
        'sender_id',
        'receiptient',
        'receiptient_role',
        'receiptient_id',
        'message_title',
        'message_body',
        'status'
    ];
}
