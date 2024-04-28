<?php

namespace App\Http\Controllers;

use App\Models\aidspatients;
use App\Models\expectantmothers;
use App\Models\Katete;
use App\Models\KideraA;
use App\Models\KideraB;
use App\Models\Mobilizations;
use App\Models\ReportedCases;
use App\Models\sessions;
use App\Models\Supervisors;
use App\Models\Trainings;
use App\Models\Tuberculosis;
use App\Models\User;
use Illuminate\Http\Request;

class UssdController extends Controller
{
    use UssdMenuTrait;
    use SmsTrait;

    public function ussdRequestHandler(Request $request)
    {
        $sessionId = $request['sessionId'];
        $serviceCode = $request['serviceCode'];
        $phone = $request['phoneNumber'];
        $date = $request['date'];
        $text = $request['text'];
        $duration = $request['duration'];
        $cost = $request['cost'];
        $status = $request['status'];

        header('Content-type: text/plain');

        if (
            kideraa::where('Phone', $phone)->exists() ||
            kiderab::where('Phone', $phone)->exists() ||
            katete::where('Phone', $phone)->exists()
            // kamukuzi::where('Phone', $phone)->exists()
        ) {
            // Function to handle already registered users
            $this->handleMainMenu($text, $phone);
            $this->ussdSessions($phone, $sessionId, $serviceCode, $duration);
        } elseif (Supervisors::where('Phone', $phone)->exists()) {
            $this->returnSupervisorsMenu($text, $phone);
        } else {
            // Function to handle new users
            // $this->handleNewUser($text, $phone);
            $this->ussd_stop('You are no registered for this service. Please contact the Health inspector for your subcounty.');
        }
    }

