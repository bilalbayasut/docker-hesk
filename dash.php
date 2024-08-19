<?php

// This function is an easy way for the end user to delete the install directory (a requirement of Hesk after setup)
    function remove_install() {
        shell_exec("rm -r install");
    }

// The dump function will be used to dump our database and place it into the bound data volume (specified in docker-compose.yml)
    function dump() {
        shell_exec("mysqldump -u root hesk > /public_html/data/dump.sql && cp /public_html/hesk_settings.inc.php /public_html/data");
    }
// The restore function will restore the dump.sql file found in the data volume.
    function restore() {
        shell_exec("mysql -u root hesk < /public_html/data/dump.sql && rm -r /public_html/install && cp /public_html/data/hesk_settings.inc.php /public_html");
    }

//The following if statements will execute the functions as supplied by the links at the bottom of this document.
    if (isset($_GET['rminstall'])) {
        remove_install();
    } elseif (isset($_GET['dump'])) {
        dump();
    } elseif (isset($_GET['restore'])) {
        restore();
    }
?>

<style>
    body {
        display:flex;
        align-items:center;
        flex-direction:column;
    }
    a {
        padding:2rem;
        width:10rem;
        text-align:center;
        margin:1rem;
        border:1px solid gray;
        color:black;
        text-decoration: none;
    }
</style>

<!-- The following anchors will provide a streamlined way for the end user to execute the required commands without needing technical knowledge -->

<a href="?dump=true">Dump Database</a>
<a href="dash.php?rminstall=true">Remove Install Dir</a>
<a href="?restore=true">Restore Database</a>
<a href="/admin/admin_main.php" target="_blank">Admin</a>
