<?php

class RimplatesCreateUserApi
{

    public function __construct()
    {
        add_action('rest_api_init', array($this, 'register_api_routes'));
    }

    public function register_api_routes()
    {
        register_rest_route(
            'rimplates/v1', '/users',
            [
                'methods' => 'POST',
                'callback' => [$this, 'register_user']
            ]
        );
    }

    public function register_user(WP_REST_Request $request)
    {

        $user = new RimplatesCreateUser();
        $create_user = $user->create_user(
            $request->get_param('caller_id'),
            $request->get_param('user_email'),
            $request->get_param('user_login'),
            $request->get_param('user_pass'),
            [
                "first_name" => $request->get_param('first_name'),
                "last_name" => $request->get_param('last_name')
            ]
        );
        
        return new WP_REST_Response($create_user);
        
    }

}

$RimplatesCreateUserApi = new RimplatesCreateUserApi();