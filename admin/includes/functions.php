<?php

    /* POSTS FUNCTIONS */

    function switch_posts_source() 
    {
        $source = (isset($_GET['source']) ? $_GET['source'] : "");
        
        switch($source) {
            case 'add_post':
                include("add-post.php");
                break;            
            case 'edit_post':
                include("edit-post.php");
                break;          
            default:
                include("posts-all.php");
        }      
    }    
    
    function posts_actions()
    {
        if(!isset($_POST['bulk_submit']))
        {
            delete_post();
        }
        else
        {
            posts_bulk_actions();
        }
    }

    function posts() 
    {
        global $connection;

        $query = 'SELECT * FROM posts ORDER BY post_date DESC';
        $select_all_posts = mysqli_query($connection,$query);

        if(!$select_all_posts)
        {
            die("Query failed". mysqli_error($connection));
        }
        else 
        {
            while($row = mysqli_fetch_assoc($select_all_posts))
            {

                $post_id = (int)$row['post_id'];
                $post_title = trim($row['post_title']);
                $post_author = trim($row['post_author']);
                $post_cat_id = trim($row['post_cat_id']);
                $post_date = new DateTime(trim($row['post_date']));
                $post_date = $post_date->format('d-m-Y');
            
                $post_tags = trim($row['post_tags']);
                $post_comment_count = get_post_comments_count($post_id);
                $post_status = trim($row['post_status']);
                $tags = explode(',',$post_tags);
                
                echo "<tr>";
                echo "<td>";
                    echo "<input type='checkbox' class='post-checkbox' name='checkBoxArray[]' value='".$post_id."'>";
                echo "</td>";
                echo "<td>";
                    echo "<a href='".HOMEURL."post.php?id=".$post_id."' target='_blank' data-toggle='tooltip' data-original-title='View'>";
                        echo "<b>".$post_title."</b>";
                    echo "</a>";
                echo "</td>";
                echo "<td><a href='".ADMINURL."posts.php?author=".$post_author."'>".$post_author."</a></td>";
                echo "<td>".get_post_category_title($post_cat_id)."</td>";      
                echo "<td>";
                foreach ($tags as $tag)
                { 
                    echo "<span class='label label-default'>{$tag}</span>";
                }
                echo "</td>";
                echo "<td>";
                    echo "<a href='".ADMINURL."comments.php?source=by_post&p_id={$post_id}'>";
                        echo "<span class='label label-primary count'>".$post_comment_count."</span>";
                    echo "</a>";
                echo "</td>";
                echo "<td>".$post_date."</td>";
                echo "<td class='status'>";
                    echo "<span class='label ".($post_status == 'published' ? "label-success" : "label-warning")."'>";
                        echo $post_status; 
                    echo "</span>";
                echo "</td>";
                echo "<td>";
                    echo '<div class="tools">';
                        echo '<button type="button" class="btn btn-table-control" data-toggle="tooltip" data-original-title="Edit"><a href="'.ADMINURL.'posts.php?source=edit_post&p_id='.$post_id.'"><i class="fa fa-edit"></i></a></button>';
                        echo '<button type="button" class="btn btn-table-control" data-toggle="tooltip" data-original-title="Delete"><a href="'.ADMINURL.'posts.php?delete_post&p_id='.$post_id.'"><i class="fa fa-trash-o"></i></a></button>';
                    echo '</div>';
                echo "</td>";
                echo "</tr>";
            } 
        }
    }    

    function get_post_comments_count($id)
    {
        global $connection;
        $post_id = (int)$id;
        
        $query = "SELECT * FROM comments WHERE comment_post_id = ?";
        $stmt = $connection->prepare($query);
        $stmt->bind_param('s',$post_id);
        
        if (!$stmt->execute())
        {
            die('Query error:' .$stmt->error);
        }
        else 
        {
            $result = $stmt->get_result();
            return $result->num_rows;
        }
    }

    function latest_posts_widget() 
    {
        global $connection;

        $query = 'SELECT * FROM posts ORDER BY post_date DESC LIMIT 10';
        $select_all_posts = mysqli_query($connection,$query);

        if(!$select_all_posts)
        {
            die("Query failed". mysqli_error($connection));
        }
        else 
        {
            while($row = mysqli_fetch_assoc($select_all_posts))
            {

                $post_id = (int)$row['post_id'];
                $post_title = trim($row['post_title']);
                $post_date = new DateTime(trim($row['post_date']));
                $post_date = $post_date->format('d-m-Y');
                $post_status = trim($row['post_status']);
                
                echo "<tr>";
                echo "<td>".$post_id."</td>";
                echo "<td>".$post_title."</td>";
                echo "<td>".$post_date."</td>";
                echo "<td class='status'>";
                    echo "<span class='label ".($post_status == 'published' ? "label-success" : "label-warning")."'>";
                        echo $post_status;
                    echo "</span>";
                echo "</td>";
                echo "<td>";
                    echo '<div class="tools">';
                        echo '<a href="'.HOMEURL.'post.php?id='.$post_id.'" target="_blank">View</a>';
                    echo '</div>';
                echo "</td>";
                echo "</tr>";
            } 
        }
    }    

    function count_table($table)
    {
        global $connection;
        $query = "SELECT * FROM $table";
        $select = mysqli_query($connection,$query);
        
        if(!$select)
        {
            die("Query failed". mysqli_error($connection));
        }
        else return mysqli_num_rows($select);
    }    
        
     function delete_post($id = false, $count = null) 
    {
        global $connection, $success;
        $post_id_to_delete = false;
        if($id)
        {
            $post_id_to_delete = $id;   
            $message = $count." post(s) was deleted";
        }
        else 
        {
            if(isset($_GET['delete_post']) and isset($_GET['p_id']) and !empty($_GET['p_id']))
            {
                $post_id_to_delete = (int)$_GET['p_id'];
                $message = "Post has been deleted";
            }
        }
        if($post_id_to_delete)
        {
            $query = $connection->prepare("DELETE FROM posts WHERE post_id = ?");
            $query->bind_param("s",$post_id_to_delete);

            if(!$query->execute())
            {
                die("Query error". $query->error);
            }
            else
            {
                $success = $message;
            }
        }
    }

    function get_post_data_to_edit()
    {
        global $connection, $get_post_data_id_to_get, $get_post_data_author, $get_post_data_title, $get_post_data_cat_id, $get_post_data_status, $get_post_data_image, $get_post_data_date, $get_post_data_tags, $get_post_data_content;
        
        if(isset($_GET['p_id']) and !empty($_GET['p_id']))
        {
            $get_post_data_id_to_get = (int)$_GET['p_id'];
            $query = $connection->prepare("SELECT * FROM posts WHERE post_id = ?");
            $query->bind_param("s",$get_post_data_id_to_get);

            if(!$query->execute())
            {
                die("Query error". $query->error);
            }
            else
            {
                $result = $query->get_result();
                while($row = $result->fetch_assoc())
                {
                    $get_post_data_author = $row['post_author'];
                    $get_post_data_title = $row['post_title'];
                    $get_post_data_cat_id = $row['post_cat_id'];
                    $get_post_data_status = $row['post_status'];
                    $get_post_data_image = $row['post_image'];
                    $get_post_data_date = $row['post_date'];
                    $get_post_data_tags = $row['post_tags'];
                    $get_post_data_content = $row['post_content'];
                }
            }
        } 
        else header('location: '.ADMINURL.'posts.php');
    }

    function edit_post()
    {
        global $connection, $edit_error, $success;
        
        if(isset($_POST['update_post']) and isset($_GET['p_id']) and !empty($_GET['p_id']))
        {
            $post_id = (int)$_GET['p_id'];
            $post_image = $_FILES['post_image']['name'];
            $post_image_temp = $_FILES['post_image']['tmp_name'];
            
            if(empty($post_image)) 
            {
                $q = $connection->prepare("SELECT post_image FROM posts WHERE post_id = ?");
                $q->bind_param("s",$post_id);
                $q->execute();
                $result = $q->get_result();
                $row = $result->fetch_assoc();
                $_FILES['post_image']['name'] = $row['post_image'];
                $post_image = $row['post_image'];
            }
            else move_uploaded_file($post_image_temp, ABSPATH."uploads/posts/$post_image"); 
             
            if($message = check_add_post_required())
            {
                $edit_error = $message;
                return false;
            }
            else
            {
                $post_author =  strip_tags(trim($_POST['post_author']));
                $post_title =  strip_tags(trim($_POST['post_title']));
                $post_cat_id =  strip_tags(trim($_POST['post_cat_id']));
                $post_status =  strip_tags(trim($_POST['post_status']));
                $post_tags =  strip_tags(trim($_POST['post_tags']));
                $post_date = date('d-m-y');
                $post_content = $_POST['post_content'];

                $query = "UPDATE posts SET ";
                $query .= "post_title = ? , ";
                $query .= "post_cat_id = ? , ";
                $query .= "post_date = now() , ";
                $query .= "post_author = ? , ";
                $query .= "post_status = ? , ";
                $query .= "post_tags = ? , ";
                $query .= "post_content = ? , ";
                $query .= "post_image = ? ";
                $query .= "WHERE post_id = ?";

                $stmt = $connection->prepare($query);
                $stmt->bind_param(
                    'ssssssss',
                    $post_title,
                    $post_cat_id,
                    $post_author,
                    $post_status,
                    $post_tags,
                    $post_content,
                    $post_image,
                    $post_id
                );

                if(!$stmt->execute())
                {
                    die("Query error". $query->error);
                }
                else
                {
                    $success = "Post has been updated. <a href='".HOMEURL."post.php?id=$post_id' target='_blank'>View post</a>";
                }
            }
        }
    }

    function get_post_category_title($id)
    {
        global $connection;
        
        if($id == 0) return '-';
        else 
        {
            $stmt = $connection->prepare("SELECT * FROM categories WHERE cat_id = ?");
            $stmt->bind_param("s",$id);

            if(!$stmt->execute())
            {
                die("Query error". $stmt->error);
            }
            else
            {
                $result = $stmt->get_result();
                while($row = $result->fetch_assoc())
                { 
                     return $row["cat_title"]; 
                }
            }
        }
    }

    function publish_post() 
    {
        global $publish_error;
        if(isset($_POST['create_post']))
        {
            if($message = check_add_post_required())
            {
                $publish_error  = $message;
                return false;
            }
            else save_new_post("published");
        }
        save_post_draft();
    }

    function save_post_draft()
    {
        global $draft_error;
        if(isset($_POST['save_draft']))
        {
            if($message = check_add_post_required())
            {
                $draft_error = $message;
                return false;
            }
            else save_new_post("draft"); 
        }
    }

    function check_add_post_required()
    {
        if(empty($_POST['post_title']))
        {
            return "Post title should not be empty";
        }
        else if (empty($_FILES['post_image']['name']))
        {
            return "Post image should not be empty";    
        } 
        else if (empty($_POST['post_content']))
        {
            return "Post content should not be empty";   
        }
        else
        {
            return false;
        } 
    }

    function save_new_post($post_status)
    {
        global $connection, $success;
        $post_author =  strip_tags(trim($_SESSION['username']));
        $post_title =  strip_tags(trim($_POST['post_title']));
        $post_cat_id =  strip_tags(trim($_POST['post_cat_id']));
        $post_tags =  strip_tags(trim($_POST['post_tags']));

        $post_image = $_FILES['post_image']['name'];
        $post_image_temp = $_FILES['post_image']['tmp_name'];

        $post_date = date('d-m-y');
        $post_content =  $_POST['post_content'];

        move_uploaded_file($post_image_temp, ABSPATH."uploads/posts/$post_image");
        
        $insert = "INSERT INTO posts(";
        $insert .= "  post_cat_id ";
        $insert .= ", post_title ";
        $insert .= ", post_author ";
        $insert .= ", post_date ";
        $insert .= ", post_image ";
        $insert .= ", post_content ";
        $insert .= ", post_tags ";
        $insert .= ", post_status ) ";
        $insert .= "VALUES(?,?,?,now(),?,?,?,?)";
        
        $query = $connection->prepare($insert);
        $query->bind_param(
            "ssssssss",
            $post_cat_id,
            $post_title,
            $post_author,
            $post_image,
            $post_content,
            $post_tags,
            $post_status
        );

        if(!$query->execute())
        {
            die("Query error". $query->error);
        }
        else
        {
            $success = "Post has been saved.  <a href='".HOMEURL."post.php?id=$connection->insert_id' target='_blank'>View post</a>";
        }
    }
        
    
    function get_post_status_select($selected) 
    {
            $options = array("published","draft");
            echo '<select name="post_status" class="selectpicker">';
            foreach ($options as $option)
            {
                echo "<option value='{$option}'".($option == $selected ? "selected" : "").">{$option}</option>";
            }
            echo '</select>';
    }
    
    function update_post_status($status = false, $id = false, $count = 1)
    {
        global $connection, $success;
        
        if($status and $id)
        {
            $query = "UPDATE posts SET ";
            $query .= "post_status = ? ";
            $query .= "WHERE post_id = ?";

            $stmt = $connection->prepare($query);
            $stmt->bind_param('ss', $status, $id);

            if(!$stmt->execute())
            {
                die("Query error". $query->error);
            }
            else
            {
                switch($status)
                {
                    case 'published':
                            $success = $count." post(s) was published";
                            break;
                    case 'draft':
                            $success = $count." post(s) was moved to draft(s)";
                            break;
                }       
            }
        }
    }
    
    function clone_post($id = false, $count = 1)
    {
        global $connection, $success;
        if($id)
        {
            $select = $connection->prepare("SELECT * FROM posts WHERE post_id = ? LIMIT 1");
            $select->bind_param("s",$id);

            if(!$select->execute())
            {
                die("Query error". $select->error);
            }
            else
            {
                $result = $select->get_result();
                $row = $result->fetch_assoc();
                
                $post_title = trim($row['post_title']);
                $post_title .= ' (Clone)';
                $post_author = trim($row['post_author']);
                $post_cat_id = trim($row['post_cat_id']);
                $post_image = trim($row['post_image']);
                $post_tags = trim($row['post_tags']);
                $post_content = trim($row['post_content']);
                $post_status = trim($row['post_status']);
                
                if($row)
                {
                    $insert = "INSERT INTO posts(";
                    $insert .= "  post_cat_id ";
                    $insert .= ", post_title ";
                    $insert .= ", post_author ";
                    $insert .= ", post_date ";
                    $insert .= ", post_image ";
                    $insert .= ", post_content ";
                    $insert .= ", post_tags ";
                    $insert .= ", post_status ) ";
                    $insert .= "VALUES(?,?,?,now(),?,?,?,?)";

                    $update = $connection->prepare($insert);
                    $update->bind_param(
                        "ssssssss",
                        $post_cat_id,
                        $post_title,
                        $post_author,
                        $post_image,
                        $post_content,
                        $post_tags,
                        $post_status
                    );

                    if(!$update->execute())
                    {
                        die("Query error". $query->error);
                    }
                    else
                    {
                        $success = $count." post(s) cloned";
                    }
                }
            }
        }
    }

    function posts_bulk_actions() {
        
        if(isset($_POST['bulk_submit']) and 
           isset($_POST['checkBoxArray']) and 
           isset($_POST['bulk_action']))
        {
            foreach($_POST['checkBoxArray'] as $idValue)
            {
                switch($_POST['bulk_action'])
                {
                    case 'published':
                            update_post_status( 'published', $idValue, count($_POST['checkBoxArray']) );
                            break;
                    case 'draft':
                            update_post_status( 'draft', $idValue, count($_POST['checkBoxArray']) );
                            break;
                    case 'delete':
                            delete_post( $idValue, count($_POST['checkBoxArray']) );
                            break;
                    case 'clone':
                            clone_post( $idValue, count($_POST['checkBoxArray']) );
                            break;
                }
            }
        }
    }

    /* END POSTS FUNCTIONS */

    /* CATEGORIES FUNCTIONS */
    
    function switch_cat_edit_forms() 
    {
        if(isset($_GET['edit']))
        {
            return include('includes/edit-category.php'); 
        }
        else
        {
            return include('includes/add-category.php');
        }
    }

    function categories_actions()
    {
        if(!isset($_POST['bulk_submit']))
        {
            insert_category();
            update_category();
            delete_category();
            edit_category();
        }
        else categories_bulk_actions();
    }

    function insert_category() 
    {
        global $connection, $insert_error, $success;
        if(isset($_POST["insert_category"])) 
        {
            if(empty($_POST["cat_title"]))
            {
                $insert_error = "Category name should not be empty";
                return false;
            } 
            else 
            {
                $cat_title = strip_tags(trim($_POST["cat_title"]));
            }
            
            $query = $connection->prepare("INSERT INTO categories(cat_title) VALUES(?)");
            $query->bind_param("s",$cat_title);

            if(!$query->execute())
            {
                die("Query error". $query->error);
            }
            else
            {
                $success = "Category has been created";
            }
        }
    }
    
    function edit_category() 
    {
        global $connection, $edit_input;
        if(isset($_GET['edit']))
        {
            $id_to_edit = (int)$_GET['edit'];
            $query = $connection->prepare("SELECT * FROM categories WHERE cat_id = ?");
            $query->bind_param("s",$id_to_edit);

            if(!$query->execute())
            {
                die("Query error". $query->error);
            }
            else
            {
                $result = $query->get_result();
                while($row = $result->fetch_assoc())
                {
                    $cat_id = $row["cat_id"];
                    $cat_title = $row["cat_title"];
                    $edit_input = '<input value="'.$cat_title.'" type="text" name="cat_title" class="form-control" placeholder="Enter new name">';
                }
            }
        }
    }

    function update_category() 
    {
        global $connection, $update_error, $success;
        if(isset($_POST["update_category"]) and isset($_GET['edit']))
        {   
            $id_to_edit = (int)$_GET['edit'];
            $title_to_update = strip_tags(trim($_POST["cat_title"]));
            if(empty($title_to_update))
            {
                $update_error = "Category name should not be empty";
            } 
            else 
            {
                $query = $connection->prepare("UPDATE categories SET cat_title = ? WHERE cat_id = ?");
                $query->bind_param("ss",$title_to_update,$id_to_edit);

                if(!$query->execute())
                {
                    die("Query error". $query->error);
                }
                else
                {
                    $success = "Category has been edited";
                }
            }
        }                                     
    }

    function get_all_categories() 
    {
        global $connection;
        $query = "SELECT * FROM categories";
        $select_categories = mysqli_query($connection,$query);
        if(!$select_categories)
        {
            die("Query failed". mysqli_error($connection));
        
        }
        else {
            while($row = mysqli_fetch_assoc($select_categories))
            {
                $cat_id = (int)$row["cat_id"];
                $cat_title = trim($row["cat_title"]);
                echo "<tr>";
                echo "<td><input type='checkbox' class='post-checkbox' name='checkBoxArray[]' value='".$cat_id."'></td>";
                echo "<td>{$cat_title}</td>";
                echo "<td>";
                    echo '<div class="tools">';
                        echo '<button type="button" class="btn btn-table-control" data-toggle="tooltip" data-original-title="Edit"><a href="'.ADMINURL.'categories.php?edit='.$cat_id.'"><i class="fa fa-edit"></i></a></button>';
                        echo '<button type="button" class="btn btn-table-control" data-toggle="tooltip" data-original-title="Delete"><a href="'.ADMINURL.'categories.php?delete='.$cat_id.'"><i class="fa fa-trash-o"></i></a></button>';
                    echo '</div>';
                echo "</td>";
                echo "</tr>";
            }
        }
    }

    function delete_category($id = false, $count = null) 
    {
        global $connection, $success;
        $id_to_delete = false;
        if($id)
        {
            $id_to_delete = $id;
            $message = $count." category(ies) deleted";
        }
        else 
        {
            if(isset($_GET['delete']) and !empty($_GET['delete']))
            {
                $id_to_delete = (int)$_GET['delete'];
                $message = "Category has been deleted";
            }
        }
        if($id_to_delete)
        {
            $query = $connection->prepare("DELETE FROM categories WHERE cat_id = ?");
            $query->bind_param("s",$id_to_delete);

            if(!$query->execute())
            {
                die("Query error". $query->error);
            }
            else
            {
                $success = $message;
            }
        }
    }

    function get_categories_select($id = "") 
    {
        global $connection;
        $query = "SELECT * FROM categories";
        $select_categories = mysqli_query($connection,$query);
        if(!$select_categories)
        {
            die("Query failed". mysqli_error($connection));
        
        }
        else {
            echo '<select name="post_cat_id" class="selectpicker">';
                echo '<option value="0">No category</option>';
                while($row = mysqli_fetch_assoc($select_categories))
                {
                    $cat_id = $row["cat_id"];
                    $cat_title = $row["cat_title"];
                    echo '<option value="'.$cat_id.'" '.($cat_id == $id ? "selected" : "").'>'.$cat_title.'</option>';
                }
            echo '</select>';
        }
    }
    
    function categories_bulk_actions() 
    {
        if(isset($_POST['bulk_submit']) and 
           isset($_POST['checkBoxArray']) and 
           isset($_POST['bulk_action']))
        {
            foreach($_POST['checkBoxArray'] as $idValue)
            {
                switch($_POST['bulk_action'])
                {
                    case 'delete':
                            delete_category( $idValue, count($_POST['checkBoxArray']) );
                            break;
                }
            }
        }
    }

    /* END CATEGORIES FUNCTIONS */

    /* COMMENTS FUNCTIONS */

    function switch_comments_source() 
    {
        $source = (isset($_GET['source']) ? $_GET['source'] : "");
        
        switch($source) {
            case 'by_post':
                include("comments-by-post.php");
                break;                  
            default:
                include("comments-all.php");
        }  
    }    
    
    function comments_actions()
    {
        if(!isset($_POST['bulk_submit']))
        {
            unapprove_comment();
            approve_comment();
            delete_comment();
        }
        else comments_bulk_actions();
    }

    function comments() 
    {
        global $connection;

        $query = 'SELECT * FROM comments ORDER BY comment_date DESC';
        $select_all_comments = mysqli_query($connection,$query);

        if(!$select_all_comments)
        {
            die("Query failed". mysqli_error($connection));
        }
        else 
        {
            while($row = mysqli_fetch_assoc($select_all_comments))
            {
                $comment_id = trim($row['comment_id']);
                $comment_content = htmlentities(trim($row['comment_content']),ENT_NOQUOTES);
                $comment_author = trim($row['comment_author']);
                $comment_date = new DateTime(trim($row['comment_date']));
                $date = $comment_date->format('d.m.Y');
                $time = $comment_date->format('H:i');
                $comment_email = trim($row['comment_email']);
                $comment_post_id = (int)$row['comment_post_id'];
                $comment_status = trim($row['comment_status']);
    
                echo "<tr>";
                echo "<td>";
                    echo "<input type='checkbox' class='post-checkbox' name='checkBoxArray[]' value='".$comment_id."'>";
                echo "</td>";
                echo "<td>".$comment_author."</td>";
                echo "<td style='max-width: 450px'>";
                    echo "<p>Submitted on <a>".$date."</a> at <a>".$time."</a></p>".$comment_content;
                echo "</td>";
                echo "<td class='status'>";
                    echo "<span class='label ".($comment_status == 'approved' ? "label-success" : "label-warning")."'>";
                        echo $comment_status; 
                    echo "</span>";
                echo "</td>";
                echo "<td><a href='".HOMEURL."post.php?id=".$comment_post_id."' target='_blank'>".get_post_title_by_comment($comment_post_id)."</a></td>";
                echo "<td><a href='".ADMINURL."comments.php?approve&id={$comment_id}'>Approve</a><br><a href='".ADMINURL."comments.php?unapprove&id={$comment_id}'>Unapprove</a><br><a href='".ADMINURL."comments.php?delete_comment&id={$comment_id}&p_id={$comment_post_id}'>Delete</a></td>";
                echo "</tr>";
            } 
        }
    }    

    function comments_by_post() 
    {
        global $connection;

        if(isset($_GET['p_id']) and !empty($_GET['p_id']))
        {
            $post_id = (int)strip_tags(trim($_GET['p_id']));
            $query = 'SELECT * FROM comments WHERE comment_post_id = ? ORDER BY comment_date DESC';
            $stmt = $connection->prepare($query);
            $stmt->bind_param('s', $post_id);
            
            if(!$stmt->execute())
            {
                die("Query failed". $stmt->error);
            }
            else 
            {
                $result = $stmt->get_result();
                while($row = $result->fetch_assoc())
                {
                    $comment_id = trim($row['comment_id']);
                    $comment_content = htmlentities(trim($row['comment_content']),ENT_NOQUOTES);
                    $comment_author = trim($row['comment_author']);
                    $comment_date = new DateTime(trim($row['comment_date']));
                    $date = $comment_date->format('d.m.Y');
                    $time = $comment_date->format('H:i');
                    $comment_email = trim($row['comment_email']);
                    $comment_post_id = (int)$row['comment_post_id'];
                    $comment_status = trim($row['comment_status']);

                    echo "<tr>";
                    echo "<td>";
                        echo "<input type='checkbox' class='post-checkbox' name='checkBoxArray[]' value='".$comment_id."'>";
                    echo "</td>";
                    echo "<td>".$comment_author."</td>";
                    echo "<td style='max-width: 450px'>";
                        echo "<p>Submitted on <a>".$date."</a> at <a>".$time."</a></p>".$comment_content;
                    echo "</td>";
                    echo "<td class='status'>";
                        echo "<span class='label ".($comment_status == 'approved' ? "label-success" : "label-warning")."'>";
                            echo $comment_status; 
                        echo "</span>";
                    echo "</td>";
                    echo "<td><a href='".HOMEURL."post.php?id=".$comment_post_id."' target='_blank'>".get_post_title_by_comment($comment_post_id)."</a></td>";
                    echo "<td><a href='".ADMINURL."comments.php?source=by_post&p_id={$comment_post_id}&approve&id={$comment_id}'>Approve</a><br><a href='".ADMINURL."comments.php?source=by_post&p_id={$comment_post_id}&unapprove&id={$comment_id}'>Unapprove</a><br><a href='".ADMINURL."comments.php?source=by_post&delete_comment&id={$comment_id}&p_id={$comment_post_id}'>Delete</a></td>";
                    echo "</tr>";
                } 
            }
        }
        else 
        {
            header('location: '.ADMINURL.'comments.php');
        }
    }    
    
    function comments_bulk_actions() {
        
        if(isset($_POST['bulk_submit']) and 
           isset($_POST['checkBoxArray']) and 
           isset($_POST['bulk_action']))
        {
            foreach($_POST['checkBoxArray'] as $idValue)
            {
                switch($_POST['bulk_action'])
                {
                    case 'approve':
                            approve_comment( $idValue, count($_POST['checkBoxArray']) );
                            break;
                    case 'unapprove':
                            unapprove_comment( $idValue, count($_POST['checkBoxArray']) );
                            break;
                    case 'delete':
                            delete_comment( $idValue, count($_POST['checkBoxArray']) );
                            break;
                }
            }
        }
    }

    function delete_comment( $id = false, $count = 1) 
    {
        global $connection, $success;
        $comment_id_to_delete = false;
        if($id)
        {
            $comment_id_to_delete = (int)$id;
            $message = $count." comment(s) deleted";
        }
        else 
        {
            if(isset($_GET['delete_comment']) and isset($_GET['id']) and !empty($_GET['id']))
            {
                $comment_id_to_delete = (int)$_GET['id'];
                $message = "Comment deleted";
            }
        }
        if($comment_id_to_delete)
        {            
            $query = $connection->prepare("DELETE FROM comments WHERE comment_id = ?");
            $query->bind_param("s",$comment_id_to_delete);

            if(!$query->execute())
            {
                die("Query error". $query->error);
            }
            else
            {
                $success = $message;
            }  
        }
    } 
  
    function approve_comment($id = false, $count = 1) 
    {
        global $connection, $success;
        $comment_id_to_approve = false;
        if($id)
        {
            $comment_id_to_approve = (int)$id;
            $message = $count." comment(s) approved";
        }
        else
        {
            if(isset($_GET['approve']) and isset($_GET['id']) and !empty($_GET['id']))
            {
                $comment_id_to_approve = (int)$_GET['id'];
                $message = "Comment approved";
            }
        }
        if($comment_id_to_approve)
        {
            $status = "approved";
            $query = $connection->prepare("UPDATE comments SET comment_status = ? WHERE comment_id = ?");
            $query->bind_param("ss",$status,$comment_id_to_approve);

            if(!$query->execute())
            {
                die("Query error". $query->error);
            }
            else
            {
                $success = $message;
            }
        }
    }    

    function unapprove_comment($id = false, $count = 1) 
    {
        global $connection, $success;
        $comment_id_to_unapprove = false;
         if($id)
        {
            $comment_id_to_unapprove = (int)$id;
            $message = $count." comment(s) unapproved";
        }
        else
        {
            if(isset($_GET['unapprove']) and isset($_GET['id']) and !empty($_GET['id']))
            {
                $comment_id_to_unapprove = (int)$_GET['id'];
                $message = "Comment unapproved";
            }
        }
        if($comment_id_to_unapprove)
        {
            $status = "unapproved";
            $query = $connection->prepare("UPDATE comments SET comment_status = ? WHERE comment_id = ?");
            $query->bind_param("ss",$status,$comment_id_to_unapprove);

            if(!$query->execute())
            {
                die("Query error". $query->error);
            }
            else
            {
                $success = $message;
            }
        }
    }

    function get_post_title_by_comment($id)
    {
        global $connection;
        $post_id = (int)$id;
        $query = "SELECT * FROM posts WHERE post_id = ?";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("s",$post_id);
        
        if(!$stmt->execute())
        {
            die("Query error". $query->error);
        }
        else
        {
            $result = $stmt->get_result();
            while($row = $result->fetch_assoc())
            {
                return trim($row["post_title"]);
            }
        }
    }    

    function display_error($message) 
    {
        if(!empty($message)) 
        {
            echo "<div class='callout callout-danger'><h4>Error:</h4><p>{$message}</p></div>"; 
        } 
    }    

    function display_success($message) 
    {
        if(!empty($message)) 
        {
            echo "<div class='callout callout-success'><h4>Success!</h4><p>{$message}</p></div>"; 
        } 
    }

    /* END COMMENTS FUNCTIONS */
   
    /* USERS FUNCTIONS */

    function switch_users_source() 
    {
        $source = (isset($_GET['source']) ? $_GET['source'] : "");
        
        switch($source) {
            case 'add_user':
                include("add-user.php");
                break;            
            case 'edit_user':
                include("edit-user.php");
                break;          
            default:
                include("users-all.php");
        }  
    }
    
    function users() 
    {
        global $connection;

        $query = 'SELECT * FROM users ORDER BY user_id DESC';
        $select_all_users = mysqli_query($connection,$query);

        if(!$select_all_users)
        {
            die("Query failed". mysqli_error($connection));
        }
        else 
        {
            while($row = mysqli_fetch_assoc($select_all_users))
            {

                $user_id = (int)$row['user_id'];
                $username = trim($row['username']);
                $user_firstname = trim($row['user_firstname']);
                $user_lastname = trim($row['user_lastname']);
                $user_email = trim($row['user_email']);
                $user_image = trim($row['user_image']);
                $user_role = trim($row['user_role']);
    
                echo "<tr>";
                echo "<td>";
                    echo "<input type='checkbox' class='post-checkbox' name='checkBoxArray[]' value='".$user_id."'>";
                echo "</td>";
                echo "<td><img src='".HOMEURL."uploads/users/{$user_image}' class='user-image' alt='User image'/>{$username}</td>";
                echo "<td>{$user_firstname} {$user_lastname}</td>";
                echo "<td><a href='mailto:{$user_email}'>{$user_email}</a></td>";
                echo "<td class='user-role'>{$user_role}</td>";
                echo "<td>".get_user_posts_count($username)."</td>";
                echo "<td>";
                    echo '<div class="tools">';
                        echo '<button type="button" class="btn btn-table-control" data-toggle="tooltip" data-original-title="Edit"><a href="'.ADMINURL.'users.php?source=edit_user&id='.$user_id.'"><i class="fa fa-edit"></i></a></button>';
                        echo '<button type="button" class="btn btn-table-control" data-toggle="tooltip" data-original-title="Delete"><a href="'.ADMINURL.'users.php?delete_user&id='.$user_id.'"><i class="fa fa-trash-o"></i></a></button>';
                    echo '</div>';
                echo "</td>";
                echo "</tr>";
            } 
        }
        delete_user();
    }    

    function get_user_posts_count($author)
    {
        global $connection;
        
        $query = "SELECT COUNT(*) AS posts_count FROM posts WHERE post_author = ?";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("s",$author);
        
        if(!$stmt->execute())
        {
            die("Query error". $stmt->error);
        }
        else
        {
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            return (int)$row["posts_count"];
            
        }
    }
    
    function add_user() 
    {
        global $connection, $add_user_error, $success;
        
        if(isset($_POST['add_user']))
        {    
            if(validate_email($_POST['user_email']))
            {
                $user_email = trim($_POST['user_email']);
            }
            else 
            {
                $add_user_error = "Email is incorrect";
                return false;
            }

            if(validate_username($_POST['username']))
            {
                $username = trim($_POST['username']);
            }
            else 
            {
                $add_user_error = "Username doesn't match requirements: ";
                $add_user_error .= "<ul>";
                $add_user_error .= "<li>Must be at least 6 characters</li>";
                $add_user_error .= "<li>Must contain only letters and numbers</li>";
                $add_user_error .= "</ul>";
                return false;
            }
            
            if(empty($_POST['user_password']) or empty($_POST['password_confirmation']))
            {
                $add_user_error = "Both Password and Repeat password fields are required";
                return false;
            }         
            
            if($_POST['user_password'] !== $_POST['password_confirmation'])
            {
                $add_user_error = "Password and Repeat password fields do not match";
                return false;
            }
            
            if(validate_password($_POST['user_password']))
            {
                $user_password = $_POST['user_password']."pepper";
            }
            else
            {
                $add_user_error = "Password doesn't match all requierements:";
                $add_user_error .= "<ul>";
                $add_user_error .= "<li>Must contain at least 1 number and 1 letter</li>";
                $add_user_error .= "<li>Must be at least 8 characters</li>";
                $add_user_error .= "<li>May contain any of these characters: !@#$%</li>";
                $add_user_error .= "</ul>";
                return false;
            }

            if($message = user_exists($username,$user_email))
            {
                $add_user_error = $message;
                return false;
            }
            
            $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));
            $user_firstname =  strip_tags(trim($_POST['user_firstname']));  
            $user_lastname =  strip_tags(trim($_POST['user_lastname']));
            $user_role =  strip_tags(trim($_POST['user_role']));
            $user_registered = date('d-m-y');
      
            $user_image = $_FILES['user_image']['name'];
            $user_image_temp = $_FILES['user_image']['tmp_name'];

            if(!empty($user_image)) 
            move_uploaded_file($user_image_temp, ABSPATH."uploads/users/$user_image");
            else $user_image = "noimage.jpg";
            
            $query = "INSERT INTO users (";
            $query .= "  username";
            $query .= ", user_password";
            $query .= ", user_firstname";
            $query .= ", user_lastname";
            $query .= ", user_email";
            $query .= ", user_image";
            $query .= ", user_role";
            $query .= ", user_registered";
            $query .= ", status";
            $query .= ")";
            $query .= "VALUES (?,?,?,?,?,?,?,now(),1)";
            
            $stmt = $connection->prepare($query);
            $stmt->bind_param(
                "sssssss",
                $username,
                $user_password,
                $user_firstname,
                $user_lastname,
                $user_email,
                $user_image,
                $user_role
            );

            if(!$stmt->execute())
            {
                die("Query error". $stmt->error);
            }
            else
            {
                $success = "User added";
            }
        }
    }
    
     
    function delete_user($id = false, $count = 1) 
    {
        global $connection, $success;
        
        if(isset($_GET['delete_user']) and isset($_GET['id']) and !empty($_GET['id']))
        {
            $user_id_to_delete = (int)$_GET['id'];
            $message = "User deleted";
        }
        else
        {
            $user_id_to_delete = (int)$id;
            $message = $count." user(s) deleted";
        }
        if($user_id_to_delete)
        {
            $query = $connection->prepare("DELETE FROM users WHERE user_id = ?");
            $query->bind_param("s",$user_id_to_delete);

            if(!$query->execute())
            {
                die("Query error". $query->error);
            }
            else
            {
                $success = $message;
            }
        }
    } 
    
    function user_exists($nickname,$email)
    {
        global $connection;
        $query = $connection->prepare("SELECT * FROM users WHERE username = ?");
        $query->bind_param("s",$nickname);
        
        if(!$query->execute())
        {
            die("Query error". $query->error);
        }
        else
        {
                $result = $query->get_result();
                if ($result->num_rows > 0)
                {
                    return "This nickname is already registered. Please choose another one.";
                }
                else 
                {
                    $stmt = $connection->prepare("SELECT * FROM users WHERE user_email = ?");
                    $stmt->bind_param("s",$email);

                    if(!$stmt->execute())
                    {
                        die("Query error". $query->error);
                    }
                    else 
                    {
                        $result = $stmt->get_result();
                        if ($result->num_rows > 0)
                        {
                            return "This email is already registered, please choose another one.";
                        }
                        else 
                        {
                            return false;
                        }
                    }
                }
        }
    }

    function check_email($email,$id)
    {
        global $connection;
        $stmt = $connection->prepare("SELECT * FROM users WHERE user_email = ?");
        $stmt->bind_param("s",$email);

        if(!$stmt->execute())
        {
            die("Query error". $query->error);
        }
        else 
        {
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            
            if ($row['user_email'] == $email and (int)$row['user_id'] !== (int)$id)
            {
                return "User with this email already exists, choose another one";
            }
            else 
            {
                return false;
            }
        }
    }

    function get_user_role_select($selected)
    {
        global $role_select;
        $options = array("subscriber","administrator");
            $role_select = '<select class="selectpicker" name="user_role">';
            foreach ($options as $option)
            {
                $role_select .= "<option value='{$option}'".($option == $selected ? "selected" : "").">{$option}</option>";
            }
            $role_select .= '</select>';
    }
    
    function edit_user()
    {
        global $connection, $user_id_to_get, $get_user_data_username, $get_user_data_firstname,
        $get_user_data_lastname, $get_user_data_email, $get_user_data_image, $get_user_data_role;
        
        if(isset($_GET['id']) and !empty($_GET['id']))
        {
            $user_id_to_get = $_GET['id'];
            $query = $connection->prepare("SELECT * FROM users WHERE user_id = ?");
            $query->bind_param("s",$user_id_to_get);

            if(!$query->execute())
            {
                die("Query error". $query->error);
            }
            else
            {
                $result = $query->get_result();
                while($row = $result->fetch_assoc())
                {
                    $get_user_data_username = trim($row['username']);
                    $get_user_data_firstname = trim($row['user_firstname']);
                    $get_user_data_lastname = trim($row['user_lastname']);
                    $get_user_data_email = trim($row['user_email']);
                    $get_user_data_image = trim($row['user_image']);
                    $get_user_data_role = trim($row['user_role']);
                }
            }
        } else header('location: '.ADMINURL.'users.php');
        edit_user_update($user_id_to_get, $get_user_data_image);
        get_user_role_select($get_user_data_role);
    }

    function edit_profile()
    { 
        $image = basename($_SESSION['user_image']);
        profile_update($_SESSION['user_id'], $image);
        get_user_role_select($_SESSION['user_role']);
    }

    function edit_user_update($id,$old_image) 
    {
        global $connection, $edit_error, $success;
        
        if(isset($_POST['update_user']))
        {
            if(validate_email($_POST['user_email']))
            {
                $user_email = trim($_POST['user_email']);
            }
            else 
            {
                $edit_error = "Email is incorrect";
                return false;
            }

            if($message = check_email($user_email,$id))
            {
                $edit_error = $message;
                return false;
            }
           
            $user_image = $_FILES['user_image']['name'];
            $user_image_temp = $_FILES['user_image']['tmp_name'];

            if(empty($user_image)) 
            {
                $_FILES['user_image']['name'] = $old_image;
                $user_image = $old_image;
            }
            else move_uploaded_file($user_image_temp, ABSPATH."uploads/users/$user_image"); 

            $user_firstname =  strip_tags(trim($_POST['user_firstname']));  
            $user_lastname =  strip_tags(trim($_POST['user_lastname']));

            $user_registered = date('d-m-y');
            
            if(isset($_POST['user_role']))
            {
                $user_role =  strip_tags(trim($_POST['user_role']));
            }
            else 
            {
                $user_role = $_SESSION['user_role'];
            }
            
            $query = "UPDATE users SET ";
            $query .= "  user_firstname = ? ";
            $query .= ", user_lastname = ? ";
            $query .= ", user_email = ? ";
            $query .= ", user_image = ? ";
            $query .= ", user_role = ? ";
            $query .= "WHERE user_id = ?";

            $stmt = $connection->prepare($query);
            $stmt->bind_param(
                'ssssss',
                $user_firstname,
                $user_lastname,
                $user_email,
                $user_image,
                $user_role,
                $id
            );

            if(!$stmt->execute())
            {
                die("Query error". $query->error);
            }
            else
            {
                if(!empty($_POST['user_password']))
                {
                    if ($_POST['user_password'] !== $_POST['password_confirmation'])
                    {
                        $edit_error = "New Password and Repeat New Password do not match.";
                        return false;
                    }
                    
                    if(!validate_password($_POST['user_password']))
                    {
                        $edit_error = "Password doesn't match all requierements:";
                        $edit_error .= "<ul>";
                        $edit_error .= "<li>Must contain at least 1 number and 1 letter</li>";
                        $edit_error .= "<li>Must be at least 8 characters</li>";
                        $edit_error .= "<li>May contain any of these characters: !@#$%</li>";
                        $edit_error .= "<ul>";
                        return false;
                    }
                        
                    $user_password = $_POST['user_password']."pepper";
                    $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));

                    $update = $connection->prepare("UPDATE users SET user_password = ? WHERE user_id = ?");
                    $update->bind_param("ss",$user_password,$id);

                    if(!$update->execute())
                    {
                        die("Query error". $query->error);
                    }
                    else
                    {
                        $success = "User updated";
                    }      
                }
                else
                {
                    $success = "User updated";
                }
            }
        }
    }
    
    function profile_update($id,$old_image) 
    {
        global $connection, $edit_error, $success;
        
        if(isset($_POST['update_user']))
        {
            if(validate_email($_POST['user_email']))
            {
                $user_email = trim($_POST['user_email']);
            }
            else 
            {
                $edit_error = "Email is incorrect";
                return false;
            }

            if($message = check_email($user_email,$id))
            {
                $edit_error = $message;
                return false;
            }
           
            $user_image = $_FILES['user_image']['name'];
            $user_image_temp = $_FILES['user_image']['tmp_name'];

            if(empty($user_image)) 
            {
                $_FILES['user_image']['name'] = $old_image;
                $user_image = $old_image;
            }
            else move_uploaded_file($user_image_temp, ABSPATH."uploads/users/$user_image"); 

            $user_firstname =  strip_tags(trim($_POST['user_firstname']));  
            $user_lastname =  strip_tags(trim($_POST['user_lastname']));

            $user_registered = date('d-m-y');
            
            $query = "UPDATE users SET ";
            $query .= "  user_firstname = ? ";
            $query .= ", user_lastname = ? ";
            $query .= ", user_email = ? ";
            $query .= ", user_image = ? ";
            $query .= "WHERE user_id = ?";

            $stmt = $connection->prepare($query);
            $stmt->bind_param(
                'sssss',
                $user_firstname,
                $user_lastname,
                $user_email,
                $user_image,
                $id
            );

            if(!$stmt->execute())
            {
                die("Query error". $query->error);
            }
            else
            {
                $_SESSION['user_firstname'] = $user_firstname;
                $_SESSION['user_lastname'] = $user_lastname;
                $_SESSION['user_email'] = $user_email;
                $_SESSION['user_image'] = $user_image;
                
                if(!empty($_POST['user_password']))
                {
                    if ($_POST['user_password'] !== $_POST['password_confirmation'])
                    {
                        $edit_error = "New Password and Repeat New Password do not match.";
                        return false;
                    }
                    
                    if(!validate_password($_POST['user_password']))
                    {
                        $edit_error = "Password doesn't match all requierements:";
                        $edit_error .= "<ul>";
                        $edit_error .= "<li>Must contain at least 1 number and 1 letter</li>";
                        $edit_error .= "<li>Must be at least 8 characters</li>";
                        $edit_error .= "<li>May contain any of these characters: !@#$%</li>";
                        $edit_error .= "<ul>";
                        return false;
                    }
                        
                    $user_password = $_POST['user_password']."pepper";
                    $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));

                    $update = $connection->prepare("UPDATE users SET user_password = ? WHERE user_id = ?");
                    $update->bind_param("ss",$user_password,$id);

                    if(!$update->execute())
                    {
                        die("Query error". $query->error);
                    }
                    else
                    {
                        $success = "Profile updated";
                    }   
                }
                else
                {
                    $success = "Profile updated";
                }
            }
        }
    }
    
     function login_user()
    {
        global $connection, $login_error;
         
        if(isset($_POST['login']))
        {
            if (validate_email($_POST['user_email']))
            {
                $user_email = trim($_POST['user_email']);
            }
            else
            {
                $login_error = "Email is incorrect.";
                return false;
            }
            
            if (!empty($_POST['user_password']))
            {
                $user_password = $_POST['user_password']."pepper";
            }
            else
            {
                $login_error = "Password field is required.";
                return false;
            }
                
            $query = "SELECT * FROM users WHERE user_email = ? and status = '1'";
            $stmt = $connection->prepare($query);
            $stmt->bind_param("s",$user_email);

            if(!$stmt->execute())
            {
                    die("Query error". $stmt->error);
            }
            else
            {
                $result = $stmt->get_result();
                if($result->num_rows == 1)
                {
                    $row = $result->fetch_assoc();
                    $password = $row['user_password'];

                    if(password_verify($user_password,$password))
                    {
                        $_SESSION['user_id'] = $row['user_id'];
                        $_SESSION['username'] = $row['username'];
                        $_SESSION['user_firstname'] = $row['user_firstname'];
                        $_SESSION['user_lastname'] = $row['user_lastname'];
                        $_SESSION['user_role'] = $row['user_role'];
                        $_SESSION['user_email'] = $row['user_email'];
                        $_SESSION['user_image'] = $row['user_image'];
                        $_SESSION['user_registered'] = $row['user_registered'];
                        
                        if (isset($_POST['remember']) and $_POST['remember'] == 'on')
                        {
                           
                        }
                        
                        if(isset($_POST['redirect']) and !empty($_POST['redirect']))
                        {
                            header('location: '.$_POST['redirect']);
                        }
                        else
                        {
                            header('location: '.ADMINURL);
                        }
                    }
                    else 
                    {
                         $login_error = "No active user with such Email/Password combination finded.";
                         return false;
                    }
                }
            }   
        }
    }    

     function register_user()
    {
        global $connection, $registration_error, $success;
         
        if(isset($_POST['register']))
        {
            if (!empty($_POST['username'])) 
            {
                if(validate_username($_POST['username']))
                {
                    $username = strip_tags(trim($_POST['username']));
                }
                else 
                {
                    $registration_error = "Username should be 6 characters at least. Only letters and numbers allowed";
                    return false;
                }
            }
            else
            {
                $registration_error = "Username should not be empty.";
                return false;
            }
            
            if (validate_email($_POST['user_email']))
            {
                $user_email = trim($_POST['user_email']);
            }
            else
            {
                $registration_error = "Email is incorrect.";
                return false;
            }
            
            if($message = user_exists($username,$user_email))
            {
                $registration_error = $message; 
                return false;
            }
            
            if (empty($_POST['user_password']) or empty($_POST['password_confirmation'])) 
            {
                $registration_error = "Password and Retype pasword are required.";
                return false;
            }
            
            if($_POST['user_password'] !== $_POST['password_confirmation'])
            {
                $registration_error = "Password and Confirmation do not match.";
                return false;
            }
            
            if(validate_password($_POST['user_password']))
            {
                $user_password = $_POST['user_password']."pepper";
            }
            else
            {
                $registration_error = "Password doesn't match all requierements:";
                $registration_error .= "<ul class='reg-error'>";
                $registration_error .= "<li class='text-red'><small>";
                $registration_error .= "Must contain at least 1 number and 1 letter";
                $registration_error .= "</small></li>";
                $registration_error .= "<li class='text-red'><small>";
                $registration_error .= "Must be at least 8 characters";
                $registration_error .= "</small></li>";  
                $registration_error .= "<li class='text-red'><small>";
                $registration_error .= "May contain any of these characters: !@#$%";
                $registration_error .= "</small></li>";
                $registration_error .= "</ul>";
                return false;
            }
            
            if(!isset($_POST['terms']) or $_POST['terms'] !== 'on')
            {
                $registration_error = "Please agree the terms";
                return false;
            }
            
            $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));
            
            $user_image = 'noimage.jpg';
            $user_role = 'subscriber';
            
            $insert = "INSERT INTO users (";
            $insert .= "  username";
            $insert .= ", user_password";
            $insert .= ", user_email";
            $insert .= ", user_image";
            $insert .= ", user_role";
            $insert .= ", user_registered";
            $insert .= ", status) ";
            $insert .= "VALUES (?,?,?,?,?,now(),1)";
            
            $query = $connection->prepare($insert);
            $query->bind_param(
                "sssss",
                $username,
                $user_password,
                $user_email,
                $user_image,
                $user_role
            );

            if(!$query->execute())
            {
                die("Query error". $query->error);
            }
            else
            {
                $success = "User succesfully registered.";
            } 
        }
    }
    
    function validate_email($email)
    {
        if(preg_match('/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/', $email)) return true;
        else return false;
    }

    function validate_password($password)
    {
        if(preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,50}$/', $password)) return true;
        else return false;
    }

    function validate_username($name)
    {
        if(preg_match('/^[a-zA-Z0-9]{6,50}$/', $name)) return true;
        else return false;
    }
           
    function display_full_name()
    {
        if(!empty($_SESSION['user_firstname']) or !empty($_SESSION['user_lastname']))
        {
            echo $_SESSION['user_firstname']." ".$_SESSION['user_lastname'];
        }
        else 
        {
            echo $_SESSION['username'];
        }
    }

    function display_nick_name()
    {
        if(!empty($_SESSION['username']))
        {
            echo $_SESSION['username'];
        }
        else echo "";
    }

    function display_role() {
        if(isset($_SESSION['user_role']) and !empty($_SESSION['user_role']))
        {
            echo $_SESSION['user_role'];
        }
        else echo "";
    }

    function display_email() {
        if(isset($_SESSION['user_email']) and !empty($_SESSION['user_email']))
        {
            echo $_SESSION['user_email'];
        }
        else echo "";
    }

    function display_firstname() {
        if(isset($_SESSION['user_firstname']) and !empty($_SESSION['user_firstname']))
        {
            echo $_SESSION['user_firstname'];
        }
        else echo "";
    }

    function display_lastname() {
        if(isset($_SESSION['user_lastname']) and !empty($_SESSION['user_lastname']))
        {
            echo $_SESSION['user_lastname'];
        }
        else echo "";
    }

    function display_image() {
        if(isset($_SESSION['user_image']) and !empty($_SESSION['user_image']))
        {
           echo HOMEURL."uploads/users/".$_SESSION['user_image']; 
        }
        else echo "";
    }

    function display_registration_date($mask = 'd-m-Y') {
        if(isset($_SESSION['user_registered']) and !empty($_SESSION['user_registered']))
        {
            $registered = new DateTime($_SESSION['user_registered']);
            $registered = $registered->format($mask);
            echo $registered;
        }
        else echo "";
    }

    function user_logged_in()
    {
        if (isset($_SESSION['username']))
        {
            return true;
        }
        else return false;
    }
    
    function logout_user()
    {
        unset($_SESSION['username']);
        unset($_SESSION['user_firstname']);
        unset($_SESSION['user_lastname']);
        unset($_SESSION['user_role']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_image']);
        unset($_SESSION['user_registered']);
        
        if(!empty($_GET['redirect']))
        {
            header('Location: '.$_GET['redirect']);
        }
        else 
        {
            header('Location: '.HOMEURL);
        }
    }

    function check_access($page)
    {
        switch($page)
        {
            case 'dashboard':
                return ( user_logged_in() ? true : false);
                break;
            case 'posts':
                return ( is_administrator() ? true : false);
                break;
            case 'comments':
                return ( is_administrator() ? true : false);
                break;
            case 'categories':
                return ( is_administrator() ? true : false);
                break;
            case 'users':
                return ( is_administrator() == 'administrator' ? true : false);
                break;
            case 'profile':
                return ( user_loged_in() ? true : false);
                break;
        }
    }
    
    function users_bulk_actions() {
        
        if(isset($_POST['bulk_submit']) and 
           isset($_POST['checkBoxArray']) and 
           isset($_POST['bulk_action']))
        {
            foreach($_POST['checkBoxArray'] as $idValue)
            {
                switch($_POST['bulk_action'])
                {
                    case 'delete':
                            delete_user( $idValue, count($_POST['checkBoxArray']) );
                            break;
                }
            }
        }
    }

       function user_loged_in()
    {
        if (isset($_SESSION['username']))
        {
            return true;
        }
        else return false;
    }

    function is_administrator()
    {
        if(isset($_SESSION['user_role']) and $_SESSION['user_role'] == 'administrator')
        {
            return true;
        }
        else return false;
    }    

    function is_subscriber()
    {
        if(isset($_SESSION['user_role']) and $_SESSION['user_role'] == 'subscriber')
        {
            return true;
        }
        else return false;
    }

    /* END USERS FUNCTIONS */

    function check_active($page,$source)
    {
        if($page)
        {
            $page = strtolower($page);
            $active = str_replace(".php","",basename($_SERVER['PHP_SELF']));
            return ($active == $page ? 'class="active"' : false);
        }
        
        if(isset($_GET['source']) and $_GET['source'] == $source)
        {
            return 'class="active"';
        }
    }

    function admin_navigation()
    {
        $nav = 
        [
            'nav_label' => 'MAIN NAVIGATION',
            'elements' => 
            [
                'dashboard' => 
                [
                    'title' => 'Dashboard',
                    'icon' => 'fa fa-dashboard',
                    'URL' => ADMINURL.'dashboard.php'
                ], 
                'posts' => 
                [
                    'title' => 'Posts',
                    'icon' => 'fa fa-edit',
                    'URL' => ADMINURL.'posts.php' , 
                    'child' => 
                    [
                        'all_posts' => 
                        [
                            'title' => 'All posts',
                            'icon' => 'fa fa-circle-o',
                            'URL' => ADMINURL.'posts.php'
                        ], 
                        'add_post' => 
                        [
                            'title' => 'Add post',
                            'icon' => 'fa fa-circle-o',
                            'URL' => ADMINURL.'posts.php?source=add_post'
                        ]
                    ]
                ],
                'categories' => 
                [
                    'title' => 'Categories',
                    'icon' => 'fa fa-server',
                    'URL' => ADMINURL.'categories.php'
                ], 
                'comments' => 
                [
                    'title' => 'Comments',
                    'icon' => 'fa fa-commenting',
                    'URL' => ADMINURL.'comments.php'
                ], 
                'users' => 
                [
                    'title' => 'Users',
                    'icon' => 'fa fa-users',
                    'URL' => ADMINURL.'users.php?source=all_users' , 
                    'child' => 
                    [
                        'all_users' => 
                        [
                            'title' => 'All users',
                            'icon' => 'fa fa-circle-o',
                            'URL' => ADMINURL.'users.php?source=all_users'
                        ], 
                        'add_user' => 
                        [
                            'title' => 'Add user',
                            'icon' => 'fa fa-circle-o',
                            'URL' => ADMINURL.'users.php?source=add_user'
                        ]
                    ]
                ], 
                'profile' => 
                [
                    'title' => 'Profile',
                    'icon' => 'fa fa-briefcase',
                    'URL' => ADMINURL.'profile.php'
                ]
            ]
        ];
                
        echo "<ul class='sidebar-menu'>";
            echo (!empty($nav['nav_label']) ? "<li class='header'>".$nav['nav_label']."</li>" : "");
            foreach ($nav['elements'] as $slug => $li)
            {
                if (check_access($slug))
                {
                    echo "<li ".check_active($slug,false).">";
                        echo "<a href='".$li['URL']."' title='".$li['title']."'>";
                            echo (!empty($li['icon']) ? "<i class='".$li['icon']."'></i> " : "");
                            echo "<span>".$li['title']."</span>";
                            echo (!empty($li['child']) ? "<i class='fa fa-angle-left pull-right'></i>" : "");
                        echo "</a>";
                        if(!empty($li['child']))
                        {
                            echo "<ul class='treeview-menu'>";
                                    foreach ($li['child'] as $slug => $option)
                                    {
                                        echo "<li ".check_active(false,$slug).">";
                                            echo "<a href='".$option['URL']."' title='".$option['title']."'>";
                                                echo (!empty($option['icon']) ? "<i class='".$option['icon']."'></i> " : "");
                                                echo "<span>".$option['title']."</span>";
                                            echo "</a>";
                                        echo "</li>";   
                                    }
                            echo "</ul>";  
                        }
                    echo "</li>";
                }
            }
        echo "</ul>";
    }