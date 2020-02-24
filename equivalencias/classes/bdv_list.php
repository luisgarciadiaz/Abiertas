<?php
namespace PHPMaker2020\project1;

/**
 * Page class
 */
class bdv_list extends bdv
{

	// Page ID
	public $PageID = "list";

	// Project ID
	public $ProjectID = "{BCBBB89F-782F-4C8E-A4DB-F05CA52E74C8}";

	// Table name
	public $TableName = 'bdv';

	// Page object name
	public $PageObjName = "bdv_list";

	// Grid form hidden field names
	public $FormName = "fbdvlist";
	public $FormActionName = "k_action";
	public $FormKeyName = "k_key";
	public $FormOldKeyName = "k_oldkey";
	public $FormBlankRowName = "k_blankrow";
	public $FormKeyCountName = "key_count";

	// Page URLs
	public $AddUrl;
	public $EditUrl;
	public $CopyUrl;
	public $DeleteUrl;
	public $ViewUrl;
	public $ListUrl;

	// Export URLs
	public $ExportPrintUrl;
	public $ExportHtmlUrl;
	public $ExportExcelUrl;
	public $ExportWordUrl;
	public $ExportXmlUrl;
	public $ExportCsvUrl;
	public $ExportPdfUrl;

	// Custom export
	public $ExportExcelCustom = FALSE;
	public $ExportWordCustom = FALSE;
	public $ExportPdfCustom = FALSE;
	public $ExportEmailCustom = FALSE;

	// Update URLs
	public $InlineAddUrl;
	public $InlineCopyUrl;
	public $InlineEditUrl;
	public $GridAddUrl;
	public $GridEditUrl;
	public $MultiDeleteUrl;
	public $MultiUpdateUrl;

	// Page headings
	public $Heading = "";
	public $Subheading = "";
	public $PageHeader;
	public $PageFooter;

	// Token
	public $Token = "";
	public $TokenTimeout = 0;
	public $CheckToken;

	// Page heading
	public function pageHeading()
	{
		global $Language;
		if ($this->Heading != "")
			return $this->Heading;
		if (method_exists($this, "tableCaption"))
			return $this->tableCaption();
		return "";
	}

	// Page subheading
	public function pageSubheading()
	{
		global $Language;
		if ($this->Subheading != "")
			return $this->Subheading;
		if ($this->TableName)
			return $Language->phrase($this->PageID);
		return "";
	}

	// Page name
	public function pageName()
	{
		return CurrentPageName();
	}

	// Page URL
	public function pageUrl()
	{
		$url = CurrentPageName() . "?";
		if ($this->UseTokenInUrl)
			$url .= "t=" . $this->TableVar . "&"; // Add page token
		return $url;
	}

	// Messages
	private $_message = "";
	private $_failureMessage = "";
	private $_successMessage = "";
	private $_warningMessage = "";

	// Get message
	public function getMessage()
	{
		return isset($_SESSION[SESSION_MESSAGE]) ? $_SESSION[SESSION_MESSAGE] : $this->_message;
	}

	// Set message
	public function setMessage($v)
	{
		AddMessage($this->_message, $v);
		$_SESSION[SESSION_MESSAGE] = $this->_message;
	}

	// Get failure message
	public function getFailureMessage()
	{
		return isset($_SESSION[SESSION_FAILURE_MESSAGE]) ? $_SESSION[SESSION_FAILURE_MESSAGE] : $this->_failureMessage;
	}

	// Set failure message
	public function setFailureMessage($v)
	{
		AddMessage($this->_failureMessage, $v);
		$_SESSION[SESSION_FAILURE_MESSAGE] = $this->_failureMessage;
	}

	// Get success message
	public function getSuccessMessage()
	{
		return isset($_SESSION[SESSION_SUCCESS_MESSAGE]) ? $_SESSION[SESSION_SUCCESS_MESSAGE] : $this->_successMessage;
	}

	// Set success message
	public function setSuccessMessage($v)
	{
		AddMessage($this->_successMessage, $v);
		$_SESSION[SESSION_SUCCESS_MESSAGE] = $this->_successMessage;
	}

	// Get warning message
	public function getWarningMessage()
	{
		return isset($_SESSION[SESSION_WARNING_MESSAGE]) ? $_SESSION[SESSION_WARNING_MESSAGE] : $this->_warningMessage;
	}

	// Set warning message
	public function setWarningMessage($v)
	{
		AddMessage($this->_warningMessage, $v);
		$_SESSION[SESSION_WARNING_MESSAGE] = $this->_warningMessage;
	}

	// Clear message
	public function clearMessage()
	{
		$this->_message = "";
		$_SESSION[SESSION_MESSAGE] = "";
	}

	// Clear failure message
	public function clearFailureMessage()
	{
		$this->_failureMessage = "";
		$_SESSION[SESSION_FAILURE_MESSAGE] = "";
	}

	// Clear success message
	public function clearSuccessMessage()
	{
		$this->_successMessage = "";
		$_SESSION[SESSION_SUCCESS_MESSAGE] = "";
	}

	// Clear warning message
	public function clearWarningMessage()
	{
		$this->_warningMessage = "";
		$_SESSION[SESSION_WARNING_MESSAGE] = "";
	}

	// Clear messages
	public function clearMessages()
	{
		$this->clearMessage();
		$this->clearFailureMessage();
		$this->clearSuccessMessage();
		$this->clearWarningMessage();
	}

