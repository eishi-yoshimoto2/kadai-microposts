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
                                                    onclick="return confirm('id = {{ $micropost->id }} のいいねを外します。よろしいですか？')">いいねを外す</button>
                                            </form>
                                        @else
                                            {{-- いいねボタンのフォーム --}}
                                            <form method="POST" action="{{ route('user.favorite', $micropost->id) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-secondary btn-sm normal-case">いいね</button>
                                            </form>
                                        @endif
                                        @if (Auth::id() == $micropost->user_id)
                                        {{-- 投稿削除ボタンのフォーム --}}
                                        <form method="POST" action="{{ route('microposts.destroy', $micropost->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-error btn-sm normal-case" 
                                                onclick="return confirm('Delete id = {{ $micropost->id }} ?')">Delete</button>
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