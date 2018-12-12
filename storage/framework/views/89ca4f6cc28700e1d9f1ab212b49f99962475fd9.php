<div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Update category</h4>
            </div>
            <form method="post" id="edit_cate" action="<?php echo e(route('update_menu_item')); ?>">
                <?php echo e(csrf_field()); ?>

                <input name="cate_id" type="hidden" value="" id="id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="control-label">Name Category</label>
                                <input form="edit_cate" type="text" required class="form-control" name="cate_name" id="name" placeholder="Category name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="slug" class="control-label">Static Link</label>
                                <input form="edit_cate" type="text" class="form-control" name="cate_slug" id="slug" placeholder="Static link">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    <button form="edit_cate" onclick="update_cate()" type="button" class="btn btn-info waves-effect waves-light">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div><!-- /.modal -->