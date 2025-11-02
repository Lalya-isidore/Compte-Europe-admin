<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionHistory extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function compte()
    {
        return $this->belongsTo(Compte::class);
    }
    public function Transfer()
    {
        return $this->belongsTo(Transfer::class);
    }

    public function unlockCode()
    {
        return $this->hasOne(UnlockCode::class);
    }
}
