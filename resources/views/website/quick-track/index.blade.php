@extends('layouts.eventlayout')

@section('title', 'EverSabz Blogs: Insights, Tips & Trends for a Sustainable Lifestyle')
@section('description', 'Explore insightful articles on sustainable living, eco-friendly tips, and green innovations. Join us on a journey towards a more sustainable future.')

@section('content')

<style>
/* ======== Base ======== */
body {
  font-family: "Segoe UI", sans-serif;
  background: #f4f6f8;
  margin: 0;
  color: #222;
  overflow-x: hidden;
}

.rightmarginadjust {
  text-align-last: right;
}

/* ======== Header ======== */
.quick-track-header {
  position: relative;
  background-color: #12181f;
  color: #fff;
  text-align: center;
  padding: 70px 20px 160px;
  overflow: hidden;
}

.quick-track-header::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 60%;
  height: 100%;
  background-image: linear-gradient(
      135deg,
      transparent 0%,
      transparent 40%,
      rgba(255, 255, 255, 0.05) 40%,
      rgba(255, 255, 255, 0.05) 60%,
      transparent 60%,
      transparent 100%
    ),
    linear-gradient(
      225deg,
      transparent 0%,
      transparent 40%,
      rgba(255, 255, 255, 0.07) 40%,
      rgba(255, 255, 255, 0.07) 60%,
      transparent 60%,
      transparent 100%
    );
  background-size: 200px 200px;
  opacity: 0.15;
  clip-path: polygon(0 0, 100% 0, 60% 100%, 0% 100%);
}

.quick-track-header h3 {
  font-size: 28px;
  margin-bottom: 25px;
  letter-spacing: 0.5px;
  font-weight: 600;
  color: #fff !important;
}

/* ======== Search Box ======== */
.track-box {
  position: relative;
  max-width: 550px;
  margin: 0 auto;
}
.track-box input {
  width: 640px;
  padding: 14px 65px 14px 18px;
  border-radius: 6px;
  border: none;
  outline: none;
  font-size: 15px;
  color: #333;
}
.track-box .close-icon,
.track-box .search-icon {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  cursor: pointer;
  color: #888;
  font-size: 16px;
}
.track-box .close-icon {
  right: -43px;
}
.track-box .search-icon {
  right: -69px;
}
.track-box .close-icon:hover,
.track-box .search-icon:hover {
  color: #000;
}

/* ======== Toggle Switch ======== */
.track-options {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-top: 18px;
  gap: 10px;
  font-size: 14px;
  color: #ccc;
  margin-left: -26%;
}
.switch {
  position: relative;
  width: 45px;
  height: 22px;
}
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: #555;
  transition: 0.4s;
  border-radius: 34px;
}
.slider:before {
  content: "";
  position: absolute;
  height: 16px;
  width: 16px;
  left: 3px;
  bottom: 3px;
  background: white;
  transition: 0.4s;
  border-radius: 50%;
}
input:checked + .slider {
  background: #e50914;
}
input:checked + .slider:before {
  transform: translateX(23px);
}

/* ======== White Floating Card ======== */
.tracking-result-box {
  background: #fff;
  max-width: 1300px;
  margin: -120px auto 60px;
  border-radius: 12px;
  padding: 35px 40px;
  box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
  position: relative;
  z-index: 10;
}

/* ======== Tracking Info ======== */
.tracking-info {
  display: flex;
  justify-content: space-between;
  align-items: center;
  border-bottom: 1px solid #eee;
  padding-bottom: 15px;
}
.left-section h2 {
  color: #222;
  font-size: 22px;
  margin: 0;
}
.left-section .delivered {
  color: #27ae60;
  font-weight: 600;
  margin: 5px 0 0;
}
.left-section .receiver {
  color: #888;
  font-size: 14px;
  margin: 3px 0 0;
}
.right-section i {
  font-size: 20px;
  color: #666;
  cursor: pointer;
  transition: transform 0.3s ease;
}
.right-section i.rotate {
  transform: rotate(180deg);
}

/* ======== Shipment Info ======== */
.shipment-info {
  display: flex;
  justify-content: space-between;
  border-top: 1px solid #eee;
  padding-top: 15px;
  font-size: 14px;
}
.shipment-info div {
  flex: 1;
}
.shipment-info strong {
  display: block;
  color: #000;
}
.shipment-info p {
  margin: 4px 0 0;
  color: #555;
}

/* ======== Toggle Animation ======== */
#trackingDetails {
  max-height: 1000px;
  overflow: hidden;
  transition: max-height 0.6s ease, opacity 0.6s ease;
  opacity: 1;
}
#trackingDetails.hidden {
  max-height: 0;
  opacity: 0;
}

