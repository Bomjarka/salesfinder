<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $name
 * @property int $user_id
 * @property boolean $enabled
 */
class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'enabled',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany
     */
    public function tokens(): HasMany
    {
        return $this->hasMany(ShopKeys::class);
    }

    /**
     * @return void
     */
    public function restore(): void
    {
        $this->enabled = false;
        $this->save();
    }

    public function getActiveToken()
    {
        return $this->tokens()->enabled()->first();
    }
}
