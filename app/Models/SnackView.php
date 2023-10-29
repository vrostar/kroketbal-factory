<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SnackView extends Model
{
    protected $fillable = ['user_id', 'snack_id', 'viewed_at'];

    public function user()
    {
        // Create relation to User model so snack views can be linked to user
        return $this->belongsTo(User::class);
    }

    public function snack()
    {
        // Create relation to Snack model so snack views can be linked to snack
        return $this->belongsTo(Snack::class);
    }

}
