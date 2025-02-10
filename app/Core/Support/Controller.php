<?php

namespace App\Core\Support;

use App\Core\Support\Traits\JsonResponse;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class Controller
{
    use JsonResponse, ValidatesRequests;
}
