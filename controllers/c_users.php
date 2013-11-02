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
                        
            $_POST = DB::instance(DB_NAME)->sanitize($_POST);
            
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
                $this->user->avatar = "/";
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
	public function profile() {
	
	    # If user is blank, they're not logged in; redirect them to the login page
	    if(!$this->user) {
	        Router::redirect('/users/login');
	    }
	
	    # If they weren't redirected away, continue:
		$q = 'SELECT 
		            *
		        FROM profiles
		        WHERE user_id = '.$this->user->user_id;	
		echo $q;
		
		$profile = DB::instance(DB_NAME)->select_rows($q);
		//echo var_dump($profile);
		
	    # Setup view
	    $this->template->content = View::instance('v_users_profile');
	    $this->template->title   = "Profile of".$this->user->first_name;
	    $this->template->content->profile = $profile;
		
	    # Render template
	    echo $this->template;
	}
	
	public function updateprofile() {
	
	    # If user is blank, they're not logged in; redirect them to the login page
	    if(!$this->user) {
	        Router::redirect('/users/login');
	    }
	
	    # If they weren't redirected away, continue:
	
	    # Setup view
	    $this->template->content = View::instance('v_users_updateprofile');
	    $this->template->title   = "Profile of".$this->user->first_name;
	
	    # Render template
	    echo $this->template;
	}

	


} # end of the class
