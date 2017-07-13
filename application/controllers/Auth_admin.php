<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auth_admin extends CI_Controller {

    function __construct() { 
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('Admin_model');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->auth = new stdClass;
        $this->load->library('flexi_auth');

        if (!$this->flexi_auth->is_logged_in_via_password() || !$this->flexi_auth->is_admin()) {
            $this->flexi_auth->set_error_message('You must login as an admin to access this area.', TRUE);
            $this->session->set_flashdata('message', $this->flexi_auth->get_messages());
            redirect('auth');
        }
        $this->data = null;
        if ($this->flexi_auth->is_logged_in()) {
            $this->data['userinfo'] = $this->userinfo = $this->flexi_auth->get_user_by_identity_row_array();
            $this->user_id = $this->data['userinfo']['uacc_id'];
        }
    }

    function include_files() {
        $this->data['header'] = $this->load->view('admin/header', $this->data, TRUE);
        $this->data['sidebar'] = $this->load->view('admin/sidebar', NULL, TRUE);
        $this->data['common'] = $this->load->view('admin/common', NULL, TRUE);
        $this->data['footer'] = $this->load->view('admin/footer', NULL, TRUE);
        return $this->data;
    }

    function index() {
        $this->dashboard();
    }

    function dashboard() {
        if ($this->flexi_auth->is_logged_in() && $this->userinfo['uacc_group_fk'] == 3) {
            $this->data['dashboard_data'] = $this->Admin_model->dashboard_data();
            $this->data['message'] = $this->session->flashdata('message');
            $this->data = $this->include_files();
            $this->load->view('admin/dashboard', $this->data);
        } else {
            redirect('admin');
        }
    }

    function users() {
        if ($this->flexi_auth->is_logged_in() && $this->userinfo['uacc_group_fk'] == 3) {
            $this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
            $this->data = $this->include_files();
            $this->load->view('admin/users', $this->data);
        } else {
            redirect('admin');
        }
    }

    function businesses() {
        if ($this->flexi_auth->is_logged_in() && $this->userinfo['uacc_group_fk'] == 3) {
            $this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
            $this->data = $this->include_files();
            $this->load->view('admin/businesses', $this->data);
        } else {
            redirect('admin');
        }
    }

    function business_detail($business_id) {
        if ($this->flexi_auth->is_logged_in() && $this->userinfo['uacc_group_fk'] == 3) {
            $this->data['business'] = $businessinfo = $this->Common_model->get_business($business_id);
            $this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
            $this->data = $this->include_files();
            $this->load->view('admin/business_detail', $this->data);
        } else {
            redirect('admin');
        }
    }

    function categories() {
        if ($this->flexi_auth->is_logged_in() && $this->userinfo['uacc_group_fk'] == 3) {
            $this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
            $this->data = $this->include_files();
            $this->load->view('admin/categories', $this->data);
        } else {
            redirect('admin');
        }
    }

    function visitor_adds() {
        if ($this->flexi_auth->is_logged_in() && $this->userinfo['uacc_group_fk'] == 3) {
            $this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
            $this->data = $this->include_files();
            $this->load->view('admin/visitor_adds', $this->data);
        } else {
            redirect('admin');
        }
    }

    public function file_check($str) {
        $allowed_mime_type_arr = array('image/gif', 'image/jpeg', 'image/pjpeg', 'image/png', 'image/x-png');
        $mime = get_mime_by_extension($_FILES['image']['name']);
        if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
            if (in_array($mime, $allowed_mime_type_arr)) {
                return true;
            } else {
                $this->form_validation->set_message('file_check', 'Please select only gif/jpg/png file.');
                return false;
            }
        } else {
            $this->form_validation->set_message('file_check', 'Please choose a file to upload.');
            return false;
        }
    }

    function add_categories($category_id = null) {
        if ($this->input->post()) {
            $error = "";
            $this->load->library('form_validation');
            $this->load->helper('file');
            $this->form_validation->set_rules('name', 'Category Name', 'required');
            //$this->form_validation->set_rules('description', 'Description', 'required');
            if ($this->input->post('old_image') == "") {
                $this->form_validation->set_rules('image', '', 'callback_file_check');
            }

            if ($this->form_validation->run() == true) {
                $categorydata = $this->data['donorsdata'] = array(
                    "name" => $this->input->post('name'),
                    "description" => $this->input->post('description'));

                if (!empty($_FILES['image']['name'])) {
                    $this->load->library('upload');
                    $config['upload_path'] = 'include_files/categories';
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['overwrite'] = FALSE;
                    $config['encrypt_name'] = TRUE;
                    $config['max_filename'] = 25;
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload('image')) {
                        $error = $this->upload->display_errors();
                        $this->session->set_flashdata('message', $error);
                    } else {
                        $file_info = $this->upload->data();
                        $categorydata['image'] = $file_info['file_name'];
                    }
                }

                if ($error == "") {
                    if ($this->input->post('edit_id')) {
                        if (isset($categorydata['image'])) {
                            if (file_exists(FCPATH . 'include_files/categories/' . $this->input->post('old_image'))) {
                                unlink(FCPATH . 'include_files/categories/' . $this->input->post('old_image'));
                            }
                            $categorydata['image'] = $file_info['file_name'];
                        } else {
                            $categorydata['image'] = $this->input->post('old_image');
                        }
                        $result = $this->Common_model->select_update('categories', $categorydata, array('id' => $this->input->post('edit_id')));
                    } else {
                        $result = $this->Common_model->insert('categories', $categorydata);
                    }
                    $this->session->set_flashdata('message', "Information saved successfully");
                    redirect('auth_admin/categories');
                } else {
                    $this->session->set_flashdata('message', $error);
                }
            } else {
                $this->data['category_info'] = array(
                    'name' => $this->input->post('name'),
                    'description' => $this->input->post('description')
                );
                $this->data['message'] = (validation_errors() != "") ? validation_errors('<p class="error_msg">', '</p>') : $this->upload->display_errors();
            }
        }
        if ($category_id != "") {
            $this->data['category_info'] = (array) $this->Common_model->select_where_row('categories', array('id' => $category_id));
        }
        $this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
        $this->data = $this->include_files();
        $this->load->view('admin/add_categories', $this->data);
    }

    function add_subcategories($subcategory_id = null) {
        if ($this->input->post()) {
            $error = "";
            $this->load->library('form_validation');
            $this->load->helper('file');
            $this->form_validation->set_rules('name', 'Category Name', 'required');
            //$this->form_validation->set_rules('description', 'Description', 'required');

            if ($this->form_validation->run() == true) {
                $subcategorydata = array(
                    "name" => $this->input->post('name'),
                    "category_id" => $this->input->post('category_id'),
                    "description" => $this->input->post('description'));


                if ($this->input->post('edit_id')) {
                    $result = $this->Common_model->select_update('subcategories', $subcategorydata, array('id' => $this->input->post('edit_id')));
                } else {
                    $result = $this->Common_model->insert('subcategories', $subcategorydata);
                }
                if (!empty($result)) {
                    $this->session->set_flashdata('message', "Information saved successfully");
                    redirect('auth_admin/subcategories');
                } else {
                    $this->session->set_flashdata('message', "Something went wrong,Please try again later");
                }
            } else {
                $this->data['subcategory_info'] = array(
                    'name' => $this->input->post('name'),
                    'description' => $this->input->post('description')
                );
                $this->data['message'] = validation_errors('<p class="error_msg">', '</p>');
            }
        }
        if ($subcategory_id != "") {
            $this->data['subcategory_info'] = (array) $this->Common_model->select_where_row('subcategories', array('id' => $subcategory_id));
        }
        $this->data['categories'] = $this->Common_model->select_where('categories', array('status' => 1));
        $this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
        $this->data = $this->include_files();
        $this->load->view('admin/add_subcategories', $this->data);
    }

    function add_keyword($keyword_id = null) {
        if ($this->input->post()) {
            $error = "";
            $this->load->library('form_validation');
            $this->load->helper('file');
            $this->form_validation->set_rules('name', 'Keyword Name', 'required');
            if ($this->form_validation->run() == true) {
                $keyworddata = array(
                    "name" => $this->input->post('name'),
                    "description" => $this->input->post('description'));

                if ($this->input->post('edit_id')) {
                    $result = $this->Common_model->select_update('keywords', $keyworddata, array('id' => $this->input->post('edit_id')));
                } else {
                    $result = $this->Common_model->insert('keywords', $keyworddata);
                }
                $this->session->set_flashdata('message', "Information saved successfully");
                redirect('auth_admin/keywords');
            } else {
                $this->data['keyword_info'] = array(
                    'name' => $this->input->post('name'),
                    'description' => $this->input->post('description')
                );
                $this->data['message'] = (validation_errors() != "") ? validation_errors('<p class="error_msg">', '</p>') : $this->upload->display_errors();
            }
        }
        if ($keyword_id != "") {
            $this->data['keyword_info'] = (array) $this->Common_model->select_where_row('keywords', array('id' => $keyword_id));
        }
        $this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
        $this->data = $this->include_files();
        $this->load->view('admin/add_keyword', $this->data);
    }

    function keywords() {
        if ($this->flexi_auth->is_logged_in() && $this->userinfo['uacc_group_fk'] == 3) {
            $this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
            $this->data = $this->include_files();
            $this->load->view('admin/keywords', $this->data);
        } else {
            redirect('admin');
        }
    }

    function logout() {
        $this->Common_model->select_update('user_accounts', array('is_login' => 0), array('uacc_id' => $this->user_id));
        $this->flexi_auth->logout(TRUE);
        $this->session->set_flashdata('message', $this->flexi_auth->get_messages());
        redirect('admin');
    }

    function subcategories() {
        if ($this->flexi_auth->is_logged_in() && $this->userinfo['uacc_group_fk'] == 3) {
            $this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
            $this->data = $this->include_files();
            $this->load->view('admin/subcategories', $this->data);
        }
    }

    function get_user_account() {
        $data = $this->Admin_model->get_user_account();
        die($data);
    }

    function get_userearnings() {
        $userinfo = $this->Common_model->select_where_row('user_accounts', array('uacc_id' => $this->input->post('user_id')));
        die(json_encode($userinfo));
    }

    function get_business() {
        $data = $this->Admin_model->get_business();
        die($data);
    }

    function get_visitors() {
        $data = $this->Admin_model->get_visitors();
        die($data);
    }

    function get_categories() {
        $data = $this->Admin_model->get_categories();
        die($data);
    }

    function get_keywords() {
        $data = $this->Admin_model->get_keywords();
        die($data);
    }

    function get_subcategories() {
        $data = $this->Admin_model->get_subcategories();
        die($data);
    }

    function get_payments($user_id) {
        $data = $this->Admin_model->get_payments($user_id);
        die($data);
    }

    function record_status() {
        $table_name = $this->input->post('table_name');
        $table_coloum_name = $this->input->post('table_coloum');
        $table_id = $this->input->post('id');
        $recordinfo = $this->Common_model->select_where_row($table_name, array($table_coloum_name => $table_id));
        if ($recordinfo->status == 1) {
            $status = 0;
        } else {
            $status = 1;
        }
        $result = $this->Common_model->select_update($table_name, array('status' => $status), array($table_coloum_name => $table_id));
        echo json_encode($result);
        die();
    }

    function susped_user() {
        $recordinfo = $this->Common_model->select_where_row('user_accounts', array('uacc_id' => $this->input->post('user_id')));
        if ($recordinfo->uacc_suspend == 1) {
            $status = 0;
        } else {
            $status = 1;
        }
        $result = $this->Common_model->select_update('user_accounts', array('uacc_suspend' => $status), array('uacc_id' => $this->input->post('user_id')));
        echo json_encode($result);
        die();
    }

    function get_item_info() {
        $table_name = $this->input->post('table_name');
        $table_coloum_name = $this->input->post('table_coloum');
        $table_id = $this->input->post('id');
        $result = $this->Common_model->select_where_row($table_name, array($table_coloum_name => $table_id));
        echo json_encode($result);
        die();
    }

    function business_status() {
        $recordinfo = $this->Common_model->select_where_row('businesses', array('id' => $this->input->post('id')));
        if ($recordinfo->is_approved == 1) {
            $status = 0;
        } else {
            $status = 1;
        }
        if ($recordinfo->user_id != "") {
            $getuserbalance = $this->Common_model->select_where_row('user_accounts', array('uacc_id' => $recordinfo->user_id));
            $user_earnings = $getuserbalance->earnings + $recordinfo->earnings;
            $this->Common_model->select_update('user_accounts', array('earnings' => $user_earnings), array('uacc_id' => $recordinfo->user_id));
        }
        $result = $this->Common_model->select_update('businesses', array('is_approved' => $status), array('id' => $this->input->post('id')));
        die($result);
    }

    function reject_status() {
        $status = 2;
        $result = $this->Common_model->select_update('businesses', array('is_approved' => $status), array('id' => $this->input->post('id')));
        die($result);
    }

    function delete_record() {
        $table_name = $this->input->post('table_name');
        $table_coloum_name = $this->input->post('table_coloum');
        $table_id = $this->input->post('id');
        $table_name = $this->input->post('table_name');
        if ($this->input->post('image_folder')) {
            $recordinfo = $this->Common_model->select_where_row($table_name, array($table_coloum_name => $table_id));
            if ($recordinfo->image != null && file_exists(FCPATH . 'includes/' . $this->input->post('image_folder') . '/' . $recordinfo->image)) {
                unlink(FCPATH . 'includes/' . $this->input->post('image_folder') . '/' . $recordinfo->image);
            }
        }
        $result = $this->Common_model->delete_where($table_name, array($table_coloum_name => $table_id));
        die($result);
    }

    function add_payment() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('payment_date', 'Payment Date', 'required');
        $this->form_validation->set_rules('amount', 'Amount', 'required');
        $this->form_validation->set_rules('payment_mode', 'Payment Mode', 'required');

        if ($this->form_validation->run() == true) {
            $payment_data = array(
                "user_id" => $this->input->post('reseller_id'),
                "earnings" => $this->input->post('total_earnings'),
                "date" => $this->input->post('payment_date'),
                "payment_method" => $this->input->post('payment_mode'),
                "amount" => $this->input->post('amount'),
                "netamount" => $this->input->post('final_amount'),
                "tax" => $this->input->post('tax_method'),
                "description" => $this->input->post('payment_description'));
            if ($this->input->post('transaction_id')) {
                $payment_data['transaction_id'] = $this->input->post('transaction_id');
            }
            if ($this->input->post('bank_transaction_id')) {
                $payment_data['bank_transaction_id'] = $this->input->post('bank_transaction_id');
            }
            if ($this->input->post('chequeno')) {
                $payment_data['chequeno'] = $this->input->post('chequeno');
            }
            $userbalance = $this->Common_model->select_where_row('user_accounts', array('uacc_id' => $this->input->post('reseller_id')));
            if ($this->input->post('edit_id')) {
                $get_payment = $this->Common_model->select_where_row('reseller_payments', array('id' => $this->input->post('edit_id')));
                if ($get_payment->netamount < $this->input->post('final_amount')) {
                    $final_balances = $get_payment->netamount - $this->input->post('final_amount');
                    $plus_amount = $userbalance->earnings + $final_balances;
                    $updateuser = $this->Common_model->select_update('user_accounts', array('earnings' => $plus_amount), array('uacc_id' => $this->input->post('reseller_id')));
                } else if ($get_payment->netamount > $this->input->post('final_amount')) {
                    $final_balances = $this->input->post('final_amount') - $get_payment->netamount;
                    $plus_amount = $userbalance->earnings - $final_balances;
                    if ($userbalance->earnings <= $plus_amount) {
                        $updateuser = $this->Common_model->select_update('user_accounts', array('earnings' => $plus_amount), array('uacc_id' => $this->input->post('reseller_id')));
                    }
                } else {
                    $updateuser = true;
                }
                $result = $this->Common_model->select_update('reseller_payments', $payment_data, array('id' => $this->input->post('edit_id')));
            } else {
                $result = $this->Common_model->insert('reseller_payments', $payment_data);
                $final_earnings = $userbalance->earnings - $this->input->post('final_amount');
                $updateuser = $this->Common_model->select_update('user_accounts', array('earnings' => $final_earnings), array('uacc_id' => $this->input->post('reseller_id')));
                $subject = 'realgujarat - Payment Approval';
                $message = "Hello " . $userbalance->uacc_username . "\n";
                $message .= "Your payment of Rs. " . $payment_data['netamount'] . " has been prosesed successfully   \n";
                $message .= "Thank you";
                $headers = 'From: ' . From_Email . '' . "\r\n" .
                        'Reply-To: ' . Reply_Email . '' . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();
                mail($userbalance->uacc_email, $subject, $message, $headers);
            }
            die(json_encode(($result && $updateuser) ? true : false));
        } else {
            die(json_encode(false));
        }
    }

    function add_business($edit_business_id = null) {
        if ($this->input->post()) {

            // Business Earning For Reseller
            $company_name_verified = $this->input->post('company_name_verified');
            $email_verified = $this->input->post('email_verified');
            $category_subcategory_verifed = $this->input->post('category_subcategory_verifed');
            $company_address_verifed = $this->input->post('company_address_verifed');
            $landline_verified = $this->input->post('landline_verified');
            $mobileno_verified = $this->input->post('mobileno_verified');
            $aboutbusiness_verified = $this->input->post('aboutbusiness_verified');
            $establishmentyear_verified = $this->input->post('establishmentyear_verified');
            $services_verified = $this->input->post('services_verified');
            $otherlocation_verified = $this->input->post('otherlocation_verified');
            $hours_verified = $this->input->post('hours_verified');
            $photologo_verified = $this->input->post('photologo_verified');
            $business_earnings = array();
            if ($company_name_verified == 1 && $category_subcategory_verifed == 1 && $company_address_verifed == 1 && $landline_verified == 1 && $mobileno_verified == 1) {
                $extra_incentive = 5;
                $business_earnings['extra_incentive'] = 1;
            } else {
                $extra_incentive = 0;
                $business_earnings['extra_incentive'] = 0;
            }

            $business_income = ($company_name_verified == 1) ? 1 : 0;
            $business_income += ($email_verified == 1) ? 1 : 0;
            $business_income += ($category_subcategory_verifed == 1) ? 1 : 0;
            $business_income += ($company_address_verifed == 1) ? 1 : 0;
            $business_income += ($landline_verified == 1) ? 1 : 0;
            $business_income += ($mobileno_verified == 1) ? 1 : 0;
            $business_income += ($establishmentyear_verified == 1) ? 1 : 0;
            $business_income += ($aboutbusiness_verified == 1) ? 3 : 0;
            $business_income += ($services_verified == 1) ? 1 : 0;
            $business_income += ($otherlocation_verified == 1) ? 1 : 0;
            $business_income += ($hours_verified == 1) ? 2 : 0;
            $business_income += ($photologo_verified == 1) ? 7 : 0;


            $total_income = $extra_incentive + $business_income;

            $from_timings_1 = implode(',', $this->input->post('from_timings'));
            $to_timings_1 = implode(',', $this->input->post('to_timings'));
            if ($this->input->post('dual_timings') == 1) {
                $from_timings_2 = implode(',', $this->input->post('from_timings_1'));
                $to_timings_2 = implode(',', $this->input->post('to_timings_1'));
            }
            $this->load->library('upload');
            $error = "";
            if (!empty($_FILES['avatar-1']['name'])) {
                $config['upload_path'] = 'include_files/logo';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['overwrite'] = FALSE;
                $config['encrypt_name'] = TRUE;
                $config['max_filename'] = 25;
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('avatar-1')) {
                    $error = $this->upload->display_errors();
                } else {
                    $file_info = $this->upload->data();
                    $company_logo = $file_info['file_name'];
                }
            }
            if (!empty($_FILES['company_banner']['name'])) {
                $config['upload_path'] = 'include_files/banners';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['overwrite'] = FALSE;
                $config['encrypt_name'] = TRUE;
                $config['max_filename'] = 25;
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('company_banner')) {
                    $error = $this->upload->display_errors();
                } else {
                    $file_info = $this->upload->data();
                    $banner = $file_info['file_name'];
                }
            }
            if ($error == "") {
                $business_data = array(
                    'name' => $this->input->post('company_name'),
                    'category_id' => $this->input->post('category'),
                    'subcategory_id' => $this->input->post('subcategory'),
                    'address' => $this->input->post('company_address'),
                    'pincode' => $this->input->post('pincode'),
                    'state' => $this->input->post('state'),
                    'city' => $this->input->post('city'),
                    'email' => $this->input->post('email'),
                    'business_description' => $this->input->post('about_company'),
                    'services' => implode(',', $this->input->post('services')),
                    'payment_methods' => implode(',', $this->input->post('payment_mode')),
                    'min_price_range ' => $this->input->post('min_rate'),
                    'max_price_range' => $this->input->post('max_rate'),
                    'from_timings_1' => $from_timings_1,
                    'to_timings_1' => $to_timings_1,
                    'from_timings_2' => $from_timings_2,
                    'to_timings_2' => $to_timings_2,
                    'year_establishment' => $this->input->post('year_establishment')
                );

                if ($this->input->post('website')) {
                    $business_data['website'] = $this->input->post('website');
                }
                if ($this->input->post('contact_person_name')) {
                    $business_data['contact_person_name'] = $this->input->post('contact_person_name');
                }

                if ($this->input->post('other_locations')) {
                    $business_data['other_locations'] = implode(',', $this->input->post('other_locations'));
                }
                if ($this->input->post('landline_no') && $this->input->post('landline_code')) {
                    $business_data['landline_no'] = $this->input->post('landline_no');
                    $business_data['landline_code'] = $this->input->post('landline_code');
                }
                if ($this->input->post('mobile_no') && $this->input->post('mobile_code')) {
                    $business_data['mobile_no'] = $this->input->post('mobile_no');
                    $business_data['mobile_code'] = $this->input->post('mobile_code');
                }
                if ($this->input->post('other_no') && $this->input->post('other_code')) {
                    $business_data['other_no'] = $this->input->post('other_no');
                    $business_data['other_code'] = $this->input->post('other_code');
                }
                if ($this->input->post('keywords')) {
                    $business_data['keywords'] = strtolower(implode(',', $this->input->post('keywords')));
                }
                if (isset($banner) && $banner != "") {
                    $business_data['banner'] = $banner;
                    if ($edit_business_id != null) {
                        if (file_exists(FCPATH . 'include_files/banners/' . $this->input->post('old_banner'))) {
                            unlink(FCPATH . 'include_files/banners/' . $this->input->post('old_banner'));
                        }
                    }
                }
                if (isset($company_logo) && $company_logo != "") {
                    $business_data['logo'] = $company_logo;
                    if ($edit_business_id != null) {
                        if (file_exists(FCPATH . 'include_files/logo/' . $this->input->post('old_logo'))) {
                            unlink(FCPATH . 'include_files/logo/' . $this->input->post('old_logo'));
                        }
                    }
                }
                if ($edit_business_id != null) {
                    $old_images_post = $this->input->post('old_company_images');
                    $old_images_table = $this->db->query("select image from company_images where business_id = '" . $edit_business_id . "'")->result_array();
                    $final_images = array_diff(array_column($old_images_table, 'image'), $old_images_post);
                    foreach ($final_images as $row_image) {
                        if (file_exists(FCPATH . 'include_files/business_images/' . $row_image)) {
                            unlink(FCPATH . 'include_files/business_images/' . $row_image);
                            $this->Common_model->delete_where('company_images', array('business_id' => $edit_business_id, 'image' => $row_image));
                        }
                    }

                    // Detailed Entry Infomration                    
                    $business_earnings['company_name'] = ($company_name_verified == 1) ? 1 : 0;
                    $business_earnings['email'] = ($email_verified == 1) ? 1 : 0;
                    $business_earnings['category_subcategory'] = ($category_subcategory_verifed == 1) ? 1 : 0;
                    $business_earnings['address'] = ($company_address_verifed == 1) ? 1 : 0;
                    $business_earnings['landline'] = ($landline_verified == 1) ? 1 : 0;
                    $business_earnings['mobile'] = ($mobileno_verified == 1) ? 1 : 0;
                    $business_earnings['establishment_year'] += ($establishmentyear_verified == 1) ? 1 : 0;
                    $business_earnings['aboutus'] = ($aboutbusiness_verified == 1) ? 1 : 0;
                    $business_earnings['services'] = ($services_verified == 1) ? 1 : 0;
                    $business_earnings['otherlocation'] = ($otherlocation_verified == 1) ? 1 : 0;
                    $business_earnings['hours'] = ($hours_verified == 1) ? 1 : 0;
                    $business_earnings['photos'] = ($photologo_verified == 1) ? 1 : 0;
                    $business_earnings_data = $this->Common_model->select_where_row('business_earnings', array('business_id' => $edit_business_id));
                    $business_earnings['business_id'] = $edit_business_id;
                    if (empty($business_earnings_data)) {
                        $business_earnings['transaction_id'] = mt_rand();             
                        $this->Common_model->inserted_id('business_earnings', $business_earnings);
                    } else {
                        $this->Common_model->select_update('business_earnings', $business_earnings, array('business_id' => $edit_business_id));
                    }
                    $this->Common_model->select_update('businesses', $business_data, array('id' => $edit_business_id));
                    $business_id = $edit_business_id;
                } else {
                    $business_data['is_approved'] = 1;
                    $business_data['user_id'] = $this->user_id;
                    $business_id = $this->Common_model->inserted_id('businesses', $business_data);
                }
                if ($business_id) {
                    $more_mobile_no_codes = $this->input->post('more_mobile_code');
                    $more_mobile_nos = $this->input->post('more_mobile_no');
                    $more_landline_no_codes = $this->input->post('more_landline_code');
                    $more_landline_nos = $this->input->post('more_landline_no');
                    $this->Common_model->delete_where('business_contacts', array('business_id' => $business_id));
                    if (count($more_mobile_nos) > count($more_landline_nos)) {
                        $more_contacts = $more_mobile_nos;
                    } else {
                        $more_contacts = $more_landline_nos;
                    }
                    foreach ($more_contacts as $key => $more_contact) {
                        $business_contacts_data = array(
                            'business_id' => $business_id
                        );
                        $add_record = '';
                        if ($more_landline_no_codes[$key] != "" && $more_landline_nos[$key]) {
                            $add_record = 1;
                            $business_contacts_data['landline_code_number'] = $more_landline_no_codes[$key];
                            $business_contacts_data['landline_number'] = $more_landline_nos[$key];
                        }
                        if ($more_mobile_no_codes[$key] != "" && $more_mobile_nos[$key] != "") {
                            $add_record = 1;
                            $business_contacts_data['mobile_no_code'] = $more_mobile_no_codes[$key];
                            $business_contacts_data['mobile_number'] = $more_mobile_nos[$key];
                        }
                        if ($add_record == 1) {
                            $this->Common_model->insert('business_contacts', $business_contacts_data);
                        }
                    }
                }
                if (!empty($_FILES['userFiles']['name'])) {
                    $filesCount = count($_FILES['userFiles']['name']);
                    for ($i = 0; $i < $filesCount; $i++) {
                        $_FILES['userFile']['name'] = $_FILES['userFiles']['name'][$i];
                        $_FILES['userFile']['type'] = $_FILES['userFiles']['type'][$i];
                        $_FILES['userFile']['tmp_name'] = $_FILES['userFiles']['tmp_name'][$i];
                        $_FILES['userFile']['error'] = $_FILES['userFiles']['error'][$i];
                        $_FILES['userFile']['size'] = $_FILES['userFiles']['size'][$i];

                        $uploadPath = 'include_files/business_images';
                        $config['upload_path'] = $uploadPath;
                        $config['allowed_types'] = 'gif|jpg|png';
                        $config['encrypt_name'] = TRUE;
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        if ($this->upload->do_upload('userFile')) {
                            $fileData = $this->upload->data();
                            $uploadData[$i]['business_id'] = $business_id;
                            $uploadData[$i]['image'] = $fileData['file_name'];
                        }
                    }
                    if ($edit_business_id != null || $business_id) {
                        if (!empty($uploadData)) {
                            $insert = $this->db->insert_batch('company_images', $uploadData);
                        }
                        $statusMsg = ($business_id || $edit_business_id || $insert) ? 'Your ad has been saved succesfully !' : 'Some problem occurred, please try again.';
                        $this->session->set_flashdata('message', $statusMsg);
                    } else {
                        $this->session->set_flashdata('message', "Something went wrong!.Please try again later");
                        $this->data['businessinfo'] = $business_data;
                    }
                }
            } else {
                $this->session->set_flashdata('message', $error);
                $this->data['businessinfo'] = $business_data;
            }
        }
        if ($edit_business_id != "") {
            $this->data['businessinfo'] = (array) $this->Common_model->get_business($edit_business_id);
            $this->data['contact_info'] = $this->Common_model->select_where('business_contacts', array('business_id' => $edit_business_id));
            $this->data['earninghistory'] = $this->Common_model->select_where_row('business_earnings', array('business_id' => $edit_business_id));
        }
        $this->data['categories'] = $this->Common_model->select_where('categories', array('status' => 1));
        $this->data['states'] = $this->Common_model->select_where('states', array('id' => 12));
        $this->data['keywordinfo'] = $this->Common_model->select_where('keywords', array('status' => 1));
        $this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
        $this->data = $this->include_files();
        $this->load->view('admin/add_business', $this->data);
    }

    function approve_user() {
        $user_id = $this->input->post('user_id');
        $userinfo = $this->Common_model->select_where_row('user_accounts', array('uacc_id' => $this->input->post('user_id')));
        $approve_user = $this->Common_model->select_update('user_accounts', array('uacc_admin_approved' => 1), array('uacc_id' => $user_id));
        if ($userinfo->reffered_by != null) {
            $refuser = $this->Common_model->select_where_row('user_accounts', array('uacc_id' => $userinfo->reffered_by));
            $final_balance = $refuser->earnings + 2500;
            $add_commission = $this->Common_model->select_update('user_accounts', array('earnings' => $final_balance), array('uacc_id' => $userinfo->reffered_by));
        }
        if ($approve_user || ($approve_user && $add_commission)) {
            die(json_encode(true));
        } else {
            die(json_encode(false));
        }
    }

    function suspend_user() {
        $user_id = $this->input->post('user_id');
        $userinfo = $this->Common_model->select_where_row('user_accounts', array('uacc_id' => $this->input->post('user_id')));
        if ($userinfo->uacc_suspend == 1) {
            $suspend_status = 0;
        } else {
            $suspend_status = 1;
        }
        $suspend_user = $this->Common_model->select_update('user_accounts', array('uacc_suspend' => $suspend_status), array('uacc_id' => $user_id));
        if ($suspend_user) {
            die(json_encode(true));
        } else {
            die(json_encode(false));
        }
    }

    function user_session() {
        $user_id = $this->input->post('id');
        $this->Common_model->select_update('user_accounts', array('is_login' => 0), array('uacc_id' => $user_id));
        echo $this->db->last_query();
        die(json_encode(true));
    }

    function delete_business() {  
        $id = $this->input->post('id');
        $this->Common_model->delete_where('businesses', array('id' => $id));
        die(json_encode(true));
    }


}
