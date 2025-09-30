<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Menu;
use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class BlogController extends Controller
{
    public function index(Request $request): View
    {
        $blogs = Blog::query();

        if ($search = $request->search) {
            $blogs->where(fn (Builder $query) => $query
                ->where('title', 'LIKE', '%' . $search . '%')
                ->orWhere('content', 'LIKE', '%' . $search . '%')
            );
        }
        return view('blogs.index', [
            'blogs' => $blogs->latest()->paginate(12),
            'menus' => Menu::all(),

        ]);   
    }

    public function blogsByCategory(Category $category): View
    {
        return view('blogs.index', [
            // 'posts' => $category->posts()->latest()->paginate(10),
            'menus' => Menu::all(),
            'blogs' => Blog::where(
                'category_id', $category->id
            )->latest()->paginate(12),
        ]);
    }

    public function show(Blog $blog): View
    {
        $blogs = Blog::latest()->get(); // Fetch all properties and order them by the latest
        $latestFive = $blogs->take(5); // Take the latest five properties

        return view('blogs.show', [
            'blog' => $blog,
            'blogs' => $blogs,
            'latestFive' => $latestFive,
            'menus' => Menu::all(),

        ]);
    }
}
