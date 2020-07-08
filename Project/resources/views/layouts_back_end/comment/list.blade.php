
@extends('layouts_back_end.admin')

@section('content')

{{-- <div class="container" >
    <div class="row"> --}}
        <hr>
        <div class="panel panel-default widget">
            <div class="panel-heading">
                <span  class="glyphicon glyphicon-comment"></span>
                <h3 style="display:inline" class="panel-title">
                    Recent Comments</h3>
                    {{-- tổng sô comment trong span --}}
                <span style=" float: right;" class="label label-info">
                    78</span>
            </div>
            <div class="panel-body">
                <ul class="list-group">
                    {{-- mỗi trang tầm 5 comment --}}
                    {{-- các comment nhóm theo sản phẩm mới  --}}
                    {{-- @foreach ($collection as $item) --}}
                    <li class="list-group-item">
                        <div class="row">
                            @foreach ($lsComm as $Comm)
                            {{-- <div class="col-xs-2 col-md-1">
                                <img src="http://placehold.it/80" class="img-circle img-responsive" alt="" /></div> --}}
                            <div class="col-xs-10 col-md-11">

                                <div>
                                    <a href="#">
                                        Google Style Login Page Design Using Bootstrap</a>
                                    <div class="mic-info">
                                        By: <a href="#">{{ $Comm->cus_name }}</a> on 2 Aug 2013
                                    </div>
                                </div>
                                <div class="comment-text">
                                    {{-- Nooij dung --}}
                                    {{ $Comm->comm_content }}
                                </div>
                                <div class="action">
                                    {{-- sửa --}}
                                    <button name="edit" type="button" class="btn btn-primary btn-xs" title="Edit">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                    </button>
                                    {{-- duyệt --}}
                                    <button name="approved" type="button" class="btn btn-success btn-xs" title="Approved">
                                        <span class="glyphicon glyphicon-ok"></span>
                                    </button>
                                    {{-- xoá --}}
                                    <button name="delete" type="button" class="btn btn-danger btn-xs" title="Delete">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </button>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </li>
                    {{-- @endforeach --}}
                </ul>
                {{-- cho nay làm phan trang đi --}}
                <a href="#" class="btn btn-primary btn-sm btn-block" role="button"><span class="glyphicon glyphicon-refresh"></span> More</a>
            </div>
        </div>
    {{-- </div>
</div> --}}

@endsection
