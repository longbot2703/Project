<?php

namespace App\Http\Controllers;

use App\category;
use App\comment;
use App\product;
// use App\Category;
// use App\Product;
use Cart;
// use App\Mail;
use App\Order;
use App\Orderdetail;
use Carbon\Carbon;
use App\Customer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Exception;

use App\Subscriber;

use App\Mail\DemoEmail;
use Illuminate\Support\Facades\Mail;

use App\Http\Controllers\Controller;;



class FrontendController extends Controller
{
    public function welcome()
    {
        // // $com = new comment();
        // $lsComment = $com->commindex();
        $lsCategory = category::all();
        //$lsProduct = product::select('select * from products where pr_discount != 0 ORDER BY pr_id DESC LIMIT 8');
        $lsProduct = DB::table('products')->where('deleted_at', null)->where('discount', '!=', 0)->orderBy('pr_id', 'desc')->paginate(8);
        // $lsComment = DB::table('comments')->join('customers', 'comments.cus_id', '=', 'customers.cus_id')->orderBy('comm_id', 'DESC')->limit('3')->get();

        return view('welcome')->with('lsCategory', $lsCategory)->with('lsProduct', $lsProduct);
    }

//  trang shop
    public function shop() {
        $lsProduct = Product::where('deleted_at', null)->paginate(8);
        $allProduct = Product::where('deleted_at', null)->paginate(8);
        $lstCategory =category::where('deleted_at',null)->get();

        // return view('shop')->with(['lsProduct'=>$lsProduct , 'allProduct'=>$allProduct , 'lstCategory'=>$lstCategory]);
        return view('shop',compact('lsProduct', 'allProduct', 'lstCategory'));
    }

    public function shopId($id){

        if ($id == 1 || $id == 2 || $id == 3 || $id == 4) {
            $lsProduct = Product::where('deleted_at', null)->where('cat_id','=', $id)->paginate(4);
            $lstCategory = category::where('deleted_at', null)->get();

            return view('shop', compact('lsProduct','lstCategory'));
        }else{
            $lsProduct = Product::where('deleted_at', null)->paginate(4);
            $lstCategory = category::where('deleted_at', null)->get();
            return view('shop', compact('lsProduct','lstCategory'));
         }

    }
//   ket thuc trang shop



// chi tiet san pham an
    public function single(){
        $listproduct = DB::table('products')->where('deleted_at',null)->where('pr_quantity','>',0)->orderBy('pr_id','desc')->paginate(4);

        return view('product-single' )->with('listproduct',$listproduct);
    }

    public function singleId($id){
      //Lấy chi tiết một sản phẩm
         $product = product::where('deleted_at',null)->where('pr_id',$id)->first();
      //Lấy danh sach cac sản phẩm liên quan
        $listproduct = DB::table('products')->where('cat_id',$product->cat_id)->where('deleted_at', null)->paginate(4);
         return view('product-single', compact('product', 'listproduct'));
    }



    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function postContact(request $request)
    {
        $data['info'] = $request -> all();

        Mail::send('contactmail', $data, function ($message) {
          $message->from('t1904efpt@gmail.com', 'Team 1 Shop');

          $message->to('t1904efpt@gmail.com', 'Team 1 Shop');

          $message->subject('Feedback khách hàng');
        });
        return view('contact');
    }

    //Manh load chi tiet san pham

    public function loadDeatilProduct(Request $request)
    {

        try {
        $data = product::where('pr_id', $request->id)->first();
        return response()->json(['status' => 1, 'data' => $data]);
        } catch (Exception $ex) {
        $ex->getMessage();
        return response()->json(['status' => 0, 'data' => null]);
        }
    }

    public function cate($id)
    {
        //lấy tất cả sản phẩm theo từng category
        $lsProduct = DB::table('products')->where('cat_id', '=', $id)->get();
        return view('wishlist', compact('lsProduct'));
    }


    // Gio hang
    public function cart()
    {
        return view('cart');
    }

    public function getAddCart(request $request,$id)
    {
         if( $request->session()->has('name') ){
            $lsproduct = Product::find($id);
                $b=$lsproduct->pr_price;
                $a=($lsproduct->pr_price)*((100-($lsproduct->discount))/100);

                // $b=$lsproduct->pr_price;
                Cart::add([
                'id' => $id,
                'name' => $lsproduct->pr_name,
                'qty' => 1,
                'price' => $a,
                'options' => [
                    'img' => $lsproduct->pr_image,
                    'discount' => $lsproduct->discount]
                ]);

        return redirect()->back()->with('success', 'IT WORKS!');
        }else{
            return redirect()->route('index.dangnhap');
        }

    }

    public function getDeleteCart($id)
    {
      if ($id == 'all') {
        Cart::destroy();
      } else {
        Cart::remove($id);
      }
      return back();
    }

    public function getUpdateCart(Request $request){
        Cart::update($request->rowId, $request->qty);
    }

    // Thanh toan
     public function getCheckOut(request $request){
         if( $request->session()->has('name') ){
            $a = $request->session()->get('cus_id');
            $datacus = DB::table('customers')->where('deleted_at',null)->where('cus_id',$a)->first();

            return view ('checkout', compact('datacus'));
         }else {
            return redirect()->route('index.dangnhap');
         }
     }

     public function postCheckOut(Request $request){
       $cartInfor = Cart::content();
       $subtotal = Cart::subtotal();

       $a = $request->session()->get('cus_id');



       $od = new Order();
       $od -> cus_id = $a;
    if($request -> note == null){
         $od -> cus_status = "";
    }else{
 $od -> cus_status = $request -> note;
    }
       $od -> cus_total_price =(int)str_replace(',', '', $subtotal) ;
       $od -> cus_total_price_PayMent =(int)str_replace(',', '', $subtotal);
       $od -> status = 0;
       $od -> created_at = Carbon::now();
       $od -> save();

       $odID = DB::table('orders')->orderBy('od_id','desc')->get('od_id')->first();

       foreach ($cartInfor as $key => $item){
         $oddetail = new Orderdetail();
         $oddetail -> od_id = $odID -> od_id;
         $oddetail -> pr_id = $item -> id;
         $oddetail -> oddt_quantity = $item -> qty;
         $oddetail -> created_at = Carbon::now();
         $oddetail -> save();
         $product = Product::find($item->id);
         $product->decrement('pr_quantity', $item->qty);
       }


        $data['cart'] = Cart::content();
        $data['subtotal'] = Cart::subtotal();
        $data['infor'] = Customer::find($a);
        $email = $request->session()->get('cus_email');

        Mail::send('email', $data, function ($message) use($email){
        $message->from('t1904efpt@gmail.com', 'Team 1 Shop');

        $message->to($email, $email);

        $message->cc('t1904efpt@gmail.com', 'Team 1 Shop');

        $message->subject('Xac nhan hoa don mua hang Team 1 Shop');
        });

       Cart::destroy();

       return view ('complete' );
     }

     public function complete(){
             return view('complete');
     }


    // Mail subscriber
    public function subscribe(Request $request) {
      $s = new Subscriber();
      $s->email = $request->email;
      $s->save();

      Mail::to($s->email)->send(new DemoEmail());

      return redirect()->back();
      }

    //   lọc tất cả các sản phẩm đã hết hàng ra trang wishlist
    public function wishlist(){
        $data = DB::table('products')->where('deleted_at', null)->where('pr_quantity',0)->paginate(4);
        return view('wishlist', compact('data'));
    }

}
