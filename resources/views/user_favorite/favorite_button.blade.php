@if (Auth::id() != $user->id)
    @if (Auth::user()->is_favorite($user->id))
        {{-- いいね外すボタンのフォーム --}}
        <form method="POST" action="{{ route('user.unfollow', $user->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-outline btn-block normal-case" 
                onclick="return confirm('id = {{ $user->id }} のいいねを外します。よろしいですか？')">Unfavorite</button>
        </form>
    @else
        {{-- いいねボタンのフォーム --}}
        <form method="POST" action="{{ route('user.follow', $user->id) }}">
            @csrf
            <button type="submit" class="btn btn-secondary btn-block normal-case">favorite</button>
        </form>
    @endif
@endif