<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::with([
            'projects.tags',
            'socials',
            'experiences',
            'certifications',
        ])->first(); 

        return response()->json([
            'myProjects' => $user->projects->map(function ($project) {
                return [
                    'id' => $project->id,
                    'title' => $project->title,
                    'description' => $project->description,
                    'sub_description' => $project->sub_description,
                    'href' => $project->href,
                    'image' => $project->image,
                    'tags' => $project->tags->map(fn ($tag) => [
                        'id' => $tag->id,
                        'name' => $tag->name,
                        'path' => $tag->path,
                    ]),
                ];
            }),
            'mySocials' => $user->socials->map(fn ($s) => [
                'name' => $s->name,
                'href' => $s->href,
                'icon' => $s->icon,
            ]),
            'experiences' => $user->experiences->map(fn ($e) => [
                'title' => $e->title,
                'job' => $e->job,
                'start_date' => $e->start_date, 
                'end_date' => $e->end_date,
                'contents' => $e->contents,
            ]),
            'certifications' => $user->certifications->map(fn ($c) => [
                'title' => $c->title,
                'img' => $c->img,
            ]),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
