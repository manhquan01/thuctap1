<?php $__env->startSection('title', 'Post'); ?>
<?php $__env->startSection('content'); ?>

    <?php echo e($hash); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script type="text/javascript">

    //Bai 1
    // var x = 1;
    // var y = 2;
    // parseInt(x);
    // parseInt(y);
    // var tong = x + y;
    // var hieu = x - y;
    // var tich = x * y;
    // var thuong = x / y;
    // document.write(hieu);

    //Bai 2
    // var today = 'Sunday';
    // var isCloudy = true;
    // var currentTemperature = 30;

    //Bai 3:
// var myCommunity = {
//     name: 'Coders.Tokyo',
//     numberOfMembers: 10000,
//     isAwesome: true
//     };
// console.log(myCommunity.name);

//Bai 4
// var arr = [1,2,3];
// console.log(arr);

</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>