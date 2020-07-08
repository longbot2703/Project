<div class="modal fade" id="mdOrderDetail" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Thông tin đơn hàng</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-5 col-md-5 col-lg-5">
                        <label class="text-dark">Tên khách hàng:</label>
                    </div>
                    <div class="col-sm-7 col-md-7 col-lg-7">{{$data->name}}</div>
                </div>
                <div class="row" style="margin-top:10px;">
                    <div class="col-sm-5 col-md-5 col-lg-5"><label class="text-dark">Số điện thoại khách hàng:</label></div>
                    <div class="col-sm-7 col-md-7 col-lg-7">{{$data->phone}}</div>
                </div>
                <div class="row" style="margin-top:10px;">
                    <div class="col-sm-5 col-md-5 col-lg-5"><label class="text-dark">Địa chỉ khách hàng:</label></div>
                    <div class="col-sm-7 col-md-7 col-lg-7">{{$data->addres}}</div>
                </div>
                <div class="row" style="margin-top:10px;">
                    <div class="col-sm-5 col-md-5 col-lg-5"><label class="text-dark">Email khách hàng:</label></div>
                    <div class="col-sm-7 col-md-7 col-lg-7">{{$data->email}}</div>
                </div>

                <div class="row" style="margin-top:10px;">
                    <div class="col-sm-5 col-md-5 col-lg-5"><label class="text-dark">Ghi chú khách hàng:</label></div>
                    <div class="col-sm-7 col-md-7 col-lg-7"><label class="text-primary">{{$data->note}}</label></div>
                </div>
                <div class="row" style="margin-top:10px;">
                    <div class="col-sm-5 col-md-5 col-lg-5"><label class="text-dark">Tổng tiền:</label></div>
                    <div class="col-sm-7 col-md-7 col-lg-7">
                        <h5 class="text-danger">{{number_format($data->total_price)}}</h5>
                    </div>
                </div>
                <div class="row" style="margin-top:10px;">
                    <div class="col-sm-5 col-md-5 col-lg-5"><label class="text-dark">Trạng thái đơn hàng:</label></div>
                    <div class="col-sm-7 col-md-7 col-lg-5">
                        <select class="form-control" id="valStatus">
                            <option value="0">Chờ xác nhận</option>
                            <option value="1">Xác nhận</option>
                            <option value="2">Thanh toán</option>
                            <option value="3" class="text-danger">Hủy</option>
                        </select>
                    </div>
                </div>

                <div class="row" style="margin-top:50px;">
                    <table style="text-align:center" class="table table-bordered table-hover mt-2 w-100">
                        <thead>
                            <tr class="text-center">
                                <th>STT</th>
                                <th class="text-center">Tên sản phẩm</th>
                                <th class="text-center">Số lượng</th>
                                <th class="text-center">Giá sản phẩm</th>
                                <th class="text-center">Tổng</th>
                                <th class="text-center">Giá sau khi giảm</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lstItem as $it)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{$it->name}}</td>
                                <td>{{$it->quantity}}</td>
                                <td>{{number_format($it->price)}}</td>
                                <td>{{number_format($it->sumprice)}}</td>
                                <td>{{number_format($it->sumpriceDiscount)}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="btn-save" onclick="saveChangeStatusBill('{{$data->id}}')"><i class="fa fa-save"></i>Lưu</button>
                    <button type="button" class="btn btn-primary" id="btn-export-excel" onclick="exportExcelBill('{{$data->id}}')"><i class="fa fa-download"></i>Xuất hóa đơn</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#valStatus').val(parseInt('{{$data->status}}'));
        if (parseInt('{{$data->status}}') == 2 || parseInt('{{$data->status}}') == 3) {
            $('#valStatus').attr('disabled', true);
            $('#btn-save').hide();
        } else {
            $('#valStatus').attr('disabled', false);
            $('#btn-save').show();
        }
        if (parseInt('{{$data->status}}') == 2) {
            $('#btn-export-excel').show();
        } else {
            $('#btn-export-excel').hide();
        }
    });

    //Sửa đơn hàng
    function saveChangeStatusBill(id) {
        var status = $('#valStatus').val();
        $('#modalLoad').modal('show');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('saveEdit')}}",
            data: {
                id: parseInt(id),
                status: status
            },
            type: "POST",
            success: function(res) {
                $('#modalLoad').modal('hide');
                $('#mdOrderDetail').modal('hide');
                if (res.status == 1) {
                    swal({
                        title: res.message,
                        text: "",
                        icon: "success"
                    }).then((success) => {
                        if (success) {
                            location.reload();
                        }
                    })
                } else {
                    swal({
                        title: res.message,
                        text: "",
                        icon: "error"
                    })
                }
            }
        })
    }

    //Xuất excel đơn hàng

    function exportExcelBill(id) {
        var valID = parseInt(id);
        $('#modalLoad').modal('show');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: window.location = "exportExcel?id=" + valID,
            success: function(res) {
                $('#modalLoad').modal('hide');
            }
        })
    }
</script>