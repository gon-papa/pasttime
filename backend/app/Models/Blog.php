<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'body',
        'status',
        'thummbnail',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * bodyはstring型のmarkdown形式で保存される
     * アクセサでHTML変換とサニタイズ処理を施す
     * @param string $value
     * @return string
     */
    public function getBodyAttribute($value)
    {
        return Str::markdown($value, [
            'html_input' => 'escape',
        ]);
    }
}
