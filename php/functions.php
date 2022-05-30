<?php

include("../php/classes.php");
session_start();
include("../php/connect.php");


/********** LOG IN / SIGN UP VERIFICATION **********/

/**
 * Finds whether a username exist in the database or not
 * 
 * @param mysqli $conn      the connection to the serever
 * @param string $username  the username that searching we are searching for
 * 
 * @return mixed            true if the username exists, false if it doesn't
 *                          and null if there was an error with the database
 */
function nameExists($conn, $username) {
    $sql_query = "SELECT username FROM user WHERE username = '$username'";
    $result = mysqli_query($conn, $sql_query);
    if(!$result) {
        return null;
    }
    $resultCheck = mysqli_num_rows($result);
    mysqli_free_result($result);

    if($resultCheck > 0) {
        return true;
    }
    return false;
}

/**
 * Finds whether a email exist in the database or not
 * 
 * @param mysqli $conn      the connection to the serever
 * @param string $email     the email that searching we are searching for
 * 
 * @return mixed            true if the email exists, false if it doesn't
 *                          and null if there was an error with the database
 */
function emailExists($conn, $email) {
    $sql_query = "SELECT email FROM user WHERE email = '$email'";
    $result = mysqli_query($conn, $sql_query);
    if(!$result) {
        return null;
    }
    $resultCheck = mysqli_num_rows($result);
    mysqli_free_result($result);

    if($resultCheck > 0) {
        return true;
    }
    return false;
}

/**
 * Signing Up a user
 * 
 * @param mysqli $conn      the connection to the serever
 * @param string $username  the username of the user that's being added
 * @param string $email     the email of the user that's being added
 * @param string $city   the city of the user that's being added
 * @param string $password  the password of the user that's being added
 * @param string $telephone the telephone of the user that's being added
 * 
 * @return boolean          returns true if the user didn't already exist and was
 *                          created successfully and false if there was a problem
 *                          with the creation of the user
 */
function signUp($conn, $username, $email, $city, $password, $telephone) {
     return addAccountToDB($conn, $username, $email, $city, $password, $telephone);
}

/**
 * Adding an acount to the database if the user didn't already exist and was
 * created successfully and logging him into the site
 * 
 * @param mysqli $conn      the connection to the serever
 * @param string $username  the username of the user that's being added
 * @param string $email     the email of the user that's being added
 * @param string $city   the city of the user that's being added
 * @param string $password  the password of the user that's being added
 * @param string $telephone the telephone of the user that's being added
 * 
 * @return boolean          returns true if the user didn't already exist and was
 *                          created successfully and false if there was a problem
 *                          with the creation of the user
 */

function addAccountToDB($conn, $username, $email, $city, $password, $telephone) {
    $sql_query = "INSERT INTO user(username, email, city, password, telephone, imgpath) VALUES ('$username', '$email', '$city', '$password','$telephone', '../images/profile-circle.png')";

    if(mysqli_query($conn, $sql_query)) {
        $id = mysqli_insert_id($conn);
        $user = new User($id, $username, $email, $city, $password, $telephone);
        if(logIn($user, $conn)) {
            return true;
        } else {
            return false;
        }
            
    }
    echo "query error " . mysqli_error($conn);
    return false;
}

/**
 * Verifies the user log in informstion and logs them in if it is correct
 * 
 * @param mysqli $conn      the connection to the serever
 * @param string $email     the email of the user that requsts to log in
 * @param string $password  the password of the user that requsts to log in
 * 
 * @return mixed            true if the accont data were correct and the user was
 *                          loged in successfully, false if the accont data were incorrect
 *                          and null if there was an error with the database
 */
function authenticate($conn, $email, $password) {
    $sql_query = "SELECT * FROM user WHERE email = '$email'";
    $result = mysqli_query($conn, $sql_query);
    if(!$result) {
        return null;
    }
    $rows = mysqli_num_rows($result);
    $data = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    if($rows < 1 || $data["password"] != $password) {
        return false;
    }
    $user = new User($data["id"], $data["username"], $data["email"], $data["city"], $data["password"], $data["telephone"]);
    return logIn($user, $conn);
}

