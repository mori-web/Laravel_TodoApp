<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

  /**
   * Display a listing of the resource.
   */
  public function index()
  {

    // $posts = Post::query();
    // $posts->orderBy('created_at', 'desc'); //並び順を逆
    // $posts = $posts->paginate(10); //ページネーションの作成
    $posts = Post::orderBy('created_at', 'asc')->paginate(10);
    // dd($posts);
    var_dump($posts);
    return view('post.index', compact('posts'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('post.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    // Gate::authorize('test');
    $validated = $request->validate([
      'title' => 'required|max:20',
      'body' => 'required|max:400',
      'image' => 'image|max:2048', //画像サイズを2048KBまでに制限
    ]);

    $validated['user_id'] = auth()->id(); //ログインしているユーザーのidをuser_idに追加する

    //もしリクエストに画像ファイルがある場合には、
    if ($request->hasFile('image')) {
      dd($request);
      // $image = $request->file('image');
      // $path = $image->store('images', 'public'); // ディレクトリ名を 'image' から 'images' に修正
      // $validated['image_path'] = $path;
    }

    $post = Post::create($validated,);

    $request->session()->flash('message', '保存しました');
    return redirect()->route('post.index'); // return back();は「元のページへ戻る指定」
  }

  /**
   * Display the specified resource.
   */
  public function show(Post $post)
  {
    return view('post.show', compact('post'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Post $post)
  {
    return view('post.edit', compact('post'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Post $post)
  {
    $validated = $request->validate([
      'title' => 'required|max:20',
      'body' => 'required|max:400',
    ]);
    $validated['user_id'] = auth()->id(); //ログインしているユーザーのidをuser_idに追加する
    $post->update($validated);
    $request->session()->flash('message', '更新しました');
    return redirect()->route('post.show', $post);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Request $request, Post $post)
  {
    $post->delete();
    $request->session()->flash('message', '削除しました');
    return redirect()->route('post.index');
  }
}
