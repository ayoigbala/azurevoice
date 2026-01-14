<?php
/**
 * Created by NiNaCoder.
 * Date: 2019-05-25
 * Time: 09:01
 */

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use View;

class UpgradeController
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    public function index(Request $request)
    {
        return view('backend.upgrade.index');
    }


    public function checkingLicense(Request $request)
    {
        // License check bypassed for custom development
        return view('backend.upgrade.process');
    }
}