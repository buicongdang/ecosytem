<?php
namespace App\Http\Controllers;

class DebugController extends Controller
{
    function phpInfo()
    {
        echo phpinfo();
    }
}
