@extends('layouts.app')
@section('content')
<div class="container ops-main">
    <div class="row">
        <div class="col-md-6 mb-3">
            <h2>コミュニティ詳細</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-md-offset-1">
        <div class="form-group row">
            <div class="col-md-3">
                @if (!empty($community->image))
	                <img id="preview" src="{{ asset('storage/' . $community['image']) }}" style="width: 100px; height: 100px;">
                @else
                    <img id="preview" src="{{ asset('/storage/' . 'profile_image.png') }}" style="width: 100px; height: 100px;">
                @endif
            </div>
            <div class="col-md-9">
                @if ($like)
                  <!-- いいね取り消しフォーム -->
                    {{ Form::model($community, array('action' => array([App\Http\Controllers\LikesController::class, 'destroy'], $community->id, $like->id))) }}
                        <button type="submit" class="btn btn-xs btn-danger">
                        - コミュニティ解除 {{ $community->likes_count }}
                        </button>
                    {!! Form::close() !!}
                @else
                <!-- いいねフォーム -->
                    {{ Form::model($community, array('action' => array([App\Http\Controllers\LikesController::class, 'store'],$community->id))) }}
                        <button type="submit" class="btn btn-xs btn-primary">
                        + コミュニティ登録 {{ $community->likes_count }}
                        </button>
                    {!! Form::close() !!}
                @endif
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3">
                <label for="community_name">コミュニティ名</label>
            </div>
            <div class="col-md-9">
                {{ $community->community_name }}
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3">
                <label for="community_name">地域</label>
            </div>
            <div class="col-md-9">
                {{$area_id_loop->get($community->area_id)}}
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3">
                <label for="community_name">カテゴリ</label>
            </div>
            <div class="col-md-9">
                {{ $category_id_loop->get($community->category_id) }}
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3">
                <label for="community_name">内容</label>
            </div>
            <div class="col-md-9">
                {{ $community->content }}
            </div>
        </div>
                <a href="/community/index">戻る</a>
        </div>
    </div>
</div>
@endsection


