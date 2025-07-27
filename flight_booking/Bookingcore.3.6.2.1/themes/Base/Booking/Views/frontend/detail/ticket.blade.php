<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>E-Ticket | Skyline Egypt Tours</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;400&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <style>
    body { background: #f2f7fc; font-family: 'Roboto', Arial, sans-serif; margin:0; padding:30px 0; }
    .tickets-wrapper { display:flex; flex-wrap:wrap; gap:36px; justify-content:center;}
    .ticket-container { max-width: 780px; background:#fff; margin:0 auto; border-radius:24px; box-shadow:0 6px 36px rgba(36, 97, 172, 0.09); padding:38px 34px 32px 34px; border:1.5px solid #d3e5fa; position:relative; min-width:380px;}
    .ticket-header { display:flex; align-items:center; gap:16px; border-bottom:1.5px solid #ddeafd; padding-bottom:17px; }
    .airline-logo { height:48px; width:48px; border-radius:50%; border:2px solid #d3e5fa; object-fit:contain; background:#f4f8fd; }
    .airline-name { font-family:'Montserrat',sans-serif; font-size:1.5rem; font-weight:700; color:#245fae; letter-spacing:2px; }
    .ticket-badge { margin-left:auto; background:#245fae; color:#fff; font-size:0.98rem; font-weight:500; border-radius:14px; padding:6px 22px; }
    .record-locator { margin-top:7px; font-size:0.99rem; color:#2461ae; letter-spacing:2px; }
    .section-title { font-size:1.18rem; font-weight:700; color:#184c7f; margin-top:32px; margin-bottom:10px; letter-spacing:1px;}
    .details-table, .segment-table { width:100%; border-collapse:collapse; margin-bottom:20px;}
    .details-table th, .details-table td, .segment-table th, .segment-table td { text-align:left; padding:7px 7px; }
    .details-table th { background:#eaf3fb; color:#245fae; font-size:1.01rem; }
    .segment-table th { background:#eaf3fb; color:#245fae; font-size:1.01rem; }
    .details-table td, .segment-table td { font-size:0.97rem; background:#f9fbff; }
    .barcode { margin: 28px 0 0 0; text-align: center; opacity: 0.7;}
    .ticket-footer { font-size:0.93rem; color:#7b91b0; margin-top:18px; }
    .download-btn { margin-top:20px; background:#245fae; color:#fff; border:none; border-radius:11px; padding:11px 36px; font-size:1.1rem; font-family:'Montserrat',sans-serif; font-weight:500; cursor:pointer; box-shadow:0 3px 16px rgba(36,97,174,0.08); transition:background 0.18s;}
    .download-btn:hover { background:#1a437e;}
    .powered { position:absolute; top:18px; right:26px; font-size:0.87rem; color:#c2d6f7;}
    @media (max-width: 900px) { .ticket-container { max-width:99vw; padding:2vw 1vw; min-width:unset;}}
    @media print {
      body { background: #fff !important; }
      .ticket-container { box-shadow: none !important; border:1.5px solid #d3e5fa !important; }
      .download-btn, .powered, .hide-on-print { display:none !important;}
      .tickets-wrapper { display:block !important;}
    }
  </style>
</head>
<body>
<div class="tickets-wrapper" id="tickets"></div>
<script>
  // Shared segments & booking data
  const ticket = {
    recordLocator: "CGFKMF",
    ticketid:"{{$booking->code}}",
    segments: <?php 
    $flights=$booking->flights;
  foreach($flights as $flight){
    $flight['flight']=$flight->flight;
    $flight['seat']=$flight->fare;
    $flight['airport_from']=$flight->flight->get_airport_from()->name;
    $flight['airport_to']=$flight->flight->get_airport_to()->name;
  }
  echo(json_encode($flights));
  ?>,
    footer: "If you have any queries, contact reservation@skylineegypttours.com"
  };

  // Each passenger gets their own ticket
  const passengers = <?php 
  echo(json_encode($booking->passengers));
  ?>

function createTicket(passenger, idx) {
  let segmentRows = "";

  ticket.segments.forEach(s => {
    const arrival_date = new Date(s.flight.arrival_time);
    const departure_date = new Date(s.flight.departure_time);
    segmentRows += `<tr>
      <td>${s.airport_from}</td>
      <td>${s.airport_to}</td>
      <td>${arrival_date.toLocaleString('en-GB')}</td>
      <td>${departure_date.toLocaleString('en-GB')}</td>
      <td>${s.seat.seat_type || "-"}</td>
      <td>${s.seat.baggage_cabin || "-"} Kg</td>
    </tr>`;
  });

    return `
    <div class="ticket-container" id="ticket${idx}">
      <span class="powered">Powered by Skyline</span>
      <div class="ticket-header">
                       <a href="{{url(app_get_locale(false,'/'))}}" class="bravo-logo">
                    @php
                        $logo_id = setting_item("logo_id");
                        if(!empty($row->custom_logo)){
                            $logo_id = $row->custom_logo;
                        }
                    @endphp
                    @if($logo_id)
                        <?php $logo = get_file_url($logo_id,'full') ?>
                        <img height='40px' src="{{$logo}}" alt="{{setting_item("site_title")}}">
                    @endif
                </a>
        <div>
          <div class="airline-name">Kemet Wings</div>
        </div>
      </div>
      <div class="section-title"><i class="bi bi-person"></i> Passenger Details</div>
      <table class="details-table">
        <tr><th>Name</th><td>${passenger.first_name}</td></tr>
        <tr><th>Name</th><td>${passenger.last_name}</td></tr>
        <tr><th>Ticket Number</th><td>${ticket.ticketid}_${passenger.id}</td></tr>
      </table>
      <div class="section-title"><i class="bi bi-airplane"></i> Flight Segment(s)</div>
      <table class="segment-table">
        <thead>
          <tr>
            <th>From</th>
            <th>To</th>
            <th>Arrival</th>
            <th>Departure</th>
            <th>Seat</th>
            <th>Baggage</th>
          </tr>
        </thead>
        <tbody>${segmentRows}</tbody>
      </table>

      <button class="download-btn" onclick="printTicket('ticket${idx}')"><i class="bi bi-download"></i> Download Ticket</button>
      <div class="ticket-footer">${ticket.footer}</div>
    </div>
    `;
  }

  // Render tickets for all passengers
  const wrapper = document.getElementById('tickets');
  wrapper.innerHTML = passengers.map(createTicket).join('');

  // Print/download just one ticket
  window.printTicket = function(ticketId) {
    const ticketElem = document.getElementById(ticketId);
    const printWindow = window.open('', '', 'height=800,width=700');
    printWindow.document.write('<html><head><title>Print Ticket</title>');
    Array.from(document.head.querySelectorAll('style,link')).forEach(styleTag => {
      printWindow.document.write(styleTag.outerHTML);
    });
    printWindow.document.write('</head><body style="background:#fff;">');
    printWindow.document.write(ticketElem.outerHTML);
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    setTimeout(() => { printWindow.print(); printWindow.close(); }, 250);
  };
</script>
</body>
</html> 
