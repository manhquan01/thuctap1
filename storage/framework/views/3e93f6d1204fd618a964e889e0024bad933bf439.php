<?php
function menuParent($menu, $parent, $str){
    $str.'';
    foreach ($menu as $item){
        if ($item->cate_parent == $parent){
            echo $item->id.'-'.$item->cate_name.'-'.$item->cate_parent.'<br>';
            menuSub($menu, $item->id, $str);
        }
    }

}

function menuSub($menu, $sub, $str){
    foreach($menu as $item){
        if ($item->cate_parent == $sub){
            echo $str.$item->cate_parent.$item->cate_name."<br>";
            menuSub($menu, $item->id, $str.'--');
        }
    }
}
?>


<?php $__env->startSection('content'); ?>
    <?php echo e(menuParent($menu,0,'--')); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>