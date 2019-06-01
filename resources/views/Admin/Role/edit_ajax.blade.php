<form method="post" action="{{asset(route('role_update',$user['id']))}}">
    {{csrf_field()}}
    <div>
        <div class="inbox-item">
            {{--<div class="inbox-item-img"><img src="assets/images/users/avatar-2.jpg" class="img-circle" alt=""></div>--}}
            {{--<p class="inbox-item-author">{{$user['name']}}</p>--}}
            {{--<p class="inbox-item-text">Administrator</p>--}}
            <div class="form-group">
                <select name="role" class="form-control" required>
                    <option value="">Select role</option>
                    <option value="0" @if($user['role'] == 0) selected @endif>Aministrator</option>
                    <option value="1" @if($user['role'] == 1) selected @endif>Editor</option>
                    <option value="2" @if($user['role'] == 2) selected @endif>Censor</option>
                </select>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <input form="delRole" type="submit" name="submit" value="Remove">
                </div>
                <div class="col-md-7 text-right">
                    <button type="submit">Update</button>
                </div>
            </div>

        </div>
    </div>
</form>

<form method="post" action="{{asset(route('role_delete',$user['id']))}}" id="delRole">
    {{csrf_field()}}
</form>
