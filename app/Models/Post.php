<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function usersEmail(){
        // Use Eloquent belongsTo directly, fetch the related user, and return email
        return $this->belongsTo(User::class, 'user_id')->first()?->email;
    }
}
