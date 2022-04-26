<?php

class RimplatesUpdateUser
{
    public $validation_error = [];
    // public $user_id;

    public function __construct()
    {
        add_shortcode('rimplates-update-user', array($this, 'update_user'));
    }

    public function update_user()
    {

        $user = $this->validate();

        if (empty($this->validation_error)) {

            if(!$this->authorization($user['user']['admin_id'])) return 'permission denied';

            update_user_meta($user['user']['user_id'], 'first_name', $user['user_meta']['first_name']);
            update_user_meta($user['user']['user_id'], 'last_name', $user['user_meta']['last_name']);
            
            $update_user = wp_update_user( $user['user'] );

            return $update_user;

        }

        return print_r($this->validation_error);
    }

    public function validate()
    {
        $first_name_error = [];
        $last_name_error = [];
        $display_name_error = [];
        $user_nicename_error = [];
        $user_login_error = [];
        $user_email_error = [];
        $user_pass = [];

        $user_id_error = [];
        $admin_id_error = [];

        $user['user_id'] = sanitize_text_field( $_GET['user_id'] );
        $user['admin_id'] = sanitize_text_field( $_GET['admin_id'] );

        if ($user['user_id'] == '') {
            $user_id_error = 'user_id is required';
        }
        if (!empty($user_id_error)) {
            $this->validation_error[] = ['user_id' => $user_id_error];
        }

        if ($user['admin_id'] == '') {
            $admin_id_error = 'admin_id is required';
        }
        if (!empty($admin_id_error)) {
            $this->validation_error[] = ['admin_id' => $admin_id_error];
        }

        if ($user['user_id']) {
            
            $get_user = get_user_by('ID', $user['user_id']);
            $get_user_meta_first_name = get_user_meta($user['user_id'], 'first_name')[1];
            $get_user_meta_last_name = get_user_meta($user['user_id'], 'last_name')[1];
            

            $user['ID'] = $user['user_id'];

            $user_meta['first_name'] = sanitize_text_field( $_POST['first_name'] );
            $user_meta['last_name'] = sanitize_text_field( $_POST['last_name'] );

            $user['display_name'] = sanitize_text_field( $_POST['display_name'] );
            $user['user_nicename'] = sanitize_text_field( $_POST['user_nicename'] );
            $user['user_email'] = sanitize_text_field( $_POST['user_email'] );
            $user['user_pass'] = sanitize_text_field( $_POST['user_pass'] );

            if ($user_meta['first_name'] == '') {
                $user_meta['first_name'] = $get_user_meta_first_name;
            }
            if (strlen($user_meta['first_name']) < 2) {
                $first_name_error[] = 'first_name must be atleast 2 chars';
            }
            if (!empty($first_name_error)) {
                $this->validation_error[] = ['first_name' => $first_name_error];
            }

            if ($user_meta['last_name'] == '') {
                $user_meta['last_name'] = $get_user_meta_last_name;
            }
            if (strlen($user_meta['last_name']) < 2) {
                $last_name_error[] = 'last_name must be atleast 2 chars';
            }
            if (!empty($last_name_error)) {
                $this->validation_error[] = ['last_name' => $last_name_error];
            }

            if ($user['display_name'] == '') {
                $user['display_name'] = $get_user->display_name;
            }
            if (strlen($user['display_name']) < 4) {
                $display_name_error[] = 'display_name must be atleast 4 chars';
            }
            if (!empty($display_name_error)) {
                $this->validation_error[] = ['display_name' => $display_name_error];
            }

            if ($user['user_nicename'] == '') {
                $user['user_nicename'] = $get_user->user_nicename;
            }
            if (strlen($user['user_nicename']) < 4) {
                $user_nicename_error[] = 'user_nicename must be atleast 4 chars';
            }
            if (!empty($user_nicename_error)) {
                $this->validation_error[] = ['user_nicename' => $user_nicename_error];
            }

            if ($user['user_email'] == '') {
                $user['user_email'] = $get_user->user_email;
            }
            if (!is_email($user['user_email'])) {
                $user_email_error[] = 'Invalid email';
            }
            if (!empty($user_email_error)) {
                $this->validation_error[] = ['user_email' => $user_email_error];
            }

        }


        return ['user' => $user, 'user_meta' => $user_meta];
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

$RimplatesUpdateUser = new RimplatesUpdateUser();