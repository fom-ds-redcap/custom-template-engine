<?php

/**
 * Create instsance of Custom Template Engine, and display template 
 * filled with REDcap data on Fill Template page.
 */
$customTemplateEngine = new \BCCHR\CustomTemplateEngine\CustomTemplateEngine();

$template_id = $_POST["template"];
$template_data = REDCap::getData([
    "project_id" => $customTemplateEngine->getSystemSetting("config-pid"),
    "return_format" => "json",
    "records" => $template_id,
    "fields" => "full_html"
]);
$template_data = json_decode($template_data, true)[0];
$template_html = $template_data["full_html"];

$file_path = $customTemplateEngine->getSystemSetting("templates-folder") . "project" . $_GET["pid"] . "_template" . $template_id . ".html";

file_put_contents($file_path, $template_html);

if (sizeof($_POST["participantID"]) == 1)
{
    /**
     * Include REDCap header.
     */
    require_once APP_PATH_DOCROOT . "ProjectGeneral/header.php";

    $customTemplateEngine->generateFillTemplatePage();

    /**
     * Include REDCap footer.
     */
    require_once APP_PATH_DOCROOT . "ProjectGeneral/footer.php";
}
else
{
    $customTemplateEngine->batchFillReports();
}