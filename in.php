<?php
/**
*Plugin Name : TODO
*Description : describe 
*Version:1.1
*/

add_action('init','my_custom_post_type');
function my_custom_post_type()
{
	register_post_type( 'todos',$args= array(
    'label' => 'My Todos List',
    'public' => true,
    'menu_icon' => 'dashicons-editor-ul',
    'shoe_ui' => true,
    'show_in_nav_menus' => true,
    'name' => 'Todo List',
    'description' => 'This is our custom post type',
	));

}
add_shortcode('todo_list','shortcode_todo_list');

function shortcode_todo_list(){
	ob_start();
	?>
	<div class="todo-list-wrapper">
		<h2>My Todo Lists</h2>
		<div class="todo-list">
			<?php
			$args=array(
                'post_type' => 'todos',
                'posts_per_page' => -1,
                'post_status' => 'publish',
			);
			$query = new wp_query($args);
			if ($query->have_posts()) :
				echo '<p>';

                while ($query->have_posts()) : $query->the_post();
	                 $postId=get_the_ID();


                     echo  '<a href="'.get_permalink($postId).'">  '. get_the_title() . '</a></br>';
                        endwhile;
                    echo '</p>';
                        wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>
        <?php
        $content = ob_get_contents();
        ob_end_clean();
        return $content;				
    }
?>