    /*
     * code handiling the main menu.
     */
    public function handleMainMenu($ussd_string, $phone)
    {
        // Split the USSD string into an array using "*" as the delimiter
        $ussd_string_exploded = explode('*', $ussd_string);

        // Get the level of the menu from the USSD string reply
        $level = count($ussd_string_exploded);

        // Show the main menu if the USSD string is empty or if the level is 0
        if (empty($ussd_string) or $level == 0) {
            $this->MainMenu();  // show the home/first menu
            // $this->sendText("Your case has been received.", $phone);
        }

        switch ($level) {
            // Level 1 input
            case 1:
                switch ($ussd_string_exploded[0]) {
                    case 1:
                        $this->DiseasesMenu();
                        break;
                    case 2:
                        $this->returnFollowupMenu();
                        break;

                    case 3:
                        $this->returnTrainingMenu();
                        break;

                    case 4:
                        $this->returnbirthsMenu();
                        break;
                    case 5:
                        $this->editProfile();
                        break;
                    case 0:
                        $this->ussd_stop('Thank you for trusting us.');
                        break;
                }

                /*
                 * if ($ussd_string_exploded[0] == '1') {
                 *     $this->DiseasesMenu();
                 * } else if ($ussd_string_exploded[0] == '2') {
                 *     $this->returnFollowupMenu();
                 * } else if ($ussd_string_exploded[0] == '3') {
                 *     $this->returnTrainingMenu();
                 * } else if ($ussd_string_exploded[0] == '4') {
                 *     $this->returnbirthsMenu();
                 * } else if ($ussd_string_exploded[0] == '0') {
                 *     $this->ussd_stop('Thank you for trusting us.');
                 * }
                 */

                break;

            // Level 2 input for the list of diseases
            case 2:
                // Handle menu options for diseases
                switch ($ussd_string_exploded[0]) {
                    case 1:
                        switch ($ussd_string_exploded[1]) {
                            // Number of patients for malaria
                            case 1:
                                $this->ussd_proceed('Number of Patients:');
                                break;

                            // Number of patients for cholera
                            case 2:
                                $this->ussd_proceed('Number of Patients:');
                                break;

                            // Number of patients for ebola
                            case 3:
                                $this->ussd_proceed('Number of Patients:');
                                break;

                            // Number of patients for covid
                            case 4:
                                $this->ussd_proceed('Number of Patients:');
                                break;

                            // Number of patients for diarrhoea
                            case 5:
                                $this->ussd_proceed('Number of Patients:');
                                break;

                            // Number of patients for other
                            case 6:
                                $this->ussd_proceed("Specify in the format \n Disease name, number of patients");
                                break;

                            // exit
                            case 0:
                                $this->ussd_stop('Thank you. Always report any case in your community');
                                break;
                            default:
                                $this->ussd_stop('Invalid input');
                                break;
                        }
                        break;

                    // The menu for entering the patient id for the patients follow up menu
                    case 2:
                        switch ($ussd_string_exploded[1]) {
                            case 1:  // for HIV patients
                                $this->ussd_proceed('Enter Patient ID.');
                                // $this->getPatientInfo($ussd_string_exploded[1], $phone);
                                break;

                            case 2:  // for antenantal care patients
                                $this->ussd_proceed('Enter Patient ID.');
                                break;

                            case 3:  // for T.B patients
                                $this->ussd_proceed('Enter Patient ID');
                                break;

                            case 4:  // for mental health patients
                                // $this->ussd_proceed("nter Patient ID");

                                $this->ussd_stop('An sms has been sent to your phone number ' . $phone);

                                break;

                            case 5:  // for other patients
                                $this->ussd_proceed('Enter Patient ID');
                                break;

                            case 0:  // for exitting cases
                                $this->ussd_stop('Thank you');
                                break;

                            default:
                                $this->ussd_stop('Invalid input');
                                break;
                        }
                        break;

                    case 3:
                        switch ($ussd_string_exploded[1]) {
                            case 1:  // for childhood illness training
                                $this->ussd_proceed('okay');
                            default:
                                $this->ussd_stop('Invalid input');
                                break;
                        }
                        break;
                    case 5:
                        switch ($ussd_string_exploded[1]) {
                            case 1:
                                $this->ussd_proceed('Enter current name');
                                break;
                            case 2:
                                $this->ussd_proceed('Enter old Phone Number');
                                break;
                            case 3:
                                $this->ussd_proceed('Enter new District');
                                break;
                            case 4:
                                $this->ussd_proceed('Enter new Subcounty');
                                break;
                            case 5:
                                $this->ussd_proceed('Enter new Parish');
                                break;
                            case 6:
                                $this->ussd_proceed('Enter new village');
                                break;
                            case 0:
                                $this->ussd_stop('Thank you.');
                                break;
                            default:
                                $this->ussd_stop('Invalid input');
                                break;
                        }
                        break;

                        /**case 4:
                            switch ($ussd_string_exploded[1]) {
                                case 1:             //for
                                    $this->ussd_proceed("okayggg");
                                    //$this->getPatientInfo($ussd_string_exploded[1], $phone);
                                case 2:             //for
                                   $this->ussd_proceed("okayggg");
                                default:
                                    $this->ussd_stop("Invalid Input");
                                break;
                            }**/
                }
                break;

            // Level 3
            case 3:
                switch ($ussd_string_exploded[0]) {
                    case 1:
                        switch ($ussd_string_exploded[1]) {
                            // malaria
                            case 1:
                                $this->ussd_stop('Thank you for your concern. You will receive communication from the health inspector shortly.');
                                $this->saveMalariaReports($ussd_string_exploded[2], $phone);
                                $this->sendSmsToInspectors();
                                break;
                                // cholera
                            case 2:
                                $this->ussd_stop('Thank you for your concern. You will recieve communication from the health inspector shortly.');
                                $this->saveCholeraReports($ussd_string_exploded[2], $phone);  // saving the reported case to the database
                                $this->sendSmsToInspectors();
                                // $this->sendSmsToInspectors('Hello, a new case has been reported by a VHT, Kindly check the VHT Health Link for more information');
                                break;
                                // ebola
                            case 3:
                                $this->ussd_stop('Thank you for your concern. You will recieve communication from the health inspector shortly.');
                                $this->saveEbolaReports($ussd_string_exploded[2], $phone);  // saving the reported case to the database
                                $this->sendSmsToInspectors();
                                // $this->sendSmsToInspectors('Hello, a new case has been reported by a VHT, Kindly check the VHT Health Link for more information');
                                break;
                                // covid
                            case 4:
                                $this->ussd_stop('Thank you for your concern. You will recieve communication from the health inspector shortly.');
                                $this->saveChovidReports($ussd_string_exploded[2], $phone);  // saving the reported case to the database
                                $this->sendSmsToInspectors();
                                // $this->sendSmsToInspectors('Hello, a new case has been reported by a VHT, Kindly check the VHT Health Link for more information');
                                break;
                                // diarrhoea
                            case 5:
                                $this->ussd_stop('Thank you for your concern. You will recieve communication from the health inspector shortly.');
                                $this->saveDiarrhoeaReports($ussd_string_exploded[2], $phone);  // saving the reported case to the database
                                $this->sendSmsToInspectors();
                                // $this->sendSmsToInspectors('Hello, a new case has been reported by a VHT, Kindly check the VHT Health Link for more information');
                                break;
                                // others
                            case 6:
                                $this->ussd_stop('Thank you for your concern. You will recieve communication from the health inspector shortly.');
                                $this->saveOtherReports($ussd_string_exploded[2], $phone);  // saving the reported case to the database
                                // $this->sendSmsToInspectors('Hello, a new case has been reported by a VHT, Kindly check the VHT Health Link for more information');
                                $this->sendSmsToInspectors();
                                break;
                        }
                        break;

                    case 2:
                        switch ($ussd_string_exploded[1]) {
                            // HIV patients
                            case 1:
                                $this->getPatientInfo($ussd_string_exploded[2], $phone);
                                break;

                            // Antenantal
                            case 2:
                                $this->getAntenantalInfo($ussd_string_exploded[2], $phone);
                                break;

                            // T.B patients
                            case 3:
                                $this->getTBInfo($ussd_string_exploded[2], $phone);
                                break;

                            // Mental care
                            case 4:
                                $this->ussd_stop('success');
                                break;

                            // Other
                            case 5:
                                $this->ussd_stop('success');
                                break;

                            // exit
                            case 0:
                                $this->ussd_stop('Thank you!');
                                break;

                            default:
                                $this->ussd_stop('Invalid Input');
                                break;
                        }
                        break;
                    case 5:
                        switch ($ussd_string_exploded[1]) {
                            // HIV patients
                            case 1:
                                $this->ussd_proceed('New name');
                                break;
                            case 2:
                                $this->ussd_proceed('Phone number changed');
                                break;
                            case 3:
                                $this->ussd_proceed('etc changed');
                                break;
                            case 4:
                                $this->ussd_proceed('Name changed');
                                break;
                            case 5:
                                $this->ussd_proceed('Name changed');
                                break;
                            case 6:
                                $this->ussd_proceed('Name changed');
                                break;
                            case 0:
                                $this->ussd_stop('Bye!');
                                break;
                            default:
                                $this->ussd_stop('Invalid Input');
                                break;
                        }
                }
                break;
            case 4:
                switch ($ussd_string_exploded[0]) {
                    case 5:
                        switch ($ussd_string_exploded[1]) {
                            case 1:
                                $otherdetails = [$ussd_string_exploded[2], $ussd_string_exploded[3]];
                                $this->ChangeName($otherdetails, $phone);
                                $this->ussd_stop('Details updated successfully');
                        }
                }
        }
    }

