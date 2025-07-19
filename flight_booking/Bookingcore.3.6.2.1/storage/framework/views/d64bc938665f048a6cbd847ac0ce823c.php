<?php $lang_local = app()->getLocale() ?>
<div class="booking-review">
    <h4 class="booking-review-title"><?php echo e(__("Your Booking")); ?></h4>
    <div class="booking-review-content">
                    <?php $__currentLoopData = $booking->flights; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $flight_booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="review-section">
            <div class="service-info">
                <div class="mt-2">
                    <h3 class="service-name"><?php echo clean($flight_booking->flight->airline->name); ?></h3>
                </div>
                <div class="font-weight-medium  mb-3">
                    <p class="mb-1">
                        <?php echo e(__(':from to :to',['from'=>$flight_booking->flight->airportFrom->location->name,'to'=>$flight_booking->flight->airportTo->location->name])); ?>

                    </p>
                    <?php echo e(__(":duration hrs",['duration'=>$flight_booking->flight->duration])); ?>

                </div>

                <div class="flex-self-start justify-content-between">
                    <div class="flex-self-start">
                        <div class="mr-2">
                            <i class="icofont-airplane font-size-30 text-primary"></i>
                        </div>
                        <div class="text-lh-sm ml-1">
                            <h6 class="font-weight-bold font-size-21 text-gray-5 mb-0"><?php echo e($flight_booking->flight->departure_time->format('H:i')); ?></h6>
                            <span class="font-size-14 font-weight-normal text-gray-1"><?php echo e($flight_booking->flight->airportFrom->name); ?> Airport</span>
                        </div>
                    </div>
                    <div class="text-center d-none d-md-block d-lg-none">
                        <div class="mb-1">
                            <h6 class="font-size-14 font-weight-bold text-gray-5 mb-0"><?php echo e(__(":duration hrs",['duration'=>$flight_booking->flight->duration])); ?></h6>
                        </div>
                    </div>
                    <div class="flex-self-start">
                        <div class="mr-2">
                            <i class="d-block rotate-90 icofont-airplane-alt font-size-30 text-primary"></i>
                        </div>
                        <div class="text-lh-sm ml-1">
                            <h6 class="font-weight-bold font-size-21 text-gray-5 mb-0"><?php echo e($flight_booking->flight->arrival_time->format("H:i")); ?></h6>
                            <span class="font-size-14 font-weight-normal text-gray-1"><?php echo e($flight_booking->flight->airportTo->name); ?> Airport</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <div class="review-section total-review">
            <ul class="review-list1">
<?php
    // Example: Get segments data and passenger counts
    $booking_flights = $booking->flights ?? []; // or $booking->booking_flights if relation
    $passenger_counts = [
        'adults'   => $_REQUEST['adults']  ?? 0,
        'children' => $_REQUEST['children']  ?? 0,
        'infants'  => $_REQUEST['infants'] ?? 0,
    ];
    $person_types = [
        ['label' => 'Adult', 'key' => 'adults', 'class' => 'adult'],
        ['label' => 'Child', 'key' => 'children', 'class' => 'child'],
        ['label' => 'Infant', 'key' => 'infants', 'class' => 'infant'],
    ];
    $grand_total = 0;
?>

<?php if(!empty($booking_flights)): ?>
    <div class="price-summary-box" style="max-width:480px;margin:20px auto;padding:16px;background:#f8fafb;border-radius:10px;box-shadow:0 2px 8px #0001;">
        <h3 style="font-size:1.3em;margin-bottom:14px;">Price Summary</h3>
        <ul style="list-style:none;padding:0;margin:0;">
            <?php $__currentLoopData = $booking_flights; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $segment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $segment_total = 0;
                ?>
                <li style="margin-bottom:9px;">
                    <strong>
                        Segment <?php echo e($segment['segment_number'] ?? ''); ?>:
                        <?php echo e($segment->flight->get_airport_from()['code'] ?? ''); ?> <i class="fa fa-arrow-right"></i> <?php echo e($segment->flight->get_airport_to()['code'] ?? ''); ?>

                        <span style="font-size:12px;font-weight:400;color:#888;">
                            <?php echo e($segment->fare['seat_type'] ?? ''); ?>

                        </span>
                    </strong>
                    <ul style="padding-left:12px;margin:4px 0 0 0;">
                        <?php $__currentLoopData = $person_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ptype): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $count = $passenger_counts[$ptype['key']] ?? 0;
                                $price = $segment[$ptype['class'].'_price'] ?? 0;
                                $line_total = $count * $price;
                                $segment_total += $line_total;
                            ?>
                            <?php if($count && $price): ?>
                                <li class="ps-type-<?php echo e($ptype['class']); ?>" style="display:flex;justify-content:space-between;font-size:14px;">
                                    <span>
                                        <?php echo e($count); ?> × <?php echo e($ptype['label']); ?>

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
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
        <div style="margin-top:10px;font-size:18px;font-weight:bold;text-align:right;color:#155;">
            Grand Total: <?php echo e(format_money($booking->total)); ?>

        </div>
        <div style="margin-top:5px;font-size:12px;color:#888;text-align:right;">
            <i>All taxes &amp; fees included</i>
        </div>
    </div>
