
<?php
    if (empty($inputName)){
        $inputName = 'to_where';
    }
    // Prepare locations for select2
    $locationOptions = [];
    $traverse = function ($locations, $prefix = '') use (&$traverse, &$locationOptions) {
        foreach ($locations as $location) {
            $translate = $location->translate();
            $locationOptions[] = [
                'id'    => $location->id,
                'text'  => trim($prefix.' '.$translate->name),
            ];
            $traverse($location->children, $prefix.'-');
        }
    };
    $traverse($list_location);
    $selectedId = Request::query($inputName) ?? '';
?>
<style>
	.select2-container--default .select2-selection--single {
    font-size: 13px;
	border: 0px;
	background-color: #f8fafc ;
}
.select2-selection__placeholder{
	color:#5191fa !important;
	font-size:14px;

}
.select2-selection__rendered{
	padding-left: 0px !important;
	color:#5191fa !important;
}
.select2-selection__arrow{
	color:#5191fa !important;
}

</style>
<div class="form-group">
	<i class="field-icon icofont-paper-plane"style='left:15px !important;position:absolute'></i>
	<div class="form-content">
    <label class="form-label"><?php echo e(ucfirst(str_replace('_', ' ', $inputName))); ?></label>
    <select required  class="form-select select2-location" name="<?php echo e($inputName); ?>[]" data-placeholder="Select location">
        <option value=""><?php echo e(__("City or airport")); ?></option>
        <?php $__currentLoopData = $locationOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($option['id']); ?>" <?php echo e($selectedId == $option['id'] ? 'selected' : ''); ?>>
                <?php echo e($option['text']); ?>

            </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
	</div>
</div>


<script>

    $('.select2-location').select2({
        width: '100%',
        placeholder: $(this).data('placeholder') || 'Select location'
    });

</script>
<?php /**PATH C:\Users\PC\Documents\flight_booking\Bookingcore.3.6.2\themes/BC/Flight/Views/frontend/layouts/search/fields/to-where.blade.php ENDPATH**/ ?>