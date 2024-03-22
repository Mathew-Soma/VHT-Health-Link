<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\vhtmembers;
//use App\Models\Kamukuzi;
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
        $ussd_string_exploded = explode ("*",$ussd_string);

        // Get menu level from ussd_string reply
        $level = count($ussd_string_exploded);

        if(empty($ussd_string) or $level == 0) {
            $this->MainMenu(); // show the home/first menu
            //$this->sendText("Your case has been recieved.",$phone);
        }

        switch ($level) {
            case ($level == 1 && !empty($ussd_string)):
                if ($ussd_string_exploded[0] == "1") {
                    $this->DiseasesMenu();
                    //$this->ussd_proceed("Please enter disease name, number of patients and risk level e.g \n Malaria,12,High");
                } else if($ussd_string_exploded[0] == "2"){
                    $this->returnFollowupMenu();

                } else if($ussd_string_exploded[0] == "3"){
                    $this->returnTrainingMenu();

                }else if($ussd_string_exploded[0] == "4"){
                    $this->ussd_proceed("Number of Births.");
                    $this->ussd_proceed("Number of Deaths.");
                    $this->ussd_stop("Thank you.");

                } else if($ussd_string_exploded[0] == "0"){
                    $this->ussd_stop("Thank you for trusting us.");
                }
            break;

                //show risks menu.
                case ($ussd_string_exploded[0] == "1"):

                    //Malaria
                    if ($ussd_string_exploded[1] == "1") {
                        
                        $this->saveMalariaReports($ussd_string_exploded[1], $phone);
                        
                        
                    }else if($ussd_string_exploded[1] == "2"){
                        $this->ussd_proceed("Number of Patients:");
    
                    } else if($ussd_string_exploded[1] == "3"){
                        $this->ussd_proceed("Number of Patients:");
    
                    } else if($ussd_string_exploded[1] == "4"){
                        $this->ussd_proceed("Number of Patients:");
    
                    } else if($ussd_string_exploded[1] == "5"){
                        $this->ussd_proceed("Number of Patients:");
    
                    } else if($ussd_string_exploded[1] == "6"){
                        $this->ussd_proceed("Specify disease and number of patients e.g. Malaria,123");
    
                    } 
                    break;
        
            

            case ($ussd_string_exploded[0] == "2"):
                if($ussd_string_exploded[1]== "1"){
                    $this->ussd_proceed("Enter Patient ID.");

                } else if($ussd_string_exploded[1]== "2"){
                    $this->ussd_proceed("Enter Patient ID.");

                } else if($ussd_string_exploded[1]== "3"){
                    $this->ussd_proceed("Enter Patient ID.");

                } else if($ussd_string_exploded[1]== "4"){
                    $this->ussd_proceed("Enter Patient ID.");

                }

            break;

            case ($ussd_string_exploded[0] == "3"):
                if($ussd_string_exploded[1]== "1"){
                    $this->ussd_stop("You will recieve training schedule shortly.");

                } else if($ussd_string_exploded[1]== "2"){
                    $this->ussd_stop("You will recieve training schedule shortly.");


                }else if($ussd_string_exploded[1]== "3"){
                    $this->ussd_stop("You will recieve training schedule shortly.");


                }else if($ussd_string_exploded[1]== "4"){
                    $this->ussd_stop("You will recieve training schedule shortly.");


                }else if($ussd_string_exploded[1]== "5"){
                    $this->ussd_stop("You will recieve training schedule shortly.");


                }else if($ussd_string_exploded[1]== "0"){
                    $this->ussd_stop("You will recieve training schedule shortly.");


                }
                break;
        }
    }



    //save malaria reports

    public function saveMalariaReports($details, $phone){
        $this->ussd_proceed("Number of Patients:");
        $input = explode(",",$details);//store input values in an array
        //$disease_name = $input[0];//store full name
        $number_of_patients = trim($input[0]); 
        //$risk = $input[1];
        $disease_name = "Malaria";
        

        //get other vht details
        $vht = new vhtmembers;
        $KideraA = new KideraA();
        $KideraB = new KideraB();
        $Katete = new KideraB();
        //$Kamukuzi = new KideraB();
        
    
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
            //$disease->Risk = $risk;
            $disease->save();
        }
 
        return $this->ussd_stop("Login was unsuccessful!");

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


    public function ussd_proceed($ussd_text) {
        echo "CON $ussd_text";

    }
    public function ussd_stop($ussd_text) {
        echo "END $ussd_text";
    }
    
    
}