<?php $__env->startSection('title', 'Category'); ?>
<?php $__env->startSection('content'); ?>
<div class="col-md-4">
    <form method="post" id="add_category" action="<?php echo e(asset(route('store_menu_item'))); ?>">
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
        <?php echo e(csrf_field()); ?>

        <button type="button" onclick="add_item_menu()" form="add_category" class="btn btn-info waves-effect waves-light">Add category</button>
    </form>
</div>
<div class="col-md-8">
    <table class="table table table-hover m-0">
        <thead>
        <tr>
            <th>#</th>
            <th>Category Name</th>
            <th>Static Link</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody id="tbody">
        <?php $__currentLoopData = $menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr class="tr" record-id="<?php echo e($item->id); ?>">
            <th><?php echo e($stt--); ?></th>
            <td headers="cate_name"><?php echo e($item->cate_name); ?></td>
            <td headers="cate_slug"><?php echo e($item->cate_slug); ?></td>
            <td>
                <button onclick="click_edit_btn(this)" data-toggle="modal" data-target="#con-close-modal" class="btn_edit">
                    <i class="ion-edit"></i>
                </button>
                <button onclick="destroy(<?php echo e($item->id); ?>)" class="btn_del">
                    <i class="ion-trash-a"></i>
                </button>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php echo $__env->make('Admin.Category.edit_category_modal', ['nemu' => $menu], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="assets/pages/jquery.icons.js"></script>
    <script>

        // them moi mot item menu
        function add_item_menu()
        {

            return $.ajax({
                type:"POST",
                url:"<?php echo e(asset(route('store_menu_item'))); ?>",
                data: new FormData($('#add_category')[0]),
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    var count = $('.tr').length;
                    parseInt(count);
                    count++;
                    var row = "<tr class=\"tr\" record-id=\""+data['id']+"\"> <th>"+count+"</th><td headers=\"cate_name\">"+data['cate_name']+"</td><td headers=\"cate_slug\">"+data['cate_slug']+"</td><td>\n" +
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
                url:"<?php echo e(asset(route('update_menu_item'))); ?>",
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
            if (confirm('Sure?')){
                return $.ajax({
                    type:"GET",
                    url:"<?php echo e(asset(route('destroy_menu_item'))); ?>",
                    data: {id: cate_id},
                    async: false,
                    success: function (data) {
                        if (data){
                            $('table tr[record-id="' + cate_id + '"]').remove();
                        }
                    }
                });
            }

        }
    </script>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>