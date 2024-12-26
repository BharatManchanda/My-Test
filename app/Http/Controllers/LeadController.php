<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    // Display all leads
    // public function dashboard() {
    //     return view('leads.index');
    // }

    public function dashboard() {
        $leads = Lead::all();
        return view('leads.index', compact('leads'));
    }

    // Show form to create a new lead
    public function create()
    {
        return view('leads.create');
    }

    // Store a new lead
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'contact' => 'required|string',
            'email' => 'required|email',
            'name' => 'required|string',
            'type' => 'required|in:WEB,WALKIN,STORE',
        ]);

        Lead::create($request->all());
        return redirect()->route('leads.index')->with('success', 'Lead created successfully!');
    }

    // Show form to edit a lead
    public function edit($id)
    {
        $lead = Lead::findOrFail($id);
        return view('leads.edit', compact('lead'));
    }

    // Update an existing lead
    public function update(Request $request, $id)
    {
        $lead = Lead::findOrFail($id);

        $request->validate([
            'title' => 'string',
            'contact' => 'string',
            'email' => 'email',
            'name' => 'string',
            'type' => 'in:WEB,WALKIN,STORE',
        ]);

        $lead->update($request->all());
        return redirect()->route('leads.index')->with('success', 'Lead updated successfully!');
    }

    // Delete a lead
    public function destroy($id)
    {
        $lead = Lead::findOrFail($id);
        $lead->delete();

        return redirect()->route('leads.index')->with('success', 'Lead deleted successfully!');
    }
}
