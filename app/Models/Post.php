<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  use HasFactory;

  // $fillable（ユーザーが入力できる範囲を指定※セキュリティ面）
  protected $fillable = [
    'title',
    'body',
    'user_id',
    'image',
  ];

  public function user()
    {
      //このコードは「1対多」の関係を表しています。つまり、現在のモデルが「所属している」ユーザー（User モデル）を示しています。belongsTo() メソッドは、関連するモデルとの「親子関係」を定義します。このメソッドにより、現在のモデルが User モデルに所属していることが示されます。
      return $this->belongsTo(User::class);
    }
}
