<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\JobRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JobRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request('search');

        // Fetch all roles from the dedicated table
        $jobRoles = JobRole::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->orderBy('name')
            ->get();

        // Count usage for each role
        // We can attach this count attribute on the fly
        foreach ($jobRoles as $role) {
            $role->total = Job::where('job_role', $role->name)->count();
        }

        return view('admin.job_roles.index', compact('jobRoles', 'search'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:job_roles,name',
        ]);

        JobRole::create(['name' => $request->name]);

        return redirect()->route('admin.job-roles.index')
            ->with('success', 'Job role created successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JobRole $jobRole)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:job_roles,name,' . $jobRole->id,
        ]);

        $oldName = $jobRole->name;
        $jobRole->update(['name' => $request->name]);

        // Optional: Update existing jobs to reflect the name change
        // Job::where('job_role', $oldName)->update(['job_role' => $request->name]);

        return redirect()->route('admin.job-roles.index')
            ->with('success', 'Job role updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $role = JobRole::findOrFail($id);
        $roleName = $role->name;

        // Remove role string from jobs table
        Job::where('job_role', $roleName)->update(['job_role' => null]);

        // Delete the entry
        $role->delete();

        return redirect()->route('admin.job-roles.index')
            ->with('success', "Job role '{$roleName}' deleted successfully.");
    }
}
