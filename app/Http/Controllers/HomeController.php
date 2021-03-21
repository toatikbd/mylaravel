<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\faq;
use App\Package;
use App\Post;
use App\Plan;
use App\Slider;
use App\Review;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::all();
        $posts = Post::latest()->approved()->published()->take(6)->get();
        $sliders = Slider::latest()->published()->get();
        $brands = Brand::latest()->published()->get();
        $reviews = Review::latest()->published()->get();
        $faqs = faq::latest()->published()->take(3)->get();
        $plans = Plan::latest()->published()->take(6)->get();
        $packages = Package::latest()->published()->take(4)->get();
        return view('welcome', compact('categories', 'posts', 'sliders', 'brands', 'reviews', 'faqs', 'plans', 'packages'));
    }
}
