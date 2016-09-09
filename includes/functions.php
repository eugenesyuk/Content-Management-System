<?php

/* POSTS FUNCTIONS */
function get_blog_posts()
{
    global $connection;
    
    $limit = check_pagination_page();
    
    $query = "SELECT * FROM posts WHERE post_status = 'published' ORDER BY post_date DESC LIMIT ? , 6";
    $stmt = $connection->prepare($query);
    $stmt->bind_param('s', $limit);
    
    if (! $stmt->execute()) {
        die('Query error' . $stmt->error);
    } else {
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
            $post_author = $row['post_author'];
            $post_date = date('d F Y', strtotime($row['post_date']));
            $post_cat_id = $row['post_cat_id'];
            $post_category = get_post_category($post_cat_id);
            $post_image = $row['post_image'];
            $post_content = substr($row['post_content'], 0, 200) . "...";
            echo "
                    <div class='blog_listing'>
                        <div class='featured_image'>
                            <a href='#'><img src='" . HOMEURL . "uploads/posts/{$post_image}' alt=''></a>
                        </div>
                        <div class='blog_details'>
                            <h2><a href='#'>{$post_title}</a></h2>
                            <h4><a href='" . HOMEURL . "author.php?name={$post_author}'>{$post_author}</a> | {$post_date} | <a href='#'>{$post_category}</a></h4>
                            <p>{$post_content}</p>
                            <a class='btn btn_b_read' href='" . HOMEURL . "post.php?id={$post_id}'>Read More</a>
                        </div>
                    </div>";
        }
    }
}

function check_pagination_page()
{
    if (isset($_GET['page'])) {
        $number = (int) $_GET['page'];
    } else {
        $number = "";
    }
    
    if (empty($number) or $number == 1) {
        $limit = 0;
    } else {
        $limit = ($number * 6) - 6;
    }
    
    return $limit;
}

function latest_posts()
{
    global $connection;
    
    $limit = check_pagination_page();
    $query = "SELECT * FROM posts WHERE post_status = 'published' ORDER BY post_date DESC LIMIT ? , 6";
    $stmt = $connection->prepare($query);
    $stmt->bind_param('s', $limit);
    
    if (! $stmt->execute()) {
        die('Query error' . $stmt->error);
    } else {
        $stmt->bind_result($id, $cat_id, $title, $author, $date, $image, $content, $tags, $status, $views);
        while ($stmt->fetch()) {
            $post_id = $id;
            $post_title = $title;
            $post_author = $author;
            $post_date = date('d F Y', strtotime($date));
            $post_image = $image;
            $post_content = substr($content, 0, 200) . "...";
            
            echo "<div class='col-md-6 item'>";
            echo "<div class='blog_listing'>";
            echo "<div class='featured_image'>";
            echo "<a href='" . HOMEURL . "post.php?id={$post_id}'><img src='" . HOMEURL . "uploads/posts/{$post_image}' alt='Post image'></a>";
            echo "</div>";
            echo "<div class='blog_details'>";
            echo "<h2><a href='" . HOMEURL . "post.php?id={$post_id}'>{$post_title}</a></h2>";
            echo "<h4><a href='" . HOMEURL . "author.php?name={$post_author}'>{$post_author}</a> | {$post_date}</h4>";
            echo "<p>{$post_content}</p>";
            echo "<a class='btn btn_b_read' href='" . HOMEURL . "post.php?id={$post_id}'>Read More</a>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
    }
}

function recent_posts_widget()
{
    global $connection;
    
    $query = "SELECT * FROM posts WHERE post_status = 'Published' ORDER BY post_date DESC LIMIT 5";
    $stmt = $connection->prepare($query);
    
    if (! $stmt->execute()) {
        die('Query error' . $stmt->error);
    } else {
        $result = $stmt->get_result();
        
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            $post_id = $row['post_id'];
            $title = $row['post_title'];
            $post_title = (strlen($title) > 33 ? substr($title, 0, 32) . "..." : $title);
            echo "<li><a href='" . HOMEURL . "post.php?id={$post_id}'>{$post_title}</a></li>";
        }
        echo "</ul>";
    }
}

