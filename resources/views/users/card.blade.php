<div class="card border border-base-300">
    <div class="card-body bg-base-200 text-4xl">
        <h2 class="card-title">Name：{{ $user->name }}</h2>
        <h2 class="card-title">Email：{{ $user->email }}</h2>
    </div>
    <figure>
        {{-- ユーザーのメールアドレスをもとにGravatarを取得して表示 --}}
        <img src="{{ Gravatar::get($user->email, ['size' => 500]) }}" alt="">
    </figure>
    @if (Auth::id() == $user->id)
        <a class="btn btn-outline btn-sm normal-case" href="{{ route('users.edit', $user->id) }}">
            ユーザー編集ページ
        </a>
    @endif
</div>
{{-- フォロー／アンフォローボタン --}}
@include('user_follow.follow_button')