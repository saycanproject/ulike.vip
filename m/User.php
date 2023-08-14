<?php
class User {
    
    private $db;

    public function __construct() {
        $this->db = new DB();
    }

    public function find($username) {
        $username = $this->db->escape($username);
        $result = $this->db->query("SELECT * FROM `member` WHERE `username` = '$username'");
        if ($result->num_rows > 0) {
            return $result->row;
        }
        return false;
    }

    public function getAllUsers() {
        $result = $this->db->query("SELECT * FROM `member`");
        if ($result->num_rows > 0) {
            return $result->rows;
        }

        return false;
    }

    public function updateUser($username, $status, $role) {
        $username = $this->db->escape($username);
        $status = $this->db->escape($status);
        $role = $this->db->escape($role);

        $sql = "UPDATE `member` SET `status` = '$status', `role` = '$role' WHERE `username` = '$username'";

        if ($this->db->query($sql) === TRUE) {
            return TRUE;
        } else {
            return $this->db->link->error;
        }
    }

    public function updateRecoveryCode($username) {
        $username = $this->db->escape($username);
        $code = rand(100000, 999999); // Generate a new random recovery code

        $sql = "UPDATE `member` SET `code` = '$code' WHERE `username` = '$username'";

        if ($this->db->query($sql) === TRUE) {
            return $code;
        } else {
            return $this->db->link->error;
        }
    }

    public function updatePassword($username, $password) {
        $username = $this->db->escape($username);
        $password = password_hash($password, PASSWORD_DEFAULT); // Hash the password

        $sql = "UPDATE `member` SET `password` = '$password' WHERE `username` = '$username'";

        if ($this->db->query($sql) === TRUE) {
            return TRUE;
        } else {
            return $this->db->link->error;
        }
    }
    
    public function create($username, $password, $email, $key) {
        $username = $this->db->escape($username);
        $password = password_hash($password, PASSWORD_DEFAULT); // Hash the password
        $email = $this->db->escape($email);
        $key = $this->db->escape($key);

        // Hard coded Register Key
        $registerKey = "3268";
        if ($key !== $registerKey) {
            return "Incorrect Registration Key";
        }

        // First, check if the username already exists in the database
        $checkUsernameSql = "SELECT * FROM `member` WHERE `username` = '$username'";
        $result = $this->db->query($checkUsernameSql);
        if ($result && $result->num_rows > 0) {
            // A record with this username already exists
            return "Username already exists";
        }

        // Check if the email already exists in the database
        $checkEmailSql = "SELECT * FROM `member` WHERE `email` = '$email'";
        $result = $this->db->query($checkEmailSql);
        if ($result && $result->num_rows > 0) {
            // A record with this email already exists
            return "Email already exists";
        }

        // Generate a new random recovery code
        $code = rand(100000, 999999); 

        $sql = "INSERT INTO `member` (`username`, `password`, `email`, `code`) VALUES ('$username', '$password', '$email', '$code')";

        if ($this->db->query($sql) === TRUE) {
            return TRUE;
        } else {
            return $this->db->link->error;
        }
    }
    
    public function isApprovedCandidate($user_id, $business_id) {
        $sql = "SELECT json_options 
                FROM settings 
                WHERE option_name = '{$business_id}' 
                AND option_value = 'approved'";

        $result = $this->db->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->row;
            $json_options = json_decode($row['json_options'], true);

            if (!isset($json_options['handlers'])) {
                return false;
            }

            $handlers = explode(',', $json_options['handlers']);
            
            if (in_array((string)$user_id, $handlers)) {
                return true;
            } else {
                return false;
            }
        }

        return false;
    }

    public function applyFor($username, $option, $data) {
        $username = $this->db->escape($username);
        $option = $this->db->escape($option);
        $data = array_map([$this->db, 'escape'], $data);

        $user = $this->find($username);
        // $options = json_decode($user['options'], true) ?? [];
        $options = $user['options'] !== null ? json_decode($user['options'], true) : [];

        $options[$option] = $data;  // Set the option

        $optionsJson = json_encode($options);
        $sql = "UPDATE `member` SET `options` = '$optionsJson' WHERE `username` = '$username'";

        if ($this->db->query($sql) === TRUE) {
            return TRUE;
        } else {
            return $this->db->link->error;
        }
    }
}