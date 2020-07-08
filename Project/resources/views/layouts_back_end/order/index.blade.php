@extends('layouts_back_end.admin')
@section('content')

<div class="col-md-12" style="margin-top:80px;">
    <div class="breadcrumb-holder">
        <div class="row mb-3 mt-3">
            <div class="col-md-10 col-sm-10 col-9 text-dark px-0">
                <h4><i class="fa fa-bitcoin"></i> Đơn hàng</h4>
            </div>
        </div>
    </div>
</div>

<div class="row mb-2">
    <div class="col-sm-3 col-md-3 col-lg-3">
        <input class="form-control" id="Odname" placeholder="Nhập tên hoặc số điện thoại khách hàng" />
    </div>
    <div class="col-sm-3 col-md-3 col-lg-3">
        <input type="text" id="fromDate" class="form-control relative-icon-calendar date" placeholder="Từ ngày" />
        <i class="fa fa-calendar absolute-icon-calendar"></i>
    </div>
    <div class="col-sm-3 col-md-3 col-lg-3">
        <input type="text" id="toDate" class="form-control relative-icon-calendar date" placeholder="Đến ngày" />
        <i class="fa fa-calendar absolute-icon-calendar"></i>
    </div>
    <div class="col-sm-3 col-md-3 col-lg-3">
        <select class="form-control" id="valStaus">
            <option value="" selected disabled hidden>Trạng thái</option>
            <option value="0">Chờ xác nhận</option>
            <option value="1">Đã xác nhận</option>
            <option value="2">Đã thanh toán</option>
            <option value="3">Đã hủy</option>
        </select>
    </div>
</div>
<div class="mb-5" style="margin-top:10px;">
    <div class="col-sm-4 col-md-4 col-lg-4 col-md-offset-8 text-right">
        <button class="btn btn-primary" id="btnSearchItem" onclick="searchOrder()"><i class="fa fa-search mr-1"></i>Tìm kiếm</button>
    </div>
</div>

<div class="row" style="margin-top: 50px;">
    <div class="col-md-12" id="TableOrder">
        <table style="text-align:center" class="table table-bordered table-hover mt-2 w-100">
            <thead>
                <tr class="text-center">
                    <th>STT</th>
                    <th class="text-center">Tên khách hàng</th>
                    <th class="text-center">Số điện thoại</th>
                    <th class="text-center">Ghi chú</th>
                    <th class="text-center">Trạng thái</th>
                    <th class="text-center">Đơn giá</th>
                    <th class="text-center">Ngày tạo</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @if(count($lstOrder) == 0 || $lstOrder == null)
                <tr class="text-center">
                    <td colspan="7">Không có dữ liệu</td>
                </tr>
                @else
                @foreach($lstOrder as $od)
                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{$od->name}}</td>
                    <td>{{$od->phone}}</td>
                    <td>{{$od->note}}</td>
                    @if($od->status == 0)
                    <td class="text-warning">Đang chờ xác nhận</td>
                    @elseif($od->status == 1)
                    <td class="text-primary">Đã xác nhận</td>
                    @elseif($od->status == 2)
                    <td class="text-success">Đã thanh toán</td>
                    @elseif($od->status == 3)
                    <td class="text-danger">Đã hủy</td>
                    @endif
                    <td>{{$od->total_price}}</td>
                    <td>{{$od->created_at}}</td>
                    <td>
                        <a data-toggle="modal" data-target="" data-placement="top" title="Chỉnh sửa thông tin." class="cursor-pointer" onclick="orderDetail('{{$od->id}}')">
                            <i class="btnEdit fa fa-fw fa-edit"></i>
                        </a>
                        <a data-toggle="" data-placement="top" title="Xóa đơn hàng." class="cursor-pointer" data-target="" onclick="">
                            <i class="btnDelete fa fa-fw fa-trash-o text-danger"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
            <div class="row">{{ $lstOrder->links() }}</div>
    </div>

</div>
@endsection

@section('modal')
<div id="mddetaiOD"></div>
@endsection
@section('script')
<script type="text/javascript">
    //Hiển thị chi tiết đơn hoàng
    function orderDetail(id) {
        $('#modalLoad').modal('show');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('orderDetail')}}",
            data: {
                id: parseInt(id)
            },
            type: "GET",
            success: function(res) {
                $('#modalLoad').modal('hide');
                $('#mddetaiOD').html(res);
                $('#mdOrderDetail').modal('show');
            }
        })

    }

    function searchOrder(){
        var name = $.trim($('#Odname').val());
        var fromDate = $.trim($('#fromDate').val());
        var toDate = $.trim($('#toDate').val());
        var status = $('#valStaus').val();
         $('#modalLoad').modal('show');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('Order.search')}}",
            data: {
                name,
                fromDate,
                toDate,
                status
            },
            type: "GET",
            success: function(res) {
                $('#modalLoad').modal('hide');
                $('#TableOrder').html(res);

            }
        })
    }
</script>
@endsection
