<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Pessoa extends Model
{
    protected $keyType = 'string';
    protected $fillable = [
        'nome',
        'email',
        'telefone',
    ];
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();

        // Gerar UUID ao criar uma nova instância
        static::creating(function ($model) {
            $model->id = (string) Uuid::uuid4();
        });
    }
}
