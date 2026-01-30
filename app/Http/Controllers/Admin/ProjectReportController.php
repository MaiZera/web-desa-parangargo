<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProjectReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectReportController extends Controller
{
    public function index(Request $request)
    {
        $query = ProjectReport::query();

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->has('rt') && $request->rt) {
            $query->where('rt', $request->rt);
        }

        $reports = $query->latest()->paginate(10);

        // Get distinct RT values from database
        $availableRTs = ProjectReport::whereNotNull('rt')
            ->where('rt', '!=', '')
            ->distinct()
            ->orderBy('rt')
            ->pluck('rt');

        return view('admin.project-reports.index', compact('reports', 'availableRTs'));
    }

    public function create()
    {
        return view('admin.project-reports.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'rt' => 'nullable|string|max:5',
            'rw' => 'nullable|string|max:5',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'percentage' => 'required|integer|min:0|max:100',
            'status' => 'required|string|in:Pending,On Progress,Selesai',
            'fund_usage' => 'required|numeric|min:0',
        ]);

        // Validate that 'Selesai' status can only be set when percentage is 100
        if ($request->status === 'Selesai' && $request->percentage != 100) {
            return back()->withErrors(['status' => 'Status "Selesai" hanya dapat dipilih jika progress mencapai 100%.'])->withInput();
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('project-reports', 'public');
        }

        ProjectReport::create($validated);

        return redirect()->route('admin.project-reports.index')->with('success', 'Laporan berhasil ditambahkan.');
    }

    public function edit(ProjectReport $projectReport)
    {
        return view('admin.project-reports.edit', compact('projectReport'));
    }

    public function update(Request $request, ProjectReport $projectReport)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'rt' => 'nullable|string|max:5',
            'rw' => 'nullable|string|max:5',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'percentage' => 'required|integer|min:0|max:100',
            'status' => 'required|string|in:Pending,On Progress,Selesai',
            'fund_usage' => 'required|numeric|min:0',
        ]);

        // Validate that 'Selesai' status can only be set when percentage is 100
        if ($request->status === 'Selesai' && $request->percentage != 100) {
            return back()->withErrors(['status' => 'Status "Selesai" hanya dapat dipilih jika progress mencapai 100%.'])->withInput();
        }

        if ($request->hasFile('image')) {
            if ($projectReport->image) {
                Storage::disk('public')->delete($projectReport->image);
            }
            $validated['image'] = $request->file('image')->store('project-reports', 'public');
        }

        $projectReport->update($validated);

        return redirect()->route('admin.project-reports.index')->with('success', 'Laporan berhasil diperbarui.');
    }

    public function destroy(ProjectReport $projectReport)
    {
        if ($projectReport->image) {
            Storage::disk('public')->delete($projectReport->image);
        }
        $projectReport->delete();

        return redirect()->route('admin.project-reports.index')->with('success', 'Laporan berhasil dihapus.');
    }
}
