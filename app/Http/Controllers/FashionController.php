<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Fashion;
use App\Http\Resources\Fashion as FashionResource;
use App\Http\Resources\Fashions as FashionResourceCollection;

class FashionController extends Controller
{
    //
    public function index(){
    	$criteria = Fashion::paginate(6);
        return new FashionResourceCollection($criteria);
    }
    public function view($id){
    	$fashion = new FashionResourceCollection(Fashion::find($id));
    	return $fashion;
    }
    public function Qbuild(){
    	$fashion = DB::table('fashion')->get();
    	return $fashion;
    }
    public function top($count){
        $criteria = Fashion::select('*')
            ->orderBy('views','DESC')
            ->limit($count)
            ->get();
        return new FashionResourceCollection($criteria);
    }
    public function slug($slug){
        $criteria = Fashion::where('slug',$slug)->first();
        return new FashionResource($criteria);
    }
    public function search($keyword){
        $criteria = Fashion::select('*')
            ->where('title','LIKE',"%".$keyword."%")
            ->orderBy('views','DESC')
            ->get();
        return new FashionResourceCollection($criteria);
    }
}
