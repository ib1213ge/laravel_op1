@extends('layouts.app')

@section('content')
    <div class="container pt-sm-4">
        <div class="row justify-content-center">
            <div class="col-lg-9 p-0">
                <details class="card">
                    <summary class="card-header">カラフルタイマーについて</summary>
                    <div class="card-body">
                        <li>好きな色や画像で自分だけのタイマーに</li>
                        <li>上の色が下に全部落ちたらタイマー終了</li>
                        <li>アラームOFF設定で静かな場所でも安心</li>
                        <li>会員登録すると５個まで設定を保存できます</li>
                    </div>
                </details>
                <details class="card">
                    <summary class="card-header">タイマーの使い方</summary>
                    <div class="card-body">
                        <h6 class="card-title font-weight-bold">設定画面</h6>
                        <li>時間（１〜６０分）形・モード・色を選んで下さい。画像はなしでもOKです。</li>
                        <h6 class="card-title mt-3 font-weight-bold">タイマー画面</h6>
                        <li><i class="fa fa-times" aria-hidden="true"></i>で時間とボタンを非表示にできます。</li>
                        <li>アラーム音(18秒間)を鳴らしたくない時は アラームOFF にして下さい。</li>
                        <li>時間になる前は ON / OFF の切り替え可能です。</li>
                        <li>音をすぐ止めるにはアラームボタンかリセットを押して下さい。</li>
                        <li>リセットで最初の状態に戻ります。</li>
                    </div>
                </details>
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('timers.unregistered') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="min" class="col-sm-4 col-3 pr-0 col-form-label">時間</label>
                                        <div class="col-sm-8 col-9 pl-0">
                                            <input type="text" id="min" class="form-control @error('min') is-invalid @enderror" name="min" value="{{ old('min') }}" autofocus placeholder="1〜60の半角数字">
                                            @error('min')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="icon_id" class="col-sm-4 col-3 col-form-label">形</label>
                                        <div class="col-sm-8 col-9 mt-2 px-0">
                                            <input type="radio" id="icon_id" class="@error('icon_id') is-invalid @enderror" name="icon_id" value="1" @if( old('icon_id') === '1') checked="checked" @endif><i class="fa fa-square fa-lg mx-2" aria-hidden="true"></i>
                                            <input type="radio" id="icon_id" class="@error('icon_id') is-invalid @enderror" name="icon_id" value="2" @if( old('icon_id') === '2') checked="checked" @endif><i class="fa fa-heart fa-lg mx-2" aria-hidden="true"></i>
                                            <input type="radio" id="icon_id" class="@error('icon_id') is-invalid @enderror" name="icon_id" value="3" @if( old('icon_id') === '3') checked="checked" @endif><i class="fa fa-tint fa-lg mx-2" aria-hidden="true"></i>
                                            <input type="radio" id="icon_id" class="@error('icon_id') is-invalid @enderror" name="icon_id" value="4" @if( old('icon_id') === '4') checked="checked" @endif><i class="fa fa-star fa-lg mx-2" aria-hidden="true"></i>
                                            @error('icon_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="mode_id" class="col-sm-4 col-3 pr-0 col-form-label">モード</label>
                                        <div class="col-sm-8 col-9 mt-2 px-0">
                                            <input type="radio" id="mode_id" class="@error('mode_id') is-invalid @enderror mr-2" name="mode_id" value="1" @if( old('mode_id') === '1') checked="checked" @endif>ノーマル
                                            <input type="radio" id="mode_id" class="@error('mode_id') is-invalid @enderror mx-2" name="mode_id" value="2" @if( old('mode_id') === '2') checked="checked" @endif>ダーク
                                            @error('mode_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="color" class="col-sm-4 col-3 col-form-label">色</label>
                                        <div class="col-sm-8 col-9 px-0">
                                            <input id="color" type="color" name="color" class="@error('color') is-invalid @enderror w-50 h-100" value="{{ old('color', '#00ffff') }}">
                                            @error('color')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div id="app" class="col-md-6">
                                    <index-image-component error_picture="{{ $errors->first('picture') }}"></index-image-component>
                                    <input type="submit" class="btn btn-primary mt-1 w-100" value="タイマー画面へ">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection