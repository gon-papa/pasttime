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

    public function guestIndex(Request $request)
    {
        $limit = $request->limit;

        $blogs = BLog::select('id', 'title', 'body', 'thummbnail', 'created_at', 'updated_at')
            ->where('status', ConstBlog::VISIBLE)
            ->latest()
            ->paginate($limit);

        foreach ($blogs as $blog) {
            $body = strip_tags($blog->body);
            $wordCount = 200;
            if(mb_strlen($body) > $wordCount) { 
                $bodyCut = mb_substr($body, 0, $wordCount);
                $blog->body = $bodyCut . '･･･' ;
            }
        }

        return response()->json(['status' => 200, 'blogs' => $blogs], 200);
    }

    public function countVisibleTotalBlog()
    {
        $total = Blog::where('status', ConstBlog::VISIBLE)->count();

        return response()->json(['status' => 200, 'total' => $total], 200);
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

    public function guestShow($id)
    {
        $blog = Blog::where(['id' => $id, 'status' => ConstBlog::VISIBLE])->first();
        $planeBlog = $blog->getAttributes();
        $planeBlog['created_at'] = $blog['created_at'];
        $planeBlog['updated_at'] = $blog['updated_at'];

        if(!$blog) {
            return response()->json(['status' => 404, 'message' => ['error' => 'ブログが見つかりません'], 404]);
        }

        return response()->json(['status' => 200, 'blog' => $planeBlog], 200);
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