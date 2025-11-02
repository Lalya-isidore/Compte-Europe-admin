<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Remboursement extends Model
{
    
    protected $fillable = ['compte_id', 'montant'];
}
