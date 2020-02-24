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
$bdv_view = new bdv_view();

// Run the page
$bdv_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$bdv_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$bdv_view->isExport()) { ?>
<script>
var fbdvview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fbdvview = currentForm = new ew.Form("fbdvview", "view");
	loadjs.done("fbdvview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$bdv_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $bdv_view->ExportOptions->render("body") ?>
<?php $bdv_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $bdv_view->showPageHeader(); ?>
<?php
$bdv_view->showMessage();
?>
<form name="fbdvview" id="fbdvview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="bdv">
<input type="hidden" name="modal" value="<?php echo (int)$bdv_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($bdv_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv_id"><?php echo $bdv_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $bdv_view->id->cellAttributes() ?>>
<span id="el_bdv_id">
<span<?php echo $bdv_view->id->viewAttributes() ?>><?php echo $bdv_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->fecha->Visible) { // fecha ?>
	<tr id="r_fecha">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv_fecha"><?php echo $bdv_view->fecha->caption() ?></span></td>
		<td data-name="fecha" <?php echo $bdv_view->fecha->cellAttributes() ?>>
<span id="el_bdv_fecha">
<span<?php echo $bdv_view->fecha->viewAttributes() ?>><?php echo $bdv_view->fecha->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->hora->Visible) { // hora ?>
	<tr id="r_hora">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv_hora"><?php echo $bdv_view->hora->caption() ?></span></td>
		<td data-name="hora" <?php echo $bdv_view->hora->cellAttributes() ?>>
<span id="el_bdv_hora">
<span<?php echo $bdv_view->hora->viewAttributes() ?>><?php echo $bdv_view->hora->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->audio->Visible) { // audio ?>
	<tr id="r_audio">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv_audio"><?php echo $bdv_view->audio->caption() ?></span></td>
		<td data-name="audio" <?php echo $bdv_view->audio->cellAttributes() ?>>
<span id="el_bdv_audio">
<span<?php echo $bdv_view->audio->viewAttributes() ?>><?php echo $bdv_view->audio->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->st->Visible) { // st ?>
	<tr id="r_st">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv_st"><?php echo $bdv_view->st->caption() ?></span></td>
		<td data-name="st" <?php echo $bdv_view->st->cellAttributes() ?>>
<span id="el_bdv_st">
<span<?php echo $bdv_view->st->viewAttributes() ?>><?php echo $bdv_view->st->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->fechaHoraIni->Visible) { // fechaHoraIni ?>
	<tr id="r_fechaHoraIni">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv_fechaHoraIni"><?php echo $bdv_view->fechaHoraIni->caption() ?></span></td>
		<td data-name="fechaHoraIni" <?php echo $bdv_view->fechaHoraIni->cellAttributes() ?>>
<span id="el_bdv_fechaHoraIni">
<span<?php echo $bdv_view->fechaHoraIni->viewAttributes() ?>><?php echo $bdv_view->fechaHoraIni->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->fechaHoraFin->Visible) { // fechaHoraFin ?>
	<tr id="r_fechaHoraFin">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv_fechaHoraFin"><?php echo $bdv_view->fechaHoraFin->caption() ?></span></td>
		<td data-name="fechaHoraFin" <?php echo $bdv_view->fechaHoraFin->cellAttributes() ?>>
<span id="el_bdv_fechaHoraFin">
<span<?php echo $bdv_view->fechaHoraFin->viewAttributes() ?>><?php echo $bdv_view->fechaHoraFin->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->telefono->Visible) { // telefono ?>
	<tr id="r_telefono">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv_telefono"><?php echo $bdv_view->telefono->caption() ?></span></td>
		<td data-name="telefono" <?php echo $bdv_view->telefono->cellAttributes() ?>>
<span id="el_bdv_telefono">
<span<?php echo $bdv_view->telefono->viewAttributes() ?>><?php echo $bdv_view->telefono->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->agente->Visible) { // agente ?>
	<tr id="r_agente">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv_agente"><?php echo $bdv_view->agente->caption() ?></span></td>
		<td data-name="agente" <?php echo $bdv_view->agente->cellAttributes() ?>>
<span id="el_bdv_agente">
<span<?php echo $bdv_view->agente->viewAttributes() ?>><?php echo $bdv_view->agente->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->fechabo->Visible) { // fechabo ?>
	<tr id="r_fechabo">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv_fechabo"><?php echo $bdv_view->fechabo->caption() ?></span></td>
		<td data-name="fechabo" <?php echo $bdv_view->fechabo->cellAttributes() ?>>
<span id="el_bdv_fechabo">
<span<?php echo $bdv_view->fechabo->viewAttributes() ?>><?php echo $bdv_view->fechabo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->agentebo->Visible) { // agentebo ?>
	<tr id="r_agentebo">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv_agentebo"><?php echo $bdv_view->agentebo->caption() ?></span></td>
		<td data-name="agentebo" <?php echo $bdv_view->agentebo->cellAttributes() ?>>
<span id="el_bdv_agentebo">
<span<?php echo $bdv_view->agentebo->viewAttributes() ?>><?php echo $bdv_view->agentebo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->comentariosbo->Visible) { // comentariosbo ?>
	<tr id="r_comentariosbo">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv_comentariosbo"><?php echo $bdv_view->comentariosbo->caption() ?></span></td>
		<td data-name="comentariosbo" <?php echo $bdv_view->comentariosbo->cellAttributes() ?>>
<span id="el_bdv_comentariosbo">
<span<?php echo $bdv_view->comentariosbo->viewAttributes() ?>><?php echo $bdv_view->comentariosbo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->IP->Visible) { // IP ?>
	<tr id="r_IP">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv_IP"><?php echo $bdv_view->IP->caption() ?></span></td>
		<td data-name="IP" <?php echo $bdv_view->IP->cellAttributes() ?>>
<span id="el_bdv_IP">
<span<?php echo $bdv_view->IP->viewAttributes() ?>><?php echo $bdv_view->IP->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->actual->Visible) { // actual ?>
	<tr id="r_actual">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv_actual"><?php echo $bdv_view->actual->caption() ?></span></td>
		<td data-name="actual" <?php echo $bdv_view->actual->cellAttributes() ?>>
<span id="el_bdv_actual">
<span<?php echo $bdv_view->actual->viewAttributes() ?>><?php echo $bdv_view->actual->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->completado->Visible) { // completado ?>
	<tr id="r_completado">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv_completado"><?php echo $bdv_view->completado->caption() ?></span></td>
		<td data-name="completado" <?php echo $bdv_view->completado->cellAttributes() ?>>
<span id="el_bdv_completado">
<span<?php echo $bdv_view->completado->viewAttributes() ?>><?php echo $bdv_view->completado->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_2_1_R->Visible) { // 2_1_R ?>
	<tr id="r__2_1_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__2_1_R"><?php echo $bdv_view->_2_1_R->caption() ?></span></td>
		<td data-name="_2_1_R" <?php echo $bdv_view->_2_1_R->cellAttributes() ?>>
<span id="el_bdv__2_1_R">
<span<?php echo $bdv_view->_2_1_R->viewAttributes() ?>><?php echo $bdv_view->_2_1_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_2_2_R->Visible) { // 2_2_R ?>
	<tr id="r__2_2_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__2_2_R"><?php echo $bdv_view->_2_2_R->caption() ?></span></td>
		<td data-name="_2_2_R" <?php echo $bdv_view->_2_2_R->cellAttributes() ?>>
<span id="el_bdv__2_2_R">
<span<?php echo $bdv_view->_2_2_R->viewAttributes() ?>><?php echo $bdv_view->_2_2_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_2_3_R->Visible) { // 2_3_R ?>
	<tr id="r__2_3_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__2_3_R"><?php echo $bdv_view->_2_3_R->caption() ?></span></td>
		<td data-name="_2_3_R" <?php echo $bdv_view->_2_3_R->cellAttributes() ?>>
<span id="el_bdv__2_3_R">
<span<?php echo $bdv_view->_2_3_R->viewAttributes() ?>><?php echo $bdv_view->_2_3_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_3_4_R->Visible) { // 3_4_R ?>
	<tr id="r__3_4_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__3_4_R"><?php echo $bdv_view->_3_4_R->caption() ?></span></td>
		<td data-name="_3_4_R" <?php echo $bdv_view->_3_4_R->cellAttributes() ?>>
<span id="el_bdv__3_4_R">
<span<?php echo $bdv_view->_3_4_R->viewAttributes() ?>><?php echo $bdv_view->_3_4_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_4_5_R->Visible) { // 4_5_R ?>
	<tr id="r__4_5_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__4_5_R"><?php echo $bdv_view->_4_5_R->caption() ?></span></td>
		<td data-name="_4_5_R" <?php echo $bdv_view->_4_5_R->cellAttributes() ?>>
<span id="el_bdv__4_5_R">
<span<?php echo $bdv_view->_4_5_R->viewAttributes() ?>><?php echo $bdv_view->_4_5_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_4_6_R->Visible) { // 4_6_R ?>
	<tr id="r__4_6_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__4_6_R"><?php echo $bdv_view->_4_6_R->caption() ?></span></td>
		<td data-name="_4_6_R" <?php echo $bdv_view->_4_6_R->cellAttributes() ?>>
<span id="el_bdv__4_6_R">
<span<?php echo $bdv_view->_4_6_R->viewAttributes() ?>><?php echo $bdv_view->_4_6_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_4_7_R->Visible) { // 4_7_R ?>
	<tr id="r__4_7_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__4_7_R"><?php echo $bdv_view->_4_7_R->caption() ?></span></td>
		<td data-name="_4_7_R" <?php echo $bdv_view->_4_7_R->cellAttributes() ?>>
<span id="el_bdv__4_7_R">
<span<?php echo $bdv_view->_4_7_R->viewAttributes() ?>><?php echo $bdv_view->_4_7_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_4_8_R->Visible) { // 4_8_R ?>
	<tr id="r__4_8_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__4_8_R"><?php echo $bdv_view->_4_8_R->caption() ?></span></td>
		<td data-name="_4_8_R" <?php echo $bdv_view->_4_8_R->cellAttributes() ?>>
<span id="el_bdv__4_8_R">
<span<?php echo $bdv_view->_4_8_R->viewAttributes() ?>><?php echo $bdv_view->_4_8_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_5_9_R->Visible) { // 5_9_R ?>
	<tr id="r__5_9_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__5_9_R"><?php echo $bdv_view->_5_9_R->caption() ?></span></td>
		<td data-name="_5_9_R" <?php echo $bdv_view->_5_9_R->cellAttributes() ?>>
<span id="el_bdv__5_9_R">
<span<?php echo $bdv_view->_5_9_R->viewAttributes() ?>><?php echo $bdv_view->_5_9_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_5_10_R->Visible) { // 5_10_R ?>
	<tr id="r__5_10_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__5_10_R"><?php echo $bdv_view->_5_10_R->caption() ?></span></td>
		<td data-name="_5_10_R" <?php echo $bdv_view->_5_10_R->cellAttributes() ?>>
<span id="el_bdv__5_10_R">
<span<?php echo $bdv_view->_5_10_R->viewAttributes() ?>><?php echo $bdv_view->_5_10_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_5_11_R->Visible) { // 5_11_R ?>
	<tr id="r__5_11_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__5_11_R"><?php echo $bdv_view->_5_11_R->caption() ?></span></td>
		<td data-name="_5_11_R" <?php echo $bdv_view->_5_11_R->cellAttributes() ?>>
<span id="el_bdv__5_11_R">
<span<?php echo $bdv_view->_5_11_R->viewAttributes() ?>><?php echo $bdv_view->_5_11_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_5_12_R->Visible) { // 5_12_R ?>
	<tr id="r__5_12_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__5_12_R"><?php echo $bdv_view->_5_12_R->caption() ?></span></td>
		<td data-name="_5_12_R" <?php echo $bdv_view->_5_12_R->cellAttributes() ?>>
<span id="el_bdv__5_12_R">
<span<?php echo $bdv_view->_5_12_R->viewAttributes() ?>><?php echo $bdv_view->_5_12_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_5_13_R->Visible) { // 5_13_R ?>
	<tr id="r__5_13_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__5_13_R"><?php echo $bdv_view->_5_13_R->caption() ?></span></td>
		<td data-name="_5_13_R" <?php echo $bdv_view->_5_13_R->cellAttributes() ?>>
<span id="el_bdv__5_13_R">
<span<?php echo $bdv_view->_5_13_R->viewAttributes() ?>><?php echo $bdv_view->_5_13_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_5_14_R->Visible) { // 5_14_R ?>
	<tr id="r__5_14_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__5_14_R"><?php echo $bdv_view->_5_14_R->caption() ?></span></td>
		<td data-name="_5_14_R" <?php echo $bdv_view->_5_14_R->cellAttributes() ?>>
<span id="el_bdv__5_14_R">
<span<?php echo $bdv_view->_5_14_R->viewAttributes() ?>><?php echo $bdv_view->_5_14_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_5_51_R->Visible) { // 5_51_R ?>
	<tr id="r__5_51_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__5_51_R"><?php echo $bdv_view->_5_51_R->caption() ?></span></td>
		<td data-name="_5_51_R" <?php echo $bdv_view->_5_51_R->cellAttributes() ?>>
<span id="el_bdv__5_51_R">
<span<?php echo $bdv_view->_5_51_R->viewAttributes() ?>><?php echo $bdv_view->_5_51_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_6_15_R->Visible) { // 6_15_R ?>
	<tr id="r__6_15_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__6_15_R"><?php echo $bdv_view->_6_15_R->caption() ?></span></td>
		<td data-name="_6_15_R" <?php echo $bdv_view->_6_15_R->cellAttributes() ?>>
<span id="el_bdv__6_15_R">
<span<?php echo $bdv_view->_6_15_R->viewAttributes() ?>><?php echo $bdv_view->_6_15_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_6_16_R->Visible) { // 6_16_R ?>
	<tr id="r__6_16_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__6_16_R"><?php echo $bdv_view->_6_16_R->caption() ?></span></td>
		<td data-name="_6_16_R" <?php echo $bdv_view->_6_16_R->cellAttributes() ?>>
<span id="el_bdv__6_16_R">
<span<?php echo $bdv_view->_6_16_R->viewAttributes() ?>><?php echo $bdv_view->_6_16_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_6_17_R->Visible) { // 6_17_R ?>
	<tr id="r__6_17_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__6_17_R"><?php echo $bdv_view->_6_17_R->caption() ?></span></td>
		<td data-name="_6_17_R" <?php echo $bdv_view->_6_17_R->cellAttributes() ?>>
<span id="el_bdv__6_17_R">
<span<?php echo $bdv_view->_6_17_R->viewAttributes() ?>><?php echo $bdv_view->_6_17_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_6_18_R->Visible) { // 6_18_R ?>
	<tr id="r__6_18_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__6_18_R"><?php echo $bdv_view->_6_18_R->caption() ?></span></td>
		<td data-name="_6_18_R" <?php echo $bdv_view->_6_18_R->cellAttributes() ?>>
<span id="el_bdv__6_18_R">
<span<?php echo $bdv_view->_6_18_R->viewAttributes() ?>><?php echo $bdv_view->_6_18_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_6_19_R->Visible) { // 6_19_R ?>
	<tr id="r__6_19_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__6_19_R"><?php echo $bdv_view->_6_19_R->caption() ?></span></td>
		<td data-name="_6_19_R" <?php echo $bdv_view->_6_19_R->cellAttributes() ?>>
<span id="el_bdv__6_19_R">
<span<?php echo $bdv_view->_6_19_R->viewAttributes() ?>><?php echo $bdv_view->_6_19_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_6_20_R->Visible) { // 6_20_R ?>
	<tr id="r__6_20_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__6_20_R"><?php echo $bdv_view->_6_20_R->caption() ?></span></td>
		<td data-name="_6_20_R" <?php echo $bdv_view->_6_20_R->cellAttributes() ?>>
<span id="el_bdv__6_20_R">
<span<?php echo $bdv_view->_6_20_R->viewAttributes() ?>><?php echo $bdv_view->_6_20_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_6_52_R->Visible) { // 6_52_R ?>
	<tr id="r__6_52_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__6_52_R"><?php echo $bdv_view->_6_52_R->caption() ?></span></td>
		<td data-name="_6_52_R" <?php echo $bdv_view->_6_52_R->cellAttributes() ?>>
<span id="el_bdv__6_52_R">
<span<?php echo $bdv_view->_6_52_R->viewAttributes() ?>><?php echo $bdv_view->_6_52_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_7_21_R->Visible) { // 7_21_R ?>
	<tr id="r__7_21_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__7_21_R"><?php echo $bdv_view->_7_21_R->caption() ?></span></td>
		<td data-name="_7_21_R" <?php echo $bdv_view->_7_21_R->cellAttributes() ?>>
<span id="el_bdv__7_21_R">
<span<?php echo $bdv_view->_7_21_R->viewAttributes() ?>><?php echo $bdv_view->_7_21_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_8_22_R->Visible) { // 8_22_R ?>
	<tr id="r__8_22_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__8_22_R"><?php echo $bdv_view->_8_22_R->caption() ?></span></td>
		<td data-name="_8_22_R" <?php echo $bdv_view->_8_22_R->cellAttributes() ?>>
<span id="el_bdv__8_22_R">
<span<?php echo $bdv_view->_8_22_R->viewAttributes() ?>><?php echo $bdv_view->_8_22_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_8_23_R->Visible) { // 8_23_R ?>
	<tr id="r__8_23_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__8_23_R"><?php echo $bdv_view->_8_23_R->caption() ?></span></td>
		<td data-name="_8_23_R" <?php echo $bdv_view->_8_23_R->cellAttributes() ?>>
<span id="el_bdv__8_23_R">
<span<?php echo $bdv_view->_8_23_R->viewAttributes() ?>><?php echo $bdv_view->_8_23_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_8_24_R->Visible) { // 8_24_R ?>
	<tr id="r__8_24_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__8_24_R"><?php echo $bdv_view->_8_24_R->caption() ?></span></td>
		<td data-name="_8_24_R" <?php echo $bdv_view->_8_24_R->cellAttributes() ?>>
<span id="el_bdv__8_24_R">
<span<?php echo $bdv_view->_8_24_R->viewAttributes() ?>><?php echo $bdv_view->_8_24_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_8_25_R->Visible) { // 8_25_R ?>
	<tr id="r__8_25_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__8_25_R"><?php echo $bdv_view->_8_25_R->caption() ?></span></td>
		<td data-name="_8_25_R" <?php echo $bdv_view->_8_25_R->cellAttributes() ?>>
<span id="el_bdv__8_25_R">
<span<?php echo $bdv_view->_8_25_R->viewAttributes() ?>><?php echo $bdv_view->_8_25_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_9_26_R->Visible) { // 9_26_R ?>
	<tr id="r__9_26_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__9_26_R"><?php echo $bdv_view->_9_26_R->caption() ?></span></td>
		<td data-name="_9_26_R" <?php echo $bdv_view->_9_26_R->cellAttributes() ?>>
<span id="el_bdv__9_26_R">
<span<?php echo $bdv_view->_9_26_R->viewAttributes() ?>><?php echo $bdv_view->_9_26_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_9_27_R->Visible) { // 9_27_R ?>
	<tr id="r__9_27_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__9_27_R"><?php echo $bdv_view->_9_27_R->caption() ?></span></td>
		<td data-name="_9_27_R" <?php echo $bdv_view->_9_27_R->cellAttributes() ?>>
<span id="el_bdv__9_27_R">
<span<?php echo $bdv_view->_9_27_R->viewAttributes() ?>><?php echo $bdv_view->_9_27_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_9_28_R->Visible) { // 9_28_R ?>
	<tr id="r__9_28_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__9_28_R"><?php echo $bdv_view->_9_28_R->caption() ?></span></td>
		<td data-name="_9_28_R" <?php echo $bdv_view->_9_28_R->cellAttributes() ?>>
<span id="el_bdv__9_28_R">
<span<?php echo $bdv_view->_9_28_R->viewAttributes() ?>><?php echo $bdv_view->_9_28_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_9_29_R->Visible) { // 9_29_R ?>
	<tr id="r__9_29_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__9_29_R"><?php echo $bdv_view->_9_29_R->caption() ?></span></td>
		<td data-name="_9_29_R" <?php echo $bdv_view->_9_29_R->cellAttributes() ?>>
<span id="el_bdv__9_29_R">
<span<?php echo $bdv_view->_9_29_R->viewAttributes() ?>><?php echo $bdv_view->_9_29_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_9_30_R->Visible) { // 9_30_R ?>
	<tr id="r__9_30_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__9_30_R"><?php echo $bdv_view->_9_30_R->caption() ?></span></td>
		<td data-name="_9_30_R" <?php echo $bdv_view->_9_30_R->cellAttributes() ?>>
<span id="el_bdv__9_30_R">
<span<?php echo $bdv_view->_9_30_R->viewAttributes() ?>><?php echo $bdv_view->_9_30_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_9_31_R->Visible) { // 9_31_R ?>
	<tr id="r__9_31_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__9_31_R"><?php echo $bdv_view->_9_31_R->caption() ?></span></td>
		<td data-name="_9_31_R" <?php echo $bdv_view->_9_31_R->cellAttributes() ?>>
<span id="el_bdv__9_31_R">
<span<?php echo $bdv_view->_9_31_R->viewAttributes() ?>><?php echo $bdv_view->_9_31_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_9_32_R->Visible) { // 9_32_R ?>
	<tr id="r__9_32_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__9_32_R"><?php echo $bdv_view->_9_32_R->caption() ?></span></td>
		<td data-name="_9_32_R" <?php echo $bdv_view->_9_32_R->cellAttributes() ?>>
<span id="el_bdv__9_32_R">
<span<?php echo $bdv_view->_9_32_R->viewAttributes() ?>><?php echo $bdv_view->_9_32_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_9_33_R->Visible) { // 9_33_R ?>
	<tr id="r__9_33_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__9_33_R"><?php echo $bdv_view->_9_33_R->caption() ?></span></td>
		<td data-name="_9_33_R" <?php echo $bdv_view->_9_33_R->cellAttributes() ?>>
<span id="el_bdv__9_33_R">
<span<?php echo $bdv_view->_9_33_R->viewAttributes() ?>><?php echo $bdv_view->_9_33_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_9_34_R->Visible) { // 9_34_R ?>
	<tr id="r__9_34_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__9_34_R"><?php echo $bdv_view->_9_34_R->caption() ?></span></td>
		<td data-name="_9_34_R" <?php echo $bdv_view->_9_34_R->cellAttributes() ?>>
<span id="el_bdv__9_34_R">
<span<?php echo $bdv_view->_9_34_R->viewAttributes() ?>><?php echo $bdv_view->_9_34_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_9_35_R->Visible) { // 9_35_R ?>
	<tr id="r__9_35_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__9_35_R"><?php echo $bdv_view->_9_35_R->caption() ?></span></td>
		<td data-name="_9_35_R" <?php echo $bdv_view->_9_35_R->cellAttributes() ?>>
<span id="el_bdv__9_35_R">
<span<?php echo $bdv_view->_9_35_R->viewAttributes() ?>><?php echo $bdv_view->_9_35_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_9_36_R->Visible) { // 9_36_R ?>
	<tr id="r__9_36_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__9_36_R"><?php echo $bdv_view->_9_36_R->caption() ?></span></td>
		<td data-name="_9_36_R" <?php echo $bdv_view->_9_36_R->cellAttributes() ?>>
<span id="el_bdv__9_36_R">
<span<?php echo $bdv_view->_9_36_R->viewAttributes() ?>><?php echo $bdv_view->_9_36_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_9_37_R->Visible) { // 9_37_R ?>
	<tr id="r__9_37_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__9_37_R"><?php echo $bdv_view->_9_37_R->caption() ?></span></td>
		<td data-name="_9_37_R" <?php echo $bdv_view->_9_37_R->cellAttributes() ?>>
<span id="el_bdv__9_37_R">
<span<?php echo $bdv_view->_9_37_R->viewAttributes() ?>><?php echo $bdv_view->_9_37_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_9_38_R->Visible) { // 9_38_R ?>
	<tr id="r__9_38_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__9_38_R"><?php echo $bdv_view->_9_38_R->caption() ?></span></td>
		<td data-name="_9_38_R" <?php echo $bdv_view->_9_38_R->cellAttributes() ?>>
<span id="el_bdv__9_38_R">
<span<?php echo $bdv_view->_9_38_R->viewAttributes() ?>><?php echo $bdv_view->_9_38_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_9_39_R->Visible) { // 9_39_R ?>
	<tr id="r__9_39_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__9_39_R"><?php echo $bdv_view->_9_39_R->caption() ?></span></td>
		<td data-name="_9_39_R" <?php echo $bdv_view->_9_39_R->cellAttributes() ?>>
<span id="el_bdv__9_39_R">
<span<?php echo $bdv_view->_9_39_R->viewAttributes() ?>><?php echo $bdv_view->_9_39_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_10_40_R->Visible) { // 10_40_R ?>
	<tr id="r__10_40_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__10_40_R"><?php echo $bdv_view->_10_40_R->caption() ?></span></td>
		<td data-name="_10_40_R" <?php echo $bdv_view->_10_40_R->cellAttributes() ?>>
<span id="el_bdv__10_40_R">
<span<?php echo $bdv_view->_10_40_R->viewAttributes() ?>><?php echo $bdv_view->_10_40_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_10_41_R->Visible) { // 10_41_R ?>
	<tr id="r__10_41_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__10_41_R"><?php echo $bdv_view->_10_41_R->caption() ?></span></td>
		<td data-name="_10_41_R" <?php echo $bdv_view->_10_41_R->cellAttributes() ?>>
<span id="el_bdv__10_41_R">
<span<?php echo $bdv_view->_10_41_R->viewAttributes() ?>><?php echo $bdv_view->_10_41_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_11_42_R->Visible) { // 11_42_R ?>
	<tr id="r__11_42_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__11_42_R"><?php echo $bdv_view->_11_42_R->caption() ?></span></td>
		<td data-name="_11_42_R" <?php echo $bdv_view->_11_42_R->cellAttributes() ?>>
<span id="el_bdv__11_42_R">
<span<?php echo $bdv_view->_11_42_R->viewAttributes() ?>><?php echo $bdv_view->_11_42_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_11_43_R->Visible) { // 11_43_R ?>
	<tr id="r__11_43_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__11_43_R"><?php echo $bdv_view->_11_43_R->caption() ?></span></td>
		<td data-name="_11_43_R" <?php echo $bdv_view->_11_43_R->cellAttributes() ?>>
<span id="el_bdv__11_43_R">
<span<?php echo $bdv_view->_11_43_R->viewAttributes() ?>><?php echo $bdv_view->_11_43_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_12_44_R->Visible) { // 12_44_R ?>
	<tr id="r__12_44_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__12_44_R"><?php echo $bdv_view->_12_44_R->caption() ?></span></td>
		<td data-name="_12_44_R" <?php echo $bdv_view->_12_44_R->cellAttributes() ?>>
<span id="el_bdv__12_44_R">
<span<?php echo $bdv_view->_12_44_R->viewAttributes() ?>><?php echo $bdv_view->_12_44_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_12_45_R->Visible) { // 12_45_R ?>
	<tr id="r__12_45_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__12_45_R"><?php echo $bdv_view->_12_45_R->caption() ?></span></td>
		<td data-name="_12_45_R" <?php echo $bdv_view->_12_45_R->cellAttributes() ?>>
<span id="el_bdv__12_45_R">
<span<?php echo $bdv_view->_12_45_R->viewAttributes() ?>><?php echo $bdv_view->_12_45_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_12_46_R->Visible) { // 12_46_R ?>
	<tr id="r__12_46_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__12_46_R"><?php echo $bdv_view->_12_46_R->caption() ?></span></td>
		<td data-name="_12_46_R" <?php echo $bdv_view->_12_46_R->cellAttributes() ?>>
<span id="el_bdv__12_46_R">
<span<?php echo $bdv_view->_12_46_R->viewAttributes() ?>><?php echo $bdv_view->_12_46_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_12_47_R->Visible) { // 12_47_R ?>
	<tr id="r__12_47_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__12_47_R"><?php echo $bdv_view->_12_47_R->caption() ?></span></td>
		<td data-name="_12_47_R" <?php echo $bdv_view->_12_47_R->cellAttributes() ?>>
<span id="el_bdv__12_47_R">
<span<?php echo $bdv_view->_12_47_R->viewAttributes() ?>><?php echo $bdv_view->_12_47_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_12_48_R->Visible) { // 12_48_R ?>
	<tr id="r__12_48_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__12_48_R"><?php echo $bdv_view->_12_48_R->caption() ?></span></td>
		<td data-name="_12_48_R" <?php echo $bdv_view->_12_48_R->cellAttributes() ?>>
<span id="el_bdv__12_48_R">
<span<?php echo $bdv_view->_12_48_R->viewAttributes() ?>><?php echo $bdv_view->_12_48_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_12_49_R->Visible) { // 12_49_R ?>
	<tr id="r__12_49_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__12_49_R"><?php echo $bdv_view->_12_49_R->caption() ?></span></td>
		<td data-name="_12_49_R" <?php echo $bdv_view->_12_49_R->cellAttributes() ?>>
<span id="el_bdv__12_49_R">
<span<?php echo $bdv_view->_12_49_R->viewAttributes() ?>><?php echo $bdv_view->_12_49_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_12_50_R->Visible) { // 12_50_R ?>
	<tr id="r__12_50_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__12_50_R"><?php echo $bdv_view->_12_50_R->caption() ?></span></td>
		<td data-name="_12_50_R" <?php echo $bdv_view->_12_50_R->cellAttributes() ?>>
<span id="el_bdv__12_50_R">
<span<?php echo $bdv_view->_12_50_R->viewAttributes() ?>><?php echo $bdv_view->_12_50_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_1__R->Visible) { // 1__R ?>
	<tr id="r__1__R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__1__R"><?php echo $bdv_view->_1__R->caption() ?></span></td>
		<td data-name="_1__R" <?php echo $bdv_view->_1__R->cellAttributes() ?>>
<span id="el_bdv__1__R">
<span<?php echo $bdv_view->_1__R->viewAttributes() ?>><?php echo $bdv_view->_1__R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_13_54_R->Visible) { // 13_54_R ?>
	<tr id="r__13_54_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__13_54_R"><?php echo $bdv_view->_13_54_R->caption() ?></span></td>
		<td data-name="_13_54_R" <?php echo $bdv_view->_13_54_R->cellAttributes() ?>>
<span id="el_bdv__13_54_R">
<span<?php echo $bdv_view->_13_54_R->viewAttributes() ?>><?php echo $bdv_view->_13_54_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_13_54_1_R->Visible) { // 13_54_1_R ?>
	<tr id="r__13_54_1_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__13_54_1_R"><?php echo $bdv_view->_13_54_1_R->caption() ?></span></td>
		<td data-name="_13_54_1_R" <?php echo $bdv_view->_13_54_1_R->cellAttributes() ?>>
<span id="el_bdv__13_54_1_R">
<span<?php echo $bdv_view->_13_54_1_R->viewAttributes() ?>><?php echo $bdv_view->_13_54_1_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_13_54_2_R->Visible) { // 13_54_2_R ?>
	<tr id="r__13_54_2_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__13_54_2_R"><?php echo $bdv_view->_13_54_2_R->caption() ?></span></td>
		<td data-name="_13_54_2_R" <?php echo $bdv_view->_13_54_2_R->cellAttributes() ?>>
<span id="el_bdv__13_54_2_R">
<span<?php echo $bdv_view->_13_54_2_R->viewAttributes() ?>><?php echo $bdv_view->_13_54_2_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_13_55_R->Visible) { // 13_55_R ?>
	<tr id="r__13_55_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__13_55_R"><?php echo $bdv_view->_13_55_R->caption() ?></span></td>
		<td data-name="_13_55_R" <?php echo $bdv_view->_13_55_R->cellAttributes() ?>>
<span id="el_bdv__13_55_R">
<span<?php echo $bdv_view->_13_55_R->viewAttributes() ?>><?php echo $bdv_view->_13_55_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_13_55_1_R->Visible) { // 13_55_1_R ?>
	<tr id="r__13_55_1_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__13_55_1_R"><?php echo $bdv_view->_13_55_1_R->caption() ?></span></td>
		<td data-name="_13_55_1_R" <?php echo $bdv_view->_13_55_1_R->cellAttributes() ?>>
<span id="el_bdv__13_55_1_R">
<span<?php echo $bdv_view->_13_55_1_R->viewAttributes() ?>><?php echo $bdv_view->_13_55_1_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_13_55_2_R->Visible) { // 13_55_2_R ?>
	<tr id="r__13_55_2_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__13_55_2_R"><?php echo $bdv_view->_13_55_2_R->caption() ?></span></td>
		<td data-name="_13_55_2_R" <?php echo $bdv_view->_13_55_2_R->cellAttributes() ?>>
<span id="el_bdv__13_55_2_R">
<span<?php echo $bdv_view->_13_55_2_R->viewAttributes() ?>><?php echo $bdv_view->_13_55_2_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_13_56_R->Visible) { // 13_56_R ?>
	<tr id="r__13_56_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__13_56_R"><?php echo $bdv_view->_13_56_R->caption() ?></span></td>
		<td data-name="_13_56_R" <?php echo $bdv_view->_13_56_R->cellAttributes() ?>>
<span id="el_bdv__13_56_R">
<span<?php echo $bdv_view->_13_56_R->viewAttributes() ?>><?php echo $bdv_view->_13_56_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_13_56_1_R->Visible) { // 13_56_1_R ?>
	<tr id="r__13_56_1_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__13_56_1_R"><?php echo $bdv_view->_13_56_1_R->caption() ?></span></td>
		<td data-name="_13_56_1_R" <?php echo $bdv_view->_13_56_1_R->cellAttributes() ?>>
<span id="el_bdv__13_56_1_R">
<span<?php echo $bdv_view->_13_56_1_R->viewAttributes() ?>><?php echo $bdv_view->_13_56_1_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_13_56_2_R->Visible) { // 13_56_2_R ?>
	<tr id="r__13_56_2_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__13_56_2_R"><?php echo $bdv_view->_13_56_2_R->caption() ?></span></td>
		<td data-name="_13_56_2_R" <?php echo $bdv_view->_13_56_2_R->cellAttributes() ?>>
<span id="el_bdv__13_56_2_R">
<span<?php echo $bdv_view->_13_56_2_R->viewAttributes() ?>><?php echo $bdv_view->_13_56_2_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_12_53_R->Visible) { // 12_53_R ?>
	<tr id="r__12_53_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__12_53_R"><?php echo $bdv_view->_12_53_R->caption() ?></span></td>
		<td data-name="_12_53_R" <?php echo $bdv_view->_12_53_R->cellAttributes() ?>>
<span id="el_bdv__12_53_R">
<span<?php echo $bdv_view->_12_53_R->viewAttributes() ?>><?php echo $bdv_view->_12_53_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_12_53_1_R->Visible) { // 12_53_1_R ?>
	<tr id="r__12_53_1_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__12_53_1_R"><?php echo $bdv_view->_12_53_1_R->caption() ?></span></td>
		<td data-name="_12_53_1_R" <?php echo $bdv_view->_12_53_1_R->cellAttributes() ?>>
<span id="el_bdv__12_53_1_R">
<span<?php echo $bdv_view->_12_53_1_R->viewAttributes() ?>><?php echo $bdv_view->_12_53_1_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_12_53_2_R->Visible) { // 12_53_2_R ?>
	<tr id="r__12_53_2_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__12_53_2_R"><?php echo $bdv_view->_12_53_2_R->caption() ?></span></td>
		<td data-name="_12_53_2_R" <?php echo $bdv_view->_12_53_2_R->cellAttributes() ?>>
<span id="el_bdv__12_53_2_R">
<span<?php echo $bdv_view->_12_53_2_R->viewAttributes() ?>><?php echo $bdv_view->_12_53_2_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_12_53_3_R->Visible) { // 12_53_3_R ?>
	<tr id="r__12_53_3_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__12_53_3_R"><?php echo $bdv_view->_12_53_3_R->caption() ?></span></td>
		<td data-name="_12_53_3_R" <?php echo $bdv_view->_12_53_3_R->cellAttributes() ?>>
<span id="el_bdv__12_53_3_R">
<span<?php echo $bdv_view->_12_53_3_R->viewAttributes() ?>><?php echo $bdv_view->_12_53_3_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_12_53_4_R->Visible) { // 12_53_4_R ?>
	<tr id="r__12_53_4_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__12_53_4_R"><?php echo $bdv_view->_12_53_4_R->caption() ?></span></td>
		<td data-name="_12_53_4_R" <?php echo $bdv_view->_12_53_4_R->cellAttributes() ?>>
<span id="el_bdv__12_53_4_R">
<span<?php echo $bdv_view->_12_53_4_R->viewAttributes() ?>><?php echo $bdv_view->_12_53_4_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_12_53_5_R->Visible) { // 12_53_5_R ?>
	<tr id="r__12_53_5_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__12_53_5_R"><?php echo $bdv_view->_12_53_5_R->caption() ?></span></td>
		<td data-name="_12_53_5_R" <?php echo $bdv_view->_12_53_5_R->cellAttributes() ?>>
<span id="el_bdv__12_53_5_R">
<span<?php echo $bdv_view->_12_53_5_R->viewAttributes() ?>><?php echo $bdv_view->_12_53_5_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_12_53_6_R->Visible) { // 12_53_6_R ?>
	<tr id="r__12_53_6_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__12_53_6_R"><?php echo $bdv_view->_12_53_6_R->caption() ?></span></td>
		<td data-name="_12_53_6_R" <?php echo $bdv_view->_12_53_6_R->cellAttributes() ?>>
<span id="el_bdv__12_53_6_R">
<span<?php echo $bdv_view->_12_53_6_R->viewAttributes() ?>><?php echo $bdv_view->_12_53_6_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_13_57_R->Visible) { // 13_57_R ?>
	<tr id="r__13_57_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__13_57_R"><?php echo $bdv_view->_13_57_R->caption() ?></span></td>
		<td data-name="_13_57_R" <?php echo $bdv_view->_13_57_R->cellAttributes() ?>>
<span id="el_bdv__13_57_R">
<span<?php echo $bdv_view->_13_57_R->viewAttributes() ?>><?php echo $bdv_view->_13_57_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_13_57_1_R->Visible) { // 13_57_1_R ?>
	<tr id="r__13_57_1_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__13_57_1_R"><?php echo $bdv_view->_13_57_1_R->caption() ?></span></td>
		<td data-name="_13_57_1_R" <?php echo $bdv_view->_13_57_1_R->cellAttributes() ?>>
<span id="el_bdv__13_57_1_R">
<span<?php echo $bdv_view->_13_57_1_R->viewAttributes() ?>><?php echo $bdv_view->_13_57_1_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_13_57_2_R->Visible) { // 13_57_2_R ?>
	<tr id="r__13_57_2_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__13_57_2_R"><?php echo $bdv_view->_13_57_2_R->caption() ?></span></td>
		<td data-name="_13_57_2_R" <?php echo $bdv_view->_13_57_2_R->cellAttributes() ?>>
<span id="el_bdv__13_57_2_R">
<span<?php echo $bdv_view->_13_57_2_R->viewAttributes() ?>><?php echo $bdv_view->_13_57_2_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_13_58_R->Visible) { // 13_58_R ?>
	<tr id="r__13_58_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__13_58_R"><?php echo $bdv_view->_13_58_R->caption() ?></span></td>
		<td data-name="_13_58_R" <?php echo $bdv_view->_13_58_R->cellAttributes() ?>>
<span id="el_bdv__13_58_R">
<span<?php echo $bdv_view->_13_58_R->viewAttributes() ?>><?php echo $bdv_view->_13_58_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_13_58_1_R->Visible) { // 13_58_1_R ?>
	<tr id="r__13_58_1_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__13_58_1_R"><?php echo $bdv_view->_13_58_1_R->caption() ?></span></td>
		<td data-name="_13_58_1_R" <?php echo $bdv_view->_13_58_1_R->cellAttributes() ?>>
<span id="el_bdv__13_58_1_R">
<span<?php echo $bdv_view->_13_58_1_R->viewAttributes() ?>><?php echo $bdv_view->_13_58_1_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_13_58_2_R->Visible) { // 13_58_2_R ?>
	<tr id="r__13_58_2_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__13_58_2_R"><?php echo $bdv_view->_13_58_2_R->caption() ?></span></td>
		<td data-name="_13_58_2_R" <?php echo $bdv_view->_13_58_2_R->cellAttributes() ?>>
<span id="el_bdv__13_58_2_R">
<span<?php echo $bdv_view->_13_58_2_R->viewAttributes() ?>><?php echo $bdv_view->_13_58_2_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_13_59_R->Visible) { // 13_59_R ?>
	<tr id="r__13_59_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__13_59_R"><?php echo $bdv_view->_13_59_R->caption() ?></span></td>
		<td data-name="_13_59_R" <?php echo $bdv_view->_13_59_R->cellAttributes() ?>>
<span id="el_bdv__13_59_R">
<span<?php echo $bdv_view->_13_59_R->viewAttributes() ?>><?php echo $bdv_view->_13_59_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_13_59_1_R->Visible) { // 13_59_1_R ?>
	<tr id="r__13_59_1_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__13_59_1_R"><?php echo $bdv_view->_13_59_1_R->caption() ?></span></td>
		<td data-name="_13_59_1_R" <?php echo $bdv_view->_13_59_1_R->cellAttributes() ?>>
<span id="el_bdv__13_59_1_R">
<span<?php echo $bdv_view->_13_59_1_R->viewAttributes() ?>><?php echo $bdv_view->_13_59_1_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_13_59_2_R->Visible) { // 13_59_2_R ?>
	<tr id="r__13_59_2_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__13_59_2_R"><?php echo $bdv_view->_13_59_2_R->caption() ?></span></td>
		<td data-name="_13_59_2_R" <?php echo $bdv_view->_13_59_2_R->cellAttributes() ?>>
<span id="el_bdv__13_59_2_R">
<span<?php echo $bdv_view->_13_59_2_R->viewAttributes() ?>><?php echo $bdv_view->_13_59_2_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_13_60_R->Visible) { // 13_60_R ?>
	<tr id="r__13_60_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__13_60_R"><?php echo $bdv_view->_13_60_R->caption() ?></span></td>
		<td data-name="_13_60_R" <?php echo $bdv_view->_13_60_R->cellAttributes() ?>>
<span id="el_bdv__13_60_R">
<span<?php echo $bdv_view->_13_60_R->viewAttributes() ?>><?php echo $bdv_view->_13_60_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_12_53_7_R->Visible) { // 12_53_7_R ?>
	<tr id="r__12_53_7_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__12_53_7_R"><?php echo $bdv_view->_12_53_7_R->caption() ?></span></td>
		<td data-name="_12_53_7_R" <?php echo $bdv_view->_12_53_7_R->cellAttributes() ?>>
<span id="el_bdv__12_53_7_R">
<span<?php echo $bdv_view->_12_53_7_R->viewAttributes() ?>><?php echo $bdv_view->_12_53_7_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bdv_view->_12_53_8_R->Visible) { // 12_53_8_R ?>
	<tr id="r__12_53_8_R">
		<td class="<?php echo $bdv_view->TableLeftColumnClass ?>"><span id="elh_bdv__12_53_8_R"><?php echo $bdv_view->_12_53_8_R->caption() ?></span></td>
		<td data-name="_12_53_8_R" <?php echo $bdv_view->_12_53_8_R->cellAttributes() ?>>
<span id="el_bdv__12_53_8_R">
<span<?php echo $bdv_view->_12_53_8_R->viewAttributes() ?>><?php echo $bdv_view->_12_53_8_R->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$bdv_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$bdv_view->isExport()) { ?>
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
$bdv_view->terminate();
?>