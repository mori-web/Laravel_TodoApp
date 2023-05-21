<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{

  /*------------------------------------------------------------
  新規投稿
  ------------------------------------------------------------*/
  // 新規投稿の表示
  public function create()
  {
    return view('posts.create');
  }

  //新規投稿の保存
  public function store(Request $request)
  {
    $validated = $request->validate([
      'title' => 'required|max:20',
      'body' => 'required|max:400',
    ]);
    // dd($request);
    // DBへ新規投稿を保存(Postモデルクラスのインスタンスを作成($post=DBのレコード))
    $post = Post::create($validated);
    return back(); // return back();は「元のページへ戻る指定」
  }

  /*------------------------------------------------------------
  一覧画面
  ------------------------------------------------------------*/
  // 一覧画面
  public function index()
  {
    $posts = Post::all();
    // // dd($posts);
    return view('posts.index', compact('posts'));
  }







}
