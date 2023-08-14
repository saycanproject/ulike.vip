<?php

class Balance {

  private $db;

  public function __construct() {
    $this->db = new DB();
  }

  public function getProfits($businessId) {

    // Get total income for this business  
    $incomeSql = "SELECT SUM(amount) AS total_income 
                  FROM records 
                  WHERE business_id = $businessId 
                    AND category = 'income'";

    $incomeResult = $this->db->query($incomeSql);
    $totalIncome = $incomeResult->row['total_income'];

    // Get total expense for this business   
    $expenseSql = "SELECT SUM(amount) AS total_expense 
                  FROM records
                  WHERE business_id = $businessId
                    AND category = 'expense'";
    
    $expenseResult = $this->db->query($expenseSql);
    $totalExpense = $expenseResult->row['total_expense'];

    // Calculate profits
    $profits = $totalIncome - $totalExpense;

    return $profits;
  }
  
  public function getUserFunds($businessId, $userId) {
    
    $sql = "SELECT SUM(amount) AS total_funds 
            FROM funding 
            WHERE business_id = $businessId
              AND member_id = $userId";

    $result = $this->db->query($sql);
    $totalFunds = $result->row['total_funds'];

    return $totalFunds;

  }

  public function getUserProfits($businessId, $userId) {

         // Get total profits
         $profits = $this->getProfits($businessId);

         // Get user's total funds
         $userFunds = $this->getUserFunds($businessId, $userId);

         // Get total funds for the business
         $totalFundsSql = "SELECT SUM(amount) AS total_funds
                           FROM funding 
                           WHERE business_id = $businessId";

         $totalFundsResult = $this->db->query($totalFundsSql);
         $totalFunds = $totalFundsResult->row['total_funds'];

         // Calculate user's share ratio
         if ($totalFunds == 0) {
             return '无';
         }

         $shareRatio = $userFunds / $totalFunds;

         // Calculate user's profits
         $userProfits = $shareRatio * $profits;

         return $userProfits;
     }

}