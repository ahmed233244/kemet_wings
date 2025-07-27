<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Invoice</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      color: #333;
      padding: 40px;
      background: #f7f7f7;
    }

    .invoice-box {
      max-width: 800px;
      margin: auto;
      background: #fff;
      padding: 30px;
      border: 1px solid #eee;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
    }

    .invoice-box h1 {
      text-align: center;
      color: #1a73e8;
    }

    .flight-block {
      border: 1px solid #ddd;
      margin-top: 20px;
      padding: 15px;
      border-radius: 8px;
      background: #fafafa;
    }

    .flight-header {
      font-weight: bold;
      margin-bottom: 10px;
      color: #444;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }

    th, td {
      padding: 8px;
      text-align: left;
    }

    th {
      background: #f0f0f0;
      font-weight: bold;
      border-bottom: 1px solid #ccc;
    }

    td {
      border-bottom: 1px solid #eee;
    }

    .total-box {
      margin-top: 30px;
      text-align: right;
      font-size: 18px;
      font-weight: bold;
      color: #222;
    }

    .price {
      text-align: right;
    }

    .center {
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="invoice-box">
    <h1>Invoice</h1>

    <?php $grandTotal = 0; ?>

    <?php $__currentLoopData = $booking->flights; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php
        $flight = $fb->flight;
        $seat = $fb->fare;

        $adult_price = $seat->price ?? 0;
        $child_price = $seat->child_price ?? 0;
        $infant_price = $seat->infant_price ?? 0;

        $counts = ['adult' => 0, 'child' => 0, 'infant' => 0];

        foreach ($booking->passengers as $p) {
          $type = strtolower($p->type ?? '');
          if (isset($counts[$type])) {
            $counts[$type]++;
          }
        }

        $segment_total =
          $counts['adult'] * $adult_price +
          $counts['child'] * $child_price +
          $counts['infant'] * $infant_price;

        $grandTotal += $segment_total;
      ?>

      <div class="flight-block">
        <div class="flight-header">
          <?php echo e($flight->get_airport_from()->name); ?> → <?php echo e($flight->get_airport_to()->name); ?>

          <span style="float:right;"><?php echo e(\Carbon\Carbon::parse($flight->departure_time)->format('d M Y')); ?></span>
        </div>

        <table>
          <thead>
            <tr>
              <th>Passenger Type</th>
              <th>Count</th>
              <th>Unit Price</th>
              <th class="price">Total</th>
            </tr>
          </thead>
          <tbody>
            <?php if($counts['adult']): ?>
              <tr>
                <td>Adult</td>
                <td><?php echo e($counts['adult']); ?></td>
                <td>EGP<?php echo e(number_format($adult_price, 2)); ?></td>
                <td class="price">EGP<?php echo e(number_format($counts['adult'] * $adult_price, 2)); ?></td>
              </tr>
            <?php endif; ?>
            <?php if($counts['child']): ?>
              <tr>
                <td>Child</td>
                <td><?php echo e($counts['child']); ?></td>
                <td>EGP<?php echo e(number_format($child_price, 2)); ?></td>
                <td class="price">EGP<?php echo e(number_format($counts['child'] * $child_price, 2)); ?></td>
              </tr>
            <?php endif; ?>
            <?php if($counts['infant']): ?>
              <tr>
                <td>Infant</td>
                <td><?php echo e($counts['infant']); ?></td>
                <td>EGP<?php echo e(number_format($infant_price, 2)); ?></td>
                <td class="price">EGP<?php echo e(number_format($counts['infant'] * $infant_price, 2)); ?></td>
              </tr>
            <?php endif; ?>
            <tr>
              <td colspan="3" class="price"><strong>Subtotal</strong></td>
              <td class="price"><strong>EGP<?php echo e(number_format($segment_total, 2)); ?></strong></td>
            </tr>
          </tbody>
        </table>
      </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <div class="total-box">
      Total All Inclusive: EGP<?php echo e(number_format($grandTotal, 2)); ?>

    </div>
    <div style="text-align: right; margin-bottom: 20px;">
  <button onclick="window.print()" style="
    padding: 10px 20px;
    background-color: #1a73e8;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;
    margin-top:1rem
  ">🖨️ Print Invoice</button>
</div>
  </div>
</body>
</html>
<?php /**PATH C:\Users\PC\Documents\flight_booking\Bookingcore.3.6.2.1\themes/Base/User/Views/frontend/bookingInvoice.blade.php ENDPATH**/ ?>