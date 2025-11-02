<?php
// app/Models/UnlockCode.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnlockCode extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function transfer()
    {
        return $this->belongsTo(Transfer::class);
    }
}
