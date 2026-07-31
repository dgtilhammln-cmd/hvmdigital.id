<?php

namespace App\Http\Controllers;

use App\Services\TrackingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function __construct(private TrackingService $tracking) {}

    public function visitor(Request $request): JsonResponse
    {
        $this->tracking->recordVisitor($request);
        return response()->json(['ok' => true]);
    }

    public function waClick(Request $request): JsonResponse
    {
        $this->tracking->recordWaClick($request);
        return response()->json(['ok' => true]);
    }
}
