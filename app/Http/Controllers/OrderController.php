<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lstOrder = DB::table('orders as o')->leftjoin('customers as c', 'o.cus_id', 'c.cus_id')
            ->where('o.deleted_at', null)
            ->select(
                'o.od_id as id',
                'o.cus_total_price as total_price',
                'o.cus_status as note',
                'o.created_at as created_at',
                'c.cus_name as name',
                'c.cus_phone as phone',
                'o.status as status'
            )->orderBy('o.created_at', 'desc')->paginate(10);
        return view('layouts_back_end.order.index', compact('lstOrder'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    //Load chi tiết đơn hàng

    public function LoadDetai(Request $request)
    {
        try {
            $data = DB::table('orders as o')->leftjoin('customers as c', 'o.cus_id', 'c.cus_id')
                ->where([['o.deleted_at', null], ['o.od_id', $request->id]])
                ->select(
                    'o.od_id as id',
                    'o.cus_total_price as total_price',
                    'o.cus_status as note',
                    'o.created_at as created_at',
                    'c.cus_name as name',
                    'c.cus_phone as phone',
                    'o.status as status',
                    'c.cus_addres as addres',
                    'c.cus_email as email',
                )->first();
            $lstItem = DB::table('orderdetails as o')->leftjoin('products as p', 'o.pr_id', 'p.pr_id')
                ->where('p.deleted_at', null)
                ->select(
                    'p.pr_name as name',
                    'p.pr_price as price',
                    'o.oddt_quantity as quantity',
                    DB::raw('p.pr_price * o.oddt_quantity as sumprice'),
                    DB::raw('p.pr_price * o.oddt_quantity *(100 - p.discount)/100 as sumpriceDiscount')
                )->get();
            return view('layouts_back_end.order.mdOrderDetail', compact('data', 'lstItem'));
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }
    //Thay đổi trạng thái đơn hàng

    public function saveEditBill(Request $request)
    {
        try {
            DB::table('orders')->where('od_id', $request->id)->update([
                'status' => $request->status
            ]);
            return response()->json(['status' => 1, 'message' => 'Đơn hàng đã được cập nhật']);
        } catch (\Exception $e) {
            $e->getMessage();
            return response()->json(['status' => 0, 'message' => 'Có lỗi']);
        }
    }

    //Xuất excel đơn hàng

    public function ExportExcel(Request $request)
    {
        try {
            $dataExcel = [];
            $data = DB::table('orders as o')->leftjoin('customers as c', 'o.cus_id', 'c.cus_id')
                ->where([['o.deleted_at', null], ['o.od_id', $request->id]])
                ->select(
                    'o.od_id as id',
                    'o.cus_total_price as total_price',
                    'o.cus_status as note',
                    'o.created_at as created_at',
                    'c.cus_name as name',
                    'c.cus_phone as phone',
                    'o.status as status',
                    'c.cus_addres as addres',
                    'c.cus_email as email',
                    'o.cus_total_price_PayMent as priceDiscount'
                )->first();

            $lstItem = DB::table('orderdetails as o')->leftjoin('products as p', 'o.pr_id', 'p.pr_id')
                ->where('p.deleted_at', null)
                ->select(
                    'p.pr_name as name',
                    'p.pr_price as price',
                    'o.oddt_quantity as quantity',
                    DB::raw('p.pr_price * o.oddt_quantity as sumprice'),
                    DB::raw('p.pr_price * o.oddt_quantity *(100 - p.discount)/100 as sumpriceDiscount')
                )->get();
            $stt = 1;
            foreach ($lstItem as $it) {
                $dataExcel[] = array(
                    'stt' => $stt,
                    'name' => $it->name,
                    'price' => $it->price,
                    'quantity' => $it->quantity,
                    'sumprice' => $it->sumprice,
                    'sumpriceDiscount' => $it->sumpriceDiscount
                );
                $stt++;
            };
            $date_now = Carbon::now();

            return Excel::download(new ExportController($request->id), "BillDetail" . " " . $date_now . '.xlsx');

            /*return Excel::download(function ($excel) use ($data, $dataExcel) {
                $excel->sheet('Sheetname', function ($sheet) use ($data, $dataExcel) {

                    $sheet->setColumnArray(array(
                        'E' => '#,##0',
                        'F' => '#,##0',
                        'G' => '#,##0',
                        'H' => '#,##0',
                    ));

                    $range_merge = "A2:F2";
                    $sheet->mergeCells($range_merge);
                    $sheet->setWidth(array(
                        'A'     =>  30,
                        'B'     =>  30,
                        'C'     =>  30,
                        'D'     =>  30,
                        'E'     =>  30,
                        'F'     =>  30
                    ));

                    $sheet->cells('A2', function ($cells) {
                        $cells->setValue('Hóa Đơn');

                        $cells->setFont(array(
                            'size'       => '18',
                            'bold'       =>  true,
                        ));
                        $cells->setAlignment('center');
                    });
                    $sheet->cell('A1', 'Tên khách hàng');
                    $sheet->cell('A2', 'Số điện thoại');
                    $sheet->cell('A3', 'Email');
                    $sheet->cell('A4', 'Địa chỉ');
                    $sheet->cell('A5', 'Thành tiền');
                    $sheet->cell('A6', 'Thời gian đặt hàng');
                    $sheet->cell('A7', 'Thời gian thanh toán');
                    $sheet->cell('B1', $data->name);
                    $sheet->cell('B2', $data->phone);
                    $sheet->cell('B3', $data->email);
                    $sheet->cell('B4', $data->address);
                    $sheet->cell('B5', $data->priceDiscount);
                    $sheet->cell('B6', $data->created_at);
                    $sheet->cell('B7', Carbon::now());

                    //Xuất chi tiết đơn hàng
                    $sheet->mergeCells("A8:F8");
                    $sheet->cells('A8', function ($cells) {
                        $cells->setValue('Chi tiết đơn hàng');

                        $cells->setFont(array(
                            'size'       => '18',
                            'bold'       =>  true,
                        ));
                        $cells->setAlignment('center');
                    });
                    $sheet->cell('A8', 'STT');
                    $sheet->cell('B8', 'Tên sản phẩm');
                    $sheet->cell('C8', 'Giá sản phẩm');
                    $sheet->cell('D8', 'Số lượng');
                    $sheet->cell('E8', 'Tổng tiền');
                    $sheet->cell('F8', 'Giá sau khi giảm');
                    $i = 9;
                    foreach ($dataExcel as $dt) {
                        $sheet->cell(
                            'A' . $i,
                            $dt['stt'],
                            'B' . $i,
                            $dt['name'],
                            'C' . $i,
                            $dt['price'],
                            'D' . $i,
                            $dt['quantity'],
                            'E' . $i,
                            $dt['sumprice'],
                            'F' . $i,
                            $dt['sumpriceDiscount']
                        );
                        $i++;
                    }
                    //Tạo phần ký tên cho đơn hàng
                    $sheet->mergeCells("A.$i:F.$i");
                    $sheet->cells(
                        'A' . $i,
                        function ($cells) {
                            $cells->setValue('Nhân viên bán hàng');

                            $cells->setFont(array(
                                'size'       => '15',
                                'bold'       =>  true,
                            ));
                            $cells->setAlignment('right');
                        }
                    );
                })->download('xlsx');
            }, "BillDetail" . " " . $date_now);*/
            //return 1;
        } catch (\Exception $e) {
            $e->getmessage();
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function seachOrd(request $request){
        $lstOrder = order::leftJoin('customers', 'orders.cus_id', '=', 'customers.cus_id')
            ->where('orders.deleted_at',null)
            // ->when(request('name', null), function($query, $name){ return $query->where('customers.name', 'like','%'.implode('%',explode(' ',$name)).'%');})
            ->when(request('fromDate', null), function($query, $fromDate){ return $query->where('orders.created_at','>=',date('Y-m-d 0:0:0', strtotime(strtr($_REQUEST['fromDate'], '/', '-'))) );})
            ->when(request('toDate', null), function($query, $endDate){ return $query->where('orders.created_at','<=', date('Y-m-d 23:59:59', strtotime(strtr($_REQUEST['toDate'], '/', '-'))) );})
            // ->select('posts.*', 'users.name as creatorName')
            ->select(
                'orders.od_id as id',
                'orders.cus_total_price as total_price',
                'orders.cus_status as note',
                'orders.created_at as created_at',
                'customers.cus_name as name',
                'customers.cus_phone as phone',
                'orders.status as status'
            )
            // ->where('posts.is_active', 1)
            ->orderBy('orders.created_at', 'desc')
            ->get();


        // $lstOrder = DB::table('orders as o')->enerjoin('customers as c', 'o.cus_id', 'c.cus_id')
        //     ->where('o.deleted_at', null)
        //     ->where('cus.cus_name','like', '%'.implode('%',explode(' ',$request->name)).'%')
        //     ->whereTime($request->fromDate ,)
        //     ->whereTime('od.created_at', '>=', date('Y-d-m 0:0:0', strtotime($request->fromDate)))
        //     ->where('od.created_at', '<=', date('Y-d-m 23:59:59', strtotime($request->toDate)))
        //     // ->where('od.status', $request->status)
        //     ->select(
        //         'o.od_id as id',
        //         'o.cus_total_price as total_price',
        //         'o.cus_status as note',
        //         'o.created_at as created_at',
        //         'c.cus_name as name',
        //         'c.cus_phone as phone',
        //         'o.status as status'
        //     )->orderBy('o.created_at', 'desc')->paginate(4);
            dd($lstOrder);
        return view('layouts_back_end.order.tblOder', compact('lstOrder'));

        // $lstOrder = DB::table('orders as od')->leftjoin('customers as cus', 'od.cus_id','cus.cus_id' )
        // ->where('od.deleted_at',null)
        // ->when(request('name', null), function($query, $name){
            // return $query->where('cus.cus_name','like','%'.implode('%',explode(' ',$name)).'%');
        //      })
        //     ->when(request('fromDate', null), function ($query, $fromDate) {
        //             return $query->where('od.created_at', '>=', date('Y-d-m 0:0:0', strtotime($fromDate)));
        //         })
        // ->when(request('toDate', null), function ($query, $toDate) {
        //         return $query->where('od.created_at', '<=', date('Y-d-m 23:59:59', strtotime($toDate)));
        //     })
        // ->when(request('status', null), function ($query, $status) {
        //         return $query->where('od.status', $status);
        //     })
        // ->orderBy('od.od_id', 'desc')->paginate(10);

        // return view('layouts_back_end.order.tblOder', compact('lstOrder'));
    }
}
