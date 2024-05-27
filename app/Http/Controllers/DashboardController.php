<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DashboardService;

class DashboardController extends Controller
{
    protected $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    public function dashboard()
    {
        $loanDetails = $this->dashboardService->getLoanDetails();

        return view('dashboard.dashboard')->with([
            'loanDetails' => $loanDetails
        ]);
    }
}
