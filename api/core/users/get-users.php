<?php

class RimplatesGetUserApi
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
                'methods' => 'GET',
                'callback' => [$this, 'get_users']
            ]
        );
    }

    public function get_users(WP_REST_Request $request)
    {

        $headers = getallheaders();
        $access_token = $headers['Authorization'];

        $user = new RimplatesGetUser();
        $get_user = $user->get_user(
            $request->get_param('caller_id'),
            $access_token,
        );
        
        return new WP_REST_Response($get_user);

    }
}

$RimplatesGetUserApi = new RimplatesGetUserApi();