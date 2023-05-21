<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
  public function create()
  {
    return view('posts.create');
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'title' => 'required|max:20',
      'body' => 'required|max:400',
    ]);
    // dd($request);
    // DBへ新規投稿を保存(Postモデルクラスのインスタンスを作成($post=DBのレコード))
    $post = Post::create($validated);
    return back();// return back();は「元のページへ戻る指定」
  }

}
