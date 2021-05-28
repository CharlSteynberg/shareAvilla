<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/18/2015
 * Time: 2:07 PM
 */
class G5Plus_Widget_Twitter extends  G5Plus_Widget {
    public function __construct() {
        $this->widget_cssclass    = 'widget-feeds';
        $this->widget_description = __( "Display your latest tweets", 'wolverine' );
        $this->widget_id          = 'g5plus-twitter';
        $this->widget_name        = __( 'G5Plus: Twitter', 'wolverine' );
        $this->settings           = array(
            'title'  => array(
                'type'  => 'text',
                'std'   => '',
                'label' => __( 'Title', 'wolverine' )
            ),
            'user_name' => array(
                'type'  => 'text',
                'std'   => '',
                'label' => __( 'User Name', 'wolverine' )
            ),
            'consumer_key' => array(
                'type'  => 'text',
                'std'   => '',
                'label' => __( 'Consumer Key', 'wolverine' )
            ),
            'consumer_secret' => array(
                'type'  => 'text',
                'std'   => '',
                'label' => __( 'Consumer Secret', 'wolverine' )
            ),
            'access_token' => array(
                'type'  => 'text',
                'std'   => '',
                'label' => __( 'Access Token', 'wolverine' )
            ),
            'access_token_secret' => array(
                'type'  => 'text',
                'std'   => '',
                'label' => __( 'Access Token Secret', 'wolverine' )
            ),
            'time_to_store' => array(
                'type'  => 'text',
                'std'   => '',
                'label' => __( 'Time To Store', 'wolverine' )
            ),
            'total_feed' => array(
                'type'  => 'text',
                'std'   => '',
                'label' => __( 'Total Feed', 'wolverine' )
            )
        );
        parent::__construct();
    }
    function widget($args, $instance) {
        if ( $this->get_cached_widget( $args ) )
            return;
        require_once('twitter/twitterclient.php');
        extract( $args, EXTR_SKIP );

        $title = (!empty( $instance['title'] ) ) ? $instance['title'] : '';
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
        $user_name = (!empty( $instance['user_name'] ) ) ? $instance['user_name'] : '';
        $consumer_key = (!empty( $instance['consumer_key'] ) ) ? $instance['consumer_key'] : '';
        $consumer_secret = (!empty( $instance['consumer_secret'] ) ) ? $instance['consumer_secret'] : '';
        $access_token = (!empty( $instance['access_token'] ) ) ? $instance['access_token'] : '';
        $access_token_secret = (!empty( $instance['access_token_secret'] ) ) ? $instance['access_token_secret'] : '';
        $time_to_store = (!empty( $instance['time_to_store'] ) ) ? $instance['time_to_store'] : '';
        $total_feed = (!empty( $instance['total_feed'] ) ) ? $instance['total_feed'] : '';

        $transient_feed_tweet = 'transient_feed_tweet';
        if(!empty($time_to_store) && is_numeric($time_to_store)) {
            $fetchedTweets = get_transient($transient_feed_tweet);
        } else {
            delete_transient($transient_feed_tweet);
        }

        $twitterClient = new TwitterClient(trim($consumer_key), trim($consumer_secret), trim($access_token), trim($access_token_secret));

        if(!isset($fetchedTweets) || !$fetchedTweets){
            $fetchedTweets = $twitterClient->getTweet(trim($user_name),$total_feed);
            if(!empty($time_to_store)  && is_numeric($time_to_store)) {
                set_transient($transient_feed_tweet, $fetchedTweets, 60 * $time_to_store);
            }
        }
        $class = array('widget-twitter-wrap');
        ob_start();
        $limitToDisplay = 0;
        if (!empty($fetchedTweets)) {
            $limitToDisplay = min($total_feed, count($fetchedTweets));
        }
        if ($limitToDisplay > 0) {

            ?>
            <?php echo $args['before_widget']; ?>
            <?php if ($title) {
                echo $args['before_title'] . $title . $args['after_title'];
            } ?>
            <div class="<?php echo join(' ',$class); ?>">
                <?php
                    for($i= 0; $i < $limitToDisplay; $i++) {
                    $tweet = $fetchedTweets[$i];
                    $text = $twitterClient->sanitize_links($tweet);
                    $time = $tweet->created_at;
                    $time = date_parse($time);
                    $uTime = mktime($time['hour'], $time['minute'], $time['second'], $time['month'], $time['day'], $time['year']);
                    ?>
                    <div class="widget-twitter-item">
                        <i class="fa fa-twitter"></i>
                        <span class="twitter-content"><?php echo $text;?></span>
                        <span class="twitter-time"><?php $twitterClient->get_the_time($uTime) ?></span>
                    </div>
                <?php } ?>
            </div>


            <?php echo $args['after_widget']; ?>
        <?php
        }
        $content =  ob_get_clean();
        echo wp_kses_post($content);
        $this->cache_widget( $args, $content );
    }
}


if (!function_exists('g5plus_register_widget_twitter')) {
    function g5plus_register_widget_twitter() {
        register_widget('G5Plus_Widget_Twitter');
    }
    add_action('widgets_init', 'g5plus_register_widget_twitter', 1);
}