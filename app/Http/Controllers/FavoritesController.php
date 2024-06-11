<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    /**
     * 投稿をいいねするアクション。
     *
     * @param  $micropostid  投稿ユーザーのid
     * @return \Illuminate\Http\Response
     */
    public function store(string $micropostId)
    {
        // 認証済みユーザー（閲覧者）が、 micropostIdの投稿をいいねする
        \Auth::user()->favorite(intval($micropostId));
        // 前のURLへリダイレクトさせる
        return back();
    }

    /**
     * 投稿のいいねを外すアクション。
     *
     * @param  $micropostid  投稿のid
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $micropostId)
    {
        // 認証済みユーザー（閲覧者）が、 micropostIdの投稿のいいねを外す
        \Auth::user()->unfavorite(intval($micropostId));
        // 前のURLへリダイレクトさせる
        return back();
    }
}
