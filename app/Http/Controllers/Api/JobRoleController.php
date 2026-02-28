<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;

class JobRoleController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->get('q');

        $roles = Job::query()
            ->when($query, function ($q) use ($query) {
                $q->where('job_role', 'like', "%{$query}%");
            })
            ->whereNotNull('job_role')
            ->distinct()
            ->limit(20)
            ->pluck('job_role');

        return response()->json($roles);
    }
}
