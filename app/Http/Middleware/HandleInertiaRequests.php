<?php

namespace App\Http\Middleware;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;
use function config;
use function settings;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'auth' => [
                'user' => Auth::user(),
            ],
            'app' => [
                'name' => settings()->site_name,
                'logo' => settings()->logo,
                'admin_items' => $this->buildAdminNavigationLinks(),
            ],
            'messages' => [
                'flash' => $this->buildFlashMessage($request->session()),
            ],
            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy)->toArray(), [
                    'location' => $request->url(),
                ]);
            },
        ]);
    }

    private function buildFlashMessage(Session $session): ?array
    {
        $flashMessage = [];

        if ($session->has('warning')) {
            $flashMessage['text'] = $session->get('warning');
            $flashMessage['type'] = 'warning';
        } else if ($session->has('error')) {
            $flashMessage['text'] = $session->get('error');
            $flashMessage['type'] = 'error';
        } else if ($session->has('success')) {
            $flashMessage['text'] = $session->get('success');
            $flashMessage['type'] = 'success';
        } else {
            return null;
        }

        return $flashMessage;
    }

    private function buildAdminNavigationLinks(): array
    {
        $items = [];

        if (!Auth::user()) {
            return $items;
        }

        $navigationItems = config('navigation.admin_items');

        foreach ($navigationItems as $navigationItem) {
            $navigationItem['current'] = $this->buildCurrentWildcard($navigationItem['route']);

            if (!isset($navigationItem['permission'])) {
                $items[] = $navigationItem;
                continue;
            }

            if (Auth::user()->can($navigationItem['permission'])) {
                $items[] = $navigationItem;
            }
        }

        return $items;
    }

    private function buildCurrentWildcard(string $route): string
    {
        $parts = explode('.', $route);

        if (count($parts) > 2) {
            array_pop($parts);
            $route = implode('.', $parts) . '.*';
        }

        return $route;
    }
}
