<x-app-layout>

  <x-slot name="title">
    About
  </x-slot>

  <h1>このブログについて</h1>
  <p>このブログはLaravelのブログです</p>
  {{ $id }}番目の記事です
  <p>日付：{{ $today }}</p>

</x-app-layout>