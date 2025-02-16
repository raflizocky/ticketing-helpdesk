<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketReplies extends Model
{
    protected $table = 'ticket_replies';
    protected $primaryKey = 'id';
    protected $fillable = ['ticket_id', 'user_id', 'message'];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
