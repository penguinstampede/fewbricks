<?php

/**
 * @todo Make sure that JSOn is used if it exists
 */

$fewbricks_success_message = false;
$fewbricks_error_message = false;

if (isset($_POST['fewbricks_buildjson'])) {
    $_POST['fewbricks_deletejson'] = true;
}

if (isset($_POST['fewbricks_deletejson'])) {

    if (file_exists(get_template_directory() . '/acf-json/')) {

        $files = glob(get_template_directory() . '/acf-json/*');

        foreach ($files AS $file) {
            unlink($file);
        }

        $fewbricks_success_message = 'ACF JSON files have been deleted.';

    } else {

        $fewbricks_error_message = 'There must be a folder named "acf-json" in the theme directory for ACF Local JSON to work.';

    }

}

if (isset($_POST['fewbricks_buildjson'])) {

    if (file_exists(get_template_directory() . '/acf-json/')) {

        global $fewbricks_save_json;
        $fewbricks_save_json = true;
        require(get_template_directory() . '/fewbricks/field-groups/init.php');

        $fewbricks_success_message = 'ACF JSON files have been saved.';

    } else {

        $fewbricks_error_message = 'There must be a folder named "acf-json" in the theme directory for ACF Local JSON to work.';

    }

}

?>

    <h2>Fewbricks</h2>

<?php
if ($fewbricks_success_message !== false) {
    ?>
    <div id="message" class="updated notice is-dismissible below-h2"><p><?php echo $success_message; ?></p>
        <button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span>
        </button>
    </div>
    <?php
}

?>

    <div class="wrap acf-settings-wrap">

        <div class="acf-box">

            <div class="title"><h3>Build local JSON</h3></div>

            <div class="inner">

                <form action="" method="post">

                    <p>Click the button below to build local JSON. Local JSON is an ACF feature which "is similar to
                        caching and both dramatically speeds up ACF and allows for version control over your field
                        settings". Read more about it at <a
                            href="http://www.advancedcustomfields.com/resources/local-json/" target="_blank">the ACF
                            site</a></p>

                    <p>Note that building JSON will first delete _all_ files in the acf-json directory.</p>
                    <input type="submit" name="fewbricks_buildjson" value="Build JSON" class="button"/>
                </form>

                <h4>Current files in acf-json</h4>

                <?php

                if (file_exists(get_template_directory() . '/acf-json/')) {

                    $files = glob(get_template_directory() . '/acf-json/*');

                    if (!empty($files)) {

                        echo '<ul>';

                        foreach ($files AS $file) {

                            echo '<li>' . basename($file) . '</li>';

                        }

                        echo '</ul>';

                    }

                } else {

                    echo 'The directory "acf-json" does not exist.';

                }

                ?>

            </div>

        </div>

        <div class="acf-box">

            <div class="title"><h3>Delete local JSON</h3></div>

            <div class="inner">

                <form action="" method="post">

                    <p>Click the button below to empty the folder containing the ACF Local JSON-files.</p>
                    <input type="submit" name="fewbricks_deletejson" value="Delete JSON" class="button"/>
                </form>

            </div>

        </div>

        <div class="acf-box">

            <div class="title"><h3>Developer mode</h3></div>

            <div class="inner">

                <p>By setting Fewbricks in developer mode, some extra debugging related to Febricks and ACF will become available. Also, every time a field group is registered, a check for duplicate keys will be carried out. You enable developer mode by setting a constant, preferrably in wp-config.php, named FEWBRICKS_DEV_MODE to true.</p>

                <p>If developer mode is enabled, you can also var dump the fields settings each time a field group is registered. This is done by adding a get variable named "dumpfewbricksfields" to any page. For example <a href="<?php echo get_option('home'); ?>/?dumpfewbricksfields" target="_blank"><?php echo get_option('home'); ?>/?dumpfewbricksfields</a></p>

            </div>

        </div>

    </div>


<?php

//require(__DIR__ . '/../field-groups/init.php');