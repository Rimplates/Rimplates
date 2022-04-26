<?php
require 'jwt.php';

class RimplatesLoginUser
{
    public $validation_error = [];

    public function __construct()
    {
        add_shortcode('rimplates-login-user', array($this, 'login_user'));
    }

    public function login_user()
    {

        $user = $this->validate();

        $is_user = wp_authenticate($user['user_email'], $user['user_pass']);
        
        if (is_wp_error($is_user)) {

            $this->validation_error[] = 'Invalid Credential';
        }

        if (empty($this->validation_error)) {

            unset($is_user->data->user_pass);

            $iss = 'localhost';
            $iat = time();
            $exp = $iat + 3600;
            $user_data = $is_user->data;

            $secret_key = "user123";

            $payload = json_encode([
                'iss' => $iss,
                'iat' => $iat,
                'exp' => $exp,
                'data' => $user_data
            ]);

            $jwt = JWT::encode($payload);
            
            return print_r(['access_token' => $jwt]);

        }

        $response['error'] = $this->validation_error;

        return print_r($this->validation_error);
    }

    public function validate()
    {
        $user_email_error = [];
        $user_pass_error = [];

        $user['user_email'] = sanitize_text_field( $_POST['user_email'] );
	    $user['user_pass'] = sanitize_text_field( $_POST['user_pass'] );

        if ($user['user_email'] == '') {
            $user_email_error[] = 'user_email is required';
        }
        if (!is_email($user['user_email'])) {
            $user_email_error[] = 'Invalid user_email';
        }
        if (!empty($user_email_error)) {
            $this->validation_error[] = ['user_email' => $user_email_error];
        }

        if ($user['user_pass'] == '') {
            $user_pass_error[] = 'user_pass is required';
        }
        if (!empty($user_pass_error)) {
            $this->validation_error[] = ['user_pass' => $user_pass_error];
        }

        return $user;
    }
    
}

$RimplatesLoginUser = new RimplatesLoginUser();