function get_category_title()
{
    global $connection, $category_title;
    
    if (isset($_GET['id'])) {
        $cat_id = (int) $_GET['id'];
        
        $stmt = $connection->prepare("SELECT cat_title FROM categories WHERE cat_id = ? LIMIT 1");
        $stmt->bind_param("s", $cat_id);
        
        if (! $stmt->execute()) {
            die("Query error" . $stmt->error);
        } else {
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $category_title = $row['cat_title'];
        }
    }
}

function get_category_posts()
{
    global $connection;
    
    if (isset($_GET['id'])) {
        $cat_id = (int) $_GET['id'];
        $limit = check_pagination_page();
        
        $stmt = $connection->prepare("SELECT * FROM posts WHERE post_cat_id = ? ORDER BY post_date DESC LIMIT ? , 6");
        $stmt->bind_param("ss", $cat_id, $limit);
        
        if (! $stmt->execute()) {
            die("Query error" . $stmt->error);
        } else {
            $result = $stmt->get_result();
            $count = $result->num_rows;
            if ($count == 0) {
                echo '<h1>No posts</h1>';
            } else {
                while ($row = $result->fetch_assoc()) {
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = date('d F Y', strtotime($row['post_date']));
                    $post_cat_id = $row['post_cat_id'];
                    $post_category = get_post_category($post_cat_id);
                    $post_image = $row['post_image'];
                    $post_content = substr($row['post_content'], 0, 200) . "...";
                    
                    echo "<div class='blog_listing'>";
                    echo "<div class='featured_image'>";
                    echo "<a href='#'><img src='" . HOMEURL . "uploads/posts/{$post_image}' alt=''></a>";
                    echo "</div>";
                    echo "<div class='blog_details'>";
                    echo "<h2><a href='#'>{$post_title}</a></h2>";
                    echo "<h4><a href='" . HOMEURL . "author.php?name={$post_author}'>{$post_author}</a> | {$post_date} | <a href='#'>{$post_category}</a></h4>";
                    echo "<p>{$post_content}</p>";
                    echo "<a class='btn btn_b_read' href='" . HOMEURL . "post.php?id={$post_id}'>Read More</a>";
                    echo "</div>";
                    echo "</div>";
                }
            }
        }
    }
}

function get_author_posts()
{
    global $connection;
    if (isset($_GET['name'])) {
        $limit = check_pagination_page();
        $author = strip_tags(trim($_GET['name']));
        $stmt = $connection->prepare("SELECT * FROM posts WHERE post_author = ? ORDER BY post_date DESC LIMIT ? , 6");
        $stmt->bind_param("ss", $author, $limit);
        
        if (! $stmt->execute()) {
            die("Query error" . $stmt->error);
        } else {
            $result = $stmt->get_result();
            $count = $result->num_rows;
            if ($count == 0) {
                echo '<h1>No posts</h1>';
            } else {
                while ($row = $result->fetch_assoc()) {
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = date('d F Y', strtotime($row['post_date']));
                    $post_cat_id = $row['post_cat_id'];
                    $post_category = get_post_category($post_cat_id);
                    $post_image = $row['post_image'];
                    $post_content = substr($row['post_content'], 0, 200) . "...";
                    echo "
                            <div class='blog_listing'>
                                <div class='featured_image'>
                                    <a href='#'><img src='" . HOMEURL . "uploads/posts/{$post_image}' alt=''></a>
                                </div>
                                <div class='blog_details'>
                                    <h2><a href='#'>{$post_title}</a></h2>
                                    <h4><a href='" . HOMEURL . "author.php?name={$post_author}'>{$post_author}</a> | {$post_date} | <a href='#'>{$post_category}</a></h4>
                                    <p>{$post_content}</p>
                                    <a class='btn btn_b_read' href='" . HOMEURL . "post.php?id={$post_id}'>Read More</a>
                                </div>
                            </div>";
                }
            }
        }
    }
}

