<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\Project;
use App\Models\Image;
use App\Models\Skill;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{

   public function show()
{
    $portfolio = Portfolio::with([
        'skills:id,name',
        'projects',
        'images'
    ])->firstOrCreate([
        'user_id' => auth()->id()
    ]);

    $portfolio->setRelation(
        'skills',
        $portfolio->skills->map(fn($s) => $s->makeHidden('pivot'))
    );

    return view('profile', compact('portfolio'));
}

public function edit()
{
    $portfolio = Portfolio::with([
        'skills:id,name',
        'projects',
        'images'
    ])->where('user_id', auth()->id())->first();

    $portfolio->setRelation(
        'skills',
        $portfolio->skills->map(fn($s) => $s->makeHidden('pivot'))
    );

    return view('edit-portfolio', compact('portfolio'));
}

public function deleteImage($id) {
    $query = Image::where('id', $id);
    if (!auth()->user()->isAdmin()) {
        $query->whereHas('portfolio', function ($q) {
            $q->where('user_id', auth()->id());
        });
    }
    $image = $query->firstOrFail();
    $image->delete();
    return response()->json(['success' => true]);
}

public function update(Request $request)
{
    $request->validate([
        'name' => 'required|string',
        'description' => 'nullable|string',
    ]);

    $portfolio = Portfolio::firstOrCreate(
        ['user_id' => auth()->id()]
    );

    $portfolio->title = $request->name;
    $portfolio->description = $request->description;
    $portfolio->save();

    $skills = [];

    if ($request->skills) {
        $skillsArray = explode(',', $request->skills);

        foreach ($skillsArray as $skillName) {
            $skill = Skill::firstOrCreate([
                'name' => trim($skillName)
            ]);

            $skills[] = $skill->id;
        }
    }

    $portfolio->skills()->sync($skills);

    $portfolio->projects()->delete();

    if ($request->projects) {

    foreach ($request->projects as $project) {
        if (!empty(trim($project['title'] ?? ''))) {
            Project::create([
                'portfolio_id' => $portfolio->id,
                'title' => $project['title'],
                'description' => $project['description'] ?? '',
            ]);

        }
    }
}

    if ($request->filled('delete_images')) {
    Image::whereIn('id', $request->delete_images)->delete();
}
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $file) {
            if (!$file || !$file->isValid()) continue;
            $path = $file->store('images', 'public');
            Image::create([
                'portfolio_id' => $portfolio->id,
                'image_url' => $path,
            ]);
    }
}
    return redirect('/profile');
}
    public function view($id) {
        $portfolio = Portfolio::with([
            'skills',
            'projects',
            'images',
            'user'
        ])->findOrFail($id);

    return view('view-portfolio', compact('portfolio'));
}

    public function search(Request $request) {
        $query = $request->search;
        $portfolios = Portfolio::with(['skills', 'user'])->when($query, function ($q) use ($query) {
        $q->where(function ($sub) use ($query) {
            $sub->where('title', 'like', "%{$query}%")
                ->orWhereHas('skills', function ($skillQuery) use ($query) {
                    $skillQuery->where('name', 'like', "%{$query}%");
                })
                ->orWhereHas('user', function ($userQuery) use ($query) {
                    $userQuery->where('name', 'like', "%{$query}%");
                });
        });
    })
    ->latest()
    ->get();

    return response()->json($portfolios);
}

    public function adminEdit($id)
    {
        $portfolio = Portfolio::with(['skills', 'projects', 'images', 'user'])
            ->findOrFail($id);

        $adminMode = true;
        return view('edit-portfolio', compact('portfolio', 'adminMode'));
    }

    public function adminUpdate(Request $request, $id)
    {
        $portfolio = Portfolio::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $portfolio->title = $request->name;
        $portfolio->description = $request->description;
        $portfolio->save();

        $skills = [];
        if ($request->skills) {
            foreach (explode(',', $request->skills) as $skillName) {
                $skill = Skill::firstOrCreate(['name' => trim($skillName)]);
                $skills[] = $skill->id;
            }
        }
        $portfolio->skills()->sync($skills);

        $portfolio->projects()->delete();
        if ($request->projects) {
            foreach ($request->projects as $project) {
                if (!empty(trim($project['title'] ?? ''))) {
                    Project::create([
                        'portfolio_id' => $portfolio->id,
                        'title' => $project['title'],
                        'description' => $project['description'] ?? '',
                    ]);
                }
            }
        }

        if ($request->filled('delete_images')) {
            Image::whereIn('id', $request->delete_images)->delete();
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                if (!$file || !$file->isValid()) continue;
                $path = $file->store('images', 'public');
                Image::create([
                    'portfolio_id' => $portfolio->id,
                    'image_url' => $path,
                ]);
            }
        }

        return redirect('/home');
    }

}
