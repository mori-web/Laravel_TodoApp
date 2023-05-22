<x-app-layout>

  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      投稿一覧
    </h2>
  </x-slot>

  <div class="max-w-7xl mx-auto px-6">

    @if (session('message'))
      <div class="text-red-600 font-bold mt-4">
        {{ session('message') }}
      </div>
    @endif

    {{--
    <pre>
      <?php dd($post);?>
    </pre> --}}

    @foreach ($posts as $post)
    <div class="mt-4 p-8 bg-white w-full rounded-2xl">


      <h1 class="p-4 text-lg font-semibold">
        <a href="{{ route('post.show', $post) }}" class="text-blue-600">
          {{ $post->title }}
        </a>
      </h1>
      
      <hr class="w-full">
      <p class="mt-4 p-4">
        {{ $post->body }}
      </p>
      <div class="p-4 text-sm font-semibold">
        <p>
        {{ $post->created_at }} / {{ $post->user->name }}
        </p>
      </div>
    </div>
    @endforeach

    <div class="mb-4 mt-4">
      {{ $posts->links() }}
    </div>

  </div>


</x-app-layout>