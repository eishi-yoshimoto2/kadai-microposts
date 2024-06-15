@extends('layouts.app')

@section('content')
    <div class="sm:grid sm:grid-cols-3 sm:gap-10">
        <aside class="mt-4">
            {{-- ユーザー情報 --}}
            @include('users.card')
        </aside>
        <div class="sm:col-span-2 mt-4">
            {{-- タブ --}}
            @include('users.navtabs')
            <div class="mt-4">
                {{-- いいね一覧 --}}
                @if (isset($microposts))
                    <ul class="list-none">
                        @foreach ($microposts as $micropost)
                            <li class="flex items-start gap-x-2 mb-4">
                                {{-- 投稿の所有者のメールアドレスをもとにGravatarを取得して表示 --}}
                                <div class="avatar">
                                    <div class="w-12 rounded">
                                        <img src="{{ Gravatar::get($micropost->user->email) }}" alt="" />
                                    </div>
                                </div>
                                <div>
                                    <div>
                                        {{-- 投稿の所有者のユーザー詳細ページへのリンク --}}
                                        <a class="link link-hover text-info" href="{{ route('users.show', $micropost->user->id) }}">{{ $micropost->user->name }}</a>
                                        <span class="text-muted text-gray-500">posted at {{ $micropost->created_at }}</span>
                                    </div>
                                    <div>
                                        {{-- 投稿内容 --}}
                                        <p class="mb-0">{!! nl2br(e($micropost->content)) !!}</p>
                                    </div>
                                    <div>
                                        @if (Auth::id() == $micropost->user_id)

                                        @endif
                                    </div>
                                    <div class='inline-flex'>
                                        @if (Auth::user()->is_favorite($micropost->id))
                                            {{-- いいねを外すボタンのフォーム --}}
                                            <form method="POST" action="{{ route('user.unfavorite', $micropost->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline btn-sm normal-case" 
                                                    onclick="return confirm('id = {{ $micropost->id }} のいいねを外します。よろしいですか？')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                      <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                                    </svg>
                                                </button>
                                            </form>
                                        @else
                                            {{-- いいねボタンのフォーム --}}
                                            <form method="POST" action="{{ route('user.favorite', $micropost->id) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-secondary btn-sm normal-case">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                      <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                                    </svg>
                                                </button>
                                            </form>
                                        @endif
                                        @if (Auth::id() == $micropost->user_id)
                                        {{-- 投稿削除ボタンのフォーム --}}
                                        <form method="POST" action="{{ route('microposts.destroy', $micropost->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-error btn-sm normal-case" 
                                                onclick="return confirm('Delete id = {{ $micropost->id }} ?')">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                  <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    {{-- ページネーションのリンク --}}
                    {{ $microposts->links() }}
                @endif
            </div>
        </div>
    </div>
@endsection