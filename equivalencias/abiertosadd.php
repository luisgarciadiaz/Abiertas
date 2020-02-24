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
$abiertos_add = new abiertos_add();

// Run the page
$abiertos_add->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$abiertos_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fabiertosadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fabiertosadd = currentForm = new ew.Form("fabiertosadd", "add");

	// Validate form
	fabiertosadd.validate = function() {
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
			<?php if ($abiertos_add->toriginal->Required) { ?>
				elm = this.getElements("x" + infix + "_toriginal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $abiertos_add->toriginal->caption(), $abiertos_add->toriginal->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($abiertos_add->tnuevo->Required) { ?>
				elm = this.getElements("x" + infix + "_tnuevo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $abiertos_add->tnuevo->caption(), $abiertos_add->tnuevo->RequiredErrorMessage)) ?>");
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
	fabiertosadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fabiertosadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fabiertosadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $abiertos_add->showPageHeader(); ?>
<?php
$abiertos_add->showMessage();
?>
<form name="fabiertosadd" id="fabiertosadd" class="<?php echo $abiertos_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="abiertos">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$abiertos_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($abiertos_add->toriginal->Visible) { // toriginal ?>
	<div id="r_toriginal" class="form-group row">
		<label id="elh_abiertos_toriginal" for="x_toriginal" class="<?php echo $abiertos_add->LeftColumnClass ?>"><?php echo $abiertos_add->toriginal->caption() ?><?php echo $abiertos_add->toriginal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $abiertos_add->RightColumnClass ?>"><div <?php echo $abiertos_add->toriginal->cellAttributes() ?>>
<span id="el_abiertos_toriginal">
<input type="text" data-table="abiertos" data-field="x_toriginal" name="x_toriginal" id="x_toriginal" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($abiertos_add->toriginal->getPlaceHolder()) ?>" value="<?php echo $abiertos_add->toriginal->EditValue ?>"<?php echo $abiertos_add->toriginal->editAttributes() ?>>
</span>
<?php echo $abiertos_add->toriginal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($abiertos_add->tnuevo->Visible) { // tnuevo ?>
	<div id="r_tnuevo" class="form-group row">
		<label id="elh_abiertos_tnuevo" for="x_tnuevo" class="<?php echo $abiertos_add->LeftColumnClass ?>"><?php echo $abiertos_add->tnuevo->caption() ?><?php echo $abiertos_add->tnuevo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $abiertos_add->RightColumnClass ?>"><div <?php echo $abiertos_add->tnuevo->cellAttributes() ?>>
<span id="el_abiertos_tnuevo">
<input type="text" data-table="abiertos" data-field="x_tnuevo" name="x_tnuevo" id="x_tnuevo" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($abiertos_add->tnuevo->getPlaceHolder()) ?>" value="<?php echo $abiertos_add->tnuevo->EditValue ?>"<?php echo $abiertos_add->tnuevo->editAttributes() ?>>
</span>
<?php echo $abiertos_add->tnuevo->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$abiertos_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $abiertos_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $abiertos_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$abiertos_add->showPageFooter();
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
$abiertos_add->terminate();
?>