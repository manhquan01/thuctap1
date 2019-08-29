@extends('Admin.index')
@section('title', 'Edit Role & Attach Permission')
@section('content')

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="post" action="{{asset(route('admin.rolemanager.update',$role['id']))}}">
        <table class="table table-bordered m-0">
            <thead>
            <tr>
                <td rowspan="2">#</td>
                <td rowspan="2">Module</td>
                <td colspan="4">Permission</td>
            </tr>
            <tr>
                <td>Read</td>
                <td>Create</td>
                <td>Update</td>
                <td>Delete</td>
            </tr>
            </thead>
            <tbody>
            @foreach($permissions as $module => $permission)
                <tr>
                    <td>1</td>
                    <td>{{ucfirst($module)}}</td>
                    @foreach($permission as $item)

                        <td><input type="checkbox" name="permission[]"
                                   @foreach($role->role_permission as $r)
                                   @if($r->name == $item.'-'.$module) checked @endif
                                   @endforeach
                                   value="{{$item.'-'.$module}}">@if($item != 'read' && $item != 'create' && $item != 'update' && $item != 'delete') {{ucfirst($item). ' '. ucfirst($module)}} @endif
                        </td>

                    @endforeach
                </tr>
            @endforeach
            </tbody>
        </table>
        <button type="submit">Update</button>
        {{csrf_field()}}
    </form>

@endsection

@section('style')
    <style>

    </style>
@endsection

@section('script')

@endsection
