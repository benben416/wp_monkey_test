<?php
/**
 * Plugin Name: Monkey Plugin
 * Description: Automatically post Monkey Noises
 * Version: 1.0
 * Author: Ben Baxter
 */

require('Monkey.php');

function monkey_init()
{

        monkey_doSubmit();

?>

        <br><br>
        <form  method="post">
                <table>
                        <tr>
                                <td><input type="text" name="num_monkey" value="<?php echo get_option( 'monkey_num' ); ?>"></td>
                                <td>How Many Monkeys?</td>
                        </tr>
                </table>

        <?php submit_button('Create Posts') ?>
        </form>

<?php 

}

function monkey_doSubmit() {

	$foods = array("cheese","bananas","pineapple");

        if(isset($_POST['num_monkey'])) {

	  $monkeys = $_POST['num_monkey'];
	  if(is_numeric($monkeys)) {

            update_option('monkey_num',$monkeys);


	    for($i = 1; $i <= $monkeys;  $i++) {
	      if(rand(0,1) == 0) {

		$m = new Monkey();

	      } else {

		$m = new HungryMonkey();
		$m->setFavoriteFood($foods[array_rand($foods)]);
	      }

	      // Feed the monkey
	      $m->eat(rand(0,20));


              $post_arr = array(
                'post_title'   => "Monkey $i Says...",
                'post_type'    => 'post',
                'post_content' => $m->makeNoise(),
                'post_status'  => 'publish',
                'post_author'  => get_current_user_id(),
                'meta_input'   => array(
                  'monkey_meta_id' => $i,
                ),
              );

              wp_insert_post( $post_arr , false);

            } // end for

	    echo "Successfuly Posted " . ( $i - 1 )  . " Monkeys";
          } // end if
        } // end if

}



add_action('admin_menu', 'monkey_plugin_setup_menu');

function monkey_plugin_setup_menu(){
      add_menu_page( 'Monkey Plugin Page', 'Monkey Plugin', 'manage_options', 'monkey-plugin', 'monkey_init' );
}



?>
