<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{--<meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">--}}
    {{--<meta name="author" content="Coderthemes">--}}
    <base href="{{asset('/')}}">

    <link rel="shortcut icon" href="frontend/assets/images/favicon.ico">

    <title>Zircos - @yield('title')</title>

    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="../plugins/morris/morris.css">

    <!-- App css -->
    <link href="frontend/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="frontend/assets/css/core.css" rel="stylesheet" type="text/css"/>
    <link href="frontend/assets/css/components.css" rel="stylesheet" type="text/css"/>
    <link href="frontend/assets/css/icons.css" rel="stylesheet" type="text/css"/>
    <link href="frontend/assets/css/pages.css" rel="stylesheet" type="text/css"/>
    <link href="frontend/assets/css/menu.css" rel="stylesheet" type="text/css"/>
    <link href="frontend/assets/css/responsive.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="../plugins/switchery/switchery.min.css">

    <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    {{--<script src="frontend/assets/js/modernizr.min.js"></script>--}}

</head>

<body>
<!-- Navigation Bar-->
<header id="topnav">
    <div class="topbar-main">
        <div class="container">

            <!-- Logo container-->
            <div class="logo">
                <!-- Text Logo -->
                <!--<a href="index.html" class="logo">-->
                <!--Zircos-->
                <!--</a>-->
                <!-- Image Logo -->
                <a href="{{asset(route('frontend_index'))}}" class="logo">
                    <img src="frontend/assets/images/logo.png" alt="" height="30">
                </a>
            </div>
            <div>
                <a href="{{asset(route('logout'))}}"><i class="ti-power-off m-r-5"></i> Logout</a>
            </div>
            <!-- End Logo container-->

            <div class="menu-extras">

                <div class="menu-item">
                    <!-- Mobile menu toggle-->
                    <a class="navbar-toggle">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </a>
                    <!-- End mobile menu toggle-->
                </div>
            </div>
            <!-- end menu-extras -->

        </div> <!-- end container -->
    </div>
    <!-- end topbar-main -->

    <div class="navbar-custom">
        <div class="container">
            <div id="navigation">
                <!-- Navigation Menu-->
                <ul class="navigation-menu">
                    <li class="has-submenu">
                        <a href="{{asset('/')}}">Home</a>
                    </li>
                    @foreach($category as $item)
                        <li class="has-submenu">
                            <a href="{{asset(route('frontend_category_post', ['slug' => $item->cate_slug]))}}">{{$item->cate_name}}</a>
                        </li>
                    @endforeach
                </ul>
                <!-- End navigation menu -->
            </div> <!-- end #navigation -->
        </div> <!-- end container -->
    </div> <!-- end navbar-custom -->
</header>
<!-- End Navigation Bar-->


<div class="wrapper">
    <div class="container">
        <div class="row">
            <div class="blog-list-wrapper">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="p-20">

                            @yield('content')

                        </div>

                    </div> <!-- end col -->

                    <div class="col-sm-4">
                        <div class="p-20">
                            <div class="">
                                <h4 class="text-uppercase">Search</h4>
                                <div class="border m-b-20"></div>
                                <div class="form-group search-box">
                                    <input type="text" id="search-input" class="form-control"
                                           placeholder="Search here...">
                                    <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
                                </div>
                            </div>

                            <div class="m-t-50">
                                <h4 class="text-uppercase">Categories</h4>
                                <div class="border m-b-20"></div>
                                <div class="blog-post-column" style="padding: 10px">
                                    <ul class="blog-categories-list list-unstyled">
                                        @foreach($category as $item)
                                            <li>
                                                <a href="{{asset(route('frontend_category_post', ['slug' => $item->cate_slug]))}}">{{$item->cate_name}}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                            <div class="m-t-50 ">
                                <h4 class="text-uppercase">Latest Post</h4>
                                <div class="border m-b-20"></div>
                                <div class="blog-post-column" style="padding: 10px">
                                    @foreach($pin as $val)
                                        <div class="media latest-post-item ">
                                            <div class="media-left">
                                                <img src="{{$val['thumbnail']}}" alt="" class="media-object"
                                                     style=" display:block; width: 100px; height: 66px; object-fit: cover">
                                            </div>
                                            <div class="media-body">
                                                <h5 class="media-heading"><a href="{{asset(route('frontend_article', ['slug' => $val['slug']]))}}">{{$val['title']}}</a></h5>
                                                <p class="font-13 text-muted">
                                                    {{$val['updated_at']}}
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>


                            <div class="m-t-50">
                                <h4 class="text-uppercase">Newsletter</h4>
                                <div class="border m-b-20"></div>

                                <form>
                                    <div class="input-group m-t-10">
                                        <input type="email" id="example-input2-group2" name="example-input2-group2"
                                               class="form-control" placeholder="Email">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn waves-effect waves-light btn-primary">Submit</button>
                                            </span>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
        </div>
        <!-- Footer -->
        <footer class="footer text-right">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        2018 © Quan Dao.
                    </div>
                </div>
            </div>
        </footer>
        <!-- End Footer -->

    </div>
</div>


<!-- jQuery  -->
<script src="frontend/assets/js/jquery.min.js"></script>
<script src="frontend/assets/js/bootstrap.min.js"></script>
<script src="frontend/assets/js/detect.js"></script>
<script src="frontend/assets/js/fastclick.js"></script>
<script src="frontend/assets/js/jquery.blockUI.js"></script>
<script src="frontend/assets/js/waves.js"></script>
<script src="frontend/assets/js/jquery.slimscroll.js"></script>
<script src="frontend/assets/js/jquery.scrollTo.min.js"></script>
<script src="../plugins/switchery/switchery.min.js"></script>

<!-- Counter js  -->
<script src="../plugins/waypoints/jquery.waypoints.min.js"></script>
<script src="../plugins/counterup/jquery.counterup.min.js"></script>

<!--Morris Chart-->
{{--<script src="../plugins/morris/morris.min.js"></script>--}}
<script src="../plugins/raphael/raphael-min.js"></script>

<!-- Dashboard init -->
{{--<script src="frontend/assets/pages/jquery.dashboard.js"></script>--}}

<!-- App js -->
<script src="frontend/assets/js/jquery.core.js"></script>
<script src="frontend/assets/js/jquery.app.js"></script>
@yield('script')
</body>
</html>