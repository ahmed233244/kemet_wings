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
    airline: "Egyptair",
    logo: "https://upload.wikimedia.org/wikipedia/commons/2/23/EgyptAir_Logo.svg",
    recordLocator: "CGFKMF",
    ticketClass: "Economy (Y)",
    segments: [
      {
        from: "Cairo (CAI)", to: "Aswan (ASW)", flight: "MS 247", date: "Friday 13 June 2025",
        depTime: "08:00", arrTime: "09:25", terminal: "3", class: "Economy (Y)",
        baggage: "1PC", status: "Confirmed"
      }
    ],
    footer: "If you have any queries, contact reservation@skylineegypttours.com"
  };

  // Each passenger gets their own ticket
  const passengers = [
    { name: "Zehnder, Matthew James", ticketNumber: "MS 0773439283786", baggage: "1PC", seat: "" },
    { name: "Zehnder, Andrew James", ticketNumber: "MS 0773439283787", baggage: "1PC", seat: "" },
    { name: "Zehnder, Julie Meredith", ticketNumber: "MS 0773439283788", baggage: "1PC", seat: "" },
    { name: "Zehnder, Hayley Rachel", ticketNumber: "MS 0773439283789", baggage: "1PC", seat: "" }
  ];

  function createTicket(passenger, idx) {
    let segmentRows = "";
    ticket.segments.forEach(s =>
      segmentRows += `<tr>
        <td>${s.from}</td>
        <td>${s.to}</td>
        <td>${s.flight}</td>
        <td>${s.date}</td>
        <td>${s.depTime}</td>
        <td>${s.arrTime}</td>
        <td>${s.terminal || "-"}</td>
        <td>${s.class || "-"}</td>
        <td>${s.baggage || "-"}</td>
        <td>${s.status}</td>
      </tr>`
    );
    return `
    <div class="ticket-container" id="ticket${idx}">
      <span class="powered">Powered by Skyline</span>
      <div class="ticket-header">
        <img src="${ticket.logo}" class="airline-logo" alt="Airline Logo"/>
        <div>
          <div class="airline-name">${ticket.airline}</div>
          <div class="record-locator">Record Locator: ${ticket.recordLocator}</div>
        </div>
        <span class="ticket-badge">${ticket.ticketClass}</span>
      </div>
      <div class="section-title"><i class="bi bi-person"></i> Passenger Details</div>
      <table class="details-table">
        <tr><th>Name</th><td>${passenger.name}</td></tr>
        <tr><th>Ticket Number</th><td>${passenger.ticketNumber || "-"}</td></tr>
        <tr><th>Baggage</th><td>${passenger.baggage || "-"}</td></tr>
        <tr><th>Seat</th><td>${passenger.seat || "-"}</td></tr>
      </table>
      <div class="section-title"><i class="bi bi-airplane"></i> Flight Segment(s)</div>
      <table class="segment-table">
        <thead>
          <tr>
            <th>From</th>
            <th>To</th>
            <th>Flight</th>
            <th>Date</th>
            <th>Departure</th>
            <th>Arrival</th>
            <th>Terminal</th>
            <th>Class</th>
            <th>Baggage</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>${segmentRows}</tbody>
      </table>
      <div class="barcode">
        <svg width="140" height="42">
          <rect x="10" y="5" width="12" height="32" fill="#bbb"/>
          <rect x="24" y="5" width="5" height="32" fill="#245fae"/>
          <rect x="32" y="5" width="3" height="32" fill="#bbb"/>
          <rect x="37" y="5" width="15" height="32" fill="#245fae"/>
          <rect x="54" y="5" width="7" height="32" fill="#bbb"/>
          <rect x="63" y="5" width="12" height="32" fill="#245fae"/>
          <rect x="77" y="5" width="5" height="32" fill="#bbb"/>
          <rect x="84" y="5" width="6" height="32" fill="#245fae"/>
          <rect x="92" y="5" width="4" height="32" fill="#bbb"/>
          <rect x="98" y="5" width="14" height="32" fill="#245fae"/>
        </svg>
      </div>
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
<?php /**PATH C:\Users\PC\Documents\flight_booking\Bookingcore.3.6.2\themes/Base/Booking/Views/frontend/detail/ticket.blade.php ENDPATH**/ ?>