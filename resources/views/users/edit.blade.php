@extends('layouts.app')

@section('content')

    <div class="prose ml-4">
        <h2 class="text-lg">id: {{ $user->id }} のユーザー編集ページ</h2>
    </div>

    <div class="flex justify-center">
        <form method="POST" action="{{ route('users.update', $user->id) }}" class="w-1/2">
            @csrf
            @method('PUT')

                <div class="form-control my-4">
                    <label for="name" class="label">
                        <span class="label-text">ユーザー名:</span>
                    </label>
                    <input type="text" name="name" value="{{ $user->name }}" class="input input-bordered w-full">
                </div>
                
                <div class="form-control my-4">
                    <label for="name" class="label">
                        <span class="label-text">メールアドレス:</span>
                    </label>
                    <input type="text" name="email" value="{{ $user->email }}" class="input input-bordered w-full">
                </div>

            <button type="submit" class="btn btn-primary btn-outline">更新</button>
        </form>
    </div>

@endsection