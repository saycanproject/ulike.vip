<?php
class RecordController {
    private $record;
    private $business;
    private $user;
    private $settings;

    public function __construct() {
        $this->record = new Record();
        $this->business = new Business();
        $this->user = new User();
        $this->settings = new Settings();
    }

    public function createRecord() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user_id = $_SESSION['id'];
            $business_id = $_POST['business_id'];
            $category = $_POST['category'];
            $amount = $_POST['amount'];
            $description = $_POST['description'];
            $date = $_POST['date'];

            $json_options = $this->settings->getJsonOptions($business_id);
            $isApprovedCandidate = $this->user->isApprovedCandidate($user_id, $business_id);

            if ($json_options !== false && $isApprovedCandidate) {
                $result = $this->record->create($user_id, $business_id, $category, $amount, $description, $date);
                if ($result === TRUE) {
                    msg("成功记录经营账目 <a href='index.php?controller=Record&action=showRecords'>点击查看记录</a>.");
                } else {
                    msg("经营记录出错, 请联系系统管理员.");
                }
            } else {
                msg("经营记录出错, 请联系系统管理员.");
            }

        } else {
            $business_id = filter_input(INPUT_GET, 'business_id', FILTER_SANITIZE_NUMBER_INT);
            load_view('record/create_record', ['business_id' => $business_id]);
        }
    }

    public function showRecords() {
        $user_id = $_SESSION['id'];
        $records = $this->record->getRecordsByUser($user_id);

        if (!empty($records)) {
            load_view('record/show_records', ['records' => $records]);
        } else {
            msg("没有找到经营记录.");
        }
    }
}