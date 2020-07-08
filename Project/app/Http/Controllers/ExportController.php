<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ExportController extends Controller implements FromCollection, WithHeadings
{
    use Exportable;

    private $id;

    public function __construct($id = 1)
    {
        $this->id = $id;
    }


    public function collection()
    {
        $dataExcel = [];
        $data = DB::table('orders as o')->leftjoin('customers as c', 'o.cus_id', 'c.cus_id')
            ->where([['o.deleted_at', null], ['o.od_id', $this->id]])
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

        return (collect($dataExcel));
    }

    public function headings(): array
    {
        return [
            'STT',
            'Tên sản phẩm',
            'Giá',
            'Số lượng',
            'Tổng tiền',
            'Tổng tiền sau khi giảm'
        ];
    }
}
