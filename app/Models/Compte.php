<?php
// app/Models/Compte.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Compte extends Model
{
    use HasFactory;

    protected $guarded = [''];

    protected $casts = [
        'is_default' => 'boolean',
    ];

    public static function generateCardNumber()
    {
        $prefix = rand(4100, 4999);
        $suffix = rand(1000, 9999);
        return $prefix . str_repeat('*', 8) . $suffix;
    }

    public static function generateCVV()
    {
        return rand(100, 999);
    }
    public static function generatePassword()
    {
        return rand(100000, 999999);
    }
    public static function generateCodeVirement()
    {
        return rand(100000, 999999);
    }

    public static function generateAccountNumber()
    {
        return 'FC-' . Str::upper(Str::random(10));
    }

    public function transfers()
    {
        return $this->hasMany(Transfer::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}