/**
 * Adds a user to a session
 * 
 * @param User $user    veriable that represents the user
 * 
 * @return boolean      true when the user is added to the SESSION
 */
function logIn($user, $conn) {
    $_SESSION["user"] = $user;
    $_SESSION["userId"] = $user->getId();
    $_SESSION["username"] = $user->getUsername();
    $_SESSION["email"] = $user->getEmail();
    $_SESSION["city"] = $user->getAddress();
    $_SESSION["password"] = $user->getPassword();
    $_SESSION["telephone"] = $user->getTelephone();
   
    $isAdnim ="SELECT is_admin FROM user WHERE username='" .$_SESSION['username']. "'";
    $fetchIsAdmin = mysqli_query($conn, $isAdnim);
    $row = mysqli_fetch_array($fetchIsAdmin);
    $_SESSION["isAdnim"] = $row['is_admin'];
    $getImg = "SELECT imgpath FROM user WHERE username='" .$_SESSION['username']. "'";
    $dataFetch = mysqli_query($conn, $getImg);
    $row = mysqli_fetch_array($dataFetch);
    $_SESSION["imgpath"] = $row['imgpath'];
    return true;
}
/****************************** *****************************/

function getCurrentUserData(){

}

function displayName(){
    if(isset($_SESSION['username'])){
        echo $_SESSION['username'];
    }else{
        echo '';
    }
}

function displayEmail(){
    if(isset($_SESSION['email'])){
        echo $_SESSION['email'];
    }else{
        echo '';
    }
}

function dipslayAddress(){
    if(isset($_SESSION['city'])){
        echo $_SESSION['city'];
    }else{
        echo '';
    }
}

function displayPassword(){
    if(isset($_SESSION['password'])){
        echo $_SESSION['password'];
    }else{
        echo '';
    }
}

function displayTelephone(){
    if(isset($_SESSION['telephone'])){
        echo $_SESSION['telephone'];
    }else{
        echo '';
    }
}

function displayImg(){
    if(isset($_SESSION['imgpath'])){
        echo $_SESSION['imgpath'];
    }else{
        echo '';
    }
}


/************* POSTS / COMMENTS / TAGS *************/

/********* SEARCH QUERIES **********/

/**
 * This function creates and returns an associated array of the data 
 * from all the posts of the user with an id equal to the $userId parameter
 * 
 * 
 * @param mysqli $conn      the connection to the serever
 * @param integer $userId   the id of the user that we want to get the posts from
 * 
 * @return mixed            returns an associated array of the data from all the
 *                          posts of a specific user or false if the search had no results
 */
function getUserPosts($conn, $userId) {
    $sql_query = "SELECT * FROM post WHERE id_user = '$userId' ORDER BY post_date DESC";
    $result = mysqli_query($conn, $sql_query);
    $rows = mysqli_num_rows($result);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    if($rows < 1) {
        return false;
    }
    return $data;
}

/**
 * This function creates and returns an associated array of the data 
 * from all the users that live in the same area as the one that the
 * parameter city represents
 * 
 * 
 * @param mysqli $conn      the connection to the serever
 * @param string $city      the area which we want to find the users that live there
 * 
 * @return mixed            returns an associated array of the data from all the
 *                          users that live in a specific area or false if the 
 *                          search had no results
 */

function getPostsFromArea($conn, $city) {
    $sql_query = "SELECT post.id, id_user, post.body, post.post_date 
                  FROM user, post 
                  WHERE user.city = '$city' AND id_user = user.id 
                  ORDER BY post_date DESC 
                  LIMIT 5";
    $result = mysqli_query($conn, $sql_query);
    $rows = mysqli_num_rows($result);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    if($rows < 1) {
        return false;
    }
    return $data;
}

