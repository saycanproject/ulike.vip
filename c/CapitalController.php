<?php
class CapitalController {

    private $capital;

    public function __construct() {
        $this->capital = new Capital();
    }

    public function showCapital() {
      $userId = $_SESSION['id'];
      $capital = $this->capital->getCapital($userId);

      // Create a Funding object and get the funding data
      $funding = new Funding();
      $fundings = $funding->getFundsByMember($userId);

      load_view('capital/show_capital', [
        'capital' => $capital,
        'fundings' => $fundings
      ]);
    }

    public function depositCapital() {

        // We make sure the session role exists and contains 'a'
        if (!(isset($_SESSION['role']) && strpos($_SESSION['role'], 'a') !== false)) {
            // Not an admin, redirect to an error page or another page.
            header('Location: http://ulike.vip/index.php?controller=Error&action=unauthorized');
            exit();
        }

        // We make sure userId is provided
        if (!isset($_GET['userId'])) {
            // No user specified, redirect to an error page or another page.
            header('Location: http://ulike.vip/index.php?controller=Error&action=userNotFound');
            exit();
        }

        // We get the userId from the GET parameters instead of the session
        $userId = $_GET['userId'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // This is a POST request, so we process the deposit.
            $amount = $_POST['amount'];
            
            $newAmount = $this->capital->depositCapital($userId, $amount);
            
            if ($newAmount !== false) {
                msg("资金存入成功, 现有资金: $newAmount.");
            } else {
                msg("Error adding funds.");
            }
        } else {
            // This is not a POST request, so we serve the page to the user.
            load_view('capital/deposit_capital', ['userId' => $userId]);
        }
    }
    
    public function transferCapital() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['id'];
            $amount = $_POST['amount'];
            
            $newAmount = $this->capital->transferCapital($userId, $amount);
            
            if ($newAmount !== false) {
                msg("Funds withdrawn successfully. Your new capital balance is $newAmount.");
            } else {
                msg("Error withdrawing funds. Please ensure you have enough capital.");
            }
        }
    }
}