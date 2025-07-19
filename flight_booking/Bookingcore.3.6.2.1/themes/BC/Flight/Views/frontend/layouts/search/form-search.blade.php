<?php
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
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slim Flight Search</title>
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <style>
        :root {
            --primary: #2563eb;
            --primary-light: #dbeafe;
            --border: #e2e8f0;
        }
        .tab-content:before{
            width:0px !important
        }
        .flight-form-container {

            width: 100%;
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border);

        }
        
        .form-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 15px;
            color: #1e293b;
        }
    .g-button-submit {
flex: 0 0 100% !important;
        max-width: 100% !important;

}
    .bravo_wrap .bravo_form .g-button-submit button {
        border-radius: 5px !important;
        display: inline-block !important;
        font-weight: 400 !important;
        height: auto !important;
        margin: 10px 15px !important;
        padding: 8px 15px !important; 
        position: relative;
        width: auto !important;
    }
        
        .trip-selector {
            display: flex;
            gap: 8px;
            margin-bottom: 10px;
            margin-top: 10px;
            width: 50%;
        }

    .g-button-submit {
        text-align: center !important;
    }

        .trip-option {
            flex: 1;
            text-align: center;
            padding: 8px 5px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 500;
            border: 1px solid var(--border);
            transition: all 0.2s;
            width: 20%;
        }
        
        .trip-option.active {
            background-color: var(--primary);
            color: white;
            border-color: var(--primary);
        }
        
        .segment-row {
            background-color: #f8fafc;
            border-radius: 6px;
            padding: 12px;
            margin-bottom: 10px;
            position: relative;
            border: 1px solid var(--border);
        }
        
        .segment-number {
            position: absolute;
            top: -8px;
            left: 10px;
            background: var(--primary);
            color: white;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: bold;
        }
        
        .remove-segment {
            position: absolute;
            top: 8px;
            right: 10px;
            color: #ef4444;
            background: none;
            border: none;
            font-size: 14px;
            cursor: pointer;
            opacity: 0.7;
            padding: 2px;
        }
        
        .form-control, .form-select {
            border: 1px solid var(--border);
            border-radius: 5px;
            padding: 8px 12px;
            height: 38px;
            font-size: 13px;
        }
        
        .form-label {
            font-size: 12px;
            color: #64748b;
            margin-bottom: 4px;
            font-weight: 500;
        }
        .bravo_wrap .bravo_form .g-field-search {
    flex: 0 0 100% !important;
    flex-grow: 1;
    max-width: 100% !important;
}
        
        .btn-add {
            background-color: transparent;
            border: 1px dashed #cbd5e1;
            color: #64748b;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 8px;
            width: 100%;
            border-radius: 5px;
            font-size: 13px;
            margin: 10px 0;
        }
        
        .btn-add i {
            margin-right: 6px;
            font-size: 12px;
        }
        
        .btn-search {
            background: var(--primary);
            border: none;
            padding: 10px;
            font-size: 14px;
            font-weight: 500;
            border-radius: 6px;
            width: 100%;
        }
        
        .passengers-section {
            background-color: #f8fafc;
            border-radius: 6px;
            padding: 12px;
            margin-top: 15px;
            border: 1px solid var(--border);
        }
        
        .section-title {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 12px;
            color: #1e293b;
        }
        
        @media (max-width: 768px) {
            .segment-row .col-md-3 {
                margin-bottom: 8px;
            }
        }
        .changable3{
            margin-left:20%
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="flight-form-container mx-auto">

            
            <form action="{{ route('flight.search') }}" class="form bravo_form" method="get">
                <!-- Trip Type Selection -->
                <div class="trip-selector">
                    <div class="trip-option active" data-type="one_way">
                        <input type="radio" name="trip_type" value="one_way" id="trip_one_way" class="d-none" checked>
                        <label for="trip_one_way" class="w-100 h-100 d-block mb-0">One Way</label>
                    </div>
                    <div class="trip-option" data-type="round_trip">
                        <input type="radio" name="trip_type" value="round_trip" id="trip_round_trip" class="d-none">
                        <label for="trip_round_trip" class="w-100 h-100 d-block mb-0">Round Trip</label>
                    </div>
                    <div class="trip-option" data-type="multi_destination">
                        <input type="radio" name="trip_type" value="multi_destination" id="trip_multi_destination" class="d-none">
                        <label for="trip_multi_destination" class="w-100 h-100 d-block mb-0">Multi-City</label>
                    </div>
                </div>

                <div class="g-field-search">
                    <div id="flight-search-segments">
                        <!-- Segment Row Template -->
                        <div class="segment-row first-segment-row flight-segment-row">
                            <span class="segment-number">1</span>
                            <div class="row changable3"id='changable3'>
                                <div class="col-md-3 mb-2 mb-md-0">
@include('Flight::frontend.layouts.search.fields.from-where')
                                </div>
                                <div class="col-md-3 mb-2 mb-md-0">
                                   
@include('Flight::frontend.layouts.search.fields.to-where')
                                </div>
                                <div class="col-md-3 mb-2 mb-md-0"style='margin-left: -2%;'>
                                <div class="form-group">
                                    <div class="form-content">
                                    <label class="form-label">Departure</label>
                                    <input required style="height:25px !important;color:#5191fa !important" name="start[]" type="date" class="form-control">
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-3 return-date-col d-none"style='margin-left: -2%;'>
                                     <div class="form-group">
                                    <div class="form-content">
                                    <label class="form-label">Return</label>
                                    <input  style="height:25px !important;color:#5191fa !important" name="start[]" type="date" class="form-control">
                                </div>
                                </div>
                                </div>
                            </div>
                        </div>
                                            <button type="button" class="btn-add add-segment-btn d-none">
                        <i class="fa fa-plus"></i> Add another flight
                    </button>
                    </div>
                    

                    
                    <!-- Passengers Section -->
                    <div class="passengers-section">
                        <div class="section-title">Passengers</div>
                        <div class="row">
   <div class="card mb-4">
    <div class="card-body">

        <div class="position-relative">
            <!-- Passenger selector trigger -->
            <div class="form-control passenger-selector-trigger" style="cursor: pointer;">
                <span class="passenger-summary">1 Adult</span>
                <i class="fa fa-chevron-down float-end mt-1"></i>
            </div>
            
            <!-- Passenger selector dropdown -->
            <div class="card passenger-selector-dropdown shadow-sm" style="display: none; position: absolute; width: 100%; z-index: 1000;">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-8">
                            <label class="form-label fw-bold">Adults</label>
                            <small class="text-muted">12+ years</small>
                        </div>
                        <div class="col-4">
                            <div class="input-group">
                                <button class="btn btn-outline-secondary passenger-minus" type="button" data-type="adults">-</button>
                                <input type="text" class="form-control text-center passenger-count" name="adults" value="1" min="1" max="9" readonly>
                                <button class="btn btn-outline-secondary passenger-plus" type="button" data-type="adults">+</button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-8">
                            <label class="form-label fw-bold">Children</label>
                            <small class="text-muted">2-11 years</small>
                        </div>
                        <div class="col-4">
                            <div class="input-group">
                                <button class="btn btn-outline-secondary passenger-minus" type="button" data-type="children">-</button>
                                <input type="text" class="form-control text-center passenger-count" name="children" value="0" min="0" max="9" readonly>
                                <button class="btn btn-outline-secondary passenger-plus" type="button" data-type="children">+</button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-8">
                            <label class="form-label fw-bold">Infants</label>
                            <small class="text-muted">Under 2 years</small>
                        </div>
                        <div class="col-4">
                            <div class="input-group">
                                <button class="btn btn-outline-secondary passenger-minus" type="button" data-type="infants">-</button>
                                <input type="text" class="form-control text-center passenger-count" name="infants" value="0" min="0" max="9" readonly>
                                <button class="btn btn-outline-secondary passenger-plus" type="button" data-type="infants">+</button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-end mt-3">
                        <button class="btn btn-primary btn-sm passenger-done">Done</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                        </div>
                    </div>
                </div>
                
                <div class="g-button-submit mt-3">
                    <button class="btn btn-search" type="submit">
                        <i style="color:white" class="fa fa-search me-2"></i> <p style="color:white">Search Flights</p>
                    </button>
                </div>
            </form>
        </div>
    </div><script>
                const tripTypeRadios = document.querySelectorAll('input[name="trip_type"]');
            const tripOptions = document.querySelectorAll('.trip-option');
            const returnDateCol = document.querySelector('.return-date-col');
            const addSegmentBtn = document.querySelector('.add-segment-btn');
            const segmentsContainer = document.getElementById('flight-search-segments');
            const changable = document.getElementById('changable3');
    function updateRemoveButtons() {
    const rows = segmentsContainer.querySelectorAll('.segment-row');
    rows.forEach((row, idx) => {
        const btn = row.querySelector('.remove-segment');
        if (btn) btn.remove(); // Remove any existing button
        if (rows.length > 1 && idx === rows.length - 1) {
            // Only add remove button to the last row if more than one row
            const removeBtn = document.createElement('button');
            removeBtn.type = 'button';
            removeBtn.className = 'remove-segment btn btn-link text-danger';
            removeBtn.style = 'position:absolute;top:8px;right:10px;';
            removeBtn.innerHTML = '&times;';
            removeBtn.onclick = function() {
                row.remove();
                updateRemoveButtons();
            };
            row.appendChild(removeBtn);
        }
    });
}

// Call after page load to set up the first row
updateRemoveButtons();
        window.locationOptions = @json($locationOptions);
  

            let segmentIndex = 1;
            
            // Update trip option active state
            function updateTripOptionActive() {
                const selectedValue = document.querySelector('input[name="trip_type"]:checked').value;
                tripOptions.forEach(option => {
                    if (option.getAttribute('data-type') === selectedValue) {
                        option.classList.add('active');
                    } else {
                        option.classList.remove('active');
                    }
                });
            }
            
            // Update form based on trip type
            function updateForm() {
                const selected = document.querySelector('input[name="trip_type"]:checked').value;
                
                // Update UI for trip options
                updateTripOptionActive();
                
                if (selected === 'one_way') {
                    returnDateCol.classList.add('d-none');
                    addSegmentBtn.classList.add('d-none');
                    changable.classList.add('changable3');
                    // Remove extra segments if any
                    document.querySelectorAll('.segment-row:not(.first-segment-row)').forEach(row => row.remove());
                } else if (selected === 'round_trip') {
                    changable.classList.remove('d-none');
                    returnDateCol.classList.remove('d-none');
                    returnDateCol.getElementsByTagName('input')[0].setAttribute('required','true')
                    addSegmentBtn.classList.add('d-none');
                    changable.classList.remove('changable3');
                    document.querySelectorAll('.segment-row:not(.first-segment-row)').forEach(row => row.remove());
                } else if (selected === 'multi_destination') {
                    returnDateCol.classList.add('d-none');
                    addSegmentBtn.classList.remove('d-none');
                    changable.classList.add('changable3');
                }
            }
            
            // Set initial state
            updateForm();
            
            // Trip type change event
            tripTypeRadios.forEach(radio => {
                radio.addEventListener('change', updateForm);
            });
            
            // Trip option click event
            tripOptions.forEach(option => {
                option.addEventListener('click', function() {
                    const radio = this.querySelector('input[type="radio"]');
                    radio.checked = true;
                    updateForm();
                });
            });
            
            // Set initial state
function createSegmentRow(index) {
    // Build select options HTML
    let optionsHtml = '<option value="">City or airport</option>';
    window.locationOptions.forEach(function(opt) {
        optionsHtml += `<option value="${opt.id}">${opt.text}</option>`;
    });

    // Build the row HTML
    const row = document.createElement('div');
    row.className = 'segment-row flight-segment-row';
    row.innerHTML = `
        <span class="segment-number">${index + 1}</span>
        <div class="row changable3" id="changable3">
            <div class="col-md-3 mb-2 mb-md-0">
                <div class="form-group">
                    <i class="field-icon icofont-paper-plane" style="left:15px !important;position:absolute"></i>
                    <div class="form-content">
                        <label class="form-label">From Where</label>
                        <select required class="form-select select2-location" name="from_where[]" id="select2-location-from${index}" data-placeholder="Select location">
                            ${optionsHtml}
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-2 mb-md-0">
                <div class="form-group">
                    <i class="field-icon icofont-paper-plane" style="left:15px !important;position:absolute"></i>
                    <div class="form-content">
                        <label class="form-label">To Where</label>
                        <select required class="form-select select2-location" name="to_where[]" id="select2-location-to${index}" data-placeholder="Select location">
                            ${optionsHtml}
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-2 mb-md-0" style="margin-left: -2%;">
                <div class="form-group">
                    <div class="form-content">
                        <label class="form-label">Departure</label>
                        <input required style="height:25px !important;color:#5191fa !important" name="start[]" type="date" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <button type="button" class="remove-segment btn btn-link text-danger" style="position:absolute;top:8px;right:10px;">&times;</button>
    `;
    // Remove button event
    
    row.querySelector('.remove-segment').onclick = function() {
        row.remove();
    };
    return row;
}
            
            // Add segment button
addSegmentBtn.addEventListener('click', function () {
    const segmentRows = segmentsContainer.querySelectorAll('.segment-row');
    const newIndex = segmentRows.length;
    console.log(newIndex)
    const newRow = createSegmentRow(newIndex);
    addSegmentBtn.parentNode.insertBefore(newRow, addSegmentBtn);

    // Initialize Select2 for new selects
    $(newRow).find('.select2-location').select2({
        width: '100%',
        placeholder: 'Select location'
    });
    updateRemoveButtons();
});

    </script>
    <script>
$(document).ready(function() {
    // Toggle passenger dropdown
    $('.passenger-selector-trigger').on('click', function(e) {
        e.stopPropagation();
        $('.passenger-selector-dropdown').toggle();
    });
    
    // Close when clicking elsewhere
    $(document).on('click', function() {
        $('.passenger-selector-dropdown').hide();
    });
    
    // Prevent dropdown close when clicking inside
    $('.passenger-selector-dropdown').on('click', function(e) {
        e.stopPropagation();
    });
    
    // Passenger counter functionality
    $('.passenger-plus').on('click', function(e) {
        e.stopPropagation();
        const type = $(this).data('type');
        const input = $(this).siblings('.passenger-count');
        let value = parseInt(input.val());
        const max = parseInt(input.attr('max'));
        
        if (value < max) {
            input.val(value + 1);
            updatePassengerSummary();
            updatePassengerLimits();
        }
    });
    
    $('.passenger-minus').on('click', function(e) {
        e.stopPropagation();
        const type = $(this).data('type');
        const input = $(this).siblings('.passenger-count');
        let value = parseInt(input.val());
        const min = parseInt(input.attr('min'));
        
        if (value > min) {
            input.val(value - 1);
            updatePassengerSummary();
            updatePassengerLimits();
        }
    });
    
    // Update passenger summary text
    function updatePassengerSummary() {
        const adults = parseInt($('input[name="adults"]').val());
        const children = parseInt($('input[name="children"]').val());
        const infants = parseInt($('input[name="infants"]').val());
        
        let summary = `${adults} Adult${adults !== 1 ? 's' : ''}`;
        if (children > 0) summary += `, ${children} Child${children !== 1 ? 'ren' : ''}`;
        if (infants > 0) summary += `, ${infants} Infant${infants !== 1 ? 's' : ''}`;
        
        $('.passenger-summary').text(summary);
    }
    
    // Ensure there's at least 1 adult and infants don't exceed adults
    function updatePassengerLimits() {
        const adults = parseInt($('input[name="adults"]').val());
        const infants = parseInt($('input[name="infants"]').val());
        
        // Ensure infants don't exceed adults
        if (infants > adults) {
            $('input[name="infants"]').val(adults);
        }
        
        // Update max values
        $('input[name="infants"]').attr('max', adults);
        updatePassengerSummary();
    }
    
    // Done button
    $('.passenger-done').on('click', function() {
        $('.passenger-selector-dropdown').hide();
    });
    
    // Initialize
    updatePassengerSummary();
});
</script>

<style>
    .passenger-minus, .passenger-plus {
        height: auto !important;
    }
.passenger-selector-trigger {
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background-color: white;
}

.passenger-selector-dropdown {
    background-color: white;
    border: 1px solid #dee2e6;
    border-radius: 5px;
    top: 100%;
    left: 0;
}

.passenger-count {
    background-color: #fff;
    border-left: none;
    border-right: none;
    font-weight: bold;
    height: 32px;
}

.passenger-minus, .passenger-plus {
    width: 32px;
    height: 32px;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-color: #ced4da;
}

.passenger-minus:hover, .passenger-plus:hover {
    background-color: #f8f9fa;
}

.card-title i {
    color: #0d6efd;
}

.passenger-done {
    padding: 5px 15px;
    font-size: 14px;
}
</style>
</body>