    /**
     * save malaria cases
     */
    public function saveMalariaReports($details, $phone)
    {
        // store input values in an array
        $input = $details;
        $number_of_patients = $input;
        $disease_name = 'Malaria';

        // get other vht details
        // $vht = new vhtmembers;
        $KideraA = new KideraA();
        $KideraB = new KideraB();
        $Katete = new KideraB();

        $vht = KideraA::where('Phone', $phone)->select('VHT_Name', 'district', 'subcounty', 'village')->first();

        if (!$vht) {
            $vht = KideraB::where('Phone', $phone)->select('VHT_Name', 'district', 'subcounty', 'village')->first();
        }
        if (!$vht) {
            $vht = Katete::where('Phone', $phone)->select('VHT_Name', 'district', 'subcounty', 'village')->first();
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
            return 'success';
        }
    }

    /**
     * save cholera cases
     */
    public function saveCholeraReports($details, $phone)
    {
        // store input values in an array
        $input = $details;
        $number_of_patients = $input;
        $disease_name = 'Cholera';

        // get other vht details
        $KideraA = new KideraA();
        $KideraB = new KideraB();
        $Katete = new KideraB();

        $vht = KideraA::where('Phone', $phone)->select('VHT_Name', 'district', 'subcounty', 'village')->first();

        if (!$vht) {
            $vht = KideraB::where('Phone', $phone)->select('VHT_Name', 'district', 'subcounty', 'village')->first();
        }
        if (!$vht) {
            $vht = Katete::where('Phone', $phone)->select('VHT_Name', 'district', 'subcounty', 'village')->first();
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
            return 'success';
        }
    }

