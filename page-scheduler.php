<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title() ?></title>
    <?php wp_head() ?>
    <link rel="stylesheet" href="<?php echo plugin_dir_url( __FILE__ ) ?>css/bootstrap.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form action="" class="form-control" id="appointmentForm">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <label for="date">Date</label>
                                <input type="date" name="date" id="date" class="form-control" required>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="time">Time</label>
                                <input type="time" name="time" id="time" class="form-control" required>
                            </div>
                        </div>
                        <label for="name">Mentee's Name</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                        <label for="notes">Notes</label>
                        <textarea name="notes" id="notes" cols="30" rows="10" class="form-control" required></textarea>

                        <input type="submit" value="Create Appointment" class="btn btn-primary">

                    </div>
                </form>
            </div>
        </div>
        <script src="<?php echo plugin_dir_url( __FILE__ ) ?>js/validator.js"></script>

        <?php wp_footer() ?>
    </body>

</html>