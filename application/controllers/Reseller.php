<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reseller extends CI_Controller {

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
        $this->data = null;
        if ($this->flexi_auth->is_logged_in()) {
            $this->data['userinfo'] = $this->userinfo = $this->flexi_auth->get_user_by_identity_row_array();
            $this->user_id = $this->data['userinfo']['uacc_id'];
        }
    }

    function login_via_ajax() {
        if ($this->input->is_ajax_request()) {
            $this->load->model('demo_auth_model');
            $this->demo_auth_model->login_via_ajax();
            die(json_encode(array('message' => $this->flexi_auth->get_messages(), 'login_status' => $this->flexi_auth->is_logged_in())));
        }
    }

    function index() {
        $this->home();
    }

    function logout() {
        $this->Common_model->select_update('user_accounts', array('is_login' => 0), array('uacc_id' => $this->user_id));
        $this->flexi_auth->logout(TRUE);
        $this->session->set_flashdata('message', $this->flexi_auth->get_messages());
        redirect('reseller/home');
    }


    function get_client_ip() {
        //$c_info = new Users_info;
        //echo $ttt->c_ip();
        // echo $ttt->c_OS();
        // echo $ttt->c_Browser();
        //$c_info = new Users_info;
        echo $this->c_ip();
        die();
    }

    function include_files() {
        $this->data['header'] = $this->load->view('resseller/header', $this->data, TRUE);
        $this->data['common'] = $this->load->view('resseller/common', $this->data, TRUE);
        $this->data['footer'] = $this->load->view('resseller/footer', $this->data, TRUE);
        return $this->data;
    }

    function signup() {
        if ($this->input->post()) {
            $this->load->model('demo_auth_model');
            $result = $this->demo_auth_model->register_account();
        }
        $this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
        $this->data = $this->include_files();
        $this->load->view('resseller/signup', $this->data);
    }

    function home() {
        $this->data = $this->include_files();
        $this->load->view('resseller/home', $this->data);
    }

    function benefits() {
        $this->data = $this->include_files();
        $this->load->view('resseller/benefits', $this->data);
    }

    function earn() {
        $this->data = $this->include_files();
        $this->load->view('resseller/earn', $this->data);
    }

    function register() {
        $this->data = $this->include_files();
        $this->load->view('resseller/register', $this->data);
    }

    function faqs() {
        $this->data = $this->include_files();
        $this->load->view('resseller/faqs', $this->data);
    }

    function contact() {
        $this->data = $this->include_files();
        $this->load->view('resseller/contact', $this->data);
    }

    function update_profile() {
        $profiledata = array(
            'upro_first_name' => $this->input->post('first_name'),
            'upro_last_name' => $this->input->post('last_name'),
            'birth_date' => $this->input->post('birth_date'),
            'address' => $this->input->post('address'),
            'gender' => $this->input->post('gender'),
            'pincode' => $this->input->post('pincode'),
            'state' => $this->input->post('state'),
            'city' => $this->input->post('city')
        );
        if ($this->input->post('landline_no')) {
            $profiledata['landline_no'] = $this->input->post('landline_no');
        }
        if ($this->input->post('mobile_no')) {
            $profiledata['mobile_no'] = $this->input->post('mobile_no');
        }
        if ($this->input->post('other_no')) {
            $profiledata['other_no'] = $this->input->post('other_no');
        }
        $result = $this->Common_model->select_update('demo_user_profiles', $profiledata, array('upro_uacc_fk' => $this->user_id));
        if ($this->input->post('change_pwd') == 1) {
            $this->load->model('demo_auth_model');
            $change_password = $this->demo_auth_model->change_password();
            $this->session->set_flashdata('message', $this->data['message']);
            if ($change_password) {
                $this->session->set_flashdata('alert_class', 'alert-success');
            } else {
                $this->session->set_flashdata('alert_class', 'alert-danger');
            }
        } else if ($result) {
            $this->session->set_flashdata('message', 'Profile updated successfully');
            $this->session->set_flashdata('alert_class', 'alert-success');
        }
        $this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
        redirect('reseller/account');
    }

    function account() {
        if ($this->flexi_auth->is_logged_in() && $this->userinfo['uacc_group_fk'] == 2) {
            $this->data['states'] = $this->Common_model->select_all('states');
            if ($this->userinfo['city'] != null) {
                $this->data['cityname'] = $this->Common_model->select_where_row('cities', array('id' => $this->userinfo['city']));
            }
            $this->data['business_counts'] = $this->Common_model->business_counts($this->user_id);
            $this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
            $this->data = $this->include_files();
            $this->data['sidebar'] = $this->load->view('resseller/sidebar', $this->data, TRUE);
            $this->load->view('resseller/profile', $this->data);
        } else {
            redirect('reseller/home');
        }
    }

    function businesses() {
        if ($this->flexi_auth->is_logged_in() && $this->userinfo['uacc_group_fk'] == 2) {
            $this->load->library('pagination');
            $config = array();
            $config["base_url"] = base_url() . "reseller/businesses";
            $config["per_page"] = 5;
            $config['use_page_numbers'] = FALSE;

            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['cur_tag_open'] = '&nbsp;<li class="active"><a>';
            $config['cur_tag_close'] = '</a></li>';
            $config['first_link'] = 'First';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['last_link'] = 'Last';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['next_link'] = 'Next';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['prev_link'] = 'Previous';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';

            $total_row = $this->Common_model->businesses('', '', $this->user_id);
            $config["total_rows"] = $total_row['counts'];
            $config['num_links'] = $total_row['counts'];
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $this->data["results"] = $this->Common_model->businesses($config["per_page"], $page, $this->user_id);
 
            $this->pagination->initialize($config);
            $str_links = $this->pagination->create_links();
            $this->data["links"] = explode('&nbsp;', $str_links);

            $this->data['business_counts'] = $this->Common_model->business_counts($this->user_id);
            $this->data = $this->include_files();
            $this->data['sidebar'] = $this->load->view('resseller/sidebar', $this->data, TRUE);
            $this->load->view('resseller/businesses', $this->data);
        } else {
            redirect('reseller/home');
        }
    }

    public function payments() {
        if ($this->flexi_auth->is_logged_in() && $this->userinfo['uacc_group_fk'] == 2) {
            $this->load->library('pagination');
            $config = array();
            $config["base_url"] = base_url() . "reseller/payments";
            $config["per_page"] = 5;
            $config['use_page_numbers'] = FALSE;
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['cur_tag_open'] = '&nbsp;<li class="active"><a>';
            $config['cur_tag_close'] = '</a></li>';
            $config['first_link'] = 'First';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['last_link'] = 'Last';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['next_link'] = 'Next';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['prev_link'] = 'Previous';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';

            $total_row = $this->Common_model->payments('', '', $this->user_id);
            $config["total_rows"] = $total_row['counts'];
            $config['num_links'] = $total_row['counts'];
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $this->data["results"] = $this->Common_model->payments($config["per_page"], $page, $this->user_id);

            $this->pagination->initialize($config);
            $str_links = $this->pagination->create_links();
            $this->data["links"] = explode('&nbsp;', $str_links);

            $this->data['business_counts'] = $this->Common_model->business_counts($this->user_id);
            $this->data = $this->include_files();
            $this->data['sidebar'] = $this->load->view('resseller/sidebar', $this->data, TRUE);
            $this->load->view('resseller/payments', $this->data);
        } else {
            redirect('reseller/home');
        }
    }

    function add_business($edit_business_id = null) {
        if ($this->flexi_auth->is_logged_in() && $this->userinfo['uacc_group_fk'] == 2) {
            if ($this->input->post()) {
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
                        'user_id' => $this->user_id,
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
                        $this->Common_model->select_update('businesses', $business_data, array('id' => $edit_business_id));
                        $business_id = $edit_business_id;
                    } else {
                        $business_data['earnings'] = $this->input->post('total_earnings');
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
            }
            $this->data['categories'] = $this->Common_model->select_where('categories', array('status' => 1));
            $this->data['states'] = $this->Common_model->select_where('states', array('id' => 12));
            $this->data['business_counts'] = $this->Common_model->business_counts($this->user_id);
            $this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
            $this->data = $this->include_files();
            $this->data['sidebar'] = $this->load->view('resseller/sidebar', $this->data, TRUE);
            $this->load->view('resseller/add_business', $this->data);
        } else {
            redirect('reseller/home');
        }
    }

    function subcategories() {
        $subcategories = $this->Common_model->select_where('subcategories', array('category_id' => $this->input->post('category_id')));
        die(json_encode($subcategories));
    }

    function cities() {
        $cities = $this->Common_model->select_where('cities', array('state_id' => $this->input->post('state_id')));
        die(json_encode($cities));
    }

    function check_duplicates() {
        $landline_no = $this->input->post('landline_no');
        $mobile_no = $this->input->post('mobile_no');
        $other_no = $this->input->post('other_no');
        $results = $this->Common_model->get_duplicate_business($landline_no, $mobile_no, $other_no);
        die(json_encode(count($results)));
    }

    function company_images() {
        $images = $this->Common_model->get_company_images($this->input->post('business_id'));
        $company_images = array_column($images, 'image');
        $string = "";
        foreach ($company_images as $key => $image) {
            if ($key == 0) {
                $string .= base_url() . 'include_files/business_images/' . $image;
            } else {
                // $string .= ',"' . base_url().'include_files/business_images/'.$image . ',"';
            }
        }
        die(json_encode($string));
    }

    function forgotten_password() {
        if ($this->input->post()) {
            $this->load->model('demo_auth_model');
            $this->demo_auth_model->forgotten_password();
        }
        $this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
        $this->data = $this->include_files();
        $this->load->view('resseller/forgotten_password', $this->data);
    }

    function manual_reset_forgotten_password($user_id = FALSE, $token = FALSE) {
        if ($this->input->post()) {
            $this->load->model('demo_auth_model');
            $this->demo_auth_model->manual_reset_forgotten_password($user_id, $token);
        }
        $this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
        $this->data = $this->include_files();
        $this->load->view('resseller/reset_password', $this->data);
    }

}
