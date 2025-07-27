<?php
    $adults = $_REQUEST['adults'] ?? 0;      // Adjust as needed: get from booking, or request
    $children = $_REQUEST['children']  ?? 0;
    $infants = $_REQUEST['infants'] ?? 0;
    $passengerLabels = [];
    for ($a = 1; $a <= $adults; $a++) $passengerLabels[] = 'Adult ' . $a;
        for ($f = 1; $f <= $infants; $f++) $passengerLabels[] = 'Infant ' . $f;
    for ($c = 1; $c <= $children; $c++) $passengerLabels[] = 'Child ' . $c;

    $totalPassenger = $booking->calTotalPassenger();
?>

    <hr>
    <div class="form-section">
        <h4 class="form-section-title"><?php echo e(__("Tickets / Guests Information:")); ?></h4>
        <div class="accordion gateways-table" id="passengers_info">
            <?php for($i = 1 ; $i <= $totalPassenger ; $i ++): ?>
                <?php $old_item = $old_data[$i] ?? []; ?>
                <div class="card">
                    <div  data-toggle="collapse" data-target="#passenger_<?php echo e($i); ?>" aria-expanded="true"
                            aria-controls="passenger_<?php echo e($i); ?>" class="card-header c-pointer" id="passenger_heading_<?php echo e($i); ?>">
                        <h4 class="mb-0 ">
                            <span class="passenger-label" data-pax="<?php echo e($i); ?>">
                            <?php echo e($passengerLabels[$i-1] ?? __("Guest #:number",['number'=>$i])); ?>:
</span>
                        </h4>
                    </div>

                    <div id="passenger_<?php echo e($i); ?>" class="collapse <?php if($i == 1): ?> show <?php endif; ?>"
                         aria-labelledby="passenger_heading_<?php echo e($i); ?>" data-parent="#passengers_info">
                        <div class="card-body">
                            <div class="row">
                                <?php if(substr($passengerLabels[$i-1],0,5) != 'Child'): ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo e(__("Title")); ?> </label>
                                        <input type="text" placeholder="<?php echo e(__("Title")); ?>" class="form-control"
                                               value="<?php echo e($old_item['Title'] ?? ''); ?>"
                                               name="passengers[<?php echo e($i); ?>][title]">
                                    </div>
                                    </div>
<?php endif; ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo e(__("First Name")); ?> </label>
                                        <input type="text" placeholder="<?php echo e(__("First Name")); ?>" class="form-control pax-name"data-pax="<?php echo e($i); ?>"
                                               value="<?php echo e($old_item['first_name'] ?? ''); ?>"
                                               name="passengers[<?php echo e($i); ?>][first_name]">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo e(__("Last Name")); ?></label>
                                        <input type="text" placeholder="<?php echo e(__("Last Name")); ?>" class="form-control pax-name"data-pax="<?php echo e($i); ?>"
                                               value="<?php echo e($old_item['last_name'] ?? ''); ?>"
                                               name="passengers[<?php echo e($i); ?>][last_name]">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo e(__("Nationality")); ?> </label>
                                        <select name="passengers[<?php echo e($i); ?>][nationality]" class="form-control">
                                            <option value=""><?php echo e(__('-- Select --')); ?></option>
                                            <?php $__currentLoopData = get_country_lists(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id=>$name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php if(($user->country ?? '') == $id): ?> selected <?php endif; ?> value="<?php echo e($id); ?>"><?php echo e($name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                               
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo e(__("Date Of Birth")); ?> </label>
                                        <input type="date" placeholder="<?php echo e(__("Date Of Birth")); ?>" class="form-control"
                                               value="<?php echo e($old_item['date_of_birth'] ?? ''); ?>" name="passengers[<?php echo e($i); ?>][date_of_birth]">
                                    </div>
                                </div>
                                <?php if(substr($passengerLabels[$i-1],0,5) != 'Child'): ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo e(__("Passport Number")); ?> </label>
                                        <input type="text" placeholder="<?php echo e(__("Passport Number")); ?>" class="form-control"
                                               value="<?php echo e($old_item['passport'] ?? ''); ?>" name="passengers[<?php echo e($i); ?>][passport]">
                                    </div>
                                </div>
                                <?php endif; ?>
                                <input type="hidden" name="passengers[<?php echo e($i); ?>][type]"value='<?php echo substr($passengerLabels[$i-1],0,-2); ?>'>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
    </div>
    <script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.pax-name').forEach(function(input) {
        input.addEventListener('input', function() {
            var pax = this.getAttribute('data-pax');
            var form = this.closest('.card-body');
            var firstName = form.querySelector('input[name^="passengers['+pax+'][first_name]"]').value;
            var lastName = form.querySelector('input[name^="passengers['+pax+'][last_name]"]').value;
            var label = document.querySelector('.passenger-label[data-pax="'+pax+'"]');
            if ((firstName && firstName.trim()) || (lastName && lastName.trim())) {
                label.textContent = [firstName, lastName].filter(Boolean).join(' ');
            } else {
                label.textContent = label.getAttribute('data-default-label') || label.textContent;
            }
        });
    });
    // Save original label so we can restore if empty
    document.querySelectorAll('.passenger-label').forEach(function(label){
        label.setAttribute('data-default-label', label.textContent);
    });
});
</script>
<?php /**PATH C:\Users\PC\Documents\flight_booking\Bookingcore.3.6.2.1\themes/Base/Booking/Views/frontend/booking/checkout-passengers.blade.php ENDPATH**/ ?>