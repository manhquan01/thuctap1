@extends('Admin.index')
@section('title', 'Post')
@section('content')
    <form method="post" id="search_form" action="{{asset(route('search_post'))}}">
        {{csrf_field()}}
    </form>
    <form id="form_show" method="post" action="">
        <div class="row">
            <div class="col-md-8 col-sm-6 col-xs-6" id="btn_destroy">
            </div>

            <div class="col-md-2 col-sm-6 col-xs-6 text-right">
                <a href="{{asset(route('create_new_post'))}}">
                    <button type="button" class="btn btn-primary waves-effect w-md waves-light m-b-5"><i class="mdi mdi-plus"></i> Write new post</button>
                </a>
            </div>

            <div class="col-md-2">
                <div class="form-group search-box">
                    <input type="text" name="key_word" id="search-input" class="form-control" placeholder="Search here..." form="search_form">
                    <button type="submit" class="btn btn-search" form="search_form"><i class="fa fa-search"></i></button>
                </div>
            </div>

        </div>
        {{csrf_field()}}
        <div class="row table-responsive">
            <table class="table m-0">
                <thead>
                <tr>
                    <th><input type="checkbox" id="check_all"></th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Author</th>
                    <th>Comment</th>
                    <th>Update at</th>
                    <th>Status</th>
                </tr>
                </thead>


                <tbody>
                @foreach($all_post as $item)
                    <tr>
                        <td align="center" width="35px"><input type="checkbox" value="{{$item->id}}" name="id[]" class="checkitem"></td>
                        <td width="50%"><a href="{{asset(route('edit_post', ['id' => $item->id]))}}">{{$item['title']}}</a></td>
                        <td >{{$item->category->cate_name}}</td>
                        <td>{{$item->user->name}}</td>
                        <td><i class="glyphicon glyphicon-comment">10</i></td>
                        <td>{{$item['updated_at']}}</td>
                        <td>
                            @foreach($status_post as $key => $status)
                                @if($key == $item['status'])
                                    @switch($item['status'])
                                        @case(0)
                                        <span class="label label-success">{{$status}}</span>
                                        @break
                                        @case(1)
                                        <span class="label label-danger">{{$status}}</span>
                                        @break
                                        @case(2)
                                        <span class="label label-warning">{{$status}}</span>
                                        @break
                                    @endswitch
                                @endif
                            @endforeach
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </form>



@endsection

@section('style')
    <style type="text/css">
        /*#datatable_paginate{*/
        /*position: relative;*/
        /*}*/
        /*.pagination{*/
        /*margin: 0;*/
        /*position: absolute;*/
        /*right: 0px;*/
        /*}*/
        /*#datatable_filter{*/
        /*position: relative;*/
        /*}*/
        #datatable_filter label{
            position: absolute;
            right: 0px;
        }

        #paginate{
            text-align: center;
        }

    </style>
@endsection

@section('script')
    <!-- init -->
    <script src="assets/pages/jquery.datatables.init.js"></script>

    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables/dataTables.bootstrap.js"></script>

    <script src="../plugins/datatables/dataTables.buttons.min.js"></script>
    <script src="../plugins/datatables/buttons.bootstrap.min.js"></script>
    <script src="../plugins/datatables/jszip.min.js"></script>
    <script src="../plugins/datatables/pdfmake.min.js"></script>
    <script src="../plugins/datatables/vfs_fonts.js"></script>
    <script src="../plugins/datatables/buttons.html5.min.js"></script>
    <script src="../plugins/datatables/buttons.print.min.js"></script>
    <script src="../plugins/datatables/dataTables.fixedHeader.min.js"></script>
    <script src="../plugins/datatables/dataTables.keyTable.min.js"></script>
    <script src="../plugins/datatables/dataTables.responsive.min.js"></script>
    <script src="../plugins/datatables/responsive.bootstrap.min.js"></script>
    <script src="../plugins/datatables/dataTables.scroller.min.js"></script>
    <script src="../plugins/datatables/dataTables.colVis.js"></script>
    <script src="../plugins/datatables/dataTables.fixedColumns.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#datatable').dataTable();
        });
        TableManageButtons.init();

        $('.checkitem').change(function () {
            var count = 0;

            $('.checkitem').each(function () {
                if ($(this).is(':checked')){
                    count++;
                }
            });

            if (count>0)
            {
                $('#btn_destroy').html('<button type="submit" onclick="destroy_post()" id="destroy" class="btn btn-danger waves-effect w-md waves-light m-b-5"><i class="glyphicon glyphicon-trash"></i> Destroy</button>\n' +
                    '<button type="submit" onclick="status_posted()" id="posted" class="btn btn-info waves-effect w-md waves-light m-b-5"><i class="glyphicon glyphicon-send"></i> Post</button>');
            }else{
                $('#destroy').hide();
                $('#posted').hide();
            }
        });

        $('#check_all').change(function(){
            $('.checkitem').prop('checked', this.checked).trigger('change');
        });

        function destroy_post(){
            $('#form_show').attr('action', '{{asset(route('destroy_post'))}}');
        }

        function status_posted(){
            $('#form_show').attr('action', '{{asset(route('stranfer_status_posted'))}}');
        }

    </script>



@endsection
