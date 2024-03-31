<?php

namespace App\Http\Controllers;

trait UssdMenuTrait{

    public function MainMenu(){
        $start  = "Welcome VHT Health Link\n";
        $start .= "1. Report Disease Outbreak.\n";
        $start .= "2. Patient Follow Up.\n";
        $start .= "3. Request training.\n";
        $start .= "4. Life Check.\n";
        $start .= "0. Exit.";
        $this->ussd_proceed($start);
    }

    public function DiseasesMenu(){
        $con  = "Report Cases\n";
        $con .= "1. Malaria.\n";
        $con .= "2. Cholera.\n";
        $con .= "3. Ebola.\n";
        $con .= "4. Covid 19.\n";
        $con .= "5. Diarrhoea.\n";
        $con .= "6. Other.\n";
        $con .= "0. Exit.";
        $this->ussd_proceed($con);
    }

    public function returnFollowupMenu(){
        $serve  = "Patient Category\n";
        $serve .= "1. HIV/AIDS patient\n";
        $serve .= "2. Antenatal\n";
        $serve .= "3. T.B\n";
        $serve .= "4. Mental care.\n";
        $serve .= "5. Other.\n";
        $serve .= "0. Exit.";
        $this->ussd_proceed($serve);
    }

    public function returnTrainingMenu(){
        $message  = "Training Category\n";
        $message .= "1. Childhood illness.\n";
        $message .= "2. Case Management\n";
        $message .= "3. First Aid\n";
        $message .= "4. Sanitation.\n";
        $message .= "5. Personal Hygiene.\n";
        $message .= "0. Exit.";
        $this->ussd_proceed($message);
    }


}