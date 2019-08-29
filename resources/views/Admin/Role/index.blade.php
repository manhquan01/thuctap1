@extends('Admin.index')
@section('title', 'Role')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @elseif(session('sucess'))
        <div class="alert alert-success">
            <ul>
                <li>{{ session('sucess') }}</li>
            </ul>
        </div>
    @endif
    <div class="col-md-4">
        <h4>Specify a new role on the Page</h4>
        <form method="post" id="add_category" class="form-horizontal" action="{{asset(route('admin.role.store'))}}">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="cate_name" class="col-md-2 control-label">Email</label>
                        <div class="col-md-10">
                            <input type="email" class="form-control" name="email" id="search-input" placeholder="Email"
                                   required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="cate_slug" class="col-md-2 control-label">Role</label>
                        {{--<input type="text" class="form-control" name="cate_slug" id="cate_slug" placeholder="Role">--}}
                        <div class="col-md-10">
                            <select name="role" class="form-control" id="select-box-role" required>
                                <option value="">Select role</option>
                                @foreach($role as $item)
                                <option value="{{$item['id']}}">{{$item['display_name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            {{csrf_field()}}
            <button type="submit" class="btn btn-primary waves-effect w-md waves-light m-b-5"><i
                        class="mdi mdi-plus"></i>Add
            </button>
        </form>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-5">
        <h4>Current role on the Page</h4>

        <div class="accordion">
            <h5>Super Administrator</h5>
            <div class="inbox-widget panel panel-default">
                @foreach($superadministrator as $sadmin)
                    <div id="user-{{$sadmin['id']}}">
                        <div class="inbox-item">
                            <div class="inbox-item-img"><img src="assets/images/users/avatar-2.jpg" class="img-circle"
                                                             alt=""></div>
                            <p class="inbox-item-author">{{$sadmin['name']}}</p>
                            <p class="inbox-item-text">{{$sadmin['email']}}</p>
                            @if($countAdmin == 1)
                                <p class="alert-danger">There must be at least one administrator on this Page. You can
                                    continue editing after adding an administrator.</p>
                            @else
                                <p class="inbox-item-date">
                                    <button data-parent=".accordion" data-toggle="collapse"
                                            href="#edit-user-{{$sadmin['id']}}" onclick="editRole({{$sadmin['id']}})"
                                            type="button" class="btn btn-xs btn-success btn-{{$sadmin['id']}}"><span
                                                class="glyphicon glyphicon-collapse-down"></span> Edit
                                    </button>
                                </p>
                            @endif
                        </div>
                    </div>
                    <div id="edit-user-{{$sadmin['id']}}"></div>
                @endforeach
            </div>

        </div>
        <div class="accordion">
            <h5>Administrator</h5>
            <div class="inbox-widget panel panel-default">
                @foreach($admins as $admin)
                    <div id="user-{{$admin['id']}}">
                        <div class="inbox-item">
                            <div class="inbox-item-img"><img src="assets/images/users/avatar-2.jpg" class="img-circle"
                                                             alt=""></div>
                            <p class="inbox-item-author">{{$admin['name']}}</p>
                            <p class="inbox-item-text">{{$admin['email']}}</p>
                            <p class="inbox-item-date">
                                <button data-parent=".accordion" data-toggle="collapse"
                                        href="#edit-user-{{$admin['id']}}" onclick="editRole({{$admin['id']}})"
                                        type="button" class="btn btn-xs btn-success btn-{{$admin['id']}}"><span
                                            class="glyphicon glyphicon-collapse-down"></span> Edit
                                </button>
                            </p>
                        </div>
                    </div>
                    <div id="edit-user-{{$admin['id']}}"></div>
                @endforeach
            </div>

        </div>
        <div class="accordion">
            <h5>Moderator</h5>
            <div class="inbox-widget panel panel-default">
                @foreach($censors as $censor)
                    <div id="user-{{$censor['id']}}">
                        <div class="inbox-item">
                            <div class="inbox-item-img"><img src="assets/images/users/avatar-2.jpg" class="img-circle"
                                                             alt=""></div>
                            <p class="inbox-item-author">{{$censor['name']}}</p>
                            <p class="inbox-item-text">{{$censor['email']}}</p>
                            <p class="inbox-item-date">
                                <button data-parent=".accordion" data-toggle="collapse"
                                        href="#edit-user-{{$censor['id']}}" onclick="editRole({{$censor['id']}})"
                                        type="button" class="btn btn-xs btn-success btn-{{$censor['id']}}"><span
                                            class="glyphicon glyphicon-collapse-down"></span> Edit
                                </button>
                            </p>
                        </div>
                    </div>
                    <div id="edit-user-{{$censor['id']}}"></div>
                @endforeach
            </div>

        </div>
        <div class="accordion">
            <h5>Editor</h5>
            <div class="inbox-widget panel panel-default">
                @foreach($editors as $editor)
                    <div id="user-{{$editor['id']}}">
                        <div class="inbox-item">
                            <div class="inbox-item-img"><img src="assets/images/users/avatar-2.jpg" class="img-circle"
                                                             alt=""></div>
                            <p class="inbox-item-author">{{$editor['name']}}</p>
                            <p class="inbox-item-text">{{$editor['email']}}</p>
                            <p class="inbox-item-date">
                                <button data-parent=".accordion" data-toggle="collapse"
                                        href="#edit-user-{{$editor['id']}}" onclick="editRole({{$editor['id']}})"
                                        type="button" class="btn btn-xs btn-success btn-{{$editor['id']}}"><span
                                            class="glyphicon glyphicon-collapse-down"></span> Edit
                                </button>
                            </p>
                        </div>
                    </div>
                    <div id="edit-user-{{$editor['id']}}"></div>
                @endforeach
            </div>

        </div>
    </div>

@endsection

@section('style')
    <style>
        .panel {
            border: none;
        }

        #select-box-role{
            width: 205px;
        }
    </style>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>

    <script>
        function editRole(id) {
            $("#edit-user-" + id).on("hide.bs.collapse", function () {
                $('.btn-' + id ).html('<span class="glyphicon glyphicon-collapse-down"></span> Edit');
            });
            $("#edit-user-" + id).on("show.bs.collapse", function () {
                $('.btn-' + id ).html('<span class="glyphicon glyphicon-collapse-up"></span> Close');
            });

            // $('.btn-'+id+' span').html('123');
            return $.ajax({
                type: "GET",
                url: "{{asset(route('admin.role.edit'))}}",
                data: {id: id},
                async: false,
                success: function (data) {
                    $('#edit-user-' + id).html(data);
                },
                error: function () {

                }
            });
        }

        $(document).ready(function () {
            var engine1 = new Bloodhound({
                remote: {
                    url: '/admin/uae/role/search?email=%QUERY%',
                    wildcard: '%QUERY%'
                },
                datumTokenizer: Bloodhound.tokenizers.whitespace('value'),
                queryTokenizer: Bloodhound.tokenizers.whitespace
            });

            $("#search-input").typeahead({
                hint: true,
                highlight: true,
                minLength: 1
            }, [
                {
                    source: engine1.ttAdapter(),
                    name: 'students-name',
                    display: function (data) {
                        return data.email;
                    },
                    templates: {
                        empty: [
                            '<div class="list-group search-results-dropdown"><div class="list-group-item">Nothing found.</div></div>'
                        ],
                        // header: [
                        //     '<div class="list-group search-results-dropdown"></div>'
                        // ],
                        suggestion: function (data) {
                            return '<div class="list-group-item">' + data.email + '</div>';
                        }
                    }
                },
            ]);

        });
    </script>


@endsection
