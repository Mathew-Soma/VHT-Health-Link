<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\vhtmembers;
use App\Models\aidspatients;
use App\Models\Katete;
use App\Models\KideraB;
use App\Models\KideraA;
use App\Models\sessions;
use App\Models\ReportedCases;


class UssdController extends Controller
{
    use UssdMenuTrait;
    use SmsTrait;

    public function ussdRequestHandler(Request $request)
    {
        $sessionId   = $request["sessionId"];
        $serviceCode = $request["serviceCode"];
        $phone       = $request["phoneNumber"];
        $date        = $request["date"];
        $text        = $request["text"];
        $duration    = $request["duration"];
        $cost        = $request["cost"];
        $status      = $request["status"];  

        header('Content-type: text/plain');

        if (
            vhtmembers::where('Phone', $phone)->exists() ||
            kideraa::where('Phone', $phone)->exists() ||
            kiderab::where('Phone', $phone)->exists() ||
            katete::where('Phone', $phone)->exists() 
            //kamukuzi::where('Phone', $phone)->exists()
        ) {
            // Function to handle already registered users
            $this->handleMainMenu($text, $phone);
            $this->ussdSessions($phone, $sessionId, $serviceCode, $duration, $cost, $status);
        }else {
             // Function to handle new users
             //$this->handleNewUser($text, $phone);
             $this->ussd_stop("You are no registered for this service.");
        }
    } 

    /* 
    
    code handiling the main menu.

    */
    public function handleMainMenu($ussd_string, $phone)
{ 
    // Split the USSD string into an array using "*" as the delimiter
    $ussd_string_exploded = explode("*", $ussd_string);

    // Get the level of the menu from the USSD string reply
    $level = count($ussd_string_exploded);

    // Show the main menu if the USSD string is empty or if the level is 0
    if (empty($ussd_string) or $level == 0) {
        $this->MainMenu(); // show the home/first menu
        //$this->sendText("Your case has been received.", $phone);
    }

    switch ($level) {
        // Level 1 input
        case 1:
            if ($ussd_string_exploded[0] == "1") {
                $this->DiseasesMenu();
                //$this->ussd_proceed("Please enter disease name, number of patients and risk level e.g \n Malaria,12,High");
            } else if ($ussd_string_exploded[0] == "2") {
                $this->returnFollowupMenu();
            } else if ($ussd_string_exploded[0] == "3") {
                $this->returnTrainingMenu();
            } else if ($ussd_string_exploded[0] == "4") {
                $this->ussd_proceed("Number of Births.");
                $this->ussd_proceed("Number of Deaths.");
                $this->ussd_stop("Thank you.");
            } else if ($ussd_string_exploded[0] == "0") {
                $this->ussd_stop("Thank you for trusting us.");
            }
            break;

        // Level 2 input for the list of diseases
        case 2:
            // Handle menu options for diseases
            switch ($ussd_string_exploded[0]) {
                case "1":
                    switch ($ussd_string_exploded[1]) {

                        //Number of patients for malaria
                        case "1":
                            $this->ussd_proceed("Number of Patients:");
                        break;

                        //Number of patients for cholera
                        case "2":
                            $this->ussd_proceed("Number of Patients:");
                        break;

                        //Number of patients for ebola
                        case "3":
                            $this->ussd_proceed("Number of Patients:");
                        break;

                        //Number of patients for covid
                        case "4":
                            $this->ussd_proceed("Number of Patients:");
                        break;

                        //Number of patients for diarrhoea
                        case "5":
                            $this->ussd_proceed("Number of Patients:");
                        break;

                        //Number of patients for other
                        case "6":
                            $this->ussd_proceed("Number of Patients:");
                        break;

                        //exit
                        case "0":
                            $this->ussd_stop("Thank you. Always report any case in your community");
                        break;
                    }
                    break;

                // The menu for entering the patient id for the patients follow up menu
                case "2":
                    switch ($ussd_string_exploded[1]) {
                        case "1":             //for HIV patients
                            $this->ussd_proceed("Enter Patient ID.");
                            //$this->getPatientInfo($ussd_string_exploded[1], $phone);
                            break;

                        case "2":             //for antenantal care patients
                            $this->ussd_proceed("Enter Patient ID.good");
                            break;

                        case "3":           //for T.B patients 
                            $this->ussd_proceed("Enter Patient ID");
                            break;

                        case "4":           //for mental health patients
                            $this->ussd_proceed("nter Patient ID");

                            break;

                        case "5":           //for other patients
                            $this->ussd_proceed("nter Patient ID");
                            break;
                            
                        case "0":           //for exitting cases
                            $this->ussd_stop("Thank you");

                            break;
                    }
                    break;
            }
            break;

        // Level 3 input for enterin the number of patients
        case 3:
            // Handle menu options for training schedule
            switch ($ussd_string_exploded[0]) {
                case "1":
                    switch ($ussd_string_exploded[1]) {
                        //malaria
                        case "1":
                            $this->saveMalariaReports($ussd_string_exploded[2], $phone);//saving the reported case to the database
                            $this->ussd_stop("Thank you for your concern. You will recieve communication from the health inspector shortly.");
                        break;
                        //cholera
                        case "2":
                            $this->saveCholeraReports($ussd_string_exploded[2], $phone);//saving the reported case to the database
                            $this->ussd_stop("Thank you for your concern. You will recieve communication from the health inspector shortly.");
                        break;
                            //ebola
                        case "3":
                            $this->saveEbolaReports($ussd_string_exploded[2], $phone);//saving the reported case to the database
                            $this->ussd_stop("Thank you for your concern. You will recieve communication from the health inspector shortly.");
                        break;
                            //covid
                        case "4":
                            $this->saveChovidReports($ussd_string_exploded[2], $phone);//saving the reported case to the database
                            $this->ussd_stop("Thank you for your concern. You will recieve communication from the health inspector shortly.");
                        break;
                            //diarrhoea
                        case "5":
                            $this->saveDiarrhoeaReports($ussd_string_exploded[2], $phone);//saving the reported case to the database
                            $this->ussd_stop("Thank you for your concern. You will recieve communication from the health inspector shortly.");
                        break;
                            //others
                        case "6":
                            $this->ussd_stop("Thank you for your concern. You will recieve communication from the health inspector shortly.");
                        break;

                    }
                    break;

                case "2":
                    switch ($ussd_string_exploded[1]) {

                        //HIV patients
                        case "1":
                            $this->ussd_stop("success");
                        break;
                        
                        //Antenantal
                        case "2":
                            $this->ussd_stop("success");
                        break;
                        
                        //T.B patients
                        case "3":
                            $this->ussd_stop("success");
                        break;

                        //Mental care
                        case "4":
                            $this->ussd_stop("success");
                        break;
                        
                        //Other
                        case "5":
                            $this->ussd_stop("success");
                        break;
                        
                        //exit
                        case "0":
                            $this->ussd_stop("Thank you!");
                        break;

                    }
            }
            break;

    }
}


