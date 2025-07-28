<tr>
    <td class="booking-history-type">

            <i class="<?php echo e($booking->flights->first->flight->flight->getServiceIconFeatured()); ?>"></i>
        <small><?php echo e($booking->object_model); ?></small>
    </td>
    <td>
        <?php foreach($booking->flights as $f){
            echo $f->flight->title.'('.$f->flight->code.')<hr style="display:block !important">';

        }
        ?>
    </td>
    <td class="a-hidden"><?php echo e(display_date($booking->created_at)); ?></td>
    <td class="a-hidden">
         <?php foreach($booking->flights as $f){
echo "Departure time : ".display_datetime($f->flight->departure_time)."<br>"
        ."Arrival Time : ".display_datetime($f->flight->arrival_time)."<br>"
        ."Duration :".$f->flight->duration.'hrs <hr style="display:block !important">';
        }
        ?>
        

    </td>
    <td><?php echo e(format_money($booking->total)); ?></td>
    <td class="<?php echo e($booking->status); ?> a-hidden"><?php echo e($booking->statusName); ?></td>
    <td width="2%">
        <?php if($service = $booking->service): ?>
            <a class="btn btn-xs btn-primary btn-info-booking" href="<?php echo e(route('booking.ticket',['booking'=>$booking])); ?>">
                <i class="fa fa-info-circle"></i><?php echo e(__("Tickets")); ?>

            </a>
        <?php endif; ?>
        <a href="<?php echo e(route('user.booking.invoice',['code'=>$booking->code])); ?>" class="btn btn-xs btn-primary btn-info-booking open-new-window mt-1" onclick="window.open(this.href); return false;">
            <i class="fa fa-print"></i><?php echo e(__("Invoice")); ?>

        </a>
        <?php if($booking->status == 'unpaid'): ?>
            <a href="<?php echo e(route('booking.checkout',['code'=>$booking->code])); ?>" class="btn btn-xs btn-primary btn-info-booking open-new-window mt-1">
                <?php echo e(__("Pay now")); ?>

            </a>
        <?php endif; ?>
    </td>
</tr>
<?php /**PATH C:\Users\PC\Documents\flight_booking\Bookingcore.3.6.2.1\themes/Base/Flight/Views/frontend/bookingHistory/loop.blade.php ENDPATH**/ ?>