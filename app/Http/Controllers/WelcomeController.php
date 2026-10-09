<?php


namespace App\Http\Controllers;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Services\HelperService;

class WelcomeController extends Controller
{

    protected HelperService $helper;

    public function __construct(HelperService $helper)
    {
        $this->helper = $helper;
    }

    public function index()
    {
        return $this->helper->greet('AMmaR');
    }
}
