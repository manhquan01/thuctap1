<div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Update category</h4>
            </div>
            <form method="post" id="edit_category" action="{{route('update_category')}}">
                {{csrf_field()}}
                <input name="cate_id" type="hidden" value="" id="cate_id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="cate_name" class="control-label">Name Category</label>
                                <input form="edit_category" type="text" class="form-control" name="cate_name" id="cate_name" placeholder="Category name">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="cate_slug" class="control-label">Static Link</label>
                                <input form="edit_category" type="text" class="form-control" name="cate_slug" id="cate_slug" placeholder="Static link">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="cate_parent" class="control-label">Parent</label>
                                <select form="edit_category" class="form-control" name="cate_parent" id="cate_parent">

                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    <button type="button" onclick="update_category()" class="btn btn-info waves-effect waves-light">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div><!-- /.modal -->