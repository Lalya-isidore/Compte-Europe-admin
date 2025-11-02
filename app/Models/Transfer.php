<?php
// app/Models/Transfer.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function compte()
    {
        return $this->belongsTo(Compte::class);
    }

    public function unlockCode()
    {
        return $this->hasOne(UnlockCode::class);
    }
    
    
}

