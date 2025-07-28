<!-- resources/views/reports/seat-report.blade.php -->


<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0"><i class="fas fa-chair me-2"></i>Flight Seats Report</h2>
        </div>
        
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Seat Type</th>
                            <th>Total Seats</th>
                            <th>Booked Seats</th>
                            <th>Available Seats</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $reportData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="fw-bold"><?php echo e($data['name']); ?></td>
                            <td><?php echo e($data['total']); ?></td>
                            <td>
                                <span class="badge bg-danger"><?php echo e($data['booked']); ?></span>
                            </td>
                            <td>
                                <span class="badge bg-success"><?php echo e($data['available']); ?></span>
                            </td>
                            <td>
                                <div class="progress" style="height: 20px;">
                                    <div class="progress-bar 
                                        <?php echo e($data['percentage'] > 90 ? 'bg-danger' : 
                                           ($data['percentage'] > 70 ? 'bg-warning' : 'bg-success')); ?>"
                                        role="progressbar" 
                                        style="width: <?php echo e($data['percentage']); ?>%"
                                        aria-valuenow="<?php echo e($data['percentage']); ?>" 
                                        aria-valuemin="0" 
                                        aria-valuemax="100">
                                        <?php echo e(round($data['percentage'])); ?>%
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4 p-3 bg-light rounded">
                <h4><i class="fas fa-chart-pie me-2"></i>Summary</h4>
                <div class="row mt-3">
                    <?php $__currentLoopData = $reportData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-3 mb-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-center">
                                <h5 class="card-title"><?php echo e($data['name']); ?></h5>
                                <div class="d-flex justify-content-around mt-3">
                                    <div>
                                        <span class="text-danger"><i class="fas fa-user-check"></i> <?php echo e($data['booked']); ?></span>
                                        <div class="small">Booked</div>
                                    </div>
                                    <div>
                                        <span class="text-success"><i class="fas fa-user-clock"></i> <?php echo e($data['available']); ?></span>
                                        <div class="small">Available</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
        
        <div class="card-footer text-muted">
            <small>Report generated on <?php echo e(now()->format('M d, Y h:i A')); ?></small>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .progress-bar {
        font-weight: 600;
        text-shadow: 1px 1px 1px rgba(0,0,0,0.3);
    }
    .card {
        border-radius: 10px;
        overflow: hidden;
    }
    .table th {
        background: #2c3e50;
        color: white;
    }
    .table-hover tbody tr:hover {
        background-color: rgba(41, 128, 185, 0.1);
    }
</style>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\PC\Documents\flight_booking\Bookingcore.3.6.2.1\modules/Flight/Views/admin/flight/seat/report.blade.php ENDPATH**/ ?>