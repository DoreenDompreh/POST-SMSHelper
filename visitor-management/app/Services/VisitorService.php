<?php
namespace App\Services;

use App\Models\Visitor;
use Carbon\Carbon;

class VisitorService
{
    // Handle Check-In
    public function checkIn(array $data)
    {
        // Check if the visitor already exists
        $visitor = Visitor::where('name', $data['name'])->first();

        if ($visitor && !$visitor->check_out_at) {
            return response()->json(['message' => 'Visitor already checked in'], 400);
        }

        // Create new visitor or update frequency if already exists
        if ($visitor) {
            $visitor->frequency += 1;
            $visitor->check_in_at = Carbon::now();
            $visitor->check_out_at = null;
            $visitor->save();
        } else {
            $visitor = Visitor::create([
                'name' => $data['name'],
                'host' => $data['host'],
                'purpose' => $data['purpose'],
                'check_in_at' => Carbon::now(),
            ]);
        }

        return $visitor;
    }

    // Handle Check-Out
    public function checkOut($name)
    {
        $visitor = Visitor::where('name', $name)->whereNull('check_out_at')->first();

        if (!$visitor) {
            return response()->json(['message' => 'Visitor not found or already checked out'], 404);
        }

        // Mark as checked out
        $visitor->check_out_at = Carbon::now();
        $visitor->save();

        return $visitor;
    }
}

