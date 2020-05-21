<?php

namespace App;

use App\SpaceCraft;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Armaments extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'qty',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden   = [
        'created_at', 'updated_at', 'id', 'pivot'
    ];

    /**
     * Relationship between Armaments and spacecrafts 
     * @return BelongsTo 
     */
    public function spacecraft() : BelongsToMany
    {
        return $this->belongsToMany(SpaceCraft::class);
    }
}
