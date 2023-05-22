<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{

  /*------------------------------------------------------------
  新規投稿
  ------------------------------------------------------------*/
  // 新規投稿の表示
  public function create()
  {
    return view('post.create');
  }

  //新規投稿の保存
  public function store(Request $request)
  {
    // Gate::authorize('test');
    $validated = $request->validate([
      'title' => 'required|max:20',
      'body' => 'required|max:400',
    ]);
    // dd($request);
    $validated['user_id'] = auth()->id(); //ログインしているユーザーのidをuser_idに追加する
    $request->session()->flash('message', '保存しました');
    $post = Post::create($validated);
    return back(); // return back();は「元のページへ戻る指定」
  }

  /*------------------------------------------------------------
  一覧画面
  ------------------------------------------------------------*/
  // 一覧画面
  public function index()
  {
    // $posts = Post::all();
    $posts = Post::with('user')->get();
    // dd($posts);
    return view('post.index', compact('posts'));
  }
  //個別一覧画面
  public function show(Post $post) {
    // dd($post);
    return view('post.show', compact('post'));
  }


  /*------------------------------------------------------------
  編集
  ------------------------------------------------------------*/
  //編集画面の表示
  public function edit(Post $post)
  {
    // dd($post);
    return view('post.edit', compact('post'));
  }
  //編集のアップデートの処理
  public function update(Request $request, Post $post)
  {
    $validated = $request->validate([
      'title' => 'required|max:20',
      'body' => 'required|max:400',
    ]);
    // dd($request);
    $validated['user_id'] = auth()->id(); //ログインしているユーザーのidをuser_idに追加する

    $post->update($validated);

    $request->session()->flash('message', '更新しました');
    return back();
  }

  /*------------------------------------------------------------
  削除
  ------------------------------------------------------------*/
  public function destroy(Request $request,Post $post)
  {
    $post->delete();
    $request->session()->flash('message', '削除しました');
    return redirect()->route('post.index');
  }



}
