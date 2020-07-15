<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Service_docx {

    function print_data($data_array, $template, $save_filename)
    {
        $return = [];
        $CI =& get_instance();

        $json_sent = [
            "document_template" => $template,
            "document_save_filename" => $save_filename,
            "document_data" => $data_array
        ];

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_PORT => "7777",
            CURLOPT_URL => "http://docx:7777/generate_document",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 120,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($json_sent),
            CURLOPT_HTTPHEADER => array(
                "content-type: application/json"
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        
        // Non debug	
	// echo "cURL Error #:" . $err;
	// echo "<br>";
	// echo 'http://docx:7777/'.$json_sent['document_save_filename'];
	// echo "<br>";
	//

	$pagename = 'my_page1';
	$newFileName = './uploads/'.$pagename.".php";
	$newFileContent = '<?php echo "something..."; ?>';

	if (file_put_contents($newFileName, $newFileContent) !== false) {
    		echo "File created (" . basename($newFileName) . ")";
	} else {
	    echo "Cannot create file (" . basename($newFileName) . ")";
	}

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            // echo $response;
            if(@$data_array['image'] && @$data_array['map_image']) {
                sleep(5);
            }
            $contents_ret = file_put_contents('./uploads/'.basename($json_sent['document_save_filename']), file_get_contents('http://docx:7777/'.$json_sent['document_save_filename']));
	    // Non debug
	    // echo "Print_error";
            // echo "<br>";
	    // echo $contents_ret;
	    $return['full_url'] = 'uploads/'.basename($json_sent['document_save_filename']);
            
        }

        return $return;
        
    }

}
