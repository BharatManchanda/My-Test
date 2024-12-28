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
        $page = $request->query('page', 1);
        $cacheKey = strtolower("leads_type_{$type}_page_{$page}");

        $leads = Cache::remember($cacheKey, 60 * 5, function () use ($type) {
            if ($type === 'all') {
                return Lead::latest()->paginate(20);
            } else {
                return Lead::latest()->where('type', $type)->paginate(20);
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
            $this->clearCache();
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
        $this->clearCache();
        return redirect()->route('leads.index')->with('success', 'Lead updated successfully!');
    }

    public function destroy(Request $request) {
        $lead = Lead::findOrFail($request->id);
        $this->clearCache();
        $lead->delete();
        return redirect()->route('leads.index')->with('success', 'Lead deleted successfully!');
    }

    private function clearCache() {
        $types = ['all', 'web', 'walkin', 'store'];
        foreach ($types as $type) {
            $leadsQuery = Lead::latest();
            if ($type !== 'all') {
                $leadsQuery->where('type', $type);
            }
            $totalPages = ceil($leadsQuery->count() / 20);
            for ($page = 1; $page <= $totalPages; $page++) {
                Cache::forget("leads_type_{$type}_page_{$page}");
            }
        }
    }
    
}
