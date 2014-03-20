<?php
class Homemodel extends CI_Model {
    
	function __construct(){
        parent::__construct();
    }
	
	public function registration(){
		$query = $this->db->query("SELECT email FROM user WHERE (email ='".mysql_real_escape_string($_POST['username'])."' OR username='".mysql_real_escape_string($_POST['username'])."')");		
		$rows = $query->result_array();
		if(!isset($rows[0]['email'])){
			unset($_POST['registration']);
			$_POST['email']=$_POST['username'];
			$_POST['password']=md5($_POST['password']);	
			$id=$this->db->insert('user', $_POST);
			$_SESSION['username']=$_POST['username'];
			$_SESSION['userid']=$id;
			$this->db->where('id', $id);
			$data['activation_key']=md5($id);
			$this->db->update('user', $data);
			$this->load->library('email');
			$this->email->from('muthu@askpundit.com', 'Muthusundar');
			$this->email->to($_POST['email']);
			$this->email->subject('Email Test');
			$this->email->message($this->config->base_url()."?verify=".md5($id));
			$this->email->send();
			return "success";
		}else{
			return "failure";
		}
	}
	public function profile(){
		if(isset($_POST['submit'])){
			unset($_POST['submit']);
			$this->db->where('id', $_SESSION['userid']);
			$this->db->update('user', $_POST);			
			return true;
		}else{
			$query = $this->db->query("SELECT * FROM user WHERE (id ='".$_SESSION['userid']."'");		
			$rows = $query->result_array();
			return $data;
		}
	}
	public function change_password(){
		if(isset($_POST['submit'])){
			$query = $this->db->query("SELECT email FROM user WHERE (email ='".mysql_real_escape_string($_POST['username'])."' OR username='".mysql_real_escape_string($_POST['username'])."')  AND password='".md5(mysql_real_escape_string($_POST['password']))."'");		
			$rows = $query->result_array();
			if(isset($rows[0]['email'])){
				$data['password']=md5($_POST['password']);
				$this->db->where('id', $_SESSION['userid']);
				$this->db->update('user', $data);			
				return true;
			}
		}
	}
	public function login(){
		$query = $this->db->query("SELECT id,firstname,lastname,email,username FROM user WHERE (email ='".mysql_real_escape_string($_POST['username'])."' OR username='".mysql_real_escape_string($_POST['username'])."')  AND password='".md5(mysql_real_escape_string($_POST['password']))."'");		
		$rows = $query->result_array();
		if(isset($rows[0]['email'])){
			$_SESSION['username']=$rows[0]['email'];
			$_SESSION['name']=$rows[0]['firstname']." ".$rows[0]['lastname'];
			$_SESSION['userid']=$rows[0]['id'];
			return $_SESSION['username'];				
		} else {
			return 1;
		}
		
	}
	Public function activation(){
		$this->db->where('activation_key', $_GET['verify']);
		$data['status']="1";
		if($this->db->update('user', $data)){
			$query = $this->db->query("SELECT id,firstname,lastname,email,username FROM user WHERE activation_key ='".mysql_real_escape_string($_GET['verify'])."'");		
			$rows = $query->result_array();
			if(isset($rows[0]['email'])){
				$_SESSION['username']=$rows[0]['email'];
				$_SESSION['name']=$rows[0]['firstname']." ".$rows[0]['lastname'];
				$_SESSION['userid']=$rows[0]['id'];
				return "success";
			} else {
				return "failuer";
			}
		
		}
	}
	public function web_login(){
		$query = $this->db->query("SELECT id,firstname,lastname,email,username FROM user WHERE (email ='".mysql_real_escape_string($_POST['username'])."' OR username='".mysql_real_escape_string($_POST['username'])."')  AND password='".md5(mysql_real_escape_string($_POST['password']))."'");		
			$rows = $query->result_array();
			if(isset($rows[0]['email'])){
				echo json_encode(array("result"=>"success"));
			} else {
				echo json_encode(array("result"=>"failure"));
			}
		
	}
	public function forgotpassword($email){
		$password=$this->RandomString();
		$user['password']=md5($password);;
		$this->db->where('email', $email);
		$this->db->update('tbl_user', $user);
		$this->load->library('email');
		$this->email->from('muthu@askpundit.com', 'Admin');
		$this->email->reply_to('muthu@askpundit.com', 'Admin');
		$this->email->to($email);
		$this->email->subject('Your Account Details – AskPundit');	
		$name=explode('@',$email);
		$message = '<table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top"><table width="500" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="top"><a href="http://physiohealth.com" target="_blank"><img src="http://physiohealth.com/images/email/logo.jpg" alt="AskPundit" width="500" height="102" border="0" /></a></td>
      </tr>
      <tr>
        <td style="background-image:url(http://physiohealth.com/images/email/bg.jpg); background-repeat:repeat-y;"><table width="450" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td><h2 style="font-family:Arial, Helvetica, sans-serif; font-size:19px; color:#182f58; font-weight:300; text-decoration:none; margin-bottom:10px; margin-top:10px;">Dear Customers,</h2>
              <p style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#59595a; text-decoration:none; margin-bottom:20px; margin-top:10px;">Hi '.$name[0].'<br>Your AskPundit account passowrd is reset.</p>
              <h3 style="font-family:Arial, Helvetica, sans-serif; font-size:15px; color:#59595a; text-decoration:none; margin-bottom:20px; margin-top:10px; font-weight:normal;"><span style="font-family:Arial, Helvetica, sans-serif; font-size:15px; color:#e75819; text-decoration:none; font-weight:700">Email:</span>'.$_POST['email'].'</h3>
              <h3 style="font-family:Arial, Helvetica, sans-serif; font-size:15px; color:#59595a; text-decoration:none; margin-bottom:20px; margin-top:5px; font-weight:normal;"><span style="font-family:Arial, Helvetica, sans-serif; font-size:15px; color:#e75819; text-decoration:none; font-weight:700">Password:</span> '.$password.'</h3>
              <p style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#59595a; text-decoration:none; margin-bottom:20px; margin-top:10px;">In case of any issues please feel to contact us at <a style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#19365e; text-decoration:underline;" href="mailto:muthu@askpundit.com">muthu@askpundit.com</a></p>
              <p style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#9d9d9d; text-decoration:none; margin-bottom:0px; margin-top:40px; text-align:center; padding:0px;">© 2014 PhysioHealth., LLC. All Rights Reserved.</p>
              </td>
          </tr>
          </table></td>
      </tr>
      <tr>
        <td valign="top"><img src="http://physiohealth.com/images/email/bottom-img.jpg" width="500" height="21" /></td>
      </tr>
    </table></td>
  </tr>
</table>';
		$this->email->message($message);	
		$this->email->set_alt_message('This is the alternative message');
		$this->email->send();
		}
	
	public function RandomString(){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randstring = '';
    for ($i = 0; $i < 10; $i++) 
        {
            $randstring .= $characters[rand(0, strlen($characters))];
        }
    return $randstring;
    }
}
?>