<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Bookstores; //2020.05.29

use App\Comments; //2020.06.05

class ListController extends Controller
{
    public function index(){
        return view('list.index');
    }
    public function about(){
        return view('list.about');
    }
     /*list画面 2020.06.01 */
    public function list(Request $request){
      $name = $request->name;
      $region = $request->region;
      if(($region !='' && $name != '')||($region !=null && $name != null)){
          $bookstores = Bookstores::where('region',$region)->where('name','LIKE',"%$name%")->orderBy('created_at','DESC')->paginate(9);
           $bs_id = Bookstores::orderBy('created_at','DESC')->get(['id']);
      $bs_id = $bs_id->toArray();
      //print_r($bs_id);
      $count = [];
      for($i=0;$i<count($bs_id);$i++){
          //print implode($bs_id[$i]);
          $cmt = Comments::select(['comments.store_id'])->Join('bookstores','comments.store_id','=','bookstores.id')->groupBy('comments.store_id')->having('comments.store_id','=',$bs_id[$i])->count();
         //$cnt=$cmt->count();
         //dd($cmt->toArray());
         //var_dump($cnt);
         
         $count[$bs_id[$i]['id']]=$cmt;
      }
      //print_r($count);
      }
      else if($region != '' || $region != null){
          $bookstores = Bookstores::where('region',$region)->orderBy('created_at','DESC')->paginate(9);
           $bs_id = Bookstores::orderBy('created_at','DESC')->get(['id']);
      $bs_id = $bs_id->toArray();
      //print_r($bs_id);
      $count = [];
      for($i=0;$i<count($bs_id);$i++){
          //print implode($bs_id[$i]);
          $cmt = Comments::select(['comments.store_id'])->Join('bookstores','comments.store_id','=','bookstores.id')->groupBy('comments.store_id')->having('comments.store_id','=',$bs_id[$i])->count();
         //$cnt=$cmt->count();
         //dd($cmt->toArray());
         //var_dump($cnt);
         
         $count[$bs_id[$i]['id']]=$cmt;
      }
      //print_r($count);
      }else if($name != '' || $name !=null){
         $bookstores = Bookstores::where('name','LIKE',"%$name%")->orderBy('created_at','DESC')->paginate(9);
          $bs_id = Bookstores::orderBy('created_at','DESC')->get(['id']);
      $bs_id = $bs_id->toArray();
      //print_r($bs_id);
      $count = [];
      for($i=0;$i<count($bs_id);$i++){
          //print implode($bs_id[$i]);
          $cmt = Comments::select(['comments.store_id'])->Join('bookstores','comments.store_id','=','bookstores.id')->groupBy('comments.store_id')->having('comments.store_id','=',$bs_id[$i])->count();
         //$cnt=$cmt->count();
         //dd($cmt->toArray());
         //var_dump($cnt);
         
         $count[$bs_id[$i]['id']]=$cmt;
      }
      //print_r($count);
      }else{
        $bookstores = Bookstores::orderBy('created_at','DESC')->paginate(9);  
         $bs_id = Bookstores::orderBy('created_at','DESC')->get(['id']);
      $bs_id = $bs_id->toArray();
      //print_r($bs_id);
      $count = [];
      for($i=0;$i<count($bs_id);$i++){
          //print implode($bs_id[$i]);
          $cmt = Comments::select(['comments.store_id'])->Join('bookstores','comments.store_id','=','bookstores.id')->groupBy('comments.store_id')->having('comments.store_id','=',$bs_id[$i])->count();
         //$cnt=$cmt->count();
         //dd($cmt->toArray());
         //var_dump($cnt);
         
         $count[$bs_id[$i]['id']]=$cmt;
      }
      //print_r($count);
      }
    
     
      return view('list.list',['bookstores'=>$bookstores,'name'=>$name,'region'=>$region,'count'=>$count]);
    }
   /*2020.05.29  xml読み込み*/
   public function sqlToXML(){
       $results = Bookstores::all();
       
       //var_dump($results);
       return response()->view('list.sqlToXML',['results' => $results ])->header("Content-type","text/xml");
       
   }
   /*2020.06.04 詳細画面へ遷移*/
   public function detail(Request $request){
       $id = $request->id;
       $bs = Bookstores::where('id',$id)->first();
       $cm = Comments::where('store_id',$id)->get();
       return view('list.list_detail',['bs'=>$bs,'cm'=>$cm]);
   }
   
   public function howtouse(){
       return view('list.howtouse');
   }
 

}
