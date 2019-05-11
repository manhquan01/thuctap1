@extends('Admin.index')
@section('title', 'Add Post')
@section('content')
    <div class="col-md-10 col-md-offset-1">
        <div class="p-20">
            <div class="">
                <form method="post" action="{{asset(route('store_new_post'))}}">

                    <div class="row">
                        <div class="form-group m-b-20 col-md-10 col-sm-12 col-xs-12">
                            <label for="exampleInputEmail1">Post Title</label>
                            <input type="text" name="title" class="form-control" id="exampleInputEmail1"
                                   placeholder="Enter title" required="">
                        </div>

                        <div class="btn-switch btn-switch-primary col-md-2 col-sm-12 col-xs-12"
                             style="margin-top: 25px;">
                            <input type="checkbox" name="featured" value="1" id="input-btn-switch-primary">
                            <label for="input-btn-switch-primary"
                                   class="btn btn-rounded btn-primary waves-effect waves-light">
                                <em class="glyphicon glyphicon-ok"></em>
                                <strong>Feature</strong>
                            </label>
                        </div>
                    </div>
                    <div class="form-group m-b-20">
                        <label for="exampleInputEmail1">Static Link</label>
                        <input type="text" name="static_link" class="form-control" id="exampleInputEmail1"
                               placeholder="Static Link">
                    </div>

                    <div class="form-group m-b-20">
                        <label>Post Category</label>
                        <select class="select2 form-control" required="" name="category">
                            <option value="">-- Select a category for your post --</option>
                            @foreach($all_cate as $item)
                                <option value="{{$item['id']}}">{{$item['cate_name']}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group m-b-20">
                        <label>Description</label>
                        <div>
                            <textarea class="ckeditor" name="descript" required=""> </textarea>
                        </div>
                    </div>

                    <div class="form-group m-b-20">
                        <label>File Uploads</label>
                        <input value="" hidden="" id="thumbnail" name="thumbnail" type="text">
                        <button type="button" id="ckfinder-modal-1" class="button-a button-a-background">Choose
                            thumbnail
                        </button>
                        <button type="button" hidden id="clear_image">clear</button>
                        <img src="" id="ckfinder-input-1" width="300px">
                    </div>
                    <input name="status" type="text" hidden value="" id="input_status">
                    @if( Auth::user()->role !== 1)
                        <button type="submit" id="save_post" class="btn btn-info waves-effect waves-light">Save and
                            Post
                        </button>
                    @endif
                    <button type="submit" id="save_draft" class="btn btn-danger waves-effect waves-light">Save as
                        draft
                    </button>
                    {{csrf_field()}}
                </form>
            </div>
        </div> <!-- end p-20 -->
    </div> <!-- end col -->

@endsection

@section('script')
    <script type="text/javascript">


    </script>
    <script>

        CKEDITOR.replace('descript', {
            filebrowserImageBrowseUrl: '/plugins/ckfinder/ckfinder.html',
            filebrowserImageUploadUrl: '/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
        });

        var button1 = document.getElementById('ckfinder-modal-1');

        button1.onclick = function () {
            selectFileWithCKFinder('ckfinder-input-1');
        };

        function selectFileWithCKFinder(elementId) {
            CKFinder.modal({
                chooseFiles: true,
                width: 800,
                height: 600,
                onInit: function (finder) {
                    finder.on('files:choose', function (evt) {
                        var file = evt.data.files.first();
                        var output = document.getElementById(elementId);
                        output.setAttribute('src', file.getUrl());
                        document.getElementById('thumbnail').value = file.getUrl();
                        $('#clear_image').attr('hidden', false);
                        $('#ckfinder-modal-1').attr('hidden', true);

                    });

                    finder.on('file:choose:resizedImage', function (evt) {
                        var output = document.getElementById(elementId);
                        output.setAttribute('src', evt.data.resizedUrl);
                        document.getElementById('thumbnail').value = evt.data.resizedUrl;
                        $('#clear_image').attr('hidden', false);
                        $('#ckfinder-modal-1').attr('hidden', true);

                    });
                }
            });
        }

        $('#clear_image').click(function () {
            $('#ckfinder-input-1').attr('src', '');
            $('#thumbnail').val('');
        });

        $('#clear_image').click(function () {
            $('#clear_image').attr('hidden', true);
            $('#ckfinder-modal-1').attr('hidden', false);

        });

        // set status = posted
        $('#save_post').click(function () {
            var user_role = "{{Auth::user()->role}}";
            if (user_role !== 1) {
                $('#input_status').val(0);
            } else {
                $('#input_status').val(2);
            }
        });

        // set status = draft
        $('#save_draft').click(function () {
            $('#input_status').val(2);
        });


    </script>

@endsection

@section('style')

@endsection
