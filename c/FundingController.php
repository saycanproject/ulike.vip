<?php
class FundingController {

    private $capital;

    public function __construct() {
        $this->capital = new Capital();
    }

    private function validateAmount($amount, $min_funding, $max_funding) {
        if ($min_funding != 0 && $amount < $min_funding) {
            return '没有达到最低金额要求.';
        }

        if ($max_funding != 0 && $amount > $max_funding) {
            return '金额超出最高金额限额.';
        }

        return null;
    }

    public function fundBusiness() {
        // Create user instance to check user's role
        $userModel = new User();

        // Retrieve user id and role from the session
        $userId = $_SESSION['id'] ?? null;
        $username = $_SESSION['username'] ?? null;

        if (!$userId || !$username) {
            die(msg('用户未登录'));
        }

        // Get user's roles
        $user = $userModel->find($username);
        $roles = explode(',', $user['role']);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Check if the user has the 'f' role
            if (!in_array('f', $roles)) {
                die(msg('你没有投资项目的权限.'));
            }

            // Retrieve business id and amount from POST request
            $businessId = $_POST['business_id'] ?? null;
            $amount = $_POST['amount'] ?? null;

            // Ensure business id and amount are provided
            if (!$businessId || !$amount) {
                die(msg('请填写金额'));
            }

            // Check if the user has enough capital
            $existingCapital = $this->capital->getCapital($userId);
            if ($existingCapital < $amount) {
                die(msg('投资资金不足.'));
            }

            // Retrieve business details
            $businessModel = new Business();
            $business = $businessModel->getBusinessById($businessId);

            // If the business doesn't exist, show an error
            if (!$business) {
                die(msg('项目不存在'));
            }

            // Get min_funding, max_funding, grand_total_target and can_exceed from the extra_info field
            $extra_info = json_decode($business['extra_info'], true);
            $min_funding = $extra_info['min_funding'] ?? 0;
            $max_funding = $extra_info['max_funding'] ?? 0;
            $grand_total_target = $extra_info['grand_total_target'] ?? 0;
            $can_exceed = $extra_info['can_exceed'] ?? 0;

            // Validate the amount based on min_funding and max_funding
            if ($min_funding != 0 && $amount < $min_funding) {
                die(msg('金额未达到最低投资数额.'));
            }

            if ($max_funding != 0 && $amount > $max_funding) {
                die(msg('金额超出最高投资数额.'));
            }

            // Create funding instance to get total funds
            $funding = new Funding();
            $total_funds = $funding->getTotalFunds($businessId); // assuming you have a getTotalFunds() method in Funding model

            // Check if the total funds would exceed the grand total target (if can_exceed is false)
            if (!$can_exceed && ($total_funds + $amount > $grand_total_target)) {
                die(msg('金额可以超出总募资数额.'));
            }

            // Deduct funds from capital
            $this->capital->transferCapital($userId, $amount);

            // Create funding
            $funding->createFunding($userId, $businessId, $amount);

            // Redirect user or show success message here...
            msg("资金投入成功!");
        } else {
            // Retrieve business id from GET request
            $businessId = $_GET['business_id'] ?? null;

            if (!$businessId) {
                die(msg('项目编号为空'));
            }

            // Retrieve business details
            $businessModel = new Business();
            $business = $businessModel->getBusinessById($businessId);

            // If the business doesn't exist, show an error
            if (!$business) {
                die(msg('项目不存在'));
            }

            // Get total funds for the business
            $fundingModel = new Funding();
            $total_funds = $fundingModel->getTotalFunds($businessId) ?? 0;
            // Load fund_business view
            load_view('funding/fund_business', ['business' => $business, 'total_funds' => $total_funds]);
        }
    }

    public function showFundsByUser() {
        $userModel = new User();
        $userId = $_SESSION['id'] ?? null;
        $username = $_SESSION['username'] ?? null;

        if (!$userId || !$username) {
            die(msg('用户未登录'));
        }

        // Get user's roles
        $user = $userModel->find($username);
        $roles = explode(',', $user['role']);

        // Check if the user has the 'f' role
        if (!in_array('f', $roles)) {
            die(msg('你没有查看投资的权限.'));
        }

        $fundingModel = new Funding();
        $fundings = $fundingModel->getFundsByMember($userId);

        // Ensure fundings are retrieved
        if (!$fundings) {
            die(msg('没有找到投资项目'));
        }

        load_view('funding/show_funds', ['fundings' => $fundings]);
    }

    public function showFundsByBusiness() {
        $businessId = $_GET['business_id'] ?? null;

        if (!$businessId) {
            die(msg('项目编号不能为空'));
        }

        $fundingModel = new Funding();
        $fundings = $fundingModel->getFundsByBusiness($businessId);
        if (!$fundings) {
            die(msg('没有找到投资项目'));
        }

        load_view('funding/show_funds', ['fundings' => $fundings]);
    }
}