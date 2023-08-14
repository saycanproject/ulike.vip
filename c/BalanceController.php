<?php

class BalanceController {

  private $balance;

  public function __construct() {
    $this->balance = new Balance(); 
  }

  public function showBalance() {

    $businessId = $_GET['business_id'];

    // Get business name
    $business = new Business();
    $biz = $business->getBusinessById($businessId);
    $bizName = $biz['bizname'];

    $userId = $_SESSION['id'];

    $profits = $this->balance->getProfits($businessId);
    $userProfits = $this->balance->getUserProfits($businessId, $userId);

    load_view('business/balance', [
      'bizName' => $bizName,
      'profits' => $profits,
      'userProfits' => $userProfits
    ]);

  }

}