/**
 * This function returns an associated array with the data from all 
 * the posts that have one or more of the tags in the array
 * 
 * 
 * @param mysqli  $conn             the connection to the serever
 * @param array   $tags             string array of the tags of a post
 * @param integer $numberOfPosts    string array of the tags of a post
 * 
 * @return mixed            returns an associated array with the data from all the
 *                          posts that have one or more of the tags in the array $tags
 */
function getPostsWithTag($conn, $tags, $numberOfPosts=30) {
    $where_query = getArrayWhereStatment($tags, "tag_name");
    $sql_query = "SELECT id, id_user, body, post_date
                  FROM post INNNER JOIN post_has_tags
                  ON id = post_id
                  INNER JOIN tag
                  ON id_tag = tag_id
                  WHERE $where_query
                  ORDER BY post_date DESC 
                  LIMIT $numberOfPosts";
    $result = mysqli_query($conn, $sql_query);
    $rows = mysqli_num_rows($result);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    if($rows < 1) {
        return false;
    }
    return $data;
}

/**
 * This function is used to get the ids of the tags inside the $tags array
 * 
 * 
 * @param mysqli  $conn     the connection to the serever
 * @param array   $tags     string array of the tags of a post
 * 
 * @return mixed            returns an associated array with the ids of all the tags
 *                          in the $tags array
 */
function getTagsId($conn, $tags) {
    $where_query = getArrayWhereStatment($tags, "tag_name");
    $sql_query = "SELECT id_tag FROM tag WHERE $where_query";
    $result = mysqli_query($conn, $sql_query);
    $rows = mysqli_num_rows($result);
    
    if($rows < 1) {
        return false;
    }
    return $result;
}

/**
 * This function is used to get the ids of the tags inside the $tags array
 * 
 * 
 * @param mysqli  $conn     the connection to the serever
 * 
 * @return mixed            returns an associated array with the names from all the tags
 *                          or false if there were no results;
 */
function getAllTags($conn) {
    $sql_query = "SELECT tag_name FROM tag ORDER BY tag_name";
    $result = mysqli_query($conn, $sql_query);
    $rows = mysqli_num_rows($result);
    
    if($rows < 1) {
        return false;
    }
    return $result;
}

function getCommentsForPost($conn, $post_id) {
    $sql_query = "SELECT id, body, comment_author, post_date
                  FROM comment
                  WHERE post_id = '$post_id'
                  ORDER BY post_date DESC";
    $result = mysqli_query($conn, $sql_query);
    $rows = mysqli_num_rows($result);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    if($rows < 1) {
        return false;
    }
    return $data;
}

/**
 * This function checks is a user with id equal to $userId is friends
 * with another user whose username is qual to $friendName
 * 
 * 
 * @param mysqli    $conn           the connection to the serever
 * @param integer   $userId         the id of the user that we want to see if he has a 
 *                                  specific friened
 * @param string    $friendName     a string of the username of a friend 
 * 
 * @return boolean          returns true if the user with id equal to $userId has
 *                          a friend with a username equal to$friendName
 */
function isFriendsWith($conn, $userId, $friendName) {
    $sql_query = "SELECT username 
                  FROM friend 
                  WHERE user_id = '$userId' AND username = '$friendName'";
    $result = mysqli_query($conn, $sql_query);
    $rows = mysqli_num_rows($result);
    mysqli_free_result($result);
    if($rows > 0) {
        return true;
    }
    return false;
}


/**
 * A function that finds and returns all the friends of a user, with id equal to
 * $userId
 * 
 * 
 * @param mysqli    $conn           the connection to the serever
 * @param integer   $userId         the id of the user
 * 
 * @return mixed            returns an associated array with the data of all the friends
 *                          of $userId or false if the search had no results 
 */
function getAllFriends($conn, $userId) {
    $sql_query = "SELECT * 
                  FROM friend 
                  WHERE user_id = '$userId'
                  ORDER BY username";
    $result = mysqli_query($conn, $sql_query);
    $rows = mysqli_num_rows($result);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    if($rows < 1) {
        return false;
    }
    return $data;
}

