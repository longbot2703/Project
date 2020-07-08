@extends('layouts_back_end.admin');

@section('content')

	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
                <li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
                <li><a href="">Quản lý thành viên</a></li>
				<li class="active">Thêm thành viên</li>
			</ol>
		</div><!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Thêm thành viên</h1>
			</div>
        </div><!--/.row-->
        <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-md-8">
                            	@if(count($errors) > 0)
                                    <div class='alert alert-danger'>
                                @foreach($errors->all() as $er)
                                        <p>{{$er}}</p>
                                        @endforeach
                                    </div>
                                    @endif
                                <form method="post" action="{{route('user_manage.store')}}">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Ho va Ten</label>
                                     <input type="text" class="form-control" id="name" name="name" placeholder="Nhap Ten">
                                </div>
                                <div class="form-group">
                                    <label for="name">email</label>
                                     <input type="text" class="form-control" id="email" name="email" placeholder="Nhap email">
                                </div>
                                <div class="form-group">
                                    <label for="name">Mật Khẩu</label>
                                     <input type="text" class="form-control" id="password" name="password" placeholder="">
                                </div>
                            
                                <div class="form-group">
                                    <label>Quyền</label>
                                    <select name="roles" class="form-control">
                                        <option value=0>Admin</option>
                                        <option value=1>Member</option>
                                    </select>
                                </div>
                                <button name="sbm" type="submit" class="btn btn-success">Thêm mới</button>
                                <button type="reset" class="btn btn-default">Làm mới</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div><!-- /.col-->
            </div><!-- /.row -->

	</div>	<!--/.main-->

@endsection
