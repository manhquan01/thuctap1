@extends('Admin.index')
@section('title', 'Membership')
@section('content')
    <div class="row table-responsive">
        <table class="table table table-hover m-0" id="table_data">
            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone munber</th>
                <th>Activated</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($members as $member)
                <tr>
                    <td>{{$member->name}}</td>
                    <td>{{$member->email}}</td>
                    <td>{{$member->phone_number}}</td>
                    <td>
                        <input type="checkbox" id="switch{{$member->id}}" data-switch="none"
                               @if($member->activated == 1) checked @endif value="{{$member->activated}}">
                        <label for="switch{{$member->id}}" data-on-label="On" data-off-label="Off"
                               onclick="change_activated({{$member->id}})"></label>
                    </td>
                    <td>
                        <div style="display: inline-block">
                            <button onclick="click_edit_btn(this)" data-toggle="modal" data-target="#con-close-modal"
                                    class="btn_edit">
                                <i class="ion-edit"></i>
                            </button>
                            <button onclick="destroy()" class="btn_del">
                                <i class="ion-trash-a"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div id="paginate" class="row">
        {{$members->links()}}
    </div>
@endsection

@section('script')
    <script>
        function change_activated(id) {
            var check_activated_user = $("#switch" + id).val();
            if (confirm('Are you sure continue change?')) {
                return $.ajax({
                    type: "GET",
                    url: "{{asset(route('admin.member.activated'))}}",
                    data: {id: id},
                    success: function (data) {
                        $("#switch" + id).val(data);
                        if (data == 0) {
                            $("#switch" + id).removeAttr('checked');
                        } else {
                            $("#switch" + id).attr('checked', true);
                        }
                    }
                });
            } else {
                location.reload();
            }

        }

        // $.getJSON('http://laravel.local/api/v1/user/', function (data) {
        //     console.log(data.data[0].name);
        //     data['data'].forEach(function (e) {
        //         console.log(e);
        //     });
        //     $.each(data, function (index, value) {
        //         console.log(value);
        //     });
        //
        // })
    </script>
@endsection

@section('style')
    <style type="text/css">
        table thead th {
            text-align: center;
        }

        table tbody td {
            text-align: center;
        }

        .btn_edit {
            border: none;
            background: transparent;
            float: left;
        }

        .btn_del {
            border: none;
            background: transparent;
            float: left;
        }

        #paginate {
            text-align: center;
        }

    </style>
@endsection
