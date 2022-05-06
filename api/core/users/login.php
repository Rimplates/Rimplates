<?php

class RimplatesLoginUserApi
{
    public $validation_error = [];

    public function __construct()
    {
        add_action('rest_api_init', array($this, 'register_api_routes'));
    }

    public function register_api_routes()
    {
        register_rest_route(
            'rimplates/v1', '/users/login',
            [
                'methods' => 'POST',
                'callback' => [$this, 'login_user']
            ]
        );
    }

    public function login_user(WP_REST_Request $request)
    {

        $user = new RimplatesLoginUser();
        $login_user = $user->login_user(
            $request->get_param('user_email'),
            $request->get_param('user_pass'),
        );
        
        return new WP_REST_Response($login_user);

    }
    
}

$RimplatesLoginUserApi = new RimplatesLoginUserApi();