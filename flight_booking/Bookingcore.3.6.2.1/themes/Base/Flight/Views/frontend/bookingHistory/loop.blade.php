<tr>
    <td class="booking-history-type">

            <i class="{{$booking->flights->first->flight->flight->getServiceIconFeatured()}}"></i>
        <small>{{$booking->object_model}}</small>
    </td>
    <td>
        <?php foreach($booking->flights as $f){
            echo $f->flight->title.'('.$f->flight->code.')<hr style="display:block !important">';

        }
        ?>
    </td>
    <td class="a-hidden">{{display_date($booking->created_at)}}</td>
    <td class="a-hidden">
         <?php foreach($booking->flights as $f){
echo "Departure time : ".display_datetime($f->flight->departure_time)."<br>"
        ."Arrival Time : ".display_datetime($f->flight->arrival_time)."<br>"
        ."Duration :".$f->flight->duration.'hrs <hr style="display:block !important">';
        }
        ?>
        

    </td>
    <td>{{format_money($booking->total)}}</td>
    <td class="{{$booking->status}} a-hidden">{{$booking->statusName}}</td>
    <td width="2%">
        @if($service = $booking->service)
            <a class="btn btn-xs btn-primary btn-info-booking" href="{{route('booking.ticket',['booking'=>$booking])}}">
                <i class="fa fa-info-circle"></i>{{__("Tickets")}}
            </a>
        @endif
        <a href="{{route('user.booking.invoice',['code'=>$booking->code])}}" class="btn btn-xs btn-primary btn-info-booking open-new-window mt-1" onclick="window.open(this.href); return false;">
            <i class="fa fa-print"></i>{{__("Invoice")}}
        </a>
        @if($booking->status == 'unpaid')
            <a href="{{route('booking.checkout',['code'=>$booking->code])}}" class="btn btn-xs btn-primary btn-info-booking open-new-window mt-1">
                {{__("Pay now")}}
            </a>
        @endif
    </td>
</tr>
