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
$bdv_edit = new bdv_edit();

// Run the page
$bdv_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$bdv_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fbdvedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fbdvedit = currentForm = new ew.Form("fbdvedit", "edit");

	// Validate form
	fbdvedit.validate = function() {
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
			<?php if ($bdv_edit->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->id->caption(), $bdv_edit->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->fecha->Required) { ?>
				elm = this.getElements("x" + infix + "_fecha");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->fecha->caption(), $bdv_edit->fecha->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_fecha");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bdv_edit->fecha->errorMessage()) ?>");
			<?php if ($bdv_edit->hora->Required) { ?>
				elm = this.getElements("x" + infix + "_hora");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->hora->caption(), $bdv_edit->hora->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_hora");
				if (elm && !ew.checkTime(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bdv_edit->hora->errorMessage()) ?>");
			<?php if ($bdv_edit->audio->Required) { ?>
				elm = this.getElements("x" + infix + "_audio");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->audio->caption(), $bdv_edit->audio->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->st->Required) { ?>
				elm = this.getElements("x" + infix + "_st");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->st->caption(), $bdv_edit->st->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->fechaHoraIni->Required) { ?>
				elm = this.getElements("x" + infix + "_fechaHoraIni");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->fechaHoraIni->caption(), $bdv_edit->fechaHoraIni->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_fechaHoraIni");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bdv_edit->fechaHoraIni->errorMessage()) ?>");
			<?php if ($bdv_edit->fechaHoraFin->Required) { ?>
				elm = this.getElements("x" + infix + "_fechaHoraFin");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->fechaHoraFin->caption(), $bdv_edit->fechaHoraFin->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_fechaHoraFin");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bdv_edit->fechaHoraFin->errorMessage()) ?>");
			<?php if ($bdv_edit->telefono->Required) { ?>
				elm = this.getElements("x" + infix + "_telefono");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->telefono->caption(), $bdv_edit->telefono->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->agente->Required) { ?>
				elm = this.getElements("x" + infix + "_agente");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->agente->caption(), $bdv_edit->agente->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_agente");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bdv_edit->agente->errorMessage()) ?>");
			<?php if ($bdv_edit->fechabo->Required) { ?>
				elm = this.getElements("x" + infix + "_fechabo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->fechabo->caption(), $bdv_edit->fechabo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_fechabo");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bdv_edit->fechabo->errorMessage()) ?>");
			<?php if ($bdv_edit->agentebo->Required) { ?>
				elm = this.getElements("x" + infix + "_agentebo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->agentebo->caption(), $bdv_edit->agentebo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_agentebo");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bdv_edit->agentebo->errorMessage()) ?>");
			<?php if ($bdv_edit->comentariosbo->Required) { ?>
				elm = this.getElements("x" + infix + "_comentariosbo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->comentariosbo->caption(), $bdv_edit->comentariosbo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->IP->Required) { ?>
				elm = this.getElements("x" + infix + "_IP");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->IP->caption(), $bdv_edit->IP->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->actual->Required) { ?>
				elm = this.getElements("x" + infix + "_actual");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->actual->caption(), $bdv_edit->actual->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->completado->Required) { ?>
				elm = this.getElements("x" + infix + "_completado");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->completado->caption(), $bdv_edit->completado->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_2_1_R->Required) { ?>
				elm = this.getElements("x" + infix + "__2_1_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_2_1_R->caption(), $bdv_edit->_2_1_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_2_2_R->Required) { ?>
				elm = this.getElements("x" + infix + "__2_2_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_2_2_R->caption(), $bdv_edit->_2_2_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_2_3_R->Required) { ?>
				elm = this.getElements("x" + infix + "__2_3_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_2_3_R->caption(), $bdv_edit->_2_3_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_3_4_R->Required) { ?>
				elm = this.getElements("x" + infix + "__3_4_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_3_4_R->caption(), $bdv_edit->_3_4_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_4_5_R->Required) { ?>
				elm = this.getElements("x" + infix + "__4_5_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_4_5_R->caption(), $bdv_edit->_4_5_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_4_6_R->Required) { ?>
				elm = this.getElements("x" + infix + "__4_6_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_4_6_R->caption(), $bdv_edit->_4_6_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_4_7_R->Required) { ?>
				elm = this.getElements("x" + infix + "__4_7_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_4_7_R->caption(), $bdv_edit->_4_7_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_4_8_R->Required) { ?>
				elm = this.getElements("x" + infix + "__4_8_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_4_8_R->caption(), $bdv_edit->_4_8_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_5_9_R->Required) { ?>
				elm = this.getElements("x" + infix + "__5_9_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_5_9_R->caption(), $bdv_edit->_5_9_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_5_10_R->Required) { ?>
				elm = this.getElements("x" + infix + "__5_10_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_5_10_R->caption(), $bdv_edit->_5_10_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_5_11_R->Required) { ?>
				elm = this.getElements("x" + infix + "__5_11_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_5_11_R->caption(), $bdv_edit->_5_11_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_5_12_R->Required) { ?>
				elm = this.getElements("x" + infix + "__5_12_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_5_12_R->caption(), $bdv_edit->_5_12_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_5_13_R->Required) { ?>
				elm = this.getElements("x" + infix + "__5_13_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_5_13_R->caption(), $bdv_edit->_5_13_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_5_14_R->Required) { ?>
				elm = this.getElements("x" + infix + "__5_14_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_5_14_R->caption(), $bdv_edit->_5_14_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_5_51_R->Required) { ?>
				elm = this.getElements("x" + infix + "__5_51_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_5_51_R->caption(), $bdv_edit->_5_51_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_6_15_R->Required) { ?>
				elm = this.getElements("x" + infix + "__6_15_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_6_15_R->caption(), $bdv_edit->_6_15_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_6_16_R->Required) { ?>
				elm = this.getElements("x" + infix + "__6_16_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_6_16_R->caption(), $bdv_edit->_6_16_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_6_17_R->Required) { ?>
				elm = this.getElements("x" + infix + "__6_17_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_6_17_R->caption(), $bdv_edit->_6_17_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_6_18_R->Required) { ?>
				elm = this.getElements("x" + infix + "__6_18_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_6_18_R->caption(), $bdv_edit->_6_18_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_6_19_R->Required) { ?>
				elm = this.getElements("x" + infix + "__6_19_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_6_19_R->caption(), $bdv_edit->_6_19_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_6_20_R->Required) { ?>
				elm = this.getElements("x" + infix + "__6_20_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_6_20_R->caption(), $bdv_edit->_6_20_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_6_52_R->Required) { ?>
				elm = this.getElements("x" + infix + "__6_52_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_6_52_R->caption(), $bdv_edit->_6_52_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_7_21_R->Required) { ?>
				elm = this.getElements("x" + infix + "__7_21_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_7_21_R->caption(), $bdv_edit->_7_21_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_8_22_R->Required) { ?>
				elm = this.getElements("x" + infix + "__8_22_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_8_22_R->caption(), $bdv_edit->_8_22_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_8_23_R->Required) { ?>
				elm = this.getElements("x" + infix + "__8_23_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_8_23_R->caption(), $bdv_edit->_8_23_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_8_24_R->Required) { ?>
				elm = this.getElements("x" + infix + "__8_24_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_8_24_R->caption(), $bdv_edit->_8_24_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_8_25_R->Required) { ?>
				elm = this.getElements("x" + infix + "__8_25_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_8_25_R->caption(), $bdv_edit->_8_25_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_9_26_R->Required) { ?>
				elm = this.getElements("x" + infix + "__9_26_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_9_26_R->caption(), $bdv_edit->_9_26_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_9_27_R->Required) { ?>
				elm = this.getElements("x" + infix + "__9_27_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_9_27_R->caption(), $bdv_edit->_9_27_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_9_28_R->Required) { ?>
				elm = this.getElements("x" + infix + "__9_28_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_9_28_R->caption(), $bdv_edit->_9_28_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_9_29_R->Required) { ?>
				elm = this.getElements("x" + infix + "__9_29_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_9_29_R->caption(), $bdv_edit->_9_29_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_9_30_R->Required) { ?>
				elm = this.getElements("x" + infix + "__9_30_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_9_30_R->caption(), $bdv_edit->_9_30_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_9_31_R->Required) { ?>
				elm = this.getElements("x" + infix + "__9_31_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_9_31_R->caption(), $bdv_edit->_9_31_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_9_32_R->Required) { ?>
				elm = this.getElements("x" + infix + "__9_32_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_9_32_R->caption(), $bdv_edit->_9_32_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_9_33_R->Required) { ?>
				elm = this.getElements("x" + infix + "__9_33_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_9_33_R->caption(), $bdv_edit->_9_33_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_9_34_R->Required) { ?>
				elm = this.getElements("x" + infix + "__9_34_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_9_34_R->caption(), $bdv_edit->_9_34_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_9_35_R->Required) { ?>
				elm = this.getElements("x" + infix + "__9_35_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_9_35_R->caption(), $bdv_edit->_9_35_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_9_36_R->Required) { ?>
				elm = this.getElements("x" + infix + "__9_36_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_9_36_R->caption(), $bdv_edit->_9_36_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_9_37_R->Required) { ?>
				elm = this.getElements("x" + infix + "__9_37_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_9_37_R->caption(), $bdv_edit->_9_37_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_9_38_R->Required) { ?>
				elm = this.getElements("x" + infix + "__9_38_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_9_38_R->caption(), $bdv_edit->_9_38_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_9_39_R->Required) { ?>
				elm = this.getElements("x" + infix + "__9_39_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_9_39_R->caption(), $bdv_edit->_9_39_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_10_40_R->Required) { ?>
				elm = this.getElements("x" + infix + "__10_40_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_10_40_R->caption(), $bdv_edit->_10_40_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_10_41_R->Required) { ?>
				elm = this.getElements("x" + infix + "__10_41_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_10_41_R->caption(), $bdv_edit->_10_41_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_11_42_R->Required) { ?>
				elm = this.getElements("x" + infix + "__11_42_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_11_42_R->caption(), $bdv_edit->_11_42_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_11_43_R->Required) { ?>
				elm = this.getElements("x" + infix + "__11_43_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_11_43_R->caption(), $bdv_edit->_11_43_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_12_44_R->Required) { ?>
				elm = this.getElements("x" + infix + "__12_44_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_12_44_R->caption(), $bdv_edit->_12_44_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_12_45_R->Required) { ?>
				elm = this.getElements("x" + infix + "__12_45_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_12_45_R->caption(), $bdv_edit->_12_45_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_12_46_R->Required) { ?>
				elm = this.getElements("x" + infix + "__12_46_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_12_46_R->caption(), $bdv_edit->_12_46_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_12_47_R->Required) { ?>
				elm = this.getElements("x" + infix + "__12_47_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_12_47_R->caption(), $bdv_edit->_12_47_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_12_48_R->Required) { ?>
				elm = this.getElements("x" + infix + "__12_48_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_12_48_R->caption(), $bdv_edit->_12_48_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_12_49_R->Required) { ?>
				elm = this.getElements("x" + infix + "__12_49_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_12_49_R->caption(), $bdv_edit->_12_49_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_12_50_R->Required) { ?>
				elm = this.getElements("x" + infix + "__12_50_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_12_50_R->caption(), $bdv_edit->_12_50_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_1__R->Required) { ?>
				elm = this.getElements("x" + infix + "__1__R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_1__R->caption(), $bdv_edit->_1__R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_13_54_R->Required) { ?>
				elm = this.getElements("x" + infix + "__13_54_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_13_54_R->caption(), $bdv_edit->_13_54_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_13_54_1_R->Required) { ?>
				elm = this.getElements("x" + infix + "__13_54_1_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_13_54_1_R->caption(), $bdv_edit->_13_54_1_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_13_54_2_R->Required) { ?>
				elm = this.getElements("x" + infix + "__13_54_2_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_13_54_2_R->caption(), $bdv_edit->_13_54_2_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_13_55_R->Required) { ?>
				elm = this.getElements("x" + infix + "__13_55_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_13_55_R->caption(), $bdv_edit->_13_55_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_13_55_1_R->Required) { ?>
				elm = this.getElements("x" + infix + "__13_55_1_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_13_55_1_R->caption(), $bdv_edit->_13_55_1_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_13_55_2_R->Required) { ?>
				elm = this.getElements("x" + infix + "__13_55_2_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_13_55_2_R->caption(), $bdv_edit->_13_55_2_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_13_56_R->Required) { ?>
				elm = this.getElements("x" + infix + "__13_56_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_13_56_R->caption(), $bdv_edit->_13_56_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_13_56_1_R->Required) { ?>
				elm = this.getElements("x" + infix + "__13_56_1_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_13_56_1_R->caption(), $bdv_edit->_13_56_1_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_13_56_2_R->Required) { ?>
				elm = this.getElements("x" + infix + "__13_56_2_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_13_56_2_R->caption(), $bdv_edit->_13_56_2_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_12_53_R->Required) { ?>
				elm = this.getElements("x" + infix + "__12_53_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_12_53_R->caption(), $bdv_edit->_12_53_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_12_53_1_R->Required) { ?>
				elm = this.getElements("x" + infix + "__12_53_1_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_12_53_1_R->caption(), $bdv_edit->_12_53_1_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_12_53_2_R->Required) { ?>
				elm = this.getElements("x" + infix + "__12_53_2_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_12_53_2_R->caption(), $bdv_edit->_12_53_2_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_12_53_3_R->Required) { ?>
				elm = this.getElements("x" + infix + "__12_53_3_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_12_53_3_R->caption(), $bdv_edit->_12_53_3_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_12_53_4_R->Required) { ?>
				elm = this.getElements("x" + infix + "__12_53_4_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_12_53_4_R->caption(), $bdv_edit->_12_53_4_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_12_53_5_R->Required) { ?>
				elm = this.getElements("x" + infix + "__12_53_5_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_12_53_5_R->caption(), $bdv_edit->_12_53_5_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_12_53_6_R->Required) { ?>
				elm = this.getElements("x" + infix + "__12_53_6_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_12_53_6_R->caption(), $bdv_edit->_12_53_6_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_13_57_R->Required) { ?>
				elm = this.getElements("x" + infix + "__13_57_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_13_57_R->caption(), $bdv_edit->_13_57_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_13_57_1_R->Required) { ?>
				elm = this.getElements("x" + infix + "__13_57_1_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_13_57_1_R->caption(), $bdv_edit->_13_57_1_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_13_57_2_R->Required) { ?>
				elm = this.getElements("x" + infix + "__13_57_2_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_13_57_2_R->caption(), $bdv_edit->_13_57_2_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_13_58_R->Required) { ?>
				elm = this.getElements("x" + infix + "__13_58_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_13_58_R->caption(), $bdv_edit->_13_58_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_13_58_1_R->Required) { ?>
				elm = this.getElements("x" + infix + "__13_58_1_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_13_58_1_R->caption(), $bdv_edit->_13_58_1_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_13_58_2_R->Required) { ?>
				elm = this.getElements("x" + infix + "__13_58_2_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_13_58_2_R->caption(), $bdv_edit->_13_58_2_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_13_59_R->Required) { ?>
				elm = this.getElements("x" + infix + "__13_59_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_13_59_R->caption(), $bdv_edit->_13_59_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_13_59_1_R->Required) { ?>
				elm = this.getElements("x" + infix + "__13_59_1_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_13_59_1_R->caption(), $bdv_edit->_13_59_1_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_13_59_2_R->Required) { ?>
				elm = this.getElements("x" + infix + "__13_59_2_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_13_59_2_R->caption(), $bdv_edit->_13_59_2_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_13_60_R->Required) { ?>
				elm = this.getElements("x" + infix + "__13_60_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_13_60_R->caption(), $bdv_edit->_13_60_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_12_53_7_R->Required) { ?>
				elm = this.getElements("x" + infix + "__12_53_7_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_12_53_7_R->caption(), $bdv_edit->_12_53_7_R->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bdv_edit->_12_53_8_R->Required) { ?>
				elm = this.getElements("x" + infix + "__12_53_8_R");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bdv_edit->_12_53_8_R->caption(), $bdv_edit->_12_53_8_R->RequiredErrorMessage)) ?>");
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
	fbdvedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fbdvedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fbdvedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $bdv_edit->showPageHeader(); ?>
<?php
$bdv_edit->showMessage();
?>
<form name="fbdvedit" id="fbdvedit" class="<?php echo $bdv_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="bdv">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$bdv_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($bdv_edit->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_bdv_id" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->id->caption() ?><?php echo $bdv_edit->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->id->cellAttributes() ?>>
<span id="el_bdv_id">
<span<?php echo $bdv_edit->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bdv_edit->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="bdv" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($bdv_edit->id->CurrentValue) ?>">
<?php echo $bdv_edit->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->fecha->Visible) { // fecha ?>
	<div id="r_fecha" class="form-group row">
		<label id="elh_bdv_fecha" for="x_fecha" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->fecha->caption() ?><?php echo $bdv_edit->fecha->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->fecha->cellAttributes() ?>>
<span id="el_bdv_fecha">
<input type="text" data-table="bdv" data-field="x_fecha" name="x_fecha" id="x_fecha" maxlength="10" placeholder="<?php echo HtmlEncode($bdv_edit->fecha->getPlaceHolder()) ?>" value="<?php echo $bdv_edit->fecha->EditValue ?>"<?php echo $bdv_edit->fecha->editAttributes() ?>>
<?php if (!$bdv_edit->fecha->ReadOnly && !$bdv_edit->fecha->Disabled && !isset($bdv_edit->fecha->EditAttrs["readonly"]) && !isset($bdv_edit->fecha->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fbdvedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fbdvedit", "x_fecha", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $bdv_edit->fecha->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->hora->Visible) { // hora ?>
	<div id="r_hora" class="form-group row">
		<label id="elh_bdv_hora" for="x_hora" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->hora->caption() ?><?php echo $bdv_edit->hora->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->hora->cellAttributes() ?>>
<span id="el_bdv_hora">
<input type="text" data-table="bdv" data-field="x_hora" name="x_hora" id="x_hora" maxlength="10" placeholder="<?php echo HtmlEncode($bdv_edit->hora->getPlaceHolder()) ?>" value="<?php echo $bdv_edit->hora->EditValue ?>"<?php echo $bdv_edit->hora->editAttributes() ?>>
</span>
<?php echo $bdv_edit->hora->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->audio->Visible) { // audio ?>
	<div id="r_audio" class="form-group row">
		<label id="elh_bdv_audio" for="x_audio" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->audio->caption() ?><?php echo $bdv_edit->audio->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->audio->cellAttributes() ?>>
<span id="el_bdv_audio">
<input type="text" data-table="bdv" data-field="x_audio" name="x_audio" id="x_audio" size="30" maxlength="2" placeholder="<?php echo HtmlEncode($bdv_edit->audio->getPlaceHolder()) ?>" value="<?php echo $bdv_edit->audio->EditValue ?>"<?php echo $bdv_edit->audio->editAttributes() ?>>
</span>
<?php echo $bdv_edit->audio->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->st->Visible) { // st ?>
	<div id="r_st" class="form-group row">
		<label id="elh_bdv_st" for="x_st" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->st->caption() ?><?php echo $bdv_edit->st->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->st->cellAttributes() ?>>
<span id="el_bdv_st">
<input type="text" data-table="bdv" data-field="x_st" name="x_st" id="x_st" size="30" maxlength="60" placeholder="<?php echo HtmlEncode($bdv_edit->st->getPlaceHolder()) ?>" value="<?php echo $bdv_edit->st->EditValue ?>"<?php echo $bdv_edit->st->editAttributes() ?>>
</span>
<?php echo $bdv_edit->st->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->fechaHoraIni->Visible) { // fechaHoraIni ?>
	<div id="r_fechaHoraIni" class="form-group row">
		<label id="elh_bdv_fechaHoraIni" for="x_fechaHoraIni" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->fechaHoraIni->caption() ?><?php echo $bdv_edit->fechaHoraIni->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->fechaHoraIni->cellAttributes() ?>>
<span id="el_bdv_fechaHoraIni">
<input type="text" data-table="bdv" data-field="x_fechaHoraIni" name="x_fechaHoraIni" id="x_fechaHoraIni" maxlength="19" placeholder="<?php echo HtmlEncode($bdv_edit->fechaHoraIni->getPlaceHolder()) ?>" value="<?php echo $bdv_edit->fechaHoraIni->EditValue ?>"<?php echo $bdv_edit->fechaHoraIni->editAttributes() ?>>
<?php if (!$bdv_edit->fechaHoraIni->ReadOnly && !$bdv_edit->fechaHoraIni->Disabled && !isset($bdv_edit->fechaHoraIni->EditAttrs["readonly"]) && !isset($bdv_edit->fechaHoraIni->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fbdvedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fbdvedit", "x_fechaHoraIni", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $bdv_edit->fechaHoraIni->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->fechaHoraFin->Visible) { // fechaHoraFin ?>
	<div id="r_fechaHoraFin" class="form-group row">
		<label id="elh_bdv_fechaHoraFin" for="x_fechaHoraFin" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->fechaHoraFin->caption() ?><?php echo $bdv_edit->fechaHoraFin->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->fechaHoraFin->cellAttributes() ?>>
<span id="el_bdv_fechaHoraFin">
<input type="text" data-table="bdv" data-field="x_fechaHoraFin" name="x_fechaHoraFin" id="x_fechaHoraFin" maxlength="19" placeholder="<?php echo HtmlEncode($bdv_edit->fechaHoraFin->getPlaceHolder()) ?>" value="<?php echo $bdv_edit->fechaHoraFin->EditValue ?>"<?php echo $bdv_edit->fechaHoraFin->editAttributes() ?>>
<?php if (!$bdv_edit->fechaHoraFin->ReadOnly && !$bdv_edit->fechaHoraFin->Disabled && !isset($bdv_edit->fechaHoraFin->EditAttrs["readonly"]) && !isset($bdv_edit->fechaHoraFin->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fbdvedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fbdvedit", "x_fechaHoraFin", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $bdv_edit->fechaHoraFin->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->telefono->Visible) { // telefono ?>
	<div id="r_telefono" class="form-group row">
		<label id="elh_bdv_telefono" for="x_telefono" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->telefono->caption() ?><?php echo $bdv_edit->telefono->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->telefono->cellAttributes() ?>>
<span id="el_bdv_telefono">
<input type="text" data-table="bdv" data-field="x_telefono" name="x_telefono" id="x_telefono" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($bdv_edit->telefono->getPlaceHolder()) ?>" value="<?php echo $bdv_edit->telefono->EditValue ?>"<?php echo $bdv_edit->telefono->editAttributes() ?>>
</span>
<?php echo $bdv_edit->telefono->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->agente->Visible) { // agente ?>
	<div id="r_agente" class="form-group row">
		<label id="elh_bdv_agente" for="x_agente" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->agente->caption() ?><?php echo $bdv_edit->agente->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->agente->cellAttributes() ?>>
<span id="el_bdv_agente">
<input type="text" data-table="bdv" data-field="x_agente" name="x_agente" id="x_agente" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($bdv_edit->agente->getPlaceHolder()) ?>" value="<?php echo $bdv_edit->agente->EditValue ?>"<?php echo $bdv_edit->agente->editAttributes() ?>>
</span>
<?php echo $bdv_edit->agente->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->fechabo->Visible) { // fechabo ?>
	<div id="r_fechabo" class="form-group row">
		<label id="elh_bdv_fechabo" for="x_fechabo" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->fechabo->caption() ?><?php echo $bdv_edit->fechabo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->fechabo->cellAttributes() ?>>
<span id="el_bdv_fechabo">
<input type="text" data-table="bdv" data-field="x_fechabo" name="x_fechabo" id="x_fechabo" maxlength="10" placeholder="<?php echo HtmlEncode($bdv_edit->fechabo->getPlaceHolder()) ?>" value="<?php echo $bdv_edit->fechabo->EditValue ?>"<?php echo $bdv_edit->fechabo->editAttributes() ?>>
<?php if (!$bdv_edit->fechabo->ReadOnly && !$bdv_edit->fechabo->Disabled && !isset($bdv_edit->fechabo->EditAttrs["readonly"]) && !isset($bdv_edit->fechabo->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fbdvedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fbdvedit", "x_fechabo", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $bdv_edit->fechabo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->agentebo->Visible) { // agentebo ?>
	<div id="r_agentebo" class="form-group row">
		<label id="elh_bdv_agentebo" for="x_agentebo" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->agentebo->caption() ?><?php echo $bdv_edit->agentebo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->agentebo->cellAttributes() ?>>
<span id="el_bdv_agentebo">
<input type="text" data-table="bdv" data-field="x_agentebo" name="x_agentebo" id="x_agentebo" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($bdv_edit->agentebo->getPlaceHolder()) ?>" value="<?php echo $bdv_edit->agentebo->EditValue ?>"<?php echo $bdv_edit->agentebo->editAttributes() ?>>
</span>
<?php echo $bdv_edit->agentebo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->comentariosbo->Visible) { // comentariosbo ?>
	<div id="r_comentariosbo" class="form-group row">
		<label id="elh_bdv_comentariosbo" for="x_comentariosbo" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->comentariosbo->caption() ?><?php echo $bdv_edit->comentariosbo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->comentariosbo->cellAttributes() ?>>
<span id="el_bdv_comentariosbo">
<textarea data-table="bdv" data-field="x_comentariosbo" name="x_comentariosbo" id="x_comentariosbo" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->comentariosbo->getPlaceHolder()) ?>"<?php echo $bdv_edit->comentariosbo->editAttributes() ?>><?php echo $bdv_edit->comentariosbo->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->comentariosbo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->IP->Visible) { // IP ?>
	<div id="r_IP" class="form-group row">
		<label id="elh_bdv_IP" for="x_IP" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->IP->caption() ?><?php echo $bdv_edit->IP->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->IP->cellAttributes() ?>>
<span id="el_bdv_IP">
<input type="text" data-table="bdv" data-field="x_IP" name="x_IP" id="x_IP" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($bdv_edit->IP->getPlaceHolder()) ?>" value="<?php echo $bdv_edit->IP->EditValue ?>"<?php echo $bdv_edit->IP->editAttributes() ?>>
</span>
<?php echo $bdv_edit->IP->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->actual->Visible) { // actual ?>
	<div id="r_actual" class="form-group row">
		<label id="elh_bdv_actual" for="x_actual" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->actual->caption() ?><?php echo $bdv_edit->actual->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->actual->cellAttributes() ?>>
<span id="el_bdv_actual">
<input type="text" data-table="bdv" data-field="x_actual" name="x_actual" id="x_actual" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($bdv_edit->actual->getPlaceHolder()) ?>" value="<?php echo $bdv_edit->actual->EditValue ?>"<?php echo $bdv_edit->actual->editAttributes() ?>>
</span>
<?php echo $bdv_edit->actual->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->completado->Visible) { // completado ?>
	<div id="r_completado" class="form-group row">
		<label id="elh_bdv_completado" for="x_completado" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->completado->caption() ?><?php echo $bdv_edit->completado->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->completado->cellAttributes() ?>>
<span id="el_bdv_completado">
<input type="text" data-table="bdv" data-field="x_completado" name="x_completado" id="x_completado" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($bdv_edit->completado->getPlaceHolder()) ?>" value="<?php echo $bdv_edit->completado->EditValue ?>"<?php echo $bdv_edit->completado->editAttributes() ?>>
</span>
<?php echo $bdv_edit->completado->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_2_1_R->Visible) { // 2_1_R ?>
	<div id="r__2_1_R" class="form-group row">
		<label id="elh_bdv__2_1_R" for="x__2_1_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_2_1_R->caption() ?><?php echo $bdv_edit->_2_1_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_2_1_R->cellAttributes() ?>>
<span id="el_bdv__2_1_R">
<textarea data-table="bdv" data-field="x__2_1_R" name="x__2_1_R" id="x__2_1_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_2_1_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_2_1_R->editAttributes() ?>><?php echo $bdv_edit->_2_1_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_2_1_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_2_2_R->Visible) { // 2_2_R ?>
	<div id="r__2_2_R" class="form-group row">
		<label id="elh_bdv__2_2_R" for="x__2_2_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_2_2_R->caption() ?><?php echo $bdv_edit->_2_2_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_2_2_R->cellAttributes() ?>>
<span id="el_bdv__2_2_R">
<textarea data-table="bdv" data-field="x__2_2_R" name="x__2_2_R" id="x__2_2_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_2_2_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_2_2_R->editAttributes() ?>><?php echo $bdv_edit->_2_2_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_2_2_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_2_3_R->Visible) { // 2_3_R ?>
	<div id="r__2_3_R" class="form-group row">
		<label id="elh_bdv__2_3_R" for="x__2_3_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_2_3_R->caption() ?><?php echo $bdv_edit->_2_3_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_2_3_R->cellAttributes() ?>>
<span id="el_bdv__2_3_R">
<textarea data-table="bdv" data-field="x__2_3_R" name="x__2_3_R" id="x__2_3_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_2_3_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_2_3_R->editAttributes() ?>><?php echo $bdv_edit->_2_3_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_2_3_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_3_4_R->Visible) { // 3_4_R ?>
	<div id="r__3_4_R" class="form-group row">
		<label id="elh_bdv__3_4_R" for="x__3_4_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_3_4_R->caption() ?><?php echo $bdv_edit->_3_4_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_3_4_R->cellAttributes() ?>>
<span id="el_bdv__3_4_R">
<textarea data-table="bdv" data-field="x__3_4_R" name="x__3_4_R" id="x__3_4_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_3_4_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_3_4_R->editAttributes() ?>><?php echo $bdv_edit->_3_4_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_3_4_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_4_5_R->Visible) { // 4_5_R ?>
	<div id="r__4_5_R" class="form-group row">
		<label id="elh_bdv__4_5_R" for="x__4_5_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_4_5_R->caption() ?><?php echo $bdv_edit->_4_5_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_4_5_R->cellAttributes() ?>>
<span id="el_bdv__4_5_R">
<textarea data-table="bdv" data-field="x__4_5_R" name="x__4_5_R" id="x__4_5_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_4_5_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_4_5_R->editAttributes() ?>><?php echo $bdv_edit->_4_5_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_4_5_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_4_6_R->Visible) { // 4_6_R ?>
	<div id="r__4_6_R" class="form-group row">
		<label id="elh_bdv__4_6_R" for="x__4_6_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_4_6_R->caption() ?><?php echo $bdv_edit->_4_6_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_4_6_R->cellAttributes() ?>>
<span id="el_bdv__4_6_R">
<textarea data-table="bdv" data-field="x__4_6_R" name="x__4_6_R" id="x__4_6_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_4_6_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_4_6_R->editAttributes() ?>><?php echo $bdv_edit->_4_6_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_4_6_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_4_7_R->Visible) { // 4_7_R ?>
	<div id="r__4_7_R" class="form-group row">
		<label id="elh_bdv__4_7_R" for="x__4_7_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_4_7_R->caption() ?><?php echo $bdv_edit->_4_7_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_4_7_R->cellAttributes() ?>>
<span id="el_bdv__4_7_R">
<textarea data-table="bdv" data-field="x__4_7_R" name="x__4_7_R" id="x__4_7_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_4_7_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_4_7_R->editAttributes() ?>><?php echo $bdv_edit->_4_7_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_4_7_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_4_8_R->Visible) { // 4_8_R ?>
	<div id="r__4_8_R" class="form-group row">
		<label id="elh_bdv__4_8_R" for="x__4_8_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_4_8_R->caption() ?><?php echo $bdv_edit->_4_8_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_4_8_R->cellAttributes() ?>>
<span id="el_bdv__4_8_R">
<textarea data-table="bdv" data-field="x__4_8_R" name="x__4_8_R" id="x__4_8_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_4_8_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_4_8_R->editAttributes() ?>><?php echo $bdv_edit->_4_8_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_4_8_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_5_9_R->Visible) { // 5_9_R ?>
	<div id="r__5_9_R" class="form-group row">
		<label id="elh_bdv__5_9_R" for="x__5_9_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_5_9_R->caption() ?><?php echo $bdv_edit->_5_9_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_5_9_R->cellAttributes() ?>>
<span id="el_bdv__5_9_R">
<textarea data-table="bdv" data-field="x__5_9_R" name="x__5_9_R" id="x__5_9_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_5_9_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_5_9_R->editAttributes() ?>><?php echo $bdv_edit->_5_9_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_5_9_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_5_10_R->Visible) { // 5_10_R ?>
	<div id="r__5_10_R" class="form-group row">
		<label id="elh_bdv__5_10_R" for="x__5_10_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_5_10_R->caption() ?><?php echo $bdv_edit->_5_10_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_5_10_R->cellAttributes() ?>>
<span id="el_bdv__5_10_R">
<textarea data-table="bdv" data-field="x__5_10_R" name="x__5_10_R" id="x__5_10_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_5_10_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_5_10_R->editAttributes() ?>><?php echo $bdv_edit->_5_10_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_5_10_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_5_11_R->Visible) { // 5_11_R ?>
	<div id="r__5_11_R" class="form-group row">
		<label id="elh_bdv__5_11_R" for="x__5_11_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_5_11_R->caption() ?><?php echo $bdv_edit->_5_11_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_5_11_R->cellAttributes() ?>>
<span id="el_bdv__5_11_R">
<textarea data-table="bdv" data-field="x__5_11_R" name="x__5_11_R" id="x__5_11_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_5_11_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_5_11_R->editAttributes() ?>><?php echo $bdv_edit->_5_11_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_5_11_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_5_12_R->Visible) { // 5_12_R ?>
	<div id="r__5_12_R" class="form-group row">
		<label id="elh_bdv__5_12_R" for="x__5_12_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_5_12_R->caption() ?><?php echo $bdv_edit->_5_12_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_5_12_R->cellAttributes() ?>>
<span id="el_bdv__5_12_R">
<textarea data-table="bdv" data-field="x__5_12_R" name="x__5_12_R" id="x__5_12_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_5_12_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_5_12_R->editAttributes() ?>><?php echo $bdv_edit->_5_12_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_5_12_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_5_13_R->Visible) { // 5_13_R ?>
	<div id="r__5_13_R" class="form-group row">
		<label id="elh_bdv__5_13_R" for="x__5_13_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_5_13_R->caption() ?><?php echo $bdv_edit->_5_13_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_5_13_R->cellAttributes() ?>>
<span id="el_bdv__5_13_R">
<textarea data-table="bdv" data-field="x__5_13_R" name="x__5_13_R" id="x__5_13_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_5_13_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_5_13_R->editAttributes() ?>><?php echo $bdv_edit->_5_13_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_5_13_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_5_14_R->Visible) { // 5_14_R ?>
	<div id="r__5_14_R" class="form-group row">
		<label id="elh_bdv__5_14_R" for="x__5_14_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_5_14_R->caption() ?><?php echo $bdv_edit->_5_14_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_5_14_R->cellAttributes() ?>>
<span id="el_bdv__5_14_R">
<textarea data-table="bdv" data-field="x__5_14_R" name="x__5_14_R" id="x__5_14_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_5_14_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_5_14_R->editAttributes() ?>><?php echo $bdv_edit->_5_14_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_5_14_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_5_51_R->Visible) { // 5_51_R ?>
	<div id="r__5_51_R" class="form-group row">
		<label id="elh_bdv__5_51_R" for="x__5_51_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_5_51_R->caption() ?><?php echo $bdv_edit->_5_51_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_5_51_R->cellAttributes() ?>>
<span id="el_bdv__5_51_R">
<textarea data-table="bdv" data-field="x__5_51_R" name="x__5_51_R" id="x__5_51_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_5_51_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_5_51_R->editAttributes() ?>><?php echo $bdv_edit->_5_51_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_5_51_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_6_15_R->Visible) { // 6_15_R ?>
	<div id="r__6_15_R" class="form-group row">
		<label id="elh_bdv__6_15_R" for="x__6_15_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_6_15_R->caption() ?><?php echo $bdv_edit->_6_15_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_6_15_R->cellAttributes() ?>>
<span id="el_bdv__6_15_R">
<textarea data-table="bdv" data-field="x__6_15_R" name="x__6_15_R" id="x__6_15_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_6_15_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_6_15_R->editAttributes() ?>><?php echo $bdv_edit->_6_15_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_6_15_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_6_16_R->Visible) { // 6_16_R ?>
	<div id="r__6_16_R" class="form-group row">
		<label id="elh_bdv__6_16_R" for="x__6_16_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_6_16_R->caption() ?><?php echo $bdv_edit->_6_16_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_6_16_R->cellAttributes() ?>>
<span id="el_bdv__6_16_R">
<textarea data-table="bdv" data-field="x__6_16_R" name="x__6_16_R" id="x__6_16_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_6_16_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_6_16_R->editAttributes() ?>><?php echo $bdv_edit->_6_16_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_6_16_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_6_17_R->Visible) { // 6_17_R ?>
	<div id="r__6_17_R" class="form-group row">
		<label id="elh_bdv__6_17_R" for="x__6_17_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_6_17_R->caption() ?><?php echo $bdv_edit->_6_17_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_6_17_R->cellAttributes() ?>>
<span id="el_bdv__6_17_R">
<textarea data-table="bdv" data-field="x__6_17_R" name="x__6_17_R" id="x__6_17_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_6_17_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_6_17_R->editAttributes() ?>><?php echo $bdv_edit->_6_17_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_6_17_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_6_18_R->Visible) { // 6_18_R ?>
	<div id="r__6_18_R" class="form-group row">
		<label id="elh_bdv__6_18_R" for="x__6_18_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_6_18_R->caption() ?><?php echo $bdv_edit->_6_18_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_6_18_R->cellAttributes() ?>>
<span id="el_bdv__6_18_R">
<textarea data-table="bdv" data-field="x__6_18_R" name="x__6_18_R" id="x__6_18_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_6_18_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_6_18_R->editAttributes() ?>><?php echo $bdv_edit->_6_18_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_6_18_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_6_19_R->Visible) { // 6_19_R ?>
	<div id="r__6_19_R" class="form-group row">
		<label id="elh_bdv__6_19_R" for="x__6_19_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_6_19_R->caption() ?><?php echo $bdv_edit->_6_19_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_6_19_R->cellAttributes() ?>>
<span id="el_bdv__6_19_R">
<textarea data-table="bdv" data-field="x__6_19_R" name="x__6_19_R" id="x__6_19_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_6_19_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_6_19_R->editAttributes() ?>><?php echo $bdv_edit->_6_19_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_6_19_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_6_20_R->Visible) { // 6_20_R ?>
	<div id="r__6_20_R" class="form-group row">
		<label id="elh_bdv__6_20_R" for="x__6_20_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_6_20_R->caption() ?><?php echo $bdv_edit->_6_20_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_6_20_R->cellAttributes() ?>>
<span id="el_bdv__6_20_R">
<textarea data-table="bdv" data-field="x__6_20_R" name="x__6_20_R" id="x__6_20_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_6_20_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_6_20_R->editAttributes() ?>><?php echo $bdv_edit->_6_20_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_6_20_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_6_52_R->Visible) { // 6_52_R ?>
	<div id="r__6_52_R" class="form-group row">
		<label id="elh_bdv__6_52_R" for="x__6_52_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_6_52_R->caption() ?><?php echo $bdv_edit->_6_52_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_6_52_R->cellAttributes() ?>>
<span id="el_bdv__6_52_R">
<textarea data-table="bdv" data-field="x__6_52_R" name="x__6_52_R" id="x__6_52_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_6_52_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_6_52_R->editAttributes() ?>><?php echo $bdv_edit->_6_52_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_6_52_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_7_21_R->Visible) { // 7_21_R ?>
	<div id="r__7_21_R" class="form-group row">
		<label id="elh_bdv__7_21_R" for="x__7_21_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_7_21_R->caption() ?><?php echo $bdv_edit->_7_21_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_7_21_R->cellAttributes() ?>>
<span id="el_bdv__7_21_R">
<textarea data-table="bdv" data-field="x__7_21_R" name="x__7_21_R" id="x__7_21_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_7_21_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_7_21_R->editAttributes() ?>><?php echo $bdv_edit->_7_21_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_7_21_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_8_22_R->Visible) { // 8_22_R ?>
	<div id="r__8_22_R" class="form-group row">
		<label id="elh_bdv__8_22_R" for="x__8_22_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_8_22_R->caption() ?><?php echo $bdv_edit->_8_22_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_8_22_R->cellAttributes() ?>>
<span id="el_bdv__8_22_R">
<textarea data-table="bdv" data-field="x__8_22_R" name="x__8_22_R" id="x__8_22_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_8_22_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_8_22_R->editAttributes() ?>><?php echo $bdv_edit->_8_22_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_8_22_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_8_23_R->Visible) { // 8_23_R ?>
	<div id="r__8_23_R" class="form-group row">
		<label id="elh_bdv__8_23_R" for="x__8_23_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_8_23_R->caption() ?><?php echo $bdv_edit->_8_23_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_8_23_R->cellAttributes() ?>>
<span id="el_bdv__8_23_R">
<textarea data-table="bdv" data-field="x__8_23_R" name="x__8_23_R" id="x__8_23_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_8_23_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_8_23_R->editAttributes() ?>><?php echo $bdv_edit->_8_23_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_8_23_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_8_24_R->Visible) { // 8_24_R ?>
	<div id="r__8_24_R" class="form-group row">
		<label id="elh_bdv__8_24_R" for="x__8_24_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_8_24_R->caption() ?><?php echo $bdv_edit->_8_24_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_8_24_R->cellAttributes() ?>>
<span id="el_bdv__8_24_R">
<textarea data-table="bdv" data-field="x__8_24_R" name="x__8_24_R" id="x__8_24_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_8_24_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_8_24_R->editAttributes() ?>><?php echo $bdv_edit->_8_24_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_8_24_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_8_25_R->Visible) { // 8_25_R ?>
	<div id="r__8_25_R" class="form-group row">
		<label id="elh_bdv__8_25_R" for="x__8_25_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_8_25_R->caption() ?><?php echo $bdv_edit->_8_25_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_8_25_R->cellAttributes() ?>>
<span id="el_bdv__8_25_R">
<textarea data-table="bdv" data-field="x__8_25_R" name="x__8_25_R" id="x__8_25_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_8_25_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_8_25_R->editAttributes() ?>><?php echo $bdv_edit->_8_25_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_8_25_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_9_26_R->Visible) { // 9_26_R ?>
	<div id="r__9_26_R" class="form-group row">
		<label id="elh_bdv__9_26_R" for="x__9_26_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_9_26_R->caption() ?><?php echo $bdv_edit->_9_26_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_9_26_R->cellAttributes() ?>>
<span id="el_bdv__9_26_R">
<textarea data-table="bdv" data-field="x__9_26_R" name="x__9_26_R" id="x__9_26_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_9_26_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_9_26_R->editAttributes() ?>><?php echo $bdv_edit->_9_26_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_9_26_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_9_27_R->Visible) { // 9_27_R ?>
	<div id="r__9_27_R" class="form-group row">
		<label id="elh_bdv__9_27_R" for="x__9_27_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_9_27_R->caption() ?><?php echo $bdv_edit->_9_27_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_9_27_R->cellAttributes() ?>>
<span id="el_bdv__9_27_R">
<textarea data-table="bdv" data-field="x__9_27_R" name="x__9_27_R" id="x__9_27_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_9_27_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_9_27_R->editAttributes() ?>><?php echo $bdv_edit->_9_27_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_9_27_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_9_28_R->Visible) { // 9_28_R ?>
	<div id="r__9_28_R" class="form-group row">
		<label id="elh_bdv__9_28_R" for="x__9_28_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_9_28_R->caption() ?><?php echo $bdv_edit->_9_28_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_9_28_R->cellAttributes() ?>>
<span id="el_bdv__9_28_R">
<textarea data-table="bdv" data-field="x__9_28_R" name="x__9_28_R" id="x__9_28_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_9_28_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_9_28_R->editAttributes() ?>><?php echo $bdv_edit->_9_28_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_9_28_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_9_29_R->Visible) { // 9_29_R ?>
	<div id="r__9_29_R" class="form-group row">
		<label id="elh_bdv__9_29_R" for="x__9_29_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_9_29_R->caption() ?><?php echo $bdv_edit->_9_29_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_9_29_R->cellAttributes() ?>>
<span id="el_bdv__9_29_R">
<textarea data-table="bdv" data-field="x__9_29_R" name="x__9_29_R" id="x__9_29_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_9_29_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_9_29_R->editAttributes() ?>><?php echo $bdv_edit->_9_29_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_9_29_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_9_30_R->Visible) { // 9_30_R ?>
	<div id="r__9_30_R" class="form-group row">
		<label id="elh_bdv__9_30_R" for="x__9_30_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_9_30_R->caption() ?><?php echo $bdv_edit->_9_30_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_9_30_R->cellAttributes() ?>>
<span id="el_bdv__9_30_R">
<textarea data-table="bdv" data-field="x__9_30_R" name="x__9_30_R" id="x__9_30_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_9_30_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_9_30_R->editAttributes() ?>><?php echo $bdv_edit->_9_30_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_9_30_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_9_31_R->Visible) { // 9_31_R ?>
	<div id="r__9_31_R" class="form-group row">
		<label id="elh_bdv__9_31_R" for="x__9_31_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_9_31_R->caption() ?><?php echo $bdv_edit->_9_31_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_9_31_R->cellAttributes() ?>>
<span id="el_bdv__9_31_R">
<textarea data-table="bdv" data-field="x__9_31_R" name="x__9_31_R" id="x__9_31_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_9_31_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_9_31_R->editAttributes() ?>><?php echo $bdv_edit->_9_31_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_9_31_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_9_32_R->Visible) { // 9_32_R ?>
	<div id="r__9_32_R" class="form-group row">
		<label id="elh_bdv__9_32_R" for="x__9_32_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_9_32_R->caption() ?><?php echo $bdv_edit->_9_32_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_9_32_R->cellAttributes() ?>>
<span id="el_bdv__9_32_R">
<textarea data-table="bdv" data-field="x__9_32_R" name="x__9_32_R" id="x__9_32_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_9_32_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_9_32_R->editAttributes() ?>><?php echo $bdv_edit->_9_32_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_9_32_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_9_33_R->Visible) { // 9_33_R ?>
	<div id="r__9_33_R" class="form-group row">
		<label id="elh_bdv__9_33_R" for="x__9_33_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_9_33_R->caption() ?><?php echo $bdv_edit->_9_33_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_9_33_R->cellAttributes() ?>>
<span id="el_bdv__9_33_R">
<textarea data-table="bdv" data-field="x__9_33_R" name="x__9_33_R" id="x__9_33_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_9_33_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_9_33_R->editAttributes() ?>><?php echo $bdv_edit->_9_33_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_9_33_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_9_34_R->Visible) { // 9_34_R ?>
	<div id="r__9_34_R" class="form-group row">
		<label id="elh_bdv__9_34_R" for="x__9_34_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_9_34_R->caption() ?><?php echo $bdv_edit->_9_34_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_9_34_R->cellAttributes() ?>>
<span id="el_bdv__9_34_R">
<textarea data-table="bdv" data-field="x__9_34_R" name="x__9_34_R" id="x__9_34_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_9_34_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_9_34_R->editAttributes() ?>><?php echo $bdv_edit->_9_34_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_9_34_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_9_35_R->Visible) { // 9_35_R ?>
	<div id="r__9_35_R" class="form-group row">
		<label id="elh_bdv__9_35_R" for="x__9_35_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_9_35_R->caption() ?><?php echo $bdv_edit->_9_35_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_9_35_R->cellAttributes() ?>>
<span id="el_bdv__9_35_R">
<textarea data-table="bdv" data-field="x__9_35_R" name="x__9_35_R" id="x__9_35_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_9_35_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_9_35_R->editAttributes() ?>><?php echo $bdv_edit->_9_35_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_9_35_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_9_36_R->Visible) { // 9_36_R ?>
	<div id="r__9_36_R" class="form-group row">
		<label id="elh_bdv__9_36_R" for="x__9_36_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_9_36_R->caption() ?><?php echo $bdv_edit->_9_36_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_9_36_R->cellAttributes() ?>>
<span id="el_bdv__9_36_R">
<textarea data-table="bdv" data-field="x__9_36_R" name="x__9_36_R" id="x__9_36_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_9_36_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_9_36_R->editAttributes() ?>><?php echo $bdv_edit->_9_36_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_9_36_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_9_37_R->Visible) { // 9_37_R ?>
	<div id="r__9_37_R" class="form-group row">
		<label id="elh_bdv__9_37_R" for="x__9_37_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_9_37_R->caption() ?><?php echo $bdv_edit->_9_37_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_9_37_R->cellAttributes() ?>>
<span id="el_bdv__9_37_R">
<textarea data-table="bdv" data-field="x__9_37_R" name="x__9_37_R" id="x__9_37_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_9_37_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_9_37_R->editAttributes() ?>><?php echo $bdv_edit->_9_37_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_9_37_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_9_38_R->Visible) { // 9_38_R ?>
	<div id="r__9_38_R" class="form-group row">
		<label id="elh_bdv__9_38_R" for="x__9_38_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_9_38_R->caption() ?><?php echo $bdv_edit->_9_38_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_9_38_R->cellAttributes() ?>>
<span id="el_bdv__9_38_R">
<textarea data-table="bdv" data-field="x__9_38_R" name="x__9_38_R" id="x__9_38_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_9_38_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_9_38_R->editAttributes() ?>><?php echo $bdv_edit->_9_38_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_9_38_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_9_39_R->Visible) { // 9_39_R ?>
	<div id="r__9_39_R" class="form-group row">
		<label id="elh_bdv__9_39_R" for="x__9_39_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_9_39_R->caption() ?><?php echo $bdv_edit->_9_39_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_9_39_R->cellAttributes() ?>>
<span id="el_bdv__9_39_R">
<textarea data-table="bdv" data-field="x__9_39_R" name="x__9_39_R" id="x__9_39_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_9_39_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_9_39_R->editAttributes() ?>><?php echo $bdv_edit->_9_39_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_9_39_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_10_40_R->Visible) { // 10_40_R ?>
	<div id="r__10_40_R" class="form-group row">
		<label id="elh_bdv__10_40_R" for="x__10_40_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_10_40_R->caption() ?><?php echo $bdv_edit->_10_40_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_10_40_R->cellAttributes() ?>>
<span id="el_bdv__10_40_R">
<textarea data-table="bdv" data-field="x__10_40_R" name="x__10_40_R" id="x__10_40_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_10_40_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_10_40_R->editAttributes() ?>><?php echo $bdv_edit->_10_40_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_10_40_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_10_41_R->Visible) { // 10_41_R ?>
	<div id="r__10_41_R" class="form-group row">
		<label id="elh_bdv__10_41_R" for="x__10_41_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_10_41_R->caption() ?><?php echo $bdv_edit->_10_41_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_10_41_R->cellAttributes() ?>>
<span id="el_bdv__10_41_R">
<textarea data-table="bdv" data-field="x__10_41_R" name="x__10_41_R" id="x__10_41_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_10_41_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_10_41_R->editAttributes() ?>><?php echo $bdv_edit->_10_41_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_10_41_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_11_42_R->Visible) { // 11_42_R ?>
	<div id="r__11_42_R" class="form-group row">
		<label id="elh_bdv__11_42_R" for="x__11_42_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_11_42_R->caption() ?><?php echo $bdv_edit->_11_42_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_11_42_R->cellAttributes() ?>>
<span id="el_bdv__11_42_R">
<textarea data-table="bdv" data-field="x__11_42_R" name="x__11_42_R" id="x__11_42_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_11_42_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_11_42_R->editAttributes() ?>><?php echo $bdv_edit->_11_42_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_11_42_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_11_43_R->Visible) { // 11_43_R ?>
	<div id="r__11_43_R" class="form-group row">
		<label id="elh_bdv__11_43_R" for="x__11_43_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_11_43_R->caption() ?><?php echo $bdv_edit->_11_43_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_11_43_R->cellAttributes() ?>>
<span id="el_bdv__11_43_R">
<textarea data-table="bdv" data-field="x__11_43_R" name="x__11_43_R" id="x__11_43_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_11_43_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_11_43_R->editAttributes() ?>><?php echo $bdv_edit->_11_43_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_11_43_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_12_44_R->Visible) { // 12_44_R ?>
	<div id="r__12_44_R" class="form-group row">
		<label id="elh_bdv__12_44_R" for="x__12_44_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_12_44_R->caption() ?><?php echo $bdv_edit->_12_44_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_12_44_R->cellAttributes() ?>>
<span id="el_bdv__12_44_R">
<textarea data-table="bdv" data-field="x__12_44_R" name="x__12_44_R" id="x__12_44_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_12_44_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_12_44_R->editAttributes() ?>><?php echo $bdv_edit->_12_44_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_12_44_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_12_45_R->Visible) { // 12_45_R ?>
	<div id="r__12_45_R" class="form-group row">
		<label id="elh_bdv__12_45_R" for="x__12_45_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_12_45_R->caption() ?><?php echo $bdv_edit->_12_45_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_12_45_R->cellAttributes() ?>>
<span id="el_bdv__12_45_R">
<textarea data-table="bdv" data-field="x__12_45_R" name="x__12_45_R" id="x__12_45_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_12_45_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_12_45_R->editAttributes() ?>><?php echo $bdv_edit->_12_45_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_12_45_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_12_46_R->Visible) { // 12_46_R ?>
	<div id="r__12_46_R" class="form-group row">
		<label id="elh_bdv__12_46_R" for="x__12_46_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_12_46_R->caption() ?><?php echo $bdv_edit->_12_46_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_12_46_R->cellAttributes() ?>>
<span id="el_bdv__12_46_R">
<textarea data-table="bdv" data-field="x__12_46_R" name="x__12_46_R" id="x__12_46_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_12_46_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_12_46_R->editAttributes() ?>><?php echo $bdv_edit->_12_46_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_12_46_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_12_47_R->Visible) { // 12_47_R ?>
	<div id="r__12_47_R" class="form-group row">
		<label id="elh_bdv__12_47_R" for="x__12_47_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_12_47_R->caption() ?><?php echo $bdv_edit->_12_47_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_12_47_R->cellAttributes() ?>>
<span id="el_bdv__12_47_R">
<textarea data-table="bdv" data-field="x__12_47_R" name="x__12_47_R" id="x__12_47_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_12_47_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_12_47_R->editAttributes() ?>><?php echo $bdv_edit->_12_47_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_12_47_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_12_48_R->Visible) { // 12_48_R ?>
	<div id="r__12_48_R" class="form-group row">
		<label id="elh_bdv__12_48_R" for="x__12_48_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_12_48_R->caption() ?><?php echo $bdv_edit->_12_48_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_12_48_R->cellAttributes() ?>>
<span id="el_bdv__12_48_R">
<textarea data-table="bdv" data-field="x__12_48_R" name="x__12_48_R" id="x__12_48_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_12_48_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_12_48_R->editAttributes() ?>><?php echo $bdv_edit->_12_48_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_12_48_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_12_49_R->Visible) { // 12_49_R ?>
	<div id="r__12_49_R" class="form-group row">
		<label id="elh_bdv__12_49_R" for="x__12_49_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_12_49_R->caption() ?><?php echo $bdv_edit->_12_49_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_12_49_R->cellAttributes() ?>>
<span id="el_bdv__12_49_R">
<textarea data-table="bdv" data-field="x__12_49_R" name="x__12_49_R" id="x__12_49_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_12_49_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_12_49_R->editAttributes() ?>><?php echo $bdv_edit->_12_49_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_12_49_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_12_50_R->Visible) { // 12_50_R ?>
	<div id="r__12_50_R" class="form-group row">
		<label id="elh_bdv__12_50_R" for="x__12_50_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_12_50_R->caption() ?><?php echo $bdv_edit->_12_50_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_12_50_R->cellAttributes() ?>>
<span id="el_bdv__12_50_R">
<textarea data-table="bdv" data-field="x__12_50_R" name="x__12_50_R" id="x__12_50_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_12_50_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_12_50_R->editAttributes() ?>><?php echo $bdv_edit->_12_50_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_12_50_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_1__R->Visible) { // 1__R ?>
	<div id="r__1__R" class="form-group row">
		<label id="elh_bdv__1__R" for="x__1__R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_1__R->caption() ?><?php echo $bdv_edit->_1__R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_1__R->cellAttributes() ?>>
<span id="el_bdv__1__R">
<textarea data-table="bdv" data-field="x__1__R" name="x__1__R" id="x__1__R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_1__R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_1__R->editAttributes() ?>><?php echo $bdv_edit->_1__R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_1__R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_13_54_R->Visible) { // 13_54_R ?>
	<div id="r__13_54_R" class="form-group row">
		<label id="elh_bdv__13_54_R" for="x__13_54_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_13_54_R->caption() ?><?php echo $bdv_edit->_13_54_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_13_54_R->cellAttributes() ?>>
<span id="el_bdv__13_54_R">
<textarea data-table="bdv" data-field="x__13_54_R" name="x__13_54_R" id="x__13_54_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_13_54_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_13_54_R->editAttributes() ?>><?php echo $bdv_edit->_13_54_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_13_54_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_13_54_1_R->Visible) { // 13_54_1_R ?>
	<div id="r__13_54_1_R" class="form-group row">
		<label id="elh_bdv__13_54_1_R" for="x__13_54_1_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_13_54_1_R->caption() ?><?php echo $bdv_edit->_13_54_1_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_13_54_1_R->cellAttributes() ?>>
<span id="el_bdv__13_54_1_R">
<textarea data-table="bdv" data-field="x__13_54_1_R" name="x__13_54_1_R" id="x__13_54_1_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_13_54_1_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_13_54_1_R->editAttributes() ?>><?php echo $bdv_edit->_13_54_1_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_13_54_1_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_13_54_2_R->Visible) { // 13_54_2_R ?>
	<div id="r__13_54_2_R" class="form-group row">
		<label id="elh_bdv__13_54_2_R" for="x__13_54_2_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_13_54_2_R->caption() ?><?php echo $bdv_edit->_13_54_2_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_13_54_2_R->cellAttributes() ?>>
<span id="el_bdv__13_54_2_R">
<textarea data-table="bdv" data-field="x__13_54_2_R" name="x__13_54_2_R" id="x__13_54_2_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_13_54_2_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_13_54_2_R->editAttributes() ?>><?php echo $bdv_edit->_13_54_2_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_13_54_2_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_13_55_R->Visible) { // 13_55_R ?>
	<div id="r__13_55_R" class="form-group row">
		<label id="elh_bdv__13_55_R" for="x__13_55_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_13_55_R->caption() ?><?php echo $bdv_edit->_13_55_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_13_55_R->cellAttributes() ?>>
<span id="el_bdv__13_55_R">
<textarea data-table="bdv" data-field="x__13_55_R" name="x__13_55_R" id="x__13_55_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_13_55_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_13_55_R->editAttributes() ?>><?php echo $bdv_edit->_13_55_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_13_55_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_13_55_1_R->Visible) { // 13_55_1_R ?>
	<div id="r__13_55_1_R" class="form-group row">
		<label id="elh_bdv__13_55_1_R" for="x__13_55_1_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_13_55_1_R->caption() ?><?php echo $bdv_edit->_13_55_1_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_13_55_1_R->cellAttributes() ?>>
<span id="el_bdv__13_55_1_R">
<textarea data-table="bdv" data-field="x__13_55_1_R" name="x__13_55_1_R" id="x__13_55_1_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_13_55_1_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_13_55_1_R->editAttributes() ?>><?php echo $bdv_edit->_13_55_1_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_13_55_1_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_13_55_2_R->Visible) { // 13_55_2_R ?>
	<div id="r__13_55_2_R" class="form-group row">
		<label id="elh_bdv__13_55_2_R" for="x__13_55_2_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_13_55_2_R->caption() ?><?php echo $bdv_edit->_13_55_2_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_13_55_2_R->cellAttributes() ?>>
<span id="el_bdv__13_55_2_R">
<textarea data-table="bdv" data-field="x__13_55_2_R" name="x__13_55_2_R" id="x__13_55_2_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_13_55_2_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_13_55_2_R->editAttributes() ?>><?php echo $bdv_edit->_13_55_2_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_13_55_2_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_13_56_R->Visible) { // 13_56_R ?>
	<div id="r__13_56_R" class="form-group row">
		<label id="elh_bdv__13_56_R" for="x__13_56_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_13_56_R->caption() ?><?php echo $bdv_edit->_13_56_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_13_56_R->cellAttributes() ?>>
<span id="el_bdv__13_56_R">
<textarea data-table="bdv" data-field="x__13_56_R" name="x__13_56_R" id="x__13_56_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_13_56_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_13_56_R->editAttributes() ?>><?php echo $bdv_edit->_13_56_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_13_56_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_13_56_1_R->Visible) { // 13_56_1_R ?>
	<div id="r__13_56_1_R" class="form-group row">
		<label id="elh_bdv__13_56_1_R" for="x__13_56_1_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_13_56_1_R->caption() ?><?php echo $bdv_edit->_13_56_1_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_13_56_1_R->cellAttributes() ?>>
<span id="el_bdv__13_56_1_R">
<textarea data-table="bdv" data-field="x__13_56_1_R" name="x__13_56_1_R" id="x__13_56_1_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_13_56_1_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_13_56_1_R->editAttributes() ?>><?php echo $bdv_edit->_13_56_1_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_13_56_1_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_13_56_2_R->Visible) { // 13_56_2_R ?>
	<div id="r__13_56_2_R" class="form-group row">
		<label id="elh_bdv__13_56_2_R" for="x__13_56_2_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_13_56_2_R->caption() ?><?php echo $bdv_edit->_13_56_2_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_13_56_2_R->cellAttributes() ?>>
<span id="el_bdv__13_56_2_R">
<textarea data-table="bdv" data-field="x__13_56_2_R" name="x__13_56_2_R" id="x__13_56_2_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_13_56_2_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_13_56_2_R->editAttributes() ?>><?php echo $bdv_edit->_13_56_2_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_13_56_2_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_12_53_R->Visible) { // 12_53_R ?>
	<div id="r__12_53_R" class="form-group row">
		<label id="elh_bdv__12_53_R" for="x__12_53_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_12_53_R->caption() ?><?php echo $bdv_edit->_12_53_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_12_53_R->cellAttributes() ?>>
<span id="el_bdv__12_53_R">
<textarea data-table="bdv" data-field="x__12_53_R" name="x__12_53_R" id="x__12_53_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_12_53_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_12_53_R->editAttributes() ?>><?php echo $bdv_edit->_12_53_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_12_53_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_12_53_1_R->Visible) { // 12_53_1_R ?>
	<div id="r__12_53_1_R" class="form-group row">
		<label id="elh_bdv__12_53_1_R" for="x__12_53_1_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_12_53_1_R->caption() ?><?php echo $bdv_edit->_12_53_1_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_12_53_1_R->cellAttributes() ?>>
<span id="el_bdv__12_53_1_R">
<textarea data-table="bdv" data-field="x__12_53_1_R" name="x__12_53_1_R" id="x__12_53_1_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_12_53_1_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_12_53_1_R->editAttributes() ?>><?php echo $bdv_edit->_12_53_1_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_12_53_1_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_12_53_2_R->Visible) { // 12_53_2_R ?>
	<div id="r__12_53_2_R" class="form-group row">
		<label id="elh_bdv__12_53_2_R" for="x__12_53_2_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_12_53_2_R->caption() ?><?php echo $bdv_edit->_12_53_2_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_12_53_2_R->cellAttributes() ?>>
<span id="el_bdv__12_53_2_R">
<textarea data-table="bdv" data-field="x__12_53_2_R" name="x__12_53_2_R" id="x__12_53_2_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_12_53_2_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_12_53_2_R->editAttributes() ?>><?php echo $bdv_edit->_12_53_2_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_12_53_2_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_12_53_3_R->Visible) { // 12_53_3_R ?>
	<div id="r__12_53_3_R" class="form-group row">
		<label id="elh_bdv__12_53_3_R" for="x__12_53_3_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_12_53_3_R->caption() ?><?php echo $bdv_edit->_12_53_3_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_12_53_3_R->cellAttributes() ?>>
<span id="el_bdv__12_53_3_R">
<textarea data-table="bdv" data-field="x__12_53_3_R" name="x__12_53_3_R" id="x__12_53_3_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_12_53_3_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_12_53_3_R->editAttributes() ?>><?php echo $bdv_edit->_12_53_3_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_12_53_3_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_12_53_4_R->Visible) { // 12_53_4_R ?>
	<div id="r__12_53_4_R" class="form-group row">
		<label id="elh_bdv__12_53_4_R" for="x__12_53_4_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_12_53_4_R->caption() ?><?php echo $bdv_edit->_12_53_4_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_12_53_4_R->cellAttributes() ?>>
<span id="el_bdv__12_53_4_R">
<textarea data-table="bdv" data-field="x__12_53_4_R" name="x__12_53_4_R" id="x__12_53_4_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_12_53_4_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_12_53_4_R->editAttributes() ?>><?php echo $bdv_edit->_12_53_4_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_12_53_4_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_12_53_5_R->Visible) { // 12_53_5_R ?>
	<div id="r__12_53_5_R" class="form-group row">
		<label id="elh_bdv__12_53_5_R" for="x__12_53_5_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_12_53_5_R->caption() ?><?php echo $bdv_edit->_12_53_5_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_12_53_5_R->cellAttributes() ?>>
<span id="el_bdv__12_53_5_R">
<textarea data-table="bdv" data-field="x__12_53_5_R" name="x__12_53_5_R" id="x__12_53_5_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_12_53_5_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_12_53_5_R->editAttributes() ?>><?php echo $bdv_edit->_12_53_5_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_12_53_5_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_12_53_6_R->Visible) { // 12_53_6_R ?>
	<div id="r__12_53_6_R" class="form-group row">
		<label id="elh_bdv__12_53_6_R" for="x__12_53_6_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_12_53_6_R->caption() ?><?php echo $bdv_edit->_12_53_6_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_12_53_6_R->cellAttributes() ?>>
<span id="el_bdv__12_53_6_R">
<textarea data-table="bdv" data-field="x__12_53_6_R" name="x__12_53_6_R" id="x__12_53_6_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_12_53_6_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_12_53_6_R->editAttributes() ?>><?php echo $bdv_edit->_12_53_6_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_12_53_6_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_13_57_R->Visible) { // 13_57_R ?>
	<div id="r__13_57_R" class="form-group row">
		<label id="elh_bdv__13_57_R" for="x__13_57_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_13_57_R->caption() ?><?php echo $bdv_edit->_13_57_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_13_57_R->cellAttributes() ?>>
<span id="el_bdv__13_57_R">
<textarea data-table="bdv" data-field="x__13_57_R" name="x__13_57_R" id="x__13_57_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_13_57_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_13_57_R->editAttributes() ?>><?php echo $bdv_edit->_13_57_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_13_57_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_13_57_1_R->Visible) { // 13_57_1_R ?>
	<div id="r__13_57_1_R" class="form-group row">
		<label id="elh_bdv__13_57_1_R" for="x__13_57_1_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_13_57_1_R->caption() ?><?php echo $bdv_edit->_13_57_1_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_13_57_1_R->cellAttributes() ?>>
<span id="el_bdv__13_57_1_R">
<textarea data-table="bdv" data-field="x__13_57_1_R" name="x__13_57_1_R" id="x__13_57_1_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_13_57_1_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_13_57_1_R->editAttributes() ?>><?php echo $bdv_edit->_13_57_1_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_13_57_1_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_13_57_2_R->Visible) { // 13_57_2_R ?>
	<div id="r__13_57_2_R" class="form-group row">
		<label id="elh_bdv__13_57_2_R" for="x__13_57_2_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_13_57_2_R->caption() ?><?php echo $bdv_edit->_13_57_2_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_13_57_2_R->cellAttributes() ?>>
<span id="el_bdv__13_57_2_R">
<textarea data-table="bdv" data-field="x__13_57_2_R" name="x__13_57_2_R" id="x__13_57_2_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_13_57_2_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_13_57_2_R->editAttributes() ?>><?php echo $bdv_edit->_13_57_2_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_13_57_2_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_13_58_R->Visible) { // 13_58_R ?>
	<div id="r__13_58_R" class="form-group row">
		<label id="elh_bdv__13_58_R" for="x__13_58_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_13_58_R->caption() ?><?php echo $bdv_edit->_13_58_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_13_58_R->cellAttributes() ?>>
<span id="el_bdv__13_58_R">
<textarea data-table="bdv" data-field="x__13_58_R" name="x__13_58_R" id="x__13_58_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_13_58_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_13_58_R->editAttributes() ?>><?php echo $bdv_edit->_13_58_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_13_58_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_13_58_1_R->Visible) { // 13_58_1_R ?>
	<div id="r__13_58_1_R" class="form-group row">
		<label id="elh_bdv__13_58_1_R" for="x__13_58_1_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_13_58_1_R->caption() ?><?php echo $bdv_edit->_13_58_1_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_13_58_1_R->cellAttributes() ?>>
<span id="el_bdv__13_58_1_R">
<textarea data-table="bdv" data-field="x__13_58_1_R" name="x__13_58_1_R" id="x__13_58_1_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_13_58_1_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_13_58_1_R->editAttributes() ?>><?php echo $bdv_edit->_13_58_1_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_13_58_1_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_13_58_2_R->Visible) { // 13_58_2_R ?>
	<div id="r__13_58_2_R" class="form-group row">
		<label id="elh_bdv__13_58_2_R" for="x__13_58_2_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_13_58_2_R->caption() ?><?php echo $bdv_edit->_13_58_2_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_13_58_2_R->cellAttributes() ?>>
<span id="el_bdv__13_58_2_R">
<textarea data-table="bdv" data-field="x__13_58_2_R" name="x__13_58_2_R" id="x__13_58_2_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_13_58_2_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_13_58_2_R->editAttributes() ?>><?php echo $bdv_edit->_13_58_2_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_13_58_2_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_13_59_R->Visible) { // 13_59_R ?>
	<div id="r__13_59_R" class="form-group row">
		<label id="elh_bdv__13_59_R" for="x__13_59_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_13_59_R->caption() ?><?php echo $bdv_edit->_13_59_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_13_59_R->cellAttributes() ?>>
<span id="el_bdv__13_59_R">
<textarea data-table="bdv" data-field="x__13_59_R" name="x__13_59_R" id="x__13_59_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_13_59_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_13_59_R->editAttributes() ?>><?php echo $bdv_edit->_13_59_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_13_59_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_13_59_1_R->Visible) { // 13_59_1_R ?>
	<div id="r__13_59_1_R" class="form-group row">
		<label id="elh_bdv__13_59_1_R" for="x__13_59_1_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_13_59_1_R->caption() ?><?php echo $bdv_edit->_13_59_1_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_13_59_1_R->cellAttributes() ?>>
<span id="el_bdv__13_59_1_R">
<textarea data-table="bdv" data-field="x__13_59_1_R" name="x__13_59_1_R" id="x__13_59_1_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_13_59_1_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_13_59_1_R->editAttributes() ?>><?php echo $bdv_edit->_13_59_1_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_13_59_1_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_13_59_2_R->Visible) { // 13_59_2_R ?>
	<div id="r__13_59_2_R" class="form-group row">
		<label id="elh_bdv__13_59_2_R" for="x__13_59_2_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_13_59_2_R->caption() ?><?php echo $bdv_edit->_13_59_2_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_13_59_2_R->cellAttributes() ?>>
<span id="el_bdv__13_59_2_R">
<textarea data-table="bdv" data-field="x__13_59_2_R" name="x__13_59_2_R" id="x__13_59_2_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_13_59_2_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_13_59_2_R->editAttributes() ?>><?php echo $bdv_edit->_13_59_2_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_13_59_2_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_13_60_R->Visible) { // 13_60_R ?>
	<div id="r__13_60_R" class="form-group row">
		<label id="elh_bdv__13_60_R" for="x__13_60_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_13_60_R->caption() ?><?php echo $bdv_edit->_13_60_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_13_60_R->cellAttributes() ?>>
<span id="el_bdv__13_60_R">
<textarea data-table="bdv" data-field="x__13_60_R" name="x__13_60_R" id="x__13_60_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_13_60_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_13_60_R->editAttributes() ?>><?php echo $bdv_edit->_13_60_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_13_60_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_12_53_7_R->Visible) { // 12_53_7_R ?>
	<div id="r__12_53_7_R" class="form-group row">
		<label id="elh_bdv__12_53_7_R" for="x__12_53_7_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_12_53_7_R->caption() ?><?php echo $bdv_edit->_12_53_7_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_12_53_7_R->cellAttributes() ?>>
<span id="el_bdv__12_53_7_R">
<textarea data-table="bdv" data-field="x__12_53_7_R" name="x__12_53_7_R" id="x__12_53_7_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_12_53_7_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_12_53_7_R->editAttributes() ?>><?php echo $bdv_edit->_12_53_7_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_12_53_7_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bdv_edit->_12_53_8_R->Visible) { // 12_53_8_R ?>
	<div id="r__12_53_8_R" class="form-group row">
		<label id="elh_bdv__12_53_8_R" for="x__12_53_8_R" class="<?php echo $bdv_edit->LeftColumnClass ?>"><?php echo $bdv_edit->_12_53_8_R->caption() ?><?php echo $bdv_edit->_12_53_8_R->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bdv_edit->RightColumnClass ?>"><div <?php echo $bdv_edit->_12_53_8_R->cellAttributes() ?>>
<span id="el_bdv__12_53_8_R">
<textarea data-table="bdv" data-field="x__12_53_8_R" name="x__12_53_8_R" id="x__12_53_8_R" cols="35" rows="4" placeholder="<?php echo HtmlEncode($bdv_edit->_12_53_8_R->getPlaceHolder()) ?>"<?php echo $bdv_edit->_12_53_8_R->editAttributes() ?>><?php echo $bdv_edit->_12_53_8_R->EditValue ?></textarea>
</span>
<?php echo $bdv_edit->_12_53_8_R->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$bdv_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $bdv_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $bdv_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$bdv_edit->showPageFooter();
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
$bdv_edit->terminate();
?>