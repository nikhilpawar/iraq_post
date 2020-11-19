<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Common\Services\EmailService;
use Validator;
use Flash;
use Sentinel;
use Reminder;
use URL;
use Session;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->arr_view_data      = [];
        $this->module_title       = "Admin";
        $this->module_view_folder = "admin.auth";
        $this->admin_panel_slug   = config('app.project.admin_panel_slug');
        $this->module_url_path    = url($this->admin_panel_slug);
    }

    public function login()
    {
        $this->arr_view_data['page_title']       = $this->module_title." Login";
        $this->arr_view_data['module_title']     = $this->module_title." Login";
        $this->arr_view_data['admin_panel_slug']     = $this->admin_panel_slug;

        if(\URL::previous()==$this->module_url_path.'/change_password')
        {
            Flash::success("Success! Your password has been changed!");    
        }

        return view($this->module_view_folder.'.login',$this->arr_view_data);
    }

    public function process_login(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'email'    => 'required|max:255',
            'password' => 'required',
        ]);

        if ($validator->fails()) 
        {
            return redirect(config('app.project.admin_panel_slug').'/login')
                      ->withErrors($validator)
                      ->withInput($request->all());
        }


        $remember_me = $request->input('remember_me');
        
        $credentials = [
                            'email'    => $request->input('email'),
                            'password' => $request->input('password'),
                       ];

        try 
        {
            $obj_authentication = false;
            if($remember_me == 'on')
            {
                $obj_authentication = Sentinel::authenticateAndRemember($credentials);
                setcookie('remember_me_email',$request->input('email'), time()+60*60*24*100);
                setcookie('remember_me_password',$request->input('password'), time()+60*60*24*100);
            }
            else
            {
                $obj_authentication = Sentinel::authenticate($credentials);
                setcookie('remember_me_email','');
                setcookie('remember_me_password','');
            }

            if($obj_authentication!=false)
            {
                
                if($obj_authentication->inRole(config('app.project.role_slug.admin_role_slug')))
                {
                    return redirect(config('app.project.admin_panel_slug').'/dashboard');
                }
                else
                {
                    Flash::error('Not Sufficient Privileges');
                    return redirect()->back();
                }
            }
            else
            {
                Flash::error('Invalid Login Credential');
                return redirect()->back();
            }    
        } 
        catch(\Exception $e)
        {
            Flash::error($e->getMessage());
            return redirect()->back();
        }

        Flash::error('Something went wrong ! Please try again !');
        return redirect()->back();
    }
    
    public function forgot_password()
    {
        $this->arr_view_data['module_title']     = 'Forgot Password';
        $this->arr_view_data['page_title']       = 'Forgot Password';
        $this->arr_view_data['admin_panel_slug'] = $this->admin_panel_slug;

        return view($this->module_view_folder.'.forgot_password',$this->arr_view_data); 
    }

    public function process_forgot_password(Request $request)
    {
        $arr_rules['email']      = "required";

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
          Flash::error('Please enter valid email_id');
          return redirect()->back()->withErrors($validator)->withInput();
        }

        $email = $request->input('email');

        try 
        {
            $user  = Sentinel::findByCredentials(['email' => $email]);
            
            if($user==null)
            {
                Flash::error("Invaild Email Address");
                return redirect()->back();
            }
            
            if($user->inRole('admin') == false) 
            {
                Flash::error('We are unable to process this Email Id');
                return redirect()->back();
            }

            $reminder = Reminder::create($user);      

            if($reminder)
            {
                $arr_mail_data = $this->built_mail_data($email, $reminder->code); 

                $obj_email_service = new EmailService();

                $email_status  = $obj_email_service->send_mail($arr_mail_data);
            
                if($email_status)
                {
                    Flash::success('Password reset link sent successfully to your email id');
                    return redirect()->back();
                }
                else
                {
                    Flash::success('Error while sending password reset link');
                    return redirect()->back();
                }
            }
            else
            {
                Flash::error('We are unable to process this Email Id');
                return redirect()->back();
            }   
        } 
        catch (\Exception $e) 
        {
            Flash::error($e->getMessage());
            return redirect()->back();    
        }

        Flash::error('Something went wrong ! Please try again !');
        return redirect()->back();
    }

    public function validate_reset_password_link($enc_id, $enc_reminder_code)
    {
        $user_id       = base64_decode($enc_id);
        $reminder_code = base64_decode($enc_reminder_code);

        try 
        {
            $user = Sentinel::findById($user_id);
        
            if(!$user)
            {
              Flash::error('Invalid User Request');
              return redirect()->back();
            }
            
            if(Reminder::exists($user))
            {
                $this->arr_view_data['module_title']      = 'Reset Password';
                $this->arr_view_data['page_title']        = 'Reset Password';
                $this->arr_view_data['admin_panel_slug']  = $this->admin_panel_slug;
                $this->arr_view_data['enc_id']            = $enc_id;
                $this->arr_view_data['enc_reminder_code'] = $enc_reminder_code;

                return view($this->module_view_folder.'.reset_password',$this->arr_view_data); 
            }
            else
            {
              Flash::error('Reset Password Link Expired');
              return redirect()->back();
            }            
        } 
        catch(\Exception $e)
        {
            Flash::error($e->getMessage());
            return redirect()->back();
        }

        Flash::error('Something went wrong ! Please try again !');
        return redirect()->back();
    }

    public function reset_password(Request $request)
    {
        $arr_rules                      = array();
        $arr_rules['password']          = "required";
        $arr_rules['confirm_password']  = "required";
        $arr_rules['enc_id']            = "required";
        $arr_rules['enc_reminder_code'] = "required";

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
          return redirect()->back();
        }

        $enc_id            = $request->input('enc_id');
        $enc_reminder_code = $request->input('enc_reminder_code');
        $password          = $request->input('password');
        $confirm_password  = $request->input('confirm_password');

        if($password  !=  $confirm_password )
        {
          Flash::error('Passwords Do Not Match.');
          return redirect()->back();
        }

        $user_id       = base64_decode($enc_id);
        $reminder_code = base64_decode($enc_reminder_code);

        try 
        {
            $user = Sentinel::findById($user_id);

            if(!$user)
            {
              Flash::error('Invalid User Request');
              return redirect()->back();
            }

            if ($reminder = Reminder::complete($user, $reminder_code, $password))
            {
              Flash::success('Password reset successfully');
              return redirect($this->admin_panel_slug.'/login');
            }
            else
            {
              Flash::error('Reset Password Link Expired');
              return redirect()->back();
            }            
        } 
        catch(\Exception $e)
        {
            Flash::error($e->getMessage());
            return redirect()->back();
        }

        Flash::error('Something went wrong ! Please try again !');
        return redirect()->back();
    }

    public function change_password()
    {
        $this->arr_view_data['page_title']           = "Change Password";
        $this->arr_view_data['module_title']         = "Change Password";

        $this->arr_view_data['parent_module_icon']   = "icon-home2";
        $this->arr_view_data['parent_module_title']  = "Dashboard";
        
        $this->arr_view_data['parent_module_url']    = url($this->admin_panel_slug.'/dashboard');
        $this->arr_view_data['module_icon']          = "fa fa-key";

        $this->arr_view_data['admin_panel_slug'] = $this->admin_panel_slug;

        return view($this->module_view_folder.'.change_password',$this->arr_view_data); 
    }
    
    public function update_password(Request $request)
    {
        $arr_rules                     = array();
        $arr_rules['current_password'] = "required";
        $arr_rules['new_password']     = "required";
      
        $validator = Validator::make($request->all(),$arr_rules);
        
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $credentials = [];
        $credentials['password'] = $request->input('current_password');

        try 
        {
            $user = Sentinel::check();
            if (Sentinel::validateCredentials($user,$credentials)) 
            {  
                $new_credentials = [];
                $new_credentials['password'] = $request->input('new_password');

                if(Sentinel::update($user,$new_credentials))
                {
                    $this->logout();
                }
                else
                {
                    Flash::error('Problem Occurred, While Changing Password');
                    return redirect()->back();
                }
            } 
            else
            {
                Flash::error('Invalid current password');
                return redirect()->back();
            }            
        } 
        catch (\Exception $e) 
        {
            Flash::error($e->getMessage());
            return redirect()->back();
        }

        Flash::error('Something went wrong ! Please try again !');
        return redirect()->back();
    }

    public function logout()
    {
        Sentinel::logout();
        return redirect(url($this->admin_panel_slug));
    }

    private function built_mail_data($email, $reminder_code)
    {
        $user = $this->get_user_details($email);
        if($user)
        {
            $arr_user = $user->toArray();

            $reminder_url = '<p class="email-button"><a target="_blank" href=" '.\URL::to($this->admin_panel_slug.'/validate_admin_reset_password_link/'.base64_encode($arr_user['id']).'/'.base64_encode($reminder_code) ).'">Reset Password</a></p><br/>' ;

            $arr_built_content = [
                                    'FIRST_NAME'       => 'Admin',
                                    'LAST_NAME'        => isset($arr_user['last_name']) ? $arr_user['last_name'] :'',
                                    'EMAIL'            => isset($arr_user['email']) ? $arr_user['email'] :'',
                                    'REMINDER_URL'     => $reminder_url,
                                    'USER_NAME'        => config('app.project.role_slug.admin_role_slug'),
                                    'PROJECT_NAME'     => ucwords(config('app.project.name'))
                                ];


            $arr_mail_data                      = [];
            $arr_mail_data['email_template_id'] = '1';
            $arr_mail_data['arr_built_content'] = $arr_built_content;
            $arr_mail_data['user']              = $arr_user;
            return $arr_mail_data;
        }
        return FALSE;
    }

    private function get_user_details($email)
    {
        $credentials = ['email' => $email];
        $user = Sentinel::findByCredentials($credentials); // check if user exists

        if($user)
        {
          return $user;
        }
        return FALSE;
    }

    public function domain()
    {
        $this->arr_view_data['page_title']          = 'Domain';
        $this->arr_view_data['admin_panel_slug']    = $this->admin_panel_slug;
        return view($this->module_view_folder.'.domain',$this->arr_view_data);
    }

    public function set_domain(Request $request)
    {
        
        \Session::forget('domain');
        \Session::put('domain',$request->domain);
        return response()->json(array('status'=>'success','domain'=>$request->domain));
    }
}
