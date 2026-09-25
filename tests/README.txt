Place the included tests directory in local/courseimage/.

From the Moodle root, rebuild Behat definitions after adding the test:
  php admin/tool/behat/cli/init.php

Run this plugin test:
  php admin/tool/behat/cli/run.php --tags=@local_courseimage

The feature uses Moodle's standard filemanager field handling and is tagged @javascript.