	// Show message
	public function showMessage()
	{
		$hidden = TRUE;
		$html = "";

		// Message
		$message = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($message, "");
		if ($message != "") { // Message in Session, display
			if (!$hidden)
				$message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $message;
			$html .= '<div class="alert alert-info alert-dismissible ew-info"><i class="icon fas fa-info"></i>' . $message . '</div>';
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($warningMessage, "warning");
		if ($warningMessage != "") { // Message in Session, display
			if (!$hidden)
				$warningMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $warningMessage;
			$html .= '<div class="alert alert-warning alert-dismissible ew-warning"><i class="icon fas fa-exclamation"></i>' . $warningMessage . '</div>';
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($successMessage, "success");
		if ($successMessage != "") { // Message in Session, display
			if (!$hidden)
				$successMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $successMessage;
			$html .= '<div class="alert alert-success alert-dismissible ew-success"><i class="icon fas fa-check"></i>' . $successMessage . '</div>';
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$errorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($errorMessage, "failure");
		if ($errorMessage != "") { // Message in Session, display
			if (!$hidden)
				$errorMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $errorMessage;
			$html .= '<div class="alert alert-danger alert-dismissible ew-error"><i class="icon fas fa-ban"></i>' . $errorMessage . '</div>';
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo '<div class="ew-message-dialog' . (($hidden) ? ' d-none' : "") . '">' . $html . '</div>';
	}

	// Get message as array
	public function getMessages()
	{
		$ar = [];

		// Message
		$message = $this->getMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($message, "");

		if ($message != "") { // Message in Session, display
			$ar["message"] = $message;
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($warningMessage, "warning");

		if ($warningMessage != "") { // Message in Session, display
			$ar["warningMessage"] = $warningMessage;
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($successMessage, "success");

		if ($successMessage != "") { // Message in Session, display
			$ar["successMessage"] = $successMessage;
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$failureMessage = $this->getFailureMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($failureMessage, "failure");

		if ($failureMessage != "") { // Message in Session, display
			$ar["failureMessage"] = $failureMessage;
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		return $ar;
	}

	// Show Page Header
	public function showPageHeader()
	{
		$header = $this->PageHeader;
		$this->Page_DataRendering($header);
		if ($header != "") { // Header exists, display
			echo '<p id="ew-page-header">' . $header . '</p>';
		}
	}

	// Show Page Footer
	public function showPageFooter()
	{
		$footer = $this->PageFooter;
		$this->Page_DataRendered($footer);
		if ($footer != "") { // Footer exists, display
			echo '<p id="ew-page-footer">' . $footer . '</p>';
		}
	}

	// Validate page request
	protected function isPageRequest()
	{
		global $CurrentForm;
		if ($this->UseTokenInUrl) {
			if ($CurrentForm)
				return ($this->TableVar == $CurrentForm->getValue("t"));
			if (Get("t") !== NULL)
				return ($this->TableVar == Get("t"));
		}
		return TRUE;
	}

	// Valid Post
	protected function validPost()
	{
		if (!$this->CheckToken || !IsPost() || IsApi())
			return TRUE;
		if (Post(Config("TOKEN_NAME")) === NULL)
			return FALSE;
		$fn = Config("CHECK_TOKEN_FUNC");
		if (is_callable($fn))
			return $fn(Post(Config("TOKEN_NAME")), $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	public function createToken()
	{
		global $CurrentToken;
		$fn = Config("CREATE_TOKEN_FUNC"); // Always create token, required by API file/lookup request
		if ($this->Token == "" && is_callable($fn)) // Create token
			$this->Token = $fn();
		$CurrentToken = $this->Token; // Save to global variable
	}

	// Constructor
	public function __construct()
	{
		global $Language, $DashboardReport;

		// Check token
		$this->CheckToken = Config("CHECK_TOKEN");

		// Initialize
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Parent constuctor
		parent::__construct();

		// Table object (bdv)
		if (!isset($GLOBALS["bdv"]) || get_class($GLOBALS["bdv"]) == PROJECT_NAMESPACE . "bdv") {
			$GLOBALS["bdv"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["bdv"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->pageUrl() . "export=print";
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel";
		$this->ExportWordUrl = $this->pageUrl() . "export=word";
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf";
		$this->ExportHtmlUrl = $this->pageUrl() . "export=html";
		$this->ExportXmlUrl = $this->pageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->pageUrl() . "export=csv";
		$this->AddUrl = "bdvadd.php";
		$this->InlineAddUrl = $this->pageUrl() . "action=add";
		$this->GridAddUrl = $this->pageUrl() . "action=gridadd";
		$this->GridEditUrl = $this->pageUrl() . "action=gridedit";
		$this->MultiDeleteUrl = "bdvdelete.php";
		$this->MultiUpdateUrl = "bdvupdate.php";

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'list');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'bdv');

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// Debug message
		LoadDebugMessage();

		// Open connection
		if (!isset($GLOBALS["Conn"]))
			$GLOBALS["Conn"] = $this->getConnection();

		// List options
		$this->ListOptions = new ListOptions();
		$this->ListOptions->TableVar = $this->TableVar;

		// Export options
		$this->ExportOptions = new ListOptions("div");
		$this->ExportOptions->TagClassName = "ew-export-option";

		// Import options
		$this->ImportOptions = new ListOptions("div");
		$this->ImportOptions->TagClassName = "ew-import-option";

		// Other options
		if (!$this->OtherOptions)
			$this->OtherOptions = new ListOptionsArray();
		$this->OtherOptions["addedit"] = new ListOptions("div");
		$this->OtherOptions["addedit"]->TagClassName = "ew-add-edit-option";
		$this->OtherOptions["detail"] = new ListOptions("div");
		$this->OtherOptions["detail"]->TagClassName = "ew-detail-option";
		$this->OtherOptions["action"] = new ListOptions("div");
		$this->OtherOptions["action"]->TagClassName = "ew-action-option";

		// Filter options
		$this->FilterOptions = new ListOptions("div");
		$this->FilterOptions->TagClassName = "ew-filter-option fbdvlistsrch";

		// List actions
		$this->ListActions = new ListActions();
	}

	// Terminate page
	public function terminate($url = "")
	{
		global $ExportFileName, $TempImages, $DashboardReport;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $bdv;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($bdv);
				$doc->Text = @$content;
				if ($this->isExport("email"))
					echo $this->exportEmail($doc->Text);
				else
					$doc->export();
				DeleteTempImages(); // Delete temp images
				exit();
			}
		}
		if (!IsApi())
			$this->Page_Redirecting($url);

		// Close connection
		CloseConnections();

		// Return for API
		if (IsApi()) {
			$res = $url === TRUE;
			if (!$res) // Show error
				WriteJson(array_merge(["success" => FALSE], $this->getMessages()));
			return;
		}

		// Go to URL if specified
		if ($url != "") {
			if (!Config("DEBUG") && ob_get_length())
				ob_end_clean();
			SaveDebugMessage();
			AddHeader("Location", $url);
		}
		exit();
	}

	// Get records from recordset
	protected function getRecordsFromRecordset($rs, $current = FALSE)
	{
		$rows = [];
		if (is_object($rs)) { // Recordset
			while ($rs && !$rs->EOF) {
				$this->loadRowValues($rs); // Set up DbValue/CurrentValue
				$row = $this->getRecordFromArray($rs->fields);
				if ($current)
					return $row;
				else
					$rows[] = $row;
				$rs->moveNext();
			}
		} elseif (is_array($rs)) {
			foreach ($rs as $ar) {
				$row = $this->getRecordFromArray($ar);
				if ($current)
					return $row;
				else
					$rows[] = $row;
			}
		}
		return $rows;
	}

	// Get record from array
	protected function getRecordFromArray($ar)
	{
		$row = [];
		if (is_array($ar)) {
			foreach ($ar as $fldname => $val) {
				if (array_key_exists($fldname, $this->fields) && ($this->fields[$fldname]->Visible || $this->fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
					$fld = &$this->fields[$fldname];
					if ($fld->HtmlTag == "FILE") { // Upload field
						if (EmptyValue($val)) {
							$row[$fldname] = NULL;
						} else {
							if ($fld->DataType == DATATYPE_BLOB) {
								$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
									Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
									Config("API_FIELD_NAME") . "=" . $fld->Param . "&" .
									Config("API_KEY_NAME") . "=" . rawurlencode($this->getRecordKeyValue($ar)))); //*** need to add this? API may not be in the same folder
								$row[$fldname] = ["mimeType" => ContentType($val), "url" => $url];
							} elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
								$row[$fldname] = ["mimeType" => MimeContentType($val), "url" => FullUrl($fld->hrefPath() . $val)];
							} else { // Multiple files
								$files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
								$ar = [];
								foreach ($files as $file) {
									if (!EmptyValue($file))
										$ar[] = ["type" => MimeContentType($file), "url" => FullUrl($fld->hrefPath() . $file)];
								}
								$row[$fldname] = $ar;
							}
						}
					} else {
						$row[$fldname] = $val;
					}
				}
			}
		}
		return $row;
	}

	// Get record key value from array
	protected function getRecordKeyValue($ar)
	{
		$key = "";
		if (is_array($ar)) {
			$key .= @$ar['id'];
		}
		return $key;
	}

	/**
	 * Hide fields for add/edit
	 *
	 * @return void
	 */
	protected function hideFieldsForAddEdit()
	{
		if ($this->isAdd() || $this->isCopy() || $this->isGridAdd())
			$this->id->Visible = FALSE;
	}

	// Lookup data
	public function lookup()
	{
		global $Language, $Security;
		if (!isset($Language))
			$Language = new Language(Config("LANGUAGE_FOLDER"), Post("language", ""));

		// Set up API request
		if (!$this->setupApiRequest())
			return FALSE;

		// Get lookup object
		$fieldName = Post("field");
		if (!array_key_exists($fieldName, $this->fields))
			return FALSE;
		$lookupField = $this->fields[$fieldName];
		$lookup = $lookupField->Lookup;
		if ($lookup === NULL)
			return FALSE;

		// Get lookup parameters
		$lookupType = Post("ajax", "unknown");
		$pageSize = -1;
		$offset = -1;
		$searchValue = "";
		if (SameText($lookupType, "modal")) {
			$searchValue = Post("sv", "");
			$pageSize = Post("recperpage", 10);
			$offset = Post("start", 0);
		} elseif (SameText($lookupType, "autosuggest")) {
			$searchValue = Get("q", "");
			$pageSize = Param("n", -1);
			$pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
			if ($pageSize <= 0)
				$pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
			$start = Param("start", -1);
			$start = is_numeric($start) ? (int)$start : -1;
			$page = Param("page", -1);
			$page = is_numeric($page) ? (int)$page : -1;
			$offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
		}
		$userSelect = Decrypt(Post("s", ""));
		$userFilter = Decrypt(Post("f", ""));
		$userOrderBy = Decrypt(Post("o", ""));
		$keys = Post("keys");
		$lookup->LookupType = $lookupType; // Lookup type
		if ($keys !== NULL) { // Selected records from modal
			if (is_array($keys))
				$keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
			$lookup->FilterValues[] = $keys; // Lookup values
		} else { // Lookup values
			$lookup->FilterValues[] = Post("v0", Post("lookupValue", ""));
		}
		$cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
		for ($i = 1; $i <= $cnt; $i++)
			$lookup->FilterValues[] = Post("v" . $i, "");
		$lookup->SearchValue = $searchValue;
		$lookup->PageSize = $pageSize;
		$lookup->Offset = $offset;
		if ($userSelect != "")
			$lookup->UserSelect = $userSelect;
		if ($userFilter != "")
			$lookup->UserFilter = $userFilter;
		if ($userOrderBy != "")
			$lookup->UserOrderBy = $userOrderBy;
		$lookup->toJson($this); // Use settings from current page
	}

	// Set up API request
	public function setupApiRequest()
	{
		global $Security;

		// Check security for API request
		If (ValidApiRequest()) {
			return TRUE;
		}
		return FALSE;
	}

	// Class variables
	public $ListOptions; // List options
	public $ExportOptions; // Export options
	public $SearchOptions; // Search options
	public $OtherOptions; // Other options
	public $FilterOptions; // Filter options
	public $ImportOptions; // Import options
	public $ListActions; // List actions
	public $SelectedCount = 0;
	public $SelectedIndex = 0;
	public $DisplayRecords = 20;
	public $StartRecord;
	public $StopRecord;
	public $TotalRecords = 0;
	public $RecordRange = 10;
	public $PageSizes = "10,20,50,-1"; // Page sizes (comma separated)
	public $DefaultSearchWhere = ""; // Default search WHERE clause
	public $SearchWhere = ""; // Search WHERE clause
	public $SearchPanelClass = "ew-search-panel collapse show"; // Search Panel class
	public $SearchRowCount = 0; // For extended search
	public $SearchColumnCount = 0; // For extended search
	public $SearchFieldsPerRow = 1; // For extended search
	public $RecordCount = 0; // Record count
	public $EditRowCount;
	public $StartRowCount = 1;
	public $RowCount = 0;
	public $Attrs = []; // Row attributes and cell attributes
	public $RowIndex = 0; // Row index
	public $KeyCount = 0; // Key count
	public $RowAction = ""; // Row action
	public $RowOldKey = ""; // Row old key (for copy)
	public $MultiColumnClass = "col-sm";
	public $MultiColumnEditClass = "w-100";
	public $DbMasterFilter = ""; // Master filter
	public $DbDetailFilter = ""; // Detail filter
	public $MasterRecordExists;
	public $MultiSelectKey;
	public $Command;
	public $RestoreSearch = FALSE;
	public $DetailPages;
	public $OldRecordset;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$FormError, $SearchError;

		// User profile
		$UserProfile = new UserProfile();

		// Security
		if (!$this->setupApiRequest()) {
			$Security = new AdvancedSecurity();
		}
		$this->CurrentAction = Param("action"); // Set up current action

		// Get grid add count
		$gridaddcnt = Get(Config("TABLE_GRID_ADD_ROW_COUNT"), "");
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$this->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->setupListOptions();
		$this->id->setVisibility();
		$this->fecha->setVisibility();
		$this->hora->setVisibility();
		$this->audio->setVisibility();
		$this->st->setVisibility();
		$this->fechaHoraIni->setVisibility();
		$this->fechaHoraFin->setVisibility();
		$this->telefono->setVisibility();
		$this->agente->setVisibility();
		$this->fechabo->setVisibility();
		$this->agentebo->setVisibility();
		$this->comentariosbo->Visible = FALSE;
		$this->IP->setVisibility();
		$this->actual->setVisibility();
		$this->completado->setVisibility();
		$this->_2_1_R->Visible = FALSE;
		$this->_2_2_R->Visible = FALSE;
		$this->_2_3_R->Visible = FALSE;
		$this->_3_4_R->Visible = FALSE;
		$this->_4_5_R->Visible = FALSE;
		$this->_4_6_R->Visible = FALSE;
		$this->_4_7_R->Visible = FALSE;
		$this->_4_8_R->Visible = FALSE;
		$this->_5_9_R->Visible = FALSE;
		$this->_5_10_R->Visible = FALSE;
		$this->_5_11_R->Visible = FALSE;
		$this->_5_12_R->Visible = FALSE;
		$this->_5_13_R->Visible = FALSE;
		$this->_5_14_R->Visible = FALSE;
		$this->_5_51_R->Visible = FALSE;
		$this->_6_15_R->Visible = FALSE;
		$this->_6_16_R->Visible = FALSE;
		$this->_6_17_R->Visible = FALSE;
		$this->_6_18_R->Visible = FALSE;
		$this->_6_19_R->Visible = FALSE;
		$this->_6_20_R->Visible = FALSE;
		$this->_6_52_R->Visible = FALSE;
		$this->_7_21_R->Visible = FALSE;
		$this->_8_22_R->Visible = FALSE;
		$this->_8_23_R->Visible = FALSE;
		$this->_8_24_R->Visible = FALSE;
		$this->_8_25_R->Visible = FALSE;
		$this->_9_26_R->Visible = FALSE;
		$this->_9_27_R->Visible = FALSE;
		$this->_9_28_R->Visible = FALSE;
		$this->_9_29_R->Visible = FALSE;
		$this->_9_30_R->Visible = FALSE;
		$this->_9_31_R->Visible = FALSE;
		$this->_9_32_R->Visible = FALSE;
		$this->_9_33_R->Visible = FALSE;
		$this->_9_34_R->Visible = FALSE;
		$this->_9_35_R->Visible = FALSE;
		$this->_9_36_R->Visible = FALSE;
		$this->_9_37_R->Visible = FALSE;
		$this->_9_38_R->Visible = FALSE;
		$this->_9_39_R->Visible = FALSE;
		$this->_10_40_R->Visible = FALSE;
		$this->_10_41_R->Visible = FALSE;
		$this->_11_42_R->Visible = FALSE;
		$this->_11_43_R->Visible = FALSE;
		$this->_12_44_R->Visible = FALSE;
		$this->_12_45_R->Visible = FALSE;
		$this->_12_46_R->Visible = FALSE;
		$this->_12_47_R->Visible = FALSE;
		$this->_12_48_R->Visible = FALSE;
		$this->_12_49_R->Visible = FALSE;
		$this->_12_50_R->Visible = FALSE;
		$this->_1__R->Visible = FALSE;
		$this->_13_54_R->Visible = FALSE;
		$this->_13_54_1_R->Visible = FALSE;
		$this->_13_54_2_R->Visible = FALSE;
		$this->_13_55_R->Visible = FALSE;
		$this->_13_55_1_R->Visible = FALSE;
		$this->_13_55_2_R->Visible = FALSE;
		$this->_13_56_R->Visible = FALSE;
		$this->_13_56_1_R->Visible = FALSE;
		$this->_13_56_2_R->Visible = FALSE;
		$this->_12_53_R->Visible = FALSE;
		$this->_12_53_1_R->Visible = FALSE;
		$this->_12_53_2_R->Visible = FALSE;
		$this->_12_53_3_R->Visible = FALSE;
		$this->_12_53_4_R->Visible = FALSE;
		$this->_12_53_5_R->Visible = FALSE;
		$this->_12_53_6_R->Visible = FALSE;
		$this->_13_57_R->Visible = FALSE;
		$this->_13_57_1_R->Visible = FALSE;
		$this->_13_57_2_R->Visible = FALSE;
		$this->_13_58_R->Visible = FALSE;
		$this->_13_58_1_R->Visible = FALSE;
		$this->_13_58_2_R->Visible = FALSE;
		$this->_13_59_R->Visible = FALSE;
		$this->_13_59_1_R->Visible = FALSE;
		$this->_13_59_2_R->Visible = FALSE;
		$this->_13_60_R->Visible = FALSE;
		$this->_12_53_7_R->Visible = FALSE;
		$this->_12_53_8_R->Visible = FALSE;
		$this->hideFieldsForAddEdit();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->validPost()) {
			Write($Language->phrase("InvalidPostRequest"));
			$this->terminate();
		}

		// Create Token
		$this->createToken();

		// Setup other options
		$this->setupOtherOptions();

		// Set up custom action (compatible with old version)
		foreach ($this->CustomActions as $name => $action)
			$this->ListActions->add($name, $action);

		// Show checkbox column if multiple action
		foreach ($this->ListActions->Items as $listaction) {
			if ($listaction->Select == ACTION_MULTIPLE && $listaction->Allow) {
				$this->ListOptions["checkbox"]->Visible = TRUE;
				break;
			}
		}

		// Set up lookup cache
		// Search filters

		$srchAdvanced = ""; // Advanced search filter
		$srchBasic = ""; // Basic search filter
		$filter = "";

		// Get command
		$this->Command = strtolower(Get("cmd"));
		if ($this->isPageRequest()) { // Validate request

			// Process list action first
			if ($this->processListAction()) // Ajax request
				$this->terminate();

			// Set up records per page
			$this->setupDisplayRecords();

			// Handle reset command
			$this->resetCmd();

			// Set up Breadcrumb
			if (!$this->isExport())
				$this->setupBreadcrumb();

			// Hide list options
			if ($this->isExport()) {
				$this->ListOptions->hideAllOptions(["sequence"]);
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			} elseif ($this->isGridAdd() || $this->isGridEdit()) {
				$this->ListOptions->hideAllOptions();
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			}

			// Hide options
			if ($this->isExport() || $this->CurrentAction) {
				$this->ExportOptions->hideAllOptions();
				$this->FilterOptions->hideAllOptions();
				$this->ImportOptions->hideAllOptions();
			}

			// Hide other options
			if ($this->isExport())
				$this->OtherOptions->hideAllOptions();

			// Get default search criteria
			AddFilter($this->DefaultSearchWhere, $this->basicSearchWhere(TRUE));

			// Get basic search values
			$this->loadBasicSearchValues();

			// Process filter list
			if ($this->processFilterList())
				$this->terminate();

			// Restore search parms from Session if not searching / reset / export
			if (($this->isExport() || $this->Command != "search" && $this->Command != "reset" && $this->Command != "resetall") && $this->Command != "json" && $this->checkSearchParms())
				$this->restoreSearchParms();

			// Call Recordset SearchValidated event
			$this->Recordset_SearchValidated();

			// Set up sorting order
			$this->setupSortOrder();

			// Get basic search criteria
			if ($SearchError == "")
				$srchBasic = $this->basicSearchWhere();
		}

		// Restore display records
		if ($this->Command != "json" && $this->getRecordsPerPage() != "") {
			$this->DisplayRecords = $this->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecords = 20; // Load default
			$this->setRecordsPerPage($this->DisplayRecords); // Save default to Session
		}

		// Load Sorting Order
		if ($this->Command != "json")
			$this->loadSortOrder();

		// Load search default if no existing search criteria
		if (!$this->checkSearchParms()) {

			// Load basic search from default
			$this->BasicSearch->loadDefault();
			if ($this->BasicSearch->Keyword != "")
				$srchBasic = $this->basicSearchWhere();
		}

		// Build search criteria
		AddFilter($this->SearchWhere, $srchAdvanced);
		AddFilter($this->SearchWhere, $srchBasic);

		// Call Recordset_Searching event
		$this->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->Command == "search" && !$this->RestoreSearch) {
			$this->setSearchWhere($this->SearchWhere); // Save to Session
			$this->StartRecord = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRecord);
		} elseif ($this->Command != "json") {
			$this->SearchWhere = $this->getSearchWhere();
		}

		// Build filter
		$filter = "";
		AddFilter($filter, $this->DbDetailFilter);
		AddFilter($filter, $this->SearchWhere);

		// Set up filter
		if ($this->Command == "json") {
			$this->UseSessionForListSql = FALSE; // Do not use session for ListSQL
			$this->CurrentFilter = $filter;
		} else {
			$this->setSessionWhere($filter);
			$this->CurrentFilter = "";
		}
		if ($this->isGridAdd()) {
			$this->CurrentFilter = "0=1";
			$this->StartRecord = 1;
			$this->DisplayRecords = $this->GridAddRowCount;
			$this->TotalRecords = $this->DisplayRecords;
			$this->StopRecord = $this->DisplayRecords;
		} else {
			$selectLimit = $this->UseSelectLimit;
			if ($selectLimit) {
				$this->TotalRecords = $this->listRecordCount();
			} else {
				if ($this->Recordset = $this->loadRecordset())
					$this->TotalRecords = $this->Recordset->RecordCount();
			}
			$this->StartRecord = 1;
			if ($this->DisplayRecords <= 0 || ($this->isExport() && $this->ExportAll)) // Display all records
				$this->DisplayRecords = $this->TotalRecords;
			if (!($this->isExport() && $this->ExportAll)) // Set up start record position
				$this->setupStartRecord();
			if ($selectLimit)
				$this->Recordset = $this->loadRecordset($this->StartRecord - 1, $this->DisplayRecords);

			// Set no record found message
			if (!$this->CurrentAction && $this->TotalRecords == 0) {
				if ($this->SearchWhere == "0=101")
					$this->setWarningMessage($Language->phrase("EnterSearchCriteria"));
				else
					$this->setWarningMessage($Language->phrase("NoRecord"));
			}
		}

		// Search options
		$this->setupSearchOptions();

		// Set up search panel class
		if ($this->SearchWhere != "")
			AppendClass($this->SearchPanelClass, "show");

		// Normal return
		if (IsApi()) {
			$rows = $this->getRecordsFromRecordset($this->Recordset);
			$this->Recordset->close();
			WriteJson(["success" => TRUE, $this->TableVar => $rows, "totalRecordCount" => $this->TotalRecords]);
			$this->terminate(TRUE);
		}

		// Set up pager
		$this->Pager = new PrevNextPager($this->StartRecord, $this->getRecordsPerPage(), $this->TotalRecords, $this->PageSizes, $this->RecordRange, $this->AutoHidePager, $this->AutoHidePageSizeSelector);
	}

	// Set up number of records displayed per page
	protected function setupDisplayRecords()
	{
		$wrk = Get(Config("TABLE_REC_PER_PAGE"), "");
		if ($wrk != "") {
			if (is_numeric($wrk)) {
				$this->DisplayRecords = (int)$wrk;
			} else {
				if (SameText($wrk, "all")) { // Display all records
					$this->DisplayRecords = -1;
				} else {
					$this->DisplayRecords = 20; // Non-numeric, load default
				}
			}
			$this->setRecordsPerPage($this->DisplayRecords); // Save to Session

			// Reset start position
			$this->StartRecord = 1;
			$this->setStartRecordNumber($this->StartRecord);
		}
	}

	// Build filter for all keys
	protected function buildKeyFilter()
	{
		global $CurrentForm;
		$wrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$CurrentForm->Index = $rowindex;
		$thisKey = strval($CurrentForm->getValue($this->FormKeyName));
		while ($thisKey != "") {
			if ($this->setupKeyValues($thisKey)) {
				$filter = $this->getRecordFilter();
				if ($wrkFilter != "")
					$wrkFilter .= " OR ";
				$wrkFilter .= $filter;
			} else {
				$wrkFilter = "0=1";
				break;
			}

			// Update row index and get row key
			$rowindex++; // Next row
			$CurrentForm->Index = $rowindex;
			$thisKey = strval($CurrentForm->getValue($this->FormKeyName));
		}
		return $wrkFilter;
	}

	// Set up key values
	protected function setupKeyValues($key)
	{
		$arKeyFlds = explode(Config("COMPOSITE_KEY_SEPARATOR"), $key);
		if (count($arKeyFlds) >= 1) {
			$this->id->setOldValue($arKeyFlds[0]);
			if (!is_numeric($this->id->OldValue))
				return FALSE;
		}
		return TRUE;
	}

	// Get list of filters
	public function getFilterList()
	{
		global $UserProfile;

		// Initialize
		$filterList = "";
		$savedFilterList = "";
		$filterList = Concat($filterList, $this->id->AdvancedSearch->toJson(), ","); // Field id
		$filterList = Concat($filterList, $this->fecha->AdvancedSearch->toJson(), ","); // Field fecha
		$filterList = Concat($filterList, $this->hora->AdvancedSearch->toJson(), ","); // Field hora
		$filterList = Concat($filterList, $this->audio->AdvancedSearch->toJson(), ","); // Field audio
		$filterList = Concat($filterList, $this->st->AdvancedSearch->toJson(), ","); // Field st
		$filterList = Concat($filterList, $this->fechaHoraIni->AdvancedSearch->toJson(), ","); // Field fechaHoraIni
		$filterList = Concat($filterList, $this->fechaHoraFin->AdvancedSearch->toJson(), ","); // Field fechaHoraFin
		$filterList = Concat($filterList, $this->telefono->AdvancedSearch->toJson(), ","); // Field telefono
		$filterList = Concat($filterList, $this->agente->AdvancedSearch->toJson(), ","); // Field agente
		$filterList = Concat($filterList, $this->fechabo->AdvancedSearch->toJson(), ","); // Field fechabo
		$filterList = Concat($filterList, $this->agentebo->AdvancedSearch->toJson(), ","); // Field agentebo
		$filterList = Concat($filterList, $this->comentariosbo->AdvancedSearch->toJson(), ","); // Field comentariosbo
		$filterList = Concat($filterList, $this->IP->AdvancedSearch->toJson(), ","); // Field IP
		$filterList = Concat($filterList, $this->actual->AdvancedSearch->toJson(), ","); // Field actual
		$filterList = Concat($filterList, $this->completado->AdvancedSearch->toJson(), ","); // Field completado
		$filterList = Concat($filterList, $this->_2_1_R->AdvancedSearch->toJson(), ","); // Field 2_1_R
		$filterList = Concat($filterList, $this->_2_2_R->AdvancedSearch->toJson(), ","); // Field 2_2_R
		$filterList = Concat($filterList, $this->_2_3_R->AdvancedSearch->toJson(), ","); // Field 2_3_R
		$filterList = Concat($filterList, $this->_3_4_R->AdvancedSearch->toJson(), ","); // Field 3_4_R
		$filterList = Concat($filterList, $this->_4_5_R->AdvancedSearch->toJson(), ","); // Field 4_5_R
		$filterList = Concat($filterList, $this->_4_6_R->AdvancedSearch->toJson(), ","); // Field 4_6_R
		$filterList = Concat($filterList, $this->_4_7_R->AdvancedSearch->toJson(), ","); // Field 4_7_R
		$filterList = Concat($filterList, $this->_4_8_R->AdvancedSearch->toJson(), ","); // Field 4_8_R
		$filterList = Concat($filterList, $this->_5_9_R->AdvancedSearch->toJson(), ","); // Field 5_9_R
		$filterList = Concat($filterList, $this->_5_10_R->AdvancedSearch->toJson(), ","); // Field 5_10_R
		$filterList = Concat($filterList, $this->_5_11_R->AdvancedSearch->toJson(), ","); // Field 5_11_R
		$filterList = Concat($filterList, $this->_5_12_R->AdvancedSearch->toJson(), ","); // Field 5_12_R
		$filterList = Concat($filterList, $this->_5_13_R->AdvancedSearch->toJson(), ","); // Field 5_13_R
		$filterList = Concat($filterList, $this->_5_14_R->AdvancedSearch->toJson(), ","); // Field 5_14_R
		$filterList = Concat($filterList, $this->_5_51_R->AdvancedSearch->toJson(), ","); // Field 5_51_R
		$filterList = Concat($filterList, $this->_6_15_R->AdvancedSearch->toJson(), ","); // Field 6_15_R
		$filterList = Concat($filterList, $this->_6_16_R->AdvancedSearch->toJson(), ","); // Field 6_16_R
		$filterList = Concat($filterList, $this->_6_17_R->AdvancedSearch->toJson(), ","); // Field 6_17_R
		$filterList = Concat($filterList, $this->_6_18_R->AdvancedSearch->toJson(), ","); // Field 6_18_R
		$filterList = Concat($filterList, $this->_6_19_R->AdvancedSearch->toJson(), ","); // Field 6_19_R
		$filterList = Concat($filterList, $this->_6_20_R->AdvancedSearch->toJson(), ","); // Field 6_20_R
		$filterList = Concat($filterList, $this->_6_52_R->AdvancedSearch->toJson(), ","); // Field 6_52_R
		$filterList = Concat($filterList, $this->_7_21_R->AdvancedSearch->toJson(), ","); // Field 7_21_R
		$filterList = Concat($filterList, $this->_8_22_R->AdvancedSearch->toJson(), ","); // Field 8_22_R
		$filterList = Concat($filterList, $this->_8_23_R->AdvancedSearch->toJson(), ","); // Field 8_23_R
		$filterList = Concat($filterList, $this->_8_24_R->AdvancedSearch->toJson(), ","); // Field 8_24_R
		$filterList = Concat($filterList, $this->_8_25_R->AdvancedSearch->toJson(), ","); // Field 8_25_R
		$filterList = Concat($filterList, $this->_9_26_R->AdvancedSearch->toJson(), ","); // Field 9_26_R
		$filterList = Concat($filterList, $this->_9_27_R->AdvancedSearch->toJson(), ","); // Field 9_27_R
		$filterList = Concat($filterList, $this->_9_28_R->AdvancedSearch->toJson(), ","); // Field 9_28_R
		$filterList = Concat($filterList, $this->_9_29_R->AdvancedSearch->toJson(), ","); // Field 9_29_R
		$filterList = Concat($filterList, $this->_9_30_R->AdvancedSearch->toJson(), ","); // Field 9_30_R
		$filterList = Concat($filterList, $this->_9_31_R->AdvancedSearch->toJson(), ","); // Field 9_31_R
		$filterList = Concat($filterList, $this->_9_32_R->AdvancedSearch->toJson(), ","); // Field 9_32_R
		$filterList = Concat($filterList, $this->_9_33_R->AdvancedSearch->toJson(), ","); // Field 9_33_R
		$filterList = Concat($filterList, $this->_9_34_R->AdvancedSearch->toJson(), ","); // Field 9_34_R
		$filterList = Concat($filterList, $this->_9_35_R->AdvancedSearch->toJson(), ","); // Field 9_35_R
		$filterList = Concat($filterList, $this->_9_36_R->AdvancedSearch->toJson(), ","); // Field 9_36_R
		$filterList = Concat($filterList, $this->_9_37_R->AdvancedSearch->toJson(), ","); // Field 9_37_R
		$filterList = Concat($filterList, $this->_9_38_R->AdvancedSearch->toJson(), ","); // Field 9_38_R
		$filterList = Concat($filterList, $this->_9_39_R->AdvancedSearch->toJson(), ","); // Field 9_39_R
		$filterList = Concat($filterList, $this->_10_40_R->AdvancedSearch->toJson(), ","); // Field 10_40_R
		$filterList = Concat($filterList, $this->_10_41_R->AdvancedSearch->toJson(), ","); // Field 10_41_R
		$filterList = Concat($filterList, $this->_11_42_R->AdvancedSearch->toJson(), ","); // Field 11_42_R
		$filterList = Concat($filterList, $this->_11_43_R->AdvancedSearch->toJson(), ","); // Field 11_43_R
		$filterList = Concat($filterList, $this->_12_44_R->AdvancedSearch->toJson(), ","); // Field 12_44_R
		$filterList = Concat($filterList, $this->_12_45_R->AdvancedSearch->toJson(), ","); // Field 12_45_R
		$filterList = Concat($filterList, $this->_12_46_R->AdvancedSearch->toJson(), ","); // Field 12_46_R
		$filterList = Concat($filterList, $this->_12_47_R->AdvancedSearch->toJson(), ","); // Field 12_47_R
		$filterList = Concat($filterList, $this->_12_48_R->AdvancedSearch->toJson(), ","); // Field 12_48_R
		$filterList = Concat($filterList, $this->_12_49_R->AdvancedSearch->toJson(), ","); // Field 12_49_R
		$filterList = Concat($filterList, $this->_12_50_R->AdvancedSearch->toJson(), ","); // Field 12_50_R
		$filterList = Concat($filterList, $this->_1__R->AdvancedSearch->toJson(), ","); // Field 1__R
		$filterList = Concat($filterList, $this->_13_54_R->AdvancedSearch->toJson(), ","); // Field 13_54_R
		$filterList = Concat($filterList, $this->_13_54_1_R->AdvancedSearch->toJson(), ","); // Field 13_54_1_R
		$filterList = Concat($filterList, $this->_13_54_2_R->AdvancedSearch->toJson(), ","); // Field 13_54_2_R
		$filterList = Concat($filterList, $this->_13_55_R->AdvancedSearch->toJson(), ","); // Field 13_55_R
		$filterList = Concat($filterList, $this->_13_55_1_R->AdvancedSearch->toJson(), ","); // Field 13_55_1_R
		$filterList = Concat($filterList, $this->_13_55_2_R->AdvancedSearch->toJson(), ","); // Field 13_55_2_R
		$filterList = Concat($filterList, $this->_13_56_R->AdvancedSearch->toJson(), ","); // Field 13_56_R
		$filterList = Concat($filterList, $this->_13_56_1_R->AdvancedSearch->toJson(), ","); // Field 13_56_1_R
		$filterList = Concat($filterList, $this->_13_56_2_R->AdvancedSearch->toJson(), ","); // Field 13_56_2_R
		$filterList = Concat($filterList, $this->_12_53_R->AdvancedSearch->toJson(), ","); // Field 12_53_R
		$filterList = Concat($filterList, $this->_12_53_1_R->AdvancedSearch->toJson(), ","); // Field 12_53_1_R
		$filterList = Concat($filterList, $this->_12_53_2_R->AdvancedSearch->toJson(), ","); // Field 12_53_2_R
		$filterList = Concat($filterList, $this->_12_53_3_R->AdvancedSearch->toJson(), ","); // Field 12_53_3_R
		$filterList = Concat($filterList, $this->_12_53_4_R->AdvancedSearch->toJson(), ","); // Field 12_53_4_R
		$filterList = Concat($filterList, $this->_12_53_5_R->AdvancedSearch->toJson(), ","); // Field 12_53_5_R
		$filterList = Concat($filterList, $this->_12_53_6_R->AdvancedSearch->toJson(), ","); // Field 12_53_6_R
		$filterList = Concat($filterList, $this->_13_57_R->AdvancedSearch->toJson(), ","); // Field 13_57_R
		$filterList = Concat($filterList, $this->_13_57_1_R->AdvancedSearch->toJson(), ","); // Field 13_57_1_R
		$filterList = Concat($filterList, $this->_13_57_2_R->AdvancedSearch->toJson(), ","); // Field 13_57_2_R
		$filterList = Concat($filterList, $this->_13_58_R->AdvancedSearch->toJson(), ","); // Field 13_58_R
		$filterList = Concat($filterList, $this->_13_58_1_R->AdvancedSearch->toJson(), ","); // Field 13_58_1_R
		$filterList = Concat($filterList, $this->_13_58_2_R->AdvancedSearch->toJson(), ","); // Field 13_58_2_R
		$filterList = Concat($filterList, $this->_13_59_R->AdvancedSearch->toJson(), ","); // Field 13_59_R
		$filterList = Concat($filterList, $this->_13_59_1_R->AdvancedSearch->toJson(), ","); // Field 13_59_1_R
		$filterList = Concat($filterList, $this->_13_59_2_R->AdvancedSearch->toJson(), ","); // Field 13_59_2_R
		$filterList = Concat($filterList, $this->_13_60_R->AdvancedSearch->toJson(), ","); // Field 13_60_R
		$filterList = Concat($filterList, $this->_12_53_7_R->AdvancedSearch->toJson(), ","); // Field 12_53_7_R
		$filterList = Concat($filterList, $this->_12_53_8_R->AdvancedSearch->toJson(), ","); // Field 12_53_8_R
		if ($this->BasicSearch->Keyword != "") {
			$wrk = "\"" . Config("TABLE_BASIC_SEARCH") . "\":\"" . JsEncode($this->BasicSearch->Keyword) . "\",\"" . Config("TABLE_BASIC_SEARCH_TYPE") . "\":\"" . JsEncode($this->BasicSearch->Type) . "\"";
			$filterList = Concat($filterList, $wrk, ",");
		}

		// Return filter list in JSON
		if ($filterList != "")
			$filterList = "\"data\":{" . $filterList . "}";
		if ($savedFilterList != "")
			$filterList = Concat($filterList, "\"filters\":" . $savedFilterList, ",");
		return ($filterList != "") ? "{" . $filterList . "}" : "null";
	}

	// Process filter list
	protected function processFilterList()
	{
		global $UserProfile;
		if (Post("ajax") == "savefilters") { // Save filter request (Ajax)
			$filters = Post("filters");
			$UserProfile->setSearchFilters(CurrentUserName(), "fbdvlistsrch", $filters);
			WriteJson([["success" => TRUE]]); // Success
			return TRUE;
		} elseif (Post("cmd") == "resetfilter") {
			$this->restoreFilterList();
		}
		return FALSE;
	}

	// Restore list of filters
	protected function restoreFilterList()
	{

		// Return if not reset filter
		if (Post("cmd") !== "resetfilter")
			return FALSE;
		$filter = json_decode(Post("filter"), TRUE);
		$this->Command = "search";

		// Field id
		$this->id->AdvancedSearch->SearchValue = @$filter["x_id"];
		$this->id->AdvancedSearch->SearchOperator = @$filter["z_id"];
		$this->id->AdvancedSearch->SearchCondition = @$filter["v_id"];
		$this->id->AdvancedSearch->SearchValue2 = @$filter["y_id"];
		$this->id->AdvancedSearch->SearchOperator2 = @$filter["w_id"];
		$this->id->AdvancedSearch->save();

		// Field fecha
		$this->fecha->AdvancedSearch->SearchValue = @$filter["x_fecha"];
		$this->fecha->AdvancedSearch->SearchOperator = @$filter["z_fecha"];
		$this->fecha->AdvancedSearch->SearchCondition = @$filter["v_fecha"];
		$this->fecha->AdvancedSearch->SearchValue2 = @$filter["y_fecha"];
		$this->fecha->AdvancedSearch->SearchOperator2 = @$filter["w_fecha"];
		$this->fecha->AdvancedSearch->save();

		// Field hora
		$this->hora->AdvancedSearch->SearchValue = @$filter["x_hora"];
		$this->hora->AdvancedSearch->SearchOperator = @$filter["z_hora"];
		$this->hora->AdvancedSearch->SearchCondition = @$filter["v_hora"];
		$this->hora->AdvancedSearch->SearchValue2 = @$filter["y_hora"];
		$this->hora->AdvancedSearch->SearchOperator2 = @$filter["w_hora"];
		$this->hora->AdvancedSearch->save();

		// Field audio
		$this->audio->AdvancedSearch->SearchValue = @$filter["x_audio"];
		$this->audio->AdvancedSearch->SearchOperator = @$filter["z_audio"];
		$this->audio->AdvancedSearch->SearchCondition = @$filter["v_audio"];
		$this->audio->AdvancedSearch->SearchValue2 = @$filter["y_audio"];
		$this->audio->AdvancedSearch->SearchOperator2 = @$filter["w_audio"];
		$this->audio->AdvancedSearch->save();

		// Field st
		$this->st->AdvancedSearch->SearchValue = @$filter["x_st"];
		$this->st->AdvancedSearch->SearchOperator = @$filter["z_st"];
		$this->st->AdvancedSearch->SearchCondition = @$filter["v_st"];
		$this->st->AdvancedSearch->SearchValue2 = @$filter["y_st"];
		$this->st->AdvancedSearch->SearchOperator2 = @$filter["w_st"];
		$this->st->AdvancedSearch->save();

		// Field fechaHoraIni
		$this->fechaHoraIni->AdvancedSearch->SearchValue = @$filter["x_fechaHoraIni"];
		$this->fechaHoraIni->AdvancedSearch->SearchOperator = @$filter["z_fechaHoraIni"];
		$this->fechaHoraIni->AdvancedSearch->SearchCondition = @$filter["v_fechaHoraIni"];
		$this->fechaHoraIni->AdvancedSearch->SearchValue2 = @$filter["y_fechaHoraIni"];
		$this->fechaHoraIni->AdvancedSearch->SearchOperator2 = @$filter["w_fechaHoraIni"];
		$this->fechaHoraIni->AdvancedSearch->save();

		// Field fechaHoraFin
		$this->fechaHoraFin->AdvancedSearch->SearchValue = @$filter["x_fechaHoraFin"];
		$this->fechaHoraFin->AdvancedSearch->SearchOperator = @$filter["z_fechaHoraFin"];
		$this->fechaHoraFin->AdvancedSearch->SearchCondition = @$filter["v_fechaHoraFin"];
		$this->fechaHoraFin->AdvancedSearch->SearchValue2 = @$filter["y_fechaHoraFin"];
		$this->fechaHoraFin->AdvancedSearch->SearchOperator2 = @$filter["w_fechaHoraFin"];
		$this->fechaHoraFin->AdvancedSearch->save();

		// Field telefono
		$this->telefono->AdvancedSearch->SearchValue = @$filter["x_telefono"];
		$this->telefono->AdvancedSearch->SearchOperator = @$filter["z_telefono"];
		$this->telefono->AdvancedSearch->SearchCondition = @$filter["v_telefono"];
		$this->telefono->AdvancedSearch->SearchValue2 = @$filter["y_telefono"];
		$this->telefono->AdvancedSearch->SearchOperator2 = @$filter["w_telefono"];
		$this->telefono->AdvancedSearch->save();

		// Field agente
		$this->agente->AdvancedSearch->SearchValue = @$filter["x_agente"];
		$this->agente->AdvancedSearch->SearchOperator = @$filter["z_agente"];
		$this->agente->AdvancedSearch->SearchCondition = @$filter["v_agente"];
		$this->agente->AdvancedSearch->SearchValue2 = @$filter["y_agente"];
		$this->agente->AdvancedSearch->SearchOperator2 = @$filter["w_agente"];
		$this->agente->AdvancedSearch->save();

		// Field fechabo
		$this->fechabo->AdvancedSearch->SearchValue = @$filter["x_fechabo"];
		$this->fechabo->AdvancedSearch->SearchOperator = @$filter["z_fechabo"];
		$this->fechabo->AdvancedSearch->SearchCondition = @$filter["v_fechabo"];
		$this->fechabo->AdvancedSearch->SearchValue2 = @$filter["y_fechabo"];
		$this->fechabo->AdvancedSearch->SearchOperator2 = @$filter["w_fechabo"];
		$this->fechabo->AdvancedSearch->save();

		// Field agentebo
		$this->agentebo->AdvancedSearch->SearchValue = @$filter["x_agentebo"];
		$this->agentebo->AdvancedSearch->SearchOperator = @$filter["z_agentebo"];
		$this->agentebo->AdvancedSearch->SearchCondition = @$filter["v_agentebo"];
		$this->agentebo->AdvancedSearch->SearchValue2 = @$filter["y_agentebo"];
		$this->agentebo->AdvancedSearch->SearchOperator2 = @$filter["w_agentebo"];
		$this->agentebo->AdvancedSearch->save();

		// Field comentariosbo
		$this->comentariosbo->AdvancedSearch->SearchValue = @$filter["x_comentariosbo"];
		$this->comentariosbo->AdvancedSearch->SearchOperator = @$filter["z_comentariosbo"];
		$this->comentariosbo->AdvancedSearch->SearchCondition = @$filter["v_comentariosbo"];
		$this->comentariosbo->AdvancedSearch->SearchValue2 = @$filter["y_comentariosbo"];
		$this->comentariosbo->AdvancedSearch->SearchOperator2 = @$filter["w_comentariosbo"];
		$this->comentariosbo->AdvancedSearch->save();

		// Field IP
		$this->IP->AdvancedSearch->SearchValue = @$filter["x_IP"];
		$this->IP->AdvancedSearch->SearchOperator = @$filter["z_IP"];
		$this->IP->AdvancedSearch->SearchCondition = @$filter["v_IP"];
		$this->IP->AdvancedSearch->SearchValue2 = @$filter["y_IP"];
		$this->IP->AdvancedSearch->SearchOperator2 = @$filter["w_IP"];
		$this->IP->AdvancedSearch->save();

		// Field actual
		$this->actual->AdvancedSearch->SearchValue = @$filter["x_actual"];
		$this->actual->AdvancedSearch->SearchOperator = @$filter["z_actual"];
		$this->actual->AdvancedSearch->SearchCondition = @$filter["v_actual"];
		$this->actual->AdvancedSearch->SearchValue2 = @$filter["y_actual"];
		$this->actual->AdvancedSearch->SearchOperator2 = @$filter["w_actual"];
		$this->actual->AdvancedSearch->save();

		// Field completado
		$this->completado->AdvancedSearch->SearchValue = @$filter["x_completado"];
		$this->completado->AdvancedSearch->SearchOperator = @$filter["z_completado"];
		$this->completado->AdvancedSearch->SearchCondition = @$filter["v_completado"];
		$this->completado->AdvancedSearch->SearchValue2 = @$filter["y_completado"];
		$this->completado->AdvancedSearch->SearchOperator2 = @$filter["w_completado"];
		$this->completado->AdvancedSearch->save();

		// Field 2_1_R
		$this->_2_1_R->AdvancedSearch->SearchValue = @$filter["x__2_1_R"];
		$this->_2_1_R->AdvancedSearch->SearchOperator = @$filter["z__2_1_R"];
		$this->_2_1_R->AdvancedSearch->SearchCondition = @$filter["v__2_1_R"];
		$this->_2_1_R->AdvancedSearch->SearchValue2 = @$filter["y__2_1_R"];
		$this->_2_1_R->AdvancedSearch->SearchOperator2 = @$filter["w__2_1_R"];
		$this->_2_1_R->AdvancedSearch->save();

		// Field 2_2_R
		$this->_2_2_R->AdvancedSearch->SearchValue = @$filter["x__2_2_R"];
		$this->_2_2_R->AdvancedSearch->SearchOperator = @$filter["z__2_2_R"];
		$this->_2_2_R->AdvancedSearch->SearchCondition = @$filter["v__2_2_R"];
		$this->_2_2_R->AdvancedSearch->SearchValue2 = @$filter["y__2_2_R"];
		$this->_2_2_R->AdvancedSearch->SearchOperator2 = @$filter["w__2_2_R"];
		$this->_2_2_R->AdvancedSearch->save();

		// Field 2_3_R
		$this->_2_3_R->AdvancedSearch->SearchValue = @$filter["x__2_3_R"];
		$this->_2_3_R->AdvancedSearch->SearchOperator = @$filter["z__2_3_R"];
		$this->_2_3_R->AdvancedSearch->SearchCondition = @$filter["v__2_3_R"];
		$this->_2_3_R->AdvancedSearch->SearchValue2 = @$filter["y__2_3_R"];
		$this->_2_3_R->AdvancedSearch->SearchOperator2 = @$filter["w__2_3_R"];
		$this->_2_3_R->AdvancedSearch->save();

		// Field 3_4_R
		$this->_3_4_R->AdvancedSearch->SearchValue = @$filter["x__3_4_R"];
		$this->_3_4_R->AdvancedSearch->SearchOperator = @$filter["z__3_4_R"];
		$this->_3_4_R->AdvancedSearch->SearchCondition = @$filter["v__3_4_R"];
		$this->_3_4_R->AdvancedSearch->SearchValue2 = @$filter["y__3_4_R"];
		$this->_3_4_R->AdvancedSearch->SearchOperator2 = @$filter["w__3_4_R"];
		$this->_3_4_R->AdvancedSearch->save();

		// Field 4_5_R
		$this->_4_5_R->AdvancedSearch->SearchValue = @$filter["x__4_5_R"];
		$this->_4_5_R->AdvancedSearch->SearchOperator = @$filter["z__4_5_R"];
		$this->_4_5_R->AdvancedSearch->SearchCondition = @$filter["v__4_5_R"];
		$this->_4_5_R->AdvancedSearch->SearchValue2 = @$filter["y__4_5_R"];
		$this->_4_5_R->AdvancedSearch->SearchOperator2 = @$filter["w__4_5_R"];
		$this->_4_5_R->AdvancedSearch->save();

		// Field 4_6_R
		$this->_4_6_R->AdvancedSearch->SearchValue = @$filter["x__4_6_R"];
		$this->_4_6_R->AdvancedSearch->SearchOperator = @$filter["z__4_6_R"];
		$this->_4_6_R->AdvancedSearch->SearchCondition = @$filter["v__4_6_R"];
		$this->_4_6_R->AdvancedSearch->SearchValue2 = @$filter["y__4_6_R"];
		$this->_4_6_R->AdvancedSearch->SearchOperator2 = @$filter["w__4_6_R"];
		$this->_4_6_R->AdvancedSearch->save();

		// Field 4_7_R
		$this->_4_7_R->AdvancedSearch->SearchValue = @$filter["x__4_7_R"];
		$this->_4_7_R->AdvancedSearch->SearchOperator = @$filter["z__4_7_R"];
		$this->_4_7_R->AdvancedSearch->SearchCondition = @$filter["v__4_7_R"];
		$this->_4_7_R->AdvancedSearch->SearchValue2 = @$filter["y__4_7_R"];
		$this->_4_7_R->AdvancedSearch->SearchOperator2 = @$filter["w__4_7_R"];
		$this->_4_7_R->AdvancedSearch->save();

		// Field 4_8_R
		$this->_4_8_R->AdvancedSearch->SearchValue = @$filter["x__4_8_R"];
		$this->_4_8_R->AdvancedSearch->SearchOperator = @$filter["z__4_8_R"];
		$this->_4_8_R->AdvancedSearch->SearchCondition = @$filter["v__4_8_R"];
		$this->_4_8_R->AdvancedSearch->SearchValue2 = @$filter["y__4_8_R"];
		$this->_4_8_R->AdvancedSearch->SearchOperator2 = @$filter["w__4_8_R"];
		$this->_4_8_R->AdvancedSearch->save();

		// Field 5_9_R
		$this->_5_9_R->AdvancedSearch->SearchValue = @$filter["x__5_9_R"];
		$this->_5_9_R->AdvancedSearch->SearchOperator = @$filter["z__5_9_R"];
		$this->_5_9_R->AdvancedSearch->SearchCondition = @$filter["v__5_9_R"];
		$this->_5_9_R->AdvancedSearch->SearchValue2 = @$filter["y__5_9_R"];
		$this->_5_9_R->AdvancedSearch->SearchOperator2 = @$filter["w__5_9_R"];
		$this->_5_9_R->AdvancedSearch->save();

		// Field 5_10_R
		$this->_5_10_R->AdvancedSearch->SearchValue = @$filter["x__5_10_R"];
		$this->_5_10_R->AdvancedSearch->SearchOperator = @$filter["z__5_10_R"];
		$this->_5_10_R->AdvancedSearch->SearchCondition = @$filter["v__5_10_R"];
		$this->_5_10_R->AdvancedSearch->SearchValue2 = @$filter["y__5_10_R"];
		$this->_5_10_R->AdvancedSearch->SearchOperator2 = @$filter["w__5_10_R"];
		$this->_5_10_R->AdvancedSearch->save();

		// Field 5_11_R
		$this->_5_11_R->AdvancedSearch->SearchValue = @$filter["x__5_11_R"];
		$this->_5_11_R->AdvancedSearch->SearchOperator = @$filter["z__5_11_R"];
		$this->_5_11_R->AdvancedSearch->SearchCondition = @$filter["v__5_11_R"];
		$this->_5_11_R->AdvancedSearch->SearchValue2 = @$filter["y__5_11_R"];
		$this->_5_11_R->AdvancedSearch->SearchOperator2 = @$filter["w__5_11_R"];
		$this->_5_11_R->AdvancedSearch->save();

		// Field 5_12_R
		$this->_5_12_R->AdvancedSearch->SearchValue = @$filter["x__5_12_R"];
		$this->_5_12_R->AdvancedSearch->SearchOperator = @$filter["z__5_12_R"];
		$this->_5_12_R->AdvancedSearch->SearchCondition = @$filter["v__5_12_R"];
		$this->_5_12_R->AdvancedSearch->SearchValue2 = @$filter["y__5_12_R"];
		$this->_5_12_R->AdvancedSearch->SearchOperator2 = @$filter["w__5_12_R"];
		$this->_5_12_R->AdvancedSearch->save();

		// Field 5_13_R
		$this->_5_13_R->AdvancedSearch->SearchValue = @$filter["x__5_13_R"];
		$this->_5_13_R->AdvancedSearch->SearchOperator = @$filter["z__5_13_R"];
		$this->_5_13_R->AdvancedSearch->SearchCondition = @$filter["v__5_13_R"];
		$this->_5_13_R->AdvancedSearch->SearchValue2 = @$filter["y__5_13_R"];
		$this->_5_13_R->AdvancedSearch->SearchOperator2 = @$filter["w__5_13_R"];
		$this->_5_13_R->AdvancedSearch->save();

		// Field 5_14_R
		$this->_5_14_R->AdvancedSearch->SearchValue = @$filter["x__5_14_R"];
		$this->_5_14_R->AdvancedSearch->SearchOperator = @$filter["z__5_14_R"];
		$this->_5_14_R->AdvancedSearch->SearchCondition = @$filter["v__5_14_R"];
		$this->_5_14_R->AdvancedSearch->SearchValue2 = @$filter["y__5_14_R"];
		$this->_5_14_R->AdvancedSearch->SearchOperator2 = @$filter["w__5_14_R"];
		$this->_5_14_R->AdvancedSearch->save();

		// Field 5_51_R
		$this->_5_51_R->AdvancedSearch->SearchValue = @$filter["x__5_51_R"];
		$this->_5_51_R->AdvancedSearch->SearchOperator = @$filter["z__5_51_R"];
		$this->_5_51_R->AdvancedSearch->SearchCondition = @$filter["v__5_51_R"];
		$this->_5_51_R->AdvancedSearch->SearchValue2 = @$filter["y__5_51_R"];
		$this->_5_51_R->AdvancedSearch->SearchOperator2 = @$filter["w__5_51_R"];
		$this->_5_51_R->AdvancedSearch->save();

		// Field 6_15_R
		$this->_6_15_R->AdvancedSearch->SearchValue = @$filter["x__6_15_R"];
		$this->_6_15_R->AdvancedSearch->SearchOperator = @$filter["z__6_15_R"];
		$this->_6_15_R->AdvancedSearch->SearchCondition = @$filter["v__6_15_R"];
		$this->_6_15_R->AdvancedSearch->SearchValue2 = @$filter["y__6_15_R"];
		$this->_6_15_R->AdvancedSearch->SearchOperator2 = @$filter["w__6_15_R"];
		$this->_6_15_R->AdvancedSearch->save();

		// Field 6_16_R
		$this->_6_16_R->AdvancedSearch->SearchValue = @$filter["x__6_16_R"];
		$this->_6_16_R->AdvancedSearch->SearchOperator = @$filter["z__6_16_R"];
		$this->_6_16_R->AdvancedSearch->SearchCondition = @$filter["v__6_16_R"];
		$this->_6_16_R->AdvancedSearch->SearchValue2 = @$filter["y__6_16_R"];
		$this->_6_16_R->AdvancedSearch->SearchOperator2 = @$filter["w__6_16_R"];
		$this->_6_16_R->AdvancedSearch->save();

		// Field 6_17_R
		$this->_6_17_R->AdvancedSearch->SearchValue = @$filter["x__6_17_R"];
		$this->_6_17_R->AdvancedSearch->SearchOperator = @$filter["z__6_17_R"];
		$this->_6_17_R->AdvancedSearch->SearchCondition = @$filter["v__6_17_R"];
		$this->_6_17_R->AdvancedSearch->SearchValue2 = @$filter["y__6_17_R"];
		$this->_6_17_R->AdvancedSearch->SearchOperator2 = @$filter["w__6_17_R"];
		$this->_6_17_R->AdvancedSearch->save();

		// Field 6_18_R
		$this->_6_18_R->AdvancedSearch->SearchValue = @$filter["x__6_18_R"];
		$this->_6_18_R->AdvancedSearch->SearchOperator = @$filter["z__6_18_R"];
		$this->_6_18_R->AdvancedSearch->SearchCondition = @$filter["v__6_18_R"];
		$this->_6_18_R->AdvancedSearch->SearchValue2 = @$filter["y__6_18_R"];
		$this->_6_18_R->AdvancedSearch->SearchOperator2 = @$filter["w__6_18_R"];
		$this->_6_18_R->AdvancedSearch->save();

		// Field 6_19_R
		$this->_6_19_R->AdvancedSearch->SearchValue = @$filter["x__6_19_R"];
		$this->_6_19_R->AdvancedSearch->SearchOperator = @$filter["z__6_19_R"];
		$this->_6_19_R->AdvancedSearch->SearchCondition = @$filter["v__6_19_R"];
		$this->_6_19_R->AdvancedSearch->SearchValue2 = @$filter["y__6_19_R"];
		$this->_6_19_R->AdvancedSearch->SearchOperator2 = @$filter["w__6_19_R"];
		$this->_6_19_R->AdvancedSearch->save();

		// Field 6_20_R
		$this->_6_20_R->AdvancedSearch->SearchValue = @$filter["x__6_20_R"];
		$this->_6_20_R->AdvancedSearch->SearchOperator = @$filter["z__6_20_R"];
		$this->_6_20_R->AdvancedSearch->SearchCondition = @$filter["v__6_20_R"];
		$this->_6_20_R->AdvancedSearch->SearchValue2 = @$filter["y__6_20_R"];
		$this->_6_20_R->AdvancedSearch->SearchOperator2 = @$filter["w__6_20_R"];
		$this->_6_20_R->AdvancedSearch->save();

		// Field 6_52_R
		$this->_6_52_R->AdvancedSearch->SearchValue = @$filter["x__6_52_R"];
		$this->_6_52_R->AdvancedSearch->SearchOperator = @$filter["z__6_52_R"];
		$this->_6_52_R->AdvancedSearch->SearchCondition = @$filter["v__6_52_R"];
		$this->_6_52_R->AdvancedSearch->SearchValue2 = @$filter["y__6_52_R"];
		$this->_6_52_R->AdvancedSearch->SearchOperator2 = @$filter["w__6_52_R"];
		$this->_6_52_R->AdvancedSearch->save();

		// Field 7_21_R
		$this->_7_21_R->AdvancedSearch->SearchValue = @$filter["x__7_21_R"];
		$this->_7_21_R->AdvancedSearch->SearchOperator = @$filter["z__7_21_R"];
		$this->_7_21_R->AdvancedSearch->SearchCondition = @$filter["v__7_21_R"];
		$this->_7_21_R->AdvancedSearch->SearchValue2 = @$filter["y__7_21_R"];
		$this->_7_21_R->AdvancedSearch->SearchOperator2 = @$filter["w__7_21_R"];
		$this->_7_21_R->AdvancedSearch->save();

		// Field 8_22_R
		$this->_8_22_R->AdvancedSearch->SearchValue = @$filter["x__8_22_R"];
		$this->_8_22_R->AdvancedSearch->SearchOperator = @$filter["z__8_22_R"];
		$this->_8_22_R->AdvancedSearch->SearchCondition = @$filter["v__8_22_R"];
		$this->_8_22_R->AdvancedSearch->SearchValue2 = @$filter["y__8_22_R"];
		$this->_8_22_R->AdvancedSearch->SearchOperator2 = @$filter["w__8_22_R"];
		$this->_8_22_R->AdvancedSearch->save();

		// Field 8_23_R
		$this->_8_23_R->AdvancedSearch->SearchValue = @$filter["x__8_23_R"];
		$this->_8_23_R->AdvancedSearch->SearchOperator = @$filter["z__8_23_R"];
		$this->_8_23_R->AdvancedSearch->SearchCondition = @$filter["v__8_23_R"];
		$this->_8_23_R->AdvancedSearch->SearchValue2 = @$filter["y__8_23_R"];
		$this->_8_23_R->AdvancedSearch->SearchOperator2 = @$filter["w__8_23_R"];
		$this->_8_23_R->AdvancedSearch->save();

		// Field 8_24_R
		$this->_8_24_R->AdvancedSearch->SearchValue = @$filter["x__8_24_R"];
		$this->_8_24_R->AdvancedSearch->SearchOperator = @$filter["z__8_24_R"];
		$this->_8_24_R->AdvancedSearch->SearchCondition = @$filter["v__8_24_R"];
		$this->_8_24_R->AdvancedSearch->SearchValue2 = @$filter["y__8_24_R"];
		$this->_8_24_R->AdvancedSearch->SearchOperator2 = @$filter["w__8_24_R"];
		$this->_8_24_R->AdvancedSearch->save();

		// Field 8_25_R
		$this->_8_25_R->AdvancedSearch->SearchValue = @$filter["x__8_25_R"];
		$this->_8_25_R->AdvancedSearch->SearchOperator = @$filter["z__8_25_R"];
		$this->_8_25_R->AdvancedSearch->SearchCondition = @$filter["v__8_25_R"];
		$this->_8_25_R->AdvancedSearch->SearchValue2 = @$filter["y__8_25_R"];
		$this->_8_25_R->AdvancedSearch->SearchOperator2 = @$filter["w__8_25_R"];
		$this->_8_25_R->AdvancedSearch->save();

		// Field 9_26_R
		$this->_9_26_R->AdvancedSearch->SearchValue = @$filter["x__9_26_R"];
		$this->_9_26_R->AdvancedSearch->SearchOperator = @$filter["z__9_26_R"];
		$this->_9_26_R->AdvancedSearch->SearchCondition = @$filter["v__9_26_R"];
		$this->_9_26_R->AdvancedSearch->SearchValue2 = @$filter["y__9_26_R"];
		$this->_9_26_R->AdvancedSearch->SearchOperator2 = @$filter["w__9_26_R"];
		$this->_9_26_R->AdvancedSearch->save();

		// Field 9_27_R
		$this->_9_27_R->AdvancedSearch->SearchValue = @$filter["x__9_27_R"];
		$this->_9_27_R->AdvancedSearch->SearchOperator = @$filter["z__9_27_R"];
		$this->_9_27_R->AdvancedSearch->SearchCondition = @$filter["v__9_27_R"];
		$this->_9_27_R->AdvancedSearch->SearchValue2 = @$filter["y__9_27_R"];
		$this->_9_27_R->AdvancedSearch->SearchOperator2 = @$filter["w__9_27_R"];
		$this->_9_27_R->AdvancedSearch->save();

		// Field 9_28_R
		$this->_9_28_R->AdvancedSearch->SearchValue = @$filter["x__9_28_R"];
		$this->_9_28_R->AdvancedSearch->SearchOperator = @$filter["z__9_28_R"];
		$this->_9_28_R->AdvancedSearch->SearchCondition = @$filter["v__9_28_R"];
		$this->_9_28_R->AdvancedSearch->SearchValue2 = @$filter["y__9_28_R"];
		$this->_9_28_R->AdvancedSearch->SearchOperator2 = @$filter["w__9_28_R"];
		$this->_9_28_R->AdvancedSearch->save();

		// Field 9_29_R
		$this->_9_29_R->AdvancedSearch->SearchValue = @$filter["x__9_29_R"];
		$this->_9_29_R->AdvancedSearch->SearchOperator = @$filter["z__9_29_R"];
		$this->_9_29_R->AdvancedSearch->SearchCondition = @$filter["v__9_29_R"];
		$this->_9_29_R->AdvancedSearch->SearchValue2 = @$filter["y__9_29_R"];
		$this->_9_29_R->AdvancedSearch->SearchOperator2 = @$filter["w__9_29_R"];
		$this->_9_29_R->AdvancedSearch->save();

		// Field 9_30_R
		$this->_9_30_R->AdvancedSearch->SearchValue = @$filter["x__9_30_R"];
		$this->_9_30_R->AdvancedSearch->SearchOperator = @$filter["z__9_30_R"];
		$this->_9_30_R->AdvancedSearch->SearchCondition = @$filter["v__9_30_R"];
		$this->_9_30_R->AdvancedSearch->SearchValue2 = @$filter["y__9_30_R"];
		$this->_9_30_R->AdvancedSearch->SearchOperator2 = @$filter["w__9_30_R"];
		$this->_9_30_R->AdvancedSearch->save();

		// Field 9_31_R
		$this->_9_31_R->AdvancedSearch->SearchValue = @$filter["x__9_31_R"];
		$this->_9_31_R->AdvancedSearch->SearchOperator = @$filter["z__9_31_R"];
		$this->_9_31_R->AdvancedSearch->SearchCondition = @$filter["v__9_31_R"];
		$this->_9_31_R->AdvancedSearch->SearchValue2 = @$filter["y__9_31_R"];
		$this->_9_31_R->AdvancedSearch->SearchOperator2 = @$filter["w__9_31_R"];
		$this->_9_31_R->AdvancedSearch->save();

		// Field 9_32_R
		$this->_9_32_R->AdvancedSearch->SearchValue = @$filter["x__9_32_R"];
		$this->_9_32_R->AdvancedSearch->SearchOperator = @$filter["z__9_32_R"];
		$this->_9_32_R->AdvancedSearch->SearchCondition = @$filter["v__9_32_R"];
		$this->_9_32_R->AdvancedSearch->SearchValue2 = @$filter["y__9_32_R"];
		$this->_9_32_R->AdvancedSearch->SearchOperator2 = @$filter["w__9_32_R"];
		$this->_9_32_R->AdvancedSearch->save();

		// Field 9_33_R
		$this->_9_33_R->AdvancedSearch->SearchValue = @$filter["x__9_33_R"];
		$this->_9_33_R->AdvancedSearch->SearchOperator = @$filter["z__9_33_R"];
		$this->_9_33_R->AdvancedSearch->SearchCondition = @$filter["v__9_33_R"];
		$this->_9_33_R->AdvancedSearch->SearchValue2 = @$filter["y__9_33_R"];
		$this->_9_33_R->AdvancedSearch->SearchOperator2 = @$filter["w__9_33_R"];
		$this->_9_33_R->AdvancedSearch->save();

		// Field 9_34_R
		$this->_9_34_R->AdvancedSearch->SearchValue = @$filter["x__9_34_R"];
		$this->_9_34_R->AdvancedSearch->SearchOperator = @$filter["z__9_34_R"];
		$this->_9_34_R->AdvancedSearch->SearchCondition = @$filter["v__9_34_R"];
		$this->_9_34_R->AdvancedSearch->SearchValue2 = @$filter["y__9_34_R"];
		$this->_9_34_R->AdvancedSearch->SearchOperator2 = @$filter["w__9_34_R"];
		$this->_9_34_R->AdvancedSearch->save();

		// Field 9_35_R
		$this->_9_35_R->AdvancedSearch->SearchValue = @$filter["x__9_35_R"];
		$this->_9_35_R->AdvancedSearch->SearchOperator = @$filter["z__9_35_R"];
		$this->_9_35_R->AdvancedSearch->SearchCondition = @$filter["v__9_35_R"];
		$this->_9_35_R->AdvancedSearch->SearchValue2 = @$filter["y__9_35_R"];
		$this->_9_35_R->AdvancedSearch->SearchOperator2 = @$filter["w__9_35_R"];
		$this->_9_35_R->AdvancedSearch->save();

		// Field 9_36_R
		$this->_9_36_R->AdvancedSearch->SearchValue = @$filter["x__9_36_R"];
		$this->_9_36_R->AdvancedSearch->SearchOperator = @$filter["z__9_36_R"];
		$this->_9_36_R->AdvancedSearch->SearchCondition = @$filter["v__9_36_R"];
		$this->_9_36_R->AdvancedSearch->SearchValue2 = @$filter["y__9_36_R"];
		$this->_9_36_R->AdvancedSearch->SearchOperator2 = @$filter["w__9_36_R"];
		$this->_9_36_R->AdvancedSearch->save();

		// Field 9_37_R
		$this->_9_37_R->AdvancedSearch->SearchValue = @$filter["x__9_37_R"];
		$this->_9_37_R->AdvancedSearch->SearchOperator = @$filter["z__9_37_R"];
		$this->_9_37_R->AdvancedSearch->SearchCondition = @$filter["v__9_37_R"];
		$this->_9_37_R->AdvancedSearch->SearchValue2 = @$filter["y__9_37_R"];
		$this->_9_37_R->AdvancedSearch->SearchOperator2 = @$filter["w__9_37_R"];
		$this->_9_37_R->AdvancedSearch->save();

		// Field 9_38_R
		$this->_9_38_R->AdvancedSearch->SearchValue = @$filter["x__9_38_R"];
		$this->_9_38_R->AdvancedSearch->SearchOperator = @$filter["z__9_38_R"];
		$this->_9_38_R->AdvancedSearch->SearchCondition = @$filter["v__9_38_R"];
		$this->_9_38_R->AdvancedSearch->SearchValue2 = @$filter["y__9_38_R"];
		$this->_9_38_R->AdvancedSearch->SearchOperator2 = @$filter["w__9_38_R"];
		$this->_9_38_R->AdvancedSearch->save();

		// Field 9_39_R
		$this->_9_39_R->AdvancedSearch->SearchValue = @$filter["x__9_39_R"];
		$this->_9_39_R->AdvancedSearch->SearchOperator = @$filter["z__9_39_R"];
		$this->_9_39_R->AdvancedSearch->SearchCondition = @$filter["v__9_39_R"];
		$this->_9_39_R->AdvancedSearch->SearchValue2 = @$filter["y__9_39_R"];
		$this->_9_39_R->AdvancedSearch->SearchOperator2 = @$filter["w__9_39_R"];
		$this->_9_39_R->AdvancedSearch->save();

		// Field 10_40_R
		$this->_10_40_R->AdvancedSearch->SearchValue = @$filter["x__10_40_R"];
		$this->_10_40_R->AdvancedSearch->SearchOperator = @$filter["z__10_40_R"];
		$this->_10_40_R->AdvancedSearch->SearchCondition = @$filter["v__10_40_R"];
		$this->_10_40_R->AdvancedSearch->SearchValue2 = @$filter["y__10_40_R"];
		$this->_10_40_R->AdvancedSearch->SearchOperator2 = @$filter["w__10_40_R"];
		$this->_10_40_R->AdvancedSearch->save();

		// Field 10_41_R
		$this->_10_41_R->AdvancedSearch->SearchValue = @$filter["x__10_41_R"];
		$this->_10_41_R->AdvancedSearch->SearchOperator = @$filter["z__10_41_R"];
		$this->_10_41_R->AdvancedSearch->SearchCondition = @$filter["v__10_41_R"];
		$this->_10_41_R->AdvancedSearch->SearchValue2 = @$filter["y__10_41_R"];
		$this->_10_41_R->AdvancedSearch->SearchOperator2 = @$filter["w__10_41_R"];
		$this->_10_41_R->AdvancedSearch->save();

		// Field 11_42_R
		$this->_11_42_R->AdvancedSearch->SearchValue = @$filter["x__11_42_R"];
		$this->_11_42_R->AdvancedSearch->SearchOperator = @$filter["z__11_42_R"];
		$this->_11_42_R->AdvancedSearch->SearchCondition = @$filter["v__11_42_R"];
		$this->_11_42_R->AdvancedSearch->SearchValue2 = @$filter["y__11_42_R"];
		$this->_11_42_R->AdvancedSearch->SearchOperator2 = @$filter["w__11_42_R"];
		$this->_11_42_R->AdvancedSearch->save();

		// Field 11_43_R
		$this->_11_43_R->AdvancedSearch->SearchValue = @$filter["x__11_43_R"];
		$this->_11_43_R->AdvancedSearch->SearchOperator = @$filter["z__11_43_R"];
		$this->_11_43_R->AdvancedSearch->SearchCondition = @$filter["v__11_43_R"];
		$this->_11_43_R->AdvancedSearch->SearchValue2 = @$filter["y__11_43_R"];
		$this->_11_43_R->AdvancedSearch->SearchOperator2 = @$filter["w__11_43_R"];
		$this->_11_43_R->AdvancedSearch->save();

		// Field 12_44_R
		$this->_12_44_R->AdvancedSearch->SearchValue = @$filter["x__12_44_R"];
		$this->_12_44_R->AdvancedSearch->SearchOperator = @$filter["z__12_44_R"];
		$this->_12_44_R->AdvancedSearch->SearchCondition = @$filter["v__12_44_R"];
		$this->_12_44_R->AdvancedSearch->SearchValue2 = @$filter["y__12_44_R"];
		$this->_12_44_R->AdvancedSearch->SearchOperator2 = @$filter["w__12_44_R"];
		$this->_12_44_R->AdvancedSearch->save();

		// Field 12_45_R
		$this->_12_45_R->AdvancedSearch->SearchValue = @$filter["x__12_45_R"];
		$this->_12_45_R->AdvancedSearch->SearchOperator = @$filter["z__12_45_R"];
		$this->_12_45_R->AdvancedSearch->SearchCondition = @$filter["v__12_45_R"];
		$this->_12_45_R->AdvancedSearch->SearchValue2 = @$filter["y__12_45_R"];
		$this->_12_45_R->AdvancedSearch->SearchOperator2 = @$filter["w__12_45_R"];
		$this->_12_45_R->AdvancedSearch->save();

		// Field 12_46_R
		$this->_12_46_R->AdvancedSearch->SearchValue = @$filter["x__12_46_R"];
		$this->_12_46_R->AdvancedSearch->SearchOperator = @$filter["z__12_46_R"];
		$this->_12_46_R->AdvancedSearch->SearchCondition = @$filter["v__12_46_R"];
		$this->_12_46_R->AdvancedSearch->SearchValue2 = @$filter["y__12_46_R"];
		$this->_12_46_R->AdvancedSearch->SearchOperator2 = @$filter["w__12_46_R"];
		$this->_12_46_R->AdvancedSearch->save();

		// Field 12_47_R
		$this->_12_47_R->AdvancedSearch->SearchValue = @$filter["x__12_47_R"];
		$this->_12_47_R->AdvancedSearch->SearchOperator = @$filter["z__12_47_R"];
		$this->_12_47_R->AdvancedSearch->SearchCondition = @$filter["v__12_47_R"];
		$this->_12_47_R->AdvancedSearch->SearchValue2 = @$filter["y__12_47_R"];
		$this->_12_47_R->AdvancedSearch->SearchOperator2 = @$filter["w__12_47_R"];
		$this->_12_47_R->AdvancedSearch->save();

		// Field 12_48_R
		$this->_12_48_R->AdvancedSearch->SearchValue = @$filter["x__12_48_R"];
		$this->_12_48_R->AdvancedSearch->SearchOperator = @$filter["z__12_48_R"];
		$this->_12_48_R->AdvancedSearch->SearchCondition = @$filter["v__12_48_R"];
		$this->_12_48_R->AdvancedSearch->SearchValue2 = @$filter["y__12_48_R"];
		$this->_12_48_R->AdvancedSearch->SearchOperator2 = @$filter["w__12_48_R"];
		$this->_12_48_R->AdvancedSearch->save();

		// Field 12_49_R
		$this->_12_49_R->AdvancedSearch->SearchValue = @$filter["x__12_49_R"];
		$this->_12_49_R->AdvancedSearch->SearchOperator = @$filter["z__12_49_R"];
		$this->_12_49_R->AdvancedSearch->SearchCondition = @$filter["v__12_49_R"];
		$this->_12_49_R->AdvancedSearch->SearchValue2 = @$filter["y__12_49_R"];
		$this->_12_49_R->AdvancedSearch->SearchOperator2 = @$filter["w__12_49_R"];
		$this->_12_49_R->AdvancedSearch->save();

		// Field 12_50_R
		$this->_12_50_R->AdvancedSearch->SearchValue = @$filter["x__12_50_R"];
		$this->_12_50_R->AdvancedSearch->SearchOperator = @$filter["z__12_50_R"];
		$this->_12_50_R->AdvancedSearch->SearchCondition = @$filter["v__12_50_R"];
		$this->_12_50_R->AdvancedSearch->SearchValue2 = @$filter["y__12_50_R"];
		$this->_12_50_R->AdvancedSearch->SearchOperator2 = @$filter["w__12_50_R"];
		$this->_12_50_R->AdvancedSearch->save();

		// Field 1__R
		$this->_1__R->AdvancedSearch->SearchValue = @$filter["x__1__R"];
		$this->_1__R->AdvancedSearch->SearchOperator = @$filter["z__1__R"];
		$this->_1__R->AdvancedSearch->SearchCondition = @$filter["v__1__R"];
		$this->_1__R->AdvancedSearch->SearchValue2 = @$filter["y__1__R"];
		$this->_1__R->AdvancedSearch->SearchOperator2 = @$filter["w__1__R"];
		$this->_1__R->AdvancedSearch->save();

		// Field 13_54_R
		$this->_13_54_R->AdvancedSearch->SearchValue = @$filter["x__13_54_R"];
		$this->_13_54_R->AdvancedSearch->SearchOperator = @$filter["z__13_54_R"];
		$this->_13_54_R->AdvancedSearch->SearchCondition = @$filter["v__13_54_R"];
		$this->_13_54_R->AdvancedSearch->SearchValue2 = @$filter["y__13_54_R"];
		$this->_13_54_R->AdvancedSearch->SearchOperator2 = @$filter["w__13_54_R"];
		$this->_13_54_R->AdvancedSearch->save();

		// Field 13_54_1_R
		$this->_13_54_1_R->AdvancedSearch->SearchValue = @$filter["x__13_54_1_R"];
		$this->_13_54_1_R->AdvancedSearch->SearchOperator = @$filter["z__13_54_1_R"];
		$this->_13_54_1_R->AdvancedSearch->SearchCondition = @$filter["v__13_54_1_R"];
		$this->_13_54_1_R->AdvancedSearch->SearchValue2 = @$filter["y__13_54_1_R"];
		$this->_13_54_1_R->AdvancedSearch->SearchOperator2 = @$filter["w__13_54_1_R"];
		$this->_13_54_1_R->AdvancedSearch->save();

		// Field 13_54_2_R
		$this->_13_54_2_R->AdvancedSearch->SearchValue = @$filter["x__13_54_2_R"];
		$this->_13_54_2_R->AdvancedSearch->SearchOperator = @$filter["z__13_54_2_R"];
		$this->_13_54_2_R->AdvancedSearch->SearchCondition = @$filter["v__13_54_2_R"];
		$this->_13_54_2_R->AdvancedSearch->SearchValue2 = @$filter["y__13_54_2_R"];
		$this->_13_54_2_R->AdvancedSearch->SearchOperator2 = @$filter["w__13_54_2_R"];
		$this->_13_54_2_R->AdvancedSearch->save();

		// Field 13_55_R
		$this->_13_55_R->AdvancedSearch->SearchValue = @$filter["x__13_55_R"];
		$this->_13_55_R->AdvancedSearch->SearchOperator = @$filter["z__13_55_R"];
		$this->_13_55_R->AdvancedSearch->SearchCondition = @$filter["v__13_55_R"];
		$this->_13_55_R->AdvancedSearch->SearchValue2 = @$filter["y__13_55_R"];
		$this->_13_55_R->AdvancedSearch->SearchOperator2 = @$filter["w__13_55_R"];
		$this->_13_55_R->AdvancedSearch->save();

		// Field 13_55_1_R
		$this->_13_55_1_R->AdvancedSearch->SearchValue = @$filter["x__13_55_1_R"];
		$this->_13_55_1_R->AdvancedSearch->SearchOperator = @$filter["z__13_55_1_R"];
		$this->_13_55_1_R->AdvancedSearch->SearchCondition = @$filter["v__13_55_1_R"];
		$this->_13_55_1_R->AdvancedSearch->SearchValue2 = @$filter["y__13_55_1_R"];
		$this->_13_55_1_R->AdvancedSearch->SearchOperator2 = @$filter["w__13_55_1_R"];
		$this->_13_55_1_R->AdvancedSearch->save();

		// Field 13_55_2_R
		$this->_13_55_2_R->AdvancedSearch->SearchValue = @$filter["x__13_55_2_R"];
		$this->_13_55_2_R->AdvancedSearch->SearchOperator = @$filter["z__13_55_2_R"];
		$this->_13_55_2_R->AdvancedSearch->SearchCondition = @$filter["v__13_55_2_R"];
		$this->_13_55_2_R->AdvancedSearch->SearchValue2 = @$filter["y__13_55_2_R"];
		$this->_13_55_2_R->AdvancedSearch->SearchOperator2 = @$filter["w__13_55_2_R"];
		$this->_13_55_2_R->AdvancedSearch->save();

		// Field 13_56_R
		$this->_13_56_R->AdvancedSearch->SearchValue = @$filter["x__13_56_R"];
		$this->_13_56_R->AdvancedSearch->SearchOperator = @$filter["z__13_56_R"];
		$this->_13_56_R->AdvancedSearch->SearchCondition = @$filter["v__13_56_R"];
		$this->_13_56_R->AdvancedSearch->SearchValue2 = @$filter["y__13_56_R"];
		$this->_13_56_R->AdvancedSearch->SearchOperator2 = @$filter["w__13_56_R"];
		$this->_13_56_R->AdvancedSearch->save();

		// Field 13_56_1_R
		$this->_13_56_1_R->AdvancedSearch->SearchValue = @$filter["x__13_56_1_R"];
		$this->_13_56_1_R->AdvancedSearch->SearchOperator = @$filter["z__13_56_1_R"];
		$this->_13_56_1_R->AdvancedSearch->SearchCondition = @$filter["v__13_56_1_R"];
		$this->_13_56_1_R->AdvancedSearch->SearchValue2 = @$filter["y__13_56_1_R"];
		$this->_13_56_1_R->AdvancedSearch->SearchOperator2 = @$filter["w__13_56_1_R"];
		$this->_13_56_1_R->AdvancedSearch->save();

		// Field 13_56_2_R
		$this->_13_56_2_R->AdvancedSearch->SearchValue = @$filter["x__13_56_2_R"];
		$this->_13_56_2_R->AdvancedSearch->SearchOperator = @$filter["z__13_56_2_R"];
		$this->_13_56_2_R->AdvancedSearch->SearchCondition = @$filter["v__13_56_2_R"];
		$this->_13_56_2_R->AdvancedSearch->SearchValue2 = @$filter["y__13_56_2_R"];
		$this->_13_56_2_R->AdvancedSearch->SearchOperator2 = @$filter["w__13_56_2_R"];
		$this->_13_56_2_R->AdvancedSearch->save();

		// Field 12_53_R
		$this->_12_53_R->AdvancedSearch->SearchValue = @$filter["x__12_53_R"];
		$this->_12_53_R->AdvancedSearch->SearchOperator = @$filter["z__12_53_R"];
		$this->_12_53_R->AdvancedSearch->SearchCondition = @$filter["v__12_53_R"];
		$this->_12_53_R->AdvancedSearch->SearchValue2 = @$filter["y__12_53_R"];
		$this->_12_53_R->AdvancedSearch->SearchOperator2 = @$filter["w__12_53_R"];
		$this->_12_53_R->AdvancedSearch->save();

		// Field 12_53_1_R
		$this->_12_53_1_R->AdvancedSearch->SearchValue = @$filter["x__12_53_1_R"];
		$this->_12_53_1_R->AdvancedSearch->SearchOperator = @$filter["z__12_53_1_R"];
		$this->_12_53_1_R->AdvancedSearch->SearchCondition = @$filter["v__12_53_1_R"];
		$this->_12_53_1_R->AdvancedSearch->SearchValue2 = @$filter["y__12_53_1_R"];
		$this->_12_53_1_R->AdvancedSearch->SearchOperator2 = @$filter["w__12_53_1_R"];
		$this->_12_53_1_R->AdvancedSearch->save();

		// Field 12_53_2_R
		$this->_12_53_2_R->AdvancedSearch->SearchValue = @$filter["x__12_53_2_R"];
		$this->_12_53_2_R->AdvancedSearch->SearchOperator = @$filter["z__12_53_2_R"];
		$this->_12_53_2_R->AdvancedSearch->SearchCondition = @$filter["v__12_53_2_R"];
		$this->_12_53_2_R->AdvancedSearch->SearchValue2 = @$filter["y__12_53_2_R"];
		$this->_12_53_2_R->AdvancedSearch->SearchOperator2 = @$filter["w__12_53_2_R"];
		$this->_12_53_2_R->AdvancedSearch->save();

		// Field 12_53_3_R
		$this->_12_53_3_R->AdvancedSearch->SearchValue = @$filter["x__12_53_3_R"];
		$this->_12_53_3_R->AdvancedSearch->SearchOperator = @$filter["z__12_53_3_R"];
		$this->_12_53_3_R->AdvancedSearch->SearchCondition = @$filter["v__12_53_3_R"];
		$this->_12_53_3_R->AdvancedSearch->SearchValue2 = @$filter["y__12_53_3_R"];
		$this->_12_53_3_R->AdvancedSearch->SearchOperator2 = @$filter["w__12_53_3_R"];
		$this->_12_53_3_R->AdvancedSearch->save();

		// Field 12_53_4_R
		$this->_12_53_4_R->AdvancedSearch->SearchValue = @$filter["x__12_53_4_R"];
		$this->_12_53_4_R->AdvancedSearch->SearchOperator = @$filter["z__12_53_4_R"];
		$this->_12_53_4_R->AdvancedSearch->SearchCondition = @$filter["v__12_53_4_R"];
		$this->_12_53_4_R->AdvancedSearch->SearchValue2 = @$filter["y__12_53_4_R"];
		$this->_12_53_4_R->AdvancedSearch->SearchOperator2 = @$filter["w__12_53_4_R"];
		$this->_12_53_4_R->AdvancedSearch->save();

		// Field 12_53_5_R
		$this->_12_53_5_R->AdvancedSearch->SearchValue = @$filter["x__12_53_5_R"];
		$this->_12_53_5_R->AdvancedSearch->SearchOperator = @$filter["z__12_53_5_R"];
		$this->_12_53_5_R->AdvancedSearch->SearchCondition = @$filter["v__12_53_5_R"];
		$this->_12_53_5_R->AdvancedSearch->SearchValue2 = @$filter["y__12_53_5_R"];
		$this->_12_53_5_R->AdvancedSearch->SearchOperator2 = @$filter["w__12_53_5_R"];
		$this->_12_53_5_R->AdvancedSearch->save();

		// Field 12_53_6_R
		$this->_12_53_6_R->AdvancedSearch->SearchValue = @$filter["x__12_53_6_R"];
		$this->_12_53_6_R->AdvancedSearch->SearchOperator = @$filter["z__12_53_6_R"];
		$this->_12_53_6_R->AdvancedSearch->SearchCondition = @$filter["v__12_53_6_R"];
		$this->_12_53_6_R->AdvancedSearch->SearchValue2 = @$filter["y__12_53_6_R"];
		$this->_12_53_6_R->AdvancedSearch->SearchOperator2 = @$filter["w__12_53_6_R"];
		$this->_12_53_6_R->AdvancedSearch->save();

		// Field 13_57_R
		$this->_13_57_R->AdvancedSearch->SearchValue = @$filter["x__13_57_R"];
		$this->_13_57_R->AdvancedSearch->SearchOperator = @$filter["z__13_57_R"];
		$this->_13_57_R->AdvancedSearch->SearchCondition = @$filter["v__13_57_R"];
		$this->_13_57_R->AdvancedSearch->SearchValue2 = @$filter["y__13_57_R"];
		$this->_13_57_R->AdvancedSearch->SearchOperator2 = @$filter["w__13_57_R"];
		$this->_13_57_R->AdvancedSearch->save();

		// Field 13_57_1_R
		$this->_13_57_1_R->AdvancedSearch->SearchValue = @$filter["x__13_57_1_R"];
		$this->_13_57_1_R->AdvancedSearch->SearchOperator = @$filter["z__13_57_1_R"];
		$this->_13_57_1_R->AdvancedSearch->SearchCondition = @$filter["v__13_57_1_R"];
		$this->_13_57_1_R->AdvancedSearch->SearchValue2 = @$filter["y__13_57_1_R"];
		$this->_13_57_1_R->AdvancedSearch->SearchOperator2 = @$filter["w__13_57_1_R"];
		$this->_13_57_1_R->AdvancedSearch->save();

		// Field 13_57_2_R
		$this->_13_57_2_R->AdvancedSearch->SearchValue = @$filter["x__13_57_2_R"];
		$this->_13_57_2_R->AdvancedSearch->SearchOperator = @$filter["z__13_57_2_R"];
		$this->_13_57_2_R->AdvancedSearch->SearchCondition = @$filter["v__13_57_2_R"];
		$this->_13_57_2_R->AdvancedSearch->SearchValue2 = @$filter["y__13_57_2_R"];
		$this->_13_57_2_R->AdvancedSearch->SearchOperator2 = @$filter["w__13_57_2_R"];
		$this->_13_57_2_R->AdvancedSearch->save();

		// Field 13_58_R
		$this->_13_58_R->AdvancedSearch->SearchValue = @$filter["x__13_58_R"];
		$this->_13_58_R->AdvancedSearch->SearchOperator = @$filter["z__13_58_R"];
		$this->_13_58_R->AdvancedSearch->SearchCondition = @$filter["v__13_58_R"];
		$this->_13_58_R->AdvancedSearch->SearchValue2 = @$filter["y__13_58_R"];
		$this->_13_58_R->AdvancedSearch->SearchOperator2 = @$filter["w__13_58_R"];
		$this->_13_58_R->AdvancedSearch->save();

		// Field 13_58_1_R
		$this->_13_58_1_R->AdvancedSearch->SearchValue = @$filter["x__13_58_1_R"];
		$this->_13_58_1_R->AdvancedSearch->SearchOperator = @$filter["z__13_58_1_R"];
		$this->_13_58_1_R->AdvancedSearch->SearchCondition = @$filter["v__13_58_1_R"];
		$this->_13_58_1_R->AdvancedSearch->SearchValue2 = @$filter["y__13_58_1_R"];
		$this->_13_58_1_R->AdvancedSearch->SearchOperator2 = @$filter["w__13_58_1_R"];
		$this->_13_58_1_R->AdvancedSearch->save();

		// Field 13_58_2_R
		$this->_13_58_2_R->AdvancedSearch->SearchValue = @$filter["x__13_58_2_R"];
		$this->_13_58_2_R->AdvancedSearch->SearchOperator = @$filter["z__13_58_2_R"];
		$this->_13_58_2_R->AdvancedSearch->SearchCondition = @$filter["v__13_58_2_R"];
		$this->_13_58_2_R->AdvancedSearch->SearchValue2 = @$filter["y__13_58_2_R"];
		$this->_13_58_2_R->AdvancedSearch->SearchOperator2 = @$filter["w__13_58_2_R"];
		$this->_13_58_2_R->AdvancedSearch->save();

		// Field 13_59_R
		$this->_13_59_R->AdvancedSearch->SearchValue = @$filter["x__13_59_R"];
		$this->_13_59_R->AdvancedSearch->SearchOperator = @$filter["z__13_59_R"];
		$this->_13_59_R->AdvancedSearch->SearchCondition = @$filter["v__13_59_R"];
		$this->_13_59_R->AdvancedSearch->SearchValue2 = @$filter["y__13_59_R"];
		$this->_13_59_R->AdvancedSearch->SearchOperator2 = @$filter["w__13_59_R"];
		$this->_13_59_R->AdvancedSearch->save();

		// Field 13_59_1_R
		$this->_13_59_1_R->AdvancedSearch->SearchValue = @$filter["x__13_59_1_R"];
		$this->_13_59_1_R->AdvancedSearch->SearchOperator = @$filter["z__13_59_1_R"];
		$this->_13_59_1_R->AdvancedSearch->SearchCondition = @$filter["v__13_59_1_R"];
		$this->_13_59_1_R->AdvancedSearch->SearchValue2 = @$filter["y__13_59_1_R"];
		$this->_13_59_1_R->AdvancedSearch->SearchOperator2 = @$filter["w__13_59_1_R"];
		$this->_13_59_1_R->AdvancedSearch->save();

		// Field 13_59_2_R
		$this->_13_59_2_R->AdvancedSearch->SearchValue = @$filter["x__13_59_2_R"];
		$this->_13_59_2_R->AdvancedSearch->SearchOperator = @$filter["z__13_59_2_R"];
		$this->_13_59_2_R->AdvancedSearch->SearchCondition = @$filter["v__13_59_2_R"];
		$this->_13_59_2_R->AdvancedSearch->SearchValue2 = @$filter["y__13_59_2_R"];
		$this->_13_59_2_R->AdvancedSearch->SearchOperator2 = @$filter["w__13_59_2_R"];
		$this->_13_59_2_R->AdvancedSearch->save();

		// Field 13_60_R
		$this->_13_60_R->AdvancedSearch->SearchValue = @$filter["x__13_60_R"];
		$this->_13_60_R->AdvancedSearch->SearchOperator = @$filter["z__13_60_R"];
		$this->_13_60_R->AdvancedSearch->SearchCondition = @$filter["v__13_60_R"];
		$this->_13_60_R->AdvancedSearch->SearchValue2 = @$filter["y__13_60_R"];
		$this->_13_60_R->AdvancedSearch->SearchOperator2 = @$filter["w__13_60_R"];
		$this->_13_60_R->AdvancedSearch->save();

		// Field 12_53_7_R
		$this->_12_53_7_R->AdvancedSearch->SearchValue = @$filter["x__12_53_7_R"];
		$this->_12_53_7_R->AdvancedSearch->SearchOperator = @$filter["z__12_53_7_R"];
		$this->_12_53_7_R->AdvancedSearch->SearchCondition = @$filter["v__12_53_7_R"];
		$this->_12_53_7_R->AdvancedSearch->SearchValue2 = @$filter["y__12_53_7_R"];
		$this->_12_53_7_R->AdvancedSearch->SearchOperator2 = @$filter["w__12_53_7_R"];
		$this->_12_53_7_R->AdvancedSearch->save();

		// Field 12_53_8_R
		$this->_12_53_8_R->AdvancedSearch->SearchValue = @$filter["x__12_53_8_R"];
		$this->_12_53_8_R->AdvancedSearch->SearchOperator = @$filter["z__12_53_8_R"];
		$this->_12_53_8_R->AdvancedSearch->SearchCondition = @$filter["v__12_53_8_R"];
		$this->_12_53_8_R->AdvancedSearch->SearchValue2 = @$filter["y__12_53_8_R"];
		$this->_12_53_8_R->AdvancedSearch->SearchOperator2 = @$filter["w__12_53_8_R"];
		$this->_12_53_8_R->AdvancedSearch->save();
		$this->BasicSearch->setKeyword(@$filter[Config("TABLE_BASIC_SEARCH")]);
		$this->BasicSearch->setType(@$filter[Config("TABLE_BASIC_SEARCH_TYPE")]);
	}

	// Return basic search SQL
	protected function basicSearchSql($arKeywords, $type)
	{
		$where = "";
		$this->buildBasicSearchSql($where, $this->audio, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->st, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->telefono, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->comentariosbo, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->IP, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->actual, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->completado, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_2_1_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_2_2_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_2_3_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_3_4_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_4_5_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_4_6_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_4_7_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_4_8_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_5_9_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_5_10_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_5_11_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_5_12_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_5_13_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_5_14_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_5_51_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_6_15_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_6_16_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_6_17_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_6_18_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_6_19_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_6_20_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_6_52_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_7_21_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_8_22_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_8_23_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_8_24_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_8_25_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_9_26_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_9_27_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_9_28_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_9_29_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_9_30_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_9_31_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_9_32_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_9_33_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_9_34_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_9_35_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_9_36_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_9_37_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_9_38_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_9_39_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_10_40_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_10_41_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_11_42_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_11_43_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_12_44_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_12_45_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_12_46_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_12_47_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_12_48_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_12_49_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_12_50_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_1__R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_13_54_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_13_54_1_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_13_54_2_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_13_55_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_13_55_1_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_13_55_2_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_13_56_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_13_56_1_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_13_56_2_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_12_53_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_12_53_1_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_12_53_2_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_12_53_3_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_12_53_4_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_12_53_5_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_12_53_6_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_13_57_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_13_57_1_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_13_57_2_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_13_58_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_13_58_1_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_13_58_2_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_13_59_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_13_59_1_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_13_59_2_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_13_60_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_12_53_7_R, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_12_53_8_R, $arKeywords, $type);
		return $where;
	}

	// Build basic search SQL
	protected function buildBasicSearchSql(&$where, &$fld, $arKeywords, $type)
	{
		$defCond = ($type == "OR") ? "OR" : "AND";
		$arSql = []; // Array for SQL parts
		$arCond = []; // Array for search conditions
		$cnt = count($arKeywords);
		$j = 0; // Number of SQL parts
		for ($i = 0; $i < $cnt; $i++) {
			$keyword = $arKeywords[$i];
			$keyword = trim($keyword);
			if (Config("BASIC_SEARCH_IGNORE_PATTERN") != "") {
				$keyword = preg_replace(Config("BASIC_SEARCH_IGNORE_PATTERN"), "\\", $keyword);
				$ar = explode("\\", $keyword);
			} else {
				$ar = [$keyword];
			}
			foreach ($ar as $keyword) {
				if ($keyword != "") {
					$wrk = "";
					if ($keyword == "OR" && $type == "") {
						if ($j > 0)
							$arCond[$j - 1] = "OR";
					} elseif ($keyword == Config("NULL_VALUE")) {
						$wrk = $fld->Expression . " IS NULL";
					} elseif ($keyword == Config("NOT_NULL_VALUE")) {
						$wrk = $fld->Expression . " IS NOT NULL";
					} elseif ($fld->IsVirtual) {
						$wrk = $fld->VirtualExpression . Like(QuotedValue("%" . $keyword . "%", DATATYPE_STRING, $this->Dbid), $this->Dbid);
					} elseif ($fld->DataType != DATATYPE_NUMBER || is_numeric($keyword)) {
						$wrk = $fld->BasicSearchExpression . Like(QuotedValue("%" . $keyword . "%", DATATYPE_STRING, $this->Dbid), $this->Dbid);
					}
					if ($wrk != "") {
						$arSql[$j] = $wrk;
						$arCond[$j] = $defCond;
						$j += 1;
					}
				}
			}
		}
		$cnt = count($arSql);
		$quoted = FALSE;
		$sql = "";
		if ($cnt > 0) {
			for ($i = 0; $i < $cnt - 1; $i++) {
				if ($arCond[$i] == "OR") {
					if (!$quoted)
						$sql .= "(";
					$quoted = TRUE;
				}
				$sql .= $arSql[$i];
				if ($quoted && $arCond[$i] != "OR") {
					$sql .= ")";
					$quoted = FALSE;
				}
				$sql .= " " . $arCond[$i] . " ";
			}
			$sql .= $arSql[$cnt - 1];
			if ($quoted)
				$sql .= ")";
		}
		if ($sql != "") {
			if ($where != "")
				$where .= " OR ";
			$where .= "(" . $sql . ")";
		}
	}

	// Return basic search WHERE clause based on search keyword and type
	protected function basicSearchWhere($default = FALSE)
	{
		global $Security;
		$searchStr = "";
		$searchKeyword = ($default) ? $this->BasicSearch->KeywordDefault : $this->BasicSearch->Keyword;
		$searchType = ($default) ? $this->BasicSearch->TypeDefault : $this->BasicSearch->Type;

		// Get search SQL
		if ($searchKeyword != "") {
			$ar = $this->BasicSearch->keywordList($default);

			// Search keyword in any fields
			if (($searchType == "OR" || $searchType == "AND") && $this->BasicSearch->BasicSearchAnyFields) {
				foreach ($ar as $keyword) {
					if ($keyword != "") {
						if ($searchStr != "")
							$searchStr .= " " . $searchType . " ";
						$searchStr .= "(" . $this->basicSearchSql([$keyword], $searchType) . ")";
					}
				}
			} else {
				$searchStr = $this->basicSearchSql($ar, $searchType);
			}
			if (!$default && in_array($this->Command, ["", "reset", "resetall"]))
				$this->Command = "search";
		}
		if (!$default && $this->Command == "search") {
			$this->BasicSearch->setKeyword($searchKeyword);
			$this->BasicSearch->setType($searchType);
		}
		return $searchStr;
	}

	// Check if search parm exists
	protected function checkSearchParms()
	{

		// Check basic search
		if ($this->BasicSearch->issetSession())
			return TRUE;
		return FALSE;
	}

	// Clear all search parameters
	protected function resetSearchParms()
	{

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$this->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->resetBasicSearchParms();
	}

	// Load advanced search default values
	protected function loadAdvancedSearchDefault()
	{
		return FALSE;
	}

	// Clear all basic search parameters
	protected function resetBasicSearchParms()
	{
		$this->BasicSearch->unsetSession();
	}

	// Restore all search parameters
	protected function restoreSearchParms()
	{
		$this->RestoreSearch = TRUE;

		// Restore basic search values
		$this->BasicSearch->load();
	}

	// Set up sort parameters
	protected function setupSortOrder()
	{

		// Check for "order" parameter
		if (Get("order") !== NULL) {
			$this->CurrentOrder = Get("order");
			$this->CurrentOrderType = Get("ordertype", "");
			$this->updateSort($this->id); // id
			$this->updateSort($this->fecha); // fecha
			$this->updateSort($this->hora); // hora
			$this->updateSort($this->audio); // audio
			$this->updateSort($this->st); // st
			$this->updateSort($this->fechaHoraIni); // fechaHoraIni
			$this->updateSort($this->fechaHoraFin); // fechaHoraFin
			$this->updateSort($this->telefono); // telefono
			$this->updateSort($this->agente); // agente
			$this->updateSort($this->fechabo); // fechabo
			$this->updateSort($this->agentebo); // agentebo
			$this->updateSort($this->IP); // IP
			$this->updateSort($this->actual); // actual
			$this->updateSort($this->completado); // completado
			$this->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	protected function loadSortOrder()
	{
		$orderBy = $this->getSessionOrderBy(); // Get ORDER BY from Session
		if ($orderBy == "") {
			if ($this->getSqlOrderBy() != "") {
				$orderBy = $this->getSqlOrderBy();
				$this->setSessionOrderBy($orderBy);
			}
		}
	}

	// Reset command
	// - cmd=reset (Reset search parameters)
	// - cmd=resetall (Reset search and master/detail parameters)
	// - cmd=resetsort (Reset sort parameters)

	protected function resetCmd()
	{

		// Check if reset command
		if (StartsString("reset", $this->Command)) {

			// Reset search criteria
			if ($this->Command == "reset" || $this->Command == "resetall")
				$this->resetSearchParms();

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$orderBy = "";
				$this->setSessionOrderBy($orderBy);
				$this->id->setSort("");
				$this->fecha->setSort("");
				$this->hora->setSort("");
				$this->audio->setSort("");
				$this->st->setSort("");
				$this->fechaHoraIni->setSort("");
				$this->fechaHoraFin->setSort("");
				$this->telefono->setSort("");
				$this->agente->setSort("");
				$this->fechabo->setSort("");
				$this->agentebo->setSort("");
				$this->IP->setSort("");
				$this->actual->setSort("");
				$this->completado->setSort("");
			}

			// Reset start position
			$this->StartRecord = 1;
			$this->setStartRecordNumber($this->StartRecord);
		}
	}

	// Set up list options
	protected function setupListOptions()
	{
		global $Security, $Language;

		// Add group option item
		$item = &$this->ListOptions->add($this->ListOptions->GroupOptionName);
		$item->Body = "";
		$item->OnLeft = FALSE;
		$item->Visible = FALSE;

		// "view"
		$item = &$this->ListOptions->add("view");
		$item->CssClass = "text-nowrap";
		$item->Visible = TRUE;
		$item->OnLeft = FALSE;

		// "edit"
		$item = &$this->ListOptions->add("edit");
		$item->CssClass = "text-nowrap";
		$item->Visible = TRUE;
		$item->OnLeft = FALSE;

		// "copy"
		$item = &$this->ListOptions->add("copy");
		$item->CssClass = "text-nowrap";
		$item->Visible = TRUE;
		$item->OnLeft = FALSE;

		// "delete"
		$item = &$this->ListOptions->add("delete");
		$item->CssClass = "text-nowrap";
		$item->Visible = TRUE;
		$item->OnLeft = FALSE;

		// List actions
		$item = &$this->ListOptions->add("listactions");
		$item->CssClass = "text-nowrap";
		$item->OnLeft = FALSE;
		$item->Visible = FALSE;
		$item->ShowInButtonGroup = FALSE;
		$item->ShowInDropDown = FALSE;

		// "checkbox"
		$item = &$this->ListOptions->add("checkbox");
		$item->Visible = FALSE;
		$item->OnLeft = FALSE;
		$item->Header = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" name=\"key\" id=\"key\" class=\"custom-control-input\" onclick=\"ew.selectAllKey(this);\"><label class=\"custom-control-label\" for=\"key\"></label></div>";
		$item->ShowInDropDown = FALSE;
		$item->ShowInButtonGroup = FALSE;

		// Drop down button for ListOptions
		$this->ListOptions->UseDropDownButton = FALSE;
		$this->ListOptions->DropDownButtonPhrase = $Language->phrase("ButtonListOptions");
		$this->ListOptions->UseButtonGroup = FALSE;
		if ($this->ListOptions->UseButtonGroup && IsMobile())
			$this->ListOptions->UseDropDownButton = TRUE;

		//$this->ListOptions->ButtonClass = ""; // Class for button group
		// Call ListOptions_Load event

		$this->ListOptions_Load();
		$this->setupListOptionsExt();
		$item = $this->ListOptions[$this->ListOptions->GroupOptionName];
		$item->Visible = $this->ListOptions->groupOptionVisible();
	}

	// Render list options
	public function renderListOptions()
	{
		global $Security, $Language, $CurrentForm;
		$this->ListOptions->loadDefault();

		// Call ListOptions_Rendering event
		$this->ListOptions_Rendering();

		// "view"
		$opt = $this->ListOptions["view"];
		$viewcaption = HtmlTitle($Language->phrase("ViewLink"));
		if (TRUE) {
			$opt->Body = "<a class=\"ew-row-link ew-view\" title=\"" . $viewcaption . "\" data-caption=\"" . $viewcaption . "\" href=\"" . HtmlEncode($this->ViewUrl) . "\">" . $Language->phrase("ViewLink") . "</a>";
		} else {
			$opt->Body = "";
		}

		// "edit"
		$opt = $this->ListOptions["edit"];
		$editcaption = HtmlTitle($Language->phrase("EditLink"));
		if (TRUE) {
			$opt->Body = "<a class=\"ew-row-link ew-edit\" title=\"" . HtmlTitle($Language->phrase("EditLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("EditLink")) . "\" href=\"" . HtmlEncode($this->EditUrl) . "\">" . $Language->phrase("EditLink") . "</a>";
		} else {
			$opt->Body = "";
		}

		// "copy"
		$opt = $this->ListOptions["copy"];
		$copycaption = HtmlTitle($Language->phrase("CopyLink"));
		if (TRUE) {
			$opt->Body = "<a class=\"ew-row-link ew-copy\" title=\"" . $copycaption . "\" data-caption=\"" . $copycaption . "\" href=\"" . HtmlEncode($this->CopyUrl) . "\">" . $Language->phrase("CopyLink") . "</a>";
		} else {
			$opt->Body = "";
		}

		// "delete"
		$opt = $this->ListOptions["delete"];
		if (TRUE)
			$opt->Body = "<a class=\"ew-row-link ew-delete\"" . "" . " title=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" href=\"" . HtmlEncode($this->DeleteUrl) . "\">" . $Language->phrase("DeleteLink") . "</a>";
		else
			$opt->Body = "";

		// Set up list action buttons
		$opt = $this->ListOptions["listactions"];
		if ($opt && !$this->isExport() && !$this->CurrentAction) {
			$body = "";
			$links = [];
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == ACTION_SINGLE && $listaction->Allow) {
					$action = $listaction->Action;
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon != "") ? "<i class=\"" . HtmlEncode(str_replace(" ew-icon", "", $listaction->Icon)) . "\" data-caption=\"" . HtmlTitle($caption) . "\"></i> " : "";
					$links[] = "<li><a class=\"dropdown-item ew-action ew-list-action\" data-action=\"" . HtmlEncode($action) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({key:" . $this->keyToJson(TRUE) . "}," . $listaction->toJson(TRUE) . "));return false;\">" . $icon . $listaction->Caption . "</a></li>";
					if (count($links) == 1) // Single button
						$body = "<a class=\"ew-action ew-list-action\" data-action=\"" . HtmlEncode($action) . "\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({key:" . $this->keyToJson(TRUE) . "}," . $listaction->toJson(TRUE) . "));return false;\">" . $icon . $listaction->Caption . "</a>";
				}
			}
			if (count($links) > 1) { // More than one buttons, use dropdown
				$body = "<button class=\"dropdown-toggle btn btn-default ew-actions\" title=\"" . HtmlTitle($Language->phrase("ListActionButton")) . "\" data-toggle=\"dropdown\">" . $Language->phrase("ListActionButton") . "</button>";
				$content = "";
				foreach ($links as $link)
					$content .= "<li>" . $link . "</li>";
				$body .= "<ul class=\"dropdown-menu" . ($opt->OnLeft ? "" : " dropdown-menu-right") . "\">". $content . "</ul>";
				$body = "<div class=\"btn-group btn-group-sm\">" . $body . "</div>";
			}
			if (count($links) > 0) {
				$opt->Body = $body;
				$opt->Visible = TRUE;
			}
		}

		// "checkbox"
		$opt = $this->ListOptions["checkbox"];
		$opt->Body = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" id=\"key_m_" . $this->RowCount . "\" name=\"key_m[]\" class=\"custom-control-input ew-multi-select\" value=\"" . HtmlEncode($this->id->CurrentValue) . "\" onclick=\"ew.clickMultiCheckbox(event);\"><label class=\"custom-control-label\" for=\"key_m_" . $this->RowCount . "\"></label></div>";
		$this->renderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set up other options
	protected function setupOtherOptions()
	{
		global $Language, $Security;
		$options = &$this->OtherOptions;
		$option = $options["addedit"];

		// Add
		$item = &$option->add("add");
		$addcaption = HtmlTitle($Language->phrase("AddLink"));
		$item->Body = "<a class=\"ew-add-edit ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . HtmlEncode($this->AddUrl) . "\">" . $Language->phrase("AddLink") . "</a>";
		$item->Visible = $this->AddUrl != "";
		$option = $options["action"];

		// Set up options default
		foreach ($options as $option) {
			$option->UseDropDownButton = FALSE;
			$option->UseButtonGroup = TRUE;

			//$option->ButtonClass = ""; // Class for button group
			$item = &$option->add($option->GroupOptionName);
			$item->Body = "";
			$item->Visible = FALSE;
		}
		$options["addedit"]->DropDownButtonPhrase = $Language->phrase("ButtonAddEdit");
		$options["detail"]->DropDownButtonPhrase = $Language->phrase("ButtonDetails");
		$options["action"]->DropDownButtonPhrase = $Language->phrase("ButtonActions");

		// Filter button
		$item = &$this->FilterOptions->add("savecurrentfilter");
		$item->Body = "<a class=\"ew-save-filter\" data-form=\"fbdvlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->add("deletefilter");
		$item->Body = "<a class=\"ew-delete-filter\" data-form=\"fbdvlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
		$item->Visible = TRUE;
		$this->FilterOptions->UseDropDownButton = TRUE;
		$this->FilterOptions->UseButtonGroup = !$this->FilterOptions->UseDropDownButton;
		$this->FilterOptions->DropDownButtonPhrase = $Language->phrase("Filters");

		// Add group option item
		$item = &$this->FilterOptions->add($this->FilterOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

	// Render other options
	public function renderOtherOptions()
	{
		global $Language, $Security;
		$options = &$this->OtherOptions;
			$option = $options["action"];

			// Set up list action buttons
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == ACTION_MULTIPLE) {
					$item = &$option->add("custom_" . $listaction->Action);
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon != "") ? "<i class=\"" . HtmlEncode($listaction->Icon) . "\" data-caption=\"" . HtmlEncode($caption) . "\"></i> " . $caption : $caption;
					$item->Body = "<a class=\"ew-action ew-list-action\" title=\"" . HtmlEncode($caption) . "\" data-caption=\"" . HtmlEncode($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({f:document.fbdvlist}," . $listaction->toJson(TRUE) . "));return false;\">" . $icon . "</a>";
					$item->Visible = $listaction->Allow;
				}
			}

			// Hide grid edit and other options
			if ($this->TotalRecords <= 0) {
				$option = $options["addedit"];
				$item = $option["gridedit"];
				if ($item)
					$item->Visible = FALSE;
				$option = $options["action"];
				$option->hideAllOptions();
			}
	}

	// Process list action
	protected function processListAction()
	{
		global $Language, $Security;
		$userlist = "";
		$user = "";
		$filter = $this->getFilterFromRecordKeys();
		$userAction = Post("useraction", "");
		if ($filter != "" && $userAction != "") {

			// Check permission first
			$actionCaption = $userAction;
			if (array_key_exists($userAction, $this->ListActions->Items)) {
				$actionCaption = $this->ListActions[$userAction]->Caption;
				if (!$this->ListActions[$userAction]->Allow) {
					$errmsg = str_replace('%s', $actionCaption, $Language->phrase("CustomActionNotAllowed"));
					if (Post("ajax") == $userAction) // Ajax
						echo "<p class=\"text-danger\">" . $errmsg . "</p>";
					else
						$this->setFailureMessage($errmsg);
					return FALSE;
				}
			}
			$this->CurrentFilter = $filter;
			$sql = $this->getCurrentSql();
			$conn = $this->getConnection();
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			$rs = $conn->execute($sql);
			$conn->raiseErrorFn = "";
			$this->CurrentAction = $userAction;

			// Call row action event
			if ($rs && !$rs->EOF) {
				$conn->beginTrans();
				$this->SelectedCount = $rs->RecordCount();
				$this->SelectedIndex = 0;
				while (!$rs->EOF) {
					$this->SelectedIndex++;
					$row = $rs->fields;
					$processed = $this->Row_CustomAction($userAction, $row);
					if (!$processed)
						break;
					$rs->moveNext();
				}
				if ($processed) {
					$conn->commitTrans(); // Commit the changes
					if ($this->getSuccessMessage() == "" && !ob_get_length()) // No output
						$this->setSuccessMessage(str_replace('%s', $actionCaption, $Language->phrase("CustomActionCompleted"))); // Set up success message
				} else {
					$conn->rollbackTrans(); // Rollback changes

					// Set up error message
					if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

						// Use the message, do nothing
					} elseif ($this->CancelMessage != "") {
						$this->setFailureMessage($this->CancelMessage);
						$this->CancelMessage = "";
					} else {
						$this->setFailureMessage(str_replace('%s', $actionCaption, $Language->phrase("CustomActionFailed")));
					}
				}
			}
			if ($rs)
				$rs->close();
			$this->CurrentAction = ""; // Clear action
			if (Post("ajax") == $userAction) { // Ajax
				if ($this->getSuccessMessage() != "") {
					echo "<p class=\"text-success\">" . $this->getSuccessMessage() . "</p>";
					$this->clearSuccessMessage(); // Clear message
				}
				if ($this->getFailureMessage() != "") {
					echo "<p class=\"text-danger\">" . $this->getFailureMessage() . "</p>";
					$this->clearFailureMessage(); // Clear message
				}
				return TRUE;
			}
		}
		return FALSE; // Not ajax request
	}

	// Set up list options (extended codes)
	protected function setupListOptionsExt()
	{
	}

	// Render list options (extended codes)
	protected function renderListOptionsExt()
	{
	}

	// Load basic search values
	protected function loadBasicSearchValues()
	{
		$this->BasicSearch->setKeyword(Get(Config("TABLE_BASIC_SEARCH"), ""), FALSE);
		if ($this->BasicSearch->Keyword != "" && $this->Command == "")
			$this->Command = "search";
		$this->BasicSearch->setType(Get(Config("TABLE_BASIC_SEARCH_TYPE"), ""), FALSE);
	}

	// Load recordset
	public function loadRecordset($offset = -1, $rowcnt = -1)
	{

		// Load List page SQL
		$sql = $this->getListSql();
		$conn = $this->getConnection();

		// Load recordset
		$dbtype = GetConnectionType($this->Dbid);
		if ($this->UseSelectLimit) {
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			if ($dbtype == "MSSQL") {
				$rs = $conn->selectLimit($sql, $rowcnt, $offset, ["_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderBy())]);
			} else {
				$rs = $conn->selectLimit($sql, $rowcnt, $offset);
			}
			$conn->raiseErrorFn = "";
		} else {
			$rs = LoadRecordset($sql, $conn);
		}

		// Call Recordset Selected event
		$this->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	public function loadRow()
	{
		global $Security, $Language;
		$filter = $this->getRecordFilter();

		// Call Row Selecting event
		$this->Row_Selecting($filter);

		// Load SQL based on filter
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		$res = FALSE;
		$rs = LoadRecordset($sql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->loadRowValues($rs); // Load row values
			$rs->close();
		}
		return $res;
	}

	// Load row values from recordset
	public function loadRowValues($rs = NULL)
	{
		if ($rs && !$rs->EOF)
			$row = $rs->fields;
		else
			$row = $this->newRow();

		// Call Row Selected event
		$this->Row_Selected($row);
		if (!$rs || $rs->EOF)
			return;
		$this->id->setDbValue($row['id']);
		$this->fecha->setDbValue($row['fecha']);
		$this->hora->setDbValue($row['hora']);
		$this->audio->setDbValue($row['audio']);
		$this->st->setDbValue($row['st']);
		$this->fechaHoraIni->setDbValue($row['fechaHoraIni']);
		$this->fechaHoraFin->setDbValue($row['fechaHoraFin']);
		$this->telefono->setDbValue($row['telefono']);
		$this->agente->setDbValue($row['agente']);
		$this->fechabo->setDbValue($row['fechabo']);
		$this->agentebo->setDbValue($row['agentebo']);
		$this->comentariosbo->setDbValue($row['comentariosbo']);
		$this->IP->setDbValue($row['IP']);
		$this->actual->setDbValue($row['actual']);
		$this->completado->setDbValue($row['completado']);
		$this->_2_1_R->setDbValue($row['2_1_R']);
		$this->_2_2_R->setDbValue($row['2_2_R']);
		$this->_2_3_R->setDbValue($row['2_3_R']);
		$this->_3_4_R->setDbValue($row['3_4_R']);
		$this->_4_5_R->setDbValue($row['4_5_R']);
		$this->_4_6_R->setDbValue($row['4_6_R']);
		$this->_4_7_R->setDbValue($row['4_7_R']);
		$this->_4_8_R->setDbValue($row['4_8_R']);
		$this->_5_9_R->setDbValue($row['5_9_R']);
		$this->_5_10_R->setDbValue($row['5_10_R']);
		$this->_5_11_R->setDbValue($row['5_11_R']);
		$this->_5_12_R->setDbValue($row['5_12_R']);
		$this->_5_13_R->setDbValue($row['5_13_R']);
		$this->_5_14_R->setDbValue($row['5_14_R']);
		$this->_5_51_R->setDbValue($row['5_51_R']);
		$this->_6_15_R->setDbValue($row['6_15_R']);
		$this->_6_16_R->setDbValue($row['6_16_R']);
		$this->_6_17_R->setDbValue($row['6_17_R']);
		$this->_6_18_R->setDbValue($row['6_18_R']);
		$this->_6_19_R->setDbValue($row['6_19_R']);
		$this->_6_20_R->setDbValue($row['6_20_R']);
		$this->_6_52_R->setDbValue($row['6_52_R']);
		$this->_7_21_R->setDbValue($row['7_21_R']);
		$this->_8_22_R->setDbValue($row['8_22_R']);
		$this->_8_23_R->setDbValue($row['8_23_R']);
		$this->_8_24_R->setDbValue($row['8_24_R']);
		$this->_8_25_R->setDbValue($row['8_25_R']);
		$this->_9_26_R->setDbValue($row['9_26_R']);
		$this->_9_27_R->setDbValue($row['9_27_R']);
		$this->_9_28_R->setDbValue($row['9_28_R']);
		$this->_9_29_R->setDbValue($row['9_29_R']);
		$this->_9_30_R->setDbValue($row['9_30_R']);
		$this->_9_31_R->setDbValue($row['9_31_R']);
		$this->_9_32_R->setDbValue($row['9_32_R']);
		$this->_9_33_R->setDbValue($row['9_33_R']);
		$this->_9_34_R->setDbValue($row['9_34_R']);
		$this->_9_35_R->setDbValue($row['9_35_R']);
		$this->_9_36_R->setDbValue($row['9_36_R']);
		$this->_9_37_R->setDbValue($row['9_37_R']);
		$this->_9_38_R->setDbValue($row['9_38_R']);
		$this->_9_39_R->setDbValue($row['9_39_R']);
		$this->_10_40_R->setDbValue($row['10_40_R']);
		$this->_10_41_R->setDbValue($row['10_41_R']);
		$this->_11_42_R->setDbValue($row['11_42_R']);
		$this->_11_43_R->setDbValue($row['11_43_R']);
		$this->_12_44_R->setDbValue($row['12_44_R']);
		$this->_12_45_R->setDbValue($row['12_45_R']);
		$this->_12_46_R->setDbValue($row['12_46_R']);
		$this->_12_47_R->setDbValue($row['12_47_R']);
		$this->_12_48_R->setDbValue($row['12_48_R']);
		$this->_12_49_R->setDbValue($row['12_49_R']);
		$this->_12_50_R->setDbValue($row['12_50_R']);
		$this->_1__R->setDbValue($row['1__R']);
		$this->_13_54_R->setDbValue($row['13_54_R']);
		$this->_13_54_1_R->setDbValue($row['13_54_1_R']);
		$this->_13_54_2_R->setDbValue($row['13_54_2_R']);
		$this->_13_55_R->setDbValue($row['13_55_R']);
		$this->_13_55_1_R->setDbValue($row['13_55_1_R']);
		$this->_13_55_2_R->setDbValue($row['13_55_2_R']);
		$this->_13_56_R->setDbValue($row['13_56_R']);
		$this->_13_56_1_R->setDbValue($row['13_56_1_R']);
		$this->_13_56_2_R->setDbValue($row['13_56_2_R']);
		$this->_12_53_R->setDbValue($row['12_53_R']);
		$this->_12_53_1_R->setDbValue($row['12_53_1_R']);
		$this->_12_53_2_R->setDbValue($row['12_53_2_R']);
		$this->_12_53_3_R->setDbValue($row['12_53_3_R']);
		$this->_12_53_4_R->setDbValue($row['12_53_4_R']);
		$this->_12_53_5_R->setDbValue($row['12_53_5_R']);
		$this->_12_53_6_R->setDbValue($row['12_53_6_R']);
		$this->_13_57_R->setDbValue($row['13_57_R']);
		$this->_13_57_1_R->setDbValue($row['13_57_1_R']);
		$this->_13_57_2_R->setDbValue($row['13_57_2_R']);
		$this->_13_58_R->setDbValue($row['13_58_R']);
		$this->_13_58_1_R->setDbValue($row['13_58_1_R']);
		$this->_13_58_2_R->setDbValue($row['13_58_2_R']);
		$this->_13_59_R->setDbValue($row['13_59_R']);
		$this->_13_59_1_R->setDbValue($row['13_59_1_R']);
		$this->_13_59_2_R->setDbValue($row['13_59_2_R']);
		$this->_13_60_R->setDbValue($row['13_60_R']);
		$this->_12_53_7_R->setDbValue($row['12_53_7_R']);
		$this->_12_53_8_R->setDbValue($row['12_53_8_R']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['id'] = NULL;
		$row['fecha'] = NULL;
		$row['hora'] = NULL;
		$row['audio'] = NULL;
		$row['st'] = NULL;
		$row['fechaHoraIni'] = NULL;
		$row['fechaHoraFin'] = NULL;
		$row['telefono'] = NULL;
		$row['agente'] = NULL;
		$row['fechabo'] = NULL;
		$row['agentebo'] = NULL;
		$row['comentariosbo'] = NULL;
		$row['IP'] = NULL;
		$row['actual'] = NULL;
		$row['completado'] = NULL;
		$row['2_1_R'] = NULL;
		$row['2_2_R'] = NULL;
		$row['2_3_R'] = NULL;
		$row['3_4_R'] = NULL;
		$row['4_5_R'] = NULL;
		$row['4_6_R'] = NULL;
		$row['4_7_R'] = NULL;
		$row['4_8_R'] = NULL;
		$row['5_9_R'] = NULL;
		$row['5_10_R'] = NULL;
		$row['5_11_R'] = NULL;
		$row['5_12_R'] = NULL;
		$row['5_13_R'] = NULL;
		$row['5_14_R'] = NULL;
		$row['5_51_R'] = NULL;
		$row['6_15_R'] = NULL;
		$row['6_16_R'] = NULL;
		$row['6_17_R'] = NULL;
		$row['6_18_R'] = NULL;
		$row['6_19_R'] = NULL;
		$row['6_20_R'] = NULL;
		$row['6_52_R'] = NULL;
		$row['7_21_R'] = NULL;
		$row['8_22_R'] = NULL;
		$row['8_23_R'] = NULL;
		$row['8_24_R'] = NULL;
		$row['8_25_R'] = NULL;
		$row['9_26_R'] = NULL;
		$row['9_27_R'] = NULL;
		$row['9_28_R'] = NULL;
		$row['9_29_R'] = NULL;
		$row['9_30_R'] = NULL;
		$row['9_31_R'] = NULL;
		$row['9_32_R'] = NULL;
		$row['9_33_R'] = NULL;
		$row['9_34_R'] = NULL;
		$row['9_35_R'] = NULL;
		$row['9_36_R'] = NULL;
		$row['9_37_R'] = NULL;
		$row['9_38_R'] = NULL;
		$row['9_39_R'] = NULL;
		$row['10_40_R'] = NULL;
		$row['10_41_R'] = NULL;
		$row['11_42_R'] = NULL;
		$row['11_43_R'] = NULL;
		$row['12_44_R'] = NULL;
		$row['12_45_R'] = NULL;
		$row['12_46_R'] = NULL;
		$row['12_47_R'] = NULL;
		$row['12_48_R'] = NULL;
		$row['12_49_R'] = NULL;
		$row['12_50_R'] = NULL;
		$row['1__R'] = NULL;
		$row['13_54_R'] = NULL;
		$row['13_54_1_R'] = NULL;
		$row['13_54_2_R'] = NULL;
		$row['13_55_R'] = NULL;
		$row['13_55_1_R'] = NULL;
		$row['13_55_2_R'] = NULL;
		$row['13_56_R'] = NULL;
		$row['13_56_1_R'] = NULL;
		$row['13_56_2_R'] = NULL;
		$row['12_53_R'] = NULL;
		$row['12_53_1_R'] = NULL;
		$row['12_53_2_R'] = NULL;
		$row['12_53_3_R'] = NULL;
		$row['12_53_4_R'] = NULL;
		$row['12_53_5_R'] = NULL;
		$row['12_53_6_R'] = NULL;
		$row['13_57_R'] = NULL;
		$row['13_57_1_R'] = NULL;
		$row['13_57_2_R'] = NULL;
		$row['13_58_R'] = NULL;
		$row['13_58_1_R'] = NULL;
		$row['13_58_2_R'] = NULL;
		$row['13_59_R'] = NULL;
		$row['13_59_1_R'] = NULL;
		$row['13_59_2_R'] = NULL;
		$row['13_60_R'] = NULL;
		$row['12_53_7_R'] = NULL;
		$row['12_53_8_R'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("id")) != "")
			$this->id->OldValue = $this->getKey("id"); // id
		else
			$validKey = FALSE;

		// Load old record
		$this->OldRecordset = NULL;
		if ($validKey) {
			$this->CurrentFilter = $this->getRecordFilter();
			$sql = $this->getCurrentSql();
			$conn = $this->getConnection();
			$this->OldRecordset = LoadRecordset($sql, $conn);
		}
		$this->loadRowValues($this->OldRecordset); // Load row values
		return $validKey;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		$this->ViewUrl = $this->getViewUrl();
		$this->EditUrl = $this->getEditUrl();
		$this->InlineEditUrl = $this->getInlineEditUrl();
		$this->CopyUrl = $this->getCopyUrl();
		$this->InlineCopyUrl = $this->getInlineCopyUrl();
		$this->DeleteUrl = $this->getDeleteUrl();

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
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

		if ($this->RowType == ROWTYPE_VIEW) { // View row

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

			// IP
			$this->IP->ViewValue = $this->IP->CurrentValue;
			$this->IP->ViewCustomAttributes = "";

			// actual
			$this->actual->ViewValue = $this->actual->CurrentValue;
			$this->actual->ViewCustomAttributes = "";

			// completado
			$this->completado->ViewValue = $this->completado->CurrentValue;
			$this->completado->ViewCustomAttributes = "";

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
		}

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Set up search options
	protected function setupSearchOptions()
	{
		global $Language;
		$this->SearchOptions = new ListOptions("div");
		$this->SearchOptions->TagClassName = "ew-search-option";

		// Search button
		$item = &$this->SearchOptions->add("searchtoggle");
		$searchToggleClass = ($this->SearchWhere != "") ? " active" : " active";
		$item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fbdvlistsrch\">" . $Language->phrase("SearchLink") . "</a>";
		$item->Visible = TRUE;

		// Show all button
		$item = &$this->SearchOptions->add("showall");
		$item->Body = "<a class=\"btn btn-default ew-show-all\" title=\"" . $Language->phrase("ShowAll") . "\" data-caption=\"" . $Language->phrase("ShowAll") . "\" href=\"" . $this->pageUrl() . "cmd=reset\">" . $Language->phrase("ShowAllBtn") . "</a>";
		$item->Visible = ($this->SearchWhere != $this->DefaultSearchWhere && $this->SearchWhere != "0=101");

		// Button group for search
		$this->SearchOptions->UseDropDownButton = FALSE;
		$this->SearchOptions->UseButtonGroup = TRUE;
		$this->SearchOptions->DropDownButtonPhrase = $Language->phrase("ButtonSearch");

		// Add group option item
		$item = &$this->SearchOptions->add($this->SearchOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Hide search options
		if ($this->isExport() || $this->CurrentAction)
			$this->SearchOptions->hideAllOptions();
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset / cmd=resetall
		$Breadcrumb->add("list", $this->TableVar, $url, "", $this->TableVar, TRUE);
	}

	// Setup lookup options
	public function setupLookupOptions($fld)
	{
		if ($fld->Lookup !== NULL && $fld->Lookup->Options === NULL) {

			// No need to check any more
			$fld->Lookup->Options = [];

			// Set up lookup SQL
			switch ($fld->FieldVar) {
				default:
					$lookupFilter = "";
					break;
			}

			// Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
			$sql = $fld->Lookup->getSql(FALSE, "", $lookupFilter, $this);

			// Set up lookup cache
			if ($fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0) {
				$conn = $this->getConnection();
				$totalCnt = $this->getRecordCount($sql);
				if ($totalCnt > $fld->LookupCacheCount) // Total count > cache count, do not cache
					return;
				$rs = $conn->execute($sql);
				$ar = [];
				while ($rs && !$rs->EOF) {
					$row = &$rs->fields;

					// Format the field values
					switch ($fld->FieldVar) {
					}
					$ar[strval($row[0])] = $row;
					$rs->moveNext();
				}
				if ($rs)
					$rs->close();
				$fld->Lookup->Options = $ar;
			}
		}
	}

	// Set up starting record parameters
	public function setupStartRecord()
	{
		if ($this->DisplayRecords == 0)
			return;
		if ($this->isPageRequest()) { // Validate request
			$startRec = Get(Config("TABLE_START_REC"));
			$pageNo = Get(Config("TABLE_PAGE_NO"));
			if ($startRec !== NULL) { // Check for "start" parameter
				$this->StartRecord = $startRec;
				$this->setStartRecordNumber($this->StartRecord);
			} elseif ($pageNo !== NULL) {
				if (is_numeric($pageNo)) {
					$this->StartRecord = ($pageNo - 1) * $this->DisplayRecords + 1;
					if ($this->StartRecord <= 0) {
						$this->StartRecord = 1;
					} elseif ($this->StartRecord >= (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1) {
						$this->StartRecord = (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1;
					}
					$this->setStartRecordNumber($this->StartRecord);
				}
			}
		}
		$this->StartRecord = $this->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRecord) || $this->StartRecord == "") { // Avoid invalid start record counter
			$this->StartRecord = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRecord);
		} elseif ($this->StartRecord > $this->TotalRecords) { // Avoid starting record > total records
			$this->StartRecord = (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1; // Point to last page first record
			$this->setStartRecordNumber($this->StartRecord);
		} elseif (($this->StartRecord - 1) % $this->DisplayRecords != 0) {
			$this->StartRecord = (int)(($this->StartRecord - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1; // Point to page boundary
			$this->setStartRecordNumber($this->StartRecord);
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$customError) {

		// Return error message in CustomError
		return TRUE;
	}

	// ListOptions Load event
	function ListOptions_Load() {

		// Example:
		//$opt = &$this->ListOptions->Add("new");
		//$opt->Header = "xxx";
		//$opt->OnLeft = TRUE; // Link on left
		//$opt->MoveTo(0); // Move to first column

	}

	// ListOptions Rendering event
	function ListOptions_Rendering() {

		//$GLOBALS["xxx_grid"]->DetailAdd = (...condition...); // Set to TRUE or FALSE conditionally
		//$GLOBALS["xxx_grid"]->DetailEdit = (...condition...); // Set to TRUE or FALSE conditionally
		//$GLOBALS["xxx_grid"]->DetailView = (...condition...); // Set to TRUE or FALSE conditionally

	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example:
		//$this->ListOptions["new"]->Body = "xxx";

	}

	// Row Custom Action event
	function Row_CustomAction($action, $row) {

		// Return FALSE to abort
		return TRUE;
	}

	// Page Exporting event
	// $this->ExportDoc = export document object
	function Page_Exporting() {

		//$this->ExportDoc->Text = "my header"; // Export header
		//return FALSE; // Return FALSE to skip default export and use Row_Export event

		return TRUE; // Return TRUE to use default export and skip Row_Export event
	}

	// Row Export event
	// $this->ExportDoc = export document object
	function Row_Export($rs) {

		//$this->ExportDoc->Text .= "my content"; // Build HTML with field value: $rs["MyField"] or $this->MyField->ViewValue
	}

	// Page Exported event
	// $this->ExportDoc = export document object
	function Page_Exported() {

		//$this->ExportDoc->Text .= "my footer"; // Export footer
		//echo $this->ExportDoc->Text;

	}

	// Page Importing event
	function Page_Importing($reader, &$options) {

		//var_dump($reader); // Import data reader
		//var_dump($options); // Show all options for importing
		//return FALSE; // Return FALSE to skip import

		return TRUE;
	}

	// Row Import event
	function Row_Import(&$row, $cnt) {

		//echo $cnt; // Import record count
		//var_dump($row); // Import row
		//return FALSE; // Return FALSE to skip import

		return TRUE;
	}

	// Page Imported event
	function Page_Imported($reader, $results) {

		//var_dump($reader); // Import data reader
		//var_dump($results); // Import results

	}
} // End class
?>