<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\ApiResponser;
use App\Models\Circle;
use Illuminate\Http\Response;

class CircleController extends Controller
{
    use ApiResponser;

    public function get_circles(Request $request)
    {
        $circles = Circle::get()->groupBy('duration');

        return $this->success($circles);
    }
}
