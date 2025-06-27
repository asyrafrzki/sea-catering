<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'message' => 'required|string|max:255',
            'rating' => 'required|integer|between:1,5',
        ]);

        Testimonial::create($request->only('name', 'message', 'rating'));

        return back()->with('success', 'Thank you for your feedback!');
    }

    public function index()
    {
        $testimonials = Testimonial::latest()->get();
        return view('testimonial.index', compact('testimonials'));
    }
}
