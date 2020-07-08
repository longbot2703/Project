<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fresh  Vegefoods - Administrator</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- an lam -->
    <!-- MetisMenu CSS -->
    <!-- <link href="{{ asset('css/metisMenu.min.css')}}" rel="stylesheet"> -->
    <!-- Timeline CSS -->
    <!-- <link href="{{ asset('css/timeline.css')}}" rel="stylesheet"> -->
    <!-- Custom CSS -->
    <!-- <link href="{{ asset('css/startmin.css')}}" rel="stylesheet"> -->
    <!-- Morris Charts CSS -->
    <!-- <link href="{{ asset('css/morris.css')}}" rel="stylesheet"> -->
    <!-- end an lamf -->

    <link href="{{ asset('css/bootstrap-theme.min.css')}}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-table.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="{{ asset('css/styles.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <!--Icons-->



    <!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><span>Team1 </span>Shop</a>
                <ul class="user-menu">
                    <li class="dropdown pull-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user">
                                <use xlink:href="#stroked-male-user"></use>
                            </svg> Admin <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#"><svg class="glyph stroked male-user">
                                        <use xlink:href="#stroked-male-user"></use>
                                    </svg> Hồ sơ</a></li>
                            <li><a href="#"><svg class="glyph stroked cancel">
                                        <use xlink:href="#stroked-cancel"></use>
                                    </svg> Đăng xuất</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

        </div><!-- /.container-fluid -->
    </nav>
    <div class="container-fluid">
        <div class="row">
            <div id="sidebar-collapse" class="col-md-2 sidebar">
                <ul class="nav menu" id="menu">
                    <li class="active li"><a href="{{ route('admin.Dashboard') }}"><svg class="glyph stroked dashboard-dial">
                                <use xlink:href="#stroked-dashboard-dial"></use>
                            </svg> Dashboard</a></li>
                    <li class="li"><a href="{{route('user_manage.index')}}"><svg class="glyph stroked male user ">
                                <use xlink:href="#stroked-male-user" /></svg>Quản lý thành viên</a></li>

                    <li class="li"><a href="{{route('cate_manage.index')}}"><svg class="glyph stroked open folder">
                                <use xlink:href="#stroked-open-folder" /></svg>Quản lý danh mục</a></li>

                    <li class="li"><a href="{{route('product_manage.index')}}"><svg class="glyph stroked bag">
                                <use xlink:href="#stroked-bag"></use>
                            </svg>Quản lý sản phẩm</a></li>

                    <li class="li"><a href="{{route('customer_manage.index')}}"><svg class="glyph stroked chain">
                                <use xlink:href="#stroked-chain" /></svg> Quản lý khách hàng</a></li>
                    <li class="li"><a href="{{route('order_manage.index')}}"><svg class="glyph stroked chain">
                                <use xlink:href="#stroked-chain" /></svg> Quản lý đơn hàng</a></li>
                </ul>

            </div>
            <!--/.sidebar-->
            <!-- Master Page -->

            <div class="col-md-10">
                @yield('content')


            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script type="text/javascript" src="{{asset('ckfinder/ckfinder.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/ready.js')}}"></script>
    <script type="text/javascript">
        var header = document.getElementById("menu");
        var btns = header.getElementsByClassName("li");
        for (var i = 0; i < btns.length; i++) {
            btns[i].addEventListener("click", function() {
                var current = document.getElementsByClassName("active");
                current[0].className = current[0].className.replace(" active", "");
                this.className += " active";
            });
        }
    </script>

    <!-- jQuery -->
    <!-- Bootstrap Core JavaScript -->

    <!-- Metis Menu Plugin JavaScript -->
    <!-- <script src="{{ asset('js/metisMenu.min.js')}}"></script> -->

    <!-- Morris Charts JavaScript -->
    <!-- <script src="{{ asset('js/raphael.min.js')}}"></script>
    <script src="{{ asset('js/morris.min.js')}}"></script>
    <script src="{{ asset('js/morris-data.js')}}"></script> -->

    <!-- Custom Theme JavaScript -->
    <!-- <script src="{{ asset('js/startmin.js')}}"></script> -->

    @yield('script')
</body>
@yield('modal')

<!-- Modal loading -->
<div class="modal" id="modalLoad" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content text-center py-3">
            <div class="modal-body text-center" style="height:120px;">
                <i class="fa fa-spinner text-success fa-spin" style="font-size: 40px;"></i>
                <div class="col-md-12 text-center mt-2">
                    <span>Đang xử lý</span>
                </div>
            </div>
        </div>
    </div>
</div>

</html>
