<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\HomepageService;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function __construct(
        protected HomepageService $homepageService
    ) {}

    public function __invoke(): View
    {
        $data = $this->homepageService->getHomepageData();

        return view('storefront.home', $data);
    }
}
