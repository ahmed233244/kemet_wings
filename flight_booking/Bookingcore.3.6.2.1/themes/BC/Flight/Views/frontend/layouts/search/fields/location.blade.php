
<?php
    if (empty($inputName)){
        $inputName = 'location_id';
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
    <label class="form-label">{{ ucfirst(str_replace('_', ' ', $inputName)) }}</label>
    <select required  class="form-select select2-location" name="{{ $inputName }}[]" data-placeholder="Select location">
        <option value="">{{ __("City or airport") }}</option>
        @foreach($locationOptions as $option)
            <option value="{{ $option['id'] }}" {{ $selectedId == $option['id'] ? 'selected' : '' }}>
                {{ $option['text'] }}
            </option>
        @endforeach
    </select>
	</div>
</div>


<script>

    $('.select2-location').select2({
        width: '100%',
        placeholder: $(this).data('placeholder') || 'Select location'
    });

</script>