    /**
     * save ebola cases
     */
    public function saveEbolaReports($details, $phone)
    {
        // store input values in an array
        $input = $details;
        $number_of_patients = $input;
        $disease_name = 'Ebola';

        // get other vht details
        $KideraA = new KideraA();
        $KideraB = new KideraB();
        $Katete = new KideraB();

        $vht = KideraA::where('Phone', $phone)->select('VHT_Name', 'district', 'subcounty', 'village')->first();

        if (!$vht) {
            $vht = KideraB::where('Phone', $phone)->select('VHT_Name', 'district', 'subcounty', 'village')->first();
        }
        if (!$vht) {
            $vht = Katete::where('Phone', $phone)->select('VHT_Name', 'district', 'subcounty', 'village')->first();
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

            return 'success';
        }
    }

    /**
     * save covid cases
     */
    public function saveChovidReports($details, $phone)
    {
        // store input values in an array
        $input = $details;
        $number_of_patients = $input;
        $disease_name = 'Chovid 19';

        // get other vht details
        $KideraA = new KideraA();
        $KideraB = new KideraB();
        $Katete = new KideraB();

        $vht = KideraA::where('Phone', $phone)->select('VHT_Name', 'district', 'subcounty', 'village')->first();

        if (!$vht) {
            $vht = KideraB::where('Phone', $phone)->select('VHT_Name', 'district', 'subcounty', 'village')->first();
        }
        if (!$vht) {
            $vht = Katete::where('Phone', $phone)->select('VHT_Name', 'district', 'subcounty', 'village')->first();
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
            return 'success';
        }
    }

    /**
     * save Diarrhoea cases
     */
    public function saveDiarrhoeaReports($details, $phone)
    {
        // store input values in an array
        $input = $details;
        $number_of_patients = $input;
        $disease_name = 'Diarrhoea';

        // get other vht details
        // $vht = new vhtmembers;
        $KideraA = new KideraA();
        $KideraB = new KideraB();
        $Katete = new KideraB();

        $vht = KideraA::where('Phone', $phone)->select('VHT_Name', 'district', 'subcounty', 'village')->first();

        if (!$vht) {
            $vht = KideraB::where('Phone', $phone)->select('VHT_Name', 'district', 'subcounty', 'village')->first();
        }
        if (!$vht) {
            $vht = Katete::where('Phone', $phone)->select('VHT_Name', 'district', 'subcounty', 'village')->first();
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
            return 'success';
        }
    }

    /**
     * save other cases
     */
    public function saveOtherReports($details, $phone)
    {
        // store input values in an array

        $input = explode(',', $details);  // store input values in an array
        $disease_name = $input[0];  // store full name
        $number_of_patients = $input[1];

        // get other vht details
        // $vht = new vhtmembers;
        $KideraA = new KideraA();
        $KideraB = new KideraB();
        $Katete = new KideraB();

        $vht = KideraA::where('Phone', $phone)->select('VHT_Name', 'district', 'subcounty', 'village')->first();

        if (!$vht) {
            $vht = KideraB::where('Phone', $phone)->select('VHT_Name', 'district', 'subcounty', 'village')->first();
        }
        if (!$vht) {
            $vht = Katete::where('Phone', $phone)->select('VHT_Name', 'district', 'subcounty', 'village')->first();
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
            return 'success';
        }
    }

    /*
     * edit user profile - name
     */

    public function ChangeName($phone, $detail)
    {
        $oldname = $detail[0];
        $newname = $detail[1];

        $kideraa = new kideraa;

        $user = kideraa::where('VHT_Name', $oldname)->first();

        if ($user) {
            $user->VHT_Name = $newname;
            $user->save();
        } else {
            $this->ussd_stop('User does not exist');
        }
    }

