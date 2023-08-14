<?php
class Funding {

    private $db;

    public function __construct() {
        $this->db = new DB();
    }

    public function createFunding($userId, $businessId, $amount) {
        $userId = $this->db->escape($userId);
        $businessId = $this->db->escape($businessId);
        $amount = $this->db->escape($amount);
        $status = 'pending'; // Default status is 'pending'
        $date = date('Y-m-d'); // Current date

        $query = "INSERT INTO `funding` (`member_id`, `business_id`, `amount`, `status`, `date`) 
                  VALUES ('$userId', '$businessId', '$amount', '$status', '$date')";

        $this->db->query($query);
    }

    public function getTotalFunds($businessId) {
        $businessId = $this->db->escape($businessId);
        $sql = "SELECT SUM(amount) AS total_funds FROM funding WHERE business_id = '$businessId'";
        $result = $this->db->query($sql);
        
        if ($result->num_rows > 0) {
            $total_funds = $result->row['total_funds'];
            return $total_funds;
        }
        
        return 0;
    }

    public function getFundsByMember($member_id) {
        $member_id = $this->db->escape($member_id);
        $result = $this->db->query("SELECT funding.*, business.bizname 
                                     FROM funding 
                                     INNER JOIN business ON funding.business_id = business.id 
                                     WHERE funding.member_id = '$member_id'");

        if ($result->num_rows > 0) {
            return $result->rows;
        }

        return false;
    }

    public function getFundsByBusiness($business_id) {
        $business_id = $this->db->escape($business_id);
        $result = $this->db->query("SELECT funding.*, business.bizname, member.username AS funder 
                                     FROM funding 
                                     INNER JOIN business ON funding.business_id = business.id 
                                     INNER JOIN member ON funding.member_id = member.id
                                     WHERE funding.business_id = '$business_id'");
        if ($result->num_rows > 0) {
            return $result->rows;
        }

        return false;
    }
}