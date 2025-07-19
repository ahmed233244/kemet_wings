
<?php $__env->startPush('css'); ?>
    <link href="<?php echo e(asset('module/booking/css/checkout.css?_ver='.config('app.asset_version'))); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="bravo-booking-page padding-content" >
        <div class="container">
            <?php echo $__env->make('Booking::frontend/global/booking-detail-notice', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="row booking-success-detail">
                <div class="col-md-8">
                    <?php echo $__env->make($service->booking_customer_info_file ?? 'Booking::frontend/booking/booking-customer-info', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="text-center">
                        <a href="<?php echo e(route('user.booking_history')); ?>" class="btn btn-primary"><?php echo e(__('Booking History')); ?></a>
                    </div>
                </div>
                <div class="col-md-4">
                    
<?php $__env->startPush('css'); ?>
    <link href="<?php echo e(asset('module/booking/css/checkout.css?_ver='.config('app.asset_version'))); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="bravo-booking-page padding-content" >
        <div class="container">
            <?php echo $__env->make('Booking::frontend/global/booking-detail-notice', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="row booking-success-detail">
                <div class="col-md-8">
                    <?php echo $__env->make($service->booking_customer_info_file ?? 'Booking::frontend/booking/booking-customer-info', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="text-center">
                        <a href="<?php echo e(route('user.booking_history')); ?>" class="btn btn-primary"><?php echo e(__('Booking History')); ?></a>
                    </div>
                </div>
                <div class="col-md-4">
                    <?php
    use Modules\Booking\Models\BookingPassenger;
    // Build passenger counts by type from booking->passengers relationship/collection
    $passenger_types = [
        'Adult'  => ['label' => 'Adult',  'class' => 'adult'],
        'Child'  => ['label' => 'Child',  'class' => 'child'],
        'Infant' => ['label' => 'Infant', 'class' => 'infant'],
    ];

    // Group booking passengers by type for the summary (count per type)
    $passengerCounts = [];
    foreach ($passenger_types as $type => $info) {
        $passengerCounts[$type] = $booking->hasMany(BookingPassenger::class)->where('type', $type)->count();
    }

    // Main flights array
    $booking_flights = $booking->flights ?? [];
    $grand_total = 0;
?>

<?php if($booking_flights->count()): ?>
    <div class="price-summary-box" style="max-width:480px;margin:20px auto;padding:16px;background:#f8fafb;border-radius:10px;box-shadow:0 2px 8px #0001;">
        <h3 style="font-size:1.3em;margin-bottom:14px;">Price Summary</h3>
        <ul style="list-style:none;padding:0;margin:0;">
            <?php $__currentLoopData = $booking_flights; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $segment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $segment_total = 0;
                ?>
                <li style="margin-bottom:9px;">
                    <strong>
                        Segment <?php echo e($segment->segment_number ?? ''); ?>:
                        <?php echo e($segment->flight->get_airport_from()['code'] ?? ''); ?>

                        <i class="fa fa-arrow-right"></i>
                        <?php echo e($segment->flight->get_airport_to()['code'] ?? ''); ?>

                        <span style="font-size:12px;font-weight:400;color:#888;">
                            <?php echo e($segment->fare['seat_type'] ?? ''); ?>

                        </span>
                    </strong>
                    <ul style="padding-left:12px;margin:4px 0 0 0;">
                        <?php $__currentLoopData = $passenger_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type => $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $count = $passengerCounts[$type];
                                $price = $segment[strtolower($type) . '_price'] ?? 0;
                                $line_total = $count * $price;
                                $segment_total += $line_total;
                            ?>
                            <?php if($count && $price): ?>
                                <li class="ps-type-<?php echo e($info['class']); ?>" style="display:flex;justify-content:space-between;font-size:14px;">
                                    <span>
                                        <?php echo e($count); ?> × <?php echo e($info['label']); ?>

                                        <span style="color:#666;">@ <?php echo e(format_money($price)); ?></span>
                                    </span>
                                    <span><?php echo e(format_money($line_total)); ?></span>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                    <div style="text-align:right;font-size:13px;font-weight:600;color:#335;margin-top:3px;">
                        Subtotal: <?php echo e(format_money($segment_total)); ?>

                    </div>
                </li>
                <hr style="border:none;border-top:1px dashed #ddd;margin:9px 0;">
                <?php $grand_total += $segment_total; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
        <div style="margin-top:10px;font-size:18px;font-weight:bold;text-align:right;color:#155;">
            Grand Total: <?php echo e(format_money($grand_total)); ?>

        </div>
        <div style="margin-top:5px;font-size:12px;color:#888;text-align:right;">
            <i>All taxes &amp; fees included</i>
        </div>
    </div>
<?php endif; ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\PC\Documents\flight_booking\Bookingcore.3.6.2\themes/BC/Booking/Views/frontend/detail.blade.php ENDPATH**/ ?>