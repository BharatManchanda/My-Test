<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LeadController extends Controller
{
    
    public function index() {
        $leads = Lead::all();
        return view('leads.index', compact('leads'));
    }

    public function showCreateOrUpdate ($id=null) {
        if ($id) {
            $lead = Lead::findOrFail($id);
            return view('leads.createOrUpdate', compact('lead'));
        } else {
            $lead = null;
            return view('leads.createOrUpdate',[
                "lead" => $lead,
            ]);
        }

    }

    public function create(Request $request) {
        try {
            $request->validate([
                'title' => 'required|string',
                'contact' => 'required|numeric|digits:10',
                'email' => 'required|email',
                'name' => 'required|string',
                'type' => 'required|in:WEB,WALKIN,STORE',
            ]);

            Lead::create($request->all());
            return redirect()->route('leads.index')->with('success', 'Lead created successfully!');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    }

    public function update(Request $request) {
        $lead = Lead::findOrFail($request->id);

        $request->validate([
            'title' => 'required|string',
            'contact' => 'required|numeric|digits:10',
            'email' => 'required|email',
            'name' => 'required|string',
            'type' => 'required|in:WEB,WALKIN,STORE',
        ]);

        $lead->update($request->all());
        return redirect()->route('leads.index')->with('success', 'Lead updated successfully!');
    }

    public function destroy(Request $request) {
        $lead = Lead::findOrFail($request->id);
        $lead->delete();

        return redirect()->route('leads.index')->with('success', 'Lead deleted successfully!');
    }
}