/**
 * 
 */
function getImagePath($conn, $username) {
    $id = getUserId($conn, $username);
    return getUserImage($conn, $id);
}

/**
 * A function that finds and returns all the users, whose usernames 
 * have a substring equal to $username
 * 
 * 
 * @param mysqli    $conn       the connection to the serever
 * @param string    $username   a substring of the users' username
 * 
 * @return mixed            returns an associated array with the data of all the users
 *                          whose usernames have a substring equal to $username
 *                          or false if the search had no results 
 */
function findUsers($conn, $username) {
    $sql_query = "SELECT * 
                  FROM user 
                  WHERE username LIKE '%$username%'
                  ORDER BY username ";
    $result = mysqli_query($conn, $sql_query);
    $rows = mysqli_num_rows($result);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    if($rows < 1) {
        return false;
    }
    return $data;
}

/**
 * A function that finds and returns all the users, whose area id equal to $area
 * 
 * 
 * @param mysqli    $conn   the connection to the serever
 * @param string    $area   the name of an area
 * 
 * @return mixed            returns an associated array with the data of all the users
 *                          whose area is equal to $area or false if the search had no results 
 */
function findUsersFromArea($conn, $area) {
    $sql_query = "SELECT * 
                  FROM user 
                  WHERE city = '$area'
                  ORDER BY username ";
    $result = mysqli_query($conn, $sql_query);
    $rows = mysqli_num_rows($result);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    if($rows < 1) {
        return false;
    }
    return $data;
}

/**
 * This function gets the username of a user and returns their data from the
 * database if that user exists
 * 
 * 
 * @param mysqli    $conn       the connection to the serever
 * @param string    $username   the username of a user
 * 
 * @return mixed            returns an associated array with the data from a users
 *                          whose username is equal to $username or false if the 
 *                          search had no results 
 */
function getUser($conn, $username) {
    $sql_query = "SELECT * 
                  FROM user 
                  WHERE username = '$username'";
    $result = mysqli_query($conn, $sql_query);
    $rows = mysqli_num_rows($result);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    if($rows < 1) {
        return false;
    }
    return $data;
}

/**
 * This function gets the username of a user and returns their id from the
 * database if that user exists
 * 
 * 
 * @param mysqli    $conn       the connection to the serever
 * @param string    $username   the username of a user
 * 
 * @return mixed            returns the id of the a users whose username 
 *                          is equal to $username or false if the search had no results 
 */
function getUserId($conn, $username) {
    $sql_query = "SELECT id 
                  FROM user 
                  WHERE username = '$username'";
    $result = mysqli_query($conn, $sql_query);
    $rows = mysqli_num_rows($result);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    if($rows !== 1) {
        return false;
    }
    return $data[0]["id"];
}

/**************** ****************/

/********* INSERT QUERIES **********/

/**
 * A function that adds the data of a post in the database
 * 
 * 
 * @param mysqli    $conn               the connection to the serever
 * @param integer   $userId             the id of a user
 * @param string    $body               the body text of a post
 * @param array     $tags               a string array that contains the names of the tags of the post
 * 
 * @return boolean          returns true if the post was created successfully or false if there was an error 
 */
function createPost($conn, $userId, $body, $tags=null) {
    $post_date = date('Y-m-d H:i:s');
    if(!$post_date) {
        return false;
    }
    $sql_query = "INSERT INTO post(id_user, body, post_date) VALUES ('$userId', '$body', '$post_date')";
    if(!mysqli_query($conn, $sql_query)) {
        return false;
    }
    if($tags === null)
        return true;
    $id = mysqli_insert_id($conn);
    return addTagsToPost($conn, $id, $tags);
}


function getPostsFromDB($conn){
    $getPostsQuery = "SELECT * FROM post ORDER BY post_date DESC";
    $result = mysqli_query($conn, $getPostsQuery);
    $rows = mysqli_num_rows($result);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    if($rows < 1) {
        return false;
    }
    return $data;
}