    /**
     * save user sessions
     */
    public function ussdSessions($phone, $sessionId, $serviceCode, $duration)
    {
        $session = new Sessions;
        $session->Date = now();  // Assuming you want to use the current date/time
        $session->Phone = $phone;
        $session->SessionID = $sessionId;
        $session->ServiceCode = $serviceCode;
        $session->Duration = $duration;
        $session->save();
    }

    /**
     * Getting patient information and displaying it to the user
     *
     * @param string $details - The details sent by the user (patient ID)
     * @param string $phone - The user's phone number
     */
    public function getPatientInfo($details, $phone)
    {
        // Extract patient ID from the details
        $patientId = $details;

        $hivpatient = new aidspatients;

        // Retrieve patient information from the database based on the patient ID
        $patient = aidspatients::where('PatientID', $patientId)->first();

        // Check if the patient exists
        if ($patient) {
            // Extract patient details
            $name = $patient->Name;
            $phone = $patient->Phone;
            $lastvisit = $patient->Last_Visit;
            $district = $patient->District;
            $subcounty = $patient->Subcounty;
            $village = $patient->Village;  // Assuming Age is a field in the database

            // Display patient information to the user
            $this->ussd_stop("Patient Name: $name \n Phone: $phone \n Last Visit: $lastvisit \n District: $district\n Sub County: $subcounty\n Village: $village");
        } else {
            // If patient does not exist, display a message to the user
            $this->ussd_stop('Patient not found.');
        }
    }

    public function getAntenantalInfo($details, $phone)
    {
        // Extract patient ID from the details
        $patientId = $details;

        $antenantalpatient = new expectantmothers;

        // Retrieve patient information from the database based on the patient ID
        $patient = expectantmothers::where('PatientID', $patientId)->first();

        // Check if the patient exists
        if ($patient) {
            // Extract patient details
            $name = $patient->Name;
            $phone = $patient->Phone;
            $lastvisit = $patient->Antenantal_care_visits;
            $district = $patient->District;
            $subcounty = $patient->Subcounty;
            $village = $patient->Village;  // Assuming Age is a field in the database

            // Display patient information to the user
            $this->ussd_stop("Patient Name: $name \n Phone: $phone \n Last Visit: $lastvisit \n District: $district\n Sub County: $subcounty\n Village: $village");
        } else {
            // If patient does not exist, display a message to the user
            $this->ussd_stop('Patient not found.');
        }
    }

    /*
     * getting T.B patients information
     */

    public function getTBInfo($details, $phone)
    {
        // Extract patient ID from the details
        $patientId = $details;

        $antenantalpatient = new Tuberculosis;

        // Retrieve patient information from the database based on the patient ID
        $patient = Tuberculosis::where('PatientID', $patientId)->first();

        // Check if the patient exists
        if ($patient) {
            // Extract patient details
            $name = $patient->Name;
            $phone = $patient->Phone;
            $lastvisit = $patient->Last_Hospital_Visit;
            $district = $patient->District;
            $subcounty = $patient->SubCounty;
            $village = $patient->Village;  // Assuming Age is a field in the database

            // Display patient information to the user
            $this->ussd_stop("Patient Name: $name \n Phone: $phone \n Last Visit: $lastvisit \n District: $district\n Sub County: $subcounty\n Village: $village");
        } else {
            // If patient does not exist, display a message to the user
            $this->ussd_stop('Patient not found.');
        }
    }

