@extends('Admin.index')
@section('title', 'Trash')
@section('content')
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            <strong>Well done!</strong> {{session('success')}}
        </div>
    @endif
<form id="form_trash" method="post" action="">
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-6" id="btn_destroy">
        </div>

        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
            <a href="{{asset(route('create_new_post'))}}">
                <button type="button" class="btn btn-primary waves-effect w-md waves-light m-b-5"><i class="mdi mdi-plus"></i> Write new post</button>
            </a>
        </div>
    </div>
    {{csrf_field()}}
    <div class="row table-responsive">
        <table class="table m-0" id="table_data">
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
    <div id="paginate" class="row">
        {{$all_post->links()}}
    </div>
</form>
@endsection

@section('style')
    <style type="text/css">
        #datatable_filter label{
            position: absolute;
            right: 0px;
        }

        #paginate{
            text-align: center;
        }

        #table_data tbody tr:hover{
            background: #F5F5F5;
        }
    </style>
@endsection

@section('script')
    <!-- init -->
    <script src="assets/pages/jquery.datatables.init.js"></script>

    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    {{--<script src="../plugins/datatables/dataTables.bootstrap.js"></script>--}}

    {{--<script src="../plugins/datatables/dataTables.buttons.min.js"></script>--}}
    {{--<script src="../plugins/datatables/buttons.bootstrap.min.js"></script>--}}
    {{--<script src="../plugins/datatables/jszip.min.js"></script>--}}
    {{--<script src="../plugins/datatables/pdfmake.min.js"></script>--}}
    {{--<script src="../plugins/datatables/vfs_fonts.js"></script>--}}
    {{--<script src="../plugins/datatables/buttons.html5.min.js"></script>--}}
    {{--<script src="../plugins/datatables/buttons.print.min.js"></script>--}}
    {{--<script src="../plugins/datatables/dataTables.fixedHeader.min.js"></script>--}}
    {{--<script src="../plugins/datatables/dataTables.keyTable.min.js"></script>--}}
    {{--<script src="../plugins/datatables/dataTables.responsive.min.js"></script>--}}
    {{--<script src="../plugins/datatables/responsive.bootstrap.min.js"></script>--}}
    {{--<script src="../plugins/datatables/dataTables.scroller.min.js"></script>--}}
    {{--<script src="../plugins/datatables/dataTables.colVis.js"></script>--}}
    {{--<script src="../plugins/datatables/dataTables.fixedColumns.min.js"></script>--}}

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
                $('#btn_destroy').html('<button onclick="delete_post()" type="button" id="destroy" class="btn btn-danger waves-effect w-md waves-light m-b-5 btn_action"><i class="glyphicon glyphicon-trash"></i> Delete</button>\n' +
                    '<button type="submit" onclick="restore_post()" id="restore" class="btn btn-success waves-effect w-md waves-light m-b-5 btn_action"><i class="glyphicon glyphicon-retweet"></i> Restore</button>');
            }else{
                $('.btn_action').hide();
            }
        });

        $('#check_all').change(function(){
            $('.checkitem').prop('checked', this.checked).trigger('change');
        });

        function restore_post(){
            $('#form_trash').attr('action', '{{asset(route('restore_post'))}}');
        }

        function delete_post(){
            var r = confirm('Are you sure delete this article?');
            if (r == true){
                $('#destroy').attr('type', 'submit');
                $('#form_trash').attr('action', '{{asset(route('delete_post'))}}');
            }

        }


    </script>



@endsection
