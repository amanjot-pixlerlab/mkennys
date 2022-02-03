<?php 
require_once('wp-load.php');

global $wpdb;
   $value = array(
      'name' => $_POST['name'],
      'email' => $_POST['email'],
      'phone' => $_POST['phone'],
      'state' => $_POST['state'],
      'city' => $_POST['city'],
      'location' => $_POST['location'],
    );



$table_name = $wpdb->prefix . 'notify';
$result = $wpdb->get_results("SELECT email FROM $table_name where email = '".$_POST['email']."' And location ='".$_POST['location']."'  ",ARRAY_A);
if(count($result) > 0){
    echo json_encode('error');
    exit;
}
else
{
    
    $wpdb->insert($table_name, $value, '%s');
    notifyMail($value);
    echo json_encode('done');
    exit;
}
    


function notifyMail($value){


        
        $url = home_url();
        $client_message = "<html><head></head><body style='font-family:Arial, Helvetica, sans-serif;margin:0; padding:0;' >";
        $client_message .="<div  style='background: #eaeced;'>
                        <div  style='width:700px; margin:0px auto; background: #fff;'>
                            
                            <div style='text-align: center; padding: 20px; background: #fff;'>
                                <a href='http://mkennys.com/' style='display:inline-block'><img src='".$url."/newsletter-images/logo.png' alt=''></a> 
                            </div>
                            <div><img src='".$url."/newsletter-images/image.jpg'></div>
                            <div style='padding:30px 40px; max-width:500px;margin:0 auto; font-size:17px;'>
                                <p style='font-size: 17px; font-family:Arial, Helvetica, sans-serif; color: #555;'>Dear ".$value['name']." </p>
                                <p style='font-size: 17px; line-height:1.8; font-family:Arial, Helvetica, sans-serif; color: #555;'>Thanks for linking up with us. We'll keep you informed of our upcoming travel schedules near you so we can start to build a fresh new custom wardrobe for you. Below is a summary of your details, if you see anything incorrect please e-mail us and let us know.</p>
                                 <table>
                                    <tbody>
                                        <tr>
                                            <td style='width: 120px;font-weight: 600;color: #555;font-family: Arial,Helvetica,sans-serif;padding: 10px 0;'>From</td>
                                            <td style='color: #555;font-family: Arial,Helvetica,sans-serif;padding: 10px 0;'>".$value['name']."</td>
                                        </tr>
                                        <tr>
                                            <td style='width: 120px;font-weight: 600;color: #555;font-family: Arial,Helvetica,sans-serif;padding: 10px 0;'>Email</td>
                                            <td style='color: #555;font-family: Arial,Helvetica,sans-serif;padding: 10px 0;'>".$value['email']."</td>
                                        </tr>
                                        <tr>
                                            <td style='width: 120px;font-weight: 600;color: #555;font-family: Arial,Helvetica,sans-serif;padding: 10px 0;'>Phone</td>
                                            <td style='color: #555;font-family: Arial,Helvetica,sans-serif;padding: 10px 0;'>".$value['phone']."</td>
                                        </tr>
                                        <tr>
                                            <td style='width: 120px;font-weight: 600;color: #555;font-family: Arial,Helvetica,sans-serif;padding: 10px 0;'>State</td>
                                            <td style='color: #555;font-family: Arial,Helvetica,sans-serif;padding: 10px 0;'>".$value['state']."</td>
                                        </tr>
                                        <tr>
                                            <td style='width: 120px;font-weight: 600;color: #555;font-family: Arial,Helvetica,sans-serif;padding: 10px 0;'>City</td>
                                            <td style='color: #555;font-family: Arial,Helvetica,sans-serif;padding: 10px 0;'>".$value['city']."</td>
                                        </tr>
                                        <tr>
                                            <td style='width: 120px;font-weight: 600;color: #555;font-family: Arial,Helvetica,sans-serif;padding: 10px 0;'>Location</td>
                                            <td style='color: #555;font-family: Arial,Helvetica,sans-serif;padding: 10px 0;'>".$value['city'].", ".$value['state']."</td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                                    
                                <hr>
                                <p>
                                                <span style='font-weight:bold;font-size: 13px; font-family:Arial, Helvetica, sans-serif; color: #222;'>Thanks,</span>
                                            <br>
                                            
                                                <span style='font-weight:bold;font-size: 12px; font-family:Arial, Helvetica, sans-serif; color: #222;'>True Fitted by M Kenny's </span>
                                            <br>
                                                <span style='font-weight:bold;font-size: 12px; font-family:Arial, Helvetica, sans-serif; color: #222;'>Irvine, CA.</span>
                                            <br>
                                                <a style='font-weight:bold;color:#15c' href='mailto:info@mkennys.com'>info@mkennys.com</a>
                                            <br>
                                                <a style='font-weight:bold;color:#15c' href='http://www.mkennys.com'>www.mkennys.com</a>
                                            <br>
                                               <a style='font-weight:bold;color:#15c' href='tel:(714)%20573-2199' value='+17145732199' target='_blank'>+1 714 573 2199</a>   
                                            </p>
                            </div>
                            <div style='padding: 30px; background: #f7f7f7; text-align:center'>
                                
                                <p style='font-size: 16px; text-align: center; font-family:Arial, Helvetica, sans-serif; color: #555;'><a href='http://www.mkennys.com'>www.mkennys.com</a></p>
                            </div>
                        </div>
                    </div>";

        

        $admin_message = "<html><head></head><body style='font-family:Arial, Helvetica, sans-serif;margin:0; padding:0;' >";
        $admin_message .="<div  style='background: #eaeced;'>
                        <div  style='width:700px; margin:0px auto; background: #fff;'>
                            
                            <div style='text-align: center; padding: 20px; background: #fff;'>
                                <a href='http://mkennys.com/' style='display:inline-block'><img src='".$url."/newsletter-images/logo.png' alt=''></a> 
                            </div>
                            <div><img src='".$url."/newsletter-images/image.jpg'></div>
                            <div style='padding:30px 40px; max-width:500px;margin:0 auto; font-size:17px;'>
                                <p style='font-size: 17px; font-family:Arial, Helvetica, sans-serif; color: #555;'>Dear Admin </p>
                                <p style='font-size: 17px; line-height:1.8; font-family:Arial, Helvetica, sans-serif; color: #555;'>
                                Tour Schedule information Request. 
                                </p>

                                <table>
                                    <tbody>
                                        <tr>
                                            <td style='width: 120px;font-weight: 600;color: #555;font-family: Arial,Helvetica,sans-serif;padding: 10px 0;'>From</td>
                                            <td style='color: #555;font-family: Arial,Helvetica,sans-serif;padding: 10px 0;'>".$value['name']."</td>
                                        </tr>
                                        <tr>
                                            <td style='width: 120px;font-weight: 600;color: #555;font-family: Arial,Helvetica,sans-serif;padding: 10px 0;'>Email</td>
                                            <td style='color: #555;font-family: Arial,Helvetica,sans-serif;padding: 10px 0;'>".$value['email']."</td>
                                        </tr>
                                        <tr>
                                            <td style='width: 120px;font-weight: 600;color: #555;font-family: Arial,Helvetica,sans-serif;padding: 10px 0;'>Phone</td>
                                            <td style='color: #555;font-family: Arial,Helvetica,sans-serif;padding: 10px 0;'>".$value['phone']."</td>
                                        </tr>
                                        <tr>
                                            <td style='width: 120px;font-weight: 600;color: #555;font-family: Arial,Helvetica,sans-serif;padding: 10px 0;'>State</td>
                                            <td style='color: #555;font-family: Arial,Helvetica,sans-serif;padding: 10px 0;'>".$value['state']."</td>
                                        </tr>
                                        <tr>
                                            <td style='width: 120px;font-weight: 600;color: #555;font-family: Arial,Helvetica,sans-serif;padding: 10px 0;'>City</td>
                                            <td style='color: #555;font-family: Arial,Helvetica,sans-serif;padding: 10px 0;'>".$value['city']."</td>
                                        </tr>
                                        <tr>
                                            <td style='width: 120px;font-weight: 600;color: #555;font-family: Arial,Helvetica,sans-serif;padding: 10px 0;'>Location</td>
                                            <td style='color: #555;font-family: Arial,Helvetica,sans-serif;padding: 10px 0;'>".$value['city'].", ".$value['state']."</td>
                                        </tr>
                                        
                                    </tbody>
                                </table>


                                    
                                <hr>
                                <p>
                                              <span style='font-weight:bold;font-size: 13px; font-family:Arial, Helvetica, sans-serif; color: #222;'>Thanks,</span>
                                            <br>
                                            
                                                <span style='font-weight:bold;font-size: 12px; font-family:Arial, Helvetica, sans-serif; color: #222;'>True Fitted by M Kenny's </span>
                                            <br>
                                                <span style='font-weight:bold;font-size: 12px; font-family:Arial, Helvetica, sans-serif; color: #222;'>Irvine, CA.</span>
                                            <br>
                                                <a style='font-weight:bold;color:#15c;font-size: 13px;' href='mailto:info@mkennys.com'>info@mkennys.com</a>
                                            <br>
                                                <a style='font-weight:bold;color:#15c;font-size: 13px;' href='http://www.mkennys.com'>www.mkennys.com</a>
                                            <br>
                                               <a style='font-weight:bold;color:#15c;font-size: 13px;' href='tel:(714)%20573-2199' value='+17145732199' target='_blank'>+1 714 573 2199</a>   
                                            </p>
                            </div>
                            <div style='padding: 30px; background: #f7f7f7; text-align:center'>
                                
                                <p style='font-size: 16px; text-align: center; font-family:Arial, Helvetica, sans-serif; color: #555;'> <a href='http://www.mkennys.com'>www.mkennys.com</a></p>
                            </div>
                        </div>
                    </div>";



        
        $admin_subject = 'Tour Schedule Notification Request in '.$value['state'];
        $client_subject = "Get notified for custom fittings in ".$value['state'];
        


        $from = 'info@mkennys.com';
		
		//$from = "karanjeettr@gmail.com";
		
        
        $headers = 'MIME-Version: 1.0' . "\r\n";
       
        $headers .= 'Bcc:info@mkennys.com' . "\r\n";
        
        $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        $headers .= "From: True Fitted by M Kennys " .$from. "\r\n" .
        "X-Mailer: PHP/" . phpversion();
        
        $mail=mail($value['email'],$client_subject,$client_message,$headers);        


        $admin_headers = 'MIME-Version: 1.0' . "\r\n";
        //$admin_headers .= 'Bcc:sanjeevtrgroup@outlook.com' . "\r\n";
        $admin_headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        $admin_headers .= "From: True Fitted by M Kennys " .$from. "\r\n" .
        "X-Mailer: PHP/" . phpversion();
        $mail=mail($from,$admin_subject,$admin_message,$admin_headers);
        return;
    }

    


?>