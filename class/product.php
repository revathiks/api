<?php

//header("Access-Control-Allow-Origin: *");
include_once 'conn.php';

class Product extends Dbconfig {

    public function __construct() {
        parent::__construct();
    }

    public function listProducts() {
        $response = array();
        $query = "select * from products where status=1 order by id desc";
        if ($result = mysqli_query($this->connection, $query)) {
            $rowcount = mysqli_num_rows($result);
            if ($rowcount > 0) {
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $productlist[] = $row;
                }
                $response['products'] = $productlist;
                $response['noRecords'] = $rowcount;
            } else {
                $response['noRecords'] = 0;
            }
        } else {
            $response['noRecords'] = 0;
        }
        return $response;
    }

    public function confirmOrder($data) {
        $response = array();
        $response['actionState'] = 0;
        /* $userid=$data['userid']; */
        /* $billing_email=$data['billing_email'];
          $billing_name=$data['billing_name']; */
        $shipping_name = $data['shipping_name'];
        $shipping_email = $data['shipping_email'];
        $total = $data['total'];
        $shipping_cost = $data['shipping_cost'];
        $shipping_address = $data['shipping_address'];
        $order_items = $data['order_item'];
        isset($data['userid']) ? $userid = $data['userid'] : $userid = 0;
        isset($billing_email) ? $billing_email = $billing_email : $billing_email = "";
        isset($billing_name) ? $billing_name = $billing_name : $billing_name = "";
        isset($shipping_name) ? $shipping_name = $shipping_name : $shipping_name = "";
        isset($shipping_email) ? $shipping_email = $shipping_email : $shipping_email = "";
        isset($shipping_address) ? $shipping_address = $shipping_address : $shipping_address = "";
        $createdon = date("Y-m-d h:i:s");
       $insertQry = "INSERT INTO order_history (userid,billing_name,billing_email,shipping_name,shipping_email,shipping_address,total,shipping_cost,createdon)
        VALUES ('$userid','$billing_name', '$billing_email', '$shipping_name','$shipping_email','$shipping_address','$total','$shipping_cost','$createdon')";
        if (mysqli_query($this->connection, $insertQry)) {
            $order_id = $this->connection->insert_id;

            if (isset($order_items) && count($order_items) > 0) {
                foreach ($order_items as $item) {
                    $product_id = $item['produc_id'];
                    $product_code = $item['product_code'];
                    $quantity = $item['quantity'];
                    $price = $item['price'];
                    $insertQry2 = "INSERT INTO order_items(order_id,product_id,product_code,quantity,price)
                     VALUES ('$order_id','$product_id', '$product_code', '$quantity','$price')";
                    mysqli_query($this->connection, $insertQry2);
                }
            }

            $response['orderstatus'] = "success";
            $response['actionState'] = 1;
            $response['msg'] = "Order Placed Successfully";
        } else {
            $response['orderstatus'] = "failed";
            $response['msg'] = "Something went to wrong.Please try again later.";
        }
        return $response;
    }

    public function myorders($userid) {
        $response = $orders = $orderlistnew = array();
        $query = "SELECT oh.* FROM `order_history` oh WHERE oh.userid=$userid";
        if ($result = mysqli_query($this->connection, $query)) {
            $rowcount = mysqli_num_rows($result);
            if ($rowcount > 0) {
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $orderlist[] = $row;
                }
                if (!empty($orderlist)) {
                    foreach ($orderlist as $k => $order) {
                        $oid = $order['id'];
                        $query2 = "SELECT oi.*,p.name,p.thumb FROM `order_items` oi join products p on oi.product_id=p.id WHERE oi.order_id=$oid";
                        if ($result2 = mysqli_query($this->connection, $query2)) {
                            while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
                                $orderlist[$k]['items'][] = $row2;
                            }
                        }
                    }
                    $response['orders'] = $orderlist;
                }
            } else {
                $response['noRecords'] = 0;
            }
        } else {
            $response['noRecords'] = 0;
        }
        return $response;
    }

    public function orderDetail($orderid) {
        $response = $orders = $orderdetail = array();
        $query = "SELECT oi.*,oh.id as orderid,oh.createdon,oh.shipping_name,oh.status,oh.shipping_email,oh.shipping_address,oh.shipping_mobile,oh.total,oh.shipping_cost,p.name AS productname,p.thumb,CONCAT(u.fname ,' ' ,u.lname)AS username,u.email AS usermail FROM `order_items` oi JOIN `order_history` oh ON oi.order_id=oh.id JOIN products p ON oi.product_id=p.id JOIN users u ON oh.userid=u.id WHERE oi.order_id=$orderid";
        if ($result = mysqli_query($this->connection, $query)) {
            $rowcount = mysqli_num_rows($result);
            if ($rowcount > 0) {
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $orderlist[] = $row;
                }


                if (!empty($orderlist)) {
                    foreach ($orderlist as $k => $order) {
                        $orderdetail[0]['orderid'] = $order['orderid'];
                        $orderdetail[0]['username'] = $order['username'];
                        $orderdetail[0]['usermail'] = $order['usermail'];
                        $orderdetail[0]['shipping_name'] = $order['shipping_name'];
                        $orderdetail[0]['shipping_email'] = $order['shipping_email'];  
                        $orderdetail[0]['shipping_address'] = $order['shipping_address'];  
                        $orderdetail[0]['shipping_mobile'] = $order['shipping_mobile'];
                         $orderdetail[0]['total'] = $order['total'];
                         $orderdetail[0]['shipping_cost'] = $order['shipping_cost'];
                          $orderdetail[0]['status'] = $order['status'];
                        $orderdetail[0]['createdon'] = $order['createdon'];
                    }
                    
                    $orderdetail[0]['items'] = $orderlist;

                    //echo "<pre>";print_r($orderdetail);echo '</pre>';
                    $response['order'] = $orderdetail;
                }
            } else {
                $response['noRecords'] = 0;
            }
        } else {
            $response['noRecords'] = 0;
        }
        return $response;
    }

    public function add_product($data) {
        $target_dir = "../uploads/products/";
        $response = array();
        $response['actionState'] = 0;
        isset($data['name']) ? $name = $data['name'] : $name = "";
        isset($data['code']) ? $code = $data['code'] : $code = "";
        isset($data['price']) ? $price = $data['price'] : $price = "";
        isset($data['description']) ? $description = $data['description'] : $description = "";

        if ($name != "" && $code != "" && $price != "" && $description != "" && $_FILES["thumb"]["name"] != "") {

            $query = "select * from products WHERE code='$code'";
            if ($result = mysqli_query($this->connection, $query)) {
                $rowcount = mysqli_num_rows($result);
                if ($rowcount > 0) {
                    $response['status'] = "failed";
                    $response['msg'] = "Product code already used";
                } else {
                    $target_file = $target_dir . basename($_FILES["thumb"]["name"]);
                    if (move_uploaded_file($_FILES["thumb"]["tmp_name"], $target_file)) {
                        $thumb = basename($_FILES["thumb"]["name"]);
                        $insertQry = "INSERT INTO products (name,code,description,price,thumb)
                         VALUES ('$name','$code','$description', '$price', '$thumb')";
                        if (mysqli_query($this->connection, $insertQry)) {
                            $response['status'] = "success";
                            $response['msg'] = "Product added successfully";
                            $response['actionState'] = 1;
                        } else {
                            $response['status'] = "failed";
                            $response['msg'] = "Something Went Wrong";
                        }
                    } else {
                        $response['status'] = "failed";
                        $response['msg']= "Sorry, there was an error uploading your file.";
                    }
                }
            } else {
                $response['status'] = "failed";
                $response['msg']= "Sorry.somthing went to wrong";
            }
        } else {
            $response['status'] = "failed";
            $response['msg'] = "Please fill all mandatory fields";
        }
        return $response;
    }
    
    public function productdetail($id) {
        $response = array();
        $response['noRecords'] = "";

        $query = "select * from products where id=" . $id;
        if ($result = mysqli_query($this->connection, $query)) {
            $rowcount = mysqli_num_rows($result);
            if ($rowcount > 0) {
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                $response['noRecords'] = $rowcount;
                $response['product'] = $row;
            } else {
                $response['noRecords'] = 0;
            }
        } else {
            $response['noRecords'] = 0;
        }
        return $response;
    }
    
    public function productupdate($data) {
        $response = array();
        $response['actionState'] = 0;
        $name = $data['name'];
        $code = $data['code'];
        $price= $data['price'];
        $description = $data['description'];
        $id = $data['id'];
        $query = "select * from products WHERE id = '" . $id . "'";
        if ($result = mysqli_query($this->connection, $query)) {
            $rowcount = mysqli_num_rows($result);
            if ($rowcount > 0) {
               $updateQry = "update products set name='$name',code='$code',price='$price',description='$description' where id=" . $id;
                if (mysqli_query($this->connection, $updateQry)) {
                    $response['updatestatus'] = "success";
                    $response['msg'] = "Product updated successfully";
                    $response['actionState'] = 1;
                } else {
                    $response['updatestatus'] = "failed";
                    $response['msg'] = "something went to wrong";
                };
            } else {
                $response['updatestatus'] = "failed";
                $response['msg'] = "something went to wrong";
            }
        } else {
            $response['updatestatus'] = "failed";
            $response['msg'] = "something went to wrong";
        }
        return $response;
    }
    
    public function deleteProduct($id) {
        $response = array();
        $response['actionState'] = 0;
        $updateQry = "update products set status=0 where id=".$id;             
        if ($result = mysqli_query($this->connection, $updateQry)) {

            $response['msg'] = "Product deleted successfully";
            $response['status'] = 'success';
            $response['actionState'] = 1;
        } else {
            $response['msg'] = "something went to wrong";
            $response['status'] = 'failed';
        }
        return $response;
    }
    public function cancelOrder($id) {
        $response = array();
        $response['actionState'] = 0;
        $updateQry = "update order_history set status='Cancelled' where id=".$id;             
        if ($result = mysqli_query($this->connection, $updateQry)) {

            $response['msg'] = "Order cancelled successfully";
            $response['status'] = 'success';
            $response['actionState'] = 1;
        } else {
            $response['msg'] = "something went to wrong";
            $response['status'] = 'failed';
        }
        return $response;
    }

}

?>