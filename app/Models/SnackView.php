<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SnackView extends Model
{
    protected $fillable = ['user_id', 'snack_id', 'viewed_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function snack()
    {
        return $this->belongsTo(Snack::class);
    }

    // Add any additional methods or properties you need for tracking views here
}
