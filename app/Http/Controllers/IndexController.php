<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {

       
        $site_settings = [
            'title' => setting('site.title'),
            'description' => setting('site.description')
        ];

        return view('home', [
            'site_settings' => $site_settings,
            
        ]);
    }
    public function __invoke()
    {
        //obtient les messages qui sont publiés, triés par odre décroissant
        $posts = Post::query()->where('is_published', true)
            ->orderBy('id', 'desc')
            ->paginate(1);

        //obtenir les articles vedettes

        $featured_posts = Post::query()
            ->where('is_published', true)
            ->where('is_featured', true)
            ->orderBy('id', 'desc')
            ->take(5)
            ->get();

        //obtient toutes les catégories
        $categories = Category::all();

        //obtient tous les tags
        $tags = Tag::all();

        //obtient les 5 derniers articles
        $recent_posts = Post::query()
            ->where('is_published', true)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();


        //assigner les variables à la vue correspondantes
        return view('home', [
            'posts' => $posts,
            'featured_posts' => $featured_posts,
            'categories' => $categories,
            'tags' => $tags,
            'recent_posts' => $recent_posts,

        ]);
    }
    
}
