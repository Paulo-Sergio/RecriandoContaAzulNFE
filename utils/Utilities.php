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

    public static function last30Days() {
        return date('Y-m-d', strtotime('-30 days'));
    }
    
    public static function today() {
        return date('Y-m-d');
    }

}
