<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kemet Wings Flight Booking</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    
    <style>
      @media (max-width: 900px) {
    .container { padding: 0 4vw; }
    .segments-container { flex-direction: column; }
    .flight-card, .segment-card { min-width: 0; width: 100%; }
    .footer-content { flex-direction: column; align-items: flex-start; gap: 1em;}
}
@media (max-width: 600px) {
    .header-content, .footer-content { flex-direction: column; align-items: flex-start; }
    .header-actions { gap: 7px; }
    .segment-header, .flight-times { flex-direction: column; align-items: flex-start; gap:8px;}
    .trip-header { flex-direction: column; align-items: flex-start;}
}

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        :root {
            --primary: #4169E1;
            --primary-light:white;
            --text-dark: #333333;
            --text-light: #666666;
            --bg-light: #f5f7fa;
            --border: #e0e0e0;
            --white: #ffffff;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
            line-height: 1.6;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }
        
        /* Header Styles */
        header {
            background-color: var(--white);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            padding: 15px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .logo-icon {
            width: 36px;
            height: 36px;
            background-color: var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .logo-icon i {
            color: white;
            font-size: 18px;
        }
        
        .logo-text {
            font-size: 24px;
            font-weight: 700;
            color: var(--primary);
        }
        
        .header-actions {
            display: flex;
            gap: 15px;
        }
        
        .btn-outline {
            padding: 8px 15px;
            border: 1px solid var(--border);
            border-radius: 4px;
            background: transparent;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .btn-outline:hover {
            background: #40E0D0;
        }
        
        .btn-primary {
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            background: var(--primary);
            color: white;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s;
        }
        
        .btn-primary:hover {
            background: #40E0D0;
        }
        
        /* Trip Summary */
        .trip-summary {
            background: var(--white);
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 20px;
            margin: 20px 0;
        }
        
        .trip-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            flex-wrap: wrap;
            gap: 15px;
        }
        
        .trip-type {
            display: inline-block;
            padding: 4px 10px;
            background: var(--primary-light);
            color: var(--primary);
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
        }
        
        .passengers-summary {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        
        .passenger-badge {
            padding: 4px 12px;
            background: #f0f2f5;
            border-radius: 20px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .segments-container {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            margin-top: 15px;
        }
        
        .segment-card {
            background: #f9fafb;
            border-radius: 8px;
            padding: 15px;
            flex: 1;
            min-width: 250px;
            border: 1px solid #eaeaea;
        }
        
        .segment-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        
        .segment-number {
            width: 24px;
            height: 24px;
            background: var(--primary);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: bold;
        }
        
        .segment-date {
            color: var(--text-light);
            font-size: 14px;
        }
        
        .segment-route {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }
        
        .segment-airports {
            font-weight: 600;
            font-size: 18px;
        }
        
        .segment-duration {
            color: var(--text-light);
            font-size: 14px;
            text-align: center;
            margin-top: 5px;
        }
        
        .segment-line {
            position: relative;
            height: 1px;
            background: var(--border);
            flex-grow: 1;
            margin: 0 10px;
        }
        
        .segment-line:before {
            content: "";
            position: absolute;
            top: -3px;
            left: 0;
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--primary);
        }
        
        .segment-line:after {
            content: "";
            position: absolute;
            top: -3px;
            right: 0;
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--primary);
        }
        
        .segment-plane {
            position: absolute;
            top: -8px;
            left: 50%;
            transform: translateX(-50%);
            color: var(--primary);
        }
        
        .segment-cities {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            color: var(--text-light);
        }
        
        /* Flight Options */
        .flight-section {
            background: var(--white);
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 20px;
            margin-bottom: 20px;
            scroll-margin-top: 100px;
            border: 1px solid #f0f0f0;
        }
        
        .section-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border);
        }
        
        .section-title {
            font-size: 18px;
            font-weight: 600;
        }
        
        .section-subtitle {
            color: var(--text-light);
            font-size: 14px;
        }
        

        
        .flight-card {
            border: 1px solid var(--border);
            border-radius: 8px;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        .flight-card:hover {
            border-color: var(--primary);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .flight-card.selected {
            border: 2px solid var(--primary);
            box-shadow: 0 0 0 3px var(--primary-light);
        }
        
        .flight-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            background: #f9fafb;
            border-bottom: 1px solid var(--border);
        }
        
        .airline-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .airline-logo {
            width: 32px;
            height: 32px;
            background: #e9ecef;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .airline-logo i {
            color: var(--primary);
            font-size: 14px;
        }
        
        .airline-name {
            font-weight: 500;
        }
        
        .flight-price {
            font-size: 18px;
            font-weight: 700;
            color: var(--primary);
        }
        
        .flight-details {
            padding: 15px;
        }
        
        .flight-times {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
        
        .time-block {
            text-align: center;
            flex: 1;
        }
        
        .time-value {
            font-size: 18px;
            font-weight: 600;
        }
        
        .time-label {
            font-size: 12px;
            color: var(--text-light);
        }
        
        .flight-duration {
            text-align: center;
            color: var(--text-light);
            font-size: 14px;
            padding: 0 10px;
            position: relative;
            flex: 2;
        }
        
        .flight-duration:before {
            content: "";
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: var(--border);
            z-index: 1;
        }
        
        .duration-text {
            position: relative;
            z-index: 2;
            background: var(--white);
            padding: 0 5px;
            display: inline-block;
        }
        
        .flight-route {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            font-size: 14px;
            color: var(--text-light);
        }
        
        .flight-fares {

            margin-top: 15px;
        }
        
        .fare-option {
            border: 1px solid var(--border);
            border-radius: 4px;
            padding: 10px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        .fare-option:hover {
            border-color: var(--primary);
            background: var(--primary-light);
        }
        
        .fare-option.selected {
            border-color: var(--primary);
            background: var(--primary-light);
            box-shadow: 0 0 0 2px var(--primary);
        }
        
        .fare-name {
            font-weight: 500;
            margin-bottom: 5px;
        }
        
        .fare-price {
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 0.8rem;
        }
        
        .fare-description {
            font-size: 12px;
            color: var(--text-light);
            margin-top: 5px;
        }
        
        .select-btn {
            width: 100%;
            padding: 10px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 4px;
            font-weight: 500;
            margin-top: 15px;
            cursor: pointer;
            transition: background 0.2s;
        }
        
        .select-btn:hover {
            background: #40E0D0;
        }
        
        .select-btn.selected {
            background: #28a745;
        }
        
        .select-btn.selected:hover {
            background: #218838;
        }
        
        /* Footer */
        footer {
            background: var(--white);
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.05);
            padding: 20px 0;
        }
        
        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .total-price {
            font-size: 24px;
            font-weight: 700;
            color: var(--primary);
        }
        
        .continue-btn {
            padding: 12px 30px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 4px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }
        
        .continue-btn:disabled {
            background: #cccccc;
            cursor: not-allowed;
        }
        
        .continue-btn:hover:not(:disabled) {
            background: #40E0D0;
        }
        
        /* Progress */
        .progress-container {
            display: flex;
            justify-content: center;
            margin: 20px 0;
        }
        
        .progress-bar {
            display: flex;
            gap: 10px;
            align-items: center;
            flex-direction: row;
        }
        
        .progress-step {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #dddddd;
            transition: background 0.3s;
        }
        
        .progress-step.active {
            background: var(--primary);
        }
        
        .progress-label {
            font-size: 14px;
            color: var(--text-light);
            margin-left: 5px;
        }
        
        /* Scroll target */
        .scroll-target {
            scroll-margin-top: 100px;
        }
        
        /* Debug message */
        .debug-message {
            background: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
            display: none;
        }
        
        .debug-message.show {
            display: block;
        }
        @media (max-width: 600px) {
    .trip-summary {
        padding: 10px 4vw;
        margin: 10px 0;
    }
    .trip-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }
    .passengers-summary {
        gap: 7px;
    }
    .segments-container {
        flex-direction: column;
        gap: 10px;
    }
    .segment-card {
        padding: 10px 7px;
        font-size: 15px;
    }
    h2 {
        font-size: 18px;
        margin-bottom: 2px;
    }
}
@media (max-width: 600px) {
    .fare-details {
        font-size: 13px;
        padding: 5px 0;
    }
    .fare-main {
        flex-direction: column;
        align-items: flex-start;
    }
}
    </style>
</head>
<body>
<div id="loader" style="
  display:none;
  position:fixed;
  z-index:9999;
  top:0; left:0; width:100vw; height:100vh;
  background:rgba(255,255,255);
  align-items:center; justify-content:center;
  flex-direction:column;">
  <i class="fas fa-spinner fa-spin" style="font-size:2.5rem;color:#4169E1"></i>
  <div style="margin-top:16px;font-size:1.1em;color:#444;">Loading flights...</div>
</div>
    <header>
        <div class="container">
            <div class="header-content">
                <a href="{{url(app_get_locale(false,'/'))}}" class="bravo-logo">
                    @php
                        $logo_id = setting_item("logo_id");
                        if(!empty($row->custom_logo)){
                            $logo_id = $row->custom_logo;
                        }
                    @endphp
                    @if($logo_id)
                        <?php $logo = get_file_url($logo_id,'full') ?>
                        <img height='70px' src="{{$logo}}" alt="{{setting_item("site_title")}}">
                    @endif
                </a>
                <div class="header-actions">
                    <button class="btn-primary">
                        <i class="fas fa-globe"></i> EN
                    </button>
                </div>
            </div>
        </div>
    </header>
    
    <div class="container">

        
        <div class="trip-summary">
            <div class="trip-header">
                <div>
                    <span class="trip-type">Multi-Destination</span>
                    <h2>Select your flights</h2>
                </div>
                <div class="passengers-summary">
                    <div class="passenger-badge">
                        <i class="fas fa-user"></i> 
                    </div>
                    <div class="passenger-badge">
                        <i class="fas fa-child"></i>
                    </div>
                    <div class="passenger-badge">
                        <i class="fas fa-baby"></i>
                    </div>
                </div>
            </div>
            
            <div class="segments-container">
            </div>
        </div>
        
        <div class="progress-container">
<div class="progress-bar">
    <span class='progress-bar' id="progress-steps"></span>
    <span id="progressBar" class="progress-label"></span>
</div>
        </div>
        
        <!-- Flight Segments -->
         <div id="flight-segments-root">
         </div>
    
    <footer>
        <div class="container">
            <div class="footer-content">
                <div>
                    <div id="footer-total-label" style="font-size: 14px; color: #666;">Total for 4 passengers</div>
                    <div class="total-price">$0.00</div>
                </div>
                <button class="continue-btn"id='submitBookingBtn' disabled>Continue</button>
            </div>
        </div>
    </footer>

<script>
const tripData = {
  trip_type: "{{$_REQUEST['trip_type']}}",
  from_where: {!! json_encode($_REQUEST['from_where']) !!},
  to_where: {!! json_encode($_REQUEST['to_where']) !!},
  start: {!! json_encode($_REQUEST['start']) !!},
  adults: "{{$_REQUEST['adults']}}",
  children: "{{$_REQUEST['children']}}",
  infants: "{{$_REQUEST['infants']}}",
};
const flights_by_segment = {!! json_encode($rows) !!};
const selectedFlights={}

function formatDate(d) {
  const dt = new Date(d);
  if (isNaN(dt)) return d;
  return dt.toLocaleDateString('en-US', { day:'2-digit', month:'short', year:'numeric' });
}
function getSegments() {
    return (tripData.from_where || []).map((from, i) => ({
      from: from,
      to: tripData.to_where[i],
      date: tripData.start[i],
      flights: flights_by_segment?.[i] || []
    }));
  }

function renderProgressSteps(count) {
    let steps = '';
    for (let i = 0; i < count; i++) {
        steps += `<div class="progress-step"></div>`;
    }
    document.getElementById('progress-steps').innerHTML = steps;
}
// ---- TRIP SUMMARY (CARDS) ----
function renderTripSummary() {
  // Trip type label
  const typeMap = {
    "one_way": "One Way",
    "round_trip": "Round Trip",
    "multi_destination": "Multi-Destination"
  };
  document.querySelector('.trip-type').textContent = typeMap[tripData.trip_type] || "Trip";

  // Passengers
  document.querySelector('.passengers-summary').innerHTML = `
    <div class="passenger-badge">
      <i class="fas fa-user"></i> ${tripData.adults} Adult
    </div>
    <div class="passenger-badge">
      <i class="fas fa-child"></i> ${tripData.children} Children
    </div>
    <div class="passenger-badge">
      <i class="fas fa-baby"></i> ${tripData.infants} Infant
    </div>

  `;

  // Segment cards (summary at top)
  const segments = getSegments();
  renderProgressSteps(segments.length);
  document.querySelector('.segments-container').innerHTML = segments.map((seg, i) => `
    <div class="segment-card">
      <div class="segment-header">
        <div class="segment-number">${i+1}</div>
        <div class="segment-date">${formatDate(seg.date)}</div>
      </div>
      <div class="segment-route">
        <div class="segment-airports">${seg.flights[0]?.airport_from_name ?? ''}</div>
        <div class="segment-line"><i class="fas fa-plane segment-plane"></i></div>
        <div class="segment-airports">${seg.flights[0]?.airport_to_name ?? ''}</div>
      </div>
      <div class="segment-cities">
        <div>${seg.flights[0]?.location_from ?? ''}</div>
        <div>${seg.flights[0]?.location_to ?? ''}</div>
      </div>
      <div class="segment-duration">${seg.flights[0]?.duration || ""}</div>
    </div>
  `).join('');
  // Update total label in footer
  const totalPax = (+tripData.adults||0) + (+tripData.children||0) + (+tripData.infants||0);
  document.getElementById("footer-total-label").textContent = `Total for ${totalPax} passengers`;
}
function formatTimeOnly(dateTimeStr) {
    const dt = new Date(dateTimeStr);
    // Pad to 2 digits
    const pad = n => n.toString().padStart(2, '0');
    return pad(dt.getHours()) + ':' + pad(dt.getMinutes());
}
// ---- FLIGHT SEGMENTS (DYNAMIC) ----
function renderFlightSegments() {
  const root = document.getElementById("flight-segments-root");
  const segments = getSegments();
  let flightSectionsHTML = "";

  segments.forEach((seg, i) => {
    const segmentNum = i+1;
    let flightCards = "";

if (seg.flights.length === 0) {
  flightCards = `
    <div class="col-12 text-center py-4">
      <div class="alert alert-warning" role="alert">
        No flights available for this segment.
      </div>
    </div>
  `;
      flightSectionsHTML += `
      <div class="flight-section scroll-target" id="segment${segmentNum}">
        <div class="section-header">
          <div class="segment-number">${segmentNum}</div>
          <div>
            <div class="section-title">${seg.flights[0]?.airport_from_name ?? ''}  ${seg.flights[0]?.airport_to_name ?? ''}</div>
            <div class="section-subtitle">${formatDate(seg.date)}</div>
          </div>
        </div>
        <div class="flight-cards row justify-content-center">
          ${flightCards}
        </div>
      </div>
    `;
}else{
    const flightCards = seg.flights.map((flight, flightIndex) => {
      const faresHTML = (flight.flight_seat || []).map((fare, fareIdx) => `
  <div class="fare-option col-4"
      data-segment="${segmentNum}" 
      data-flight="${flightIndex}" 
      data-fare="${fareIdx}"
      data-price-adult="${fare.price ?? fare.price}" 
      data-price-child="${fare.child_price ?? fare.price}" 
      data-fare-id="${fare.id}" 
      data-price-infant="${fare.infant_price ?? fare.price}">
    <div class="fare-main">
      <div class="fare-name">${fare.seat_type}</div>
      <div class="fare-price">$${fare.price }</div>
      <button class="show-fare-details-btn fare-rules-btn" type="button" 
        data-title="Fare Rules for ${fare.seat_type}" 
        data-details="<strong>Baggage:</strong> ${fare.baggage_cabin}kg Hand, ${fare.baggage_check_in}kg Checked<br><strong>Rules:</strong> ${fare.rules || 'Non-refundable. No changes allowed.'}">
        <i class="fas fa-info-circle"></i> Fare Rules
      </button>
    </div>
  </div>
`).join("");
      return `
        <div class="flight-card col-6" data-flight-id=${flight.id} data-segment="${segmentNum}" data-flight="${flightIndex}">
          <div class="flight-header">
            <div class="airline-info">
              <div class="airline-logo"><i class="fas fa-plane"></i></div>
              <div class="airline-name">${flight.title}</div>
            </div>
          </div>
          <div class="flight-details">
            <div class="flight-times">
              <div class="time-block">
                <div class="time-value">${formatTimeOnly(flight.departure_time)}</div>
                <div class="time-label">${seg.flights[0]?.location_from}</div>
              </div>
              <div class="flight-duration">
                <div class="duration-text">${flight.duration}</div>
              </div>
              <div class="time-block">
                <div class="time-value">${formatTimeOnly(flight.arrival_time)}</div>
                <div class="time-label">${seg.flights[0]?.location_to}</div>
              </div>
            </div>
            <div class="flight-route">
              <div>${flight.airport_from_name} Airport</div>
              <div style='text-align:right'>${flight.airport_to_name} Airport</div>
            </div>
            <div class="flight-fares row justify-content-center">
              ${faresHTML}
            </div>
            <button class="select-btn" data-segment="${segmentNum}" data-flight="${flightIndex}">Select Flight</button>
          </div>
        </div>
      `;
    }).join("");
    flightSectionsHTML += `
      <div class="flight-section scroll-target" id="segment${segmentNum}">
        <div class="section-header">
          <div class="segment-number">${segmentNum}</div>
          <div>
            <div class="section-title">${seg.flights[0]?.airport_from_name ?? ''}  ${seg.flights[0]?.airport_to_name ?? ''}</div>
            <div class="section-subtitle">${formatDate(seg.date)}</div>
          </div>
        </div>
        <div class="flight-cards row justify-content-center">
          ${flightCards}
        </div>
      </div>
    `;
      console.log(flightCards)
  }})

  root.innerHTML = flightSectionsHTML;
}

document.addEventListener("DOMContentLoaded", function() {
  function showLoader() { document.getElementById('loader').style.display = 'flex'; }
function hideLoader() { document.getElementById('loader').style.display = 'none'; }

// For demo, wrap fetching in setTimeout
showLoader();
  renderTripSummary();
  renderFlightSegments();
    hideLoader();
    document.body.addEventListener('click', function(e) {
    if (e.target.classList.contains('show-fare-details-btn')) {
        const fareOption = e.target.closest('.fare-option');
        const details = fareOption.querySelector('.fare-details');
        if (details) {
            const visible = details.style.display === 'block';
            details.style.display = visible ? 'none' : 'block';
            e.target.textContent = visible ? 'Show Fare Rules' : 'Hide Fare Rules';
        }
    }
});

  const segments = getSegments();
  // Dynamically build selectedFlights for any trip length
  for (let i = 1; i <= segments.length; i++) {
    selectedFlights[i] = { flight: null, fare: null };
  }

  function updateProgress() {
    const progressSteps = document.querySelectorAll('.progress-step');
    const progressLabel = document.querySelector('.progress-label');
    let completedSegments = 0;
    for (let i = 1; i <= segments.length; i++) {
      if (selectedFlights[i].flight && selectedFlights[i].fare) completedSegments++;
    }
    progressSteps.forEach((step, index) => {
      step.classList.toggle('active', index < completedSegments);
    });
    progressLabel.textContent = `${completedSegments} of ${segments.length} segments completed`;
    document.querySelector('.continue-btn').disabled = completedSegments < segments.length;
    updateTotalPrice();
  }
function formatMoney(val) {
  // Adapt this as needed
  return "USD " + Number(val).toLocaleString('en-EG', {minimumFractionDigits: 2, maximumFractionDigits: 2});
}

function updateTotalPrice() {
  let totalAdults = 0, totalChildren = 0, totalInfants = 0;
  let total = 0;
  const adults = +tripData.adults || 0;
  const children = +tripData.children || 0;
  const infants = +tripData.infants || 0;

  for (let i = 1; i <= segments.length; i++) {
    const fare = selectedFlights[i].fare;
    if (fare) {
      totalAdults   += (fare.price_adult   ?? fare.price) * adults;
      totalChildren += (fare.child_price   ?? fare.price) * children;
      totalInfants  += (fare.infant_price  ?? fare.price) * infants;
    }
  }
  total = totalAdults + totalChildren + totalInfants;

  // Update footer
  document.querySelector('.total-price').textContent = formatMoney(total);

  let details = '';
  if (adults)  details += `<div>${adults} X Adult${adults>1?'s':''} &nbsp; &nbsp; ${formatMoney(totalAdults)}</div>`;
  if (children) details += `<div>${children} X Child${children>1?'ren':''} &nbsp; &nbsp; ${formatMoney(totalChildren)}</div>`;
  if (infants) details += `<div>${infants} X Infant${infants>1?'s':''} &nbsp; &nbsp; ${formatMoney(totalInfants)}</div>`;
  details += `<div style="font-weight:bold;margin-top:6px;">Total all inclusive &nbsp; ${formatMoney(total)}</div>`;

  document.getElementById("footer-total-label").innerHTML = details;
}

  document.querySelectorAll('.flight-card').forEach(card => {
    const segment = parseInt(card.querySelector('.select-btn').dataset.segment);

    const selectBtn = card.querySelector('.select-btn');

    // Initially disable select buttons visually
    selectBtn.classList.add('disabled');
    selectBtn.disabled = true;

    card.querySelectorAll('.fare-option').forEach(fareOption => {
      fareOption.addEventListener('click', function () {
        // Unselect all other cards and fares in the same segment
        document.querySelectorAll(`#segment${segment} .flight-card`).forEach(otherCard => {
          if (otherCard !== card) {
            otherCard.classList.remove('selected');
            otherCard.querySelectorAll('.fare-option').forEach(f => f.classList.remove('selected'));
            const otherBtn = otherCard.querySelector('.select-btn');
            otherBtn.classList.add('disabled');
            otherBtn.disabled = true;
            otherBtn.textContent = 'Select Flight';
            otherBtn.classList.remove('selected');
          }
        });

        // Clear previously selected flight & fare for this segment
        selectedFlights[segment] = { flight: null, fare: null };

        card.querySelectorAll('.fare-option').forEach(f => f.classList.remove('selected'));
        this.classList.add('selected');
        const fareName = this.querySelector('.fare-name').textContent;
        const farePriceAdult = parseFloat(this.getAttribute('data-price-adult') || this.querySelector('.fare-price').textContent.replace('$', ''));
        const farePriceChild = parseFloat(this.getAttribute('data-price-child') || farePriceAdult);
        const fareid = this.getAttribute('data-fare-id');
        const farePriceInfant = parseFloat(this.getAttribute('data-price-infant') || farePriceAdult);

        selectedFlights[segment].fare = { 
          price_adult: farePriceAdult, 
          child_price: farePriceChild, 
          infant_price: farePriceInfant, 
          name: fareName,
          id:fareid
        };

        selectBtn.classList.remove('disabled');
        selectBtn.disabled = false;


        updateProgress();
      });
    });

    selectBtn.addEventListener('click', function () {
      if (!selectedFlights[segment].fare) return;

      document.querySelectorAll(`#segment${segment} .flight-card`).forEach(otherCard => {
        otherCard.classList.remove('selected');
        const otherBtn = otherCard.querySelector('.select-btn');
        otherBtn.textContent = 'Select Flight';
        otherBtn.classList.remove('selected');
      });

      card.classList.add('selected');
      this.textContent = '✓ Selected';
      this.classList.add('selected');

      const airline = card.querySelector('.airline-name').textContent;
      const departureTime = card.querySelector('.time-value:first-child').textContent;
      const arrivalTime = card.querySelectorAll('.time-value')[card.querySelectorAll('.time-value').length - 1].textContent;
      const flightid = card.getAttribute('data-flight-id');

      selectedFlights[segment].flight = {
        airline: airline,
        departureTime: departureTime,
        arrivalTime: arrivalTime,
        id:flightid
      };

      updateProgress();

      if (segment < segments.length) {
        const next = document.getElementById(`segment${segment + 1}`);
        if (next) setTimeout(() => next.scrollIntoView({ behavior: 'smooth' }), 300);
      }
      if (segment === segments.length) {
    setTimeout(() => {
      document.querySelector('footer').scrollIntoView({ behavior: 'smooth' });
    }, 400);
  }

    });
  });

  updateProgress();
  function showFareModal(title, detailsHtml) {
    document.getElementById('fare-modal-title').textContent = title;
    document.getElementById('fare-modal-body').innerHTML = detailsHtml;
    document.getElementById('fare-modal').style.display = 'flex';
    document.body.style.overflow = 'hidden'; // prevent scroll
}
function hideFareModal() {
    document.getElementById('fare-modal').style.display = 'none';
    document.body.style.overflow = '';
}
document.getElementById('close-fare-modal').onclick = hideFareModal;
document.getElementById('fare-modal').onclick = function(e){
  if (e.target === this) hideFareModal();
};
document.body.addEventListener('click', function(e) {
    if (e.target.classList.contains('show-fare-details-btn')) {
        const btn = e.target;
        showFareModal(
            btn.getAttribute('data-title'), 
            btn.getAttribute('data-details')
        );
    }
});   
var submitBookingBtn=document.getElementById('submitBookingBtn')
submitBookingBtn.addEventListener('click', function () {
  console.log(selectedFlights)
fetch('/booking/addToCart', {
  method: 'POST',
  headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
  body: JSON.stringify({
    service_type: 'flight',
    service_id: '1',
    adults: tripData.adults,
    children: tripData.children,
    infants: tripData.infants,
    segments: selectedFlights
  })
})
.then(res => res.json())
.then(data => {
  if (data.url) window.location.href = data.url;
  else alert("Booking error: " + JSON.stringify(data));
});
});
});

</script>

<style>
    .select-btn.disabled {
        background: #ccc !important;
        cursor: not-allowed !important;
    }
    .fare-rules-btn {
  display: flex;
  align-items: center;
  gap: 6px;
  background: transparent;
  border: none;
  color: var(--primary);
  font-weight: 500;
  font-size: 15px;
  cursor: pointer;
  padding: 4px 8px;
  border-radius: 20px;
  transition: background 0.15s;
}
.fare-rules-btn:hover, .fare-rules-btn:focus {
  background: #f2f6ff;
  color: #254ecb;
}
.fare-rules-btn .fa-info-circle {
  font-size: 18px;
}
.fare-rules-text {
  display: inline;
  transition: opacity 0.2s;
}

/* Modal */
#fare-modal {
  display: none;
  position: fixed;
  z-index: 99999;
  top: 0; left: 0;
  width: 100vw; height: 100vh;
  background: rgba(40,60,120,0.17);
  align-items: center;
  justify-content: center;
  animation: modalBgIn .22s cubic-bezier(.5,.5,.3,1);
}
@keyframes modalBgIn { from { background: rgba(40,60,120,0); } to { background: rgba(40,60,120,0.17); } }

