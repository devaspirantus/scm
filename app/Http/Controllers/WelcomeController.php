<?php


namespace App\Http\Controllers;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $helper = App::make('helper');
        
        return $helper->greet('Ammar');
    }
}
