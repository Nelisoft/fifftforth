<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plan;

class PlanController extends Controller
{
    // Display a listing of plans
    public function index()
    {
        $plans = Plan::latest()->paginate(15);
        return view('admin.plans.index', compact('plans'));
    }

    // Show the form for creating a new plan
    public function create()
    {
        return view('admin.plans.create');
    }

    // Store a newly created plan
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:plans,name',
            'min_amount' => 'required|numeric|min:0',
            'max_amount' => 'required|numeric|gte:min_amount',
            'daily_roi' => 'required|numeric|min:0', // Daily return %
            'duration_days' => 'required|integer|min:1',
        ]);

        Plan::create($request->only([
            'name', 
            'min_amount', 
            'max_amount', 
            'daily_roi', 
            'duration_days'
        ]));

        return redirect()->route('admin.plans.index')->with('success', 'Plan created successfully.');
    }

    // Show the form for editing a plan
    public function edit(Plan $plan)
    {
        return view('admin.plans.edit', compact('plan'));
    }

    // Update the specified plan
    public function update(Request $request, Plan $plan)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:plans,name,' . $plan->id,
            'min_amount' => 'required|numeric|min:0',
            'max_amount' => 'required|numeric|gte:min_amount',
            'daily_roi' => 'required|numeric|min:0', // Daily return %
            'duration_days' => 'required|integer|min:1',
        ]);

        $plan->update($request->only([
            'name', 
            'min_amount', 
            'max_amount', 
            'daily_roi', 
            'duration_days'
        ]));

        return redirect()->route('admin.plans.index')->with('success', 'Plan updated successfully.');
    }

    // Delete a plan
    public function destroy(Plan $plan)
    {
        $plan->delete();
        return back()->with('success', 'Plan deleted successfully.');
    }
}
