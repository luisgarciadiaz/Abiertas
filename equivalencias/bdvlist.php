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
$bdv_list = new bdv_list();

// Run the page
$bdv_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$bdv_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$bdv_list->isExport()) { ?>
<script>
var fbdvlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fbdvlist = currentForm = new ew.Form("fbdvlist", "list");
	fbdvlist.formKeyCountName = '<?php echo $bdv_list->FormKeyCountName ?>';
	loadjs.done("fbdvlist");
});
var fbdvlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fbdvlistsrch = currentSearchForm = new ew.Form("fbdvlistsrch");

	// Dynamic selection lists
	// Filters

	fbdvlistsrch.filterList = <?php echo $bdv_list->getFilterList() ?>;
	loadjs.done("fbdvlistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$bdv_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($bdv_list->TotalRecords > 0 && $bdv_list->ExportOptions->visible()) { ?>
<?php $bdv_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($bdv_list->ImportOptions->visible()) { ?>
<?php $bdv_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($bdv_list->SearchOptions->visible()) { ?>
<?php $bdv_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($bdv_list->FilterOptions->visible()) { ?>
<?php $bdv_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$bdv_list->renderOtherOptions();
?>
<?php if (!$bdv_list->isExport() && !$bdv->CurrentAction) { ?>
<form name="fbdvlistsrch" id="fbdvlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fbdvlistsrch-search-panel" class="<?php echo $bdv_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="bdv">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $bdv_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($bdv_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($bdv_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $bdv_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($bdv_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($bdv_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($bdv_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($bdv_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php $bdv_list->showPageHeader(); ?>
<?php
$bdv_list->showMessage();
?>
<?php if ($bdv_list->TotalRecords > 0 || $bdv->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($bdv_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> bdv">
<form name="fbdvlist" id="fbdvlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="bdv">
<div id="gmp_bdv" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($bdv_list->TotalRecords > 0 || $bdv_list->isGridEdit()) { ?>
<table id="tbl_bdvlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$bdv->RowType = ROWTYPE_HEADER;

// Render list options
$bdv_list->renderListOptions();

// Render list options (header, left)
$bdv_list->ListOptions->render("header", "left");
?>
<?php if ($bdv_list->id->Visible) { // id ?>
	<?php if ($bdv_list->SortUrl($bdv_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $bdv_list->id->headerCellClass() ?>"><div id="elh_bdv_id" class="bdv_id"><div class="ew-table-header-caption"><?php echo $bdv_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $bdv_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bdv_list->SortUrl($bdv_list->id) ?>', 1);"><div id="elh_bdv_id" class="bdv_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bdv_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($bdv_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bdv_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bdv_list->fecha->Visible) { // fecha ?>
	<?php if ($bdv_list->SortUrl($bdv_list->fecha) == "") { ?>
		<th data-name="fecha" class="<?php echo $bdv_list->fecha->headerCellClass() ?>"><div id="elh_bdv_fecha" class="bdv_fecha"><div class="ew-table-header-caption"><?php echo $bdv_list->fecha->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fecha" class="<?php echo $bdv_list->fecha->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bdv_list->SortUrl($bdv_list->fecha) ?>', 1);"><div id="elh_bdv_fecha" class="bdv_fecha">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bdv_list->fecha->caption() ?></span><span class="ew-table-header-sort"><?php if ($bdv_list->fecha->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bdv_list->fecha->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bdv_list->hora->Visible) { // hora ?>
	<?php if ($bdv_list->SortUrl($bdv_list->hora) == "") { ?>
		<th data-name="hora" class="<?php echo $bdv_list->hora->headerCellClass() ?>"><div id="elh_bdv_hora" class="bdv_hora"><div class="ew-table-header-caption"><?php echo $bdv_list->hora->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="hora" class="<?php echo $bdv_list->hora->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bdv_list->SortUrl($bdv_list->hora) ?>', 1);"><div id="elh_bdv_hora" class="bdv_hora">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bdv_list->hora->caption() ?></span><span class="ew-table-header-sort"><?php if ($bdv_list->hora->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bdv_list->hora->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bdv_list->audio->Visible) { // audio ?>
	<?php if ($bdv_list->SortUrl($bdv_list->audio) == "") { ?>
		<th data-name="audio" class="<?php echo $bdv_list->audio->headerCellClass() ?>"><div id="elh_bdv_audio" class="bdv_audio"><div class="ew-table-header-caption"><?php echo $bdv_list->audio->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="audio" class="<?php echo $bdv_list->audio->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bdv_list->SortUrl($bdv_list->audio) ?>', 1);"><div id="elh_bdv_audio" class="bdv_audio">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bdv_list->audio->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($bdv_list->audio->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bdv_list->audio->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bdv_list->st->Visible) { // st ?>
	<?php if ($bdv_list->SortUrl($bdv_list->st) == "") { ?>
		<th data-name="st" class="<?php echo $bdv_list->st->headerCellClass() ?>"><div id="elh_bdv_st" class="bdv_st"><div class="ew-table-header-caption"><?php echo $bdv_list->st->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="st" class="<?php echo $bdv_list->st->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bdv_list->SortUrl($bdv_list->st) ?>', 1);"><div id="elh_bdv_st" class="bdv_st">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bdv_list->st->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($bdv_list->st->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bdv_list->st->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bdv_list->fechaHoraIni->Visible) { // fechaHoraIni ?>
	<?php if ($bdv_list->SortUrl($bdv_list->fechaHoraIni) == "") { ?>
		<th data-name="fechaHoraIni" class="<?php echo $bdv_list->fechaHoraIni->headerCellClass() ?>"><div id="elh_bdv_fechaHoraIni" class="bdv_fechaHoraIni"><div class="ew-table-header-caption"><?php echo $bdv_list->fechaHoraIni->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fechaHoraIni" class="<?php echo $bdv_list->fechaHoraIni->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bdv_list->SortUrl($bdv_list->fechaHoraIni) ?>', 1);"><div id="elh_bdv_fechaHoraIni" class="bdv_fechaHoraIni">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bdv_list->fechaHoraIni->caption() ?></span><span class="ew-table-header-sort"><?php if ($bdv_list->fechaHoraIni->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bdv_list->fechaHoraIni->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bdv_list->fechaHoraFin->Visible) { // fechaHoraFin ?>
	<?php if ($bdv_list->SortUrl($bdv_list->fechaHoraFin) == "") { ?>
		<th data-name="fechaHoraFin" class="<?php echo $bdv_list->fechaHoraFin->headerCellClass() ?>"><div id="elh_bdv_fechaHoraFin" class="bdv_fechaHoraFin"><div class="ew-table-header-caption"><?php echo $bdv_list->fechaHoraFin->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fechaHoraFin" class="<?php echo $bdv_list->fechaHoraFin->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bdv_list->SortUrl($bdv_list->fechaHoraFin) ?>', 1);"><div id="elh_bdv_fechaHoraFin" class="bdv_fechaHoraFin">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bdv_list->fechaHoraFin->caption() ?></span><span class="ew-table-header-sort"><?php if ($bdv_list->fechaHoraFin->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bdv_list->fechaHoraFin->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bdv_list->telefono->Visible) { // telefono ?>
	<?php if ($bdv_list->SortUrl($bdv_list->telefono) == "") { ?>
		<th data-name="telefono" class="<?php echo $bdv_list->telefono->headerCellClass() ?>"><div id="elh_bdv_telefono" class="bdv_telefono"><div class="ew-table-header-caption"><?php echo $bdv_list->telefono->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="telefono" class="<?php echo $bdv_list->telefono->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bdv_list->SortUrl($bdv_list->telefono) ?>', 1);"><div id="elh_bdv_telefono" class="bdv_telefono">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bdv_list->telefono->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($bdv_list->telefono->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bdv_list->telefono->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bdv_list->agente->Visible) { // agente ?>
	<?php if ($bdv_list->SortUrl($bdv_list->agente) == "") { ?>
		<th data-name="agente" class="<?php echo $bdv_list->agente->headerCellClass() ?>"><div id="elh_bdv_agente" class="bdv_agente"><div class="ew-table-header-caption"><?php echo $bdv_list->agente->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="agente" class="<?php echo $bdv_list->agente->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bdv_list->SortUrl($bdv_list->agente) ?>', 1);"><div id="elh_bdv_agente" class="bdv_agente">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bdv_list->agente->caption() ?></span><span class="ew-table-header-sort"><?php if ($bdv_list->agente->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bdv_list->agente->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bdv_list->fechabo->Visible) { // fechabo ?>
	<?php if ($bdv_list->SortUrl($bdv_list->fechabo) == "") { ?>
		<th data-name="fechabo" class="<?php echo $bdv_list->fechabo->headerCellClass() ?>"><div id="elh_bdv_fechabo" class="bdv_fechabo"><div class="ew-table-header-caption"><?php echo $bdv_list->fechabo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fechabo" class="<?php echo $bdv_list->fechabo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bdv_list->SortUrl($bdv_list->fechabo) ?>', 1);"><div id="elh_bdv_fechabo" class="bdv_fechabo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bdv_list->fechabo->caption() ?></span><span class="ew-table-header-sort"><?php if ($bdv_list->fechabo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bdv_list->fechabo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bdv_list->agentebo->Visible) { // agentebo ?>
	<?php if ($bdv_list->SortUrl($bdv_list->agentebo) == "") { ?>
		<th data-name="agentebo" class="<?php echo $bdv_list->agentebo->headerCellClass() ?>"><div id="elh_bdv_agentebo" class="bdv_agentebo"><div class="ew-table-header-caption"><?php echo $bdv_list->agentebo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="agentebo" class="<?php echo $bdv_list->agentebo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bdv_list->SortUrl($bdv_list->agentebo) ?>', 1);"><div id="elh_bdv_agentebo" class="bdv_agentebo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bdv_list->agentebo->caption() ?></span><span class="ew-table-header-sort"><?php if ($bdv_list->agentebo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bdv_list->agentebo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bdv_list->IP->Visible) { // IP ?>
	<?php if ($bdv_list->SortUrl($bdv_list->IP) == "") { ?>
		<th data-name="IP" class="<?php echo $bdv_list->IP->headerCellClass() ?>"><div id="elh_bdv_IP" class="bdv_IP"><div class="ew-table-header-caption"><?php echo $bdv_list->IP->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IP" class="<?php echo $bdv_list->IP->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bdv_list->SortUrl($bdv_list->IP) ?>', 1);"><div id="elh_bdv_IP" class="bdv_IP">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bdv_list->IP->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($bdv_list->IP->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bdv_list->IP->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bdv_list->actual->Visible) { // actual ?>
	<?php if ($bdv_list->SortUrl($bdv_list->actual) == "") { ?>
		<th data-name="actual" class="<?php echo $bdv_list->actual->headerCellClass() ?>"><div id="elh_bdv_actual" class="bdv_actual"><div class="ew-table-header-caption"><?php echo $bdv_list->actual->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="actual" class="<?php echo $bdv_list->actual->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bdv_list->SortUrl($bdv_list->actual) ?>', 1);"><div id="elh_bdv_actual" class="bdv_actual">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bdv_list->actual->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($bdv_list->actual->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bdv_list->actual->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bdv_list->completado->Visible) { // completado ?>
	<?php if ($bdv_list->SortUrl($bdv_list->completado) == "") { ?>
		<th data-name="completado" class="<?php echo $bdv_list->completado->headerCellClass() ?>"><div id="elh_bdv_completado" class="bdv_completado"><div class="ew-table-header-caption"><?php echo $bdv_list->completado->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="completado" class="<?php echo $bdv_list->completado->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bdv_list->SortUrl($bdv_list->completado) ?>', 1);"><div id="elh_bdv_completado" class="bdv_completado">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bdv_list->completado->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($bdv_list->completado->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bdv_list->completado->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$bdv_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($bdv_list->ExportAll && $bdv_list->isExport()) {
	$bdv_list->StopRecord = $bdv_list->TotalRecords;
} else {

	// Set the last record to display
	if ($bdv_list->TotalRecords > $bdv_list->StartRecord + $bdv_list->DisplayRecords - 1)
		$bdv_list->StopRecord = $bdv_list->StartRecord + $bdv_list->DisplayRecords - 1;
	else
		$bdv_list->StopRecord = $bdv_list->TotalRecords;
}
$bdv_list->RecordCount = $bdv_list->StartRecord - 1;
if ($bdv_list->Recordset && !$bdv_list->Recordset->EOF) {
	$bdv_list->Recordset->moveFirst();
	$selectLimit = $bdv_list->UseSelectLimit;
	if (!$selectLimit && $bdv_list->StartRecord > 1)
		$bdv_list->Recordset->move($bdv_list->StartRecord - 1);
} elseif (!$bdv->AllowAddDeleteRow && $bdv_list->StopRecord == 0) {
	$bdv_list->StopRecord = $bdv->GridAddRowCount;
}

// Initialize aggregate
$bdv->RowType = ROWTYPE_AGGREGATEINIT;
$bdv->resetAttributes();
$bdv_list->renderRow();
while ($bdv_list->RecordCount < $bdv_list->StopRecord) {
	$bdv_list->RecordCount++;
	if ($bdv_list->RecordCount >= $bdv_list->StartRecord) {
		$bdv_list->RowCount++;

		// Set up key count
		$bdv_list->KeyCount = $bdv_list->RowIndex;

		// Init row class and style
		$bdv->resetAttributes();
		$bdv->CssClass = "";
		if ($bdv_list->isGridAdd()) {
		} else {
			$bdv_list->loadRowValues($bdv_list->Recordset); // Load row values
		}
		$bdv->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$bdv->RowAttrs->merge(["data-rowindex" => $bdv_list->RowCount, "id" => "r" . $bdv_list->RowCount . "_bdv", "data-rowtype" => $bdv->RowType]);

		// Render row
		$bdv_list->renderRow();

		// Render list options
		$bdv_list->renderListOptions();
?>
	<tr <?php echo $bdv->rowAttributes() ?>>
<?php

// Render list options (body, left)
$bdv_list->ListOptions->render("body", "left", $bdv_list->RowCount);
?>
	<?php if ($bdv_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $bdv_list->id->cellAttributes() ?>>
<span id="el<?php echo $bdv_list->RowCount ?>_bdv_id" class="bdv_id">
<span<?php echo $bdv_list->id->viewAttributes() ?>><?php echo $bdv_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bdv_list->fecha->Visible) { // fecha ?>
		<td data-name="fecha" <?php echo $bdv_list->fecha->cellAttributes() ?>>
<span id="el<?php echo $bdv_list->RowCount ?>_bdv_fecha" class="bdv_fecha">
<span<?php echo $bdv_list->fecha->viewAttributes() ?>><?php echo $bdv_list->fecha->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bdv_list->hora->Visible) { // hora ?>
		<td data-name="hora" <?php echo $bdv_list->hora->cellAttributes() ?>>
<span id="el<?php echo $bdv_list->RowCount ?>_bdv_hora" class="bdv_hora">
<span<?php echo $bdv_list->hora->viewAttributes() ?>><?php echo $bdv_list->hora->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bdv_list->audio->Visible) { // audio ?>
		<td data-name="audio" <?php echo $bdv_list->audio->cellAttributes() ?>>
<span id="el<?php echo $bdv_list->RowCount ?>_bdv_audio" class="bdv_audio">
<span<?php echo $bdv_list->audio->viewAttributes() ?>><?php echo $bdv_list->audio->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bdv_list->st->Visible) { // st ?>
		<td data-name="st" <?php echo $bdv_list->st->cellAttributes() ?>>
<span id="el<?php echo $bdv_list->RowCount ?>_bdv_st" class="bdv_st">
<span<?php echo $bdv_list->st->viewAttributes() ?>><?php echo $bdv_list->st->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bdv_list->fechaHoraIni->Visible) { // fechaHoraIni ?>
		<td data-name="fechaHoraIni" <?php echo $bdv_list->fechaHoraIni->cellAttributes() ?>>
<span id="el<?php echo $bdv_list->RowCount ?>_bdv_fechaHoraIni" class="bdv_fechaHoraIni">
<span<?php echo $bdv_list->fechaHoraIni->viewAttributes() ?>><?php echo $bdv_list->fechaHoraIni->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bdv_list->fechaHoraFin->Visible) { // fechaHoraFin ?>
		<td data-name="fechaHoraFin" <?php echo $bdv_list->fechaHoraFin->cellAttributes() ?>>
<span id="el<?php echo $bdv_list->RowCount ?>_bdv_fechaHoraFin" class="bdv_fechaHoraFin">
<span<?php echo $bdv_list->fechaHoraFin->viewAttributes() ?>><?php echo $bdv_list->fechaHoraFin->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bdv_list->telefono->Visible) { // telefono ?>
		<td data-name="telefono" <?php echo $bdv_list->telefono->cellAttributes() ?>>
<span id="el<?php echo $bdv_list->RowCount ?>_bdv_telefono" class="bdv_telefono">
<span<?php echo $bdv_list->telefono->viewAttributes() ?>><?php echo $bdv_list->telefono->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bdv_list->agente->Visible) { // agente ?>
		<td data-name="agente" <?php echo $bdv_list->agente->cellAttributes() ?>>
<span id="el<?php echo $bdv_list->RowCount ?>_bdv_agente" class="bdv_agente">
<span<?php echo $bdv_list->agente->viewAttributes() ?>><?php echo $bdv_list->agente->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bdv_list->fechabo->Visible) { // fechabo ?>
		<td data-name="fechabo" <?php echo $bdv_list->fechabo->cellAttributes() ?>>
<span id="el<?php echo $bdv_list->RowCount ?>_bdv_fechabo" class="bdv_fechabo">
<span<?php echo $bdv_list->fechabo->viewAttributes() ?>><?php echo $bdv_list->fechabo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bdv_list->agentebo->Visible) { // agentebo ?>
		<td data-name="agentebo" <?php echo $bdv_list->agentebo->cellAttributes() ?>>
<span id="el<?php echo $bdv_list->RowCount ?>_bdv_agentebo" class="bdv_agentebo">
<span<?php echo $bdv_list->agentebo->viewAttributes() ?>><?php echo $bdv_list->agentebo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bdv_list->IP->Visible) { // IP ?>
		<td data-name="IP" <?php echo $bdv_list->IP->cellAttributes() ?>>
<span id="el<?php echo $bdv_list->RowCount ?>_bdv_IP" class="bdv_IP">
<span<?php echo $bdv_list->IP->viewAttributes() ?>><?php echo $bdv_list->IP->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bdv_list->actual->Visible) { // actual ?>
		<td data-name="actual" <?php echo $bdv_list->actual->cellAttributes() ?>>
<span id="el<?php echo $bdv_list->RowCount ?>_bdv_actual" class="bdv_actual">
<span<?php echo $bdv_list->actual->viewAttributes() ?>><?php echo $bdv_list->actual->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bdv_list->completado->Visible) { // completado ?>
		<td data-name="completado" <?php echo $bdv_list->completado->cellAttributes() ?>>
<span id="el<?php echo $bdv_list->RowCount ?>_bdv_completado" class="bdv_completado">
<span<?php echo $bdv_list->completado->viewAttributes() ?>><?php echo $bdv_list->completado->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$bdv_list->ListOptions->render("body", "right", $bdv_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$bdv_list->isGridAdd())
		$bdv_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$bdv->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($bdv_list->Recordset)
	$bdv_list->Recordset->Close();
?>
<?php if (!$bdv_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$bdv_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $bdv_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $bdv_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($bdv_list->TotalRecords == 0 && !$bdv->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $bdv_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$bdv_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$bdv_list->isExport()) { ?>
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
$bdv_list->terminate();
?>