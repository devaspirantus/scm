<?php 


namespace App\Services;
use App\Models\Student;

class HelperService
{
    public static function greet(string $name): string
    {
        return "Hello, " . $name . "!";
    }
}