<?php

class Utilities {

    public static function loadTemplateBaseInfo($user) {
        $company = new Companies($user->getCompany());
        $data = array(
            'company_name' => $company->getName(),
            'user_email' => $user->getEmail()
        );
        return $data;
    }

}
