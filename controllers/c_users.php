<?php
class users_controller extends base_controller {

    public function __construct() {
        parent::__construct();
    } 

    public function index() {
        echo "This is the index page";
    }

    public function signup() {
       
       # Set up the view
       $this->template->content = View::instance('v_users_signup');
       
       
       # Render the view
       echo $this->template;
       
    }
    
    public function p_signup() {
                        
            $_POST['created']  = Time::now();
            $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
            $_POST['token']    = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string());
            
            echo "<pre>";
            print_r($_POST);
            echo "<pre>";
            
            DB::instance(DB_NAME)->insert_row('users', $_POST);
            
            # Send them to the login page
            //Router::redirect('/users/login');
            
            
    }

    public function login() {
    
            $this->template->content = View::instance('v_users_login');            
            echo $this->template;   
       
    }
    
    public function p_login() {
                      
                $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
                
                echo "<pre>";
            print_r($_POST);
            echo "</pre>";

                $q = 
                        'SELECT token 
                        FROM users
                        WHERE email = "'.$_POST['email'].'"
                        AND password = "'.$_POST['password'].'"';
                        
                        //echo $q;
           
                $token = DB::instance(DB_NAME)->select_field($q);
                
                # Success
                if($token) {
                		# cookie exists for up to one year, accessible to all in domain
                        setcookie('token',$token, strtotime('+1 year'), '/'); 
                        echo "You are logged in!";
                }
                # Fail
                else {
                        echo "Login failed!";
                }
           
    }

    public function logout() {
        echo "This is the logout page";
    }

    public function profile($user_name = NULL) {
                
                # Set up the View
                # this creates an instance of the master template: $template=View::('_v_template'); but this ALREADY set up in base controller! So we do this which loads an instance of the profile for insertion into the master template (set to content):
                $this->template->content = View::instance('v_users_profile');
                
                #Pass data to the view
                $this->template->content->user_name = $user_name;
                $this->template->title = "Profile";
                
                # Load client files
                $client_files_head = Array(
                        '/css/profile.css',
                        );
                
                # what this does is take the array contained in $client_files_head and puts the surrounding <link or script> stuff.
                $this->template->client_files_head = Utils::load_client_files($client_files_head);
                
                $client_files_body = Array(
                        '/js/profile.js'
                        );
                
                $this->template->client_files_body = Utils::load_client_files($client_files_body);
                
                # Pass the data to the View
                $this->template->content->user_name = $user_name;
                
                # Display the view
                echo $this->template;
                        
                //$view = View::instance('v_users_profile');
                //$view->user_name = $user_name;                
                //echo $view;
                
    }

} # end of the class
