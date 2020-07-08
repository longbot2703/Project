@extends('layouts_back_end.admin');

@section('content')

	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li><a href="">Quản lý danh mục</a></li>
				<li class="active">Thêm danh mục</li>
			</ol>
		</div><!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Thêm danh mục</h1>
			</div>
		</div><!--/.row-->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-md-8">
                        	
                        <form role="form" action="{{route('admin.savecate')}}" method="post" enctype="multipart/form-data">
                        @csrf
                            <div class="modal-body">
                            <div class="row" style="margin-top:10px;">
                            <div class="col-md-5">
                                <label class="text-dark">Tên danh mục:</label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" id="txtNamecreate" name="cat_name" class="form-control" placeholder="Nhập tên danh mục" />
                                <input type="hidden" id="" />
                            </div>
                            </div>
                            <div class="row" style="margin-top:10px;">
                                <div class="col-md-5">
                                    <label class="text-dark">Ảnh danh mục:</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="file" id="pr_image" name="cat_image" value="" class="form-control">
                                </div>
                                <!-- Show image -->
                                <div class=form-row>
                                    <div class="row">
                                    <div class="col-sm-5">
                                        </div>
                                        <div class="col-sm-7" style="padding: 10px;">
                                            <img src="" id="category-img-tag" width="200px" />
                                            <!--for preview purpose -->
                                        </div>
                                    </div>
                                </div>
                                <!-- End show -->
                            </div>

                            
                            <button type="submit" class="btn btn-success">Thêm mới</button>
                            <button type="reset" class="btn btn-default">Làm mới</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div><!-- /.col-->
    </div>	<!--/.main-->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript">

        //Hiển thị ảnh sản phẩm
    $('#category-img-tag').hide();

    function readURL(input) {
    if (input.files && input.files[0]) {


        var reader = new FileReader();

        reader.onload = function(e) {
            $('#category-img-tag').show();
            $('#category-img-tag').attr('src', e.target.result);

        }

        reader.readAsDataURL(input.files[0]);
    }

    

}

$("#pr_image").change(function() {

    readURL(this);
});
//Tạo mới một sản phẩm
    </script>
@endsection

