<?php

namespace App\Helpers;

use App\Models\Admin;
use App\Models\Agent;
use App\Models\Seller;
use App\Models\User;
use Carbon\Carbon;

class SettingsHelper
{
    public static function getGreeting()
    {
        //$time = date("H");
        $time = Carbon::now()->hour;
        /* If the time is less than 1200 hours, show good morning */
        if ($time < '12') {
            return 'Good morning';
        }
        /* If the time is grater than or equal to 1200 hours, but less than 1700 hours, so good afternoon */ elseif ($time >= '12' && $time < '17') {
            return 'Good afternoon';
        }
        /* Should the time be between or equal to 1700 and 1900 hours, show good evening */ elseif ($time >= '17' && $time < '22') {
            return 'Good evening';
        }
        /* Finally, show good night if the time is greater than or equal to 2200 hours */ elseif ($time >= '22') {
            return 'Good night';
        }
    }

    public static function generatTicketID()
    {
        $characters = '0123456789';
        $randomString = '';
        for ($i = 0; $i < 9; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }
        return  $randomString;
    }

    public static function passGenerator($n)
    {
        $characters = '0123456789';
        $randomString = '';

        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }

    public static function sanitazeAmount($amount)
    { 
        $number = (int)str_replace(',', '', $amount);
        // or
        // $number = (int)preg_replace('/[^\d]/', '', $amount);
        return $number;
    }

    public static function checkPhoneNumber(string $mobile)
    {
        // Remove any non-digit characters from the phone number
        $cleanedNumber = preg_replace('/\D/', '', $mobile);
    
        // If the number starts with '0', replace it with '255'
        if (substr($cleanedNumber, 0, 1) === '0') {
            $cleanedNumber = '255' . substr($cleanedNumber, 1);
        }
    
        // If the number does not start with '0' or '+', and is not already in the format '255', append '255'
        if (substr($cleanedNumber, 0, 1) !== '0' && substr($cleanedNumber, 0, 1) !== '+' && substr($cleanedNumber, 0, 3) !== '255') {
            $cleanedNumber = '255' . $cleanedNumber;
        }
    
        // If the number starts with '+', remove the '+'
        if (substr($cleanedNumber, 0, 1) === '+') {
            $cleanedNumber = substr($cleanedNumber, 1);
        }
    
        return $cleanedNumber;
    }

    public static function unique_order_number()
    {
        return rand(1000, 9999) .  time();
    }

    //generate reference
    public static function generateref($regno)
    {
        $characters = '0123456789';
        $randomString = '';
        for ($i = 0; $i < 9; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }
        return $regno . '' . $randomString;
    }

