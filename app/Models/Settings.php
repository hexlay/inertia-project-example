<?php

namespace App\Models;

use App\Traits\ExtendsMediaInteractions;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableInterface;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Settings extends Model implements AuditableInterface, HasMedia
{
    use Auditable, InteractsWithMedia, ExtendsMediaInteractions;

    protected $table = 'settings';

    protected $fillable = [
        'site_name',
        'mail_from',
    ];

    protected $appends = [
        'logo'
    ];

    public function logo(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getFirstMediaUrl('logo')
        );
    }

}
