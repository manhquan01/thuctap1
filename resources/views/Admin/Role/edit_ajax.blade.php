<form method="post" action="{{asset(route('admin.role.update',$userID))}}">
    {{csrf_field()}}
    <div>
        <div class="inbox-item">
            <div class="form-group">
                <select name="role" class="form-control" required>
                    <option value="">Select role</option>
                    @foreach($role as $item)
                        <option value="{{$item['id']}}">{{$item['display_name']}}</option>
                    @endforeach
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

<form method="post" action="{{asset(route('admin.role.delete',$userID))}}" id="delRole">
    {{csrf_field()}}
</form>
