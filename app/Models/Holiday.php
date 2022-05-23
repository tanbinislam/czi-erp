<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'country', 'date', 'type'];

    public static function holidays($year)
    {
        if(self::whereYear('date', $year)->count() < 1){
            $url = "https://calendarific.com/api/v2/holidays?&api_key=7828ed4e884d1d38eb3144afb0a7f573d8caa944&country=BD&year=".$year."&type=national";
    
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_HEADER => false,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_RETURNTRANSFER => true,
            ));
            $data = curl_exec($curl);
            curl_close($curl);
            $response = json_decode($data, true);

            foreach($response['response']['holidays'] as $holiday){
                self::create([
                    'name' => $holiday['name'],
                    'description' => $holiday['description'],
                    'country' => $holiday['country']['name'],
                    'date' => $holiday['date']['iso'],
                    'type' => $holiday['type'][0],
                ]);
            }
        }

        $holidays = self::whereYear('date', $year)->get();
        return $holidays;
        
    }
}
