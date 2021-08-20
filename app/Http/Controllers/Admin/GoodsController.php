<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\News;
use App\History;
use Carbon\Carbon;


class GoodsController extends Controller
{
    public function add()
    {
        return view('admin.goods.create');
    }
    public function create(Request $request)
  {
      $this->validate($request,Goods::$rules);
      $goods = new Goods;
      $form = $request->all();
       if (isset($form['image'])) {
        $path = $request->file('image')->store('public/image');
        $goods->image_path = basename($path);
      } else {
          $goods->image_path = null;
      }
      unset($form['_token']);
      unset($form['image']);
      $goods->fill($form);
      $goods->save();
      return redirect('admin/goods/create');
  }  
  public function index(Request $request)
  {
      $cond_title = $request->cond_title;
      if ($cond_title != '') {
          // 検索されたら検索結果を取得する
          $posts = Goods::where('title', $cond_title)->get();
      } else {
          // それ以外はすべてのニュースを取得する
          $posts = Goods::all();
      }
      return view('admin.goods.index', ['posts' => $posts, 'cond_title' => $cond_title]);
  }
  public function edit(Request $request)
  {
      // News Modelからデータを取得する
      $goods = Goods::find($request->id);
      if (empty($goods)) {
        abort(404);    
      }
      return view('admin.goods.edit', ['goods_form' => $goods]);
  }

public function update(Request $request)
  {
      // Validationをかける
      $this->validate($request, Goods::$rules);
      // News Modelからデータを取得する
      $goods = Goods::find($request->id);
      // 送信されてきたフォームデータを格納する
      $goods_form = $request->all();
      if ($request->remove == 'true') {
          $goods_form['image_path'] = null;
      } elseif ($request->file('image')) {
          $path = $request->file('image')->store('public/image');
          $goods_form['image_path'] = basename($path);
      } else {
          $goods_form['image_path'] = $goods->image_path;
      }

      unset($goods_form['image']);
      unset($goods_form['remove']);
      unset($goods_form['_token']);
      // 該当するデータを上書きして保存する
      $goods_form->fill($goods_form)->save();
      
     

      return redirect('admin/goods');
  }
  
   public function delete(Request $request)
  {
      // 該当するNews Modelを取得
      $goods = Goods::find($request->id);
      // 削除する
      $goods->delete();
      return redirect('admin/goods/');
  }  
 
}