    public function returnSupervisorsMenu($ussd_string, $phone)
    {
        $ussd_string_exploded = explode('*', $ussd_string);
        $level = count($ussd_string_exploded);
        if (empty($ussd_string) or $level == 0) {
            $this->SupervisorsMenu();  // show the home/first menu
            // $this->sendText("Your case has been received.", $phone);
        }

        switch ($level) {
            case 1:
                switch ($ussd_string_exploded[0]) {
                    case 1:
                        $this->ussd_proceed('Village Name:');
                        break;
                    case 2:
                        $this->mobilizationMenu();
                        break;
                    case 3:
                        $this->ussd_proceed("Enter the training date: \n dd/mm/yy");
                        break;
                    case 4:
                        $this->ussd_proceed('Write a brief update.');
                        break;
                }

                break;
            case 2:
                switch ($ussd_string_exploded[0]) {
                    case 1:
                        $this->LatestReportedCase($ussd_string_exploded[1]);
                        break;
                    case 2:
                        switch ($ussd_string_exploded[1]) {
                            case 1:
                                $this->ussd_proceed('Event Date:');
                                break;
                            case 2:
                                $this->ussd_proceed('Event Date:');
                                break;
                            case 3:
                                $this->ussd_proceed('Event Date:');
                                break;
                            case 4:
                                $this->ussd_proceed('Event Date:');
                                break;
                            case 5:
                                $this->ussd_proceed('Specify event: ');
                                break;
                            case 0:
                                $this->ussd_stop('Thank you for trusting us.');
                                break;
                            default:
                                $this->ussd_stop('Invalid input');
                                break;
                        }
                        break;

                    case 3:
                        $this->ussd_proceed('Trainig type');
                        break;
                    case 4:
                        $this->ussd_stop('An sms has been sent to the vhts.');
                        break;
                    default:
                        $this->ussd_stop('Invalid input');
                        break;
                }
                break;

            case 3:
                switch ($ussd_string_exploded[0]) {
                    case 2:
                        switch ($ussd_string_exploded[1]) {
                            case 1:
                                $this->ussd_proceed('Event Venue:');
                                break;
                            case 2:
                                $this->ussd_proceed('Event Venue:');
                                break;
                            case 3:
                                $this->ussd_proceed('Event Venue:');
                                break;
                            case 4:
                                $this->ussd_proceed('Event Venue:');
                                break;
                            case 5:
                                $this->ussd_proceed('Event Date:');
                                break;
                            default:
                                $this->ussd_stop('Invalid input');
                                break;
                        }
                        break;

                    case 3:
                        $this->ussd_proceed('Training venue');
                        break;
                    default:
                        $this->ussd_stop('Invalid input');
                        break;
                }
                break;
            case 4:
                switch ($ussd_string_exploded[0]) {
                    case 2:
                        switch ($ussd_string_exploded[1]) {
                            case 1:
                                $imundetails = [
                                    $ussd_string_exploded[2],  // Date
                                    $ussd_string_exploded[3],  // venue
                                ];
                                $this->saveImmuneMobilizationData($imundetails, $phone);
                                $this->ussd_stop('An sms has been sent to all the vhts to notify them about the event');
                                break;
                            case 2:
                                $educdetails = [
                                    $ussd_string_exploded[2],  // Date
                                    $ussd_string_exploded[3],  // venue
                                ];
                                $this->saveHealthEducData($educdetails, $phone);
                                $this->ussd_stop('An sms has been sent to all the vhts to notify them about the event');
                                break;
                            case 3:
                                $screendetails = [
                                    $ussd_string_exploded[2],  // Date
                                    $ussd_string_exploded[3],  // venue
                                ];
                                $this->saveHealthScreeningData($screendetails, $phone);
                                $this->ussd_stop('An sms has been sent to all the vhts to notify them about the event');
                                break;
                            case 4:
                                $preventdetails = [
                                    $ussd_string_exploded[2],  // Date
                                    $ussd_string_exploded[3],  // venue
                                ];
                                $this->savePreventData($preventdetails, $phone);
                                $this->ussd_stop('An sms has been sent to all the vhts to notify them about the event');
                                break;
                            case 5:
                                $this->ussd_proceed('Event Venue:');
                                break;
                            default:
                                $this->ussd_stop('Invalid input');
                                break;
                        }
                        break;
                    case 3:
                        $trainingDetails = [
                            $ussd_string_exploded[1],  // Date
                            $ussd_string_exploded[2],  // Training type
                            $ussd_string_exploded[3],  // Venue
                        ];
                        $this->saveTrainingData($trainingDetails, $phone);
                        $this->ussd_stop('An sms has been sent to the vhts to notify them about the training');
                        break;
                    default:
                        $this->ussd_stop('Invalid input');
                        break;
                }
                break;
            case 5:
                switch ($ussd_string_exploded[0]) {
                    case 2:
                        switch ($ussd_string_exploded[1]) {
                            case 5:
                            case 3:
                                $otherDetails = [
                                    $ussd_string_exploded[2],  // Date
                                    $ussd_string_exploded[3],  // Training type
                                    $ussd_string_exploded[4],  // Venue
                                ];
                                $this->saveotherData($otherDetails, $phone);
                                $this->ussd_stop('An sms has been sent to the vhts to notify them about the training');
                                break;
                            default:
                                $this->ussd_stop('something went wrong');
                                break;
                        }
                        break;
                }
                break;
        }
    }

