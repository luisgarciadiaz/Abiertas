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
$abiertos_delete = new abiertos_delete();

// Run the page
$abiertos_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$abiertos_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fabiertosdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fabiertosdelete = currentForm = new ew.Form("fabiertosdelete", "delete");
	loadjs.done("fabiertosdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $abiertos_delete->showPageHeader(); ?>
<?php
$abiertos_delete->showMessage();
?>
<form name="fabiertosdelete" id="fabiertosdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="abiertos">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($abiertos_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($abiertos_delete->id->Visible) { // id ?>
		<th class="<?php echo $abiertos_delete->id->headerCellClass() ?>"><span id="elh_abiertos_id" class="abiertos_id"><?php echo $abiertos_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($abiertos_delete->toriginal->Visible) { // toriginal ?>
		<th class="<?php echo $abiertos_delete->toriginal->headerCellClass() ?>"><span id="elh_abiertos_toriginal" class="abiertos_toriginal"><?php echo $abiertos_delete->toriginal->caption() ?></span></th>
<?php } ?>
<?php if ($abiertos_delete->tnuevo->Visible) { // tnuevo ?>
		<th class="<?php echo $abiertos_delete->tnuevo->headerCellClass() ?>"><span id="elh_abiertos_tnuevo" class="abiertos_tnuevo"><?php echo $abiertos_delete->tnuevo->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$abiertos_delete->RecordCount = 0;
$i = 0;
while (!$abiertos_delete->Recordset->EOF) {
	$abiertos_delete->RecordCount++;
	$abiertos_delete->RowCount++;

	// Set row properties
	$abiertos->resetAttributes();
	$abiertos->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$abiertos_delete->loadRowValues($abiertos_delete->Recordset);

	// Render row
	$abiertos_delete->renderRow();
?>
	<tr <?php echo $abiertos->rowAttributes() ?>>
<?php if ($abiertos_delete->id->Visible) { // id ?>
		<td <?php echo $abiertos_delete->id->cellAttributes() ?>>
<span id="el<?php echo $abiertos_delete->RowCount ?>_abiertos_id" class="abiertos_id">
<span<?php echo $abiertos_delete->id->viewAttributes() ?>><?php echo $abiertos_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($abiertos_delete->toriginal->Visible) { // toriginal ?>
		<td <?php echo $abiertos_delete->toriginal->cellAttributes() ?>>
<span id="el<?php echo $abiertos_delete->RowCount ?>_abiertos_toriginal" class="abiertos_toriginal">
<span<?php echo $abiertos_delete->toriginal->viewAttributes() ?>><?php echo $abiertos_delete->toriginal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($abiertos_delete->tnuevo->Visible) { // tnuevo ?>
		<td <?php echo $abiertos_delete->tnuevo->cellAttributes() ?>>
<span id="el<?php echo $abiertos_delete->RowCount ?>_abiertos_tnuevo" class="abiertos_tnuevo">
<span<?php echo $abiertos_delete->tnuevo->viewAttributes() ?>><?php echo $abiertos_delete->tnuevo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$abiertos_delete->Recordset->moveNext();
}
$abiertos_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $abiertos_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$abiertos_delete->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$abiertos_delete->terminate();
?>