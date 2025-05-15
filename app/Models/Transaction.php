<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

Class Transaction extends Model {
    protected $fillable = ['client_id', 'value','type','description','performs_in'];
    public $timestamps = false;

    protected $casts = [
        'performs_in'=> 'datetime',
    ];

    public function client(): BelongsTo {
        return $this->belongsTo(Client::class);
    }
}