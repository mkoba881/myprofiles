<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// 以下の1行を追記することで、Profiles Modelが扱えるようになる
use App\Models\Profiles;
use App\Models\History;
use Carbon\Carbon;

class ProfilesController extends Controller
{
    //
    public function add()
    {
        return view('admin.profiles.create');
    }
    
    public function create(Request $request)
    {
        // Validationを行う
        $this->validate($request, Profiles::$rules);
        $profiles = new Profiles;
        $form = $request->all();
        
        // フォームから画像が送信されてきたら、保存して、$news->image_path に画像のパスを保存する
        if (isset($form['image'])) {
            $path = $request->file('image')->store('public/image');
            $profiles->image_path = basename($path);
        } else {
            $profiles->image_path = null;
        }

        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        // フォームから送信されてきたimageを削除する
        unset($form['image']);

        // データベースに保存する
        $profiles->fill($form);
        $profiles->save();
        
        // admin/profiles/createにリダイレクトする
        return redirect('admin/profiles/create');
    }
    
    public function index(Request $request)
    {
        $cond_title = $request->cond_title;
        if ($cond_title != '') {
            // 検索されたら検索結果を取得する
            $posts = Profiles::where('profile_name', $cond_title)->get();
        } else {
            // それ以外はすべてのプロフィール名を取得する
            $posts = Profiles::all();
        }
        return view('admin.profiles.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }
    
        public function edit(Request $request)
    {
        // Profiles Modelからデータを取得する
        $profiles = Profiles::find($request->id);
        if (empty($profiles)) {
            abort(404);
        }
        return view('admin.profiles.edit', ['profiles_form' => $profiles]);
    }

    public function update(Request $request)
    {
        // Validationをかける
        $this->validate($request, Profiles::$rules);
        // News Modelからデータを取得する
        $profiles = Profiles::find($request->id);
        // 送信されてきたフォームデータを格納する
        $profiles_form = $request->all();
        
        if ($request->remove == 'true') {
            $profiles_form['image_path'] = null;
        } elseif ($request->file('image')) {
            $path = $request->file('image')->store('public/image');
            $profiles_form['image_path'] = basename($path);
        } else {
            $profiles_form['image_path'] = $profiles->image_path;
        }
        
        unset($profiles_form['image']);
        unset($profiles_form['remove']);
        unset($profiles_form['_token']);

        // 該当するデータを上書きして保存する
        $profiles->fill($profiles_form)->save();

        // 以下を追記
        $history = new History();
        $history->profiles_id = $profiles->id;
        $history->edited_at = Carbon::now();
        $history->save();

        return redirect('admin/profiles');
    }
    
    public function delete(Request $request)
    {
        // 該当するProfiles Modelを取得
        $profiles = Profiles::find($request->id);

        // 削除する
        $profiles->delete();

        return redirect('admin/profiles/');
    }
    
}
