<?php
/**
 * Template Name: Climber Profile
 */
get_header(); ?>

<?php $climber_username = $wp_query->query_vars['climber_username']; ?>
<?php $climber = get_user_by('login', $climber_username); ?>

<div class="container py-5">
    <div id="climber-profile">
        <div class="profile-header mb-5">
            <div class="row">
                <div class="col-lg-4">
                    <img src="<?php echo get_avatar_url( $climber ); ?>" alt="<?php echo $climber->display_name; ?>" class="float-left">
                    
                    <div class="climber-info px-3 float-left">
                        <h1 class="h5 mb-1"><?php echo $climber->display_name; ?></h1>
                        <p class="text-muted">Joined <?php echo App\Climber::member_since($climber); ?></p>
                    </div>

                </div>
                <div class="col-lg-8">
                    <div class="card-deck">
                        <div class="card bg-light border-0 rounded-0">
                            <div class="card-body text-center">
                                <p class="small text-muted">Average Climb Rating</p>
                                <p class="display-4">
                                    <?php echo App\Climber::average_rating($climber); ?>
                                </p>
                            </div>
                        </div>
                        <div class="card bg-light border-0 rounded-0">
                            <div class="card-body text-center">
                                <p class="small text-muted">Total Attempts</p>
                                <p class="display-4">
                                    <?php echo App\Climber::attempt_count($climber); ?>
                                </p>
                            </div>
                        </div>
                        <div class="card bg-light border-0 rounded-0">
                            <div class="card-body text-center">
                                <p class="small text-muted">Success Rate</p>
                                <p class="display-4">
                                    <?php echo App\Climber::success_rate($climber); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- <p class="text-muted">
                        <?php echo get_the_author_meta('description', $climber->ID ); ?>
                    </p> -->
                </div>
            </div>
        </div>
        <div class="profile-stats mb-4">
  
        </div>

        <?php 
            $attempts_query = new WP_Query([
                'post_type' => 'attempt',
                'meta_key'  => 'attempt_climber',
                'meta_value'  => $climber->ID,
            ]);
        ?>

        <h2 class="mb-4">Recent Attempts</h2>

            <?php if( $attempts_query->have_posts() ): ?>
            
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th>Climb</th>
                        <th>Rating</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($attempts_query->have_posts()): ?>
                        <?php $attempts_query->the_post(); ?>
                            <?php $climb = get_field('attempt_climb'); ?>

                            <tr>
                                <td>
                                    <a href="<?php echo get_permalink($climb); ?>">
                                        <?php echo $climb->post_title; ?>
                                    </a>
                                </td>
                                <td><?php echo App\Climb::convert_rating( get_field('climb_rating', $climb) ); ?></td>
                                <td><?php the_field('attempt_date'); ?></td>
                            </tr>
        
                    <?php endwhile; ?>
                </tbody>
            </table>

            <?php else: ?>
            <p class="text-muted">No Recent Attempts</p>
            <?php endif; ?>

    </div>
</div>

<?php get_footer(); ?>