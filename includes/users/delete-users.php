<?php
require_once(ABSPATH.'wp-admin/includes/user.php');

class RimplatesDeleteUser
{
    public $validation_error = [];

    public function __construct()
    {
        add_shortcode('rimplates-delete-user', array($this, 'delete_user'));
    }

    public function delete_user()
    {
        global $wpdb;

        $user = $this->validate();

        if (empty($this->validation_error)) {

            if(!$this->authorization($user['admin_id'])) return 'permission denied';

            $table='wp_users';
            $deleted = wp_delete_user( $user['user_id'] );

            if ($deleted) {
                return 'Successfuly deleted';
            }

            return 'User not found';

        }

        return print_r($this->validation_error);
    }

    public function validate()
    {

        $user_id_error = [];
        $admin_id_error = [];

        $user['admin_id'] = sanitize_text_field( $_GET['admin_id'] );
        $user['user_id'] = sanitize_text_field( $_GET['user_id'] );

        if ($user['user_id'] == '') {
            $user_id_error[] = 'user_id is required';
        }
        if (!empty($user_id_error)) {
            $this->validation_error[] = ['user_id' => $user_id_error];
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

$RimplatesDeleteUser = new RimplatesDeleteUser();