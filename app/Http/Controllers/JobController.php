<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateJobRequest;
use App\Models\Job;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $jobs = Job::latest()->with(['employer', 'tags'])->get()->groupBy('featured');

        return view('jobs.index', [
            'jobs' => $jobs[0],
            'featuredJobs' => $jobs[1],
            'tags' => Tag::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $attributes = $request->validate([
            'title' => ['required'],
            'salary' => ['required'],
            'location' => ['required'],
            'schedule' => ['required', Rule::in(['Part Time', 'Full Time'])],
            'url' => ['required', 'active_url'],
            'tags' => ['nullable'],
        ]);

        $attributes['featured'] = $request->has('featured');

        $job = Auth::user()->employer->jobs()->create(Arr::except($attributes, 'tags'));

        if ($attributes['tags'] ?? false) {
            foreach (explode(',', $attributes['tags']) as $tag) {
                $job->tag($tag);
            }
        }

        return redirect('/');
    }
    /**
     * Show the ressource.
     */
    public function show(Job $job): View
    {
        return view('jobs.show', [
            'job' => $job
        ]);
    }

    /**
     * Edit the ressource.
     */
    public function edit(Job $job): View
    {
        return view('jobs.edit', ['job' => $job]);
    }

    /**
     * Update the ressource.
     */
    public function update(Job $job): RedirectResponse
    {
        // dd(request()->has('featured'));
        // Gate::authorize('edit-job', $job);
        $attributes = request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required'],
            'location' => ['required'],
            'schedule' => ['required'],
            'url' => ['required'],
            'tags' => ['nullable']
        ]);

        $job->update([
            'title' => request('title'),
            'salary' => request('salary'),
            'location' => request('location'),
            'schedule' => request('schedule'),
            'featured' => request()->has('featured') ? 1 : 0,
            'url' => request('url'),
        ]);

        if ($attributes['tags'] ?? false) {
            foreach (explode(',', $attributes['tags']) as $tag) {
                $job->tag($tag);
            }
        }
        return redirect('/jobs/' . $job->id);
    }

    /**
     * Delete the ressource.
     */
    public function destroy(Job $job): RedirectResponse
    {
        $job->delete();

        return redirect('/');
    }
}