/* ======== Progress Bar (Overlapping Arrows) ======== */
.progress-bar {
  display: flex;
  margin: 40px 0 25px;
  color: #fff;
  text-transform: uppercase;
  font-size: 12px;
  font-weight: 600;
  letter-spacing: 0.5px;
}
.step {
  position: relative;
  flex: 1;
  padding: 14px 0;
  text-align: center;
  background: #ccc;
  clip-path: polygon(0 0, calc(100% - 25px) 0, 100% 50%, calc(100% - 25px) 100%, 0 100%);
  transition: all 0.3s ease;
  z-index: 1;
}
.step:not(:last-child) {
  margin-right: -25px;
}
.step.orange {
  background: #e67e22;
  z-index: 6;
}
.step.magenta {
  background: #c0398f;
  z-index: 5;
}
.step.purple {
  background: #8e44ad;
  z-index: 4;
}
.step.blue {
  background: #2980b9;
  z-index: 3;
}
.step.green {
  background: #27ae60;
  z-index: 2;
}

/* ======== Tracking Details Table ======== */
.tracking-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin: 25px 0 10px;
}
.tracking-header h3 {
  margin: 0;
  font-size: 18px;
  font-weight: 700;
}
.expand-btn {
  background: #111;
  color: #fff;
  border: none;
  padding: 7px 14px;
  border-radius: 6px;
  cursor: pointer;
  font-size: 13px;
}
.expand-btn:hover {
  background: #000;
}

.tracking-list {
  border-top: 1px solid #eee;
  width: 100%;
}

.tracking-item {
  display: grid;
  grid-template-columns: 60px 1.2fr 1fr 1fr 0.8fr 0.8fr 40px;
  align-items: center;
  border-bottom: 1px solid #eee;
  padding: 12px 0;
  gap: 10px;
  text-align: center;
}

.icon {
  width: 38px;
  height: 38px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #fff;
  font-size: 15px;
  margin: 0 auto;
}
.icon.orange {
  background: #e67e22;
}
.icon.magenta {
  background: #c0398f;
}
.icon.purple {
  background: #8e44ad;
}
.icon.blue {
  background: #2980b9;
}
.icon.green {
  background: #27ae60;
}

.details strong {
  font-size: 14px;
  color: #111;
}
.date-time,
.location,
.count,
.view,
.arrow {
  font-size: 13px;
  color: #444;
}
.view a {
  color: #000;
  text-decoration: none;
  font-weight: 600;
}
.view a:hover {
  color: #007bff;
}
.arrow i {
  font-size: 15px;
  color: #666;
}

/* ======== Footer Note ======== */
.note {
  font-size: 13px;
  text-align: center;
  color: #555;
  margin-top: 25px;
  line-height: 1.6;
}
.note a {
  color: #007bff;
  text-decoration: none;
}
.note a:hover {
  text-decoration: underline;
}

/* Responsive */
@media (max-width: 900px) {
  .tracking-item {
    grid-template-columns: 1fr;
    text-align: left;
  }
}

/* ======== Help Card ======== */
.help-card {
  background: #fff;
  max-width: 1300px;
  margin: 0 auto 20px;
  border-radius: 10px;
  padding: 30px 40px;
  margin-top: -29px;
  box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}
.help-card h3 {
  font-size: 18px;
  font-weight: 600;
  margin-bottom: 20px;
}
.help-option {
  display: flex;
  align-items: center;
  gap: 10px;
  margin: 12px 0;
  color: #333;
  cursor: pointer;
}
.help-option i {
  font-size: 20px;
  color: #000;
}

