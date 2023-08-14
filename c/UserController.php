<?php
class UserController {

    private $user;

    public function __construct() {
        $this->user = new User();
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $key = $_POST['key'];

            $result = $this->user->create($username, $password, $email, $key);

            if ($result === TRUE) {
                msg("注册成功. 你可通过邮箱找回密码. 请 <a href='index.php'>登录.</a>");
            } else {
                msg("错误: " . $result);  // Corrected line
            }
        } else {
            // Display the registration form
            load_view('user/register');
        }
    }

    public function login() {
        // Check if the user is already logged in
        if (isset($_SESSION['id'])) {
            // Redirect to the profile page
            header('Location: index.php?controller=User&action=profile');
            exit();
        }
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Authenticate the user
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = $this->user->find($username);

            if ($user) {
                if (password_verify($password, $user['password'])) {
                    // Store user data in the session
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['username'] = $username;
                    $_SESSION['role'] = $user['role'];
                    $_SESSION['status'] = $user['status'];
                    // Redirect to the profile page
                    header('Location: index.php?controller=User&action=profile');
                    exit();
                } else {
                    $_SESSION['error'] = "密码错误.";
                    header('Location: index.php?controller=User&action=login');
                    exit();
                }
            } else {
                $_SESSION['error'] = "该用户不存在.";
                header('Location: index.php?controller=User&action=login');
                exit();
            }
        } else {
            load_view('user/login');
        }
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        $_SESSION['logout_message'] = "你已成功退出";
        header("Location: index.php");
        exit;
    }

    public function profile() {
        if (isset($_SESSION['username'])) {
            // If user is logged in, display the business page
            load_view('user/profile');
        } else {
            // If user is not logged in, redirect to the login page
            header('Location: index.php?controller=User&action=login');
            exit;
        }
    }

    public function resetPasswordRequest() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $user = $this->user->find($username);
            
            if ($user) {
                $code = $this->user->updateRecoveryCode($username);
                $resetLink = "http://ulike.vip/index.php?controller=User&action=resetPassword&username=" . urlencode($username);
                $message = "你请求账号密码重置. 找回密码编号是: $code. 重置密码, 请访问以下链接: $resetLink";
                
                // mail function to send the email
                $headers = "From: webmaster@ulike.vip";
                if(mail($user['email'], "密码重置", $message, $headers)) {
                    msg("密码重置链接及密码编号已发到你的邮箱.");
                } else {
                    msg("发送密码重置邮件失败. 请稍后再试.");
                }
            } else {
                msg("找不到该用户.");
            }
        } else {
            load_view('user/reset_password_request');
        }
    }

    public function resetPassword() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $code = $_POST['code'];
            $newPassword = $_POST['password'];
            $user = $this->user->find($username);
            
            if ($user && $user['code'] == $code) {
                $result = $this->user->updatePassword($username, $newPassword);
                
                if ($result === TRUE) {
                    msg("成功更新密码. 请 <a href='index.php?controller=User&action=login'>登录</a>.");
                } else {
                    msg("错误: ") . $result;
                }
            } else {
                msg("无效重置编号或链接.");
            }
        } else {
            load_view('user/reset_password');
        }
    }

    public function userList() {
        $users = $this->user->getAllUsers();

        if (!$users) {
            msg("找不到用户.");
            exit;
        }

        load_view('user/user_list', ['users' => $users]);
    }

    public function updateUser() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $loggedInUser = $this->user->find($_SESSION['username']);
            $roles = explode(',', $loggedInUser['role']);

            if (in_array('a', $roles)) {
                $username = $_POST['username'];
                $status = $_POST['status'];
                $role = $_POST['role'];

                $result = $this->user->updateUser($username, $status, $role);

                if ($result === TRUE) {
                    msg("成功更新用户.");
                } else {
                    msg("Error: ") . $result;
                }
            } else {
                msg("你没有更新用户的权限.");
            }
        } else {
            $users = $this->user->getAllUsers();
            load_view('user/user_list', ['users' => $users]);
        }
    }

    public function applyCreateBusiness() {
        $username = $_SESSION['username'] ?? null;
        if ($username !== null) {
            $user = $this->user->find($username);
            $options = $user['options'] !== null ? json_decode($user['options'], true) : [];
            if (isset($options['applyCreateBusiness'])) {
                $lastApplied = DateTime::createFromFormat('Y-m-d H:i:s', $options['applyCreateBusiness']['timestamp']);
                $now = new DateTime();
                $diff = $now->diff($lastApplied);

                $hoursSinceLastApplication = $diff->h + ($diff->days * 48);

                if ($hoursSinceLastApplication < 48) {
                    $hoursLeft = 48 - $hoursSinceLastApplication;
                    msg("您申请在又来®平台创建投资项目.我们将在 $hoursLeft 小时内与您联系处理！");
                    return;
                }
            }

            $data = ['status' => 'y', 'timestamp' => date('Y-m-d H:i:s')];
            $result = $this->user->applyFor($username, 'applyCreateBusiness', $data);

            if ($result === TRUE) {
                msg('成功提交创建项目申请. 请等候回复.');
            } else {
                msg('错误: ' . $result);
            }
        }
    }
}