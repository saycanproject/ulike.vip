<?php
class BusinessController {
    private $business;
    private $user;
    private $settings;

    public function __construct() {
        $this->business = new Business();
        $this->user = new User();
        $this->settings = new Settings();
    }

    public function createBusiness() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $member_id = $_SESSION['id'];
            $user = $this->user->find($_SESSION['username']);
            $status = $user['status'];
            $roles = explode(',', $user['role']);

            if($status == 'approved' && (in_array('c', $roles))){
                $bizname = $_POST['bizname'];
                $description = strip_tags($_POST['description'], '<br><b>');
                $grand_total_target = $_POST['grand_total_target'];
                $handlers = $_POST['handlers'];
                $can_exceed = isset($_POST['can_exceed']) ? 1 : 0;
                $min_funding = isset($_POST['min_funding']) && $_POST['min_funding'] !== '' ? $_POST['min_funding'] : null;
                $max_funding = isset($_POST['max_funding']) && $_POST['max_funding'] !== '' ? $_POST['max_funding'] : null;

                $business_id = $this->business->create($member_id, $bizname, $description, $grand_total_target, $handlers, $can_exceed, $min_funding, $max_funding);

                if ($business_id !== FALSE) {
                    $json_options = array(
                        'grand_total_target' => $grand_total_target,
                        'handlers' => $handlers,
                        'can_exceed' => $can_exceed
                    );
                    $this->settings->setOption($business_id, 'pending', $member_id, $json_options);
                    msg("项目创建成功，你可以 <a href='index.php?controller=Business&action=showBusinesses'>在此查看你的项目</a>.");
                } else {
                    msg("错误: 创建项目出错");
                }
            } else {
                msg("你没有创建项目的权限.");
            }
        } else {
            load_view('business/create_business');
        }
    }

    public function editBusiness() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = $this->user->find($_SESSION['username']);
            $roles = explode(',', $user['role']);

            if (in_array('a', $roles) && isset($_POST['business_id'])) {
                $business_id = $_POST['business_id'];
                $bizname = $_POST['bizname'];
                $description = strip_tags($_POST['description'], '<br><b>');

                if ($this->business->update($business_id, $bizname, $description)) {
                    msg("项目更新成功，你可以 <a href='index.php?controller=Business&action=showBusinesses'>在此查看你的项目</a>.");
                } else {
                    msg("错误: 更新项目出错");
                }
            } else {
                msg("你没有编辑项目的权限.");
            }
        } else {
            $business_id = $_GET['business_id'] ?? null;
            if($business_id) {
                $business = $this->business->getBusinessById($business_id);
                if($business) {
                    load_view('business/edit_business', ['business' => $business]);
                } else {
                    msg("找不到指定的项目.");
                }
            } else {
                msg("无效的请求.");
            }
        }
    }

    public function showBusinesses() {
        if (!isset($_SESSION['id'])) {
            msg('请先登录！');
            return;
        }

        $member_id = $_SESSION['id'];
        $businesses = $this->business->getBusinessesByMember($member_id);
        $otherBusinesses = $this->business->getOtherBusinesses($member_id);

        if (is_array($businesses) || is_object($businesses)) {
            foreach ($businesses as &$business) {
                $json_options = $this->settings->getJsonOptions($business['id']);
                $isApprovedCandidate = $this->user->isApprovedCandidate($member_id, $business['id']);
                $business['json_options'] = $json_options;
                $business['isApprovedCandidate'] = $isApprovedCandidate;
            }
        } else {
            $businesses = [];
        }

        if (is_array($otherBusinesses) || is_object($otherBusinesses)) {
            foreach ($otherBusinesses as &$business) {
                $json_options = $this->settings->getJsonOptions($business['id']);
                $isApprovedCandidate = $this->user->isApprovedCandidate($member_id, $business['id']);
                $business['json_options'] = $json_options;
                $business['isApprovedCandidate'] = $isApprovedCandidate;
            }
        } else {
            $otherBusinesses = [];
        }

        if ($businesses || $otherBusinesses) {
            load_view('business/show_businesses', [
                'businesses' => $businesses, 
                'otherBusinesses' => $otherBusinesses,
                'roles' => explode(',', $_SESSION['role'])
            ]);
        } else {
            msg("No businesses found.");
        }
    }
    
    public function selectBusiness() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['business_id'])) {
            $_SESSION['selected_business_id'] = $_POST['business_id'];
            header("Location: index.php?controller=Record&action=createRecord"); // Redirect to the page where the user can create a record
            exit();
        } else {
            msg("无效请求.");
        }
    }
     public function tos() {
       load_view('business/tos'); 
     }      
}