<?php

namespace App\Http\Controllers;

use RuntimeException;

class GDCheckController extends Controller
{
    public function checkGDExtension()
    {
        if (!extension_loaded('gd')) {
            // GD extension is not installed
            return 'GD extension is not installed.';
        }

        // Check if the GD library is enabled
        if (!function_exists('gd_info')) {
            // GD library is not enabled
            return 'GD library is not enabled.';
        }

        // GD extension is installed and enabled
        return 'GD extension is installed and enabled.';
    }
}
