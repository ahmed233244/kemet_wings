@php $lang_local = app()->getLocale() @endphp
<div class="booking-review">
    <h4 class="booking-review-title">{{__("Your Booking")}}</h4>
    <div class="booking-review-content">
                    @foreach($booking->flights as $flight_booking)
        <div class="review-section">
            <div class="service-info">
                <div class="mt-2">
                    <h3 class="service-name">{!! clean($flight_booking->flight->airline->name) !!}</h3>
                </div>
                <div class="font-weight-medium  mb-3">
                    <p class="mb-1">
                        {{__(':from to :to',['from'=>$flight_booking->flight->airportFrom->location->name,'to'=>$flight_booking->flight->airportTo->location->name])}}
                    </p>
                    {{__(":duration hrs",['duration'=>$flight_booking->flight->duration])}}
                </div>

                <div class="flex-self-start justify-content-between">
                    <div class="flex-self-start">
                        <div class="mr-2">
                            <i class="icofont-airplane font-size-30 text-primary"></i>
                        </div>
                        <div class="text-lh-sm ml-1">
                            <h6 class="font-weight-bold font-size-21 text-gray-5 mb-0">{{$flight_booking->flight->departure_time->format('H:i')}}</h6>
                            <span class="font-size-14 font-weight-normal text-gray-1">{{$flight_booking->flight->airportFrom->name}} Airport</span>
                        </div>
                    </div>
                    <div class="text-center d-none d-md-block d-lg-none">
                        <div class="mb-1">
                            <h6 class="font-size-14 font-weight-bold text-gray-5 mb-0">{{__(":duration hrs",['duration'=>$flight_booking->flight->duration])}}</h6>
                        </div>
                    </div>
                    <div class="flex-self-start">
                        <div class="mr-2">
                            <i class="d-block rotate-90 icofont-airplane-alt font-size-30 text-primary"></i>
                        </div>
                        <div class="text-lh-sm ml-1">
                            <h6 class="font-weight-bold font-size-21 text-gray-5 mb-0">{{$flight_booking->flight->arrival_time->format("H:i")}}</h6>
                            <span class="font-size-14 font-weight-normal text-gray-1">{{$flight_booking->flight->airportTo->name}} Airport</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        @endforeach

        <div class="review-section total-review">
            <ul class="review-list1">
@php
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
@endphp

@if(!empty($booking_flights))
    <div class="price-summary-box" style="max-width:480px;margin:20px auto;padding:16px;background:#f8fafb;border-radius:10px;box-shadow:0 2px 8px #0001;">
        <h3 style="font-size:1.3em;margin-bottom:14px;">Price Summary</h3>
        <ul style="list-style:none;padding:0;margin:0;">
            @foreach($booking_flights as $segment)
                @php
                    $segment_total = 0;
                @endphp
                <li style="margin-bottom:9px;">
                    <strong>
                        Segment {{ $segment['segment_number'] ?? '' }}:
                        {{ $segment->flight->get_airport_from()['code'] ?? '' }} <i class="fa fa-arrow-right"></i> {{ $segment->flight->get_airport_to()['code'] ?? '' }}
                        <span style="font-size:12px;font-weight:400;color:#888;">
                            {{ $segment->fare['seat_type'] ?? '' }}
                        </span>
                    </strong>
                    <ul style="padding-left:12px;margin:4px 0 0 0;">
                        @foreach($person_types as $ptype)
                            @php
                                $count = $passenger_counts[$ptype['key']] ?? 0;
                                $price = $segment[$ptype['class'].'_price'] ?? 0;
                                $line_total = $count * $price;
                                $segment_total += $line_total;
                            @endphp
                            @if($count && $price)
                                <li class="ps-type-{{ $ptype['class'] }}" style="display:flex;justify-content:space-between;font-size:14px;">
                                    <span>
                                        {{ $count }} × {{ $ptype['label'] }}
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
            @endforeach
        </ul>
        <div style="margin-top:10px;font-size:18px;font-weight:bold;text-align:right;color:#155;">
            Grand Total: {{ format_money($booking->total) }}
        </div>
        <div style="margin-top:5px;font-size:12px;color:#888;text-align:right;">
            <i>All taxes &amp; fees included</i>
        </div>
    </div>
@endif

                @php $extra_price = $booking->getJsonMeta('extra_price') @endphp
                @if(!empty($extra_price))
                    <li>
                        <div>
                            {{__("Extra Prices:")}}
                        </div>
                    </li>
                    @foreach($extra_price as $type)
                        <li>
                            <div class="label">{{$type['name_'.$lang_local] ?? __($type['name'])}}:</div>
                            <div class="val">
                                {{format_money($type['total'] ?? 0)}}
                            </div>
                        </li>
                    @endforeach
                @endif
                @php
                    $list_all_fee = [];
                    if(!empty($booking->buyer_fees)){
                        $buyer_fees = json_decode($booking->buyer_fees , true);
                        $list_all_fee = $buyer_fees;
                    }
                    if(!empty($vendor_service_fee = $booking->vendor_service_fee)){
                        $list_all_fee = array_merge($list_all_fee , $vendor_service_fee);
                    }
                @endphp
                @if(!empty($list_all_fee))
                    @foreach ($list_all_fee as $item)
                        @php
                            $fee_price = $item['price'];
                            if(!empty($item['unit']) and $item['unit'] == "percent"){
                                $fee_price = ( $booking->total_before_fees / 100 ) * $item['price'];
                            }
                        @endphp
                        <li>
                            <div class="label">
                                {{$item['name_'.$lang_local] ?? $item['name']}}
                                <i class="icofont-info-circle" data-toggle="tooltip" data-placement="top" title="{{ $item['desc_'.$lang_local] ?? $item['desc'] }}"></i>
                                @if(!empty($item['per_person']) and $item['per_person'] == "on")
                                    : {{$booking->total_guests}} * {{format_money( $fee_price )}}
                                @endif
                            </div>
                            <div class="val">
                                @if(!empty($item['per_person']) and $item['per_person'] == "on")
                                    {{ format_money( $fee_price * $booking->total_guests ) }}
                                @else
                                    {{ format_money( $fee_price ) }}
                                @endif
                            </div>
                        </li>
                    @endforeach
                @endif
                @includeIf('Coupon::frontend/booking/checkout-coupon')
                <li class="final-total d-block">
                    <div class="d-flex justify-content-between">
                        <div class="label">{{__("Total:")}}</div>
                        <div class="val">{{format_money($booking->total)}}</div>
                    </div>
                    @if($booking->status !='draft')
                        <div class="d-flex justify-content-between">
                            <div class="label">{{__("Paid:")}}</div>
                            <div class="val">{{format_money($booking->paid)}}</div>
                        </div>
                        @if($booking->paid < $booking->total )
                            <div class="d-flex justify-content-between">
                                <div class="label">{{__("Remain:")}}</div>
                                <div class="val">{{format_money($booking->total - $booking->paid)}}</div>
                            </div>
                        @endif
                    @endif
                </li>
                @include ('Booking::frontend/booking/checkout-deposit-amount')
            </ul>
        </div>
    </div>
</div>