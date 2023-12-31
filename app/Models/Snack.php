<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Snack extends Model
{
    protected $fillable = ['name', 'ingredients', 'description', 'user_id', 'type'];

    // Define the relationship to the User model so snacks can be linked to users
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    use HasFactory;
}
