<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Requests\BlogRequest;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->get();
        return response()->json(['status' => 200, 'blogs' => $blogs], 200);
    }

    public function store(BlogRequest $request)
    {
        $blog = $request->all();
        $blog['user_id'] = auth('sanctum')->user()->id;

        $result = Blog::create($blog);

        if($result) {
            return response()->json(['status' => 200, 'message' => ['success' => 'ブログを保存しました'], 200]);
        }
        return response()->json(['status' => 500, 'message' => ['error' => 'ブログを作成できませんでした'], 500]);
    }
}