    public static function getRealIP()
    {
        $ip = $_SERVER["REMOTE_ADDR"];
        //Deep detect ip
        if (filter_var(@$_SERVER['HTTP_FORWARDED'], FILTER_VALIDATE_IP)) {
            $ip = $_SERVER['HTTP_FORWARDED'];
        }
        if (filter_var(@$_SERVER['HTTP_FORWARDED_FOR'], FILTER_VALIDATE_IP)) {
            $ip = $_SERVER['HTTP_FORWARDED_FOR'];
        }
        if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP)) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP)) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
        if (filter_var(@$_SERVER['HTTP_X_REAL_IP'], FILTER_VALIDATE_IP)) {
            $ip = $_SERVER['HTTP_X_REAL_IP'];
        }
        if (filter_var(@$_SERVER['HTTP_CF_CONNECTING_IP'], FILTER_VALIDATE_IP)) {
            $ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
        }
        if ($ip == '::1') {
            $ip = '127.0.0.1';
        }

        return $ip;
    }

    public static function sendSMS($contact, $sms)
    {
        $api_key = '';
        $from = '';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://smsportal.imartgroup.co.tz/app/smsapi/index.php');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'key=' . $api_key . '&campaign=739&routeid=8&type=text&contacts=' . $contact . '&senderid=' . $from . '&msg=' . $sms);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    public static function getCustomerInitials($id)
    {
        $customer = User::find($id);
        $name = $customer->name;
        $name_arr = explode(" ", $name);
        $names = [
            'fname' => isset($name_arr[0]) ? $name_arr[0] : '',
            'mname' => isset($name_arr[1]) ? $name_arr[1] : '',
            'lname' => isset($name_arr[2]) ? $name_arr[2] : '',
        ];

        if (count($names) > 1) {
            $firstInitial = strtoupper(substr($names['fname'], 0, 1));
            $secondInitial = strtoupper(substr($names['mname'], 0, 1));
            $thirdInitial = strtoupper(substr($names['lname'], 0, 1));

            if (isset($secondInitial)) {
                $initials = $firstInitial.$secondInitial;
                return $initials;
            } else {
                $initials = $firstInitial.$thirdInitial;
                return $initials;
            }
        } else {
            $initials = strtoupper(substr($names['fname'], 0, 2));
        }
        
        return $initials;
        
    }

    public static function getAdminInitials($id)
    {
        $admin = Admin::find($id);
        $name = $admin->name;
        $name_arr = explode(" ", $name);
        $names = [
            'fname' => isset($name_arr[0]) ? $name_arr[0] : '',
            'mname' => isset($name_arr[1]) ? $name_arr[1] : '',
            'lname' => isset($name_arr[2]) ? $name_arr[2] : '',
        ];

        if (count($names) > 1) {
            $firstInitial = strtoupper(substr($names['fname'], 0, 1));
            $secondInitial = strtoupper(substr($names['mname'], 0, 1));
            $thirdInitial = strtoupper(substr($names['lname'], 0, 1));

            if (isset($secondInitial)) {
                $initials = $firstInitial.$secondInitial;
                return $initials;
            } else {
                $initials = $firstInitial.$thirdInitial;
                return $initials;
            }
        } else {
            $initials = strtoupper(substr($names['fname'], 0, 2));
        }
        
        return $initials;
        
    }

    public static function getUserInitials($id)
    {
        $admin = User::find($id);
        $name = $admin->name;
        $name_arr = explode(" ", $name);
        $names = [
            'fname' => isset($name_arr[0]) ? $name_arr[0] : '',
            'mname' => isset($name_arr[1]) ? $name_arr[1] : '',
            'lname' => isset($name_arr[2]) ? $name_arr[2] : '',
        ];

        if (count($names) > 1) {
            $firstInitial = strtoupper(substr($names['fname'], 0, 1));
            $secondInitial = strtoupper(substr($names['mname'], 0, 1));
            $thirdInitial = strtoupper(substr($names['lname'], 0, 1));

            if (isset($secondInitial)) {
                $initials = $firstInitial.$secondInitial;
                return $initials;
            } else {
                $initials = $firstInitial.$thirdInitial;
                return $initials;
            }
        } else {
            $initials = strtoupper(substr($names['fname'], 0, 2));
        }
        
        return $initials;
        
    }

    public static function getSellerInitials($id)
    {
        $admin = Seller::find($id);
        $name = $admin->name;
        $name_arr = explode(" ", $name);
        $names = [
            'fname' => isset($name_arr[0]) ? $name_arr[0] : '',
            'mname' => isset($name_arr[1]) ? $name_arr[1] : '',
            'lname' => isset($name_arr[2]) ? $name_arr[2] : '',
        ];

        if (count($names) > 1) {
            $firstInitial = strtoupper(substr($names['fname'], 0, 1));
            $secondInitial = strtoupper(substr($names['mname'], 0, 1));
            $thirdInitial = strtoupper(substr($names['lname'], 0, 1));

            if (isset($secondInitial)) {
                $initials = $firstInitial.$secondInitial;
                return $initials;
            } else {
                $initials = $firstInitial.$thirdInitial;
                return $initials;
            }
        } else {
            $initials = strtoupper(substr($names['fname'], 0, 2));
        }
        
        return $initials;
        
    }

    public static function getAgentInitials($id)
    {
        $admin = Agent::find($id);
        $name = $admin->name;
        $name_arr = explode(" ", $name);
        $names = [
            'fname' => isset($name_arr[0]) ? $name_arr[0] : '',
            'mname' => isset($name_arr[1]) ? $name_arr[1] : '',
            'lname' => isset($name_arr[2]) ? $name_arr[2] : '',
        ];

        if (count($names) > 1) {
            $firstInitial = strtoupper(substr($names['fname'], 0, 1));
            $secondInitial = strtoupper(substr($names['mname'], 0, 1));
            $thirdInitial = strtoupper(substr($names['lname'], 0, 1));

            if (isset($secondInitial)) {
                $initials = $firstInitial.$secondInitial;
                return $initials;
            } else {
                $initials = $firstInitial.$thirdInitial;
                return $initials;
            }
        } else {
            $initials = strtoupper(substr($names['fname'], 0, 2));
        }
        
        return $initials;
        
    }
}