    //save malaria reports

    public function saveMalariaReports($details, $phone){

        //store input values in an array
        $input = $details;
        $number_of_patients = $input; 
        $disease_name = "Malaria";
        
        //get other vht details
        $vht = new vhtmembers;
        $KideraA = new KideraA();
        $KideraB = new KideraB();
        $Katete = new KideraB();
    
        $vht = KideraA::where('Phone', $phone)->select('VHT_Name', 'district', 'subcounty','village')->first();
        
        if (!$vht) {
            $vht = KideraB::where('Phone', $phone)->select('VHT_Name', 'district', 'subcounty','village')->first();
        }
        if (!$vht) {
            $vht = Katete::where('Phone', $phone)->select('VHT_Name', 'district', 'subcounty','village')->first();
        }

        if ($vht) {
            $name = $vht->VHT_Name;
            $district = $vht->district;
            $subcounty = $vht->subcounty;
            $village = $vht->village;

            $disease = new ReportedCases;
            $disease->VHT_Name = $name;
            $disease->District = $district;
            $disease->Subcounty = $subcounty;
            $disease->Village = $village;
            $disease->DiseaseName = $disease_name;
            $disease->Date = now();
            $disease->Phone = $phone;
            $disease->Number_of_Patients = $number_of_patients;
            $disease->save();
            return "success";
        }
    }

    //save cholera cases
    public function saveCholeraReports($details, $phone){

        //store input values in an array
        $input = $details;
        $number_of_patients = $input; 
        $disease_name = "Cholera";
        
        //get other vht details
        $vht = new vhtmembers;
        $KideraA = new KideraA();
        $KideraB = new KideraB();
        $Katete = new KideraB();
    
        $vht = KideraA::where('Phone', $phone)->select('VHT_Name', 'district', 'subcounty','village')->first();
        
        if (!$vht) {
            $vht = KideraB::where('Phone', $phone)->select('VHT_Name', 'district', 'subcounty','village')->first();
        }
        if (!$vht) {
            $vht = Katete::where('Phone', $phone)->select('VHT_Name', 'district', 'subcounty','village')->first();
        }

        if ($vht) {
            $name = $vht->VHT_Name;
            $district = $vht->district;
            $subcounty = $vht->subcounty;
            $village = $vht->village;

            $disease = new ReportedCases;
            $disease->VHT_Name = $name;
            $disease->District = $district;
            $disease->Subcounty = $subcounty;
            $disease->Village = $village;
            $disease->DiseaseName = $disease_name;
            $disease->Date = now();
            $disease->Phone = $phone;
            $disease->Number_of_Patients = $number_of_patients;
            $disease->save();
            return "success";
        }
    }

