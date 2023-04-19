<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;

class Audit extends \OwenIt\Auditing\Models\Audit
{

    protected $appends = [
        'author',
        'target',
    ];

    public static $columns = [
        'id' => 'ID',
        'author' => 'Author',
        'event' => 'Event',
        'target' => 'Target',
    ];

    public function author(): Attribute
    {
        return Attribute::make(
            get: fn () => Str::replace('App\Models\\', '', $this->user_type) . ': ' . $this->user->name
        );
    }

    public function target(): Attribute
    {
        return Attribute::make(
            get: fn () => Str::replace('App\Models\\', '', $this->auditable_type)
        );
    }

}
