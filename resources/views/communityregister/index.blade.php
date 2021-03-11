@extends('layouts.app')

@section('content')
<div class="container ops-main">
    <div class="row">
        <div class="col-md-12">
            <h3 class="ops-title">コミュニティ作成</h3>
            <a href="/communityregister/create" class="btn btn-default">
                <button class="btn btn-xs btn-primary"> {{ __('コミュニティ作成') }}</button>
            </a>
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
                    <th class="text-center">削除</th>
                </tr>
                @foreach($communities as $community)
                <tr>
                    <td>
                        <a href="/communityregister/{{$community->id}}/edit">{{ $community->id }}</a>
                    </td>
                    <td><img src="{{ asset('storage/' . $community['image']) }}" style="width: 50px; height: 50px;">
                    </td>
                    <td>{{ $community->community_name }}</td>
                    <td>{{ $community->category }}</td>
                    <td>{{ $community->area }}</td>
                    <td>{{ $community->content }}</td>
                    <td>
                        <form action="/communityregister/{{ $community->id }}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="btn btn-xs btn-danger" aria-label="Left Align">削除</button>
                        </form>
                    </td>
                </tr>
                @endforeach

            </table>

        </div>
        <div class="col-md-3 col-md-offset-1">
            <a href="/community/index" class="btn btn-default">
                <button class="btn btn-xs btn-primary"> {{ __('コミュニティ一覧画面') }}</button>
            </a>
        </div>
    </div>
    @endsection