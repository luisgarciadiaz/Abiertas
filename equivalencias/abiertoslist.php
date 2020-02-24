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
$abiertos_list = new abiertos_list();

// Run the page
$abiertos_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$abiertos_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$abiertos_list->isExport()) { ?>
<script>
var fabiertoslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fabiertoslist = currentForm = new ew.Form("fabiertoslist", "list");
	fabiertoslist.formKeyCountName = '<?php echo $abiertos_list->FormKeyCountName ?>';
	loadjs.done("fabiertoslist");
});
var fabiertoslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fabiertoslistsrch = currentSearchForm = new ew.Form("fabiertoslistsrch");

	// Dynamic selection lists
	// Filters

	fabiertoslistsrch.filterList = <?php echo $abiertos_list->getFilterList() ?>;
	loadjs.done("fabiertoslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$abiertos_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($abiertos_list->TotalRecords > 0 && $abiertos_list->ExportOptions->visible()) { ?>
<?php $abiertos_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($abiertos_list->ImportOptions->visible()) { ?>
<?php $abiertos_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($abiertos_list->SearchOptions->visible()) { ?>
<?php $abiertos_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($abiertos_list->FilterOptions->visible()) { ?>
<?php $abiertos_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$abiertos_list->renderOtherOptions();
?>
<?php if (!$abiertos_list->isExport() && !$abiertos->CurrentAction) { ?>
<form name="fabiertoslistsrch" id="fabiertoslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fabiertoslistsrch-search-panel" class="<?php echo $abiertos_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="abiertos">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $abiertos_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($abiertos_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($abiertos_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $abiertos_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($abiertos_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($abiertos_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($abiertos_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($abiertos_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php $abiertos_list->showPageHeader(); ?>
<?php
$abiertos_list->showMessage();
?>
<?php if ($abiertos_list->TotalRecords > 0 || $abiertos->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($abiertos_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> abiertos">
<form name="fabiertoslist" id="fabiertoslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="abiertos">
<div id="gmp_abiertos" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($abiertos_list->TotalRecords > 0 || $abiertos_list->isGridEdit()) { ?>
<table id="tbl_abiertoslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$abiertos->RowType = ROWTYPE_HEADER;

// Render list options
$abiertos_list->renderListOptions();

// Render list options (header, left)
$abiertos_list->ListOptions->render("header", "left");
?>
<?php if ($abiertos_list->id->Visible) { // id ?>
	<?php if ($abiertos_list->SortUrl($abiertos_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $abiertos_list->id->headerCellClass() ?>"><div id="elh_abiertos_id" class="abiertos_id"><div class="ew-table-header-caption"><?php echo $abiertos_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $abiertos_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $abiertos_list->SortUrl($abiertos_list->id) ?>', 1);"><div id="elh_abiertos_id" class="abiertos_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $abiertos_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($abiertos_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($abiertos_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($abiertos_list->toriginal->Visible) { // toriginal ?>
	<?php if ($abiertos_list->SortUrl($abiertos_list->toriginal) == "") { ?>
		<th data-name="toriginal" class="<?php echo $abiertos_list->toriginal->headerCellClass() ?>"><div id="elh_abiertos_toriginal" class="abiertos_toriginal"><div class="ew-table-header-caption"><?php echo $abiertos_list->toriginal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="toriginal" class="<?php echo $abiertos_list->toriginal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $abiertos_list->SortUrl($abiertos_list->toriginal) ?>', 1);"><div id="elh_abiertos_toriginal" class="abiertos_toriginal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $abiertos_list->toriginal->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($abiertos_list->toriginal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($abiertos_list->toriginal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($abiertos_list->tnuevo->Visible) { // tnuevo ?>
	<?php if ($abiertos_list->SortUrl($abiertos_list->tnuevo) == "") { ?>
		<th data-name="tnuevo" class="<?php echo $abiertos_list->tnuevo->headerCellClass() ?>"><div id="elh_abiertos_tnuevo" class="abiertos_tnuevo"><div class="ew-table-header-caption"><?php echo $abiertos_list->tnuevo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tnuevo" class="<?php echo $abiertos_list->tnuevo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $abiertos_list->SortUrl($abiertos_list->tnuevo) ?>', 1);"><div id="elh_abiertos_tnuevo" class="abiertos_tnuevo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $abiertos_list->tnuevo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($abiertos_list->tnuevo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($abiertos_list->tnuevo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$abiertos_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($abiertos_list->ExportAll && $abiertos_list->isExport()) {
	$abiertos_list->StopRecord = $abiertos_list->TotalRecords;
} else {

	// Set the last record to display
	if ($abiertos_list->TotalRecords > $abiertos_list->StartRecord + $abiertos_list->DisplayRecords - 1)
		$abiertos_list->StopRecord = $abiertos_list->StartRecord + $abiertos_list->DisplayRecords - 1;
	else
		$abiertos_list->StopRecord = $abiertos_list->TotalRecords;
}
$abiertos_list->RecordCount = $abiertos_list->StartRecord - 1;
if ($abiertos_list->Recordset && !$abiertos_list->Recordset->EOF) {
	$abiertos_list->Recordset->moveFirst();
	$selectLimit = $abiertos_list->UseSelectLimit;
	if (!$selectLimit && $abiertos_list->StartRecord > 1)
		$abiertos_list->Recordset->move($abiertos_list->StartRecord - 1);
} elseif (!$abiertos->AllowAddDeleteRow && $abiertos_list->StopRecord == 0) {
	$abiertos_list->StopRecord = $abiertos->GridAddRowCount;
}

// Initialize aggregate
$abiertos->RowType = ROWTYPE_AGGREGATEINIT;
$abiertos->resetAttributes();
$abiertos_list->renderRow();
while ($abiertos_list->RecordCount < $abiertos_list->StopRecord) {
	$abiertos_list->RecordCount++;
	if ($abiertos_list->RecordCount >= $abiertos_list->StartRecord) {
		$abiertos_list->RowCount++;

		// Set up key count
		$abiertos_list->KeyCount = $abiertos_list->RowIndex;

		// Init row class and style
		$abiertos->resetAttributes();
		$abiertos->CssClass = "";
		if ($abiertos_list->isGridAdd()) {
		} else {
			$abiertos_list->loadRowValues($abiertos_list->Recordset); // Load row values
		}
		$abiertos->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$abiertos->RowAttrs->merge(["data-rowindex" => $abiertos_list->RowCount, "id" => "r" . $abiertos_list->RowCount . "_abiertos", "data-rowtype" => $abiertos->RowType]);

		// Render row
		$abiertos_list->renderRow();

		// Render list options
		$abiertos_list->renderListOptions();
?>
	<tr <?php echo $abiertos->rowAttributes() ?>>
<?php

// Render list options (body, left)
$abiertos_list->ListOptions->render("body", "left", $abiertos_list->RowCount);
?>
	<?php if ($abiertos_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $abiertos_list->id->cellAttributes() ?>>
<span id="el<?php echo $abiertos_list->RowCount ?>_abiertos_id" class="abiertos_id">
<span<?php echo $abiertos_list->id->viewAttributes() ?>><?php echo $abiertos_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($abiertos_list->toriginal->Visible) { // toriginal ?>
		<td data-name="toriginal" <?php echo $abiertos_list->toriginal->cellAttributes() ?>>
<span id="el<?php echo $abiertos_list->RowCount ?>_abiertos_toriginal" class="abiertos_toriginal">
<span<?php echo $abiertos_list->toriginal->viewAttributes() ?>><?php echo $abiertos_list->toriginal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($abiertos_list->tnuevo->Visible) { // tnuevo ?>
		<td data-name="tnuevo" <?php echo $abiertos_list->tnuevo->cellAttributes() ?>>
<span id="el<?php echo $abiertos_list->RowCount ?>_abiertos_tnuevo" class="abiertos_tnuevo">
<span<?php echo $abiertos_list->tnuevo->viewAttributes() ?>><?php echo $abiertos_list->tnuevo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$abiertos_list->ListOptions->render("body", "right", $abiertos_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$abiertos_list->isGridAdd())
		$abiertos_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$abiertos->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($abiertos_list->Recordset)
	$abiertos_list->Recordset->Close();
?>
<?php if (!$abiertos_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$abiertos_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $abiertos_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $abiertos_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($abiertos_list->TotalRecords == 0 && !$abiertos->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $abiertos_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$abiertos_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$abiertos_list->isExport()) { ?>
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
$abiertos_list->terminate();
?>