<?php

class RimplatesGetUser
{
    public $validation_error = [];

    public function __construct()
    {
        add_shortcode('rimplates-get-user', array($this, 'get_user'));
    }

    public function get_user()
    {

        // $access_token = sanitize_text_field($_POST['access_token']);
        $user = $this->validate();


        if (empty($this->validation_error)) {

            if(!$this->authorization($user['admin_id'])) return 'permission denied';

            if ($user['access_token']) {
                try {
                    
                    $user_access_token = JWT::decode($user['access_token']);

                    if ($user_access_token === "Expired token") {
                        return 'Expired token';
                    } elseif ($user_access_token === "Invalid signature") {
                        return 'Invalid signature';
                    } elseif ($user_access_token) {
                        return print_r(json_decode($user_access_token));
                    }

                } catch (Exception $ex) {
                    
                    return $ex->getMessage();

                }
            } else {

                return 'User not found';
            }


        }

        return print_r($this->validation_error);
        
    }

    public function validate()
    {

        $access_token_error = [];
        $admin_id_error = [];

        $user['admin_id'] = sanitize_text_field( $_POST['admin_id'] );
        $user['access_token'] = sanitize_text_field( $_POST['access_token'] );

        if ($user['access_token'] == '') {
            $access_token_error[] = 'access_token is required';
        }
        if (!empty($access_token_error)) {
            $this->validation_error[] = ['access_token' => $access_token_error];
        }

        if ($user['admin_id'] == '') {
            $admin_id_error[] = 'admin_id is required';
        }
        if (!empty($admin_id_error)) {
            $this->validation_error[] = ['admin_id' => $admin_id_error];
        }

        return $user;
    }

    public function authorization($user_id)
    {
        $user = get_user_by('ID', $user_id);

        if (user_can($user, 'administrator')) {
            
            return true;

        }

        return false;
    }
}

$RimplatesGetUser = new RimplatesGetUser();