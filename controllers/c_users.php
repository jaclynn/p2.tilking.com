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
            $_POST['modified'] = Time::now();
            $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
            $_POST['token']    = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string());
            
            /*
            echo "<pre>";
            print_r($_POST);
            echo "<pre>";
            */
                        
            DB::instance(DB_NAME)->insert_row('users', $_POST);
            
            echo 'You\'re signed up';
            
            # Send them to the login page
            Router::redirect('/users/login');
            
            
    }

    public function login($error=NULL) {
    
            $this->template->content = View::instance('v_users_login');    
               
            # Pass data to the view
			$this->template->content->error = $error;

		    # Render the view
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
                
			    # Login failed
			    if(!$token) {
			        # Note the addition of the parameter "error"
			        Router::redirect("/users/login/error"); 
			    }
			    # Login passed
			    else {
			        setcookie("token", $token, strtotime('+2 weeks'), '/');
			        Router::redirect("/");
			    }           
    }

	public function logout() {
	
	    # Generate and save a new token for next login
	    $new_token = sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string());
	
	    # Create the data array we'll use with the update method
	    # In this case, we're only updating one field, so our array only has one entry
	    $data = Array("token" => $new_token);
	
	    # Do the update
	    DB::instance(DB_NAME)->update("users", $data, "WHERE token = '".$this->user->token."'");
	
	    # Delete their token cookie by setting it to a date in the past - effectively logging them out
	    setcookie("token", "", strtotime('-1 year'), '/');
	
	    # Send them back to the main index.
	    Router::redirect("/");
	
	}
	
    public function oldprofile($user_name=NULL) {
                
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
                
                $q = "SELECT * FROM users WHERE first_name = 'Jackie'";
                echo $q;
                
                # Pass the data to the View
                $this->template->content->user_name = $user_name;
                
                # Display the view
                echo $this->template;
                        
                //$view = View::instance('v_users_profile');
                //$view->user_name = $user_name;                
                //echo $view;
                
    }

} # end of the class
