<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //
    public function list_order(){
        $data=[];
        // $orders=Order::join('users','orders.user_id','=','users.id')->select('orders.id','orders.status','users.name','orders.created_at')->orderBy('orders.created_at','desc')->paginate(5);
        $orders=Order::join('users','orders.user_id','=','users.id')
        ->join('order_detail','orders.id','=','order_detail.order_id')
        ->select('orders.*','users.name',DB::raw('SUM(order_detail.quantity) AS quantity'))
        ->groupBy('order_detail.order_id')->orderBy('created_at','desc')
        ->paginate(5);

        // SELECT orders.*,users.name,SUM(order_detail.quantity) as quantity FROM orders INNER JOIN order_detail ON order_detail.order_id = orders.id INNER JOIN users ON users.id = orders.user_id GROUP BY order_detail.order_id;
        $data['orders']=$orders;
        // dd($data);
        return view('admin.orders.index',$data);
    }
    public function order_detail($id){
        $data=[];
       
        $order=Order::find($id);
        $customer=User::select('name','email','address','phone')->find($order->user_id);
        $order_details = DB::table('order_detail')
        ->join('products', 'order_detail.product_id', '=', 'products.id')
        ->join('orders', 'order_detail.order_id', '=', 'orders.id')
        ->join('sizes', 'order_detail.size_id', '=', 'sizes.id')
        ->join('prices', 'order_detail.price_id', '=', 'prices.id')
        ->leftjoin('promotions','order_detail.promotion_id','=','promotions.id')
        ->where('order_id',$id)->select('products.thumbnail','products.name as product_name', 'sizes.name as size_name', 'prices.price','order_detail.quantity','promotions.discount')
        ->get();
        $data['customer']=$customer;
        $data['order_details']=$order_details;
        return view('admin.orders.order_detail',$data);
    }
    public function confirm_order($id){
        $order=Order::find($id);
        $order->status=2;
        try{
            $order->save();
            return redirect()->route('admin.order.list_order')->with('success',"Duyệt đơn hàng $id thành công");
        }catch(\Exception $ex){
            return redirect()->back()->with('error',$ex->getMessage());
        }
    }
    public function search(Request $request){
        $date=$request->date;
        $status=$request->status;
        $data=[];
        $orders=Order::join('users','orders.user_id','=','users.id')->select('orders.id','orders.status','users.name','orders.created_at');
        if(!empty($date)){
           $orders=$orders->whereDate('orders.created_at','=',$date);
        }
        if($status==2){
            $orders=$orders->where('orders.status','=',$status);
        }elseif($status==3){
            $orders=$orders->where('orders.status','=',$status);
        }elseif($status==4){
            $orders=$orders->where('orders.status','=',$status);
        }elseif($status=="0-1"){
            $status=explode("-",$status);
            $status_first=$status[0];
            $status_second=$status[1];
            $orders=$orders->where('orders.status','=',$status_first)->orWhere('orders.status','=',$status_second);
        }
        $orders=$orders->orderBy('orders.created_at', 'desc')->paginate(5);
        $data['date']=$date;
        $data['status']=$request->status;
        $data['orders']=$orders;
        return view('admin.orders.index',$data);
    }
    public function list_order_shipping(){
        $data=[];
        $orders=Order::where('status','=',2)->orderBy('created_at','desc')->paginate(5);
        $data['orders']=$orders;
        return view('admin.orders.list_order_shipping',$data);
    }

    public function shipping_failure($id){
        $order=Order::find($id);
        $order->status=3;
        DB::beginTransaction();
        try{
            $order->save();
            DB::commit();
            return redirect()->back()->with('success','Cập nhật tình trạng thành công');
        }catch(\Exception $ex){
            DB::rollback();
            return redirect()->back()->with('error',$ex->getMessage());
        }
    }
    public function shipping_success($id){
        $order=Order::find($id);
        $order->status=4;
        DB::beginTransaction();
        try{
            $order->save();
            DB::commit();
            return redirect()->back()->with('success','Cập nhật tình trạng thành công');
        }catch(\Exception $ex){
            DB::rollback();
            return redirect()->back()->with('error',$ex->getMessage());
        }
    }
}
