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
        <h4 class="form-section-title">{{__("Tickets / Guests Information:")}}</h4>
        <div class="accordion gateways-table" id="passengers_info">
            @for($i = 1 ; $i <= $totalPassenger ; $i ++)
                <?php $old_item = $old_data[$i] ?? []; ?>
                <div class="card">
                    <div  data-toggle="collapse" data-target="#passenger_{{$i}}" aria-expanded="true"
                            aria-controls="passenger_{{$i}}" class="card-header c-pointer" id="passenger_heading_{{$i}}">
                        <h4 class="mb-0 ">
                            <span class="passenger-label" data-pax="{{$i}}">
                            {{ $passengerLabels[$i-1] ?? __("Guest #:number",['number'=>$i]) }}:
</span>
                        </h4>
                    </div>

                    <div id="passenger_{{$i}}" class="collapse @if($i == 1) show @endif"
                         aria-labelledby="passenger_heading_{{$i}}" data-parent="#passengers_info">
                        <div class="card-body">
                            <div class="row">
                                @if(substr($passengerLabels[$i-1],0,5) != 'Child')
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__("Title")}} </label>
                                        <input type="text" placeholder="{{__("Title")}}" class="form-control"
                                               value="{{$old_item['Title'] ?? ''}}"
                                               name="passengers[{{$i}}][title]">
                                    </div>
                                    </div>
@endif
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__("First Name")}} </label>
                                        <input type="text" placeholder="{{__("First Name")}}" class="form-control pax-name"data-pax="{{$i}}"
                                               value="{{$old_item['first_name'] ?? ''}}"
                                               name="passengers[{{$i}}][first_name]">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__("Last Name")}}</label>
                                        <input type="text" placeholder="{{__("Last Name")}}" class="form-control pax-name"data-pax="{{$i}}"
                                               value="{{$old_item['last_name'] ?? ''}}"
                                               name="passengers[{{$i}}][last_name]">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__("Nationality")}} </label>
                                        <select name="passengers[{{$i}}][nationality]" class="form-control">
                                            <option value="">{{__('-- Select --')}}</option>
                                            @foreach(get_country_lists() as $id=>$name)
                                                <option @if(($user->country ?? '') == $id) selected @endif value="{{$id}}">{{$name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                               
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__("Date Of Birth")}} </label>
                                        <input type="date" placeholder="{{__("Date Of Birth")}}" class="form-control"
                                               value="{{$old_item['date_of_birth'] ?? ''}}" name="passengers[{{$i}}][date_of_birth]">
                                    </div>
                                </div>
                                @if(substr($passengerLabels[$i-1],0,5) != 'Child')
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__("Passport Number")}} </label>
                                        <input type="text" placeholder="{{__("Passport Number")}}" class="form-control"
                                               value="{{$old_item['passport'] ?? ''}}" name="passengers[{{$i}}][passport]">
                                    </div>
                                </div>
                                @endif
                                <input type="hidden" name="passengers[{{$i}}][type]"value='<?php echo substr($passengerLabels[$i-1],0,-2); ?>'>
                            </div>
                        </div>
                    </div>
                </div>
            @endfor
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
