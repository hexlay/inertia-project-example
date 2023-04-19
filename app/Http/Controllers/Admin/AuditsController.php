<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Audit;
use Inertia\Inertia;

class AuditsController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Audit::class);

        $audits = Audit::select(['id', 'auditable_type', 'user_type', 'user_id', 'event'])->get();

        return Inertia::render('Admin/Audits/Index', [
            'audits' => $audits,
            'columns' => Audit::$columns,
        ]);
    }

    public function show(Audit $audit)
    {
        $this->authorize('view', Audit::class);

        return Inertia::render('Admin/Audits/View', [
            'audit' => $audit
        ]);
    }

}