function  getUserImage($conn, $idUser){
    $findUsrImgQuery = "SELECT imgpath FROM user WHERE id= $idUser ";
    $result = mysqli_query($conn, $findUsrImgQuery);
    $row = mysqli_fetch_array($result);
    return $row['imgpath'];
}

function getUsernameByID($conn, $id){
    $getUsrnmQuery = "SELECT username FROM user WHERE id= $id";
    $result = mysqli_query($conn, $getUsrnmQuery);
    $row = mysqli_fetch_array($result);
    return $row['username'];
}


/**
 * A creates an association with the tags and a post in the database
 * 
 * 
 * @param mysqli    $conn               the connection to the serever
 * @param integer   $post_id            the id of a post
 * @param array     $tags               a string array that contains the names of tags
 * 
 * @return boolean          returns true if the association was created successfully or false if there was an error 
 */
function addTagsToPost($conn, $post_id, $tags) {
    $result = getTagsId($conn, $tags);
    
    if(!$result) {
        return false;
    }

    while ($row = mysqli_fetch_assoc($result)) {
        $tag_id = $row['id_tag'];
        $sql_query = "INSERT INTO post_has_tags(post_id, tag_id) VALUES ('$post_id', '$tag_id')";
        mysqli_query($conn, $sql_query);
    }
    mysqli_free_result($result);
    return true;
}

/**
 * Adds a friend to a user in the database
 * 
 * 
 * @param mysqli    $conn               the connection to the serever
 * @param integer   $userId             the id of a user
 * @param string    $friendName         the username of a friend
 * 
 * @return boolean          returns true if the friend was added successfully or false if there was an error 
 */
function addFriend($conn, $userId, $friendName) {
    $sql_query = "INSERT INTO friend(user_id, username) VALUES ('$userId', '$friendName')";
    if(mysqli_query($conn, $sql_query))
        return true;
    return false;
}

/**
 * Adds a comment to a post in the database
 * 
 * 
 * @param mysqli    $conn               the connection to the serever
 * @param integer   $posts_id           the id of a post
 * @param string    $body               the text body a post
 * 
 * @return boolean          returns true if the comment was added successfully or false if there was an error 
 */
function addComment($conn, $posts_id, $body, $commentAuthor) {
    $post_date = date('Y-m-d H:i:s');
    if(!$post_date) {
        return false;
    }
    $sql_query = "INSERT INTO comment(post_id, body, comment_author, post_date) VALUES ('$posts_id', '$body', '$commentAuthor', '$post_date')";
    if(!mysqli_query($conn, $sql_query)) {
        return false;

    }
    return true;
}

/*************** *****************/

/********* DELETE QUERIES **********/

/**
 * Deletes a post from the database with id equal to $id
 * 
 * 
 * @param mysqli    $conn   the connection to the serever
 * @param integer   $id     the id of a post
 * 
 * @return boolean          returns true if the post was deleted successfully or false if there was an error 
 */
function deletePost($conn, $id) {
    $sql_query = "DELETE FROM post WHERE id = '$id'";
    if(mysqli_query($conn, $sql_query)) 
        return true;
    return false;
}

/**
 * Function that deletes the association bettwen a post and the tags that the $tags array contains
 * 
 * 
 * @param mysqli    $conn        the connection to the serever
 * @param integer   $post_id     the id of a post
 * @param array     $tags        string array that contains the names of some tags
 * 
 * @return boolean               returns true if the association was deleted successfully or false if there was an error 
 */
function removeTagsToPost($conn, $post_id, $tags) {
    $result = getTagsId($conn, $tags);

    if(!$result) {
        return false;
    }

    while ($row = mysqli_fetch_assoc($result)) {
        $tag_id = $row['id'];
        $sql_query = "DELETE FROM post_has_tags WHERE post_id = $post_id AND tag_id = $tag_id";
        if(!mysqli_query($conn, $sql_query)) {
            return false;
        }
    }
    mysqli_free_result($result);
    return true;
}

