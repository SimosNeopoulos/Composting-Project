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
    $sql_query = "SELECT username FROM users WHERE username = '$username'";
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
    $sql_query = "SELECT email FROM users WHERE email = '$email'";
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
 * @param string $address   the address of the user that's being added
 * @param string $password  the password of the user that's being added
 * @param string $telephone the telephone of the user that's being added
 * 
 * @return boolean          returns true if the user didn't already exist and was
 *                          created successfully and false if there was a problem
 *                          with the creation of the user
 */
function signUp($conn, $username, $email, $address, $password, $telephone) {
     return addAccountToDB($conn, $username, $email, $address, $password, $telephone);
}

/**
 * Adding an acount to the database if the user didn't already exist and was
 * created successfully and logging him into the site
 * 
 * @param mysqli $conn      the connection to the serever
 * @param string $username  the username of the user that's being added
 * @param string $email     the email of the user that's being added
 * @param string $address   the address of the user that's being added
 * @param string $password  the password of the user that's being added
 * @param string $telephone the telephone of the user that's being added
 * 
 * @return boolean          returns true if the user didn't already exist and was
 *                          created successfully and false if there was a problem
 *                          with the creation of the user
 */
function addAccountToDB($conn, $username, $email, $address, $password, $telephone) {
    $sql_query = "INSERT INTO users(username, email, address, password, telephone, imgpath) VALUES ('$username', '$email', '$address', '$password','$telephone', '../images/profile-circle.png')";
    if(mysqli_query($conn, $sql_query)) {
        $id = mysqli_insert_id($conn);
        $user = new User($id, $username, $email, $address, $password, $telephone);
        if(logIn($user)) {
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
    $sql_query = "SELECT * FROM users WHERE email = '$email'";
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
    $user = new User($data["id"], $data["username"], $data["email"], $data["address"], $data["password"], $data["telephone"]);
    return logIn($user);
}

/**
 * Adds a user to a session
 * 
 * @param User $user    veriable that represents the user
 * 
 * @return boolean      true when the user is added to the SESSION
 */
function logIn($user) {
    $_SESSION["user"] = $user;
    $_SESSION["username"] = $user->getUsername();
    $_SESSION["email"] = $user->getEmail();
    $_SESSION["address"] = $user->getAddress();
    $_SESSION["password"] = $user->getPassword();
    $_SESSION["telephone"] = $user->getTelephone();
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
    if(isset($_SESSION['address'])){
        echo $_SESSION['address'];
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
    $sql_query = "SELECT * FROM posts WHERE id_user = '$userId' ORDER BY post_date DESC";
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
    $sql_query = "SELECT posts.id, id_user, posts.body, posts.post_date 
                  FROM users, posts 
                  WHERE users.address = '$city' AND id_user = users.id 
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
                  FROM posts INNNER JOIN posts_has_tags
                  ON id = posts_id
                  INNER JOIN tags
                  ON id_tag = tags_id
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
 * @param mysqli  $conn             the connection to the serever
 * @param array   $tags             string array of the tags of a post
 * 
 * @return mixed            returns an associated array with the ids of all the tags
 *                          in the $tags array
 */
function getTagsId($conn, $tags) {
    $where_query = getArrayWhereStatment($tags, "tag_name");
    $sql_query = "SELECT id FROM tags WHERE $where_query";
    $result = mysqli_query($conn, $sql_query);
    $rows = mysqli_num_rows($result);
    
    if($rows < 1) {
        return false;
    }
    return $result;
}

/**
 * This function checks is a user with id equal to $userId is friends
 * with another user whose username is qual to $friendName
 * 
 * 
 * @param mysqli    $conn               the connection to the serever
 * @param integer   $userId             the id of the user that we want to see if he has a 
 *                                      specific friened
 * @param string    $friendName         a string of the username of a friend 
 * 
 * @return boolean          returns true if the user with id equal to $userId has
 *                          a friend with a username equal to$friendName
 */
function isFriendsWith($conn, $userId, $friendName) {
    $sql_query = "SELECT username 
                  FROM friends 
                  WHERE users_id = '$userId' AND username = '$friendName'";
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
 * $userId, whose username have $friendName as a substring
 * 
 * 
 * @param mysqli    $conn               the connection to the serever
 * @param integer   $userId             the id of the user 
 * @param string    $friendName         a substring of the username of a friend 
 * 
 * @return mixed            returns an associated array with the data of all the friends
 *                          of $userId whose usernames have a substring equal to $friendName
 *                          or false if the search had no results 
 */
function findFriends($conn, $userId, $friendName) {
    $sql_query = "SELECT * 
                  FROM friends 
                  WHERE users_id = '$userId' AND username LIKE '%$friendName%'";
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
 * A function that finds and returns all the users, whose usernames 
 * have a substring equal to $username
 * 
 * 
 * @param mysqli    $conn               the connection to the serever
 * @param string    $username           a substring of the users' username
 * 
 * @return mixed            returns an associated array with the data of all the users
 *                          whose usernames have a substring equal to $username
 *                          or false if the search had no results 
 */
function findUsers($conn, $username) {
    $sql_query = "SELECT * 
                  FROM users 
                  WHERE username LIKE '%$username%'";
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
 * @param mysqli    $conn               the connection to the serever
 * @param string    $area               the name of an area
 * 
 * @return mixed            returns an associated array with the data of all the users
 *                          whose area is equal to $area or false if the search had no results 
 */
function findUsersFromArea($conn, $area) {
    $sql_query = "SELECT * 
                  FROM users 
                  WHERE address = '$area'";
    $result = mysqli_query($conn, $sql_query);
    $rows = mysqli_num_rows($result);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    if($rows < 1) {
        return false;
    }
    return $data;
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
function createPost($conn, $userId, $body, $tags) {
    $post_date = date('Y-m-d H:i:s');
    if(!$post_date) {
        return false;
    }
    $sql_query = "INSERT INTO posts(id_user, body, post_date) VALUES ('$userId', '$body', '$post_date')";
    if(!mysqli_query($conn, $sql_query)) {
        return false;
    }
    $id = mysqli_insert_id($conn);
    return addTagsToPost($conn, $id, $tags);
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
        $tag_id = $row['id'];
        $sql_query = "INSERT INTO posts_has_tags(posts_id, tags_id) VALUES ('$post_id', '$tag_id')";
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
    $sql_query = "INSERT INTO friends(users_id, username) VALUES ('$userId', '$friendName')";
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
    $sql_query = "INSERT INTO comments(posts_id, body, comment_author, post_date) VALUES ('$posts_id', '$body', '$commentAuthor', '$post_date')";
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
    $sql_query = "DELETE FROM posts WHERE id = '$id'";
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
        $sql_query = "DELETE FROM posts_has_tags WHERE posts_id = $post_id AND tags_id = $tag_id";
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
    $sql_query = "DELETE FROM comments WHERE id = '$id'";
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
    $sql_query = "DELETE FROM friends WHERE users_id = '$userId' AND username = '$friendName'";
    if(mysqli_query($conn, $sql_query))
        return true;
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
    $sql_query = "UPDATE comments SET body = '$newBody' WHERE id = '$id'";
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
    $sql_query = "UPDATE posts SET body = '$newBody' WHERE id = '$id'";
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

