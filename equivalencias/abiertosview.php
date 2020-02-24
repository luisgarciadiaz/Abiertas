<?php
namespace PHPMaker2020\project1;

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	session_start(); // Init session data

// Output buffering
ob_start();

// Autoload
include_once "autoload.php";
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$abiertos_view = new abiertos_view();

// Run the page
$abiertos_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$abiertos_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$abiertos_view->isExport()) { ?>
<script>
var fabiertosview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fabiertosview = currentForm = new ew.Form("fabiertosview", "view");
	loadjs.done("fabiertosview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$abiertos_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $abiertos_view->ExportOptions->render("body") ?>
<?php $abiertos_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $abiertos_view->showPageHeader(); ?>
<?php
$abiertos_view->showMessage();
?>
<form name="fabiertosview" id="fabiertosview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="abiertos">
<input type="hidden" name="modal" value="<?php echo (int)$abiertos_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($abiertos_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $abiertos_view->TableLeftColumnClass ?>"><span id="elh_abiertos_id"><?php echo $abiertos_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $abiertos_view->id->cellAttributes() ?>>
<span id="el_abiertos_id">
<span<?php echo $abiertos_view->id->viewAttributes() ?>><?php echo $abiertos_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($abiertos_view->toriginal->Visible) { // toriginal ?>
	<tr id="r_toriginal">
		<td class="<?php echo $abiertos_view->TableLeftColumnClass ?>"><span id="elh_abiertos_toriginal"><?php echo $abiertos_view->toriginal->caption() ?></span></td>
		<td data-name="toriginal" <?php echo $abiertos_view->toriginal->cellAttributes() ?>>
<span id="el_abiertos_toriginal">
<span<?php echo $abiertos_view->toriginal->viewAttributes() ?>><?php echo $abiertos_view->toriginal->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($abiertos_view->tnuevo->Visible) { // tnuevo ?>
	<tr id="r_tnuevo">
		<td class="<?php echo $abiertos_view->TableLeftColumnClass ?>"><span id="elh_abiertos_tnuevo"><?php echo $abiertos_view->tnuevo->caption() ?></span></td>
		<td data-name="tnuevo" <?php echo $abiertos_view->tnuevo->cellAttributes() ?>>
<span id="el_abiertos_tnuevo">
<span<?php echo $abiertos_view->tnuevo->viewAttributes() ?>><?php echo $abiertos_view->tnuevo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$abiertos_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$abiertos_view->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$abiertos_view->terminate();
?>