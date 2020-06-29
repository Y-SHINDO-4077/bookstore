<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

//2020.05.28
use App\Bookstores; 
use App\BookstoreHistories;
use Carbon\Carbon;  
use App\User;

//2020.06.01 コメントtable
use App\Comments;
use App\Commenthistories;

use Storage;

class ListController extends Controller
{  
    /*新規登録画面へ遷移*/
    public function add()
    {
      return view('user.list_detail.register');    
    }
    
    /*新規登録画面で入力した内容を保存 */
    public function create(Request $request)
    {
      $this->validate($request, Bookstores::$rules);
     
      //$bsid = Bookstores::find($request->id);
      //print $bsid;
      
      $bs = new Bookstores;
      
      $bs->name=$request->input('name');
      $bs->region=$request->input('region');
      $bs->pref=$request->input('pref');
      $bs->address=$request->input('address');
      
      if ($request->file('image') !=null ) {
        $path = $request->file('image')->store('public/image');
        $bs->image_path = basename($path);
      } else {
          $bs->image_path = null;
      }
      //ログイン中のユーザーIDを取得 2020.06.01
      $bs->user_id=Auth::id();
      
        
      
      // フォームから送信されてきた_tokenを削除する
      unset($bs['_token']);
      // フォームから送信されてきたimageを削除する
      unset($bs['image']);
      
      $bs->save();
      //保存した最新のbookstoreidを取得する 2020.06.01
      $last_insert_id = $bs->id;
      //var_dump($last_insert_id);
      //本屋履歴にデータ保存する 2020/06/01
      $bsh= new BookstoreHistories;
      $bsh->bookstore_id = $last_insert_id;
      $bsh->name=$request->input('name');
      $bsh->region=$request->input('region');
      $bsh->pref=$request->input('pref');
      $bsh->address=$request->input('address');
      //以下、開発用/lolipop用
      // if (isset($form['image'])) {
      //   $path = $request->file('image')->store('public/image');
      //   $bsh->image_path = basename($path);
      // } else {
      //     $bsh->image_path = null;
      // }
      
      //以下、heroku用
      if (isset($form['image'])) {
        $path = putFile('/',$form['image'],'public');
        $bsh->image_path = Storage::disk('s3')->url($path);
      } else {
          $bsh->image_path = null;
      }
      
      
      //ログイン中のユーザーIDを取得 2020.06.01
      $bsh->user_id=Auth::id();
      // フォームから送信されてきた_tokenを削除する
      unset($bsh['_token']);
      // フォームから送信されてきたimageを削除する
      unset($bsh['image']);
    
      $bsh->edited_at = Carbon::now();
      $bsh->save();
      
      //comments tableに値を挿入 2020.06.01
      $cm=new Comments;
      $cm->store_id =$last_insert_id;
      $cm->handdle_name = $request->input('handdle_name');
      $cm->comment = $request->input('comment');
      $cm->user_id = Auth::id();
      
      $cm->save();
      //comments.idを取得 2020.06.01
      $cm_last_insert_id = $cm->id;
      
      $cmh = new Commenthistories;
      $cmh->store_id = $last_insert_id;
      $cmh->comment_id = $cm_last_insert_id;
      $cmh->user_id = Auth::id();
      $cmh->handdle_name = $request->input('handdle_name');
      $cmh->comments = $request->input('comment');
      $cmh->edited_at = Carbon::now();
      
      $cmh->save();
      
      //return redirect('admin/list_detail/register');
      //登録完了後、ログイン一覧画面へ遷移,登録しました。のメッセージを表示する
      return redirect('user/list')->with('message','登録しました。');
    }
    
