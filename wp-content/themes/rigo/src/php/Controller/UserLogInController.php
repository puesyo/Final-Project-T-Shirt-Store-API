<?php
namespace Rigo\Controller;

use Rigo\Types\Course;
use Rigo\Types\UserLogIn;
use \WP_REST_Request;

class UserLogInController{
    
    
    
    public function getSingleUser(WP_REST_Request $request){
        $id = (string) $request['id'];
        return UserLogIn::get($id);
    }
    
    public function getAllUsers(WP_REST_Request $request){
        
        //get all posts
        $query = UserLogIn::all();
        return $query;//Always return an Array type
    }
    
    // public function getCoursesByType(WP_REST_Request $request){
        
    //     $query = UserLogIn::all([ 'status' => 'draft' ]);
    //     return $query->posts;
    // }
    
    public function createUser(WP_REST_Request $request){

        $body = json_decode($request->get_body());
        
        $id = UserLogIn::create([
            'post_title'    => $body->title,
            ]);
            return $id;
    }

    
    public function deleteUser(WP_REST_Request $request){
        $id = (string) $request['id'];
        // result is true on success, false on failure
        $result = UserLogIn::delete($id);
        return $result;
    }
        
        
    /**
     * Using Custom Post types to add new properties to the course
     */
    public function getUserWithCustomFields(WP_REST_Request $request){
        
        $users = [];
        $query = UserLogIn::all();
        foreach($query->posts as $user){
            $users[] = array(
                "ID" => $user->ID,
                "post_title" => $user->name,
                "name" => $user->name,
                "last_name" => $user->last_name,
                "email" => $user->email,
                "password" => $user->password,
                
            );
        }
        return $users;
    }
}
?>