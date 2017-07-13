<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_model extends CI_Model {

    public function &__get($key) {
        $CI = & get_instance();
        return $CI->$key;
    }

    function get_user_account() {
        $this->load->library('Datatables');
        $this->datatables->select('demo_user_profiles.mobile_no as mobile_no,user_accounts.is_login as is_login,user_accounts.reffrence_link as reffrence_link,user_accounts.uacc_active as uacc_active,user_accounts.uacc_admin_approved as uacc_admin_approved,user_accounts.earnings as earnings,user_accounts.uacc_username as uacc_username,user_accounts.uacc_group_fk as uacc_group_fk,user_accounts.uacc_email as uacc_email,user_accounts.uacc_id as uacc_id,user_accounts.uacc_ip_address as uacc_ip_address ,user_accounts.uacc_date_last_login as uacc_date_last_login,user_accounts.uacc_suspend as uacc_suspend');
        $this->datatables->from('user_accounts');
        $this->datatables->where('uacc_group_fk = 2');
        $this->datatables->join('demo_user_profiles', 'demo_user_profiles.upro_uacc_fk  = user_accounts.uacc_id', 'inner');
        return $this->datatables->generate();
    }

    function get_business() {
        $search_data = $this->input->post();
        $this->load->library('Datatables');
        $this->datatables->select('business_earnings.transaction_id as transaction_id,businesses.id as id,businesses.website as website,businesses.contact_person_name as contact_person_name,businesses.name as name,businesses.email as email,businesses.mobile_no as mobile_no,businesses.other_no as other_no,businesses.created_date as created_date,businesses.is_approved as is_approved');
        $this->datatables->from('businesses');
        if ($search_data['approved_business'] == 1) {
            $this->datatables->where('is_approved = 1');
        }
        if ($search_data['rejected_business'] == 1) {
            $this->datatables->where('is_approved = 2');
        }
        if ($search_data['pending_business'] == 1) {
            $this->datatables->where('is_approved = 0');
        }
        $this->datatables->join('business_earnings', 'business_earnings.business_id  = businesses.id', 'left');
        return $this->datatables->generate();
    }

    function get_categories() {
        $this->load->library('Datatables');
        $this->datatables->select('categories.id as id,categories.name as name,categories.description as description,categories.created_date as created_date,categories.status as status');
        $this->datatables->from('categories');
        $this->datatables->where('categories.status = 1');
        return $this->datatables->generate();
    }

    function get_keywords() {
        $this->load->library('Datatables');
        $this->datatables->select('keywords.id as id,keywords.name as name,keywords.description as description,keywords.created_date as created_date,keywords.status as status');
        $this->datatables->from('keywords');
        $this->datatables->where('keywords.status = 1');
        return $this->datatables->generate();
    }

    function get_subcategories() {
        $this->load->library('Datatables');
        $this->datatables->select('categories.name as category_name,subcategories.id as id,subcategories.category_id as category_id,subcategories.name as name,subcategories.description as description,subcategories.created_date as created_date,categories.status as status');
        $this->datatables->from('subcategories');
        $this->datatables->where('subcategories.status = 1');
        $this->datatables->join('categories', 'subcategories.category_id = categories.id', 'inner');
        return $this->datatables->generate();
    }

    function get_payments($user_id) {
        $this->load->library('Datatables');
        $this->datatables->select('reseller_payments.id as id,reseller_payments.netamount as netamount,reseller_payments.tax as tax,reseller_payments.date as date,reseller_payments.payment_method as payment_method,reseller_payments.id as id,reseller_payments.created_date as created_date,reseller_payments.status as status,reseller_payments.amount as amount,reseller_payments.transaction_id as transaction_id,reseller_payments.bank_transaction_id as bank_transaction_id,reseller_payments.chequeno as chequeno');
        $this->datatables->from('reseller_payments');
        $this->datatables->where('reseller_payments.status = 1');
        $this->datatables->where('reseller_payments.user_id', $user_id);
        return $this->datatables->generate();
    }

    function get_visitors() {
        $this->load->library('Datatables');
        $this->datatables->select('visitorinfo.company_name as company_name,visitorinfo.first_name as first_name,visitorinfo.last_name as last_name,visitorinfo.contact_no as contact_no,visitorinfo.is_verified as is_verified,visitorinfo.advertize_added as advertize_added');
        $this->datatables->from('visitorinfo');
        return $this->datatables->generate();
    }

    function dashboard_data() {
        $query = $this->db->query('SELECT
  (SELECT COUNT(*) FROM categories WHERE status = 1) as total_categories, 
  (SELECT COUNT(*) FROM subcategories WHERE status = 1) as total_subcategories,
  (SELECT COUNT(*) FROM visitorinfo) as total_visitors,
  (SELECT COUNT(*) FROM reseller_payments where status = 1) as reseller_payments,
  (SELECT COUNT(*) FROM businesses WHERE is_approved = 0) as pending_business,
  (SELECT COUNT(*) FROM businesses WHERE is_approved = 1) as approved_business,
  (SELECT COUNT(*) FROM user_accounts WHERE uacc_group_fk = 2 and uacc_active = 1) as total_users,
  (SELECT COUNT(*) FROM visitorinfo WHERE advertize_added = 1) as total_visitor_adds');
        return $query->row();
    }

}
