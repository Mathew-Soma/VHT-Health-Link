<?php
namespace App\Http\Controllers;

use AfricasTalking\SDK\AfricasTalking;
use App\Models\HealthInspector;

trait SmsTrait 
{
    public function sendSms($message, $phone)
    {
        $username = config("africastalking.username_sandbox");
        $apiKey = config("africastalking.api_key_sandbox");

        $AT = new AfricasTalking($username, $apiKey);
        
        $sms = $AT->sms();
    
        try {
            $result = $sms->send([
                'to'      => $phone,
                'message' => $message
            ]);
                
            print_r($result);
        } catch (Exception $e) {
            echo "Error: ".$e.getMessage();
        }

        return "I am done";
    }


    public function sendSmsToInspectors($message)
    {
        $username = config("africastalking.username_sandbox");
        $apiKey = config("africastalking.api_key_sandbox");

        $AT = new AfricasTalking($username, $apiKey);
        
        $sms = $AT->sms();
    
        try {
            // Retrieve phone numbers of doctors from the database
            $doctors = HealthInspector::all(); // Assuming all doctors are in the 'doctors' table
            foreach ($doctors as $doctor) {
                $result = $sms->send([
                    'to'      => $doctor->Phone, // Assuming the phone number field is 'phone' in the doctors table
                    'message' => $message
                ]);
                
                // Handle or log the result if needed
                print_r($result);
            }
        } catch (\Exception $e) {
            echo "Error: ".$e->getMessage();
        }

        return "SMS sent to all doctors";
    }
}