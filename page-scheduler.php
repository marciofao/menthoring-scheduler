<?php global $post; ?>
<?php wp_head() ?>

<div class="container">
    <div class="row">
        <h1><?php echo get_the_title() ?></h1>
        <?php the_content() ?>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php if (!isset($_GET['appointment-saved'])) : ?>
                <form method="post" class="form-control" id="appointmentForm">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <label for="ms_date">Date</label>
                                <input type="date" name="ms_date" id="date" class="form-control" required>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="ms_time">Time</label>
                                <input type="time" name="ms_time" id="time" class="form-control" required>
                            </div>
                        </div>
                        <label for="ms_name">Mentee's Name</label>
                        <input type="text" name="ms_name" id="name" class="form-control" required>
                        <label for="ms_notes">Notes</label>
                        <textarea name="ms_notes" id="notes" cols="30" rows="10" class="form-control" required></textarea>
                        <input type="hidden" name="menthoring-scheduler" value="1">

                        <input type="submit" value="Create Appointment" class="btn btn-primary">

                    </div>
                </form>
            <?php else : ?>
                <h2 class="text-center">Appointment Saved Sucessfully!</h2>
                <div class="text-center">
                    <a href="<?php echo site_url() . '/' . $post->post_name ?>">Add new appointment</a>
                </div>
            <?php endif ?>
        </div>
    </div>
</div>
<script src="<?php echo plugin_dir_url(__FILE__) ?>js/validator.js"></script>

<?php wp_footer() ?>