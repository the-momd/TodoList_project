<?php defined('BASE_PATH') OR die("premition denied!");

/*** Auth Functions ***/

# get login user id
function getCurrentUserId(){
    return getLoggedInUser()->id ?? 0;
}



function isLoggedIn(){
    // dd($_SESSION);
    return isset($_SESSION['login']) ? true : false ;
}

function getLoggedInUser(){

    return $_SESSION['login'] ?? null;    
}

function getUserByEmail($email){
    global $pdo;
    $sql = "SELECT * FROM `users` where email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':email' => $email]);
    $records = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $records[0] ?? null; 
}

function logout(){
    unset($_SESSION['login']);
}

function login($email, $password){
    $user = getUserByEmail($email);
    if (is_null($user)) {
        message("No user found with email: $email");
        return false; // Return false if no user is found
    }

    // Assuming password is stored as a hashed value
    if (password_verify($password, $user->password)) {
        // Store user information in session
        $user->image = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $user->email ) ) );
        $_SESSION['login'] = $user;
        // dd($_SESSION);
        // message("Login successful!", 'success');
        // Proceed with login (e.g., start session, set cookies, etc.)
        return true; // Return the user object for further use
    } else {
        message("Invalid password.");
        return false; // Return false for invalid password
    }
}







function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

function isValidUsername($username) {
    // Username: 5-20 characters, letters, numbers, underscores only
    return preg_match('/^[a-zA-Z0-9_]{4,20}$/', $username);
}

function isValidPassword($password) {
    // Password: at least 8 characters long, include letters and numbers
    return preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/', $password);
}



function register($userData) {
    global $pdo;

    $name = $userData['name'];
    $email = $userData['email'];
    $password = $userData['password'];

    if (!isValidEmail($email)) {
        throw new Exception('Invalid email.');
    }
    if (!isValidUsername($name)) {
        throw new Exception('Invalid username.');
    }
    if (!isValidPassword($password)) {
        throw new Exception('Invalid password.');
    }

    $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :pass)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':name' => $name,
        ':email' => $email,
        ':pass' => password_hash($password, PASSWORD_DEFAULT),
    ]);

    return $stmt->rowCount() ? true : false;
}

    


