<?php namespace PHPMaker2020\project1; ?>
<?php

/**
 * Table class for bdv
 */
class bdv extends DbTable
{
	protected $SqlFrom = "";
	protected $SqlSelect = "";
	protected $SqlSelectList = "";
	protected $SqlWhere = "";
	protected $SqlGroupBy = "";
	protected $SqlHaving = "";
	protected $SqlOrderBy = "";
	public $UseSessionForListSql = TRUE;

	// Column CSS classes
	public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
	public $RightColumnClass = "col-sm-10";
	public $OffsetColumnClass = "col-sm-10 offset-sm-2";
	public $TableLeftColumnClass = "w-col-2";

	// Export
	public $ExportDoc;

	// Fields
	public $id;
	public $fecha;
	public $hora;
	public $audio;
	public $st;
	public $fechaHoraIni;
	public $fechaHoraFin;
	public $telefono;
	public $agente;
	public $fechabo;
	public $agentebo;
	public $comentariosbo;
	public $IP;
	public $actual;
	public $completado;
	public $_2_1_R;
	public $_2_2_R;
	public $_2_3_R;
	public $_3_4_R;
	public $_4_5_R;
	public $_4_6_R;
	public $_4_7_R;
	public $_4_8_R;
	public $_5_9_R;
	public $_5_10_R;
	public $_5_11_R;
	public $_5_12_R;
	public $_5_13_R;
	public $_5_14_R;
	public $_5_51_R;
	public $_6_15_R;
	public $_6_16_R;
	public $_6_17_R;
	public $_6_18_R;
	public $_6_19_R;
	public $_6_20_R;
	public $_6_52_R;
	public $_7_21_R;
	public $_8_22_R;
	public $_8_23_R;
	public $_8_24_R;
	public $_8_25_R;
	public $_9_26_R;
	public $_9_27_R;
	public $_9_28_R;
	public $_9_29_R;
	public $_9_30_R;
	public $_9_31_R;
	public $_9_32_R;
	public $_9_33_R;
	public $_9_34_R;
	public $_9_35_R;
	public $_9_36_R;
	public $_9_37_R;
	public $_9_38_R;
	public $_9_39_R;
	public $_10_40_R;
	public $_10_41_R;
	public $_11_42_R;
	public $_11_43_R;
	public $_12_44_R;
	public $_12_45_R;
	public $_12_46_R;
	public $_12_47_R;
	public $_12_48_R;
	public $_12_49_R;
	public $_12_50_R;
	public $_1__R;
	public $_13_54_R;
	public $_13_54_1_R;
	public $_13_54_2_R;
	public $_13_55_R;
	public $_13_55_1_R;
	public $_13_55_2_R;
	public $_13_56_R;
	public $_13_56_1_R;
	public $_13_56_2_R;
	public $_12_53_R;
	public $_12_53_1_R;
	public $_12_53_2_R;
	public $_12_53_3_R;
	public $_12_53_4_R;
	public $_12_53_5_R;
	public $_12_53_6_R;
	public $_13_57_R;
	public $_13_57_1_R;
	public $_13_57_2_R;
	public $_13_58_R;
	public $_13_58_1_R;
	public $_13_58_2_R;
	public $_13_59_R;
	public $_13_59_1_R;
	public $_13_59_2_R;
	public $_13_60_R;
	public $_12_53_7_R;
	public $_12_53_8_R;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'bdv';
		$this->TableName = 'bdv';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`bdv`";
		$this->Dbid = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
		$this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->DetailAdd = FALSE; // Allow detail add
		$this->DetailEdit = FALSE; // Allow detail edit
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 5;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = 0; // User ID Allow
		$this->BasicSearch = new BasicSearch($this->TableVar);

