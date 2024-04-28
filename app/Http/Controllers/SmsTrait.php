<?php
namespace App\Http\Controllers;

use AfricasTalking\SDK\AfricasTalking;
use App\Models\HealthInspector;
use App\Models\reportedcases;

trait SmsTrait
{
    public function sendSmsToInspectors()
    {
        $username = config('africastalking.username_sandbox');
        $apiKey = config('africastalking.api_key_sandbox');

        $AT = new AfricasTalking($username, $apiKey);

        $sms = $AT->sms();

        try {
            // Retrieve the most recent reported diseases case from the database
            $recentCase = reportedcases::latest()->first();  // Assuming the model for reported cases is 'ReportedCase'

            // If there's no reported case, return with a message
            if (!$recentCase) {
                return 'No reported cases found.';
            }

            // Compose the message with data from the most recent reported case
            $message = "New diseases case:\n"
                . 'VHT Name: ' . $recentCase->VHT_Name . "\n"
                . 'Phone: ' . $recentCase->Phone . "\n"
                . 'Disease Name: ' . $recentCase->DiseaseName . "\n"
                . 'No of Patients: ' . $recentCase->Number_of_Patients . "\n"
                . 'District: ' . $recentCase->District . "\n"
                . 'Village: ' . $recentCase->Village . "\n"
                // Retrieve phone numbers of inspectors from the database
                . $inspectors = HealthInspector::all();  // Assuming all inspectors are in the 'health_inspectors' table

            foreach ($inspectors as $inspector) {
                $result = $sms->send([
                    'to' => $inspector->Phone,  // Assuming the phone number field is 'Phone' in the inspectors table
                    'message' => $message
                ]);

                // Handle or log the result if needed
                // print_r($result);
            }
        } catch (\Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }

        return 'SMS sent to all inspectors';
    }
}
