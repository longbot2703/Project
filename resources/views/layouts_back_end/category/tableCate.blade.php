<table style="text-align:center" class="table table-bordered table-hover mt-2 w-100">
    <thead>
        <tr>
            <th style="text-align:center">STT</th>
            <th style="text-align:center">Tên danh mục</th>
            <th style="text-align:center">Ảnh danh mục</th>
            <th style="text-align:center">Ngày tạo</th>
            <th style="text-align:center">Chức năng</th>
        </tr>
    </thead>
    <tbody>
        @if($lsCategory == null)

        <tr class="text-center">
            <td collapse="5">Không có dữ liệu</td>
        </tr>
        @else
        @foreach($lsCategory as $category)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td class="cat_name">{{$category->cat_name}}</td>

            <td class="imgUrl">
                <div class="col-md-3"><img src="{{asset('images/$category->imgUrl')}}" style="height:100px;" /></div>
            </td>
            <td>{{date('d-m-Y',strtotime($category->created_at))}}</td>
            <td style="text-align:center">
                <button id="{{$category->cat_id}}" type="button" class="btn btn-success" onclick="loadCatDetail($(this));" data-toggle="modal" data-target="#myModal" title="Sửa Danh Mục">
                    <i class="fa fa-pencil"></i>
                </button>
                <button type="button" class="btn btn-danger" title="Xóa Danh Mục" onclick="delCat({{$category->cat_id}})">
                    <i class="fa fa-trash-o"></i>
                </button>
            </td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>

<div class="row">
    {{$lsCategory->links()}}
</div>
