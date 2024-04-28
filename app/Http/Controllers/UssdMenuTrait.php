<?php

namespace App\Http\Controllers;

trait UssdMenuTrait
{
    public function MainMenu()
    {
        $start = "VHT Health Link\n";
        $start .= "1. Report Disease Outbreak.\n";
        $start .= "2. Patient Follow Up.\n";
        $start .= "3. Request training.\n";
        $start .= "4. Deaths and Births.\n";
        $start .= "5. Edit profile.\n";
        $start .= '0. Exit.';
        $this->ussd_proceed($start);
    }

    public function DiseasesMenu()
    {
        $con = "Report Cases\n";
        $con .= "1. Malaria.\n";
        $con .= "2. Cholera.\n";
        $con .= "3. Ebola.\n";
        $con .= "4. Covid 19.\n";
        $con .= "5. Diarrhoea.\n";
        $con .= "6. Other.\n";
        $con .= '0. Exit.';
        $this->ussd_proceed($con);
    }

    public function returnFollowupMenu()
    {
        $serve = "Patient Category\n";
        $serve .= "1. HIV/AIDS patient\n";
        $serve .= "2. Antenatal\n";
        $serve .= "3. T.B\n";
        $serve .= "4. Mental care.\n";
        $serve .= "5. Other.\n";
        $serve .= '0. Exit.';
        $this->ussd_proceed($serve);
    }

    public function returnTrainingMenu()
    {
        $message = "Training Category\n";
        $message .= "1. Childhood illness.\n";
        $message .= "2. Case Management\n";
        $message .= "3. First Aid\n";
        $message .= "4. Sanitation.\n";
        $message .= "5. Personal Hygiene.\n";
        $message .= '0. Exit.';
        $this->ussd_proceed($message);
    }

    public function SupervisorsMenu()
    {
        $view = "VHT Health Link\n";
        $view .= "1. Latest Reported Case.\n";
        $view .= "2. Initiate Mobilization.\n";
        $view .= "3. Schedule VHT training.\n";
        $view .= "4. Send updates.\n";
        $view .= '0. Exit.';
        $this->ussd_proceed($view);
    }

    public function mobilizationMenu()
    {
        $mob = "Mobilization\n";
        $mob .= "1. Immunization Campaigns.\n";
        $mob .= "2. Health Education.\n";
        $mob .= "3. Health screening.\n";
        $mob .= "4. Disease prevention.\n";
        $mob .= "5. Other.\n";
        $mob .= '0. Exit.';
        $this->ussd_proceed($mob);
    }

    public function editProfile()
    {
        $edit = "Edit Profile\n";
        $edit .= "1. Change Name.\n";
        $edit .= "2. Change phone number.\n";
        $edit .= "3. Change District.\n";
        $edit .= "4. Change Subcounty.\n";
        $edit .= "5. Change Parish.\n";
        $edit .= "6. Change Village.\n";
        $edit .= '0. Exit.';
        $this->ussd_proceed($edit);
    }

    public function returnbirthsMenu()
    {
        $births = 'Enter number of births';
        $this->ussd_proceed($births);
    }
}
