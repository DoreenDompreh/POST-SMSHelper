<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use App\Services\VisitorService;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    protected $visitorService;

    public function __construct(VisitorService $visitorService)
    {
        $this->visitorService = $visitorService;
    }

    // Check In
    public function checkIn(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'host' => 'required|string',
            'purpose' => 'required|string',
        ]);

        $visitor = $this->visitorService->checkIn($validated);
        return response()->json(['message' => 'Checked in successfully', 'data' => $visitor], 200);
    }

    // Check Out
    public function checkOut(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
        ]);

        $visitor = $this->visitorService->checkOut($validated['name']);
        return response()->json(['message' => 'Checked out successfully', 'data' => $visitor], 200);
    }

    // List Visitors
    public function index()
    {
        $visitors = Visitor::all();
        return response()->json(['data' => $visitors], 200);
    }
}