function get_post()
{
    global $connection;
    
    if (isset($_GET['id'])) {
        $post_id = (int) $_GET['id'];
        
        $stmt = $connection->prepare("SELECT * FROM posts WHERE post_id = ?");
        $stmt->bind_param("s", $post_id);
        
        if (! $stmt->execute()) {
            die("Query error" . $stmt->error);
        } else {
            $result = $stmt->get_result();
            $count = $result->num_rows;
            if ($count == 0) {
                echo '<h1>No post finded</h1>';
            } else {
                while ($row = $result->fetch_assoc()) {
                    
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = date('d F Y', strtotime($row['post_date']));
                    $post_cat_id = $row['post_cat_id'];
                    $post_category = get_post_category($post_cat_id);
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];
                    echo "
                        <div class='blog_details_single'>
                            <!-- SINGLE BLOG FEATURED IMAGE -->
                            <div class='featured_image_single'>
                                <img src='" . HOMEURL . "uploads/posts/{$post_image}' alt=''>
                            </div>
                            <!-- SINGLE BLOG DETAILS -->
                            <div class='blog_content_single'>
                                <h2><a href='#'>{$post_title}</a></h2>
                                <h4><a href='" . HOMEURL . "author.php?name={$post_author}'>{$post_author}</a> | 
                                    {$post_date} | 
                                    {$post_category} ";
                    if (is_administrator())
                        echo ' | <a href="' . ADMINURL . 'posts.php?source=edit_post&p_id=' . $post_id . '">Edit</a> ';
                    echo "</h4><p>{$post_content}</p>
                            </div>
                        </div>";
                }
            }
        }
    }
}

function count_all_posts()
{
    global $connection;
    $query = "SELECT * FROM posts WHERE post_status = 'published'";
    $select = mysqli_query($connection, $query);
    
    return mysqli_num_rows($select);
}

function count_category_posts($id)
{
    global $connection;
    
    $cat_id = (int) $id;
    $stmt = $connection->prepare("SELECT * FROM posts WHERE post_cat_id = ? AND post_status = 'published'");
    $stmt->bind_param("s", $cat_id);
    
    if (! $stmt->execute()) {
        die("Query error" . $stmt->error);
    } else {
        $result = $stmt->get_result();
        return $result->num_rows;
    }
}

function count_author_posts($name)
{
    global $connection;
    
    $author = strip_tags(trim($name));
    $stmt = $connection->prepare("SELECT * FROM posts WHERE post_author = ? AND post_status = 'published'");
    $stmt->bind_param("s", $author);
    
    if (! $stmt->execute()) {
        die("Query error" . $stmt->error);
    } else {
        $result = $stmt->get_result();
        return $result->num_rows;
    }
}

function blog_pagination()
{
    $count = (int) count_all_posts();
    $amount = ceil($count / 6);
    
    if (isset($_GET['page'])) {
        $active = (int) $_GET['page'];
        $prev = $active - 1;
        $next = $active + 1;
    } else {
        $active = 1;
        $next = $active + 1;
    }
    
    if ($active > 1) {
        echo "<li>";
        echo "<a class='prev' href='" . HOMEURL . "blog.php?page={$prev}' aria-label='Previous'>Prev</a>";
        echo "</li>";
    }
    
    for ($i = 1; $i <= $amount; $i ++) {
        echo "<li" . ($i == $active ? " class='active'" : false) . ">";
        echo "<a href='" . HOMEURL . "blog.php?page={$i}'>{$i}</a>";
        echo "</li>";
    }
    
    if ($active < $amount) {
        echo "<li>";
        echo "<a class='next' href='" . HOMEURL . "blog.php?page={$next}' aria-label='Next'>Next</a>";
        echo "</li>";
    }
}

