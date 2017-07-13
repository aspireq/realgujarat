<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auth extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->database();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->auth = new stdClass;
        $this->load->library('flexi_auth');

        if ($this->flexi_auth->is_logged_in_via_password() && uri_string() != 'auth/logout') {
            if ($this->session->flashdata('message')) {
                $this->session->keep_flashdata('message');
            }
        }
        $this->data = null;
        if ($this->flexi_auth->is_logged_in()) {
            $this->data['userinfo'] = $this->userinfo = $this->flexi_auth->get_user_by_identity_row_array();
            $this->user_id = $this->data['userinfo']['uacc_id'];
        }
    }

    function index() {
        $this->home();
    }

    public function include_files() {
        $this->data['header'] = $this->load->view('user/header', $this->data, TRUE);
        $this->data['footer'] = $this->load->view('user/footer', $this->data, TRUE);
        return $this->data;
    }

    public function home() {
        $this->data['categories'] = $this->Common_model->select_where('categories', array('status' => 1));
        $this->data['cities'] = $this->Common_model->select_where('cities', array('state_id' => 12));
        $this->data['top_business'] = $this->Common_model->get_top_business();
        $this->data['business_cities'] = $this->Common_model->get_business_cities();        
        $this->data = $this->include_files();
        $this->load->view('user/home', $this->data);
    }

    public function get_category() {
        $category_id = $this->input->post('category');
        die($category_id);
    }

    public function businesses() {
        if ($this->input->post('category_id_row')) {
            $this->session->unset_userdata('session_category');
            $this->session->set_userdata('session_category', $this->input->post('category_id_row'));
        }
        $category_id = $this->session->userdata('session_category');

        $search_key = ($this->input->post('search_key') != "") ? $this->input->post('search_key') : '';
        $search_category_id = ($this->input->post('category') != "") ? $this->input->post('category') : '';
        $search_city = ($this->input->post('city') != "") ? $this->input->post('city') : '';

        if ($search_key != "" || $search_category_id != "" || $search_city != "") {
            $this->session->unset_userdata('search_data');
            $search_data = array(
                'key' => $search_key,
                'category' => $search_category_id,
                'city' => $search_city
            );
            $this->session->set_userdata('search_data', $search_data);
            $this->session->unset_userdata('session_category');
        }
        $this->load->library('pagination');
        $config = array();
        $config["base_url"] = base_url() . "auth/businesses/";
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

        $from_date = "";
        $to_date = "";
        if ($this->input->post()) {
            $this->data['from_date'] = $from_date = date('Y-m-d', strtotime($this->input->post('from_date')));
            $this->data['to_date'] = $to_date = date('Y-m-d', strtotime($this->input->post('to_date')));
        }
        $total_row = $this->Common_model->business_data('', '', $category_id, $search_key, $search_category_id, $search_city);
        $config["total_rows"] = $total_row['counts'];
        $config['num_links'] = $total_row['counts'];
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $this->data["results"] = $this->Common_model->business_data($config["per_page"], $page, $category_id, $search_key, $search_category_id, $search_city);
        $this->pagination->initialize($config);
        $str_links = $this->pagination->create_links();
        $this->data["links"] = explode('&nbsp;', $str_links);

        $this->data['categories'] = $this->Common_model->select_where('categories', array('status' => 1));
        $this->data['cities'] = $this->Common_model->select_where('cities', array('state_id' => 12));
        $this->data = $this->include_files();
        $this->load->view('user/businesses', $this->data);
    }

    public function businessinfo() {

        if ($this->input->post('business_id_row')) {
            $this->session->unset_userdata('session_business');
            $this->session->set_userdata('session_business', $this->input->post('business_id_row'));
        }
        $business_id = $this->session->userdata('session_business');

        $this->data['business'] = $this->Common_model->get_business($business_id);
        $this->load->library('pagination');
        $config = array();
        $config["base_url"] = base_url() . "auth/businessinfo/" . $business_id;
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

        $total_row = $this->Common_model->review_data('', '', $business_id);
        $config["total_rows"] = $total_row['counts'];
        $config['num_links'] = $total_row['counts'];
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $this->data["results"] = $this->Common_model->review_data($config["per_page"], $page, $business_id);
        //  $reviews = (array) $this->Common_model->select_where('reviews', array('business_id' => $business_id, 'status' => 1));
        $reviews = $this->db->query('select rating from reviews where business_id = ' . $business_id . ' AND status = 1')->result_array();

        $total_ratings = array_sum(array_column($reviews, 'rating'));
        // echo $total_ratings;die();
        foreach ($reviews as $review) {
            if ($review['rating'] == 1.0) {
                $star_1 += $review['rating'];
            } else if ($review['rating'] == 2.0) {
                $star_2 += $review['rating'];
            } else if ($review['rating'] == 3.0) {
                $star_3 += $review['rating'];
            } else if ($review['rating'] == 4.0) {
                $star_4 += $review['rating'];
            } else if ($review['rating'] == 5.0) {
                $star_5 += $review['rating'];
            }
        }
        $string = ($star_1 + $star_2 * 2 + $star_3 * 3 + $star_4 * 4 + $star_5 * 5) / $total_ratings;
        $this->data["total_ratings"] = round(mb_substr($string, 0, -1));

        $this->pagination->initialize($config);
        $str_links = $this->pagination->create_links();
        $this->data["links"] = explode('&nbsp;', $str_links);
        $this->data = $this->include_files();
        $this->load->view('user/businessinfo', $this->data);
    }

    function add_review() {
        $data = array(
            'business_id' => $this->input->post('business_id'),
            'name' => $this->input->post('name'),
            'review' => $this->input->post('review'),
            'rating' => $this->input->post('rating')
        );
        $review_added = $this->Common_model->inserted_id('reviews', $data);
        die(json_encode($review_added));
    }

    public function free_listing() {
        $confirmation_code = "";
        if ($confirmation_code == "" && $this->input->post('verification') == "verification") {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('company_name', 'Company Name', 'required');
            $this->form_validation->set_rules('mobile_no', 'Mobile No.', 'required|min_length[10]|max_length[10]');
            if ($this->form_validation->run()) {
                $confirmation_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
                $visitorinfo = array(
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'contact_no' => $this->input->post('mobile_no'),
                    'company_name' => $this->input->post('company_name'),
                    'confirmation_code' => $confirmation_code
                );
                $visitor_id = $this->Common_model->inserted_id('visitorinfo', $visitorinfo);
            } else {
                $this->data['visitorinfo'] = array(
                    'company_name' => $this->input->post('company_name'),
                    'mobile_no' => $this->input->post('mobile_no')
                );
                $this->data['message'] = validation_errors('<p class="error_msg">', '</p>');
            }
        } else if ($this->input->post('verified') == 'verified') {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('code', 'Code', 'required');
            $this->form_validation->set_rules('confirmation_code', 'Confirmation Code', 'required|matches[code]');
            $this->form_validation->set_message('matches', 'Confimation code is invalid.');
            if ($this->form_validation->run()) {
                $get_visitor = $this->Common_model->select_where_row('visitorinfo', array('confirmation_code' => $this->input->post('code')));
                $visitorinfo = array(
                    'is_verified' => 1
                );
                $visitor_id = $this->Common_model->select_update('visitorinfo', $visitorinfo, array('confirmation_code' => $this->input->post('code')));
                $this->session->set_flashdata('message', "Your mobile no. is verified !");
                $this->session->set_flashdata('is_allowed', 1);
                $this->session->set_flashdata('visitor_id', $get_visitor->id);
                redirect('business');
            } else {
                $this->data['message'] = validation_errors('<p class="error_msg">', '</p>');
                $confirmation_code = $this->input->post('code');
            }
            $this->data['confirmation_code'] = $confirmation_code;
        }
        $this->data['confirmation_code'] = $confirmation_code;
        $this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
        $this->data = $this->include_files();
        $this->load->view('user/free_listing', $this->data);
    }

    public function business() {
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
                    'banner' => $banner,
                    'logo' => $company_logo,
                    'from_timings_1' => $from_timings_1,
                    'to_timings_1' => $to_timings_1,
                    'from_timings_2' => $from_timings_2,
                    'to_timings_2' => $to_timings_2,
                    'visitor_id' => $this->input->post('visitor_id')
                );

                if ($this->input->post('website')) {
                    $business_data['website'] = $this->input->post('website');
                }
                if ($this->input->post('contact_person_name')) {
                    $business_data['contact_person_name'] = $this->input->post('contact_person_name');
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

                $business_id = $this->Common_model->inserted_id('businesses', $business_data);

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
                $this->Common_model->select_update('visitorinfo', array('ad_id' => $business_id, 'advertize_added' => 1), array('id' => $this->input->post('visitor_id')));

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
                    if (!empty($uploadData) && $business_id) {
                        if (!empty($uploadData)) {
                            $insert = $this->db->insert_batch('company_images', $uploadData);
                        }
                        $statusMsg = $business_id ? 'Your add has been submitted succesfully !' : 'Some problem occurred, please try again.';
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

        if ($this->session->flashdata('is_allowed') == 1) {
            $this->data['visitor_id'] = $this->session->flashdata('visitor_id');
            $this->data['categories'] = $this->Common_model->select_where('categories', array('status' => 1));
            $this->data['states'] = $this->Common_model->select_where('states', array('id' => 12));
            $this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
            $this->data = $this->include_files();
            $this->load->view('user/business', $this->data);
        } else {
            $this->session->set_flashdata('message', "You can not post advertizement without verification");
            redirect('free_listing');
        }
    }

    function admin() {
        if ($this->input->post()) {
            $this->load->model('demo_auth_model');
            $result = $this->demo_auth_model->login();
        }
        $this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
        $this->data['common'] = $this->load->view('admin/common', $this->data, TRUE);
        $this->load->view('admin/login', $this->data);
    }

    function activate_account($user_id, $token = FALSE) {
        $this->flexi_auth->activate_user($user_id, $token, TRUE);
        $this->session->set_flashdata('message', $this->flexi_auth->get_messages());
        redirect('auth');
    }

    function hours_of_operation() {
        $business_id = $this->input->post('id');
        $timings = $this->Common_model->select_where_row('businesses', array('id' => $business_id));
        $days = array(
            0 => 'Monday',
            1 => 'Tuesday',
            2 => 'Wednesday',
            3 => 'Thursday',
            4 => 'Friday',
            5 => 'Saturday',
            6 => 'Sunday');
        $from_timings_1 = explode(',', $timings->from_timings_1);
        $to_timings_1 = explode(',', $timings->to_timings_1);
        $from_timings_2 = explode(',', $timings->from_timings_2);
        $to_timings_2 = explode(',', $timings->to_timings_2);
        $data = '';
        foreach ($days as $key => $day) {
            if ($this->input->post('type') == "Show Less") {
                if (date('l', strtotime(date('Y-m-d'))) == $day) {
                    $data .= '<p>' . $day . '  ' . $from_timings_1[$key] . ' - ' . $to_timings_1[$key];
                    if (!empty($from_timings_2[0])) {
                        $data .= ' || ' . $from_timings_2[$key] . ' - ' . $to_timings_2[$key];
                    }
                    $data .= '</p>';
                }
            } else {
                $data .= '<p>' . $day . '  ' . $from_timings_1[$key] . ' - ' . $to_timings_1[$key];
                if (!empty($from_timings_2[0])) {
                    $data .= ' || ' . $from_timings_2[$key] . ' - ' . $to_timings_2[$key];
                }
                $data .= '</p>';
            }
        }
        die(json_encode($data));
    }

    function get_record() {
        $table_name = $this->input->post('table_name');
        $id = $this->input->post('id');
        $table_coloum = $this->input->post('table_coloum');
        $data = $this->Common_model->select_where_row($table_name, array($table_coloum => $id));
        die(json_encode($data));
    }

    function map($id = null) {
        $businessinfo = $this->Common_model->select_where_row('businesses', array('id' => $id));
        $addres = $businessinfo->address;
        $address = str_replace(" ", "+", $addres);
        $json_result = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&region=$region");
        $json = json_decode($json_result);
        $this->data['lat'] = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
        $this->data['long'] = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
        $this->data['name'] = $businessinfo->name;
        $this->data = $this->include_files();
        $this->load->view('user/map', $this->data);
    }

    function send_information() {
        $business_id = $this->input->post('business_id');
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        //$mobile = $this->input->post('mobile');

        $businessinfo = $this->Common_model->select_where_row('businesses', array('id' => $business_id));

        $mobile = ($businessinfo->mobile_code != "") ? $businessinfo->mobile_code . $businessinfo->mobile_no : $businessinfo->mobile_no;

        $subject = 'realgujarat - ' . ucfirst($businessinfo->name);
        $message = "Hello " . $name . "\n";
        $message .= "Business Info   \n";
        $message .= "Name  : " . $businessinfo->name . "\n";
        $message .= "Address : " . $businessinfo->address . "\n";
        $message .= "Contact : " . $mobile . "\n";
        $message .= "\r";
        $message .= "Services Provided : " . $businessinfo->services;

        $headers = 'From: ' . From_Email . '' . "\r\n" .
                'Reply-To: ' . Reply_Email . '' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();
        if (mail($email, $subject, $message, $headers)) {
            die(json_encode(true));
        } else {
            die(json_encode(false));
        }
    }

    function add_more_contacts() {
        $data = '<div class="col-md-12 col-sm-12 col-xs-12">';
        $data .= '<div class="form-group col-md-4 col-sm-12 col-xs-12">';
        $data .= '<div class="input-group">';
        $data .= '<div class="input-group-addon">';
        $data .= '<i class="fa fa-phone"></i>';
        $data .= '</div>';
        $data .= '<div class="input-group-addon codeinput">';
        $data .= '<input type="text" placeholder="Code" class="form-control" name="more_landline_code[]" id="more_landline_code" >';
        $data .= '</div>';
        $data .= '<input type="text" class="form-control" placeholder="Landline No." name="more_landline_no[]" id="more_landline_no" maxlength="10"">';
        $data .= '</div>';
        $data .= '</div>';
        $data .= '<div class="form-group col-md-4 col-sm-12 col-xs-12">';
        $data .= '<div class="input-group">';
        $data .= '<div class="input-group-addon"><i class="fa fa-mobile"></i></div>';
        $data .= '<div class="input-group-addon codeinput">';
        $data .= '<input type="text" placeholder="Code" class="form-control" name="more_mobile_code[]" id="more_mobile_code">';
        $data .= '</div>';
        $data .= '<input type="text" class="form-control" placeholder="Mobile No." name="more_mobile_no[]" id="more_mobile_no" maxlength="10">';
        $data .= '</div>';
        $data .= '</div>';
        $data .= '</div>';
        die(json_encode($data));
    }

    function get_businessinfo() {
        $id = $this->input->post('id');
        $data = $this->Common_model->select_where_row('business_earnings', array('business_id' => $id));
        if (empty($data)) {
            die(json_encode(array('status' => false)));
        } else {
            die(json_encode(array('status' => true, 'earninginfo' => $data)));
        }
    }

}
