<?php
declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Entry
 *
 * @property-read mixed $created_at
 * @property mixed $is_active
 * @property-read mixed $updated_at
 * @mixin \Eloquent
 */
abstract class Entry extends Model
{

    use TimezoneAccessor;
    protected $dateFormat = 'Y-m-d H:i:sO';

    public function getRouteKeyName()
    {
        return 'url';
    }

    public function getFillable(): array
    {
        return ['title', 'url', 'content', 'meta_tags', 'meta_description', 'is_active'];
    }

    public function setIsActiveAttribute($value)
    {
        $this->attributes['is_active'] = (bool)$value;
    }

    // For the type checking
    public function getIsActiveAttribute(?bool $value): ?bool
    {
        return $value;
    }

    public function getUrl(): string
    {
        return route($this->getTable().'.show', array_merge(isset($this->catalogue) ? [$this->catalogue] : [], [$this]));
    }
}
