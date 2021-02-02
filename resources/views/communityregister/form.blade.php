@extends('layouts.app')
@section('content')
<div class="container ops-main">
    <div class="row">
        <div class="col-md-6">
            <h2>コミュニティ登録</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-1">
            @if($target == 'store')
                <form action="/communityregister" method="post" enctype='multipart/form-data'>
                @elseif($target == 'update')
                <form action="/communityregister/{{ $community->id }}" method="post" enctype='multipart/form-data'>
                <input type="hidden" name="_method" value="PUT">
            @endif
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="community_name">コミュニティ名</label>
                    <input type="text" class="form-control" name="community_name" value="{{ $community->community_name }}">
                </div>
                <div class="form-group">
                    <label for="area_id">地域</label>
                    <!--<input type="select" class="form-control" name="category_id" value="{{ $community->category_id }}">-->
                    @if($target == 'store')
                        {{Form::select('area_id', $area_id_loop, null, ['class' => 'form-control', 'placeholder' => '選択してください','value'=>'$community->area_id'])}}
                    @elseif($target == 'update')
                    {{Form::select('area_id', $area_id_loop, $community->area_id, ['class' => 'form-control', 'value'=>'$community->area_id'])}}
                    @endif
                </div>
                <div class="form-group">
                    <label for="category_id">カテゴリ</label>
                    <!--<input type="select" class="form-control" name="category_id" value="{{ $community->category_id }}">-->
                    @if($target == 'store')
                        {{Form::select('category_id', $category_id_loop, null, ['class' => 'form-control', 'placeholder' => '選択してください','value'=>'$community->category_id'])}}
                    @elseif($target == 'update')
                    {{Form::select('category_id', $category_id_loop, $community->category_id, ['class' => 'form-control', 'value'=>'$community->category_id'])}}
                    @endif
                </div>
                <div class="form-group">
                    <label for="image">画像</label>
                 <!-- アップロードした画像。なければ表示しない -->
	            <div>
                @if (!empty($community->image))
	                <img id="preview" src="{{ asset('storage/' . $community['image']) }}" style="width: 50px; height: 50px;">
                @else
                    <img id="preview" src="{{ asset('/storage/' . 'profile_image.png') }}" style="width: 50px; height: 50px;">
                @endif
	            </div>
                    <input type="file" name="image" id="imageUpload" accept='image/*' value="{{ $community->image }}">
                </div>
                <div class="form-group">
                    <label for="content">内容</label>
                    <input type="text" class="form-control" name="content" value="{{ $community->content }}">
                </div>
                <button type="submit" class="btn btn-default">登録</button>
                <a href="/communityregister/index">戻る</a>
                
            </form>
        </div>
    </div>
</div>
@endsection


