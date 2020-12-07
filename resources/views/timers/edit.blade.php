@extends('layouts.app')

@section('content')
    <div class="container py-sm-4">
        <div class="row justify-content-center">
            <div class="col-lg-9 p-0">
                <details class="card">
                    <summary class="card-header">My Timer</summary>
                    <div class="card-body">
                        <li>５個まで設定を保存できます</li>
                        <li><i class="fa fa-play-circle text-primary fa-lg fa-hover" aria-hidden="true"></i> タイマー画面へ移動</li>
                        <li><i class="fa fa-pencil text-success fa-lg fa-hover" aria-hidden="true"></i> 編集→下のフォームで更新して下さい</li>
                        <li><i class="fa fa-trash-o fa-lg fa-hover" aria-hidden="true"></i> My Timerから削除します</li>
                    </div>
                </details>
                <div class="card">
                    <div class="card-body p-3">
                       <div class="table-responsive">
                        <table class="row table table-borderless table-sm text-nowrap mb-0 mx-0">
                            <thead class="px-0 m-auto">
                              @foreach ($timers as $timer)
                                <tr class="row border-bottom">
                                    <td class="col-1 d-none d-sm-block"></td>
                                    <td class="col-2"><a href="{{ route('timers.show', $timer->id) }}" class="btn btn-light bg-white border-0"><i class="fa fa-play-circle text-primary fa-lg fa-hover" aria-hidden="true"></i></a></td>
                                    @if(($timer->icon_id) === 1)
                                    <td class="col-1"><i class="fa fa-square fa-lg my-icon" aria-hidden="true" style="color:{{ $timer->color }}"></i></td>
                                    @elseif(($timer->icon_id) === 2)
                                    <td class="col-1"><i class="fa fa-heart fa-lg my-icon" aria-hidden="true" style="color:{{ $timer->color }}"></i></td>
                                    @elseif(($timer->icon_id) === 3)
                                    <td class="col-1"><i class="fa fa-tint fa-lg ml-1 my-icon" aria-hidden="true" style="color:{{ $timer->color }}"></i></td>
                                    @else(($timer->icon_id) === 4)
                                    <td class="col-1"><i class="fa fa-star fa-lg my-icon" aria-hidden="true" style="color:{{ $timer->color }}"></i></td>
                                    @endif
                                    <td class="col-3"><p class="text-truncate my-title mb-0 pb-2">{{ $timer->title }}</p>
                                    <td class="col-3">
                                        <span class="my-min d-inline-block mx-2">{{ $timer->min }} 分</span>
                                        <a href="{{ route('timers.edit', $timer->id) }}" class="btn btn-light bg-white border-0"><i class="fa fa-pencil text-success fa-lg fa-hover" aria-hidden="true"></i></a>
                                        <form action="{{ route('timers.delete', $timer->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button class="btn btn-light bg-white border-0" onclick='return confirm("削除しますか?");'><i class="fa fa-trash-o fa-lg fa-hover" aria-hidden="true"></i></button>
                                        </form>
                                    </td>
                                </tr>
                              @endforeach
                            </thead>
                        </table>
                        </div>
                    </div>
                </div>
                <details class="card">
                    <summary class="card-header">タイマーの使い方</summary>
                    <div class="card-body">
                        <h6 class="card-title font-weight-bold">設定画面</h6>
                        <li>時間（１〜６０分）形・モード・色を選んで下さい。画像はなしでもOKです。</li>
                        <h6 class="card-title mt-3 font-weight-bold">タイマー画面</h6>
                        <li>×で時間とボタンを非表示にできます。</li>
                        <li>アラーム音(18秒間)を鳴らしたくない時は アラームOFF にして下さい。</li>
                        <li>時間になる前は ON / OFF の切り替え可能です。</li>
                        <li>音をすぐ止めるにはアラームボタンかリセットを押して下さい。</li>
                        <li>リセットで最初の状態に戻ります。</li>
                    </div>
                </details>
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('timers.unregistered') }}" enctype="multipart/form-data" class="form">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                   <input type="hidden" name="id" value="{{ $edit->id }}">
                                    <div class="form-group row">
                                        <label for="title" class="col-sm-4 col-3 pr-0 col-form-label">タイトル</label>
                                        <div class="col-sm-8 col-9 pl-0">
                                            <input type="text" id="title" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $edit->title }}" autofocus placeholder="必須ではありません">
                                            @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="min" class="col-sm-4 col-3 pr-0 col-form-label">時間</label>
                                        <div class="col-sm-8 col-9 pl-0">
                                            <input type="text" id="min" class="form-control @error('min') is-invalid @enderror" name="min" value="{{ $edit->min }}" autofocus placeholder="1〜60の半角数字">
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
                                            <input type="radio" id="icon_id" class="@error('icon_id') is-invalid @enderror" name="icon_id" value="1" @if ($edit->icon_id === 1) checked="checked" @endif><i class="fa fa-square fa-lg mx-2" aria-hidden="true"></i>
                                            <input type="radio" id="icon_id" class="@error('icon_id') is-invalid @enderror" name="icon_id" value="2" @if ($edit->icon_id === 2) checked="checked" @endif><i class="fa fa-heart fa-lg mx-2" aria-hidden="true"></i>
                                            <input type="radio" id="icon_id" class="@error('icon_id') is-invalid @enderror" name="icon_id" value="3" @if ($edit->icon_id === 3) checked="checked" @endif><i class="fa fa-tint fa-lg mx-2" aria-hidden="true"></i>
                                            <input type="radio" id="icon_id" class="@error('icon_id') is-invalid @enderror" name="icon_id" value="4" @if ($edit->icon_id === 4) checked="checked" @endif><i class="fa fa-star fa-lg mx-2" aria-hidden="true"></i>
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
                                            <input type="radio" id="mode_id" class="@error('mode_id') is-invalid @enderror mr-2" name="mode_id" value="1" @if ($edit->mode_id === 1) checked="checked" @endif>ノーマル
                                            <input type="radio" id="mode_id" class="@error('mode_id') is-invalid @enderror mx-2" name="mode_id" value="2" @if ($edit->mode_id === 2) checked="checked" @endif>ダーク
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
                                            <input id="color" type="color" name="color" class="@error('color') is-invalid @enderror w-50 h-100" value="{{ $edit->color }}">
                                            @error('color')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div id="app" class="col-md-6">
                                    <edit-image-component edit_picture="{{ $edit->picture }}" error_picture="{{ $errors->first('picture') }}"></edit-image-component>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-sm-3 pr-1">
                                    <button type="submit" formaction="{{ route('timers.reset') }}" class="btn btn-outline-dark w-100">{{ __('Cancel') }}</button>
                                </div>
                                <div class="col-6 col-sm-3 pl-1">
                                    <button type="submit" formaction="{{ route('timers.update', $edit->id) }}" class="btn btn-success w-100">{{ __('Update') }}</button>
                                </div>
                                <div class="col-12 col-sm-6 pt-3 pt-sm-0">
                                    <input type="submit" class="btn btn-primary w-100" value="タイマー画面へ">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
