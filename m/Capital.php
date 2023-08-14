<?php
class Capital {
    private $db;

    public function __construct() {
        $this->db = new DB();
    }

    public function getCapital($member_id) {
        $member_id = $this->db->escape($member_id);
        $result = $this->db->query("SELECT `amount` FROM `capital` WHERE `member_id` = '$member_id'");
        
        if ($result && $result->num_rows > 0) {
            return $result->row['amount'];
        }

        return 0;
    }

    public function depositCapital($member_id, $amount) {
        $member_id = $this->db->escape($member_id);
        $amount = $this->db->escape($amount);
        
        $existingAmount = $this->getCapital($member_id);
        $newAmount = $existingAmount + $amount;

        $sql = "INSERT INTO `capital` (`member_id`, `amount`) 
                VALUES ('$member_id', '$newAmount')
                ON DUPLICATE KEY UPDATE `amount` = '$newAmount'";

        if ($this->db->query($sql) === TRUE) {
            return $newAmount;
        } else {
            return $this->db->link->error;
        }
    }

    public function transferCapital($member_id, $amount) {
        $member_id = $this->db->escape($member_id);
        $amount = $this->db->escape($amount);
        
        $existingAmount = $this->getCapital($member_id);
        if ($existingAmount < $amount) {
            return false;  // Not enough funds
        }

        $newAmount = $existingAmount - $amount;

        $sql = "UPDATE `capital` SET `amount` = '$newAmount' WHERE `member_id` = '$member_id'";
        
        if ($this->db->query($sql) === TRUE) {
            return $newAmount;
        } else {
            return $this->db->link->error;
        }
    }
}