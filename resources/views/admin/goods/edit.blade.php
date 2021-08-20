@extends('layouts.admin')
@section('name', '商品編集')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>商品編集</h2>
                <form action="{{ action('Admin\GoodsController@update') }}" method="post" enctype="multipart/form-data">
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2" for="name">商品名</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="name" value="{{ $goods_form->name }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="body">詳細</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="detail" rows="20">{{ $goods_form->detail }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="price">価格</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="price" value="{{ $goods_form->price }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="imgpath">画像</label>
                        <div class="col-md-10">
                            <input type="file" class="form-control-file" name="imgpath">
                            <div class="form-text text-info">
                                設定中: {{ $goods_form->imgpath }}
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="remove" value="true">画像を削除
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-10">
                            <input type="hidden" name="id" value="{{ $goods_form->id }}">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="更新">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection