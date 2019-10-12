@extends('Admin.index')
@section('title', 'Category')
@section('content')
@permission('create-category')
<div class="col-md-4">
    <form method="post" id="add_category" action="{{asset(route('admin.category.store'))}}">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="cate_name" class="control-label">Name Category</label>
                    <input form="add_category" type="text" class="form-control" name="cate_name" id="cate_name" placeholder="Category name">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="cate_slug" class="control-label">Static Link</label>
                    <input form="add_category" type="text" class="form-control" name="cate_slug" id="cate_slug" placeholder="Static link">
                </div>
            </div>
        </div>
        {{csrf_field()}}
        <button type="submit"
                {{--onclick="add_item_menu()" --}}
                form="add_category" class="btn btn-primary waves-effect w-md waves-light m-b-5"><i class="mdi mdi-plus"></i> Add category</button>
    </form>
</div>
@endpermission
<div class="col-md-8">
    <table class="table table table-hover m-0">
        <thead>
        <tr>
            <th>#</th>
            <th>Category Name</th>
            <th>Static Link</th>
            @permission('status-category')
            <th>Status</th>
            @endpermission
            @permission(['update-category','delete-category'])
            <th>Action</th>
            @endpermission
        </tr>
        </thead>
        <tbody id="tbody">
        @foreach($menu as $item)
        <tr class="tr" record-id="{{$item->id}}">
            <th>{{$stt--}}</th>
            <td headers="cate_name">{{$item->cate_name}}</td>
            <td headers="cate_slug">{{$item->cate_slug}}</td>
            @permission('status-category')
            <td>
                <input type="checkbox" id="switch{{$item->id}}" data-switch="none" @if($item->status == 1) checked @endif value="{{$item->status}}">
                <label for="switch{{$item->id}}" data-on-label="On" data-off-label="Off" onclick="change_status({{$item->id}})"></label>
            </td>
            @endpermission
            <td>
            @permission('update-category')
                <button onclick="click_edit_btn(this)" data-toggle="modal" data-target="#con-close-modal" class="btn_edit">
                    <i class="ion-edit"></i>
                </button>
            @endpermission
            @permission('delete-category')
                <button onclick="destroy({{$item->id}})" class="btn_del">
                    <i class="ion-trash-a"></i>
                </button>
            @endpermission
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
@include('Admin.Category.edit_category_modal', ['nemu' => $menu])
@endsection

@section('script')
    <script src="assets/pages/jquery.icons.js"></script>
    <script>

        // them moi mot item menu
        function add_item_menu()
        {
            location.reload();
            return $.ajax({
                type:"POST",
                url:"{{asset(route('admin.category.store'))}}",
                data: new FormData($('#add_category')[0]),
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {

                    var count = $('.tr').length;
                    parseInt(count);
                    count++;
                    var row = "<tr class=\"tr\" record-id=\""+data['id']+"\"> <th>"+count+"</th><td headers=\"cate_name\">"+data['cate_name']+"</td><td headers=\"cate_slug\">"+data['cate_slug']+"</td>" +
                        "<td>" +
                        "<input type=\"checkbox\" id=\"switch"+data['id']+"\" data-switch=\"none\" value=\""+data['status']+"\">\n" +
                        "<label for=\"switch"+data['id']+"\" data-on-label=\"On\" data-off-label=\"Off\" onclick=\"change_status("+data['id']+")\"></label>" +
                        "</td>\n" +
                        "<td>\n" +
                        "<button onclick=\"click_edit_btn(this)\" data-toggle=\"modal\" data-target=\"#con-close-modal\" class=\"btn_edit\">\n" +
                        "<i class=\"ion-edit\"></i>\n" +
                        "</button>\n" +
                        "<button onclick=\"destroy("+data['id']+")\" class=\"btn_del\">\n" +
                        "<i class=\"ion-trash-a\"></i>\n" +
                        "</button>" +
                        "</td></tr>";
                    $('#cate_name').val('');
                    $('#cate_slug').val('');
                    $('#tbody').prepend(row);
                    if (data['status'] == 1){
                        $("#switch"+data['id']).prop("checked", true);
                    }

                }
            });
        }
        // lay thong tin cua item muon sua
        function click_edit_btn(object)
        {
            var record_id = $(object).closest('tr').attr('record-id');
            var cate_name = $(object).closest('tr').find('td[headers="cate_name"]').html();
            var cate_slug = $(object).closest('tr').find('td[headers="cate_slug"]').html();

            $('#id').val(record_id);
            $('#name').val(cate_name);
            $('#slug').val(cate_slug);
        }

        function update_cate() {
            return $.ajax({
                type:"POST",
                url:"{{asset(route('admin.category.update'))}}",
                data: new FormData($('#edit_cate')[0]),
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    $('#con-close-modal').modal('toggle');
                    $('tr[record-id="'+data['id']+'"] td[headers="cate_name"]').text(data['cate_name']);
                    $('tr[record-id="'+data['id']+'"] td[headers="cate_slug"]').text(data['cate_slug']);
                }
            });
        }

        function destroy(cate_id) {
            if (confirm('Are you sure delete this category?')){
                return $.ajax({
                    type:"GET",
                    url:"{{asset(route('admin.category.destroy'))}}",
                    data: {id: cate_id},
                    async: false,
                    success: function (data) {
                        if (data === 'Can\'t delete this category because exist post in category.'){
                            alert("Can't delete this category because exist post in category.");

                        }else {
                            $('table tr[record-id="' + cate_id + '"]').remove();
                        }
                    },
                    error: function () {

                    }
                });
            }

        }

        function change_status(id){
            var status = $("#switch"+id).val();
            return $.ajax({
               type:"GET",
               url:"{{asset(route('admin.category.status'))}}",
               data: {id: id, val: status},
               success: function (data) {
                   $("#switch"+id).val(data);
               }
            });
        }
    </script>

@endsection

@section('style')
    <style type="text/css">
        .btn_edit{
            border: none;
            background: transparent;
            float: left;
        }

        .btn_del{
            border: none;
            background: transparent;
            float: left;
        }

    </style>
@endsection