function latest_pagination()
{
    $count = (int) count_all_posts();
    $amount = ceil($count / 6);
    
    if (isset($_GET['page'])) {
        $active = (int) $_GET['page'];
        $prev = $active - 1;
        $next = $active + 1;
    } else {
        $active = 1;
        $next = $active + 1;
    }
    
    if ($active > 1) {
        echo "<li>";
        echo "<a class='prev' href='" . HOMEURL . "?page={$prev}' aria-label='Previous'>Prev</a>";
        echo "</li>";
    }
    
    for ($i = 1; $i <= $amount; $i ++) {
        echo "<li" . ($i == $active ? " class='active'" : false) . ">";
        echo "<a href='" . HOMEURL . "?page={$i}'>{$i}</a>";
        echo "</li>";
    }
    
    if ($active < $amount) {
        echo "<li>";
        echo "<a class='next' href='" . HOMEURL . "?page={$next}' aria-label='Next'>Next</a>";
        echo "</li>";
    }
}

function category_pagination()
{
    if (isset($_GET['id'])) {
        $id = (int) $_GET['id'];
        $count = (int) count_category_posts($id);
        $amount = ceil($count / 6);
        
        if (isset($_GET['page'])) {
            $active = (int) $_GET['page'];
            $prev = $active - 1;
            $next = $active + 1;
        } else {
            $active = 1;
            $next = $active + 1;
        }
        
        if ($active > 1) {
            echo "<li>";
            echo "<a class='prev' href='" . HOMEURL . "category.php?id={$id}&page={$prev}' aria-label='Previous'>Prev</a>";
            echo "</li>";
        }
        
        for ($i = 1; $i <= $amount; $i ++) {
            echo "<li" . ($i == $active ? " class='active'" : false) . ">";
            echo "<a href='" . HOMEURL . "category.php?id={$id}&page={$i}'>{$i}</a>";
            echo "</li>";
        }
        
        if ($active < $amount) {
            echo "<li>";
            echo "<a class='next' href='" . HOMEURL . "category.php?id={$id}&page={$next}' aria-label='Next'>Next</a>";
            echo "</li>";
        }
    }
}

function author_pagination()
{
    if (isset($_GET['name'])) {
        $name = strip_tags(trim($_GET['name']));
        $count = count_author_posts($name);
        $amount = ceil($count / 6);
        
        if (isset($_GET['page'])) {
            $active = (int) $_GET['page'];
            $prev = $active - 1;
            $next = $active + 1;
        } else {
            $active = 1;
            $next = $active + 1;
        }
        
        if ($active > 1) {
            echo "<li>";
            echo "<a class='prev' href='" . HOMEURL . "author.php?name={$name}&page={$prev}' aria-label='Previous'>Prev</a>";
            echo "</li>";
        }
        
        for ($i = 1; $i <= $amount; $i ++) {
            echo "<li" . ($i == $active ? " class='active'" : false) . ">";
            echo "<a href='" . HOMEURL . "author.php?name={$name}&page={$i}'>{$i}</a>";
            echo "</li>";
        }
        
        if ($active < $amount) {
            echo "<li>";
            echo "<a class='next' href='" . HOMEURL . "author.php?name={$name}&page={$next}' aria-label='Next'>Next</a>";
            echo "</li>";
        }
    }
}

/* END POSTS FUNCTIONS */

/* CATEGORIES FUNCTIONS */
function blog_categories()
{
    global $connection;
    $query = 'SELECT * FROM categories';
    $select_sidebar_categories = mysqli_query($connection, $query);
    
    if (! $select_sidebar_categories) {
        die("Query failed" . mysqli_error($connection));
    } else {
        while ($row = mysqli_fetch_assoc($select_sidebar_categories)) {
            $id = $row['cat_id'];
            $title = $row['cat_title'];
            echo "<li><a href='" . HOMEURL . "category.php?id={$id}'>{$title}</a></li>";
        }
    }
}

