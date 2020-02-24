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
$abiertos_edit = new abiertos_edit();

// Run the page
$abiertos_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$abiertos_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fabiertosedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fabiertosedit = currentForm = new ew.Form("fabiertosedit", "edit");

	// Validate form
	fabiertosedit.validate = function() {
		if (!this.validateRequired)
			return true; // Ignore validation
		var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
		if ($fobj.find("#confirm").val() == "F")
			return true;
		var elm, felm, uelm, addcnt = 0;
		var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
		var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
		var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
		var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
		for (var i = startcnt; i <= rowcnt; i++) {
			var infix = ($k[0]) ? String(i) : "";
			$fobj.data("rowindex", infix);
			<?php if ($abiertos_edit->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $abiertos_edit->id->caption(), $abiertos_edit->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($abiertos_edit->toriginal->Required) { ?>
				elm = this.getElements("x" + infix + "_toriginal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $abiertos_edit->toriginal->caption(), $abiertos_edit->toriginal->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($abiertos_edit->tnuevo->Required) { ?>
				elm = this.getElements("x" + infix + "_tnuevo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $abiertos_edit->tnuevo->caption(), $abiertos_edit->tnuevo->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}

		// Process detail forms
		var dfs = $fobj.find("input[name='detailpage']").get();
		for (var i = 0; i < dfs.length; i++) {
			var df = dfs[i], val = df.value;
			if (val && ew.forms[val])
				if (!ew.forms[val].validate())
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	fabiertosedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fabiertosedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fabiertosedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $abiertos_edit->showPageHeader(); ?>
<?php
$abiertos_edit->showMessage();
?>
<form name="fabiertosedit" id="fabiertosedit" class="<?php echo $abiertos_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="abiertos">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$abiertos_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($abiertos_edit->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_abiertos_id" class="<?php echo $abiertos_edit->LeftColumnClass ?>"><?php echo $abiertos_edit->id->caption() ?><?php echo $abiertos_edit->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $abiertos_edit->RightColumnClass ?>"><div <?php echo $abiertos_edit->id->cellAttributes() ?>>
<span id="el_abiertos_id">
<span<?php echo $abiertos_edit->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($abiertos_edit->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="abiertos" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($abiertos_edit->id->CurrentValue) ?>">
<?php echo $abiertos_edit->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($abiertos_edit->toriginal->Visible) { // toriginal ?>
	<div id="r_toriginal" class="form-group row">
		<label id="elh_abiertos_toriginal" for="x_toriginal" class="<?php echo $abiertos_edit->LeftColumnClass ?>"><?php echo $abiertos_edit->toriginal->caption() ?><?php echo $abiertos_edit->toriginal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $abiertos_edit->RightColumnClass ?>"><div <?php echo $abiertos_edit->toriginal->cellAttributes() ?>>
<span id="el_abiertos_toriginal">
<input type="text" data-table="abiertos" data-field="x_toriginal" name="x_toriginal" id="x_toriginal" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($abiertos_edit->toriginal->getPlaceHolder()) ?>" value="<?php echo $abiertos_edit->toriginal->EditValue ?>"<?php echo $abiertos_edit->toriginal->editAttributes() ?>>
</span>
<?php echo $abiertos_edit->toriginal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($abiertos_edit->tnuevo->Visible) { // tnuevo ?>
	<div id="r_tnuevo" class="form-group row">
		<label id="elh_abiertos_tnuevo" for="x_tnuevo" class="<?php echo $abiertos_edit->LeftColumnClass ?>"><?php echo $abiertos_edit->tnuevo->caption() ?><?php echo $abiertos_edit->tnuevo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $abiertos_edit->RightColumnClass ?>"><div <?php echo $abiertos_edit->tnuevo->cellAttributes() ?>>
<span id="el_abiertos_tnuevo">
<input type="text" data-table="abiertos" data-field="x_tnuevo" name="x_tnuevo" id="x_tnuevo" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($abiertos_edit->tnuevo->getPlaceHolder()) ?>" value="<?php echo $abiertos_edit->tnuevo->EditValue ?>"<?php echo $abiertos_edit->tnuevo->editAttributes() ?>>
</span>
<?php echo $abiertos_edit->tnuevo->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$abiertos_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $abiertos_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $abiertos_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$abiertos_edit->showPageFooter();
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
$abiertos_edit->terminate();
?>