/**
 * Deletes a comment from the database with id equal to $id
 * 
 * 
 * @param mysqli    $conn   the connection to the serever
 * @param integer   $id     the id of a comment
 * 
 * @return boolean          returns true if the comment was deleted successfully or false if there was an error 
 */
function deleteComment($conn, $id) {
    $sql_query = "DELETE FROM comment WHERE id = '$id'";
    if(mysqli_query($conn, $sql_query))
        return true;
    return false;
}

/**
 * Deletes the friend of the user with id equal to $userId, that has a username equal to $friendName
 * 
 * 
 * @param mysqli    $conn           the connection to the serever
 * @param integer   $userId         the id of a user
 * @param string    $friendName     the username of a friend
 * 
 * @return boolean                  returns true if the comment was deleted successfully or false if there was an error 
 */
function deleteFriend($conn, $userId, $friendName) {
    $sql_query = "DELETE FROM friend WHERE user_id = '$userId' AND username = '$friendName'";
    if(mysqli_query($conn, $sql_query))
        return true;
    return false;
}

function deleteUserFromDB($conn, $username){
   
    $delete_query = "DELETE FROM user WHERE username= '$username'";
    
    if(mysqli_query($conn,  $delete_query)){
      
        return true;
      
    }
    
    return false;
}

/***************** *****************/

/********* UPDATE QUERIES **********/

/**
 * Updates the body text of the comment with id equal to $id in the database
 * 
 * 
 * @param mysqli    $conn       the connection to the serever
 * @param integer   $id         the id of a comment
 * @param string    $newBody    the new body text of the comment
 * 
 * @return boolean              returns true if the comment was updated successfully or false if there was an error 
 */
function updateComment($conn, $id, $newBody) {
    $sql_query = "UPDATE comment SET body = '$newBody' WHERE id = '$id'";
    if(mysqli_query($conn, $sql_query))
        return true;
    return false;
}

/**
 * Updates the body text of the post with id equal to $id in the database
 * 
 * 
 * @param mysqli    $conn       the connection to the serever
 * @param integer   $id         the id of a post
 * @param string    $newBody    the new body text of the post
 * 
 * @return boolean              returns true if the post was updated successfully or false if there was an error 
 */
function updatePost($conn, $id, $newBody) {
    $sql_query = "UPDATE post SET body = '$newBody' WHERE id = '$id'";
    if(mysqli_query($conn, $sql_query))
        return true;
    return false;
}

/**
 * Updates the password a user with email equal to $email in the database
 * 
 * 
 * @param mysqli    $conn           the connection to the serever
 * @param string    $email          the id of a post
 * @param string    $newPassword    the new body text of the post
 * 
 * @return boolean                  returns true if the password was updated successfully or false if there was an error
 */
function updatePassword($conn, $email, $newPassword) {
    $sql_query = "UPDATE user SET password = '$newPassword' WHERE email = '$email'";
    if(mysqli_query($conn, $sql_query))
        return true;
    return false;
}

/***************** *****************/

/**
 * This function which creates a string that contains a costume "WHERE" statment to be used
 * in SQL queries. It is used when a query with unknown number of args in the 'WHERE' stament
 * needs to be used. For example if we need to access all the posts that contain one or more
 * tags. The names of the tags are provided in the $array and the column's name that contains 
 * the names of the tags is provided throught $columnName
 * 
 * @param array     $array          the values we are searching for
 * @param string    $columnName     the name of column of a table
 * 
 * @return  string                  returns a costum 'WHERE' statement
 */
function getArrayWhereStatment($array, $columnName) {
    $where_query = "( ";
    $numElements = count($array);
    for($i=0; $i<$numElements; $i++) {
        $elemnt = $array[$i];
        $where_query .= "$columnName = '$elemnt'";
        if($i+1 !== $numElements) {
            $where_query .= " OR ";
        }
    }
    $where_query .= ")";
    return $where_query;
}

/************************  *************************/
?>