    //save ebola cases
    public function saveEbolaReports($details, $phone){

        //store input values in an array
        $input = $details;
        $number_of_patients = $input; 
        $disease_name = "Ebola";
        
        //get other vht details
        $vht = new vhtmembers;
        $KideraA = new KideraA();
        $KideraB = new KideraB();
        $Katete = new KideraB();
    
        $vht = KideraA::where('Phone', $phone)->select('VHT_Name', 'district', 'subcounty','village')->first();
        
        if (!$vht) {
            $vht = KideraB::where('Phone', $phone)->select('VHT_Name', 'district', 'subcounty','village')->first();
        }
        if (!$vht) {
            $vht = Katete::where('Phone', $phone)->select('VHT_Name', 'district', 'subcounty','village')->first();
        }

        if ($vht) {
            $name = $vht->VHT_Name;
            $district = $vht->district;
            $subcounty = $vht->subcounty;
            $village = $vht->village;

            $disease = new ReportedCases;
            $disease->VHT_Name = $name;
            $disease->District = $district;
            $disease->Subcounty = $subcounty;
            $disease->Village = $village;
            $disease->DiseaseName = $disease_name;
            $disease->Date = now();
            $disease->Phone = $phone;
            $disease->Number_of_Patients = $number_of_patients;
            $disease->save();
            return "success";
        }
    }

    //save covid cases
    public function saveChovidReports($details, $phone){

        //store input values in an array
        $input = $details;
        $number_of_patients = $input; 
        $disease_name = "Chovid 19";
        
        //get other vht details
        $vht = new vhtmembers;
        $KideraA = new KideraA();
        $KideraB = new KideraB();
        $Katete = new KideraB();
    
        $vht = KideraA::where('Phone', $phone)->select('VHT_Name', 'district', 'subcounty','village')->first();
        
        if (!$vht) {
            $vht = KideraB::where('Phone', $phone)->select('VHT_Name', 'district', 'subcounty','village')->first();
        }
        if (!$vht) {
            $vht = Katete::where('Phone', $phone)->select('VHT_Name', 'district', 'subcounty','village')->first();
        }

        if ($vht) {
            $name = $vht->VHT_Name;
            $district = $vht->district;
            $subcounty = $vht->subcounty;
            $village = $vht->village;

            $disease = new ReportedCases;
            $disease->VHT_Name = $name;
            $disease->District = $district;
            $disease->Subcounty = $subcounty;
            $disease->Village = $village;
            $disease->DiseaseName = $disease_name;
            $disease->Date = now();
            $disease->Phone = $phone;
            $disease->Number_of_Patients = $number_of_patients;
            $disease->save();
            return "success";
        }
    }

    //save Diarrhoea cases
    public function saveDiarrhoeaReports($details, $phone){

        //store input values in an array
        $input = $details;
        $number_of_patients = $input; 
        $disease_name = "Diarrhoea";
        
        //get other vht details
        $vht = new vhtmembers;
        $KideraA = new KideraA();
        $KideraB = new KideraB();
        $Katete = new KideraB();
    
        $vht = KideraA::where('Phone', $phone)->select('VHT_Name', 'district', 'subcounty','village')->first();
        
        if (!$vht) {
            $vht = KideraB::where('Phone', $phone)->select('VHT_Name', 'district', 'subcounty','village')->first();
        }
        if (!$vht) {
            $vht = Katete::where('Phone', $phone)->select('VHT_Name', 'district', 'subcounty','village')->first();
        }

        if ($vht) {
            $name = $vht->VHT_Name;
            $district = $vht->district;
            $subcounty = $vht->subcounty;
            $village = $vht->village;

            $disease = new ReportedCases;
            $disease->VHT_Name = $name;
            $disease->District = $district;
            $disease->Subcounty = $subcounty;
            $disease->Village = $village;
            $disease->DiseaseName = $disease_name;
            $disease->Date = now();
            $disease->Phone = $phone;
            $disease->Number_of_Patients = $number_of_patients;
            $disease->save();
            return "success";
        }
    }

    //save user sessions
    public function ussdSessions($phone, $sessionId, $serviceCode, $duration, $cost, $status)
    {
        $session = new Sessions;
        $session->Date = now(); // Assuming you want to use the current date/time
        $session->Phone = $phone;
        $session->SessionID = $sessionId;
        $session->ServiceCode = $serviceCode;
        $session->Duration = $duration;
        $session->Cost = $cost;
        $session->Status = $status;
        $session->save(); 
    }
 
    /**
     * Handles Login Request
     */
    public function ussdLogin($details, $phone)
    {
        $user = User::where('phone', $phone)->first();

        if ($user->pin == $details ) {
            return "Success";           
        } else {
            return $this->ussd_stop("Login was unsuccessful!");
        }
    }

    
            //getting patient information

    public function getPatientInfo($details, $phone){

        $ussd_string_exploded = explode ("*",$detail);
        $input = explode(",",$details);
        $patientid = trim($input[0]);

        $hivpatient = new aidspatients;


        $hivpatient = aidspatients::where('PatientID', $patientid)->select('Name', 'Phone', 'Last_Visit','District','Subcounty','village')->first();
        
        $name = $hivpatient->Name;
        $phone = $hivpatient->Phone;
        $lastvisit = $hivpatient->Last_Visit;
        $district = $hivpatient->District;
        $subcounty = $hivpatient->subcounty;
        $village = $hivpatient->village;

        //$this->ussd_stop("Name: " . $name . ", Phone: " . $phone);
    }



    public function ussd_proceed($ussd_text) {
        echo "CON $ussd_text";

    }
    public function ussd_stop($ussd_text) {
        echo "END $ussd_text";
    }
    
    
}