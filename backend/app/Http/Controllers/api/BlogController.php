<?php

namespace App\Http\Controllers\api;

use App\Const\Blog as ConstBlog;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Requests\BlogRequest;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->get();
        return response()->json(['status' => 200, 'blogs' => $blogs], 200);
    }

    public function draftIndex()
    {
        $blogs = Blog::where('status', ConstBlog::DRAFT)->latest()->get();
        return response()->json(['status' => 200, 'blogs' => $blogs], 200);
    }

    public function store(BlogRequest $request)
    {
        $blog = $request->all();
        $blog['user_id'] = auth('sanctum')->user()->id;

        $result = Blog::create($blog);

        if($result) {
            return response()->json(['status' => 200, 'message' => ['success' => 'ブログを保存しました']], 200);
        }
        return response()->json(['status' => 500, 'message' => ['error' => 'ブログを作成できませんでした']], 500);
    }

    public function show($id)
    {
        $blog = Blog::find($id);
        return response()->json(['status' => 200, 'blog' => $blog], 200);
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        $planeBlog = $blog->getAttributes();
        return response()->json(['status' => 200, 'blog' => $planeBlog], 200);
    }

    public function update(Request $request, $id)
    {
        $editedBlog = $request->all();
        $blog = Blog::find($id);
        $blog->fill($editedBlog)->save();
        return response()->json(['status' => 200, 'message' => ['success' => "{$blog->title}をアップデートしました"]], 200);
    }

    public function delete($id)
    {
        $blog = Blog::find($id);
        $blog->delete();
        return response()->json(['status' => 200, 'message' => ['success' => 'ブログを削除しました']], 200);
    }
}
