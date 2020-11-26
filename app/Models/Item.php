<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    /**
     * Vault relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vault(){
        return $this->belongsTo('App\Models\Vault');
    }
}