<?php endif; ?>

                <?php $extra_price = $booking->getJsonMeta('extra_price') ?>
                <?php if(!empty($extra_price)): ?>
                    <li>
                        <div>
                            <?php echo e(__("Extra Prices:")); ?>

                        </div>
                    </li>
                    <?php $__currentLoopData = $extra_price; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <div class="label"><?php echo e($type['name_'.$lang_local] ?? __($type['name'])); ?>:</div>
                            <div class="val">
                                <?php echo e(format_money($type['total'] ?? 0)); ?>

                            </div>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
                <?php
                    $list_all_fee = [];
                    if(!empty($booking->buyer_fees)){
                        $buyer_fees = json_decode($booking->buyer_fees , true);
                        $list_all_fee = $buyer_fees;
                    }
                    if(!empty($vendor_service_fee = $booking->vendor_service_fee)){
                        $list_all_fee = array_merge($list_all_fee , $vendor_service_fee);
                    }
                ?>
                <?php if(!empty($list_all_fee)): ?>
                    <?php $__currentLoopData = $list_all_fee; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $fee_price = $item['price'];
                            if(!empty($item['unit']) and $item['unit'] == "percent"){
                                $fee_price = ( $booking->total_before_fees / 100 ) * $item['price'];
                            }
                        ?>
                        <li>
                            <div class="label">
                                <?php echo e($item['name_'.$lang_local] ?? $item['name']); ?>

                                <i class="icofont-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e($item['desc_'.$lang_local] ?? $item['desc']); ?>"></i>
                                <?php if(!empty($item['per_person']) and $item['per_person'] == "on"): ?>
                                    : <?php echo e($booking->total_guests); ?> * <?php echo e(format_money( $fee_price )); ?>

                                <?php endif; ?>
                            </div>
                            <div class="val">
                                <?php if(!empty($item['per_person']) and $item['per_person'] == "on"): ?>
                                    <?php echo e(format_money( $fee_price * $booking->total_guests )); ?>

                                <?php else: ?>
                                    <?php echo e(format_money( $fee_price )); ?>

                                <?php endif; ?>
                            </div>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
                <?php if ($__env->exists('Coupon::frontend/booking/checkout-coupon')) echo $__env->make('Coupon::frontend/booking/checkout-coupon', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <li class="final-total d-block">
                    <div class="d-flex justify-content-between">
                        <div class="label"><?php echo e(__("Total:")); ?></div>
                        <div class="val"><?php echo e(format_money($booking->total)); ?></div>
                    </div>
                    <?php if($booking->status !='draft'): ?>
                        <div class="d-flex justify-content-between">
                            <div class="label"><?php echo e(__("Paid:")); ?></div>
                            <div class="val"><?php echo e(format_money($booking->paid)); ?></div>
                        </div>
                        <?php if($booking->paid < $booking->total ): ?>
                            <div class="d-flex justify-content-between">
                                <div class="label"><?php echo e(__("Remain:")); ?></div>
                                <div class="val"><?php echo e(format_money($booking->total - $booking->paid)); ?></div>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </li>
                <?php echo $__env->make('Booking::frontend/booking/checkout-deposit-amount', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </ul>
        </div>
    </div>
</div><?php /**PATH C:\Users\PC\Documents\flight_booking\Bookingcore.3.6.2\themes/Base/Flight/Views/frontend/booking/detail.blade.php ENDPATH**/ ?>