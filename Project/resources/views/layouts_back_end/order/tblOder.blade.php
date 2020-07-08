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
