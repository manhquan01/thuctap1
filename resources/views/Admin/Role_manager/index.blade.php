@extends('Admin.index')
@section('title', 'Role Manager')
@section('content')
    <table class="table table table-hover m-0">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <thead>
        <tr>
            <th>#</th>
            <th>Role name</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($roles as $item)
            <tr>
                <td>{{$item['id']}}</td>
                <td>{{$item['display_name']}}</td>
                <td>{{$item['description']}}</td>
                <td>
                    <div style="display: inline-block">
                        <a href="{{asset(route('admin.rolemanager.edit',$item['id']))}}">
                            <button class="btn_edit">
                                <i class="ion-edit"></i>
                            </button>
                        </a>
                        <a class="btn_delete" href="#">
                            <button class="btn_del">
                                <i class="ion-trash-a"></i>
                            </button>
                        </a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div id="paginate" class="row">
        {{$roles->links()}}
    </div>
@endsection

@section('style')
    <style>
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

@section('script')

@endsection
