@extends('layouts.app')

@section('content')
<div class="container ops-main">
    <div class="row">
        <div class="col-md-12 mb-5">
            <h3 class="ops-title">コミュニティ一覧</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-9 col-md-offset-1">
            <table class="table text-center">
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">画像</th>
                    <th class="text-center">コミュニティ名</th>
                    <th class="text-center">カテゴリ</th>
                    <th class="text-center">地域</th>
                    <th class="text-center">内容</th>
                </tr>
                @foreach($communities as $community)
                <tr>
                    <td>
                        <a href="/community/{{$community->id}}/show">{{ $community->id }}</a>
                    </td>
                    <td><img src="{{ asset('storage/' . $community['image']) }}" style="width: 50px; height: 50px;"></td>
                    <td>{{ $community->community_name }}</td>
                    <td>{{ $community->category }}</td>
                    <td>{{ $community->area }}</td>
                    <td>{{ $community->content }}</td>
                </tr>
                @endforeach
            </table>
        </div>
        <div class="col-md-3 col-md-offset-1">
            <a href="/communityregister/index" class="btn btn-default mb-4">
                <button class="btn btn-xs btn-primary"> {{ __('コミュニティ作成画面') }}</button>
            </a>
            <br><label class='mb-3'>マイコミュニティ</label>
            <table class="table text-center">
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">コミュニティ名</th>
                </tr>
                @foreach($likeCommunities as $like)
                <tr>
                    <td>
                        <a href="/likecommunity/{{$like->id}}/show">{{ $like->id }}</a>
                    </td>
                    <td>{{ $like->community_name }}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
    @endsection