    /*ログイン後、ログイン後のトップ画面に遷移 2020.05.17*/
    public function index(){
      return view('user.home');
    }
    /*ログイン後、ログイン後のabout画面に遷移 2020.05.17*/
    public function about(){
      return view('user.about');
    }
    /*ログイン後、ログイン後のlist画面に遷移 2020.05.20 */
    public function list(Request $request){
       $name = $request->name;
      $region = $request->region;
      if(($region !='' && $name != '')||($region !=null && $name != null)){
          $bookstores = Bookstores::where('region',$region)->where('name','LIKE',"%$name%")->orderBy('created_at','DESC')->paginate(9);
          $bs_id = Bookstores::where('region',$region)->where('name','LIKE',"%$name%")->orderBy('created_at','DESC')->get(['id']);
      $bs_id = $bs_id->toArray();
     
      $count = [];
      for($i=0;$i<count($bs_id);$i++){
         $cmt = Comments::select(['comments.store_id'])->Join('bookstores','comments.store_id','=','bookstores.id')->groupBy('comments.store_id')->having('comments.store_id','=',$bs_id[$i])->count();
         
         $count[$bs_id[$i]['id']]=$cmt;
        }
      }
      else if($region != '' || $region != null){
          $bookstores = Bookstores::where('region',$region)->orderBy('created_at','DESC')->paginate(9);
          $bs_id = Bookstores::where('region',$region)->orderBy('created_at','DESC')->get(['id']);
          $bs_id = $bs_id->toArray();
     
          $count = [];
      for($i=0;$i<count($bs_id);$i++){
         
          $cmt = Comments::select(['comments.store_id'])->Join('bookstores','comments.store_id','=','bookstores.id')->groupBy('comments.store_id')->having('comments.store_id','=',$bs_id[$i])->count();
         
         $count[$bs_id[$i]['id']]=$cmt;
      }
      }else if($name != '' || $name !=null){
         $bookstores = Bookstores::where('name','LIKE',"%$name%")->orderBy('created_at','DESC')->paginate(9);
      $bs_id = Bookstores::where('name','LIKE',"%$name%")->orderBy('created_at','DESC')->get(['id']);
      $bs_id = $bs_id->toArray();
    
      $count = [];
      for($i=0;$i<count($bs_id);$i++){
          
         $cmt = Comments::select(['comments.store_id'])->Join('bookstores','comments.store_id','=','bookstores.id')->groupBy('comments.store_id')->having('comments.store_id','=',$bs_id[$i])->count();
        
         $count[$bs_id[$i]['id']]=$cmt;
      }
      }else{
        $bookstores = Bookstores::orderBy('created_at','DESC')->paginate(9);  
        $bs_id = Bookstores::orderBy('created_at','DESC')->get(['id']);
        $bs_id = $bs_id->toArray();

        $count = [];
        for($i=0;$i<count($bs_id);$i++){
          $cmt = Comments::select(['bookstore.comments.store_id'])->Join('bookstore.bookstores','bookstore.comments.store_id','=','bookstore.bookstores.id')->groupBy('bookstore.comments.store_id')->having('bookstore.comments.store_id','=',$bs_id[$i])->count();
        
          $count[$bs_id[$i]['id']]=$cmt;
          }
      }
     
      return view('user.list',['bookstores'=>$bookstores,'name'=>$name,'region'=>$region,'count'=>$count]);
    }
    
     /*2020.05.29  xml読み込み*/
   public function sqlToXML(){
       $results = Bookstores::all();
       
       //var_dump($results);
       return response()->view('user.sqlToXML',['results' => $results ])->header("Content-type","text/xml");
       //return view('list.sqlToXML',['results' => $results ]);
   }
   
   /*2020.06.05 詳細画面へ遷移*/
   public function detail(Request $request){
       $id = $request->id;
       $bs = Bookstores::where('id',$id)->first();
       $cm = Comments::where('store_id',$id)->get();
       return view('user.list_detail.detail_comment',['bs'=>$bs,'cm'=>$cm]);
   }
   
   /*2020.06.05 コメント詳細画面でコメントを新規登録する*/
  public function commentInsert(Request $request)
    {
      $this->validate($request, Comments::$rules);
     
      
      //現在表示されているページのbookstoreidを取得する 2020.06.05
     // $id = $request->id;
      //$bs = Bookstores::where('id',$id)->first();
      //$last_insert_id = $bs->id;
     
      
      
      //comments tableに値を挿入 2020.06.05
      $cm = new Comments;
      $cm->store_id = $request->input('store_id');
      $cm->handdle_name = $request->input('handdle_name');
      $cm->comment = $request->input('comment');
      $cm->user_id = Auth::id();
      
      // フォームから送信されてきた_tokenを削除する
      unset($cm['_token']);
      
      $cm->save();
      //comments.idを取得 2020.06.05
      $cm_last_insert_id = $cm->id;
      $cm_store_id = $cm->store_id;
      
      
      $cmh = new Commenthistories;
      $cmh->store_id = $cm_store_id;
      $cmh->comment_id = $cm_last_insert_id;
      $cmh->user_id = Auth::id();
      $cmh->handdle_name = $request->input('handdle_name');
      $cmh->comments = $request->input('comment');
      $cmh->edited_at = Carbon::now();
      
      $cmh->save();
      //登録完了後、ログイン一覧画面へ遷移、コメント登録しましたフラッシュメッセージを表示
      return redirect('user/list')->with('message','コメント登録しました。');
    }
    
    public function howtouse(){
       return view('user.howtouse');
   }
   
}
