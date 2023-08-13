<?php

namespace App\Http\Controllers;

use App\Services\HomeService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(protected HomeService $homeService)
    {
    }

    public function index()
    {
        return view('home.index')->with($this->homeService->homeData());
    }
}