/* ======== Scroll Up Button ======== */
#scrollUp {
  position: fixed;
  bottom: 25px;
  right: 25px;
  background: #12181f;
  color: #fff;
  border: none;
  border-radius: 50%;
  width: 45px;
  height: 45px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  font-size: 18px;
  box-shadow: 0 3px 8px rgba(0,0,0,0.3);
  transition: all 0.3s ease;
}
#scrollUp:hover {
  background: #000;
  transform: translateY(-3px);
}
</style>
</head>
<body>
<section class="tracking-container">
  <div class="quick-track-header">
    <h3>Quick Track</h3>
    <div class="track-box">
      <input type="text" placeholder="Enter Tracking Number" value="PRES507038" />
      <span class="close-icon"><i class="fa fa-times"></i></span>
      <span class="search-icon"><i class="fa fa-search"></i></span>
    </div>
    <div class="track-options">
      <span>Single</span>
      <label class="switch">
        <input type="checkbox" />
        <span class="slider round"></span>
      </label>
      <span>Multiple</span>
    </div>
  </div>

  <div class="tracking-result-box">
    <div class="tracking-info">
      <div class="left-section">
        <h2>PRES507038</h2>
        <p class="delivered">Delivered</p>
        <p class="receiver">Received by Abdle.</p>
      </div>
      <div class="right-section">
        <i class="fa fa-chevron-down" id="toggleArrow"></i>
      </div>
    </div>

    <div class="shipment-info">
      <div>
        <strong>Despatched Oct 27, 2025</strong>
        <p>Smeaton Grange, NSW, 2567</p>
      </div>
      <div class="rightmarginadjust">
        <strong>Delivered Oct 28, 2025</strong>
        <p>Noble Park, VIC, 3174</p>
      </div>
    </div>

    
      <div class="progress-bar">
        <div class="step orange">DATA RECEIVED</div>
        <div class="step magenta">PICKED UP</div>
        <div class="step purple">IN TRANSIT</div>
        <div class="step blue">ON BOARD</div>
        <div class="step green">DELIVERED</div>
      </div>
    <div id="trackingDetails">

      <div class="tracking-header">
        <h3>Tracking Details</h3>
        <button class="expand-btn"><i class="fa fa-filter"></i> Expand All</button>
      </div>

      <div class="tracking-list">
        <div class="tracking-item">
          <div class="icon orange"><i class="fa fa-database"></i></div>
          <div class="details" style="text-align-last: left;"><strong>Shipment Data Received</strong></div>
          <div class="date-time">27 Oct 2025 05:29 PM</div>
          <div class="location">Smeaton Grange, NSW</div>
          <div class="count"></div>
          <div class="view"></div>
          <div class="arrow"></div>
        </div>

        <div class="tracking-item">
          <div class="icon magenta"><i class="fa fa-truck"></i></div>
          <div class="details" style="text-align-last: left;"><strong>Picked Up</strong></div>
          <div class="date-time"></div>
          <div class="location"></div>
          <div class="count"></div>
          <div class="view"></div>
          <div class="arrow"></div>
        </div>

        <div class="tracking-item">
          <div class="icon purple"><i class="fa fa-plane"></i></div>
          <div class="details" style="text-align-last: left;"><strong>In Transit</strong></div>
          <div class="date-time">28 Oct 2025 08:25 AM</div>
          <div class="location">Cranbourne West, VIC</div>
          <div class="count"><i class="fa fa-archive" aria-hidden="true"></i> 1 of 1</div>
          <div class="view"><a href="#">View More</a></div>
          <div class="arrow"><i class="fa fa-chevron-down"></i></div>
        </div>

        <div class="tracking-item">
          <div class="icon blue"><i class="fa fa-ship"></i></div>
          <div class="details" style="text-align-last: left;"><strong>On Board</strong></div>
          <div class="date-time">28 Oct 2025 10:29 AM</div>
          <div class="location">Cranbourne West, VIC</div>
          <div class="count"><i class="fa fa-archive" aria-hidden="true"></i> 1 of 1</div>
          <div class="view"><a href="#">View More</a></div>
          <div class="arrow"><i class="fa fa-chevron-down"></i></div>
        </div>

        <div class="tracking-item">
          <div class="icon green"><i class="fa fa-check"></i></div>
          <div class="details" style="text-align-last: left;"><strong>Delivered</strong></div>
          <div class="date-time">28 Oct 2025 03:43 PM</div>
          <div class="location">Noble Park, VIC</div>
          <div class="count"><i class="fa fa-archive" aria-hidden="true"></i> 1 of 1</div>
          <div class="view"><a href="#">View More</a></div>
          <div class="arrow"><i class="fa fa-chevron-down"></i></div>
        </div>
      </div>

      <p class="note">
        Note: This search will display basic tracking information for the consignment. If you wish to see more detailed information, please <a href="#">sign in</a> to our customer portal. Alternatively, please <a href="#">contact us</a> for assistance.
      </p>
    </div>
  </div>
</section>

<!-- Help Card -->
<div class="help-card">
  <h3>Need Help with your Delivery?</h3>
  <div class="help-option"><i class="fa fa-bullseye"></i> I have not received this item</div>
  <div class="help-option"><i class="fa fa-info-circle"></i> I have a different issue</div>
</div>

<!-- Scroll Up Button -->
<button id="scrollUp"><i class="fa fa-arrow-up"></i></button>

<script>
const toggleArrow = document.getElementById("toggleArrow");
const trackingDetails = document.getElementById("trackingDetails");
toggleArrow.addEventListener("click", () => {
  trackingDetails.classList.toggle("hidden");
  toggleArrow.classList.toggle("rotate");
});

const scrollUp = document.getElementById("scrollUp");
scrollUp.addEventListener("click", () => {
  window.scrollTo({ top: 0, behavior: "smooth" });
});
</script>
</body>


@endsection