<div class="form-group">
    <i class="field-icon icofont-wall-clock"></i>
    <div class="form-content">
        <div class="form-date-search">
            <div class="date-wrapper">
                <div class="check-in-wrapper">
                    <label>From when</label>
                    <div class=" font-size-14"><?php echo e(Request::query('start',display_date(strtotime("today")))); ?></div>

                </div>
            </div>
            <input type="hidden" class="check-in-input" value="<?php echo e(Request::query('start',display_date(strtotime("today")))); ?>" name="start">
            <input type="hidden" class="check-out-input" value="<?php echo e(Request::query('end',display_date(strtotime("+7 day")))); ?>" name="end">
            <input type="text" class="check-in-out" name="date" value="<?php echo e(Request::query('date',date("Y-m-d")." - ".date("Y-m-d",strtotime("+7 day")))); ?>">
        </div>
    </div>
</div><?php /**PATH C:\Users\PC\Documents\flight_booking\Bookingcore.3.6.2\themes/BC/Flight/Views/frontend/layouts/search/fields/date.blade.php ENDPATH**/ ?>