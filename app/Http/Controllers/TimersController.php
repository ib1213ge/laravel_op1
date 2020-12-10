<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TimerRequest;
use App\Timer;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TimersController extends Controller
{
    public function index()
    {
        return view('timers.index');
    }

    public function mypage()
    {
        $timers = Auth::user()->timers()->get();
        //dd($timers);
        return view('timers.mypage', compact('timers'));
    }

    public function unregistered(TimerRequest $request)
    {
        $timer = $request->all();

        if($request->picture !== null) {
            $file = $request->file('picture');
            $path = Storage::disk('s3')->putFile('/',$file, 'public');
            //$path = $request->file('picture')->store('public/img');
            $timer['picture'] = Storage::disk('s3')->url($path);
        }elseif($request->edit_flg !== ''){
            $timer['picture'] = $request->edit_flg;
        }else{
            $timer['picture']= '';
        }
        //dd($timer);

        return view('timers.timer', compact('timer'));
    }

    public function show($id)
    {
        if(!ctype_digit($id)){
           return redirect('/mypage')->with('flash_message', __('Invalid operation was performed.'));
        }
        $timer = Timer::find($id);
        //dd($timer);

        return view('timers.timer', compact('timer'));
    }

    public function create(TimerRequest $request)
    {
        $count = Auth::user()->timers()->count();
        // ５個まで登録できる
        if($count < 5) {
            // モデルを使ってDBに登録する値をセット
            $timer = new Timer;
            Auth::user()->timers()->save($timer->fill($request->all()));

            if($request->picture !== null) {
                //$path = $request->file('picture')->store('public/img');
                //$timer->picture = basename($path);
                $file = $request->file('picture');
                $path = Storage::disk('s3')->putFile('/',$file, 'public');
                $timer->picture = $path;
            }

            $timer->user_id = Auth::id();
            $timer->save();
            // リダイレクトする
            return redirect('/mypage')->with('flash_message', __('Registered'));

        }else{
            // 登録せずにリダイレクトする
            return redirect('/mypage')->with('flash_message', __('No More Registered'));
        }
    }

    public function edit($id)
    {
        // GETパラメータが数字がどうかをチェックする
        if(!ctype_digit($id)){
            return redirect('/mypage')->with('flash_message', __('Invalid operation was performed.'));
        }

        $timers = Auth::user()->timers()->get();
        $edit = Auth::user()->timers()->find($id);
        //dd($edit);
        return view('timers.edit', ['timers' => $timers, 'edit' => $edit]);
    }

    public function update(TimerRequest $request, $id)
    {
        // GETパラメータが数字がどうかをチェックする
        if(!ctype_digit($id)){
            return redirect('/timers/{id}/edit')->with('flash_message', __('Invalid operation was performed.'));
        }

        $timer = Timer::find($id);

        if($request->picture !== null) {
            $file = $request->file('picture');
            $path = Storage::disk('s3')->putFile('/',$file, 'public');
            $timer->picture = $path;
            //$path = $request->file('picture')->store('public/img');
            //$timer->picture = basename($path);
        }elseif($request->edit_flg == ''){
            $timer->picture = '';
        }else{
            $timer->picture = $timer->picture;
        }
        //dd($timer->picture);

        $timer->title = $request->title;
        $timer->min = $request->min;
        $timer->icon_id = $request->icon_id;
        $timer->mode_id = $request->mode_id;
        $timer->color = $request->color;
        $timer->save();

        return redirect('/mypage')->with('flash_message', __('Updated'));
    }

    public function destroy($id)
    {
        // GETパラメータが数字がどうかをチェックする
        if(!ctype_digit($id)){
            return redirect('/mypage')->with('flash_message', __('Invalid operation was performed.'));
        }

//        $drill = Drill::find($id)
        $timer = Auth::user()->timers()->find($id);
        $timer->delete();

        // こう書いた方がスマート
//        Drill::find($id)->delete();

        return redirect('/mypage');
    }

    public function clear()
    {
        $timers = Auth::user()->timers()->get();

        return view('timers.mypage', compact('timers'));
    }

}
