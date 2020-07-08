@extends('layouts_back_end.admin')

@section('content')
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Danh sách thành viên</li>
			</ol>
		</div><!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Danh sách thành viên</h1>
			</div>
		</div><!--/.row-->
			<div class="row mb-2">
				<div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
					<input type="text" id="name" class="form-control" placeholder="Nhập ID" />
				</div>
				<div id="toolbar" class="btn-group">
					<button class="btn btn-primary" id="btnSearchItem" onclick="searchItem()"><i class="fa fa-search mr-1"></i>Tìm kiếm</button>
				</div>
				<div id="toolbar" class="btn-group">
					<a href="{{route('user_manage.create')}}" class="btn btn-success">
						<i class="glyphicon glyphicon-plus"></i> Thêm thành viên
					</a>
				</div>
			</div>
		<div class="">
		</div>
		 <!-- them thanh vien -->

				<!-- tao bang -->
	<div class="row">
		<div class="col-md-12" id="TableCategory">
				<table style="text-align:center" class="table table-bordered table-hover mt-2 w-100">
				    <thead >
				        <tr >
				            <th style="text-align:center">ID</th>
				            <th style="text-align:center">Họ Tên</th>
							<th style="text-align:center">Email</th>
				            <th style="text-align:center">Quyền</th>
				            <th style="text-align:center" >Chức Năng</th>
				        </tr>
				    </thead>
				    <tbody >
						@foreach($lsUsers as $Users)
						<tr>
							<td>{{$Users->id}}</td>
							<td class="name-ep">{{$Users->name}}</td>
							<td class="email-ep">{{$Users->email}}</td>
								@if($Users->roles == 0)
						<td class="role-ep" data-id="{{$Users->roles}}"><span class="label label-danger">Adm</span></td> 	
								@else:
									<td class="role-ep" data-id="{{$Users->roles}}"><span class="label label-danger">Mem</span></td>
								@endif
								<td class="text-center">
									<a id="{{$Users->id}}" onclick="loadEmployeeDetail($(this))"><i class="fa fa-edit text-success"></i></a>
									<a onclick="delId('{{$Users->id}}')"><i class="fa fa-trash text-danger"></i></a>
								  </td>
						</tr>
						@endforeach
				    </tbody>
				</table>
				<div>{{$lsUsers -> links()}}</div>
				

	</div>	<!--/.main-->




@endsection

@section('script')
<script type="text/javascript">  
	 function delId(id) {
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
		 url: "user_manage/destroy",
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
			   if(success)  {
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



 //Load thông tin nhân viên

 function loadEmployeeDetail(data){
var thiss = data.closest('tr');
var id = data.attr('id');
var name = thiss.children('.name-ep').text();
var email = thiss.children('.email-ep').text();
var role = thiss.children('.role-ep').attr('data-id');

$('#txt-name-ep').val(name);
$('#txt-email-ep').val(email);
$('#roles').val(role);
$('#val-id-ep').val(id);
$('#employeeDetail').modal('show');

 }


 //SửA thông tin nhân viên

 function saveDetailEP(id){
	 var name = $.trim($('#txt-name-ep').val());
	 var email = $.trim($('#txt-email-ep').val());
	 var role = $.trim($('#roles').val());

	 if(name.length == 0 || email.length == 0){
		 swal({
			 title:"Vui lòng nhập đầy đủ thông tin!",
			 text:"",
			 icon:"warning",
		 })

		 return;
	 }

	 if(role == ""){
	   swal({
			 title:"Vui lòng chọn quyền cho nhân viên!",
			 text:"",
			 icon:"warning",
		 })

		 return;
	 }

	 $.ajax({
	   headers: {
		   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		 },
		 url:"user_manage/update",
		 data:{id,name,email,role},
		 type:"GET",
		 success:function(res){
			 if(res.status == 1){
			   swal({
				   title:res.message,
				 text:"",
				 icon:"success"
			   }).then((succes)=>{
				   if(success){
					   location.reload();
					   $('#employeeDetail').modal('hide');
				   }
				   
			   })
			 }
			 else{
				 swal({
					 title:res.message,
					 text:"",
					 icon:"error"
				 })
			 }
		 }

	 })
 }

</script>
@endsection
@section('modal')
 <!-- Modal -->
 <div class="modal fade" id="employeeDetail" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Thông tin nhân viên</h4>
        </div>
        <div class="modal-body">
          <div class="row">
			  <label class="text-dark">Tên nhân viên:</label>
			  <div class="col-sm-12 coil-md-12 col-lg-12">
				  <input type="hidden" id="val-id-ep"/>
				  <input class="form-control" placeholder="Nhập tên nhân viên" id="txt-name-ep"/>
			  </div>
		</div>

		<div class="row"style="margin-top:10px;"> 
			<label class="text-dark">Email:</label>
			<div class="col-sm-12 coil-md-12 col-lg-12">
				<input class="form-control" placeholder="Nhập tên nhân viên" id="txt-email-ep"/>
			</div>
		</div>

		<div class="row"style="margin-top:10px;"> 
			<label class="text-dark">Quyền:</label>
			<div class="col-sm-12 coil-md-12 col-lg-12">
				<select class="form-control" id="roles">
					<option value="" selected disabled hidden>--Quyền nhân viên--</option>
					<option value="0">Admin</option>
					<option value="1">Member</option>
				</select>
			</div>
		</div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" onclick="saveDetailEP($('#val-id-ep'))"><i class="fa fa-save" style="margin-right:2px;">lưu</i></button>
        </div>
      </div>
      
	</div>
 </div>
@endsection
