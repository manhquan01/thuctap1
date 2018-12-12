<?php
//Lay ra tat ca menu cha.
function menuParent($menu, $parent, $str){
    $str.'';
    foreach ($menu as $item){
        if ($item->cate_parent == $parent){
            echo '<tr record_id="'.$item->id.'"> <th scope="row">'.$item->id.'</th>'.
                '<td headers="cate_name">'.$item->cate_name.'</td>'.
                '<td headers="cate_slug">'.$item->cate_slug.'</td>'.
                '<td> <div class="col-sm-6 col-md-4 col-lg-3"><button data-toggle="modal" data-target="#con-close-modal" class="btn_edit" onclick="getRecord(this)"><i class="ion-edit"></i></button></div> </td>';
            menuSub($menu, $item->id, $str);
        }
    }

}
//Lay ra tat ca menu con.
function menuSub($menu, $sub, $str){
    foreach($menu as $item){
        if ($item->cate_parent == $sub){
            echo '<tr record_id="'.$item->id.'"> <th scope="row">'.$item->id.'</th>'.
                '<td class="sub_menu" headers="cate_name">'.$str.$item->cate_name.'</td>'.
                '<td headers="cate_slug">'.$item->cate_slug.'</td>'.
                '<td> <div class="col-sm-6 col-md-4 col-lg-3"><button data-toggle="modal" data-target="#con-close-modal" class="btn_edit" onclick="getRecord(this)"><i class="ion-edit"></i></button></div> </td>';
            menuSub($menu, $item->id, $str.'| _ ');
        }
    }
}
?>


<?php $__env->startSection('title', 'Multilevel Category'); ?>
<?php $__env->startSection('content'); ?>
<div class="col-md-4">
    <form method="post" id="add_category" action="<?php echo e(asset(route('store_category'))); ?>">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="cate_name" class="control-label">Name Category</label>
                    <input form="add_category" type="text" class="form-control" name="cate_name" placeholder="Category name">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="cate_slug" class="control-label">Static Link</label>
                    <input form="add_category" type="text" class="form-control" name="cate_slug" placeholder="Static link">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="cate_parent" class="control-label">Parent</label>
                    <select form="add_category" class="form-control" name="cate_parent">
                        <option value="0">--Select--</option>
                        <option value="0">No parent</option>
                        <?php $__currentLoopData = $menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($item->id); ?>"><?php echo e($item->cate_name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
        </div>
        <?php echo e(csrf_field()); ?>

        <button type="submit" form="add_category" class="btn btn-info waves-effect waves-light">Add category</button>
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
        <tbody>
        <?php echo e(menuParent($menu,0,'| _ ')); ?>

        </tbody>
    </table>
</div>
<?php echo $__env->make('edit_category_modal', ['nemu' => $menu], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="assets/pages/jquery.icons.js"></script>
    <script type="text/javascript">

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Lay thong tin cua ban ghi muon sua
        function getRecord(object){
            var record_id = $(object).closest('tr').attr('record_id');
            return $.ajax({
                type: "GET",
                url: "admin/category/edit/"+record_id,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data){
                    $('#cate_name').val(data['cate_name']);
                    $('#cate_slug').val(data['cate_slug']);
                    $('#cate_id').val(data['id']);
                    //$('#cate_parent').val(data['cate_parent'])
                    parent(record_id, data['cate_parent']);
                }
            });
        }

        //lay ra tat ca item-menu tru cai dang dc chon
        function parent(id, parent) {
            return $.ajax({
                type: "GET",
                url: "admin/category/parent/"+id,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data){
                    //console.log(id);
                    $('#cate_parent option').remove();
                    $('#cate_parent').append('<option value="0">No parent</option>');
                    $.each(data, function(i, item) {
                        var option = "<option value=\""+data[i].id+"\">"+data[i].cate_name+"</option>";
                        if (id == data[i].cate_parent){
                            option = '';
                        }
                        $('#cate_parent').append(option);
                        if (data[i].id == parent){
                            $('#cate_parent').val(parent);
                        }
                    });
                }
            });
        }

        //Sua thong tin category
        function update_category() {

            return $.ajax({
                type:"POST",
                url:"admin/category/update",
                data: new FormData($('#edit_category')[0]),
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    location.reload();
                    // $('#con-close-modal').modal('toggle');
                    // var rowinfo = $('table tr[record_id='+ data['id']+']');
                    // rowinfo.find('td[headers="cate_name"]').text(data['cate_name']);
                    // rowinfo.find('td[headers="cate_slug"]').text(data['cate_slug']);

                }
            });
        }
    </script>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
    <style type="text/css">
        .btn_edit{
            border: none;
            background: transparent;
        }
        
        .sub_menu{
            color: red;
        }
    </style>
}
<?php $__env->stopSection(); ?>

<?php echo $__env->make('index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>