    /**
     * Save training data
     */
    public function saveTrainingData($details, $phone)
    {
        // Extracting details from the provided array
        $date = $details[0];
        $training_type = $details[1];
        $venue = $details[2];

        // Assuming you have a model named Train
        $train = new Trainings;

        $train->Type = $training_type;
        $train->Date = $date;
        $train->Venue = $venue;
        $train->save();

        return 'success';
    }

    public function LatestReportedCase($details)
    {
        $user_input = $details;  // Example user input

        // Retrieve the most recent reported case from the database based on the village name
        $reported_case = reportedcases::where('Village', $user_input)->orderBy('created_at', 'DESC')->first();

        // Check if the reported case exists
        if ($reported_case) {
            // Extract reported case details
            $disease_name = $reported_case->DiseaseName;
            $phone = $reported_case->Phone;
            $vht_name = $reported_case->VHT_Name;
            $number_of_patients = $reported_case->Number_of_patients;
            $date = $reported_case->Date;
            $subcounty = $reported_case->Subcounty;
            $village = $reported_case->Village;

            // Display reported case information to the user
            $this->ussd_stop("Disease: $disease_name \n VHT name: $vht_name \n Phone: $phone \n Number of Patients:  $number_of_patients\n Date: $date\n Sub County: $subcounty\n Village: $village");
        } else {
            // If no reported case found for the entered village
            $this->ussd_stop('No reported case found for the entered village.');
        }
    }

    /**
     * save imunization mobilization details
     */
    public function saveImmuneMobilizationData($details, $phone)
    {
        // Extracting details from the provided array
        $activity = 'Imunization';
        $date = $details[0];
        $venue = $details[1];

        // Assuming you have a model named Train
        $imun = new Mobilizations;

        $imun->Activity = $activity;
        $imun->Date = $date;
        $imun->Venue = $venue;
        $imun->save();

        return 'success';
    }

    /**
     * save health education mobilization details
     */
    public function saveHealthEducData($details, $phone)
    {
        // Extracting details from the provided array
        $activity = 'Health Education';
        $date = $details[0];
        $venue = $details[1];

        // Assuming you have a model named Train
        $educ = new Mobilizations;

        $educ->Activity = $activity;
        $educ->Date = $date;
        $educ->Venue = $venue;
        $educ->save();

        return 'success';
    }

    /**
     * save health screening mobilization details
     */
    public function saveHealthScreeningData($details, $phone)
    {
        // Extracting details from the provided array
        $activity = 'Health Screening';
        $date = $details[0];
        $venue = $details[1];

        // Assuming you have a model named Train
        $screen = new Mobilizations;

        $screen->Activity = $activity;
        $screen->Date = $date;
        $screen->Venue = $venue;
        $screen->save();

        return 'success';
    }

    /**
     * save health screening mobilization details
     */
    public function savePreventData($details, $phone)
    {
        // Extracting details from the provided array
        $activity = 'Disease Prevention';
        $date = $details[0];
        $venue = $details[1];

        // Assuming you have a model named Train
        $prevent = new Mobilizations;

        $prevent->Activity = $activity;
        $prevent->Date = $date;
        $prevent->Venue = $venue;
        $prevent->save();

        return 'success';
    }

    /**
     * save other mobilization details
     */
    public function saveotherData($details, $phone)
    {
        // Extracting details from the provided array
        $activity = $details[0];
        $date = $details[1];
        $venue = $details[2];

        // Assuming you have a model named Train
        $other = new Mobilizations;

        $other->Activity = $activity;
        $other->Date = $date;
        $other->Venue = $venue;
        $other->save();

        return 'success';
    }

    // For continuing the USSD session

    public function ussd_proceed($ussd_text)
    {
        echo "CON $ussd_text";
    }

    // For ending the USSD session

    public function ussd_stop($ussd_text)
    {
        echo "END $ussd_text";
    }
}
