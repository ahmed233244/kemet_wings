<div class="form-checkout" id="form-checkout" >
    <input type="hidden" name="code" value="<?php echo e($booking->code); ?>">
    <div class="form-section">
        <div class="row">

            <?php if(is_enable_guest_checkout() && is_enable_registration() and !$user): ?>
                <div class="col-12 " id="confirmRegisterContent">
                    <div class="row">
                        <div class="col-md-6" >
                            <div class="form-group ">
                                <label class="lh-1 text-16 text-light-1" ><?php echo e(__("Password")); ?> <span class="required">*</span></label>
                                <input type="password" class="form-control" name="password" autocomplete="off" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="lh-1 text-16 text-light-1" ><?php echo e(__('Password confirmation')); ?> <span class="required">*</span></label>
                                <input type="password" class="form-control" name="password_confirmation" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
            <?php endif; ?>
            <div class="col-md-6 field-email">
                <div class="form-group">
                    <label ><?php echo e(__("Email")); ?> <span class="required">*</span></label>
                    <input type="email" placeholder="<?php echo e(__("email@domain.com")); ?>" class="form-control" value="<?php echo e($user->email ?? ''); ?>" name="email">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label ><?php echo e(__("Phone")); ?> <span class="required">*</span></label>
                    <input type="text" placeholder="<?php echo e(__("Your Phone")); ?>" class="form-control" value="<?php echo e($user->phone ?? ''); ?>" name="phone">
                </div>
            </div>
            <div class="col-md-6 field-country">
                <div class="form-group">
                    <label ><?php echo e(__("Country of Residence")); ?> <span class="required">*</span> </label>
                    <select name="country" class="form-control">
                        <option value=""><?php echo e(__('-- Select --')); ?></option>
                        <?php $__currentLoopData = get_country_lists(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id=>$name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option <?php if(($user->country ?? '') == $id): ?> selected <?php endif; ?> value="<?php echo e($id); ?>"><?php echo e($name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <label ><?php echo e(__("Special Requirements")); ?> </label>
                <textarea name="customer_notes" cols="30" rows="6" class="form-control" placeholder="<?php echo e(__('Special Requirements')); ?>"></textarea>
            </div>
        </div>
    </div>

    <?php echo $__env->make('Booking::frontend/booking/checkout-passengers', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('Booking::frontend/booking/checkout-deposit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make($service->checkout_form_payment_file ?? 'Booking::frontend/booking/checkout-payment', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php
    $term_conditions = setting_item('booking_term_conditions');
    ?>

    <div class="form-group">
        <label class="term-conditions-checkbox">
            <input type="checkbox" name="term_conditions"> <?php echo e(__('I have read and accept the')); ?>  <a target="_blank" href="<?php echo e(get_page_url($term_conditions)); ?>"><?php echo e(__('terms and conditions')); ?></a>
        </label>
    </div>
    <?php if(setting_item("booking_enable_recaptcha")): ?>
        <div class="form-group">
            <?php echo e(recaptcha_field('booking')); ?>

        </div>
    <?php endif; ?>
    <div class="html_before_actions"></div>

    <p class="alert-text mt10" v-show=" message.content" v-html="message.content" :class="{'danger':!message.type,'success':message.type}"></p>

    <div class="form-actions">
        <button class="btn btn-danger" @click="doCheckout"><?php echo e(__('Submit')); ?>

            <i class="fa fa-spin fa-spinner" v-show="onSubmit"></i>
        </button>
    </div>
</div>
<?php /**PATH C:\Users\PC\Documents\flight_booking\Bookingcore.3.6.2\themes/BC/Booking/Views/frontend/booking/checkout-form.blade.php ENDPATH**/ ?>