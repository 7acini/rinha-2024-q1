<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model{
    protected $fillable = ['name', 'limit', 'balance'];
    public $timestamps = false;

    public function transactions() {
        return $this->hasMany(Transaction::class);
    }
}