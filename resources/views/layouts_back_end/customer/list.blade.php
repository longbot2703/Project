@extends('layouts_back_end.admin');

@section('content')


<div class="col-md-12" >
  <div class="breadcrumb-holder">
    <div class="row mb-3 mt-3">
      <div class="col-md-10 col-sm-10 col-9 text-dark px-0" style="margin-top: 50px">
        <h1><i class="fa fa-fw fa-circle"></i> Quản lý khách hàng</h1>
      </div>
    </div>
  </div>
</div>
<div class="row mb-2">
  <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
    <input type="text" id="cus-name" class="form-control" placeholder="Nhập tên hoặc số điện thoại khách hàng" />
  </div>

  <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
    <input type="text" id="fromDateCus" class="form-control relative-icon-calendar date" placeholder="Từ ngày" />
    <i class="fa fa-calendar absolute-icon-calendar"></i>
  </div>
  <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
    <input type="text" id="toDateCus" class="form-control relative-icon-calendar date" placeholder="Đến ngày" />
    <i class="fa fa-calendar absolute-icon-calendar"></i>
  </div>
  <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 text-right">
    <button class="btn btn-success" id="btnSearchCus" onclick="searchCus()"><i class="fa fa-search mr-1"></i>Tìm kiếm</button>
  </div>
</div>

<div class="row mt-5" style="margin-top:20px;">
  <div class="col-md-12">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th class="text-center">STT</th>
          <th class="text-center">Họ và Tên</th>
          <th class="text-center">Email</th>
          <th class="text-center">Số Điện Thoại</th>
          <th class="text-center">Địa Chỉ</th>
          <th class="text-center">Hành Động</th>
        </tr>
      </thead>
      <tbody>
        @foreach($lsCustomer as $customer)
        <tr>
          <td class="text-center">{{$customer->cus_id}}</td>
          <td class="cus_name text-center">{{$customer->cus_name}}</td>
          <td class="cus_email text-center">{{$customer->cus_email}}</td>
          <td class="cus_phone text-center">{{$customer->cus_phone}}</td>
          <td class="cus_addres text-center">{{$customer->cus_addres}}</td>
          <td class="text-center">
            <a id="{{$customer->cus_id}}" onclick="loadCusDetail($(this))"><i class="fa fa-edit text-success"></i></a>
            <a onclick="delCus('{{$customer->cus_id}}')"><i class="fa fa-trash text-danger"></i></a>
          </td>
          <!-- <td class="form-group">
                    <a href="{{route('customer_manage.edit', $customer->cus_id)}}" class="button">Edit</a></i></a>
                    <form class="" action="{{route('customer_manage.destroy', $customer->cus_id)}}"
                      method="POST" onsubmit="return ConfirmDelete()">
                      @csrf
                      <input type="hidden" name="_method" value="DELETE">
                      <input type="submit" name=""  value="Delete">
                    </form>
                  </td> -->
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

{{$lsCustomer->links()}}

<!-- Modal -->
<div class="modal fade" id="cusDetail" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Thông tin khách hàng</h4>
      </div>
      <div class="modal-body">
        <div class="row" style="margin-top:10px;">
          <div class="col-md-5">
            <label class="text-dark">Tên khách hàng:</label>
          </div>
          <div class="col-md-7">
            <input type="text" id="txtName" class="form-control" />
            <input type="hidden" id="valIdCus" />
          </div>
        </div>
        <div class="row" style="margin-top:10px;">
          <div class="col-md-5">
            <label class="text-dark">Số điện thoại:</label>
          </div>
          <div class="col-md-7">
            <input id="txtPhone" class="form-control" >
          </div>
        </div>
        <div class="row" style="margin-top:10px;">
          <div class="col-md-5">
            <label class="text-dark">Email:</label>
          </div>
          <div class="col-md-7">
            <input id="txtEmail" class="form-control" >
          </div>
        </div>
        <div class="row" style="margin-top:10px;">
          <div class="col-md-5">
            <label class="text-dark">Địa chỉ:</label>
          </div>
          <div class="col-md-7">
            <input id="txtAddress" class="form-control" >
          </div>
        </div>
      </div>

  </div>
</div>

<script type="text/javascript">
  // load thông tin khách hàng

  function loadCusDetail(data) {
    var thiss = data.closest('tr');
    var id = data.attr('id');
    var name = thiss.children('.cus_name').text();
    var phone = thiss.children('.cus_phone').text();
    var email = thiss.children('.cus_email').text();
    var addres = thiss.children('.cus_addres').text();
    $('#txtName').val(name);
    $('#txtEmail').val(email);
    $('#txtAddress').val(addres);
    $('#txtPhone').val(phone);
    $('#valIdCus').val(id);
    $('#cusDetail').modal('show');

  }

  //Xóa khách hàng
  function delCus(id) {
    swal({
      title: "Bạn chắc chắn muốn xóa chứ?",
      text: "",
      icon: "warning",
      buttons: ['Cancel', 'OK']
    }).then((sure) => {
      if (sure) {
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: "customer_manage/destroy",
          data: {
            id
          },
          type: "delete",
          success: function(res) {
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
                icon: "error",
              })
            }
          }
        })
      }
    })
  }

//tim kiem khach hang
  function searchCus(){
    var name =$.trim($('#cus-name').val());
    var fromDateCus =$.trim($('#fromDateCus').val());
    var toDateCus =$.trim($('#toDateCus').val());
    
  }
</script>


@endsection
