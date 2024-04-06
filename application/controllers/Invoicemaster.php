<?php
defined('BASEPATH') or exit('No direct script access allowed');

// $path = "plugin/mpdf61/mpdf.php";
// include $path;
class Invoicemaster extends CI_COntroller
{

public function __construct(){
    parent::__construct();
    $this->load->model('Invoicemaster_Model');
    $this->load->library('mailer');
    if (!$this->session->userdata('Email'))
    redirect('Login');
}
// ------------------------------------------------------------------------------------------------
public function index(){
    $this->load->view('invoice/invoicemaster');
}
// ------------------------------------------------------------------------------------------------

public function autoClinetSearch(){
    $output = "";
    if (empty($this->input->post('clientsearch'))) {
        echo json_encode(array('error' => 'Please enter a search term'));
        exit;
    }
    $searchclient = $this->input->post("clientsearch");
    $data = $this->Invoicemaster_Model->getClientRecords($searchclient);
    echo json_encode(array('data' => $data));
}
    // ------------------------------------------------------------------------------------------------
public function autoItemSearch(){
    if (empty($this->input->post('itemsearch'))) {
    echo json_encode(array('error' => 'Please enter a search term'));
    exit;
    }
    $searchItem  = $this->input->post("itemsearch");
    $data = $this->Invoicemaster_Model->getItemRecords($searchItem);
    echo json_encode(array('data' => $data));
}
// ------------------------------------------------------------------------------------------------
// insert and update :-----------------------------------------------------------------------------
public function addUpdateinvoicemaster(){
    // echo "insert24-12";die;
    $this->form_validation->set_rules('clientname', 'Client Name', 'trim|required');
	$this->form_validation->set_rules('item_name[]', 'Item Name', 'required');
	$this->form_validation->set_rules('item_quantity[]', 'Item Quantity', 'required|greater_than_equal_to[1]|trim');
    $this->form_validation->set_rules('item_Total[]', 'Item Total', 'required|trim|numeric');

    if ($this->form_validation->run()) {
    $invoiceid = $this->input->post('Sno');

    $invoiceid = $this->input->post('invoiceid');
    // print_r($invoiceid);die;
    $invoicedate = $this->input->post('invoice_date');
    $clientname = $this->input->post('clientid');
    $total_amount = $this->input->post('Total_amount');

    if(empty($invoiceid)) {
            if ($this->input->post("clientname") == "") {
                echo json_encode(array('status' => 'error', 'message' => 'ClientName is blank'));
                exit;
            }
        $data = array(
            'client_id' => $clientname,
            'invoice_date' => $invoicedate,
            'total_amount' => $total_amount
        );
        // echo "insert";die;
        $invoiceid = $this->Invoicemaster_Model->insert_invoicemaster($data);
        $itemarr = array();
        echo json_encode(array('code' => 200, 'msg' => 'Insert Sucessfully'));
    }
    else{
        // echo "update";die;
        if ($this->input->post("clientname") == "") {
            echo json_encode(array('status' => 'error', 'message' => 'ClientName is blank'));
            exit;
        }
        $data = array(
            'client_id' => $clientname,
            'invoice_date' => $invoicedate,
            'total_amount' => $total_amount
        );
        // echo "update1";die;
        $this->Invoicemaster_Model->update_invoicemaster($invoiceid, $data);
        $this->Invoicemaster_Model->delete_invoice_details($invoiceid);
        echo json_encode(array('code' => 200, 'msg' => 'Update Sucessfully'));
    }
    foreach ($this->input->post('item_id') as $key => $val) {
        $itemarr = array(
            'item_id' => $val,
            'item_qty' => $this->input->post('item_quantity')[$key],
            'invoice_id' => $invoiceid,
            'item_price' => $this->input->post('item_price')[$key],
        );
        $this->Invoicemaster_Model->insert_invoice_details($itemarr);
    }
}
else{
    echo json_encode(array('status' => 'error', 'message' => strip_tags(validation_errors())));
}

}
//-------------------------------------------------------------------------------------------------
public function fetch_Data(){
    $table = '';
    $post = $this->input->post();
    $order_by = $this->input->post('columnName');
    $sort_by = $this->input->post('sort_type');

    $search_params = array(
        'client_name' => $this->input->post('search_user_name'),
        'client_email' => $this->input->post('search_user_email'),
        'page_num' =>  $this->input->post('page_num'),
        'limit' =>  $this->input->post('limit')
    );
    $data = $this->Invoicemaster_Model->invoice_record($search_params, $order_by, $sort_by);
    $totaldata = $this->Invoicemaster_Model->getRecordTotal();
    $pagination = $this->load->view('pagination.php', array('total' => $totaldata, 'limit' => $post['limit']), true);
    // print_r($data);die;
    if (!empty($data['data'])) {
        $i = $post['limit'] * ($post['page_num'] - 1) + 1;
        // $table = '';
        foreach ($data['data'] as $row) {
            // print_r($row);die;
            $table .= "<tr>";
            $table .= "<td class='p-2 border-r w-10 text-right text-center' style='font-size: 15px; margin-top: 5px; color: black '>" . $i . "</td>";
            $table .= "<td class='p-2 border-r w-10 text-right text-center' style='font-size: 15px; margin-top: 5px; color: black '>" . $row->id . "</td>";
             $table .= "<td class='p-2 border-r w-10 text-right text-center' style='font-size: 15px; margin-top: 5px; color: black '>" . $row->invoice_date . "</td>";
            // echo "<td class='p-2 border-r w-10 text-right text-center' style='font-size: 14px; margin-top: 5px; color: black '>". $row->invoice_date. "</td>";
            $table .= "<td onclick = 'invoiceupdate($row->id);' class='p-2 border-r w-10 text-right text-center' style='font-size: 15px; margin-top: 5px; color: black; cursor:pointer; '>" . ucfirst($row->client_name) . "</td>";
            $table .= "<td onclick = 'invoiceupdate($row->id);' class='p-2 border-r w-10 text-right text-center' style='font-size: 15px; margin-top: 5px; color: black; cursor:pointer; '>" . ucfirst($row->client_email) . "</td>";
            $table .= "<td class='p-2 border-r w-10 text-right text-center' style='font-size: 15px; margin-top: 5px; color: black '>" . ucfirst($row->address) . "</td>";
            $table .= "<td class='p-2 border-r w-10 text-right text-right' style='font-size: 15px; margin-top: 5px; color: black '>" . $row->total_amount . "</td>";
            $table .= '<td><span  onclick="getpdf(' . $row->id . ')"><a href="#" style=" margin-left:6px; color: red;">
                <i class="bi bi-file-earmark-pdf-fill"></i>
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="20" fill="currentColor" class="bi bi-file-earmark-pdf-fill" viewBox="0 0 16 16">
                <path d="M5.523 12.424c.14-.082.293-.162.459-.238a7.878 7.878 0 0 1-.45.606c-.28.337-.498.516-.635.572a.266.266 0 0 1-.035.012.282.282 0 0 1-.026-.044c-.056-.11-.054-.216.04-.36.106-.165.319-.354.647-.548zm2.455-1.647c-.119.025-.237.05-.356.078a21.148 21.148 0 0 0 .5-1.05 12.045 12.045 0 0 0 .51.858c-.217.032-.436.07-.654.114zm2.525.939a3.881 3.881 0 0 1-.435-.41c.228.005.434.022.612.054.317.057.466.147.518.209a.095.095 0 0 1 .026.064.436.436 0 0 1-.06.2.307.307 0 0 1-.094.124.107.107 0 0 1-.069.015c-.09-.003-.258-.066-.498-.256zM8.278 6.97c-.04.244-.108.524-.2.829a4.86 4.86 0 0 1-.089-.346c-.076-.353-.087-.63-.046-.822.038-.177.11-.248.196-.283a.517.517 0 0 1 .145-.04c.013.03.028.092.032.198.005.122-.007.277-.038.465z"/>
                <path fill-rule="evenodd" d="M4 0h5.293A1 1 0 0 1 10 .293L13.707 4a1 1 0 0 1 .293.707V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zm5.5 1.5v2a1 1 0 0 0 1 1h2l-3-3zM4.165 13.668c.09.18.23.343.438.419.207.075.412.04.58-.03.318-.13.635-.436.926-.786.333-.401.683-.927 1.021-1.51a11.651 11.651 0 0 1 1.997-.406c.3.383.61.713.91.95.28.22.603.403.934.417a.856.856 0 0 0 .51-.138c.155-.101.27-.247.354-.416.09-.181.145-.37.138-.563a.844.844 0 0 0-.2-.518c-.226-.27-.596-.4-.96-.465a5.76 5.76 0 0 0-1.335-.05 10.954 10.954 0 0 1-.98-1.686c.25-.66.437-1.284.52-1.794.036-.218.055-.426.048-.614a1.238 1.238 0 0 0-.127-.538.7.7 0 0 0-.477-.365c-.202-.043-.41 0-.601.077-.377.15-.576.47-.651.823-.073.34-.04.736.046 1.136.088.406.238.848.43 1.295a19.697 19.697 0 0 1-1.062 2.227 7.662 7.662 0 0 0-1.482.645c-.37.22-.699.48-.897.787-.21.326-.275.714-.08 1.103z"/>
                </svg> </a></span></td>';
            $table .= "<td>
                <button type='button' onclick='modalemail(" . $row->id . ", `" . $row->client_email ."`,`".$row->client_name."`,`".$row->total_amount. "`)' class='btn ' data-bs-toggle='modal' data-bs-target='#exampleModal' data-bs-whatever='@mdo' style='margin-top : -9px'> <a href='#' style='margin-top: 0px; margin-left: 7px; color: #007bff'><i class='bi bi-envelope'></i>
                <svg xmlns='http://www.w3.org/2000/svg' width='30' height='20' fill='currentColor' class='bi bi-envelope' viewBox='0 0 16 16'>
                <path d='M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z'/>
                </svg>
                </a></button>
                </td>";
            $table .= "<td><span  onclick='invoiceupdate($row->id);'>
                <a href='#'><i class='bi bi-pencil-square'></i>
				<svg xmlns='http://www.w3.org/2000/svg' width='30' height='20' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16' style='margin-left: 9px; '>
				<path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
				<path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/>
				</svg></a>
                </span> </td>";

                $table .= "<td><span  onclick='deleteinvoice($row->id);'>
                <a href='#'><i class='bi bi-pencil-square'></i>
				<svg xmlns='http://www.w3.org/2000/svg' width='30' height='20' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16' style='margin-left: 2px; color:red;'>
  					<path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z'/>
  					<path d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z'/>
					</svg></a>
                </span> </td>";




            $table .= "</tr>";
            $i++;
        }
        echo json_encode(array('table' => $table, 'pagi' => $pagination, 'status' => 200));
    } else {
        // $table .= "<tr>";
        $table .= "
        <div class='col-12'>
        <div class='alert alert-primary bg-light text-center col-12' role='alert'>
            No Record Found
          </div></div>";
        echo json_encode(array('table' => $table, 'pagi' => $pagination, 'status' => 300));
    }
}

public function deleteinvoice()
	{
		$invoiceid = $this->input->post('id');
		$result = $this->Invoicemaster_Model->invoicemaster_delete($invoiceid);
		echo json_encode(array('code' => 200, 'msg' => ' Delete Successfully'));
	}



// ------------------------------------------------------------------------------------------------
public function getTotalRecords(){
    $data = $this->Invoicemaster_Model->getRecordTotal();
    echo json_encode($data);
}
// ----------------------------------------------------------------------------

public function Pdf(){
    $edit_id = $this->input->post('id');
    $data = $this->Invoicemaster_Model->Invoicemaster_update($edit_id);
    $content = $this->load->view('invoice/pdf', array('data' => $data), true);
    $fileLocation = "uploads/pdf/invoice-" . $data['cleint_data'][0]['id'] . "SAN" . $data['cleint_data'][0]['id'] . '.pdf';
    $filePath = $_SERVER['DOCUMENT_ROOT'] . "/CodeIgniter/" . $fileLocation;
    $fileUrl  = base_url() . $fileLocation;
    if (file_exists($filePath)) {
        unlink($filePath);
    }
    $check = $this->generatepdf->DownloadPdf($filePath,  $content, $data);
    if (file_exists($filePath)) {
        echo json_encode(array('statusCode' => 200, 'fileUrl' => $fileUrl));
    }
    else{
        echo json_encode(array('statusCode' => 400, 'msg' => "File Not Found"));
    }
}
// ------------------------------------------------------------------------------------------------
public function invoiceupdate(){
    $edit_id = $this->input->post('id');
    // print_r($edit_id);die;
    $result = $this->Invoicemaster_Model->Invoicemaster_update($edit_id);
    //    echo "<pre>";
    //    print_r($result);die;
        echo json_encode($result);
}

// ------------------------------------------------------------------------------------------------
public function mailer(){
    $edit_id = $this->input->post('id');
    $email = $_POST['email'];
    $cc = $_POST['cc'];
    $subject = $_POST['subject'];
    $body = $_POST['body'];
    $data = $this->Invoicemaster_Model->Invoicemaster_update($edit_id);
    echo json_encode(array('code' => 200, 'msg' => 'Send Sucessfully'));
     $content = $this->load->view('invoice/pdf', array('data' => $data), true);
    $fileLocation = "uploads/pdf/invoice-" .  $data['cleint_data'][0]['id'] . "SAN" . $data['cleint_data'][0]['id'] . '.pdf';
    $filePath = $_SERVER['DOCUMENT_ROOT'] . "/CodeIgniter/" . $fileLocation;
    $fileUrl  = base_url() . $fileLocation;
    if (file_exists($filePath)) {
        unlink($filePath);
    }
    $check = $this->generatepdf->DownloadPdf($filePath, $content, $data);
    $dataArr = array('cc' => $cc);
    $dataArr['attachment'] = array(
        array('file' => $filePath, 'name' => "Invoice-SAN" .   $data['cleint_data'][0]['id'])
    );
     $resp = $this->mailer->sendEmail($email, $subject, $body, $dataArr);
    // echo json_encode(array('status' => 'error', 'msg' => 'Email Not Send '));
    // echo json_encode(array('code' => 200, 'msg' => 'Send Sucessfully'));
}


public function getnextinvoice(){
    $nextInvoicemaster = $this->Invoicemaster_Model->nextInvoice();
    echo json_encode(array('data' => $nextInvoicemaster));
}
}
