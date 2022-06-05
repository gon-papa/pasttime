<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UploaderRequest;

class ImageController extends Controller
{

    public function index(Request $request)
    {
        $allPath = collect(Storage::files('public/images/'));
        $allUrl = $allPath->map(function($path, $key) {
            return $this->checkEnv($path);
        });

        return response()->json(['allUrl' => $allUrl]);
    }

    public function store(UploaderRequest $request)
    {
        $image = $request->file('image');
        $path = $image->store('public/images');

        if($path) {
            $url = $this->checkEnv($path);
            return response()->json(['status'=> 200, 'url' => $url, 'message' => ['success' => '画像をアップロードしました']]);
        }

        return response()->json(['status' => 400, 'message' => ['error' => '画像を処理できませんでした']]);
    }

    public function destroy(Request $request)
    {
        $url = $request->url;
        $path = str_replace(config('app.url') . '/storage/images/', '', $url);
        $result = Storage::delete('public/images/' . $path);

        if($result) {
            return response()->json(['status'=> 200, 'success' => '画像を削除しました']);
        }

        return response()->json(['status' => 400, 'message' => ['error' => '画像を削除できませんでした']]);
    }

    public function checkEnv($path)
    {
        if (config('APP_ENV') === 'production') {
            return Storage::url($path);
        }
        return config('app.url') . Storage::url($path);
    }
}
