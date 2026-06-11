<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class estoque extends Model
{
    use HasFactory;
    protected $estoque;
    protected $fillable = ['titulo','autor','ano_publicacao','genero','quantidade_paginas','status'];
}
