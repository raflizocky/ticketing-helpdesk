<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'email', 'password', 'role', 'department_id'];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function createdTickets()
    {
        return $this->hasMany(Ticket::class, 'created_by');
    }

    public function assignedTickets()
    {
        return $this->hasMany(Ticket::class, 'assigned_to');
    }

    public function ticketReplies()
    {
        return $this->hasMany(TicketReplies::class);
    }

    public function hasRole($role): bool
    {
        return $this->role === $role;
    }

    public function hasAnyRole($roles): bool
    {
        if (is_array($roles)) {
            return in_array($this->role, $roles);
        }
        return $this->role === $roles;
    }
}
