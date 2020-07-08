 <table style="text-align:center" class="table table-bordered table-hover mt-2 w-100">
     <thead>
         <tr>
             <th style="text-align:center">STT</th>
             <th style="text-align:center">Tên sản phẩm</th>
             <th style="text-align:center">Giá sản phẩm</th>
             <th style="text-align:center">Danh mục </th>
             <th style="text-align:center">Số lượng</th>
             <th style="text-align:center">Ngày tạo</th>
             <th style="text-align:center">Chức năng</th>
         </tr>
     </thead>
     <tbody>
         @if(count($lstProduct) == 0 || $lstProduct == null)
         <tr class="text-center">
             <td colspan="7">Không có dữ liệu</td>
         </tr>
         @else
         @foreach($lstProduct as $pro)
         <tr>
             <td>{{$pro->pr_id}}</td>

             <td class="pr_name">{{$pro->pr_name}}</td>
             <td class="pr_price">{{$pro->pr_price}}</td>
             <td class="cat_name">{{$pro->cat_name}}</td>
             <td class="pr_quantity">{{$pro->pr_quantity}}</td>
             <td style="display: none;" class="pr_title">{{$pro->pr_title}}</td>
             <td style="display: none;" class="pr_des">{{$pro->pr_description}}</td>
             <td>{{date('d-m-Y',strtotime($pro->created_at))}} </td>


             <td style="text-align:center">
                 <button id="{{$pro->pr_id}}" type="button" class="btn btn-success" onclick="loadProDetail($(this));" data-toggle="modal" data-target="#myModal" title="Sửa sản phẩm">
                     <i class="fa fa-pencil"></i>
                 </button>
                 <button type="button" class="btn btn-danger" delid="{{$pro->pr_id}}" data-toggle="modal" data-target="#mdDelPro" title="Xóa sản phẩm" onclick="delPro($(this))">
                     <i class="fa fa-trash-o"></i>
                 </button>
             </td>
         </tr>
         @endforeach
         @endif
     </tbody>
 </table>