function get_category_title_by_post()
{
    global $connection, $category_title, $category_id;
    
    if (isset($_GET['id'])) {
        $post_id = (int) $_GET['id'];
        
        $stmt = $connection->prepare("SELECT post_cat_id FROM posts WHERE post_id = ? LIMIT 1");
        $stmt->bind_param("s", $post_id);
        
        if (! $stmt->execute()) {
            die("Query error" . $stmt->error);
        } else {
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $category_id = (int) $row['post_cat_id'];
            $category_title = get_post_category($category_id);
        }
    }
}

function get_post_category($id)
{
    global $connection;
    
    $stmt = $connection->prepare("SELECT * FROM categories WHERE cat_id = ?");
    $stmt->bind_param("s", $id);
    
    if (! $stmt->execute()) {
        die("Query error" . $stmt->error);
    } else {
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            return $row["cat_title"];
        }
    }
}

/* END CATEGORIES FUNCTIONS */

/* SEARCHING FUNCTIONS */
function search_by_tags()
{
    global $connection;
    
    if (isset($_POST['search'])) {
        $search = strip_tags(mysqli_real_escape_string($connection, $_POST['search']));
        $param = "%{$search}%";
        $query = $connection->prepare("SELECT * FROM posts WHERE post_tags LIKE ? ");
        $query->bind_param("s", $param);
        
        if (! $query->execute())
            die("Query error" . $query->error);
        
        $result = $query->get_result();
        $count = $result->num_rows;
        if ($count == 0) {
            echo '<h1>No result</h1>';
        } else {
            while ($row = $result->fetch_assoc()) {
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = date('d F Y', strtotime($row['post_date']));
                $post_cat_id = $row['post_cat_id'];
                $post_category = get_post_category($post_cat_id);
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];
                echo "
                        <div class='blog_listing'>
                            <div class='featured_image'>
                                <a href='#'><img src='" . HOMEURL . "uploads/posts/{$post_image}' alt=''></a>
                            </div>
                            <div class='blog_details'>
                                <h2><a href='#'>{$post_title}</a></h2>
                                <h4>POSTED BY <a href='#'>{$post_author}</a> | {$post_date} | <a href='#'>{$post_category}</a></h4>
                                <p>{$post_content}</p>
                                <a class='btn btn_b_read' href='#'>Read More</a>
                            </div>
                        </div>";
            }
        }
    }
}

function search_query()
{
    global $connection;
    
    if (isset($_POST['search'])) {
        $search = strip_tags(mysqli_real_escape_string($connection, $_POST['search']));
        echo $search;
    }
}

/* END SEARCHING FUNCTIONS */

/* COMMENTS FUNCTIONS */
function get_post_comments()
{
    global $connection;
    
    if (isset($_GET['id'])) {
        $post_id = (int) $_GET['id'];
        $status = "approved";
        $query = "SELECT * FROM comments WHERE comment_post_id = ? AND comment_status = ?";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("ss", $post_id, $status);
        
        if (! $stmt->execute()) {
            die("Query error" . $stmt->error);
        } else {
            $result = $stmt->get_result();
            $count = $result->num_rows;
            while ($row = $result->fetch_assoc()) {
                $comment_id = (int) $row['comment_id'];
                $comment_content = strip_tags(trim($row['comment_content']));
                $comment_author = strip_tags(trim($row['comment_author']));
                $comment_date = new DateTime($row['comment_date']);
                $date = $comment_date->format('d F Y');
                $time = $comment_date->format('H:i');
                $image = get_user_image_by_comment($comment_author);
                echo "
                         <li class='single-comment'>
                            <div class='comment_image'>
                                <img src='" . HOMEURL . "uploads/users/" . $image . "' alt=''>
                            </div>
                            <div class='comment_info'>
                                <h2><a href='#'>{$comment_author}</a></h2>
                                <h4>{$date} | {$time}</h4>
                                <p>{$comment_content}</p>
                                <a class='reply' href='#'>POST A REPLY</a>
                            </div>
                        </li>";
            }
        }
    }
}

