<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Common_model extends CI_Model {

    public function &__get($key) {
        $CI = & get_instance();
        return $CI->$key;
    }

    function select_all($tbl) {
        $data = $this->db->get($tbl);
        return $data->result();
    }

    function select_where($table, $id) {
        $qry = $this->db->get_where($table, $id);
        $respond = $qry->result();
        return $respond;
    }

    function select_where_row($table, $id) {
        $qry = $this->db->get_where($table, $id);
        return $qry->row();
    }

    function select_update($table, $data, $id) {
        $query = $this->db->update($table, $data, $id);
        return $query;
    }

    function insert($table, $data) {
        $query = $this->db->insert($table, $data);
        return $query;
    }

    function delete_where($tbl, $where) {
        $query = $this->db->delete($tbl, $where);
        return $query;
    }

    function inserted_id($table, $data) {
        $insert_id = $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    function get_top_business() {
        $this->db->select('businesses.*,cities.name as city_name,categories.name as category_name');
        $this->db->from('businesses');
        $this->db->join('cities', 'cities.id = businesses.city', 'left');
        $this->db->join('categories', 'categories.id = businesses.category_id', 'left');
        $this->db->where('businesses.is_approved', 1);
        $this->db->order_by('id desc');
        $this->db->limit(6);
        $qry = $this->db->get();
        return $qry->result();
    }

    function get_business_cities() {
        $this->db->distinct();
        $this->db->select('city,cities.name as city_name');
        $this->db->where('is_approved', 1);
        $this->db->where('city !=', 0);
        $this->db->join('cities', 'cities.id = businesses.city', 'left');
        $query = $this->db->get('businesses');
        return $query->result();
    }

    function businesses($limit = null, $start = null, $user_id) {
        if ($limit != null || $start != null) {
            $this->db->limit($limit, $start);
        }
        //$this->db->where('businesses.is_approved', 0);
        $this->db->where('businesses.user_id', $user_id);
        $this->db->order_by('businesses.created_date desc');
        $query = $this->db->get('businesses');
        if ($query->num_rows() > 0) {
            $final_data = array();
            foreach ($query->result() as $key => $row) {
                $earningsdata = $this->db->query("select * from  business_earnings where business_id = '" . $row->id . "'")->row();
                $data[] = $row;
                $final_data[$key] = $row;
                if (!empty($earningsdata)) {
                    $final_data[$key]->transaction_id = $earningsdata->transaction_id;
                }
            }
            $final_data['counts'] = $query->num_rows();
            return $final_data;
        }
        return false;
    }

    function payments($limit = null, $start = null, $user_id) {
        if ($limit != null || $start != null) {
            $this->db->limit($limit, $start);
        }
        $this->db->where('reseller_payments.status', 1);
        $this->db->where('reseller_payments.user_id', $user_id);
        $this->db->order_by('reseller_payments.created_date desc');
        $query = $this->db->get('reseller_payments');
        if ($query->num_rows() > 0) {
            $final_data = array();
            foreach ($query->result() as $key => $row) {
                $data[] = $row;
                $final_data[$key] = $row;
            }
            $final_data['counts'] = $query->num_rows();
            return $final_data;
        }
        return false;
    }

    function get_duplicate_business($landline_no, $mobile_no, $other_no) {
        //$query = $this->db->query("SELECT `businesses`.*
        //      FROM `businesses`
        //    WHERE `businesses`.`mobile_no` = '$mobile_no'");

        if ($mobile_no != "") {
            $this->db->where('businesses.mobile_no', $mobile_no);
            $this->db->or_where('businesses.landline_no', $mobile_no);
            $this->db->or_where('businesses.other_no', $mobile_no);
        }
        if ($landline_no != "") {
            $this->db->where('businesses.mobile_no', $landline_no);
            $this->db->or_where('businesses.landline_no', $landline_no);
            $this->db->or_where('businesses.other_no', $landline_no);
        }
        if ($other_no != "") {
            $this->db->where('businesses.mobile_no', $other_no);
            $this->db->or_where('businesses.landline_no', $other_no);
            $this->db->or_where('businesses.other_no', $other_no);
        }

        $query = $this->db->get('businesses');
//        $query = $this->db->query("SELECT `businesses`.* "
//                . "FROM `businesses` "
//                . "WHERE `businesses`.`mobile_no` = '$mobile_no' or landline_no = '$mobile_no' or other_no = '$mobile_no' "
//                . "OR `businesses`.`mobile_no` = '$landline_no' or landline_no = '$landline_no' or other_no = '$landline_no' OR `businesses`.`mobile_no` = '$other_no' or landline_no = '$other_no' or other_no = '$other_no'");
        //echo $this->db->last_query();
        return $query->result();
    }

    function business_counts($user_id) {
        $query = $this->db->query('SELECT
  (SELECT COUNT(*) FROM businesses WHERE businesses.user_id = "' . $user_id . '" AND businesses.is_approved = 1) as approvedbusinesses, 
  (SELECT COUNT(*) FROM businesses WHERE businesses.user_id = "' . $user_id . '" AND businesses.is_approved = 0) as pendingbusinesses');
        return $query->row();
    }

    function get_business($business_id) {
        $query = $this->db->query("SELECT *,
(select states.name from states where businesses.state = states.id) as state_name, 
(select cities.name from cities where businesses.city = cities.id) as city_name, 
(select categories.name from categories where businesses.category_id = categories.id) as category_name, 
(select subcategories.name from subcategories where businesses.subcategory_id = subcategories.id) as subcategory_name
FROM `businesses`
WHERE `businesses`.`id` = $business_id");
        $result = $query->row();
        $images = $this->select_where('company_images', array('business_id' => $result->id));
        if (!empty($images)) {
            $result->company_images = $images;
        }
        if ($result->city != "") {
            $city = $this->select_where_row('cities', array('id' => $result->city));
            $result->state_name = $city->name;
        }
        if ($result->state != "") {
            $state = $this->select_where_row('states', array('id' => $result->state));
            $result->state_name = $state->name;
        }
        return $result;
    }

    function business_data($limit = null, $start = null, $category_id = null, $search_key = null, $search_category_id = null, $search_city = null) {
        if ($limit != null || $start != null) {
            $this->db->limit($limit, $start);
        }
        $this->db->where('businesses.status', 1);
        $this->db->where('businesses.is_approved', 1);
        if ($category_id != null) {
            $this->db->where('businesses.category_id', $category_id);
        }
        if ($search_category_id != null) {
            $this->db->where('businesses.category_id', $search_category_id);
        }
        if ($search_key != null) {
            $keyword = $this->db->query("select * from keywords where name = '" . $search_key . "'")->row();
            if (!empty($keyword)) {
                $this->db->where("FIND_IN_SET('$keyword->id',businesses.keywords) !=", 0);
            }
        }
        if ($search_city != null) {
            $this->db->like('businesses.city', $search_city);
        }
        $query = $this->db->get('businesses');
        if ($query->num_rows() > 0) {
            $final_data = array();
            foreach ($query->result() as $key => $row) {
                $data[] = $row;
                $final_data[$key] = $row;
            }
            $final_data['counts'] = $query->num_rows();
            return $final_data;
        }
        return false;
    }

    function review_data($limit = null, $start = null, $business_id = null) {
        if ($limit != null || $start != null) {
            $this->db->limit($limit, $start);
        }
        $this->db->where('reviews.status', 1);
        $this->db->where('reviews.business_id', $business_id);
        $query = $this->db->get('reviews');
        if ($query->num_rows() > 0) {
            $final_data = array();
            foreach ($query->result() as $key => $row) {
                $data[] = $row;
                $final_data[$key] = $row;
            }
            $final_data['counts'] = $query->num_rows();
            return $final_data;
        }
        return false;
    }

    function get_company_images($business_id) {
        $query = $this->db->query("SELECT `company_images`.image
                FROM `company_images`
                WHERE `company_images`.`business_id` = '$business_id'");
        return $query->result_array();
    }

    function get_busi_images($business_id) {
        $query = $this->db->query('SELECT GROUP_CONCAT("' . base_url() . '",image) as image FROM `company_images` WHERE `business_id` = "' . $business_id . '"');
        return $query->result_array();
    }

}
