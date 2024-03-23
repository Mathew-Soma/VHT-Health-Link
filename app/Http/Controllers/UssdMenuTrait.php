<?php
namespace App\Http\Controllers;

trait UssdMenuTrait{

    public function newUserMenu(){
        $start  = "Welcome to SampleUSSD\n";
        $start .= "1. Registering\n";
        $start .= "2. Get Information\n";
        $start .= "3. Exit";
        $this->ussd_proceed($start);
    }

    public function MainMenu(){
        $con  = "Welcome VHT Health Link\n";
        $con .= "1. Report Disease Outbreak.\n";
        $con .= "2. Patient Follow Up.\n";
        $con .= "3.	Request training.\n";
        $con .= "4. Life Check.\n";
        $con .= "0. Exit.";
        $this->ussd_proceed($con);
    }

    public function returnUserMenu(){
        $con  = "Welcome back to SampleUSSD\n";
        $con .= "1. Login\n";
        $con .= "2. Exit";
        $this->ussd_proceed($con);
    }
    public function servicesMenu(){
        $serve = "What service are you looking for?\n";
        $serve .= "1. Subscribe to updates\n";
        $serve .= "2. Information on the service\n";       
        $serve .= "3. Logout";
        $this->ussd_proceed($serve);
    }

    public function DiseasesMenu(){
        $dis  = "Report Cases\n";
        $dis .= "1. Malaria.\n";
        $dis .= "2. Cholera.\n";
        $dis .= "3.	Ebola.\n";
        $dis .= "4. Covid 19.\n";
        $dis .= "5. Diarrhoea.\n";
        $dis .= "6. Other.\n";
        $dis .= "0. Exit.";
        $this->ussd_proceed($dis);
    }

    public function returnFollowupMenu(){
        $follow  = "Patient Category\n";
        $follow .= "1. HIV/AIDs patient\n";
        $follow .= "2. Antenental\n";
        $follow .= "3. T.B\n";
        $follow .= "4. Mental care.\n";
        $follow .= "5. Other.\n";
        $follow .= "0. Exit.";
        $this->ussd_proceed($follow);
    }

    public function returnTrainingMenu(){
        $train  = "Training Category\n";
        $train .= "1. Childhood illness.\n";
        $train .= "2. Case Management\n";
        $train .= "3. First Aid\n";
        $train .= "4. Sanitation.\n";
        $train .= "5. Personal Hygiene.\n";
        $train .= "0. Exit.";
        $this->ussd_proceed($train);
    }
}