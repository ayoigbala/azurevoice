<?php

namespace App\Installer\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class InstallMigrationsController extends Controller
{
    public function __invoke(): View|Factory|Application|RedirectResponse
    {
        if (
            !DB::connection()->getPdo() ||
            !(new InstallServerController())->check() ||
            !(new InstallFolderController())->check()
        ) {
            return redirect()->route('installer-router.install.database');
        }

        return view('installer::steps.migrations');
    }
}