		// id
		$this->id = new DbField('bdv', 'bdv', 'x_id', 'id', '`id`', '`id`', 3, 11, -1, FALSE, '`id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id->IsPrimaryKey = TRUE; // Primary key field
		$this->id->Sortable = TRUE; // Allow sort
		$this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id'] = &$this->id;

		// fecha
		$this->fecha = new DbField('bdv', 'bdv', 'x_fecha', 'fecha', '`fecha`', CastDateFieldForLike("`fecha`", 0, "DB"), 133, 10, 0, FALSE, '`fecha`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fecha->Sortable = TRUE; // Allow sort
		$this->fecha->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['fecha'] = &$this->fecha;

		// hora
		$this->hora = new DbField('bdv', 'bdv', 'x_hora', 'hora', '`hora`', CastDateFieldForLike("`hora`", 4, "DB"), 134, 10, 4, FALSE, '`hora`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->hora->Nullable = FALSE; // NOT NULL field
		$this->hora->Required = TRUE; // Required field
		$this->hora->Sortable = TRUE; // Allow sort
		$this->hora->DefaultErrorMessage = str_replace("%s", $GLOBALS["TIME_SEPARATOR"], $Language->phrase("IncorrectTime"));
		$this->fields['hora'] = &$this->hora;

		// audio
		$this->audio = new DbField('bdv', 'bdv', 'x_audio', 'audio', '`audio`', '`audio`', 200, 2, -1, FALSE, '`audio`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->audio->Sortable = TRUE; // Allow sort
		$this->fields['audio'] = &$this->audio;

		// st
		$this->st = new DbField('bdv', 'bdv', 'x_st', 'st', '`st`', '`st`', 200, 60, -1, FALSE, '`st`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->st->Sortable = TRUE; // Allow sort
		$this->fields['st'] = &$this->st;

		// fechaHoraIni
		$this->fechaHoraIni = new DbField('bdv', 'bdv', 'x_fechaHoraIni', 'fechaHoraIni', '`fechaHoraIni`', CastDateFieldForLike("`fechaHoraIni`", 0, "DB"), 135, 19, 0, FALSE, '`fechaHoraIni`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fechaHoraIni->Nullable = FALSE; // NOT NULL field
		$this->fechaHoraIni->Required = TRUE; // Required field
		$this->fechaHoraIni->Sortable = TRUE; // Allow sort
		$this->fechaHoraIni->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['fechaHoraIni'] = &$this->fechaHoraIni;

		// fechaHoraFin
		$this->fechaHoraFin = new DbField('bdv', 'bdv', 'x_fechaHoraFin', 'fechaHoraFin', '`fechaHoraFin`', CastDateFieldForLike("`fechaHoraFin`", 0, "DB"), 135, 19, 0, FALSE, '`fechaHoraFin`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fechaHoraFin->Nullable = FALSE; // NOT NULL field
		$this->fechaHoraFin->Required = TRUE; // Required field
		$this->fechaHoraFin->Sortable = TRUE; // Allow sort
		$this->fechaHoraFin->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['fechaHoraFin'] = &$this->fechaHoraFin;

		// telefono
		$this->telefono = new DbField('bdv', 'bdv', 'x_telefono', 'telefono', '`telefono`', '`telefono`', 200, 15, -1, FALSE, '`telefono`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->telefono->Nullable = FALSE; // NOT NULL field
		$this->telefono->Required = TRUE; // Required field
		$this->telefono->Sortable = TRUE; // Allow sort
		$this->fields['telefono'] = &$this->telefono;

		// agente
		$this->agente = new DbField('bdv', 'bdv', 'x_agente', 'agente', '`agente`', '`agente`', 3, 11, -1, FALSE, '`agente`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->agente->Nullable = FALSE; // NOT NULL field
		$this->agente->Required = TRUE; // Required field
		$this->agente->Sortable = TRUE; // Allow sort
		$this->agente->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['agente'] = &$this->agente;

		// fechabo
		$this->fechabo = new DbField('bdv', 'bdv', 'x_fechabo', 'fechabo', '`fechabo`', CastDateFieldForLike("`fechabo`", 0, "DB"), 133, 10, 0, FALSE, '`fechabo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fechabo->Sortable = TRUE; // Allow sort
		$this->fechabo->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['fechabo'] = &$this->fechabo;

		// agentebo
		$this->agentebo = new DbField('bdv', 'bdv', 'x_agentebo', 'agentebo', '`agentebo`', '`agentebo`', 3, 11, -1, FALSE, '`agentebo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->agentebo->Sortable = TRUE; // Allow sort
		$this->agentebo->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['agentebo'] = &$this->agentebo;

		// comentariosbo
		$this->comentariosbo = new DbField('bdv', 'bdv', 'x_comentariosbo', 'comentariosbo', '`comentariosbo`', '`comentariosbo`', 201, 65535, -1, FALSE, '`comentariosbo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->comentariosbo->Sortable = TRUE; // Allow sort
		$this->fields['comentariosbo'] = &$this->comentariosbo;

		// IP
		$this->IP = new DbField('bdv', 'bdv', 'x_IP', 'IP', '`IP`', '`IP`', 200, 20, -1, FALSE, '`IP`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->IP->Sortable = TRUE; // Allow sort
		$this->fields['IP'] = &$this->IP;

		// actual
		$this->actual = new DbField('bdv', 'bdv', 'x_actual', 'actual', '`actual`', '`actual`', 200, 20, -1, FALSE, '`actual`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->actual->Sortable = TRUE; // Allow sort
		$this->fields['actual'] = &$this->actual;

		// completado
		$this->completado = new DbField('bdv', 'bdv', 'x_completado', 'completado', '`completado`', '`completado`', 200, 20, -1, FALSE, '`completado`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->completado->Sortable = TRUE; // Allow sort
		$this->fields['completado'] = &$this->completado;

		// 2_1_R
		$this->_2_1_R = new DbField('bdv', 'bdv', 'x__2_1_R', '2_1_R', '`2_1_R`', '`2_1_R`', 201, 65535, -1, FALSE, '`2_1_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_2_1_R->Sortable = TRUE; // Allow sort
		$this->fields['2_1_R'] = &$this->_2_1_R;

		// 2_2_R
		$this->_2_2_R = new DbField('bdv', 'bdv', 'x__2_2_R', '2_2_R', '`2_2_R`', '`2_2_R`', 201, 65535, -1, FALSE, '`2_2_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_2_2_R->Sortable = TRUE; // Allow sort
		$this->fields['2_2_R'] = &$this->_2_2_R;

		// 2_3_R
		$this->_2_3_R = new DbField('bdv', 'bdv', 'x__2_3_R', '2_3_R', '`2_3_R`', '`2_3_R`', 201, 65535, -1, FALSE, '`2_3_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_2_3_R->Sortable = TRUE; // Allow sort
		$this->fields['2_3_R'] = &$this->_2_3_R;

		// 3_4_R
		$this->_3_4_R = new DbField('bdv', 'bdv', 'x__3_4_R', '3_4_R', '`3_4_R`', '`3_4_R`', 201, 65535, -1, FALSE, '`3_4_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_3_4_R->Sortable = TRUE; // Allow sort
		$this->fields['3_4_R'] = &$this->_3_4_R;

		// 4_5_R
		$this->_4_5_R = new DbField('bdv', 'bdv', 'x__4_5_R', '4_5_R', '`4_5_R`', '`4_5_R`', 201, 65535, -1, FALSE, '`4_5_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_4_5_R->Sortable = TRUE; // Allow sort
		$this->fields['4_5_R'] = &$this->_4_5_R;

		// 4_6_R
		$this->_4_6_R = new DbField('bdv', 'bdv', 'x__4_6_R', '4_6_R', '`4_6_R`', '`4_6_R`', 201, 65535, -1, FALSE, '`4_6_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_4_6_R->Sortable = TRUE; // Allow sort
		$this->fields['4_6_R'] = &$this->_4_6_R;

		// 4_7_R
		$this->_4_7_R = new DbField('bdv', 'bdv', 'x__4_7_R', '4_7_R', '`4_7_R`', '`4_7_R`', 201, 65535, -1, FALSE, '`4_7_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_4_7_R->Sortable = TRUE; // Allow sort
		$this->fields['4_7_R'] = &$this->_4_7_R;

		// 4_8_R
		$this->_4_8_R = new DbField('bdv', 'bdv', 'x__4_8_R', '4_8_R', '`4_8_R`', '`4_8_R`', 201, 65535, -1, FALSE, '`4_8_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_4_8_R->Sortable = TRUE; // Allow sort
		$this->fields['4_8_R'] = &$this->_4_8_R;

		// 5_9_R
		$this->_5_9_R = new DbField('bdv', 'bdv', 'x__5_9_R', '5_9_R', '`5_9_R`', '`5_9_R`', 201, 65535, -1, FALSE, '`5_9_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_5_9_R->Sortable = TRUE; // Allow sort
		$this->fields['5_9_R'] = &$this->_5_9_R;

		// 5_10_R
		$this->_5_10_R = new DbField('bdv', 'bdv', 'x__5_10_R', '5_10_R', '`5_10_R`', '`5_10_R`', 201, 65535, -1, FALSE, '`5_10_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_5_10_R->Sortable = TRUE; // Allow sort
		$this->fields['5_10_R'] = &$this->_5_10_R;

		// 5_11_R
		$this->_5_11_R = new DbField('bdv', 'bdv', 'x__5_11_R', '5_11_R', '`5_11_R`', '`5_11_R`', 201, 65535, -1, FALSE, '`5_11_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_5_11_R->Sortable = TRUE; // Allow sort
		$this->fields['5_11_R'] = &$this->_5_11_R;

		// 5_12_R
		$this->_5_12_R = new DbField('bdv', 'bdv', 'x__5_12_R', '5_12_R', '`5_12_R`', '`5_12_R`', 201, 65535, -1, FALSE, '`5_12_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_5_12_R->Sortable = TRUE; // Allow sort
		$this->fields['5_12_R'] = &$this->_5_12_R;

		// 5_13_R
		$this->_5_13_R = new DbField('bdv', 'bdv', 'x__5_13_R', '5_13_R', '`5_13_R`', '`5_13_R`', 201, 65535, -1, FALSE, '`5_13_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_5_13_R->Sortable = TRUE; // Allow sort
		$this->fields['5_13_R'] = &$this->_5_13_R;

		// 5_14_R
		$this->_5_14_R = new DbField('bdv', 'bdv', 'x__5_14_R', '5_14_R', '`5_14_R`', '`5_14_R`', 201, 65535, -1, FALSE, '`5_14_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_5_14_R->Sortable = TRUE; // Allow sort
		$this->fields['5_14_R'] = &$this->_5_14_R;

		// 5_51_R
		$this->_5_51_R = new DbField('bdv', 'bdv', 'x__5_51_R', '5_51_R', '`5_51_R`', '`5_51_R`', 201, 65535, -1, FALSE, '`5_51_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_5_51_R->Sortable = TRUE; // Allow sort
		$this->fields['5_51_R'] = &$this->_5_51_R;

		// 6_15_R
		$this->_6_15_R = new DbField('bdv', 'bdv', 'x__6_15_R', '6_15_R', '`6_15_R`', '`6_15_R`', 201, 65535, -1, FALSE, '`6_15_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_6_15_R->Sortable = TRUE; // Allow sort
		$this->fields['6_15_R'] = &$this->_6_15_R;

		// 6_16_R
		$this->_6_16_R = new DbField('bdv', 'bdv', 'x__6_16_R', '6_16_R', '`6_16_R`', '`6_16_R`', 201, 65535, -1, FALSE, '`6_16_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_6_16_R->Sortable = TRUE; // Allow sort
		$this->fields['6_16_R'] = &$this->_6_16_R;

		// 6_17_R
		$this->_6_17_R = new DbField('bdv', 'bdv', 'x__6_17_R', '6_17_R', '`6_17_R`', '`6_17_R`', 201, 65535, -1, FALSE, '`6_17_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_6_17_R->Sortable = TRUE; // Allow sort
		$this->fields['6_17_R'] = &$this->_6_17_R;

		// 6_18_R
		$this->_6_18_R = new DbField('bdv', 'bdv', 'x__6_18_R', '6_18_R', '`6_18_R`', '`6_18_R`', 201, 65535, -1, FALSE, '`6_18_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_6_18_R->Sortable = TRUE; // Allow sort
		$this->fields['6_18_R'] = &$this->_6_18_R;

		// 6_19_R
		$this->_6_19_R = new DbField('bdv', 'bdv', 'x__6_19_R', '6_19_R', '`6_19_R`', '`6_19_R`', 201, 65535, -1, FALSE, '`6_19_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_6_19_R->Sortable = TRUE; // Allow sort
		$this->fields['6_19_R'] = &$this->_6_19_R;

		// 6_20_R
		$this->_6_20_R = new DbField('bdv', 'bdv', 'x__6_20_R', '6_20_R', '`6_20_R`', '`6_20_R`', 201, 65535, -1, FALSE, '`6_20_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_6_20_R->Sortable = TRUE; // Allow sort
		$this->fields['6_20_R'] = &$this->_6_20_R;

		// 6_52_R
		$this->_6_52_R = new DbField('bdv', 'bdv', 'x__6_52_R', '6_52_R', '`6_52_R`', '`6_52_R`', 201, 65535, -1, FALSE, '`6_52_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_6_52_R->Sortable = TRUE; // Allow sort
		$this->fields['6_52_R'] = &$this->_6_52_R;

		// 7_21_R
		$this->_7_21_R = new DbField('bdv', 'bdv', 'x__7_21_R', '7_21_R', '`7_21_R`', '`7_21_R`', 201, 65535, -1, FALSE, '`7_21_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_7_21_R->Sortable = TRUE; // Allow sort
		$this->fields['7_21_R'] = &$this->_7_21_R;

		// 8_22_R
		$this->_8_22_R = new DbField('bdv', 'bdv', 'x__8_22_R', '8_22_R', '`8_22_R`', '`8_22_R`', 201, 65535, -1, FALSE, '`8_22_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_8_22_R->Sortable = TRUE; // Allow sort
		$this->fields['8_22_R'] = &$this->_8_22_R;

		// 8_23_R
		$this->_8_23_R = new DbField('bdv', 'bdv', 'x__8_23_R', '8_23_R', '`8_23_R`', '`8_23_R`', 201, 65535, -1, FALSE, '`8_23_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_8_23_R->Sortable = TRUE; // Allow sort
		$this->fields['8_23_R'] = &$this->_8_23_R;

		// 8_24_R
		$this->_8_24_R = new DbField('bdv', 'bdv', 'x__8_24_R', '8_24_R', '`8_24_R`', '`8_24_R`', 201, 65535, -1, FALSE, '`8_24_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_8_24_R->Sortable = TRUE; // Allow sort
		$this->fields['8_24_R'] = &$this->_8_24_R;

		// 8_25_R
		$this->_8_25_R = new DbField('bdv', 'bdv', 'x__8_25_R', '8_25_R', '`8_25_R`', '`8_25_R`', 201, 65535, -1, FALSE, '`8_25_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_8_25_R->Sortable = TRUE; // Allow sort
		$this->fields['8_25_R'] = &$this->_8_25_R;

		// 9_26_R
		$this->_9_26_R = new DbField('bdv', 'bdv', 'x__9_26_R', '9_26_R', '`9_26_R`', '`9_26_R`', 201, 65535, -1, FALSE, '`9_26_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_9_26_R->Sortable = TRUE; // Allow sort
		$this->fields['9_26_R'] = &$this->_9_26_R;

		// 9_27_R
		$this->_9_27_R = new DbField('bdv', 'bdv', 'x__9_27_R', '9_27_R', '`9_27_R`', '`9_27_R`', 201, 65535, -1, FALSE, '`9_27_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_9_27_R->Sortable = TRUE; // Allow sort
		$this->fields['9_27_R'] = &$this->_9_27_R;

		// 9_28_R
		$this->_9_28_R = new DbField('bdv', 'bdv', 'x__9_28_R', '9_28_R', '`9_28_R`', '`9_28_R`', 201, 65535, -1, FALSE, '`9_28_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_9_28_R->Sortable = TRUE; // Allow sort
		$this->fields['9_28_R'] = &$this->_9_28_R;

		// 9_29_R
		$this->_9_29_R = new DbField('bdv', 'bdv', 'x__9_29_R', '9_29_R', '`9_29_R`', '`9_29_R`', 201, 65535, -1, FALSE, '`9_29_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_9_29_R->Sortable = TRUE; // Allow sort
		$this->fields['9_29_R'] = &$this->_9_29_R;

		// 9_30_R
		$this->_9_30_R = new DbField('bdv', 'bdv', 'x__9_30_R', '9_30_R', '`9_30_R`', '`9_30_R`', 201, 65535, -1, FALSE, '`9_30_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_9_30_R->Sortable = TRUE; // Allow sort
		$this->fields['9_30_R'] = &$this->_9_30_R;

		// 9_31_R
		$this->_9_31_R = new DbField('bdv', 'bdv', 'x__9_31_R', '9_31_R', '`9_31_R`', '`9_31_R`', 201, 65535, -1, FALSE, '`9_31_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_9_31_R->Sortable = TRUE; // Allow sort
		$this->fields['9_31_R'] = &$this->_9_31_R;

		// 9_32_R
		$this->_9_32_R = new DbField('bdv', 'bdv', 'x__9_32_R', '9_32_R', '`9_32_R`', '`9_32_R`', 201, 65535, -1, FALSE, '`9_32_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_9_32_R->Sortable = TRUE; // Allow sort
		$this->fields['9_32_R'] = &$this->_9_32_R;

		// 9_33_R
		$this->_9_33_R = new DbField('bdv', 'bdv', 'x__9_33_R', '9_33_R', '`9_33_R`', '`9_33_R`', 201, 65535, -1, FALSE, '`9_33_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_9_33_R->Sortable = TRUE; // Allow sort
		$this->fields['9_33_R'] = &$this->_9_33_R;

		// 9_34_R
		$this->_9_34_R = new DbField('bdv', 'bdv', 'x__9_34_R', '9_34_R', '`9_34_R`', '`9_34_R`', 201, 65535, -1, FALSE, '`9_34_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_9_34_R->Sortable = TRUE; // Allow sort
		$this->fields['9_34_R'] = &$this->_9_34_R;

		// 9_35_R
		$this->_9_35_R = new DbField('bdv', 'bdv', 'x__9_35_R', '9_35_R', '`9_35_R`', '`9_35_R`', 201, 65535, -1, FALSE, '`9_35_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_9_35_R->Sortable = TRUE; // Allow sort
		$this->fields['9_35_R'] = &$this->_9_35_R;

		// 9_36_R
		$this->_9_36_R = new DbField('bdv', 'bdv', 'x__9_36_R', '9_36_R', '`9_36_R`', '`9_36_R`', 201, 65535, -1, FALSE, '`9_36_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_9_36_R->Sortable = TRUE; // Allow sort
		$this->fields['9_36_R'] = &$this->_9_36_R;

		// 9_37_R
		$this->_9_37_R = new DbField('bdv', 'bdv', 'x__9_37_R', '9_37_R', '`9_37_R`', '`9_37_R`', 201, 65535, -1, FALSE, '`9_37_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_9_37_R->Sortable = TRUE; // Allow sort
		$this->fields['9_37_R'] = &$this->_9_37_R;

		// 9_38_R
		$this->_9_38_R = new DbField('bdv', 'bdv', 'x__9_38_R', '9_38_R', '`9_38_R`', '`9_38_R`', 201, 65535, -1, FALSE, '`9_38_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_9_38_R->Sortable = TRUE; // Allow sort
		$this->fields['9_38_R'] = &$this->_9_38_R;

		// 9_39_R
		$this->_9_39_R = new DbField('bdv', 'bdv', 'x__9_39_R', '9_39_R', '`9_39_R`', '`9_39_R`', 201, 65535, -1, FALSE, '`9_39_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_9_39_R->Sortable = TRUE; // Allow sort
		$this->fields['9_39_R'] = &$this->_9_39_R;

		// 10_40_R
		$this->_10_40_R = new DbField('bdv', 'bdv', 'x__10_40_R', '10_40_R', '`10_40_R`', '`10_40_R`', 201, 65535, -1, FALSE, '`10_40_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_10_40_R->Sortable = TRUE; // Allow sort
		$this->fields['10_40_R'] = &$this->_10_40_R;

		// 10_41_R
		$this->_10_41_R = new DbField('bdv', 'bdv', 'x__10_41_R', '10_41_R', '`10_41_R`', '`10_41_R`', 201, 65535, -1, FALSE, '`10_41_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_10_41_R->Sortable = TRUE; // Allow sort
		$this->fields['10_41_R'] = &$this->_10_41_R;

		// 11_42_R
		$this->_11_42_R = new DbField('bdv', 'bdv', 'x__11_42_R', '11_42_R', '`11_42_R`', '`11_42_R`', 201, 65535, -1, FALSE, '`11_42_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_11_42_R->Sortable = TRUE; // Allow sort
		$this->fields['11_42_R'] = &$this->_11_42_R;

		// 11_43_R
		$this->_11_43_R = new DbField('bdv', 'bdv', 'x__11_43_R', '11_43_R', '`11_43_R`', '`11_43_R`', 201, 65535, -1, FALSE, '`11_43_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_11_43_R->Sortable = TRUE; // Allow sort
		$this->fields['11_43_R'] = &$this->_11_43_R;

		// 12_44_R
		$this->_12_44_R = new DbField('bdv', 'bdv', 'x__12_44_R', '12_44_R', '`12_44_R`', '`12_44_R`', 201, 65535, -1, FALSE, '`12_44_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_12_44_R->Sortable = TRUE; // Allow sort
		$this->fields['12_44_R'] = &$this->_12_44_R;

		// 12_45_R
		$this->_12_45_R = new DbField('bdv', 'bdv', 'x__12_45_R', '12_45_R', '`12_45_R`', '`12_45_R`', 201, 65535, -1, FALSE, '`12_45_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_12_45_R->Sortable = TRUE; // Allow sort
		$this->fields['12_45_R'] = &$this->_12_45_R;

		// 12_46_R
		$this->_12_46_R = new DbField('bdv', 'bdv', 'x__12_46_R', '12_46_R', '`12_46_R`', '`12_46_R`', 201, 65535, -1, FALSE, '`12_46_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_12_46_R->Sortable = TRUE; // Allow sort
		$this->fields['12_46_R'] = &$this->_12_46_R;

		// 12_47_R
		$this->_12_47_R = new DbField('bdv', 'bdv', 'x__12_47_R', '12_47_R', '`12_47_R`', '`12_47_R`', 201, 65535, -1, FALSE, '`12_47_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_12_47_R->Sortable = TRUE; // Allow sort
		$this->fields['12_47_R'] = &$this->_12_47_R;

		// 12_48_R
		$this->_12_48_R = new DbField('bdv', 'bdv', 'x__12_48_R', '12_48_R', '`12_48_R`', '`12_48_R`', 201, 65535, -1, FALSE, '`12_48_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_12_48_R->Sortable = TRUE; // Allow sort
		$this->fields['12_48_R'] = &$this->_12_48_R;

		// 12_49_R
		$this->_12_49_R = new DbField('bdv', 'bdv', 'x__12_49_R', '12_49_R', '`12_49_R`', '`12_49_R`', 201, 65535, -1, FALSE, '`12_49_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_12_49_R->Sortable = TRUE; // Allow sort
		$this->fields['12_49_R'] = &$this->_12_49_R;

		// 12_50_R
		$this->_12_50_R = new DbField('bdv', 'bdv', 'x__12_50_R', '12_50_R', '`12_50_R`', '`12_50_R`', 201, 65535, -1, FALSE, '`12_50_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_12_50_R->Sortable = TRUE; // Allow sort
		$this->fields['12_50_R'] = &$this->_12_50_R;

		// 1__R
		$this->_1__R = new DbField('bdv', 'bdv', 'x__1__R', '1__R', '`1__R`', '`1__R`', 201, 65535, -1, FALSE, '`1__R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_1__R->Sortable = TRUE; // Allow sort
		$this->fields['1__R'] = &$this->_1__R;

		// 13_54_R
		$this->_13_54_R = new DbField('bdv', 'bdv', 'x__13_54_R', '13_54_R', '`13_54_R`', '`13_54_R`', 201, 65535, -1, FALSE, '`13_54_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_13_54_R->Sortable = TRUE; // Allow sort
		$this->fields['13_54_R'] = &$this->_13_54_R;

		// 13_54_1_R
		$this->_13_54_1_R = new DbField('bdv', 'bdv', 'x__13_54_1_R', '13_54_1_R', '`13_54_1_R`', '`13_54_1_R`', 201, 65535, -1, FALSE, '`13_54_1_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_13_54_1_R->Sortable = TRUE; // Allow sort
		$this->fields['13_54_1_R'] = &$this->_13_54_1_R;

		// 13_54_2_R
		$this->_13_54_2_R = new DbField('bdv', 'bdv', 'x__13_54_2_R', '13_54_2_R', '`13_54_2_R`', '`13_54_2_R`', 201, 65535, -1, FALSE, '`13_54_2_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_13_54_2_R->Sortable = TRUE; // Allow sort
		$this->fields['13_54_2_R'] = &$this->_13_54_2_R;

		// 13_55_R
		$this->_13_55_R = new DbField('bdv', 'bdv', 'x__13_55_R', '13_55_R', '`13_55_R`', '`13_55_R`', 201, 65535, -1, FALSE, '`13_55_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_13_55_R->Sortable = TRUE; // Allow sort
		$this->fields['13_55_R'] = &$this->_13_55_R;

		// 13_55_1_R
		$this->_13_55_1_R = new DbField('bdv', 'bdv', 'x__13_55_1_R', '13_55_1_R', '`13_55_1_R`', '`13_55_1_R`', 201, 65535, -1, FALSE, '`13_55_1_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_13_55_1_R->Sortable = TRUE; // Allow sort
		$this->fields['13_55_1_R'] = &$this->_13_55_1_R;

		// 13_55_2_R
		$this->_13_55_2_R = new DbField('bdv', 'bdv', 'x__13_55_2_R', '13_55_2_R', '`13_55_2_R`', '`13_55_2_R`', 201, 65535, -1, FALSE, '`13_55_2_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_13_55_2_R->Sortable = TRUE; // Allow sort
		$this->fields['13_55_2_R'] = &$this->_13_55_2_R;

		// 13_56_R
		$this->_13_56_R = new DbField('bdv', 'bdv', 'x__13_56_R', '13_56_R', '`13_56_R`', '`13_56_R`', 201, 65535, -1, FALSE, '`13_56_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_13_56_R->Sortable = TRUE; // Allow sort
		$this->fields['13_56_R'] = &$this->_13_56_R;

		// 13_56_1_R
		$this->_13_56_1_R = new DbField('bdv', 'bdv', 'x__13_56_1_R', '13_56_1_R', '`13_56_1_R`', '`13_56_1_R`', 201, 65535, -1, FALSE, '`13_56_1_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_13_56_1_R->Sortable = TRUE; // Allow sort
		$this->fields['13_56_1_R'] = &$this->_13_56_1_R;

		// 13_56_2_R
		$this->_13_56_2_R = new DbField('bdv', 'bdv', 'x__13_56_2_R', '13_56_2_R', '`13_56_2_R`', '`13_56_2_R`', 201, 65535, -1, FALSE, '`13_56_2_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_13_56_2_R->Sortable = TRUE; // Allow sort
		$this->fields['13_56_2_R'] = &$this->_13_56_2_R;

		// 12_53_R
		$this->_12_53_R = new DbField('bdv', 'bdv', 'x__12_53_R', '12_53_R', '`12_53_R`', '`12_53_R`', 201, 65535, -1, FALSE, '`12_53_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_12_53_R->Sortable = TRUE; // Allow sort
		$this->fields['12_53_R'] = &$this->_12_53_R;

		// 12_53_1_R
		$this->_12_53_1_R = new DbField('bdv', 'bdv', 'x__12_53_1_R', '12_53_1_R', '`12_53_1_R`', '`12_53_1_R`', 201, 65535, -1, FALSE, '`12_53_1_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_12_53_1_R->Sortable = TRUE; // Allow sort
		$this->fields['12_53_1_R'] = &$this->_12_53_1_R;

		// 12_53_2_R
		$this->_12_53_2_R = new DbField('bdv', 'bdv', 'x__12_53_2_R', '12_53_2_R', '`12_53_2_R`', '`12_53_2_R`', 201, 65535, -1, FALSE, '`12_53_2_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_12_53_2_R->Sortable = TRUE; // Allow sort
		$this->fields['12_53_2_R'] = &$this->_12_53_2_R;

		// 12_53_3_R
		$this->_12_53_3_R = new DbField('bdv', 'bdv', 'x__12_53_3_R', '12_53_3_R', '`12_53_3_R`', '`12_53_3_R`', 201, 65535, -1, FALSE, '`12_53_3_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_12_53_3_R->Sortable = TRUE; // Allow sort
		$this->fields['12_53_3_R'] = &$this->_12_53_3_R;

		// 12_53_4_R
		$this->_12_53_4_R = new DbField('bdv', 'bdv', 'x__12_53_4_R', '12_53_4_R', '`12_53_4_R`', '`12_53_4_R`', 201, 65535, -1, FALSE, '`12_53_4_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_12_53_4_R->Sortable = TRUE; // Allow sort
		$this->fields['12_53_4_R'] = &$this->_12_53_4_R;

		// 12_53_5_R
		$this->_12_53_5_R = new DbField('bdv', 'bdv', 'x__12_53_5_R', '12_53_5_R', '`12_53_5_R`', '`12_53_5_R`', 201, 65535, -1, FALSE, '`12_53_5_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_12_53_5_R->Sortable = TRUE; // Allow sort
		$this->fields['12_53_5_R'] = &$this->_12_53_5_R;

		// 12_53_6_R
		$this->_12_53_6_R = new DbField('bdv', 'bdv', 'x__12_53_6_R', '12_53_6_R', '`12_53_6_R`', '`12_53_6_R`', 201, 65535, -1, FALSE, '`12_53_6_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_12_53_6_R->Sortable = TRUE; // Allow sort
		$this->fields['12_53_6_R'] = &$this->_12_53_6_R;

		// 13_57_R
		$this->_13_57_R = new DbField('bdv', 'bdv', 'x__13_57_R', '13_57_R', '`13_57_R`', '`13_57_R`', 201, 65535, -1, FALSE, '`13_57_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_13_57_R->Sortable = TRUE; // Allow sort
		$this->fields['13_57_R'] = &$this->_13_57_R;

		// 13_57_1_R
		$this->_13_57_1_R = new DbField('bdv', 'bdv', 'x__13_57_1_R', '13_57_1_R', '`13_57_1_R`', '`13_57_1_R`', 201, 65535, -1, FALSE, '`13_57_1_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_13_57_1_R->Sortable = TRUE; // Allow sort
		$this->fields['13_57_1_R'] = &$this->_13_57_1_R;

		// 13_57_2_R
		$this->_13_57_2_R = new DbField('bdv', 'bdv', 'x__13_57_2_R', '13_57_2_R', '`13_57_2_R`', '`13_57_2_R`', 201, 65535, -1, FALSE, '`13_57_2_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_13_57_2_R->Sortable = TRUE; // Allow sort
		$this->fields['13_57_2_R'] = &$this->_13_57_2_R;

		// 13_58_R
		$this->_13_58_R = new DbField('bdv', 'bdv', 'x__13_58_R', '13_58_R', '`13_58_R`', '`13_58_R`', 201, 65535, -1, FALSE, '`13_58_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_13_58_R->Sortable = TRUE; // Allow sort
		$this->fields['13_58_R'] = &$this->_13_58_R;

		// 13_58_1_R
		$this->_13_58_1_R = new DbField('bdv', 'bdv', 'x__13_58_1_R', '13_58_1_R', '`13_58_1_R`', '`13_58_1_R`', 201, 65535, -1, FALSE, '`13_58_1_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_13_58_1_R->Sortable = TRUE; // Allow sort
		$this->fields['13_58_1_R'] = &$this->_13_58_1_R;

		// 13_58_2_R
		$this->_13_58_2_R = new DbField('bdv', 'bdv', 'x__13_58_2_R', '13_58_2_R', '`13_58_2_R`', '`13_58_2_R`', 201, 65535, -1, FALSE, '`13_58_2_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_13_58_2_R->Sortable = TRUE; // Allow sort
		$this->fields['13_58_2_R'] = &$this->_13_58_2_R;

		// 13_59_R
		$this->_13_59_R = new DbField('bdv', 'bdv', 'x__13_59_R', '13_59_R', '`13_59_R`', '`13_59_R`', 201, 65535, -1, FALSE, '`13_59_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_13_59_R->Sortable = TRUE; // Allow sort
		$this->fields['13_59_R'] = &$this->_13_59_R;

		// 13_59_1_R
		$this->_13_59_1_R = new DbField('bdv', 'bdv', 'x__13_59_1_R', '13_59_1_R', '`13_59_1_R`', '`13_59_1_R`', 201, 65535, -1, FALSE, '`13_59_1_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_13_59_1_R->Sortable = TRUE; // Allow sort
		$this->fields['13_59_1_R'] = &$this->_13_59_1_R;

		// 13_59_2_R
		$this->_13_59_2_R = new DbField('bdv', 'bdv', 'x__13_59_2_R', '13_59_2_R', '`13_59_2_R`', '`13_59_2_R`', 201, 65535, -1, FALSE, '`13_59_2_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_13_59_2_R->Sortable = TRUE; // Allow sort
		$this->fields['13_59_2_R'] = &$this->_13_59_2_R;

		// 13_60_R
		$this->_13_60_R = new DbField('bdv', 'bdv', 'x__13_60_R', '13_60_R', '`13_60_R`', '`13_60_R`', 201, 65535, -1, FALSE, '`13_60_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_13_60_R->Sortable = TRUE; // Allow sort
		$this->fields['13_60_R'] = &$this->_13_60_R;

		// 12_53_7_R
		$this->_12_53_7_R = new DbField('bdv', 'bdv', 'x__12_53_7_R', '12_53_7_R', '`12_53_7_R`', '`12_53_7_R`', 201, 65535, -1, FALSE, '`12_53_7_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_12_53_7_R->Sortable = TRUE; // Allow sort
		$this->fields['12_53_7_R'] = &$this->_12_53_7_R;

		// 12_53_8_R
		$this->_12_53_8_R = new DbField('bdv', 'bdv', 'x__12_53_8_R', '12_53_8_R', '`12_53_8_R`', '`12_53_8_R`', 201, 65535, -1, FALSE, '`12_53_8_R`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->_12_53_8_R->Sortable = TRUE; // Allow sort
		$this->fields['12_53_8_R'] = &$this->_12_53_8_R;
	}

	// Field Visibility
	public function getFieldVisibility($fldParm)
	{
		global $Security;
		return $this->$fldParm->Visible; // Returns original value
	}

	// Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
	function setLeftColumnClass($class)
	{
		if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
			$this->LeftColumnClass = $class . " col-form-label ew-label";
			$this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
			$this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
			$this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
		}
	}

	// Single column sort
	public function updateSort(&$fld)
	{
		if ($this->CurrentOrder == $fld->Name) {
			$sortField = $fld->Expression;
			$lastSort = $fld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$thisSort = $this->CurrentOrderType;
			} else {
				$thisSort = ($lastSort == "ASC") ? "DESC" : "ASC";
			}
			$fld->setSort($thisSort);
			$this->setSessionOrderBy($sortField . " " . $thisSort); // Save to Session
		} else {
			$fld->setSort("");
		}
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`bdv`";
	}
	public function sqlFrom() // For backward compatibility
	{
		return $this->getSqlFrom();
	}
	public function setSqlFrom($v)
	{
		$this->SqlFrom = $v;
	}
	public function getSqlSelect() // Select
	{
		return ($this->SqlSelect != "") ? $this->SqlSelect : "SELECT * FROM " . $this->getSqlFrom();
	}
	public function sqlSelect() // For backward compatibility
	{
		return $this->getSqlSelect();
	}
	public function setSqlSelect($v)
	{
		$this->SqlSelect = $v;
	}
	public function getSqlWhere() // Where
	{
		$where = ($this->SqlWhere != "") ? $this->SqlWhere : "";
		$this->TableFilter = "";
		AddFilter($where, $this->TableFilter);
		return $where;
	}
	public function sqlWhere() // For backward compatibility
	{
		return $this->getSqlWhere();
	}
	public function setSqlWhere($v)
	{
		$this->SqlWhere = $v;
	}
	public function getSqlGroupBy() // Group By
	{
		return ($this->SqlGroupBy != "") ? $this->SqlGroupBy : "";
	}
	public function sqlGroupBy() // For backward compatibility
	{
		return $this->getSqlGroupBy();
	}
	public function setSqlGroupBy($v)
	{
		$this->SqlGroupBy = $v;
	}
	public function getSqlHaving() // Having
	{
		return ($this->SqlHaving != "") ? $this->SqlHaving : "";
	}
	public function sqlHaving() // For backward compatibility
	{
		return $this->getSqlHaving();
	}
	public function setSqlHaving($v)
	{
		$this->SqlHaving = $v;
	}
	public function getSqlOrderBy() // Order By
	{
		return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "";
	}
	public function sqlOrderBy() // For backward compatibility
	{
		return $this->getSqlOrderBy();
	}
	public function setSqlOrderBy($v)
	{
		$this->SqlOrderBy = $v;
	}

	// Apply User ID filters
	public function applyUserIDFilters($filter)
	{
		return $filter;
	}

	// Check if User ID security allows view all
	public function userIDAllow($id = "")
	{
		$allow = Config("USER_ID_ALLOW");
		switch ($id) {
			case "add":
			case "copy":
			case "gridadd":
			case "register":
			case "addopt":
				return (($allow & 1) == 1);
			case "edit":
			case "gridedit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return (($allow & 4) == 4);
			case "delete":
				return (($allow & 2) == 2);
			case "view":
				return (($allow & 32) == 32);
			case "search":
				return (($allow & 64) == 64);
			default:
				return (($allow & 8) == 8);
		}
	}

	// Get recordset
	public function getRecordset($sql, $rowcnt = -1, $offset = -1)
	{
		$conn = $this->getConnection();
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->selectLimit($sql, $rowcnt, $offset);
		$conn->raiseErrorFn = "";
		return $rs;
	}

	// Get record count
	public function getRecordCount($sql)
	{
		$cnt = -1;
		$rs = NULL;
		$sql = preg_replace('/\/\*BeginOrderBy\*\/[\s\S]+\/\*EndOrderBy\*\//', "", $sql); // Remove ORDER BY clause (MSSQL)
		$pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';

		// Skip Custom View / SubQuery and SELECT DISTINCT
		if (($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
			preg_match($pattern, $sql) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sql) && !preg_match('/^\s*select\s+distinct\s+/i', $sql)) {
			$sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sql);
		} else {
			$sqlwrk = "SELECT COUNT(*) FROM (" . $sql . ") COUNT_TABLE";
		}
		$conn = $this->getConnection();
		if ($rs = $conn->execute($sqlwrk)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->close();
			}
			return (int)$cnt;
		}

		// Unable to get count, get record count directly
		if ($rs = $conn->execute($sql)) {
			$cnt = $rs->RecordCount();
			$rs->close();
			return (int)$cnt;
		}
		return $cnt;
	}

	// Get SQL
	public function getSql($where, $orderBy = "")
	{
		return BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$where, $orderBy);
	}

	// Table SQL
	public function getCurrentSql()
	{
		$filter = $this->CurrentFilter;
		$filter = $this->applyUserIDFilters($filter);
		$sort = $this->getSessionOrderBy();
		return $this->getSql($filter, $sort);
	}

	// Table SQL with List page filter
	public function getListSql()
	{
		$filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->getSqlSelect();
		$sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
		return BuildSelectSql($select, $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $filter, $sort);
	}

	// Get ORDER BY clause
	public function getOrderBy()
	{
		$sort = $this->getSessionOrderBy();
		return BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sort);
	}

	// Get record count based on filter (for detail record count in master table pages)
	public function loadRecordCount($filter)
	{
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $filter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
		$cnt = $this->getRecordCount($sql);
		$this->CurrentFilter = $origFilter;
		return $cnt;
	}

	// Get record count (for current List page)
	public function listRecordCount()
	{
		$filter = $this->getSessionWhere();
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
		$cnt = $this->getRecordCount($sql);
		return $cnt;
	}

	// INSERT statement
	protected function insertSql(&$rs)
	{
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom)
				continue;
			$names .= $this->fields[$name]->Expression . ",";
			$values .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$names = preg_replace('/,+$/', "", $names);
		$values = preg_replace('/,+$/', "", $values);
		return "INSERT INTO " . $this->UpdateTable . " ($names) VALUES ($values)";
	}

	// Insert
	public function insert(&$rs)
	{
		$conn = $this->getConnection();
		$success = $conn->execute($this->insertSql($rs));
		if ($success) {

			// Get insert id if necessary
			$this->id->setDbValue($conn->insert_ID());
			$rs['id'] = $this->id->DbValue;
		}
		return $success;
	}

	// UPDATE statement
	protected function updateSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "UPDATE " . $this->UpdateTable . " SET ";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom || $this->fields[$name]->IsAutoIncrement)
				continue;
			$sql .= $this->fields[$name]->Expression . "=";
			$sql .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$sql = preg_replace('/,+$/', "", $sql);
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		AddFilter($filter, $where);
		if ($filter != "")
			$sql .= " WHERE " . $filter;
		return $sql;
	}

	// Update
	public function update(&$rs, $where = "", $rsold = NULL, $curfilter = TRUE)
	{
		$conn = $this->getConnection();
		$success = $conn->execute($this->updateSql($rs, $where, $curfilter));
		return $success;
	}

	// DELETE statement
	protected function deleteSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		if ($rs) {
			if (array_key_exists('id', $rs))
				AddFilter($where, QuotedName('id', $this->Dbid) . '=' . QuotedValue($rs['id'], $this->id->DataType, $this->Dbid));
		}
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		AddFilter($filter, $where);
		if ($filter != "")
			$sql .= $filter;
		else
			$sql .= "0=1"; // Avoid delete
		return $sql;
	}

	// Delete
	public function delete(&$rs, $where = "", $curfilter = FALSE)
	{
		$success = TRUE;
		$conn = $this->getConnection();
		if ($success)
			$success = $conn->execute($this->deleteSql($rs, $where, $curfilter));
		return $success;
	}

	// Load DbValue from recordset or array
	protected function loadDbValues(&$rs)
	{
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->fecha->DbValue = $row['fecha'];
		$this->hora->DbValue = $row['hora'];
		$this->audio->DbValue = $row['audio'];
		$this->st->DbValue = $row['st'];
		$this->fechaHoraIni->DbValue = $row['fechaHoraIni'];
		$this->fechaHoraFin->DbValue = $row['fechaHoraFin'];
		$this->telefono->DbValue = $row['telefono'];
		$this->agente->DbValue = $row['agente'];
		$this->fechabo->DbValue = $row['fechabo'];
		$this->agentebo->DbValue = $row['agentebo'];
		$this->comentariosbo->DbValue = $row['comentariosbo'];
		$this->IP->DbValue = $row['IP'];
		$this->actual->DbValue = $row['actual'];
		$this->completado->DbValue = $row['completado'];
		$this->_2_1_R->DbValue = $row['2_1_R'];
		$this->_2_2_R->DbValue = $row['2_2_R'];
		$this->_2_3_R->DbValue = $row['2_3_R'];
		$this->_3_4_R->DbValue = $row['3_4_R'];
		$this->_4_5_R->DbValue = $row['4_5_R'];
		$this->_4_6_R->DbValue = $row['4_6_R'];
		$this->_4_7_R->DbValue = $row['4_7_R'];
		$this->_4_8_R->DbValue = $row['4_8_R'];
		$this->_5_9_R->DbValue = $row['5_9_R'];
		$this->_5_10_R->DbValue = $row['5_10_R'];
		$this->_5_11_R->DbValue = $row['5_11_R'];
		$this->_5_12_R->DbValue = $row['5_12_R'];
		$this->_5_13_R->DbValue = $row['5_13_R'];
		$this->_5_14_R->DbValue = $row['5_14_R'];
		$this->_5_51_R->DbValue = $row['5_51_R'];
		$this->_6_15_R->DbValue = $row['6_15_R'];
		$this->_6_16_R->DbValue = $row['6_16_R'];
		$this->_6_17_R->DbValue = $row['6_17_R'];
		$this->_6_18_R->DbValue = $row['6_18_R'];
		$this->_6_19_R->DbValue = $row['6_19_R'];
		$this->_6_20_R->DbValue = $row['6_20_R'];
		$this->_6_52_R->DbValue = $row['6_52_R'];
		$this->_7_21_R->DbValue = $row['7_21_R'];
		$this->_8_22_R->DbValue = $row['8_22_R'];
		$this->_8_23_R->DbValue = $row['8_23_R'];
		$this->_8_24_R->DbValue = $row['8_24_R'];
		$this->_8_25_R->DbValue = $row['8_25_R'];
		$this->_9_26_R->DbValue = $row['9_26_R'];
		$this->_9_27_R->DbValue = $row['9_27_R'];
		$this->_9_28_R->DbValue = $row['9_28_R'];
		$this->_9_29_R->DbValue = $row['9_29_R'];
		$this->_9_30_R->DbValue = $row['9_30_R'];
		$this->_9_31_R->DbValue = $row['9_31_R'];
		$this->_9_32_R->DbValue = $row['9_32_R'];
		$this->_9_33_R->DbValue = $row['9_33_R'];
		$this->_9_34_R->DbValue = $row['9_34_R'];
		$this->_9_35_R->DbValue = $row['9_35_R'];
		$this->_9_36_R->DbValue = $row['9_36_R'];
		$this->_9_37_R->DbValue = $row['9_37_R'];
		$this->_9_38_R->DbValue = $row['9_38_R'];
		$this->_9_39_R->DbValue = $row['9_39_R'];
		$this->_10_40_R->DbValue = $row['10_40_R'];
		$this->_10_41_R->DbValue = $row['10_41_R'];
		$this->_11_42_R->DbValue = $row['11_42_R'];
		$this->_11_43_R->DbValue = $row['11_43_R'];
		$this->_12_44_R->DbValue = $row['12_44_R'];
		$this->_12_45_R->DbValue = $row['12_45_R'];
		$this->_12_46_R->DbValue = $row['12_46_R'];
		$this->_12_47_R->DbValue = $row['12_47_R'];
		$this->_12_48_R->DbValue = $row['12_48_R'];
		$this->_12_49_R->DbValue = $row['12_49_R'];
		$this->_12_50_R->DbValue = $row['12_50_R'];
		$this->_1__R->DbValue = $row['1__R'];
		$this->_13_54_R->DbValue = $row['13_54_R'];
		$this->_13_54_1_R->DbValue = $row['13_54_1_R'];
		$this->_13_54_2_R->DbValue = $row['13_54_2_R'];
		$this->_13_55_R->DbValue = $row['13_55_R'];
		$this->_13_55_1_R->DbValue = $row['13_55_1_R'];
		$this->_13_55_2_R->DbValue = $row['13_55_2_R'];
		$this->_13_56_R->DbValue = $row['13_56_R'];
		$this->_13_56_1_R->DbValue = $row['13_56_1_R'];
		$this->_13_56_2_R->DbValue = $row['13_56_2_R'];
		$this->_12_53_R->DbValue = $row['12_53_R'];
		$this->_12_53_1_R->DbValue = $row['12_53_1_R'];
		$this->_12_53_2_R->DbValue = $row['12_53_2_R'];
		$this->_12_53_3_R->DbValue = $row['12_53_3_R'];
		$this->_12_53_4_R->DbValue = $row['12_53_4_R'];
		$this->_12_53_5_R->DbValue = $row['12_53_5_R'];
		$this->_12_53_6_R->DbValue = $row['12_53_6_R'];
		$this->_13_57_R->DbValue = $row['13_57_R'];
		$this->_13_57_1_R->DbValue = $row['13_57_1_R'];
		$this->_13_57_2_R->DbValue = $row['13_57_2_R'];
		$this->_13_58_R->DbValue = $row['13_58_R'];
		$this->_13_58_1_R->DbValue = $row['13_58_1_R'];
		$this->_13_58_2_R->DbValue = $row['13_58_2_R'];
		$this->_13_59_R->DbValue = $row['13_59_R'];
		$this->_13_59_1_R->DbValue = $row['13_59_1_R'];
		$this->_13_59_2_R->DbValue = $row['13_59_2_R'];
		$this->_13_60_R->DbValue = $row['13_60_R'];
		$this->_12_53_7_R->DbValue = $row['12_53_7_R'];
		$this->_12_53_8_R->DbValue = $row['12_53_8_R'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`id` = @id@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('id', $row) ? $row['id'] : NULL;
		else
			$val = $this->id->OldValue !== NULL ? $this->id->OldValue : $this->id->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
		return $keyFilter;
	}

	// Return page URL
	public function getReturnUrl()
	{
		$name = PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL");

		// Get referer URL automatically
		if (ServerVar("HTTP_REFERER") != "" && ReferPageName() != CurrentPageName() && ReferPageName() != "login.php") // Referer not same page or login page
			$_SESSION[$name] = ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] != "") {
			return $_SESSION[$name];
		} else {
			return "bdvlist.php";
		}
	}
	public function setReturnUrl($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL")] = $v;
	}

	// Get modal caption
	public function getModalCaption($pageName)
	{
		global $Language;
		if ($pageName == "bdvview.php")
			return $Language->phrase("View");
		elseif ($pageName == "bdvedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "bdvadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "bdvlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("bdvview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("bdvview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "bdvadd.php?" . $this->getUrlParm($parm);
		else
			$url = "bdvadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("bdvedit.php", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline edit URL
	public function getInlineEditUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=edit"));
		return $this->addMasterUrl($url);
	}

	// Copy URL
	public function getCopyUrl($parm = "")
	{
		$url = $this->keyUrl("bdvadd.php", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline copy URL
	public function getInlineCopyUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=copy"));
		return $this->addMasterUrl($url);
	}

	// Delete URL
	public function getDeleteUrl()
	{
		return $this->keyUrl("bdvdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "id:" . JsonEncode($this->id->CurrentValue, "number");
		$json = "{" . $json . "}";
		if ($htmlEncode)
			$json = HtmlEncode($json);
		return $json;
	}

	// Add key value to URL
	public function keyUrl($url, $parm = "")
	{
		$url = $url . "?";
		if ($parm != "")
			$url .= $parm . "&";
		if ($this->id->CurrentValue != NULL) {
			$url .= "id=" . urlencode($this->id->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		return $url;
	}

	// Sort URL
	public function sortUrl(&$fld)
	{
		if ($this->CurrentAction || $this->isExport() ||
			in_array($fld->Type, [128, 204, 205])) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->reverseSort());
			return $this->addMasterUrl(CurrentPageName() . "?" . $urlParm);
		} else {
			return "";
		}
	}

	// Get record keys from Post/Get/Session
	public function getRecordKeys()
	{
		$arKeys = [];
		$arKey = [];
		if (Param("key_m") !== NULL) {
			$arKeys = Param("key_m");
			$cnt = count($arKeys);
		} else {
			if (Param("id") !== NULL)
				$arKeys[] = Param("id");
			elseif (IsApi() && Key(0) !== NULL)
				$arKeys[] = Key(0);
			elseif (IsApi() && Route(2) !== NULL)
				$arKeys[] = Route(2);
			else
				$arKeys = NULL; // Do not setup

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = [];
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_numeric($key))
					continue;
				$ar[] = $key;
			}
		}
		return $ar;
	}

	// Get filter from record keys
	public function getFilterFromRecordKeys($setCurrent = TRUE)
	{
		$arKeys = $this->getRecordKeys();
		$keyFilter = "";
		foreach ($arKeys as $key) {
			if ($keyFilter != "") $keyFilter .= " OR ";
			if ($setCurrent)
				$this->id->CurrentValue = $key;
			else
				$this->id->OldValue = $key;
			$keyFilter .= "(" . $this->getRecordFilter() . ")";
		}
		return $keyFilter;
	}

	// Load rows based on filter
	public function &loadRs($filter)
	{

		// Set up filter (WHERE Clause)
		$sql = $this->getSql($filter);
		$conn = $this->getConnection();
		$rs = $conn->execute($sql);
		return $rs;
	}

	// Load row values from recordset
	public function loadListRowValues(&$rs)
	{
		$this->id->setDbValue($rs->fields('id'));
		$this->fecha->setDbValue($rs->fields('fecha'));
		$this->hora->setDbValue($rs->fields('hora'));
		$this->audio->setDbValue($rs->fields('audio'));
		$this->st->setDbValue($rs->fields('st'));
		$this->fechaHoraIni->setDbValue($rs->fields('fechaHoraIni'));
		$this->fechaHoraFin->setDbValue($rs->fields('fechaHoraFin'));
		$this->telefono->setDbValue($rs->fields('telefono'));
		$this->agente->setDbValue($rs->fields('agente'));
		$this->fechabo->setDbValue($rs->fields('fechabo'));
		$this->agentebo->setDbValue($rs->fields('agentebo'));
		$this->comentariosbo->setDbValue($rs->fields('comentariosbo'));
		$this->IP->setDbValue($rs->fields('IP'));
		$this->actual->setDbValue($rs->fields('actual'));
		$this->completado->setDbValue($rs->fields('completado'));
		$this->_2_1_R->setDbValue($rs->fields('2_1_R'));
		$this->_2_2_R->setDbValue($rs->fields('2_2_R'));
		$this->_2_3_R->setDbValue($rs->fields('2_3_R'));
		$this->_3_4_R->setDbValue($rs->fields('3_4_R'));
		$this->_4_5_R->setDbValue($rs->fields('4_5_R'));
		$this->_4_6_R->setDbValue($rs->fields('4_6_R'));
		$this->_4_7_R->setDbValue($rs->fields('4_7_R'));
		$this->_4_8_R->setDbValue($rs->fields('4_8_R'));
		$this->_5_9_R->setDbValue($rs->fields('5_9_R'));
		$this->_5_10_R->setDbValue($rs->fields('5_10_R'));
		$this->_5_11_R->setDbValue($rs->fields('5_11_R'));
		$this->_5_12_R->setDbValue($rs->fields('5_12_R'));
		$this->_5_13_R->setDbValue($rs->fields('5_13_R'));
		$this->_5_14_R->setDbValue($rs->fields('5_14_R'));
		$this->_5_51_R->setDbValue($rs->fields('5_51_R'));
		$this->_6_15_R->setDbValue($rs->fields('6_15_R'));
		$this->_6_16_R->setDbValue($rs->fields('6_16_R'));
		$this->_6_17_R->setDbValue($rs->fields('6_17_R'));
		$this->_6_18_R->setDbValue($rs->fields('6_18_R'));
		$this->_6_19_R->setDbValue($rs->fields('6_19_R'));
		$this->_6_20_R->setDbValue($rs->fields('6_20_R'));
		$this->_6_52_R->setDbValue($rs->fields('6_52_R'));
		$this->_7_21_R->setDbValue($rs->fields('7_21_R'));
		$this->_8_22_R->setDbValue($rs->fields('8_22_R'));
		$this->_8_23_R->setDbValue($rs->fields('8_23_R'));
		$this->_8_24_R->setDbValue($rs->fields('8_24_R'));
		$this->_8_25_R->setDbValue($rs->fields('8_25_R'));
		$this->_9_26_R->setDbValue($rs->fields('9_26_R'));
		$this->_9_27_R->setDbValue($rs->fields('9_27_R'));
		$this->_9_28_R->setDbValue($rs->fields('9_28_R'));
		$this->_9_29_R->setDbValue($rs->fields('9_29_R'));
		$this->_9_30_R->setDbValue($rs->fields('9_30_R'));
		$this->_9_31_R->setDbValue($rs->fields('9_31_R'));
		$this->_9_32_R->setDbValue($rs->fields('9_32_R'));
		$this->_9_33_R->setDbValue($rs->fields('9_33_R'));
		$this->_9_34_R->setDbValue($rs->fields('9_34_R'));
		$this->_9_35_R->setDbValue($rs->fields('9_35_R'));
		$this->_9_36_R->setDbValue($rs->fields('9_36_R'));
		$this->_9_37_R->setDbValue($rs->fields('9_37_R'));
		$this->_9_38_R->setDbValue($rs->fields('9_38_R'));
		$this->_9_39_R->setDbValue($rs->fields('9_39_R'));
		$this->_10_40_R->setDbValue($rs->fields('10_40_R'));
		$this->_10_41_R->setDbValue($rs->fields('10_41_R'));
		$this->_11_42_R->setDbValue($rs->fields('11_42_R'));
		$this->_11_43_R->setDbValue($rs->fields('11_43_R'));
		$this->_12_44_R->setDbValue($rs->fields('12_44_R'));
		$this->_12_45_R->setDbValue($rs->fields('12_45_R'));
		$this->_12_46_R->setDbValue($rs->fields('12_46_R'));
		$this->_12_47_R->setDbValue($rs->fields('12_47_R'));
		$this->_12_48_R->setDbValue($rs->fields('12_48_R'));
		$this->_12_49_R->setDbValue($rs->fields('12_49_R'));
		$this->_12_50_R->setDbValue($rs->fields('12_50_R'));
		$this->_1__R->setDbValue($rs->fields('1__R'));
		$this->_13_54_R->setDbValue($rs->fields('13_54_R'));
		$this->_13_54_1_R->setDbValue($rs->fields('13_54_1_R'));
		$this->_13_54_2_R->setDbValue($rs->fields('13_54_2_R'));
		$this->_13_55_R->setDbValue($rs->fields('13_55_R'));
		$this->_13_55_1_R->setDbValue($rs->fields('13_55_1_R'));
		$this->_13_55_2_R->setDbValue($rs->fields('13_55_2_R'));
		$this->_13_56_R->setDbValue($rs->fields('13_56_R'));
		$this->_13_56_1_R->setDbValue($rs->fields('13_56_1_R'));
		$this->_13_56_2_R->setDbValue($rs->fields('13_56_2_R'));
		$this->_12_53_R->setDbValue($rs->fields('12_53_R'));
		$this->_12_53_1_R->setDbValue($rs->fields('12_53_1_R'));
		$this->_12_53_2_R->setDbValue($rs->fields('12_53_2_R'));
		$this->_12_53_3_R->setDbValue($rs->fields('12_53_3_R'));
		$this->_12_53_4_R->setDbValue($rs->fields('12_53_4_R'));
		$this->_12_53_5_R->setDbValue($rs->fields('12_53_5_R'));
		$this->_12_53_6_R->setDbValue($rs->fields('12_53_6_R'));
		$this->_13_57_R->setDbValue($rs->fields('13_57_R'));
		$this->_13_57_1_R->setDbValue($rs->fields('13_57_1_R'));
		$this->_13_57_2_R->setDbValue($rs->fields('13_57_2_R'));
		$this->_13_58_R->setDbValue($rs->fields('13_58_R'));
		$this->_13_58_1_R->setDbValue($rs->fields('13_58_1_R'));
		$this->_13_58_2_R->setDbValue($rs->fields('13_58_2_R'));
		$this->_13_59_R->setDbValue($rs->fields('13_59_R'));
		$this->_13_59_1_R->setDbValue($rs->fields('13_59_1_R'));
		$this->_13_59_2_R->setDbValue($rs->fields('13_59_2_R'));
		$this->_13_60_R->setDbValue($rs->fields('13_60_R'));
		$this->_12_53_7_R->setDbValue($rs->fields('12_53_7_R'));
		$this->_12_53_8_R->setDbValue($rs->fields('12_53_8_R'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// id
		// fecha
		// hora
		// audio
		// st
		// fechaHoraIni
		// fechaHoraFin
		// telefono
		// agente
		// fechabo
		// agentebo
		// comentariosbo
		// IP
		// actual
		// completado
		// 2_1_R
		// 2_2_R
		// 2_3_R
		// 3_4_R
		// 4_5_R
		// 4_6_R
		// 4_7_R
		// 4_8_R
		// 5_9_R
		// 5_10_R
		// 5_11_R
		// 5_12_R
		// 5_13_R
		// 5_14_R
		// 5_51_R
		// 6_15_R
		// 6_16_R
		// 6_17_R
		// 6_18_R
		// 6_19_R
		// 6_20_R
		// 6_52_R
		// 7_21_R
		// 8_22_R
		// 8_23_R
		// 8_24_R
		// 8_25_R
		// 9_26_R
		// 9_27_R
		// 9_28_R
		// 9_29_R
		// 9_30_R
		// 9_31_R
		// 9_32_R
		// 9_33_R
		// 9_34_R
		// 9_35_R
		// 9_36_R
		// 9_37_R
		// 9_38_R
		// 9_39_R
		// 10_40_R
		// 10_41_R
		// 11_42_R
		// 11_43_R
		// 12_44_R
		// 12_45_R
		// 12_46_R
		// 12_47_R
		// 12_48_R
		// 12_49_R
		// 12_50_R
		// 1__R
		// 13_54_R
		// 13_54_1_R
		// 13_54_2_R
		// 13_55_R
		// 13_55_1_R
		// 13_55_2_R
		// 13_56_R
		// 13_56_1_R
		// 13_56_2_R
		// 12_53_R
		// 12_53_1_R
		// 12_53_2_R
		// 12_53_3_R
		// 12_53_4_R
		// 12_53_5_R
		// 12_53_6_R
		// 13_57_R
		// 13_57_1_R
		// 13_57_2_R
		// 13_58_R
		// 13_58_1_R
		// 13_58_2_R
		// 13_59_R
		// 13_59_1_R
		// 13_59_2_R
		// 13_60_R
		// 12_53_7_R
		// 12_53_8_R
		// id

		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// fecha
		$this->fecha->ViewValue = $this->fecha->CurrentValue;
		$this->fecha->ViewValue = FormatDateTime($this->fecha->ViewValue, 0);
		$this->fecha->ViewCustomAttributes = "";

		// hora
		$this->hora->ViewValue = $this->hora->CurrentValue;
		$this->hora->ViewValue = FormatDateTime($this->hora->ViewValue, 4);
		$this->hora->ViewCustomAttributes = "";

		// audio
		$this->audio->ViewValue = $this->audio->CurrentValue;
		$this->audio->ViewCustomAttributes = "";

		// st
		$this->st->ViewValue = $this->st->CurrentValue;
		$this->st->ViewCustomAttributes = "";

		// fechaHoraIni
		$this->fechaHoraIni->ViewValue = $this->fechaHoraIni->CurrentValue;
		$this->fechaHoraIni->ViewValue = FormatDateTime($this->fechaHoraIni->ViewValue, 0);
		$this->fechaHoraIni->ViewCustomAttributes = "";

		// fechaHoraFin
		$this->fechaHoraFin->ViewValue = $this->fechaHoraFin->CurrentValue;
		$this->fechaHoraFin->ViewValue = FormatDateTime($this->fechaHoraFin->ViewValue, 0);
		$this->fechaHoraFin->ViewCustomAttributes = "";

		// telefono
		$this->telefono->ViewValue = $this->telefono->CurrentValue;
		$this->telefono->ViewCustomAttributes = "";

		// agente
		$this->agente->ViewValue = $this->agente->CurrentValue;
		$this->agente->ViewValue = FormatNumber($this->agente->ViewValue, 0, -2, -2, -2);
		$this->agente->ViewCustomAttributes = "";

		// fechabo
		$this->fechabo->ViewValue = $this->fechabo->CurrentValue;
		$this->fechabo->ViewValue = FormatDateTime($this->fechabo->ViewValue, 0);
		$this->fechabo->ViewCustomAttributes = "";

		// agentebo
		$this->agentebo->ViewValue = $this->agentebo->CurrentValue;
		$this->agentebo->ViewValue = FormatNumber($this->agentebo->ViewValue, 0, -2, -2, -2);
		$this->agentebo->ViewCustomAttributes = "";

		// comentariosbo
		$this->comentariosbo->ViewValue = $this->comentariosbo->CurrentValue;
		$this->comentariosbo->ViewCustomAttributes = "";

		// IP
		$this->IP->ViewValue = $this->IP->CurrentValue;
		$this->IP->ViewCustomAttributes = "";

		// actual
		$this->actual->ViewValue = $this->actual->CurrentValue;
		$this->actual->ViewCustomAttributes = "";

		// completado
		$this->completado->ViewValue = $this->completado->CurrentValue;
		$this->completado->ViewCustomAttributes = "";

		// 2_1_R
		$this->_2_1_R->ViewValue = $this->_2_1_R->CurrentValue;
		$this->_2_1_R->ViewCustomAttributes = "";

		// 2_2_R
		$this->_2_2_R->ViewValue = $this->_2_2_R->CurrentValue;
		$this->_2_2_R->ViewCustomAttributes = "";

		// 2_3_R
		$this->_2_3_R->ViewValue = $this->_2_3_R->CurrentValue;
		$this->_2_3_R->ViewCustomAttributes = "";

		// 3_4_R
		$this->_3_4_R->ViewValue = $this->_3_4_R->CurrentValue;
		$this->_3_4_R->ViewCustomAttributes = "";

		// 4_5_R
		$this->_4_5_R->ViewValue = $this->_4_5_R->CurrentValue;
		$this->_4_5_R->ViewCustomAttributes = "";

		// 4_6_R
		$this->_4_6_R->ViewValue = $this->_4_6_R->CurrentValue;
		$this->_4_6_R->ViewCustomAttributes = "";

		// 4_7_R
		$this->_4_7_R->ViewValue = $this->_4_7_R->CurrentValue;
		$this->_4_7_R->ViewCustomAttributes = "";

		// 4_8_R
		$this->_4_8_R->ViewValue = $this->_4_8_R->CurrentValue;
		$this->_4_8_R->ViewCustomAttributes = "";

		// 5_9_R
		$this->_5_9_R->ViewValue = $this->_5_9_R->CurrentValue;
		$this->_5_9_R->ViewCustomAttributes = "";

		// 5_10_R
		$this->_5_10_R->ViewValue = $this->_5_10_R->CurrentValue;
		$this->_5_10_R->ViewCustomAttributes = "";

		// 5_11_R
		$this->_5_11_R->ViewValue = $this->_5_11_R->CurrentValue;
		$this->_5_11_R->ViewCustomAttributes = "";

		// 5_12_R
		$this->_5_12_R->ViewValue = $this->_5_12_R->CurrentValue;
		$this->_5_12_R->ViewCustomAttributes = "";

		// 5_13_R
		$this->_5_13_R->ViewValue = $this->_5_13_R->CurrentValue;
		$this->_5_13_R->ViewCustomAttributes = "";

		// 5_14_R
		$this->_5_14_R->ViewValue = $this->_5_14_R->CurrentValue;
		$this->_5_14_R->ViewCustomAttributes = "";

		// 5_51_R
		$this->_5_51_R->ViewValue = $this->_5_51_R->CurrentValue;
		$this->_5_51_R->ViewCustomAttributes = "";

		// 6_15_R
		$this->_6_15_R->ViewValue = $this->_6_15_R->CurrentValue;
		$this->_6_15_R->ViewCustomAttributes = "";

		// 6_16_R
		$this->_6_16_R->ViewValue = $this->_6_16_R->CurrentValue;
		$this->_6_16_R->ViewCustomAttributes = "";

		// 6_17_R
		$this->_6_17_R->ViewValue = $this->_6_17_R->CurrentValue;
		$this->_6_17_R->ViewCustomAttributes = "";

		// 6_18_R
		$this->_6_18_R->ViewValue = $this->_6_18_R->CurrentValue;
		$this->_6_18_R->ViewCustomAttributes = "";

		// 6_19_R
		$this->_6_19_R->ViewValue = $this->_6_19_R->CurrentValue;
		$this->_6_19_R->ViewCustomAttributes = "";

		// 6_20_R
		$this->_6_20_R->ViewValue = $this->_6_20_R->CurrentValue;
		$this->_6_20_R->ViewCustomAttributes = "";

		// 6_52_R
		$this->_6_52_R->ViewValue = $this->_6_52_R->CurrentValue;
		$this->_6_52_R->ViewCustomAttributes = "";

		// 7_21_R
		$this->_7_21_R->ViewValue = $this->_7_21_R->CurrentValue;
		$this->_7_21_R->ViewCustomAttributes = "";

		// 8_22_R
		$this->_8_22_R->ViewValue = $this->_8_22_R->CurrentValue;
		$this->_8_22_R->ViewCustomAttributes = "";

		// 8_23_R
		$this->_8_23_R->ViewValue = $this->_8_23_R->CurrentValue;
		$this->_8_23_R->ViewCustomAttributes = "";

		// 8_24_R
		$this->_8_24_R->ViewValue = $this->_8_24_R->CurrentValue;
		$this->_8_24_R->ViewCustomAttributes = "";

		// 8_25_R
		$this->_8_25_R->ViewValue = $this->_8_25_R->CurrentValue;
		$this->_8_25_R->ViewCustomAttributes = "";

		// 9_26_R
		$this->_9_26_R->ViewValue = $this->_9_26_R->CurrentValue;
		$this->_9_26_R->ViewCustomAttributes = "";

		// 9_27_R
		$this->_9_27_R->ViewValue = $this->_9_27_R->CurrentValue;
		$this->_9_27_R->ViewCustomAttributes = "";

		// 9_28_R
		$this->_9_28_R->ViewValue = $this->_9_28_R->CurrentValue;
		$this->_9_28_R->ViewCustomAttributes = "";

		// 9_29_R
		$this->_9_29_R->ViewValue = $this->_9_29_R->CurrentValue;
		$this->_9_29_R->ViewCustomAttributes = "";

		// 9_30_R
		$this->_9_30_R->ViewValue = $this->_9_30_R->CurrentValue;
		$this->_9_30_R->ViewCustomAttributes = "";

		// 9_31_R
		$this->_9_31_R->ViewValue = $this->_9_31_R->CurrentValue;
		$this->_9_31_R->ViewCustomAttributes = "";

		// 9_32_R
		$this->_9_32_R->ViewValue = $this->_9_32_R->CurrentValue;
		$this->_9_32_R->ViewCustomAttributes = "";

		// 9_33_R
		$this->_9_33_R->ViewValue = $this->_9_33_R->CurrentValue;
		$this->_9_33_R->ViewCustomAttributes = "";

		// 9_34_R
		$this->_9_34_R->ViewValue = $this->_9_34_R->CurrentValue;
		$this->_9_34_R->ViewCustomAttributes = "";

		// 9_35_R
		$this->_9_35_R->ViewValue = $this->_9_35_R->CurrentValue;
		$this->_9_35_R->ViewCustomAttributes = "";

		// 9_36_R
		$this->_9_36_R->ViewValue = $this->_9_36_R->CurrentValue;
		$this->_9_36_R->ViewCustomAttributes = "";

		// 9_37_R
		$this->_9_37_R->ViewValue = $this->_9_37_R->CurrentValue;
		$this->_9_37_R->ViewCustomAttributes = "";

		// 9_38_R
		$this->_9_38_R->ViewValue = $this->_9_38_R->CurrentValue;
		$this->_9_38_R->ViewCustomAttributes = "";

		// 9_39_R
		$this->_9_39_R->ViewValue = $this->_9_39_R->CurrentValue;
		$this->_9_39_R->ViewCustomAttributes = "";

		// 10_40_R
		$this->_10_40_R->ViewValue = $this->_10_40_R->CurrentValue;
		$this->_10_40_R->ViewCustomAttributes = "";

		// 10_41_R
		$this->_10_41_R->ViewValue = $this->_10_41_R->CurrentValue;
		$this->_10_41_R->ViewCustomAttributes = "";

		// 11_42_R
		$this->_11_42_R->ViewValue = $this->_11_42_R->CurrentValue;
		$this->_11_42_R->ViewCustomAttributes = "";

		// 11_43_R
		$this->_11_43_R->ViewValue = $this->_11_43_R->CurrentValue;
		$this->_11_43_R->ViewCustomAttributes = "";

		// 12_44_R
		$this->_12_44_R->ViewValue = $this->_12_44_R->CurrentValue;
		$this->_12_44_R->ViewCustomAttributes = "";

		// 12_45_R
		$this->_12_45_R->ViewValue = $this->_12_45_R->CurrentValue;
		$this->_12_45_R->ViewCustomAttributes = "";

		// 12_46_R
		$this->_12_46_R->ViewValue = $this->_12_46_R->CurrentValue;
		$this->_12_46_R->ViewCustomAttributes = "";

		// 12_47_R
		$this->_12_47_R->ViewValue = $this->_12_47_R->CurrentValue;
		$this->_12_47_R->ViewCustomAttributes = "";

		// 12_48_R
		$this->_12_48_R->ViewValue = $this->_12_48_R->CurrentValue;
		$this->_12_48_R->ViewCustomAttributes = "";

		// 12_49_R
		$this->_12_49_R->ViewValue = $this->_12_49_R->CurrentValue;
		$this->_12_49_R->ViewCustomAttributes = "";

		// 12_50_R
		$this->_12_50_R->ViewValue = $this->_12_50_R->CurrentValue;
		$this->_12_50_R->ViewCustomAttributes = "";

		// 1__R
		$this->_1__R->ViewValue = $this->_1__R->CurrentValue;
		$this->_1__R->ViewCustomAttributes = "";

		// 13_54_R
		$this->_13_54_R->ViewValue = $this->_13_54_R->CurrentValue;
		$this->_13_54_R->ViewCustomAttributes = "";

		// 13_54_1_R
		$this->_13_54_1_R->ViewValue = $this->_13_54_1_R->CurrentValue;
		$this->_13_54_1_R->ViewCustomAttributes = "";

		// 13_54_2_R
		$this->_13_54_2_R->ViewValue = $this->_13_54_2_R->CurrentValue;
		$this->_13_54_2_R->ViewCustomAttributes = "";

		// 13_55_R
		$this->_13_55_R->ViewValue = $this->_13_55_R->CurrentValue;
		$this->_13_55_R->ViewCustomAttributes = "";

		// 13_55_1_R
		$this->_13_55_1_R->ViewValue = $this->_13_55_1_R->CurrentValue;
		$this->_13_55_1_R->ViewCustomAttributes = "";

		// 13_55_2_R
		$this->_13_55_2_R->ViewValue = $this->_13_55_2_R->CurrentValue;
		$this->_13_55_2_R->ViewCustomAttributes = "";

		// 13_56_R
		$this->_13_56_R->ViewValue = $this->_13_56_R->CurrentValue;
		$this->_13_56_R->ViewCustomAttributes = "";

		// 13_56_1_R
		$this->_13_56_1_R->ViewValue = $this->_13_56_1_R->CurrentValue;
		$this->_13_56_1_R->ViewCustomAttributes = "";

		// 13_56_2_R
		$this->_13_56_2_R->ViewValue = $this->_13_56_2_R->CurrentValue;
		$this->_13_56_2_R->ViewCustomAttributes = "";

		// 12_53_R
		$this->_12_53_R->ViewValue = $this->_12_53_R->CurrentValue;
		$this->_12_53_R->ViewCustomAttributes = "";

		// 12_53_1_R
		$this->_12_53_1_R->ViewValue = $this->_12_53_1_R->CurrentValue;
		$this->_12_53_1_R->ViewCustomAttributes = "";

		// 12_53_2_R
		$this->_12_53_2_R->ViewValue = $this->_12_53_2_R->CurrentValue;
		$this->_12_53_2_R->ViewCustomAttributes = "";

		// 12_53_3_R
		$this->_12_53_3_R->ViewValue = $this->_12_53_3_R->CurrentValue;
		$this->_12_53_3_R->ViewCustomAttributes = "";

		// 12_53_4_R
		$this->_12_53_4_R->ViewValue = $this->_12_53_4_R->CurrentValue;
		$this->_12_53_4_R->ViewCustomAttributes = "";

		// 12_53_5_R
		$this->_12_53_5_R->ViewValue = $this->_12_53_5_R->CurrentValue;
		$this->_12_53_5_R->ViewCustomAttributes = "";

		// 12_53_6_R
		$this->_12_53_6_R->ViewValue = $this->_12_53_6_R->CurrentValue;
		$this->_12_53_6_R->ViewCustomAttributes = "";

		// 13_57_R
		$this->_13_57_R->ViewValue = $this->_13_57_R->CurrentValue;
		$this->_13_57_R->ViewCustomAttributes = "";

		// 13_57_1_R
		$this->_13_57_1_R->ViewValue = $this->_13_57_1_R->CurrentValue;
		$this->_13_57_1_R->ViewCustomAttributes = "";

		// 13_57_2_R
		$this->_13_57_2_R->ViewValue = $this->_13_57_2_R->CurrentValue;
		$this->_13_57_2_R->ViewCustomAttributes = "";

		// 13_58_R
		$this->_13_58_R->ViewValue = $this->_13_58_R->CurrentValue;
		$this->_13_58_R->ViewCustomAttributes = "";

		// 13_58_1_R
		$this->_13_58_1_R->ViewValue = $this->_13_58_1_R->CurrentValue;
		$this->_13_58_1_R->ViewCustomAttributes = "";

		// 13_58_2_R
		$this->_13_58_2_R->ViewValue = $this->_13_58_2_R->CurrentValue;
		$this->_13_58_2_R->ViewCustomAttributes = "";

		// 13_59_R
		$this->_13_59_R->ViewValue = $this->_13_59_R->CurrentValue;
		$this->_13_59_R->ViewCustomAttributes = "";

		// 13_59_1_R
		$this->_13_59_1_R->ViewValue = $this->_13_59_1_R->CurrentValue;
		$this->_13_59_1_R->ViewCustomAttributes = "";

		// 13_59_2_R
		$this->_13_59_2_R->ViewValue = $this->_13_59_2_R->CurrentValue;
		$this->_13_59_2_R->ViewCustomAttributes = "";

		// 13_60_R
		$this->_13_60_R->ViewValue = $this->_13_60_R->CurrentValue;
		$this->_13_60_R->ViewCustomAttributes = "";

		// 12_53_7_R
		$this->_12_53_7_R->ViewValue = $this->_12_53_7_R->CurrentValue;
		$this->_12_53_7_R->ViewCustomAttributes = "";

		// 12_53_8_R
		$this->_12_53_8_R->ViewValue = $this->_12_53_8_R->CurrentValue;
		$this->_12_53_8_R->ViewCustomAttributes = "";

		// id
		$this->id->LinkCustomAttributes = "";
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

		// fecha
		$this->fecha->LinkCustomAttributes = "";
		$this->fecha->HrefValue = "";
		$this->fecha->TooltipValue = "";

		// hora
		$this->hora->LinkCustomAttributes = "";
		$this->hora->HrefValue = "";
		$this->hora->TooltipValue = "";

		// audio
		$this->audio->LinkCustomAttributes = "";
		$this->audio->HrefValue = "";
		$this->audio->TooltipValue = "";

		// st
		$this->st->LinkCustomAttributes = "";
		$this->st->HrefValue = "";
		$this->st->TooltipValue = "";

		// fechaHoraIni
		$this->fechaHoraIni->LinkCustomAttributes = "";
		$this->fechaHoraIni->HrefValue = "";
		$this->fechaHoraIni->TooltipValue = "";

		// fechaHoraFin
		$this->fechaHoraFin->LinkCustomAttributes = "";
		$this->fechaHoraFin->HrefValue = "";
		$this->fechaHoraFin->TooltipValue = "";

		// telefono
		$this->telefono->LinkCustomAttributes = "";
		$this->telefono->HrefValue = "";
		$this->telefono->TooltipValue = "";

		// agente
		$this->agente->LinkCustomAttributes = "";
		$this->agente->HrefValue = "";
		$this->agente->TooltipValue = "";

		// fechabo
		$this->fechabo->LinkCustomAttributes = "";
		$this->fechabo->HrefValue = "";
		$this->fechabo->TooltipValue = "";

		// agentebo
		$this->agentebo->LinkCustomAttributes = "";
		$this->agentebo->HrefValue = "";
		$this->agentebo->TooltipValue = "";

		// comentariosbo
		$this->comentariosbo->LinkCustomAttributes = "";
		$this->comentariosbo->HrefValue = "";
		$this->comentariosbo->TooltipValue = "";

		// IP
		$this->IP->LinkCustomAttributes = "";
		$this->IP->HrefValue = "";
		$this->IP->TooltipValue = "";

		// actual
		$this->actual->LinkCustomAttributes = "";
		$this->actual->HrefValue = "";
		$this->actual->TooltipValue = "";

		// completado
		$this->completado->LinkCustomAttributes = "";
		$this->completado->HrefValue = "";
		$this->completado->TooltipValue = "";

		// 2_1_R
		$this->_2_1_R->LinkCustomAttributes = "";
		$this->_2_1_R->HrefValue = "";
		$this->_2_1_R->TooltipValue = "";

		// 2_2_R
		$this->_2_2_R->LinkCustomAttributes = "";
		$this->_2_2_R->HrefValue = "";
		$this->_2_2_R->TooltipValue = "";

		// 2_3_R
		$this->_2_3_R->LinkCustomAttributes = "";
		$this->_2_3_R->HrefValue = "";
		$this->_2_3_R->TooltipValue = "";

		// 3_4_R
		$this->_3_4_R->LinkCustomAttributes = "";
		$this->_3_4_R->HrefValue = "";
		$this->_3_4_R->TooltipValue = "";

		// 4_5_R
		$this->_4_5_R->LinkCustomAttributes = "";
		$this->_4_5_R->HrefValue = "";
		$this->_4_5_R->TooltipValue = "";

		// 4_6_R
		$this->_4_6_R->LinkCustomAttributes = "";
		$this->_4_6_R->HrefValue = "";
		$this->_4_6_R->TooltipValue = "";

		// 4_7_R
		$this->_4_7_R->LinkCustomAttributes = "";
		$this->_4_7_R->HrefValue = "";
		$this->_4_7_R->TooltipValue = "";

		// 4_8_R
		$this->_4_8_R->LinkCustomAttributes = "";
		$this->_4_8_R->HrefValue = "";
		$this->_4_8_R->TooltipValue = "";

		// 5_9_R
		$this->_5_9_R->LinkCustomAttributes = "";
		$this->_5_9_R->HrefValue = "";
		$this->_5_9_R->TooltipValue = "";

		// 5_10_R
		$this->_5_10_R->LinkCustomAttributes = "";
		$this->_5_10_R->HrefValue = "";
		$this->_5_10_R->TooltipValue = "";

		// 5_11_R
		$this->_5_11_R->LinkCustomAttributes = "";
		$this->_5_11_R->HrefValue = "";
		$this->_5_11_R->TooltipValue = "";

		// 5_12_R
		$this->_5_12_R->LinkCustomAttributes = "";
		$this->_5_12_R->HrefValue = "";
		$this->_5_12_R->TooltipValue = "";

		// 5_13_R
		$this->_5_13_R->LinkCustomAttributes = "";
		$this->_5_13_R->HrefValue = "";
		$this->_5_13_R->TooltipValue = "";

		// 5_14_R
		$this->_5_14_R->LinkCustomAttributes = "";
		$this->_5_14_R->HrefValue = "";
		$this->_5_14_R->TooltipValue = "";

		// 5_51_R
		$this->_5_51_R->LinkCustomAttributes = "";
		$this->_5_51_R->HrefValue = "";
		$this->_5_51_R->TooltipValue = "";

		// 6_15_R
		$this->_6_15_R->LinkCustomAttributes = "";
		$this->_6_15_R->HrefValue = "";
		$this->_6_15_R->TooltipValue = "";

		// 6_16_R
		$this->_6_16_R->LinkCustomAttributes = "";
		$this->_6_16_R->HrefValue = "";
		$this->_6_16_R->TooltipValue = "";

		// 6_17_R
		$this->_6_17_R->LinkCustomAttributes = "";
		$this->_6_17_R->HrefValue = "";
		$this->_6_17_R->TooltipValue = "";

		// 6_18_R
		$this->_6_18_R->LinkCustomAttributes = "";
		$this->_6_18_R->HrefValue = "";
		$this->_6_18_R->TooltipValue = "";

		// 6_19_R
		$this->_6_19_R->LinkCustomAttributes = "";
		$this->_6_19_R->HrefValue = "";
		$this->_6_19_R->TooltipValue = "";

		// 6_20_R
		$this->_6_20_R->LinkCustomAttributes = "";
		$this->_6_20_R->HrefValue = "";
		$this->_6_20_R->TooltipValue = "";

		// 6_52_R
		$this->_6_52_R->LinkCustomAttributes = "";
		$this->_6_52_R->HrefValue = "";
		$this->_6_52_R->TooltipValue = "";

		// 7_21_R
		$this->_7_21_R->LinkCustomAttributes = "";
		$this->_7_21_R->HrefValue = "";
		$this->_7_21_R->TooltipValue = "";

		// 8_22_R
		$this->_8_22_R->LinkCustomAttributes = "";
		$this->_8_22_R->HrefValue = "";
		$this->_8_22_R->TooltipValue = "";

		// 8_23_R
		$this->_8_23_R->LinkCustomAttributes = "";
		$this->_8_23_R->HrefValue = "";
		$this->_8_23_R->TooltipValue = "";

		// 8_24_R
		$this->_8_24_R->LinkCustomAttributes = "";
		$this->_8_24_R->HrefValue = "";
		$this->_8_24_R->TooltipValue = "";

		// 8_25_R
		$this->_8_25_R->LinkCustomAttributes = "";
		$this->_8_25_R->HrefValue = "";
		$this->_8_25_R->TooltipValue = "";

		// 9_26_R
		$this->_9_26_R->LinkCustomAttributes = "";
		$this->_9_26_R->HrefValue = "";
		$this->_9_26_R->TooltipValue = "";

		// 9_27_R
		$this->_9_27_R->LinkCustomAttributes = "";
		$this->_9_27_R->HrefValue = "";
		$this->_9_27_R->TooltipValue = "";

		// 9_28_R
		$this->_9_28_R->LinkCustomAttributes = "";
		$this->_9_28_R->HrefValue = "";
		$this->_9_28_R->TooltipValue = "";

		// 9_29_R
		$this->_9_29_R->LinkCustomAttributes = "";
		$this->_9_29_R->HrefValue = "";
		$this->_9_29_R->TooltipValue = "";

		// 9_30_R
		$this->_9_30_R->LinkCustomAttributes = "";
		$this->_9_30_R->HrefValue = "";
		$this->_9_30_R->TooltipValue = "";

		// 9_31_R
		$this->_9_31_R->LinkCustomAttributes = "";
		$this->_9_31_R->HrefValue = "";
		$this->_9_31_R->TooltipValue = "";

		// 9_32_R
		$this->_9_32_R->LinkCustomAttributes = "";
		$this->_9_32_R->HrefValue = "";
		$this->_9_32_R->TooltipValue = "";

		// 9_33_R
		$this->_9_33_R->LinkCustomAttributes = "";
		$this->_9_33_R->HrefValue = "";
		$this->_9_33_R->TooltipValue = "";

		// 9_34_R
		$this->_9_34_R->LinkCustomAttributes = "";
		$this->_9_34_R->HrefValue = "";
		$this->_9_34_R->TooltipValue = "";

		// 9_35_R
		$this->_9_35_R->LinkCustomAttributes = "";
		$this->_9_35_R->HrefValue = "";
		$this->_9_35_R->TooltipValue = "";

		// 9_36_R
		$this->_9_36_R->LinkCustomAttributes = "";
		$this->_9_36_R->HrefValue = "";
		$this->_9_36_R->TooltipValue = "";

		// 9_37_R
		$this->_9_37_R->LinkCustomAttributes = "";
		$this->_9_37_R->HrefValue = "";
		$this->_9_37_R->TooltipValue = "";

		// 9_38_R
		$this->_9_38_R->LinkCustomAttributes = "";
		$this->_9_38_R->HrefValue = "";
		$this->_9_38_R->TooltipValue = "";

		// 9_39_R
		$this->_9_39_R->LinkCustomAttributes = "";
		$this->_9_39_R->HrefValue = "";
		$this->_9_39_R->TooltipValue = "";

		// 10_40_R
		$this->_10_40_R->LinkCustomAttributes = "";
		$this->_10_40_R->HrefValue = "";
		$this->_10_40_R->TooltipValue = "";

		// 10_41_R
		$this->_10_41_R->LinkCustomAttributes = "";
		$this->_10_41_R->HrefValue = "";
		$this->_10_41_R->TooltipValue = "";

		// 11_42_R
		$this->_11_42_R->LinkCustomAttributes = "";
		$this->_11_42_R->HrefValue = "";
		$this->_11_42_R->TooltipValue = "";

		// 11_43_R
		$this->_11_43_R->LinkCustomAttributes = "";
		$this->_11_43_R->HrefValue = "";
		$this->_11_43_R->TooltipValue = "";

		// 12_44_R
		$this->_12_44_R->LinkCustomAttributes = "";
		$this->_12_44_R->HrefValue = "";
		$this->_12_44_R->TooltipValue = "";

		// 12_45_R
		$this->_12_45_R->LinkCustomAttributes = "";
		$this->_12_45_R->HrefValue = "";
		$this->_12_45_R->TooltipValue = "";

		// 12_46_R
		$this->_12_46_R->LinkCustomAttributes = "";
		$this->_12_46_R->HrefValue = "";
		$this->_12_46_R->TooltipValue = "";

		// 12_47_R
		$this->_12_47_R->LinkCustomAttributes = "";
		$this->_12_47_R->HrefValue = "";
		$this->_12_47_R->TooltipValue = "";

		// 12_48_R
		$this->_12_48_R->LinkCustomAttributes = "";
		$this->_12_48_R->HrefValue = "";
		$this->_12_48_R->TooltipValue = "";

		// 12_49_R
		$this->_12_49_R->LinkCustomAttributes = "";
		$this->_12_49_R->HrefValue = "";
		$this->_12_49_R->TooltipValue = "";

		// 12_50_R
		$this->_12_50_R->LinkCustomAttributes = "";
		$this->_12_50_R->HrefValue = "";
		$this->_12_50_R->TooltipValue = "";

		// 1__R
		$this->_1__R->LinkCustomAttributes = "";
		$this->_1__R->HrefValue = "";
		$this->_1__R->TooltipValue = "";

		// 13_54_R
		$this->_13_54_R->LinkCustomAttributes = "";
		$this->_13_54_R->HrefValue = "";
		$this->_13_54_R->TooltipValue = "";

		// 13_54_1_R
		$this->_13_54_1_R->LinkCustomAttributes = "";
		$this->_13_54_1_R->HrefValue = "";
		$this->_13_54_1_R->TooltipValue = "";

		// 13_54_2_R
		$this->_13_54_2_R->LinkCustomAttributes = "";
		$this->_13_54_2_R->HrefValue = "";
		$this->_13_54_2_R->TooltipValue = "";

		// 13_55_R
		$this->_13_55_R->LinkCustomAttributes = "";
		$this->_13_55_R->HrefValue = "";
		$this->_13_55_R->TooltipValue = "";

		// 13_55_1_R
		$this->_13_55_1_R->LinkCustomAttributes = "";
		$this->_13_55_1_R->HrefValue = "";
		$this->_13_55_1_R->TooltipValue = "";

		// 13_55_2_R
		$this->_13_55_2_R->LinkCustomAttributes = "";
		$this->_13_55_2_R->HrefValue = "";
		$this->_13_55_2_R->TooltipValue = "";

		// 13_56_R
		$this->_13_56_R->LinkCustomAttributes = "";
		$this->_13_56_R->HrefValue = "";
		$this->_13_56_R->TooltipValue = "";

		// 13_56_1_R
		$this->_13_56_1_R->LinkCustomAttributes = "";
		$this->_13_56_1_R->HrefValue = "";
		$this->_13_56_1_R->TooltipValue = "";

		// 13_56_2_R
		$this->_13_56_2_R->LinkCustomAttributes = "";
		$this->_13_56_2_R->HrefValue = "";
		$this->_13_56_2_R->TooltipValue = "";

		// 12_53_R
		$this->_12_53_R->LinkCustomAttributes = "";
		$this->_12_53_R->HrefValue = "";
		$this->_12_53_R->TooltipValue = "";

		// 12_53_1_R
		$this->_12_53_1_R->LinkCustomAttributes = "";
		$this->_12_53_1_R->HrefValue = "";
		$this->_12_53_1_R->TooltipValue = "";

		// 12_53_2_R
		$this->_12_53_2_R->LinkCustomAttributes = "";
		$this->_12_53_2_R->HrefValue = "";
		$this->_12_53_2_R->TooltipValue = "";

		// 12_53_3_R
		$this->_12_53_3_R->LinkCustomAttributes = "";
		$this->_12_53_3_R->HrefValue = "";
		$this->_12_53_3_R->TooltipValue = "";

		// 12_53_4_R
		$this->_12_53_4_R->LinkCustomAttributes = "";
		$this->_12_53_4_R->HrefValue = "";
		$this->_12_53_4_R->TooltipValue = "";

		// 12_53_5_R
		$this->_12_53_5_R->LinkCustomAttributes = "";
		$this->_12_53_5_R->HrefValue = "";
		$this->_12_53_5_R->TooltipValue = "";

		// 12_53_6_R
		$this->_12_53_6_R->LinkCustomAttributes = "";
		$this->_12_53_6_R->HrefValue = "";
		$this->_12_53_6_R->TooltipValue = "";

		// 13_57_R
		$this->_13_57_R->LinkCustomAttributes = "";
		$this->_13_57_R->HrefValue = "";
		$this->_13_57_R->TooltipValue = "";

		// 13_57_1_R
		$this->_13_57_1_R->LinkCustomAttributes = "";
		$this->_13_57_1_R->HrefValue = "";
		$this->_13_57_1_R->TooltipValue = "";

		// 13_57_2_R
		$this->_13_57_2_R->LinkCustomAttributes = "";
		$this->_13_57_2_R->HrefValue = "";
		$this->_13_57_2_R->TooltipValue = "";

		// 13_58_R
		$this->_13_58_R->LinkCustomAttributes = "";
		$this->_13_58_R->HrefValue = "";
		$this->_13_58_R->TooltipValue = "";

		// 13_58_1_R
		$this->_13_58_1_R->LinkCustomAttributes = "";
		$this->_13_58_1_R->HrefValue = "";
		$this->_13_58_1_R->TooltipValue = "";

		// 13_58_2_R
		$this->_13_58_2_R->LinkCustomAttributes = "";
		$this->_13_58_2_R->HrefValue = "";
		$this->_13_58_2_R->TooltipValue = "";

		// 13_59_R
		$this->_13_59_R->LinkCustomAttributes = "";
		$this->_13_59_R->HrefValue = "";
		$this->_13_59_R->TooltipValue = "";

		// 13_59_1_R
		$this->_13_59_1_R->LinkCustomAttributes = "";
		$this->_13_59_1_R->HrefValue = "";
		$this->_13_59_1_R->TooltipValue = "";

		// 13_59_2_R
		$this->_13_59_2_R->LinkCustomAttributes = "";
		$this->_13_59_2_R->HrefValue = "";
		$this->_13_59_2_R->TooltipValue = "";

		// 13_60_R
		$this->_13_60_R->LinkCustomAttributes = "";
		$this->_13_60_R->HrefValue = "";
		$this->_13_60_R->TooltipValue = "";

		// 12_53_7_R
		$this->_12_53_7_R->LinkCustomAttributes = "";
		$this->_12_53_7_R->HrefValue = "";
		$this->_12_53_7_R->TooltipValue = "";

		// 12_53_8_R
		$this->_12_53_8_R->LinkCustomAttributes = "";
		$this->_12_53_8_R->HrefValue = "";
		$this->_12_53_8_R->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();

		// Save data for Custom Template
		$this->Rows[] = $this->customTemplateFieldValues();
	}

	// Render edit row values
	public function renderEditRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// id
		$this->id->EditAttrs["class"] = "form-control";
		$this->id->EditCustomAttributes = "";
		$this->id->EditValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// fecha
		$this->fecha->EditAttrs["class"] = "form-control";
		$this->fecha->EditCustomAttributes = "";
		$this->fecha->EditValue = FormatDateTime($this->fecha->CurrentValue, 8);
		$this->fecha->PlaceHolder = RemoveHtml($this->fecha->caption());

		// hora
		$this->hora->EditAttrs["class"] = "form-control";
		$this->hora->EditCustomAttributes = "";
		$this->hora->EditValue = $this->hora->CurrentValue;
		$this->hora->PlaceHolder = RemoveHtml($this->hora->caption());

		// audio
		$this->audio->EditAttrs["class"] = "form-control";
		$this->audio->EditCustomAttributes = "";
		if (!$this->audio->Raw)
			$this->audio->CurrentValue = HtmlDecode($this->audio->CurrentValue);
		$this->audio->EditValue = $this->audio->CurrentValue;
		$this->audio->PlaceHolder = RemoveHtml($this->audio->caption());

		// st
		$this->st->EditAttrs["class"] = "form-control";
		$this->st->EditCustomAttributes = "";
		if (!$this->st->Raw)
			$this->st->CurrentValue = HtmlDecode($this->st->CurrentValue);
		$this->st->EditValue = $this->st->CurrentValue;
		$this->st->PlaceHolder = RemoveHtml($this->st->caption());

		// fechaHoraIni
		$this->fechaHoraIni->EditAttrs["class"] = "form-control";
		$this->fechaHoraIni->EditCustomAttributes = "";
		$this->fechaHoraIni->EditValue = FormatDateTime($this->fechaHoraIni->CurrentValue, 8);
		$this->fechaHoraIni->PlaceHolder = RemoveHtml($this->fechaHoraIni->caption());

		// fechaHoraFin
		$this->fechaHoraFin->EditAttrs["class"] = "form-control";
		$this->fechaHoraFin->EditCustomAttributes = "";
		$this->fechaHoraFin->EditValue = FormatDateTime($this->fechaHoraFin->CurrentValue, 8);
		$this->fechaHoraFin->PlaceHolder = RemoveHtml($this->fechaHoraFin->caption());

		// telefono
		$this->telefono->EditAttrs["class"] = "form-control";
		$this->telefono->EditCustomAttributes = "";
		if (!$this->telefono->Raw)
			$this->telefono->CurrentValue = HtmlDecode($this->telefono->CurrentValue);
		$this->telefono->EditValue = $this->telefono->CurrentValue;
		$this->telefono->PlaceHolder = RemoveHtml($this->telefono->caption());

		// agente
		$this->agente->EditAttrs["class"] = "form-control";
		$this->agente->EditCustomAttributes = "";
		$this->agente->EditValue = $this->agente->CurrentValue;
		$this->agente->PlaceHolder = RemoveHtml($this->agente->caption());

		// fechabo
		$this->fechabo->EditAttrs["class"] = "form-control";
		$this->fechabo->EditCustomAttributes = "";
		$this->fechabo->EditValue = FormatDateTime($this->fechabo->CurrentValue, 8);
		$this->fechabo->PlaceHolder = RemoveHtml($this->fechabo->caption());

		// agentebo
		$this->agentebo->EditAttrs["class"] = "form-control";
		$this->agentebo->EditCustomAttributes = "";
		$this->agentebo->EditValue = $this->agentebo->CurrentValue;
		$this->agentebo->PlaceHolder = RemoveHtml($this->agentebo->caption());

		// comentariosbo
		$this->comentariosbo->EditAttrs["class"] = "form-control";
		$this->comentariosbo->EditCustomAttributes = "";
		$this->comentariosbo->EditValue = $this->comentariosbo->CurrentValue;
		$this->comentariosbo->PlaceHolder = RemoveHtml($this->comentariosbo->caption());

		// IP
		$this->IP->EditAttrs["class"] = "form-control";
		$this->IP->EditCustomAttributes = "";
		if (!$this->IP->Raw)
			$this->IP->CurrentValue = HtmlDecode($this->IP->CurrentValue);
		$this->IP->EditValue = $this->IP->CurrentValue;
		$this->IP->PlaceHolder = RemoveHtml($this->IP->caption());

		// actual
		$this->actual->EditAttrs["class"] = "form-control";
		$this->actual->EditCustomAttributes = "";
		if (!$this->actual->Raw)
			$this->actual->CurrentValue = HtmlDecode($this->actual->CurrentValue);
		$this->actual->EditValue = $this->actual->CurrentValue;
		$this->actual->PlaceHolder = RemoveHtml($this->actual->caption());

		// completado
		$this->completado->EditAttrs["class"] = "form-control";
		$this->completado->EditCustomAttributes = "";
		if (!$this->completado->Raw)
			$this->completado->CurrentValue = HtmlDecode($this->completado->CurrentValue);
		$this->completado->EditValue = $this->completado->CurrentValue;
		$this->completado->PlaceHolder = RemoveHtml($this->completado->caption());

		// 2_1_R
		$this->_2_1_R->EditAttrs["class"] = "form-control";
		$this->_2_1_R->EditCustomAttributes = "";
		$this->_2_1_R->EditValue = $this->_2_1_R->CurrentValue;
		$this->_2_1_R->PlaceHolder = RemoveHtml($this->_2_1_R->caption());

		// 2_2_R
		$this->_2_2_R->EditAttrs["class"] = "form-control";
		$this->_2_2_R->EditCustomAttributes = "";
		$this->_2_2_R->EditValue = $this->_2_2_R->CurrentValue;
		$this->_2_2_R->PlaceHolder = RemoveHtml($this->_2_2_R->caption());

		// 2_3_R
		$this->_2_3_R->EditAttrs["class"] = "form-control";
		$this->_2_3_R->EditCustomAttributes = "";
		$this->_2_3_R->EditValue = $this->_2_3_R->CurrentValue;
		$this->_2_3_R->PlaceHolder = RemoveHtml($this->_2_3_R->caption());

		// 3_4_R
		$this->_3_4_R->EditAttrs["class"] = "form-control";
		$this->_3_4_R->EditCustomAttributes = "";
		$this->_3_4_R->EditValue = $this->_3_4_R->CurrentValue;
		$this->_3_4_R->PlaceHolder = RemoveHtml($this->_3_4_R->caption());

		// 4_5_R
		$this->_4_5_R->EditAttrs["class"] = "form-control";
		$this->_4_5_R->EditCustomAttributes = "";
		$this->_4_5_R->EditValue = $this->_4_5_R->CurrentValue;
		$this->_4_5_R->PlaceHolder = RemoveHtml($this->_4_5_R->caption());

		// 4_6_R
		$this->_4_6_R->EditAttrs["class"] = "form-control";
		$this->_4_6_R->EditCustomAttributes = "";
		$this->_4_6_R->EditValue = $this->_4_6_R->CurrentValue;
		$this->_4_6_R->PlaceHolder = RemoveHtml($this->_4_6_R->caption());

		// 4_7_R
		$this->_4_7_R->EditAttrs["class"] = "form-control";
		$this->_4_7_R->EditCustomAttributes = "";
		$this->_4_7_R->EditValue = $this->_4_7_R->CurrentValue;
		$this->_4_7_R->PlaceHolder = RemoveHtml($this->_4_7_R->caption());

		// 4_8_R
		$this->_4_8_R->EditAttrs["class"] = "form-control";
		$this->_4_8_R->EditCustomAttributes = "";
		$this->_4_8_R->EditValue = $this->_4_8_R->CurrentValue;
		$this->_4_8_R->PlaceHolder = RemoveHtml($this->_4_8_R->caption());

		// 5_9_R
		$this->_5_9_R->EditAttrs["class"] = "form-control";
		$this->_5_9_R->EditCustomAttributes = "";
		$this->_5_9_R->EditValue = $this->_5_9_R->CurrentValue;
		$this->_5_9_R->PlaceHolder = RemoveHtml($this->_5_9_R->caption());

		// 5_10_R
		$this->_5_10_R->EditAttrs["class"] = "form-control";
		$this->_5_10_R->EditCustomAttributes = "";
		$this->_5_10_R->EditValue = $this->_5_10_R->CurrentValue;
		$this->_5_10_R->PlaceHolder = RemoveHtml($this->_5_10_R->caption());

		// 5_11_R
		$this->_5_11_R->EditAttrs["class"] = "form-control";
		$this->_5_11_R->EditCustomAttributes = "";
		$this->_5_11_R->EditValue = $this->_5_11_R->CurrentValue;
		$this->_5_11_R->PlaceHolder = RemoveHtml($this->_5_11_R->caption());

		// 5_12_R
		$this->_5_12_R->EditAttrs["class"] = "form-control";
		$this->_5_12_R->EditCustomAttributes = "";
		$this->_5_12_R->EditValue = $this->_5_12_R->CurrentValue;
		$this->_5_12_R->PlaceHolder = RemoveHtml($this->_5_12_R->caption());

		// 5_13_R
		$this->_5_13_R->EditAttrs["class"] = "form-control";
		$this->_5_13_R->EditCustomAttributes = "";
		$this->_5_13_R->EditValue = $this->_5_13_R->CurrentValue;
		$this->_5_13_R->PlaceHolder = RemoveHtml($this->_5_13_R->caption());

		// 5_14_R
		$this->_5_14_R->EditAttrs["class"] = "form-control";
		$this->_5_14_R->EditCustomAttributes = "";
		$this->_5_14_R->EditValue = $this->_5_14_R->CurrentValue;
		$this->_5_14_R->PlaceHolder = RemoveHtml($this->_5_14_R->caption());

		// 5_51_R
		$this->_5_51_R->EditAttrs["class"] = "form-control";
		$this->_5_51_R->EditCustomAttributes = "";
		$this->_5_51_R->EditValue = $this->_5_51_R->CurrentValue;
		$this->_5_51_R->PlaceHolder = RemoveHtml($this->_5_51_R->caption());

		// 6_15_R
		$this->_6_15_R->EditAttrs["class"] = "form-control";
		$this->_6_15_R->EditCustomAttributes = "";
		$this->_6_15_R->EditValue = $this->_6_15_R->CurrentValue;
		$this->_6_15_R->PlaceHolder = RemoveHtml($this->_6_15_R->caption());

		// 6_16_R
		$this->_6_16_R->EditAttrs["class"] = "form-control";
		$this->_6_16_R->EditCustomAttributes = "";
		$this->_6_16_R->EditValue = $this->_6_16_R->CurrentValue;
		$this->_6_16_R->PlaceHolder = RemoveHtml($this->_6_16_R->caption());

		// 6_17_R
		$this->_6_17_R->EditAttrs["class"] = "form-control";
		$this->_6_17_R->EditCustomAttributes = "";
		$this->_6_17_R->EditValue = $this->_6_17_R->CurrentValue;
		$this->_6_17_R->PlaceHolder = RemoveHtml($this->_6_17_R->caption());

		// 6_18_R
		$this->_6_18_R->EditAttrs["class"] = "form-control";
		$this->_6_18_R->EditCustomAttributes = "";
		$this->_6_18_R->EditValue = $this->_6_18_R->CurrentValue;
		$this->_6_18_R->PlaceHolder = RemoveHtml($this->_6_18_R->caption());

		// 6_19_R
		$this->_6_19_R->EditAttrs["class"] = "form-control";
		$this->_6_19_R->EditCustomAttributes = "";
		$this->_6_19_R->EditValue = $this->_6_19_R->CurrentValue;
		$this->_6_19_R->PlaceHolder = RemoveHtml($this->_6_19_R->caption());

		// 6_20_R
		$this->_6_20_R->EditAttrs["class"] = "form-control";
		$this->_6_20_R->EditCustomAttributes = "";
		$this->_6_20_R->EditValue = $this->_6_20_R->CurrentValue;
		$this->_6_20_R->PlaceHolder = RemoveHtml($this->_6_20_R->caption());

		// 6_52_R
		$this->_6_52_R->EditAttrs["class"] = "form-control";
		$this->_6_52_R->EditCustomAttributes = "";
		$this->_6_52_R->EditValue = $this->_6_52_R->CurrentValue;
		$this->_6_52_R->PlaceHolder = RemoveHtml($this->_6_52_R->caption());

		// 7_21_R
		$this->_7_21_R->EditAttrs["class"] = "form-control";
		$this->_7_21_R->EditCustomAttributes = "";
		$this->_7_21_R->EditValue = $this->_7_21_R->CurrentValue;
		$this->_7_21_R->PlaceHolder = RemoveHtml($this->_7_21_R->caption());

		// 8_22_R
		$this->_8_22_R->EditAttrs["class"] = "form-control";
		$this->_8_22_R->EditCustomAttributes = "";
		$this->_8_22_R->EditValue = $this->_8_22_R->CurrentValue;
		$this->_8_22_R->PlaceHolder = RemoveHtml($this->_8_22_R->caption());

		// 8_23_R
		$this->_8_23_R->EditAttrs["class"] = "form-control";
		$this->_8_23_R->EditCustomAttributes = "";
		$this->_8_23_R->EditValue = $this->_8_23_R->CurrentValue;
		$this->_8_23_R->PlaceHolder = RemoveHtml($this->_8_23_R->caption());

		// 8_24_R
		$this->_8_24_R->EditAttrs["class"] = "form-control";
		$this->_8_24_R->EditCustomAttributes = "";
		$this->_8_24_R->EditValue = $this->_8_24_R->CurrentValue;
		$this->_8_24_R->PlaceHolder = RemoveHtml($this->_8_24_R->caption());

		// 8_25_R
		$this->_8_25_R->EditAttrs["class"] = "form-control";
		$this->_8_25_R->EditCustomAttributes = "";
		$this->_8_25_R->EditValue = $this->_8_25_R->CurrentValue;
		$this->_8_25_R->PlaceHolder = RemoveHtml($this->_8_25_R->caption());

		// 9_26_R
		$this->_9_26_R->EditAttrs["class"] = "form-control";
		$this->_9_26_R->EditCustomAttributes = "";
		$this->_9_26_R->EditValue = $this->_9_26_R->CurrentValue;
		$this->_9_26_R->PlaceHolder = RemoveHtml($this->_9_26_R->caption());

		// 9_27_R
		$this->_9_27_R->EditAttrs["class"] = "form-control";
		$this->_9_27_R->EditCustomAttributes = "";
		$this->_9_27_R->EditValue = $this->_9_27_R->CurrentValue;
		$this->_9_27_R->PlaceHolder = RemoveHtml($this->_9_27_R->caption());

		// 9_28_R
		$this->_9_28_R->EditAttrs["class"] = "form-control";
		$this->_9_28_R->EditCustomAttributes = "";
		$this->_9_28_R->EditValue = $this->_9_28_R->CurrentValue;
		$this->_9_28_R->PlaceHolder = RemoveHtml($this->_9_28_R->caption());

		// 9_29_R
		$this->_9_29_R->EditAttrs["class"] = "form-control";
		$this->_9_29_R->EditCustomAttributes = "";
		$this->_9_29_R->EditValue = $this->_9_29_R->CurrentValue;
		$this->_9_29_R->PlaceHolder = RemoveHtml($this->_9_29_R->caption());

		// 9_30_R
		$this->_9_30_R->EditAttrs["class"] = "form-control";
		$this->_9_30_R->EditCustomAttributes = "";
		$this->_9_30_R->EditValue = $this->_9_30_R->CurrentValue;
		$this->_9_30_R->PlaceHolder = RemoveHtml($this->_9_30_R->caption());

		// 9_31_R
		$this->_9_31_R->EditAttrs["class"] = "form-control";
		$this->_9_31_R->EditCustomAttributes = "";
		$this->_9_31_R->EditValue = $this->_9_31_R->CurrentValue;
		$this->_9_31_R->PlaceHolder = RemoveHtml($this->_9_31_R->caption());

		// 9_32_R
		$this->_9_32_R->EditAttrs["class"] = "form-control";
		$this->_9_32_R->EditCustomAttributes = "";
		$this->_9_32_R->EditValue = $this->_9_32_R->CurrentValue;
		$this->_9_32_R->PlaceHolder = RemoveHtml($this->_9_32_R->caption());

		// 9_33_R
		$this->_9_33_R->EditAttrs["class"] = "form-control";
		$this->_9_33_R->EditCustomAttributes = "";
		$this->_9_33_R->EditValue = $this->_9_33_R->CurrentValue;
		$this->_9_33_R->PlaceHolder = RemoveHtml($this->_9_33_R->caption());

		// 9_34_R
		$this->_9_34_R->EditAttrs["class"] = "form-control";
		$this->_9_34_R->EditCustomAttributes = "";
		$this->_9_34_R->EditValue = $this->_9_34_R->CurrentValue;
		$this->_9_34_R->PlaceHolder = RemoveHtml($this->_9_34_R->caption());

		// 9_35_R
		$this->_9_35_R->EditAttrs["class"] = "form-control";
		$this->_9_35_R->EditCustomAttributes = "";
		$this->_9_35_R->EditValue = $this->_9_35_R->CurrentValue;
		$this->_9_35_R->PlaceHolder = RemoveHtml($this->_9_35_R->caption());

		// 9_36_R
		$this->_9_36_R->EditAttrs["class"] = "form-control";
		$this->_9_36_R->EditCustomAttributes = "";
		$this->_9_36_R->EditValue = $this->_9_36_R->CurrentValue;
		$this->_9_36_R->PlaceHolder = RemoveHtml($this->_9_36_R->caption());

		// 9_37_R
		$this->_9_37_R->EditAttrs["class"] = "form-control";
		$this->_9_37_R->EditCustomAttributes = "";
		$this->_9_37_R->EditValue = $this->_9_37_R->CurrentValue;
		$this->_9_37_R->PlaceHolder = RemoveHtml($this->_9_37_R->caption());

		// 9_38_R
		$this->_9_38_R->EditAttrs["class"] = "form-control";
		$this->_9_38_R->EditCustomAttributes = "";
		$this->_9_38_R->EditValue = $this->_9_38_R->CurrentValue;
		$this->_9_38_R->PlaceHolder = RemoveHtml($this->_9_38_R->caption());

		// 9_39_R
		$this->_9_39_R->EditAttrs["class"] = "form-control";
		$this->_9_39_R->EditCustomAttributes = "";
		$this->_9_39_R->EditValue = $this->_9_39_R->CurrentValue;
		$this->_9_39_R->PlaceHolder = RemoveHtml($this->_9_39_R->caption());

		// 10_40_R
		$this->_10_40_R->EditAttrs["class"] = "form-control";
		$this->_10_40_R->EditCustomAttributes = "";
		$this->_10_40_R->EditValue = $this->_10_40_R->CurrentValue;
		$this->_10_40_R->PlaceHolder = RemoveHtml($this->_10_40_R->caption());

		// 10_41_R
		$this->_10_41_R->EditAttrs["class"] = "form-control";
		$this->_10_41_R->EditCustomAttributes = "";
		$this->_10_41_R->EditValue = $this->_10_41_R->CurrentValue;
		$this->_10_41_R->PlaceHolder = RemoveHtml($this->_10_41_R->caption());

		// 11_42_R
		$this->_11_42_R->EditAttrs["class"] = "form-control";
		$this->_11_42_R->EditCustomAttributes = "";
		$this->_11_42_R->EditValue = $this->_11_42_R->CurrentValue;
		$this->_11_42_R->PlaceHolder = RemoveHtml($this->_11_42_R->caption());

		// 11_43_R
		$this->_11_43_R->EditAttrs["class"] = "form-control";
		$this->_11_43_R->EditCustomAttributes = "";
		$this->_11_43_R->EditValue = $this->_11_43_R->CurrentValue;
		$this->_11_43_R->PlaceHolder = RemoveHtml($this->_11_43_R->caption());

		// 12_44_R
		$this->_12_44_R->EditAttrs["class"] = "form-control";
		$this->_12_44_R->EditCustomAttributes = "";
		$this->_12_44_R->EditValue = $this->_12_44_R->CurrentValue;
		$this->_12_44_R->PlaceHolder = RemoveHtml($this->_12_44_R->caption());

		// 12_45_R
		$this->_12_45_R->EditAttrs["class"] = "form-control";
		$this->_12_45_R->EditCustomAttributes = "";
		$this->_12_45_R->EditValue = $this->_12_45_R->CurrentValue;
		$this->_12_45_R->PlaceHolder = RemoveHtml($this->_12_45_R->caption());

		// 12_46_R
		$this->_12_46_R->EditAttrs["class"] = "form-control";
		$this->_12_46_R->EditCustomAttributes = "";
		$this->_12_46_R->EditValue = $this->_12_46_R->CurrentValue;
		$this->_12_46_R->PlaceHolder = RemoveHtml($this->_12_46_R->caption());

		// 12_47_R
		$this->_12_47_R->EditAttrs["class"] = "form-control";
		$this->_12_47_R->EditCustomAttributes = "";
		$this->_12_47_R->EditValue = $this->_12_47_R->CurrentValue;
		$this->_12_47_R->PlaceHolder = RemoveHtml($this->_12_47_R->caption());

		// 12_48_R
		$this->_12_48_R->EditAttrs["class"] = "form-control";
		$this->_12_48_R->EditCustomAttributes = "";
		$this->_12_48_R->EditValue = $this->_12_48_R->CurrentValue;
		$this->_12_48_R->PlaceHolder = RemoveHtml($this->_12_48_R->caption());

		// 12_49_R
		$this->_12_49_R->EditAttrs["class"] = "form-control";
		$this->_12_49_R->EditCustomAttributes = "";
		$this->_12_49_R->EditValue = $this->_12_49_R->CurrentValue;
		$this->_12_49_R->PlaceHolder = RemoveHtml($this->_12_49_R->caption());

		// 12_50_R
		$this->_12_50_R->EditAttrs["class"] = "form-control";
		$this->_12_50_R->EditCustomAttributes = "";
		$this->_12_50_R->EditValue = $this->_12_50_R->CurrentValue;
		$this->_12_50_R->PlaceHolder = RemoveHtml($this->_12_50_R->caption());

		// 1__R
		$this->_1__R->EditAttrs["class"] = "form-control";
		$this->_1__R->EditCustomAttributes = "";
		$this->_1__R->EditValue = $this->_1__R->CurrentValue;
		$this->_1__R->PlaceHolder = RemoveHtml($this->_1__R->caption());

		// 13_54_R
		$this->_13_54_R->EditAttrs["class"] = "form-control";
		$this->_13_54_R->EditCustomAttributes = "";
		$this->_13_54_R->EditValue = $this->_13_54_R->CurrentValue;
		$this->_13_54_R->PlaceHolder = RemoveHtml($this->_13_54_R->caption());

		// 13_54_1_R
		$this->_13_54_1_R->EditAttrs["class"] = "form-control";
		$this->_13_54_1_R->EditCustomAttributes = "";
		$this->_13_54_1_R->EditValue = $this->_13_54_1_R->CurrentValue;
		$this->_13_54_1_R->PlaceHolder = RemoveHtml($this->_13_54_1_R->caption());

		// 13_54_2_R
		$this->_13_54_2_R->EditAttrs["class"] = "form-control";
		$this->_13_54_2_R->EditCustomAttributes = "";
		$this->_13_54_2_R->EditValue = $this->_13_54_2_R->CurrentValue;
		$this->_13_54_2_R->PlaceHolder = RemoveHtml($this->_13_54_2_R->caption());

		// 13_55_R
		$this->_13_55_R->EditAttrs["class"] = "form-control";
		$this->_13_55_R->EditCustomAttributes = "";
		$this->_13_55_R->EditValue = $this->_13_55_R->CurrentValue;
		$this->_13_55_R->PlaceHolder = RemoveHtml($this->_13_55_R->caption());

		// 13_55_1_R
		$this->_13_55_1_R->EditAttrs["class"] = "form-control";
		$this->_13_55_1_R->EditCustomAttributes = "";
		$this->_13_55_1_R->EditValue = $this->_13_55_1_R->CurrentValue;
		$this->_13_55_1_R->PlaceHolder = RemoveHtml($this->_13_55_1_R->caption());

		// 13_55_2_R
		$this->_13_55_2_R->EditAttrs["class"] = "form-control";
		$this->_13_55_2_R->EditCustomAttributes = "";
		$this->_13_55_2_R->EditValue = $this->_13_55_2_R->CurrentValue;
		$this->_13_55_2_R->PlaceHolder = RemoveHtml($this->_13_55_2_R->caption());

		// 13_56_R
		$this->_13_56_R->EditAttrs["class"] = "form-control";
		$this->_13_56_R->EditCustomAttributes = "";
		$this->_13_56_R->EditValue = $this->_13_56_R->CurrentValue;
		$this->_13_56_R->PlaceHolder = RemoveHtml($this->_13_56_R->caption());

		// 13_56_1_R
		$this->_13_56_1_R->EditAttrs["class"] = "form-control";
		$this->_13_56_1_R->EditCustomAttributes = "";
		$this->_13_56_1_R->EditValue = $this->_13_56_1_R->CurrentValue;
		$this->_13_56_1_R->PlaceHolder = RemoveHtml($this->_13_56_1_R->caption());

		// 13_56_2_R
		$this->_13_56_2_R->EditAttrs["class"] = "form-control";
		$this->_13_56_2_R->EditCustomAttributes = "";
		$this->_13_56_2_R->EditValue = $this->_13_56_2_R->CurrentValue;
		$this->_13_56_2_R->PlaceHolder = RemoveHtml($this->_13_56_2_R->caption());

		// 12_53_R
		$this->_12_53_R->EditAttrs["class"] = "form-control";
		$this->_12_53_R->EditCustomAttributes = "";
		$this->_12_53_R->EditValue = $this->_12_53_R->CurrentValue;
		$this->_12_53_R->PlaceHolder = RemoveHtml($this->_12_53_R->caption());

		// 12_53_1_R
		$this->_12_53_1_R->EditAttrs["class"] = "form-control";
		$this->_12_53_1_R->EditCustomAttributes = "";
		$this->_12_53_1_R->EditValue = $this->_12_53_1_R->CurrentValue;
		$this->_12_53_1_R->PlaceHolder = RemoveHtml($this->_12_53_1_R->caption());

		// 12_53_2_R
		$this->_12_53_2_R->EditAttrs["class"] = "form-control";
		$this->_12_53_2_R->EditCustomAttributes = "";
		$this->_12_53_2_R->EditValue = $this->_12_53_2_R->CurrentValue;
		$this->_12_53_2_R->PlaceHolder = RemoveHtml($this->_12_53_2_R->caption());

		// 12_53_3_R
		$this->_12_53_3_R->EditAttrs["class"] = "form-control";
		$this->_12_53_3_R->EditCustomAttributes = "";
		$this->_12_53_3_R->EditValue = $this->_12_53_3_R->CurrentValue;
		$this->_12_53_3_R->PlaceHolder = RemoveHtml($this->_12_53_3_R->caption());

		// 12_53_4_R
		$this->_12_53_4_R->EditAttrs["class"] = "form-control";
		$this->_12_53_4_R->EditCustomAttributes = "";
		$this->_12_53_4_R->EditValue = $this->_12_53_4_R->CurrentValue;
		$this->_12_53_4_R->PlaceHolder = RemoveHtml($this->_12_53_4_R->caption());

		// 12_53_5_R
		$this->_12_53_5_R->EditAttrs["class"] = "form-control";
		$this->_12_53_5_R->EditCustomAttributes = "";
		$this->_12_53_5_R->EditValue = $this->_12_53_5_R->CurrentValue;
		$this->_12_53_5_R->PlaceHolder = RemoveHtml($this->_12_53_5_R->caption());

		// 12_53_6_R
		$this->_12_53_6_R->EditAttrs["class"] = "form-control";
		$this->_12_53_6_R->EditCustomAttributes = "";
		$this->_12_53_6_R->EditValue = $this->_12_53_6_R->CurrentValue;
		$this->_12_53_6_R->PlaceHolder = RemoveHtml($this->_12_53_6_R->caption());

		// 13_57_R
		$this->_13_57_R->EditAttrs["class"] = "form-control";
		$this->_13_57_R->EditCustomAttributes = "";
		$this->_13_57_R->EditValue = $this->_13_57_R->CurrentValue;
		$this->_13_57_R->PlaceHolder = RemoveHtml($this->_13_57_R->caption());

		// 13_57_1_R
		$this->_13_57_1_R->EditAttrs["class"] = "form-control";
		$this->_13_57_1_R->EditCustomAttributes = "";
		$this->_13_57_1_R->EditValue = $this->_13_57_1_R->CurrentValue;
		$this->_13_57_1_R->PlaceHolder = RemoveHtml($this->_13_57_1_R->caption());

		// 13_57_2_R
		$this->_13_57_2_R->EditAttrs["class"] = "form-control";
		$this->_13_57_2_R->EditCustomAttributes = "";
		$this->_13_57_2_R->EditValue = $this->_13_57_2_R->CurrentValue;
		$this->_13_57_2_R->PlaceHolder = RemoveHtml($this->_13_57_2_R->caption());

		// 13_58_R
		$this->_13_58_R->EditAttrs["class"] = "form-control";
		$this->_13_58_R->EditCustomAttributes = "";
		$this->_13_58_R->EditValue = $this->_13_58_R->CurrentValue;
		$this->_13_58_R->PlaceHolder = RemoveHtml($this->_13_58_R->caption());

		// 13_58_1_R
		$this->_13_58_1_R->EditAttrs["class"] = "form-control";
		$this->_13_58_1_R->EditCustomAttributes = "";
		$this->_13_58_1_R->EditValue = $this->_13_58_1_R->CurrentValue;
		$this->_13_58_1_R->PlaceHolder = RemoveHtml($this->_13_58_1_R->caption());

		// 13_58_2_R
		$this->_13_58_2_R->EditAttrs["class"] = "form-control";
		$this->_13_58_2_R->EditCustomAttributes = "";
		$this->_13_58_2_R->EditValue = $this->_13_58_2_R->CurrentValue;
		$this->_13_58_2_R->PlaceHolder = RemoveHtml($this->_13_58_2_R->caption());

		// 13_59_R
		$this->_13_59_R->EditAttrs["class"] = "form-control";
		$this->_13_59_R->EditCustomAttributes = "";
		$this->_13_59_R->EditValue = $this->_13_59_R->CurrentValue;
		$this->_13_59_R->PlaceHolder = RemoveHtml($this->_13_59_R->caption());

		// 13_59_1_R
		$this->_13_59_1_R->EditAttrs["class"] = "form-control";
		$this->_13_59_1_R->EditCustomAttributes = "";
		$this->_13_59_1_R->EditValue = $this->_13_59_1_R->CurrentValue;
		$this->_13_59_1_R->PlaceHolder = RemoveHtml($this->_13_59_1_R->caption());

		// 13_59_2_R
		$this->_13_59_2_R->EditAttrs["class"] = "form-control";
		$this->_13_59_2_R->EditCustomAttributes = "";
		$this->_13_59_2_R->EditValue = $this->_13_59_2_R->CurrentValue;
		$this->_13_59_2_R->PlaceHolder = RemoveHtml($this->_13_59_2_R->caption());

		// 13_60_R
		$this->_13_60_R->EditAttrs["class"] = "form-control";
		$this->_13_60_R->EditCustomAttributes = "";
		$this->_13_60_R->EditValue = $this->_13_60_R->CurrentValue;
		$this->_13_60_R->PlaceHolder = RemoveHtml($this->_13_60_R->caption());

		// 12_53_7_R
		$this->_12_53_7_R->EditAttrs["class"] = "form-control";
		$this->_12_53_7_R->EditCustomAttributes = "";
		$this->_12_53_7_R->EditValue = $this->_12_53_7_R->CurrentValue;
		$this->_12_53_7_R->PlaceHolder = RemoveHtml($this->_12_53_7_R->caption());

		// 12_53_8_R
		$this->_12_53_8_R->EditAttrs["class"] = "form-control";
		$this->_12_53_8_R->EditCustomAttributes = "";
		$this->_12_53_8_R->EditValue = $this->_12_53_8_R->CurrentValue;
		$this->_12_53_8_R->PlaceHolder = RemoveHtml($this->_12_53_8_R->caption());

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	public function aggregateListRowValues()
	{
	}

	// Aggregate list row (for rendering)
	public function aggregateListRow()
	{

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
	{
		if (!$recordset || !$doc)
			return;
		if (!$doc->ExportCustom) {

			// Write header
			$doc->exportTableHeader();
			if ($doc->Horizontal) { // Horizontal format, write header
				$doc->beginExportRow();
				if ($exportPageType == "view") {
					$doc->exportCaption($this->id);
					$doc->exportCaption($this->fecha);
					$doc->exportCaption($this->hora);
					$doc->exportCaption($this->audio);
					$doc->exportCaption($this->st);
					$doc->exportCaption($this->fechaHoraIni);
					$doc->exportCaption($this->fechaHoraFin);
					$doc->exportCaption($this->telefono);
					$doc->exportCaption($this->agente);
					$doc->exportCaption($this->fechabo);
					$doc->exportCaption($this->agentebo);
					$doc->exportCaption($this->comentariosbo);
					$doc->exportCaption($this->IP);
					$doc->exportCaption($this->actual);
					$doc->exportCaption($this->completado);
					$doc->exportCaption($this->_2_1_R);
					$doc->exportCaption($this->_2_2_R);
					$doc->exportCaption($this->_2_3_R);
					$doc->exportCaption($this->_3_4_R);
					$doc->exportCaption($this->_4_5_R);
					$doc->exportCaption($this->_4_6_R);
					$doc->exportCaption($this->_4_7_R);
					$doc->exportCaption($this->_4_8_R);
					$doc->exportCaption($this->_5_9_R);
					$doc->exportCaption($this->_5_10_R);
					$doc->exportCaption($this->_5_11_R);
					$doc->exportCaption($this->_5_12_R);
					$doc->exportCaption($this->_5_13_R);
					$doc->exportCaption($this->_5_14_R);
					$doc->exportCaption($this->_5_51_R);
					$doc->exportCaption($this->_6_15_R);
					$doc->exportCaption($this->_6_16_R);
					$doc->exportCaption($this->_6_17_R);
					$doc->exportCaption($this->_6_18_R);
					$doc->exportCaption($this->_6_19_R);
					$doc->exportCaption($this->_6_20_R);
					$doc->exportCaption($this->_6_52_R);
					$doc->exportCaption($this->_7_21_R);
					$doc->exportCaption($this->_8_22_R);
					$doc->exportCaption($this->_8_23_R);
					$doc->exportCaption($this->_8_24_R);
					$doc->exportCaption($this->_8_25_R);
					$doc->exportCaption($this->_9_26_R);
					$doc->exportCaption($this->_9_27_R);
					$doc->exportCaption($this->_9_28_R);
					$doc->exportCaption($this->_9_29_R);
					$doc->exportCaption($this->_9_30_R);
					$doc->exportCaption($this->_9_31_R);
					$doc->exportCaption($this->_9_32_R);
					$doc->exportCaption($this->_9_33_R);
					$doc->exportCaption($this->_9_34_R);
					$doc->exportCaption($this->_9_35_R);
					$doc->exportCaption($this->_9_36_R);
					$doc->exportCaption($this->_9_37_R);
					$doc->exportCaption($this->_9_38_R);
					$doc->exportCaption($this->_9_39_R);
					$doc->exportCaption($this->_10_40_R);
					$doc->exportCaption($this->_10_41_R);
					$doc->exportCaption($this->_11_42_R);
					$doc->exportCaption($this->_11_43_R);
					$doc->exportCaption($this->_12_44_R);
					$doc->exportCaption($this->_12_45_R);
					$doc->exportCaption($this->_12_46_R);
					$doc->exportCaption($this->_12_47_R);
					$doc->exportCaption($this->_12_48_R);
					$doc->exportCaption($this->_12_49_R);
					$doc->exportCaption($this->_12_50_R);
					$doc->exportCaption($this->_1__R);
					$doc->exportCaption($this->_13_54_R);
					$doc->exportCaption($this->_13_54_1_R);
					$doc->exportCaption($this->_13_54_2_R);
					$doc->exportCaption($this->_13_55_R);
					$doc->exportCaption($this->_13_55_1_R);
					$doc->exportCaption($this->_13_55_2_R);
					$doc->exportCaption($this->_13_56_R);
					$doc->exportCaption($this->_13_56_1_R);
					$doc->exportCaption($this->_13_56_2_R);
					$doc->exportCaption($this->_12_53_R);
					$doc->exportCaption($this->_12_53_1_R);
					$doc->exportCaption($this->_12_53_2_R);
					$doc->exportCaption($this->_12_53_3_R);
					$doc->exportCaption($this->_12_53_4_R);
					$doc->exportCaption($this->_12_53_5_R);
					$doc->exportCaption($this->_12_53_6_R);
					$doc->exportCaption($this->_13_57_R);
					$doc->exportCaption($this->_13_57_1_R);
					$doc->exportCaption($this->_13_57_2_R);
					$doc->exportCaption($this->_13_58_R);
					$doc->exportCaption($this->_13_58_1_R);
					$doc->exportCaption($this->_13_58_2_R);
					$doc->exportCaption($this->_13_59_R);
					$doc->exportCaption($this->_13_59_1_R);
					$doc->exportCaption($this->_13_59_2_R);
					$doc->exportCaption($this->_13_60_R);
					$doc->exportCaption($this->_12_53_7_R);
					$doc->exportCaption($this->_12_53_8_R);
				} else {
					$doc->exportCaption($this->id);
					$doc->exportCaption($this->fecha);
					$doc->exportCaption($this->hora);
					$doc->exportCaption($this->audio);
					$doc->exportCaption($this->st);
					$doc->exportCaption($this->fechaHoraIni);
					$doc->exportCaption($this->fechaHoraFin);
					$doc->exportCaption($this->telefono);
					$doc->exportCaption($this->agente);
					$doc->exportCaption($this->fechabo);
					$doc->exportCaption($this->agentebo);
					$doc->exportCaption($this->IP);
					$doc->exportCaption($this->actual);
					$doc->exportCaption($this->completado);
				}
				$doc->endExportRow();
			}
		}

		// Move to first record
		$recCnt = $startRec - 1;
		if (!$recordset->EOF) {
			$recordset->moveFirst();
			if ($startRec > 1)
				$recordset->move($startRec - 1);
		}
		while (!$recordset->EOF && $recCnt < $stopRec) {
			$recCnt++;
			if ($recCnt >= $startRec) {
				$rowCnt = $recCnt - $startRec + 1;

				// Page break
				if ($this->ExportPageBreakCount > 0) {
					if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0)
						$doc->exportPageBreak();
				}
				$this->loadListRowValues($recordset);

				// Render row
				$this->RowType = ROWTYPE_VIEW; // Render view
				$this->resetAttributes();
				$this->renderListRow();
				if (!$doc->ExportCustom) {
					$doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
					if ($exportPageType == "view") {
						$doc->exportField($this->id);
						$doc->exportField($this->fecha);
						$doc->exportField($this->hora);
						$doc->exportField($this->audio);
						$doc->exportField($this->st);
						$doc->exportField($this->fechaHoraIni);
						$doc->exportField($this->fechaHoraFin);
						$doc->exportField($this->telefono);
						$doc->exportField($this->agente);
						$doc->exportField($this->fechabo);
						$doc->exportField($this->agentebo);
						$doc->exportField($this->comentariosbo);
						$doc->exportField($this->IP);
						$doc->exportField($this->actual);
						$doc->exportField($this->completado);
						$doc->exportField($this->_2_1_R);
						$doc->exportField($this->_2_2_R);
						$doc->exportField($this->_2_3_R);
						$doc->exportField($this->_3_4_R);
						$doc->exportField($this->_4_5_R);
						$doc->exportField($this->_4_6_R);
						$doc->exportField($this->_4_7_R);
						$doc->exportField($this->_4_8_R);
						$doc->exportField($this->_5_9_R);
						$doc->exportField($this->_5_10_R);
						$doc->exportField($this->_5_11_R);
						$doc->exportField($this->_5_12_R);
						$doc->exportField($this->_5_13_R);
						$doc->exportField($this->_5_14_R);
						$doc->exportField($this->_5_51_R);
						$doc->exportField($this->_6_15_R);
						$doc->exportField($this->_6_16_R);
						$doc->exportField($this->_6_17_R);
						$doc->exportField($this->_6_18_R);
						$doc->exportField($this->_6_19_R);
						$doc->exportField($this->_6_20_R);
						$doc->exportField($this->_6_52_R);
						$doc->exportField($this->_7_21_R);
						$doc->exportField($this->_8_22_R);
						$doc->exportField($this->_8_23_R);
						$doc->exportField($this->_8_24_R);
						$doc->exportField($this->_8_25_R);
						$doc->exportField($this->_9_26_R);
						$doc->exportField($this->_9_27_R);
						$doc->exportField($this->_9_28_R);
						$doc->exportField($this->_9_29_R);
						$doc->exportField($this->_9_30_R);
						$doc->exportField($this->_9_31_R);
						$doc->exportField($this->_9_32_R);
						$doc->exportField($this->_9_33_R);
						$doc->exportField($this->_9_34_R);
						$doc->exportField($this->_9_35_R);
						$doc->exportField($this->_9_36_R);
						$doc->exportField($this->_9_37_R);
						$doc->exportField($this->_9_38_R);
						$doc->exportField($this->_9_39_R);
						$doc->exportField($this->_10_40_R);
						$doc->exportField($this->_10_41_R);
						$doc->exportField($this->_11_42_R);
						$doc->exportField($this->_11_43_R);
						$doc->exportField($this->_12_44_R);
						$doc->exportField($this->_12_45_R);
						$doc->exportField($this->_12_46_R);
						$doc->exportField($this->_12_47_R);
						$doc->exportField($this->_12_48_R);
						$doc->exportField($this->_12_49_R);
						$doc->exportField($this->_12_50_R);
						$doc->exportField($this->_1__R);
						$doc->exportField($this->_13_54_R);
						$doc->exportField($this->_13_54_1_R);
						$doc->exportField($this->_13_54_2_R);
						$doc->exportField($this->_13_55_R);
						$doc->exportField($this->_13_55_1_R);
						$doc->exportField($this->_13_55_2_R);
						$doc->exportField($this->_13_56_R);
						$doc->exportField($this->_13_56_1_R);
						$doc->exportField($this->_13_56_2_R);
						$doc->exportField($this->_12_53_R);
						$doc->exportField($this->_12_53_1_R);
						$doc->exportField($this->_12_53_2_R);
						$doc->exportField($this->_12_53_3_R);
						$doc->exportField($this->_12_53_4_R);
						$doc->exportField($this->_12_53_5_R);
						$doc->exportField($this->_12_53_6_R);
						$doc->exportField($this->_13_57_R);
						$doc->exportField($this->_13_57_1_R);
						$doc->exportField($this->_13_57_2_R);
						$doc->exportField($this->_13_58_R);
						$doc->exportField($this->_13_58_1_R);
						$doc->exportField($this->_13_58_2_R);
						$doc->exportField($this->_13_59_R);
						$doc->exportField($this->_13_59_1_R);
						$doc->exportField($this->_13_59_2_R);
						$doc->exportField($this->_13_60_R);
						$doc->exportField($this->_12_53_7_R);
						$doc->exportField($this->_12_53_8_R);
					} else {
						$doc->exportField($this->id);
						$doc->exportField($this->fecha);
						$doc->exportField($this->hora);
						$doc->exportField($this->audio);
						$doc->exportField($this->st);
						$doc->exportField($this->fechaHoraIni);
						$doc->exportField($this->fechaHoraFin);
						$doc->exportField($this->telefono);
						$doc->exportField($this->agente);
						$doc->exportField($this->fechabo);
						$doc->exportField($this->agentebo);
						$doc->exportField($this->IP);
						$doc->exportField($this->actual);
						$doc->exportField($this->completado);
					}
					$doc->endExportRow($rowCnt);
				}
			}

			// Call Row Export server event
			if ($doc->ExportCustom)
				$this->Row_Export($recordset->fields);
			$recordset->moveNext();
		}
		if (!$doc->ExportCustom) {
			$doc->exportTableFooter();
		}
	}

	// Get file data
	public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0)
	{

		// No binary fields
		return FALSE;
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Grid Inserting event
	function Grid_Inserting() {

		// Enter your code here
		// To reject grid insert, set return value to FALSE

		return TRUE;
	}

	// Grid Inserted event
	function Grid_Inserted($rsnew) {

		//echo "Grid Inserted";
	}

	// Grid Updating event
	function Grid_Updating($rsold) {

		// Enter your code here
		// To reject grid update, set return value to FALSE

		return TRUE;
	}

	// Grid Updated event
	function Grid_Updated($rsold, $rsnew) {

		//echo "Grid Updated";
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending($email, &$args) {

		//var_dump($email); var_dump($args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		//var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
		// Enter your code here

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>