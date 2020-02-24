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
$bdv_delete = new bdv_delete();

// Run the page
$bdv_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$bdv_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fbdvdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fbdvdelete = currentForm = new ew.Form("fbdvdelete", "delete");
	loadjs.done("fbdvdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $bdv_delete->showPageHeader(); ?>
<?php
$bdv_delete->showMessage();
?>
<form name="fbdvdelete" id="fbdvdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="bdv">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($bdv_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($bdv_delete->id->Visible) { // id ?>
		<th class="<?php echo $bdv_delete->id->headerCellClass() ?>"><span id="elh_bdv_id" class="bdv_id"><?php echo $bdv_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($bdv_delete->fecha->Visible) { // fecha ?>
		<th class="<?php echo $bdv_delete->fecha->headerCellClass() ?>"><span id="elh_bdv_fecha" class="bdv_fecha"><?php echo $bdv_delete->fecha->caption() ?></span></th>
<?php } ?>
<?php if ($bdv_delete->hora->Visible) { // hora ?>
		<th class="<?php echo $bdv_delete->hora->headerCellClass() ?>"><span id="elh_bdv_hora" class="bdv_hora"><?php echo $bdv_delete->hora->caption() ?></span></th>
<?php } ?>
<?php if ($bdv_delete->audio->Visible) { // audio ?>
		<th class="<?php echo $bdv_delete->audio->headerCellClass() ?>"><span id="elh_bdv_audio" class="bdv_audio"><?php echo $bdv_delete->audio->caption() ?></span></th>
<?php } ?>
<?php if ($bdv_delete->st->Visible) { // st ?>
		<th class="<?php echo $bdv_delete->st->headerCellClass() ?>"><span id="elh_bdv_st" class="bdv_st"><?php echo $bdv_delete->st->caption() ?></span></th>
<?php } ?>
<?php if ($bdv_delete->fechaHoraIni->Visible) { // fechaHoraIni ?>
		<th class="<?php echo $bdv_delete->fechaHoraIni->headerCellClass() ?>"><span id="elh_bdv_fechaHoraIni" class="bdv_fechaHoraIni"><?php echo $bdv_delete->fechaHoraIni->caption() ?></span></th>
<?php } ?>
<?php if ($bdv_delete->fechaHoraFin->Visible) { // fechaHoraFin ?>
		<th class="<?php echo $bdv_delete->fechaHoraFin->headerCellClass() ?>"><span id="elh_bdv_fechaHoraFin" class="bdv_fechaHoraFin"><?php echo $bdv_delete->fechaHoraFin->caption() ?></span></th>
<?php } ?>
<?php if ($bdv_delete->telefono->Visible) { // telefono ?>
		<th class="<?php echo $bdv_delete->telefono->headerCellClass() ?>"><span id="elh_bdv_telefono" class="bdv_telefono"><?php echo $bdv_delete->telefono->caption() ?></span></th>
<?php } ?>
<?php if ($bdv_delete->agente->Visible) { // agente ?>
		<th class="<?php echo $bdv_delete->agente->headerCellClass() ?>"><span id="elh_bdv_agente" class="bdv_agente"><?php echo $bdv_delete->agente->caption() ?></span></th>
<?php } ?>
<?php if ($bdv_delete->fechabo->Visible) { // fechabo ?>
		<th class="<?php echo $bdv_delete->fechabo->headerCellClass() ?>"><span id="elh_bdv_fechabo" class="bdv_fechabo"><?php echo $bdv_delete->fechabo->caption() ?></span></th>
<?php } ?>
<?php if ($bdv_delete->agentebo->Visible) { // agentebo ?>
		<th class="<?php echo $bdv_delete->agentebo->headerCellClass() ?>"><span id="elh_bdv_agentebo" class="bdv_agentebo"><?php echo $bdv_delete->agentebo->caption() ?></span></th>
<?php } ?>
<?php if ($bdv_delete->IP->Visible) { // IP ?>
		<th class="<?php echo $bdv_delete->IP->headerCellClass() ?>"><span id="elh_bdv_IP" class="bdv_IP"><?php echo $bdv_delete->IP->caption() ?></span></th>
<?php } ?>
<?php if ($bdv_delete->actual->Visible) { // actual ?>
		<th class="<?php echo $bdv_delete->actual->headerCellClass() ?>"><span id="elh_bdv_actual" class="bdv_actual"><?php echo $bdv_delete->actual->caption() ?></span></th>
<?php } ?>
<?php if ($bdv_delete->completado->Visible) { // completado ?>
		<th class="<?php echo $bdv_delete->completado->headerCellClass() ?>"><span id="elh_bdv_completado" class="bdv_completado"><?php echo $bdv_delete->completado->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$bdv_delete->RecordCount = 0;
$i = 0;
while (!$bdv_delete->Recordset->EOF) {
	$bdv_delete->RecordCount++;
	$bdv_delete->RowCount++;

	// Set row properties
	$bdv->resetAttributes();
	$bdv->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$bdv_delete->loadRowValues($bdv_delete->Recordset);

	// Render row
	$bdv_delete->renderRow();
?>
	<tr <?php echo $bdv->rowAttributes() ?>>
<?php if ($bdv_delete->id->Visible) { // id ?>
		<td <?php echo $bdv_delete->id->cellAttributes() ?>>
<span id="el<?php echo $bdv_delete->RowCount ?>_bdv_id" class="bdv_id">
<span<?php echo $bdv_delete->id->viewAttributes() ?>><?php echo $bdv_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bdv_delete->fecha->Visible) { // fecha ?>
		<td <?php echo $bdv_delete->fecha->cellAttributes() ?>>
<span id="el<?php echo $bdv_delete->RowCount ?>_bdv_fecha" class="bdv_fecha">
<span<?php echo $bdv_delete->fecha->viewAttributes() ?>><?php echo $bdv_delete->fecha->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bdv_delete->hora->Visible) { // hora ?>
		<td <?php echo $bdv_delete->hora->cellAttributes() ?>>
<span id="el<?php echo $bdv_delete->RowCount ?>_bdv_hora" class="bdv_hora">
<span<?php echo $bdv_delete->hora->viewAttributes() ?>><?php echo $bdv_delete->hora->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bdv_delete->audio->Visible) { // audio ?>
		<td <?php echo $bdv_delete->audio->cellAttributes() ?>>
<span id="el<?php echo $bdv_delete->RowCount ?>_bdv_audio" class="bdv_audio">
<span<?php echo $bdv_delete->audio->viewAttributes() ?>><?php echo $bdv_delete->audio->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bdv_delete->st->Visible) { // st ?>
		<td <?php echo $bdv_delete->st->cellAttributes() ?>>
<span id="el<?php echo $bdv_delete->RowCount ?>_bdv_st" class="bdv_st">
<span<?php echo $bdv_delete->st->viewAttributes() ?>><?php echo $bdv_delete->st->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bdv_delete->fechaHoraIni->Visible) { // fechaHoraIni ?>
		<td <?php echo $bdv_delete->fechaHoraIni->cellAttributes() ?>>
<span id="el<?php echo $bdv_delete->RowCount ?>_bdv_fechaHoraIni" class="bdv_fechaHoraIni">
<span<?php echo $bdv_delete->fechaHoraIni->viewAttributes() ?>><?php echo $bdv_delete->fechaHoraIni->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bdv_delete->fechaHoraFin->Visible) { // fechaHoraFin ?>
		<td <?php echo $bdv_delete->fechaHoraFin->cellAttributes() ?>>
<span id="el<?php echo $bdv_delete->RowCount ?>_bdv_fechaHoraFin" class="bdv_fechaHoraFin">
<span<?php echo $bdv_delete->fechaHoraFin->viewAttributes() ?>><?php echo $bdv_delete->fechaHoraFin->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bdv_delete->telefono->Visible) { // telefono ?>
		<td <?php echo $bdv_delete->telefono->cellAttributes() ?>>
<span id="el<?php echo $bdv_delete->RowCount ?>_bdv_telefono" class="bdv_telefono">
<span<?php echo $bdv_delete->telefono->viewAttributes() ?>><?php echo $bdv_delete->telefono->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bdv_delete->agente->Visible) { // agente ?>
		<td <?php echo $bdv_delete->agente->cellAttributes() ?>>
<span id="el<?php echo $bdv_delete->RowCount ?>_bdv_agente" class="bdv_agente">
<span<?php echo $bdv_delete->agente->viewAttributes() ?>><?php echo $bdv_delete->agente->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bdv_delete->fechabo->Visible) { // fechabo ?>
		<td <?php echo $bdv_delete->fechabo->cellAttributes() ?>>
<span id="el<?php echo $bdv_delete->RowCount ?>_bdv_fechabo" class="bdv_fechabo">
<span<?php echo $bdv_delete->fechabo->viewAttributes() ?>><?php echo $bdv_delete->fechabo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bdv_delete->agentebo->Visible) { // agentebo ?>
		<td <?php echo $bdv_delete->agentebo->cellAttributes() ?>>
<span id="el<?php echo $bdv_delete->RowCount ?>_bdv_agentebo" class="bdv_agentebo">
<span<?php echo $bdv_delete->agentebo->viewAttributes() ?>><?php echo $bdv_delete->agentebo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bdv_delete->IP->Visible) { // IP ?>
		<td <?php echo $bdv_delete->IP->cellAttributes() ?>>
<span id="el<?php echo $bdv_delete->RowCount ?>_bdv_IP" class="bdv_IP">
<span<?php echo $bdv_delete->IP->viewAttributes() ?>><?php echo $bdv_delete->IP->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bdv_delete->actual->Visible) { // actual ?>
		<td <?php echo $bdv_delete->actual->cellAttributes() ?>>
<span id="el<?php echo $bdv_delete->RowCount ?>_bdv_actual" class="bdv_actual">
<span<?php echo $bdv_delete->actual->viewAttributes() ?>><?php echo $bdv_delete->actual->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bdv_delete->completado->Visible) { // completado ?>
		<td <?php echo $bdv_delete->completado->cellAttributes() ?>>
<span id="el<?php echo $bdv_delete->RowCount ?>_bdv_completado" class="bdv_completado">
<span<?php echo $bdv_delete->completado->viewAttributes() ?>><?php echo $bdv_delete->completado->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$bdv_delete->Recordset->moveNext();
}
$bdv_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $bdv_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$bdv_delete->showPageFooter();
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
$bdv_delete->terminate();
?>