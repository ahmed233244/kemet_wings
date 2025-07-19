@extends('layouts.app')
@push('css')
    <link href="{{ asset('module/booking/css/checkout.css?_ver='.config('app.asset_version')) }}" rel="stylesheet">
@endpush
@section('content')
    <div class="bravo-booking-page padding-content" >
        <div class="container">
            @include ('Booking::frontend/global/booking-detail-notice')
            <div class="row booking-success-detail">
                <div class="col-md-8">
                    @include ($service->booking_customer_info_file ?? 'Booking::frontend/booking/booking-customer-info')
                    <div class="text-center">
                        <a href="{{route('user.booking_history')}}" class="btn btn-primary">{{__('Booking History')}}</a>
                    </div>
                </div>
                <div class="col-md-4">
                    @extends('layouts.app')
@push('css')
    <link href="{{ asset('module/booking/css/checkout.css?_ver='.config('app.asset_version')) }}" rel="stylesheet">
@endpush
@section('content')
    <div class="bravo-booking-page padding-content" >
        <div class="container">
            @include ('Booking::frontend/global/booking-detail-notice')
            <div class="row booking-success-detail">
                <div class="col-md-8">
                    @include ($service->booking_customer_info_file ?? 'Booking::frontend/booking/booking-customer-info')
                    <div class="text-center">
                        <a href="{{route('user.booking_history')}}" class="btn btn-primary">{{__('Booking History')}}</a>
                    </div>
                </div>
                <div class="col-md-4">
                    @php
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
@endphp

@if($booking_flights->count())
    <div class="price-summary-box" style="max-width:480px;margin:20px auto;padding:16px;background:#f8fafb;border-radius:10px;box-shadow:0 2px 8px #0001;">
        <h3 style="font-size:1.3em;margin-bottom:14px;">Price Summary</h3>
        <ul style="list-style:none;padding:0;margin:0;">
            @foreach($booking_flights as $segment)
                @php
                    $segment_total = 0;
                @endphp
                <li style="margin-bottom:9px;">
                    <strong>
                        Segment {{ $segment->segment_number ?? '' }}:
                        {{ $segment->flight->get_airport_from()['code'] ?? '' }}
                        <i class="fa fa-arrow-right"></i>
                        {{ $segment->flight->get_airport_to()['code'] ?? '' }}
                        <span style="font-size:12px;font-weight:400;color:#888;">
                            {{ $segment->fare['seat_type'] ?? '' }}
                        </span>
                    </strong>
                    <ul style="padding-left:12px;margin:4px 0 0 0;">
                        @foreach($passenger_types as $type => $info)
                            @php
                                $count = $passengerCounts[$type];
                                $price = $segment[strtolower($type) . '_price'] ?? 0;
                                $line_total = $count * $price;
                                $segment_total += $line_total;
                            @endphp
                            @if($count && $price)
                                <li class="ps-type-{{ $info['class'] }}" style="display:flex;justify-content:space-between;font-size:14px;">
                                    <span>
                                        {{ $count }} × {{ $info['label'] }}
                                        <span style="color:#666;">@ {{ format_money($price) }}</span>
                                    </span>
                                    <span>{{ format_money($line_total) }}</span>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                    <div style="text-align:right;font-size:13px;font-weight:600;color:#335;margin-top:3px;">
                        Subtotal: {{ format_money($segment_total) }}
                    </div>
                </li>
                <hr style="border:none;border-top:1px dashed #ddd;margin:9px 0;">
                @php $grand_total += $segment_total; @endphp
            @endforeach
        </ul>
        <div style="margin-top:10px;font-size:18px;font-weight:bold;text-align:right;color:#155;">
            Grand Total: {{ format_money($grand_total) }}
        </div>
        <div style="margin-top:5px;font-size:12px;color:#888;text-align:right;">
            <i>All taxes &amp; fees included</i>
        </div>
    </div>
@endif

                </div>
            </div>
        </div>
    </div>
@endsection

                </div>
            </div>
        </div>
    </div>
@endsection
