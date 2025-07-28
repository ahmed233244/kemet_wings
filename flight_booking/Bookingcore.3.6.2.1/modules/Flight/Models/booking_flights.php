<?php


    namespace Modules\Flight\Models;


    use App\BaseModel;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\SoftDeletes;
    use Modules\Flight\Factories\AirLineFactory;
    use Modules\Booking\Models\Booking;
    class booking_flights extends Model
    {
        use SoftDeletes;

        protected $table ='booking_flights';
        protected $fillable = [
            'booking_id',
            'fare_id',
            'flight_id',
            'segment_number',
            'adult_price',
            'child_price',
            'infant_price',
            'deleted_at',
        ];

    
        public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function flight()
    {
        return$this->belongsTo(Flight::class);
    }

    public function fare()
    {
        return $this->belongsTo(FlightSeat::class, 'fare_id');
    }
    }