<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

/**
 * @property int $shop_id
 * @property bool $enabled
 * @property string $token
 */
class ShopKeys extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop_id',
        'token',
        'enabled',
    ];

    /**
     * @return BelongsTo
     */
    public function shop(): BelongsTo
    {
        return $this->belongsTo(Shop::class);
    }

    /**
     * @return void
     */
    public function restore(): void
    {
        $this->enabled = false;
        $this->save();
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeEnabled(Builder $query): Builder
    {
        return $query->where('enabled', true);
    }
}
