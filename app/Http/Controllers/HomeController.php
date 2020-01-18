<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\ProductRating;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //return view('home');
        // $user = Auth::user();
        // dd($user);

        $products = DB::table('products')->get();
        return view('home', ['products' => $products]);
    }

    public function productDetails($product_id) {
        $data = DB::table('products')->where('product_row_id', $product_id)->first();
        $product_ratings = ProductRating::where('product_id', $product_id)->get();
        return view('product_detail', compact('data', 'product_ratings')); 
    }

    function submitRating(Request $request) {
        $rating_data = $request->all();
        //echo '<pre>'.print_r($rating_data, true).'</pre>'; exit;
        $productRating_model = new ProductRating();
        $pid = $request->product_id;
        $productRating_model->user_id = 0;
        $productRating_model->product_id = $request->product_id;
        $productRating_model->name = $request->author;
        $productRating_model->email = $request->email;  
        $productRating_model->rating = $request->rating;
        $productRating_model->reviews = $request->comment;
        
        if($productRating_model->save() == true){
            $insertedId = $productRating_model->id;
            return view('show_review_ajax', ['product_ratings'=> $rating_data, 'insertedId'=>$insertedId]);
        }

    }
}
