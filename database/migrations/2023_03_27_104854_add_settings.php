<?php

use App\Models\Settings;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Settings::create([
            'site_name' => config('app.name'),
            'mail_from' => config('mail.from.address')
        ]);
    }
};
