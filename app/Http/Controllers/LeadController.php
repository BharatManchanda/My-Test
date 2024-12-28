<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\ValidationException;

class LeadController extends Controller
{
    
    public function index(Request $request) {
        $type = $request->query('type', 'all');
        $cacheKey = strtolower("leads_type_{$type}");
        $leads = Cache::remember($cacheKey, 60 * 5, function () use ($type) {
            if ($type === 'all') {
                return Lead::latest()->get();
            } else {
                return Lead::latest()->where('type', $type)->get();
            }
        });
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
                'type' => 'required|in:web,walkin,store',
            ]);

            $lead = Lead::create($request->all());
            $this->clearChache();
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
            'type' => 'required|in:web,walkin,store',
        ]);

        $lead->update($request->all());
        $this->clearChache();
        return redirect()->route('leads.index')->with('success', 'Lead updated successfully!');
    }

    public function destroy(Request $request) {
        $lead = Lead::findOrFail($request->id);
        $this->clearChache();
        $lead->delete();
        return redirect()->route('leads.index')->with('success', 'Lead deleted successfully!');
    }

    private function clearChache() {
        Cache::forget("leads_type_all");
        Cache::forget("leads_type_web");
        Cache::forget("leads_type_walkin");
        Cache::forget("leads_type_store");
    }
}
