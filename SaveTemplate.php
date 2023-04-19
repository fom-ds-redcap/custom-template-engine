<?php
/**
 * Create an instance of the Custom Template Engine class,
 * and save template.
 */
$customTemplateEngine = new \BCCHR\CustomTemplateEngine\CustomTemplateEngine();
$result = $customTemplateEngine->saveTemplate($_POST["templateID"]);
print json_encode($result);