#fare-modal-content {
  background: #fff;
  border-radius: 18px;
  box-shadow: 0 8px 48px rgba(0,0,0,0.19);
  width: 95%;
  max-width: 420px;
  padding: 32px 22px 22px 22px;
  position: relative;
  transform: translateY(24px);
  opacity: 0;
  animation: modalIn .27s cubic-bezier(.5,1,.2,1) forwards;
}
@keyframes modalIn { to { transform: translateY(0); opacity: 1; } }

#close-fare-modal {
  position: absolute;
  top: 10px; right: 12px;
  background: none;
  border: none;
  font-size: 22px;
  color: #888;
  cursor: pointer;
  border-radius: 50%;
  padding: 5px;
  transition: background .15s;
}
#close-fare-modal:hover {
  background: #eee;
  color: #e00;
}
#fare-modal-title {
  font-size: 1.18rem;
  font-weight: 700;
  margin-bottom: 14px;
  color: #2c3e50;
}
#fare-modal-body {
  color: #35495e;
  font-size: 15.5px;
  line-height: 1.7;
}
@media (max-width: 600px) {
  #fare-modal-content {
    padding: 20px 7vw 20px 7vw;
    max-width: 97vw;
    font-size: 15px;
  }
  #fare-modal-title { font-size: 1rem; }
}

</style>
<div id="fare-modal" style="display:none; position:fixed; z-index:99999; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.32); align-items:center; justify-content:center;">
  <div id="fare-modal-content" style="background:#fff; border-radius:8px; box-shadow:0 8px 32px rgba(0,0,0,0.18); width:90%; max-width:420px; padding:30px 18px 18px 18px; position:relative;">
    <button id="close-fare-modal" style="position:absolute;top:12px;right:12px; background:none; border:none; font-size:18px; cursor:pointer;"><i class="fas fa-times"></i></button>
    <h3 style="margin-bottom:10px;" id="fare-modal-title">Fare Rules</h3>
    <div id="fare-modal-body" style="color:#333;font-size:16px;line-height:1.6;">
      <!-- Fare rules inserted here dynamically -->
    </div>
  </div>
</div>
</body>
</html>