function get_user_image_by_comment($author)
{
    global $connection;
    
    $author = mysql_real_escape_string($author);
    $query = "SELECT user_image FROM users WHERE username = '$author' LIMIT 1";
    $select_image = mysqli_query($connection, $query);
    
    if (! $select_image) {
        die("Query failed" . mysqli_error($connection));
    } else {
        $result = mysqli_fetch_assoc($select_image);
        return $result['user_image'];
    }
}

function add_comment()
{
    global $connection;
    
    if (isset($_POST['add_comment']) and isset($_GET['id']) and ! empty($_GET['id'])) {
        if (empty($_POST['comment_content'])) {
            $message = "Comment should not be empty";
            return false;
        }
        
        $comment_author = strip_tags(trim($_SESSION['username']));
        $comment_email = strip_tags(trim($_SESSION['user_email']));
        $comment_content = strip_tags(trim($_POST['comment_content']));
        $comment_date = date('d-m-y');
        $comment_post_id = (int) $_GET['id'];
        $comment_status = "approved";
        
        $query = $connection->prepare("INSERT INTO comments(comment_post_id,comment_author,comment_email,comment_content,comment_date,comment_status) VALUES(?,?,?,?,now(),?)");
        $query->bind_param("sssss", $comment_post_id, $comment_author, $comment_email, $comment_content, $comment_status);
        
        if (! $query->execute()) {
            die("Query error" . $query->error);
        } else {
            header("Location: " . HOMEURL . "post.php?id=" . $comment_post_id . "#comments");
        }
    }
}

/* END COMMENTS FUNCTIONS */

/* USERS FUNCTIONS */

/* END USERS FUNCTIONS */
function check_class($page = false)
{
    if ($page) {
        $active = str_replace(".php", "", basename($_SERVER['PHP_SELF']));
        echo ($active == $page ? 'class="active"' : false);
    }
}

function display_full_name()
{
    if (! empty($_SESSION['user_firstname']) and ! empty($_SESSION['user_lastname'])) {
        echo $_SESSION['user_firstname'] . " " . $_SESSION['user_lastname'];
    } else {
        echo $_SESSION['username'];
    }
}

function display_nick_name()
{
    if (! empty($_SESSION['username']) and ! empty($_SESSION['username'])) {
        echo $_SESSION['username'];
    } else
        echo "";
}

function display_role()
{
    if (isset($_SESSION['user_role']) and ! empty($_SESSION['user_role'])) {
        echo $_SESSION['user_role'];
    } else
        echo "";
}

function display_email()
{
    if (isset($_SESSION['user_email']) and ! empty($_SESSION['user_email'])) {
        echo $_SESSION['user_email'];
    } else
        echo "";
}

function display_firstname()
{
    if (isset($_SESSION['user_firstname']) and ! empty($_SESSION['user_firstname'])) {
        echo $_SESSION['user_firstname'];
    } else
        echo "";
}

function display_lastname()
{
    if (isset($_SESSION['user_lastname']) and ! empty($_SESSION['user_lastname'])) {
        echo $_SESSION['user_lastname'];
    } else
        echo "";
}

function display_image()
{
    if (isset($_SESSION['user_image']) and ! empty($_SESSION['user_image'])) {
        echo HOMEURL . "uploads/users/" . $_SESSION['user_image'];
    } else
        echo "";
}

function display_registration_date($mask = 'd-m-Y')
{
    if (isset($_SESSION['user_registered']) and ! empty($_SESSION['user_registered'])) {
        $registered = new DateTime($_SESSION['user_registered']);
        $registered = $registered->format($mask);
        echo $registered;
    } else
        echo "";
}

function user_loged_in()
{
    if (isset($_SESSION['username'])) {
        return true;
    } else
        return false;
}

function is_administrator()
{
    if (isset($_SESSION['user_role']) and $_SESSION['user_role'] == 'administrator') {
        return true;
    } else
        return false;
}

function is_subscriber()
{
    if (isset($_SESSION['user_role']) and $_SESSION['user_role'] == 'subscriber') {
        return true;
    } else
        return false;
}